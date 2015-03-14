<?php
/*
 * Use gzip to compress the upload
 */ 
function s3bubble_compress($source, $level = 9) {
	$cfg = get_option('s3bubblebackup_options');
	$level = $cfg['gzip_lvl'];

	$dest = $source . '.gz';
	$mode = 'wb' . $level;
	$error = false;
	if ($fp_out = gzopen($dest, $mode)) {
		if ($fp_in = fopen($source, 'rb')) {
			while (!feof($fp_in))
				gzwrite($fp_out, fread($fp_in, 1024 * 512));
			fclose($fp_in);
		} else {
			$error = true;
		}
		gzclose($fp_out);
	} else {
		$error = true;
	}
	if ($error)
		return false;
	else
		return $dest;
}

/*
 * Run php exec to run a sql dump
 */ 
function s3bubblebackup_exec($file, $action) {
	global $wpdb;

	$handle = fopen($file, 'wb');

	if (!$handle)
		return new WP_Error('db_dump', 'Could not open ' . $file . ' for writing.');

	fwrite($handle, "/**\n");
	fwrite($handle, " * SQL Dump created with S3Bubble Backup\n");
	fwrite($handle, " *\n");
	fwrite($handle, " */\n\n");

	fwrite($handle, "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n");
	fwrite($handle, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n");
	fwrite($handle, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n");
	fwrite($handle, "/*!40101 SET NAMES " . DB_CHARSET . " */;\n");
	fwrite($handle, "/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n");
	fwrite($handle, "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n");
	fwrite($handle, "/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n\n");

	$tables = $wpdb -> get_results("SHOW TABLES", ARRAY_A);

	if (empty($tables))
		return new WP_Error('db_dump', 'There are no tables in the database.');

	foreach ($tables as $table_array) {
		$table = current($table_array);
		$create = $wpdb -> get_var("SHOW CREATE TABLE " . $table, 1);
		$myisam = strpos($create, 'MyISAM');

		fwrite($handle, "/* Dump of table `" . $table . "`\n");
		fwrite($handle, " * ------------------------------------------------------------*/\n\n");

		fwrite($handle, "DROP TABLE IF EXISTS `" . $table . "`;\n\n" . $create . ";\n\n");

		$data = $wpdb -> get_results("SELECT * FROM `" . $table . "` LIMIT 1000", ARRAY_A);
		if (!empty($data)) {
			fwrite($handle, "LOCK TABLES `" . $table . "` WRITE;\n");
			if (false !== $myisam)
				fwrite($handle, "/*!40000 ALTER TABLE `" . $table . "` DISABLE KEYS */;\n\n");

			$offset = 0;
			do {
				foreach ($data as $entry) {
					foreach ($entry as $key => $value) {
						if (NULL === $value)
							$entry[$key] = "NULL";
						elseif ("" === $value || false === $value)
							$entry[$key] = "''";
						elseif (!is_numeric($value))
							$entry[$key] = "'" . mysql_real_escape_string($value) . "'";
					}
					fwrite($handle, "INSERT INTO `" . $table . "` (" . implode(", ", array_keys($entry)) . ") VALUES (" . implode(", ", $entry) . " );\n");
				}

				$offset += 1000;
				$data = $wpdb -> get_results("SELECT * FROM `" . $table . "` LIMIT " . $offset . ",1000", ARRAY_A);
			} while(!empty($data));

			if (false !== $myisam)
				fwrite($handle, "\n/*!40000 ALTER TABLE `" . $table . "` ENABLE KEYS */;");
			fwrite($handle, "\nUNLOCK TABLES;\n\n");
		}
	}

	fwrite($handle, "/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;\n");
	fwrite($handle, "/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;\n");
	fwrite($handle, "/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;\n");
	fwrite($handle, "/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n");
	fwrite($handle, "/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n");
	fwrite($handle, "/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n");

	fclose($handle);

	$cfg = get_option('s3bubblebackup_options');
	if ($cfg['compression'] == 'gz') {
		s3bubble_compress($file);
		unlink($file);
	}
}

/*
 * Open directory function
 */
function s3bubblebackup_open($fp, $mode = 'write') {
	switch(S3BUBBLE_COMPRESSION) {
		case 'gz' :
			if ($mode == 'write') {
				$fp = $fp . '.sql.gz';
				$file = @gzopen($fp, 'w' . S3BUBBLE_GZIP_LVL);
			} else
				$file = @gzopen($fp, "r");
			break;

		default :
			if ($mode == 'write') {
				$fp = $fp . '.sql';
				$file = @fopen($fp, "w");
			} else
				$file = @fopen($fp, "r");
			break;
	}
	return array($file, $fp);
}

/*
 * Recursively get the directory filesize
 * @author sam
 * @params PATH, format, exclude
 */
function recursive_directory_size($directory, $format = FALSE, $exclude = NULL) {
	$size = 0;
	if (substr($directory, -1) == '/') {
		$directory = substr($directory, 0, -1);
	}
	if (!file_exists($directory) || !is_dir($directory) || !is_readable($directory)) {
		return -1;
	}
	if ($handle = opendir($directory)) {
		while (($file = readdir($handle)) !== false) {
			if (basename($directory) != "$exclude") {
				$path = $directory . '/' . $file;
				if ($file != '.' && $file != '..') {
					if (is_file($path)) {
						$size += filesize($path);
					} elseif (is_dir($path)) {
						$handlesize = recursive_directory_size($path, FALSE, $exclude);
						if ($handlesize >= 0) {
							$size += $handlesize;
						} else {
							return -1;
						}
					}
				}
			}
		}
		closedir($handle);
	}
	if ($format == TRUE) {
		if ($size / 1048576 > 1) {
			if(round($size / 1048576, 1) > 500){
				return '<li class="highlight-no">The backup filesize of your wp-content/ folder will be <strong>' . round($size / 1048576, 1) . ' MB</strong> <i class="wp-menu-image dashicons-before dashicons-no" style="color: red;"></i></li>';
			}else{
				return '<li class="highlight-yes">The backup filesize of your wp-content/ folder will be <strong>' . round($size / 1048576, 1) . ' MB</strong> <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
			}
		} elseif ($size / 1024 > 1) {
			return '<li class="highlight-yes">The backup filesize of your wp-content/ folder will be <strong>' . round($size / 1024, 1) . ' KB</strong> <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
		} else {
			return '<li class="highlight-yes">The backup filesize of your wp-content/ folder will be <strong>' . round($size, 1) . ' bytes</strong> <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
		}
	} else {
		return $size;
	}
}


/*
 * Recursively get the directory filesize
 * @author sam
 * @params PATH, format, exclude
 */
function recursive_directory_size_backup($directory, $format=FALSE)
{
	$size = 0;

	// if the path has a slash at the end we remove it here
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}

	// if the path is not valid or is not a directory ...
	if(!file_exists($directory) || !is_dir($directory) || !is_readable($directory))
	{
		// ... we return -1 and exit the function
		return -1;
	}
	// we open the directory
	if($handle = opendir($directory))
	{
		// and scan through the items inside
		while(($file = readdir($handle)) !== false)
		{
			// we build the new path
			$path = $directory.'/'.$file;

			// if the filepointer is not the current directory
			// or the parent directory
			if($file != '.' && $file != '..')
			{
				// if the new path is a file
				if(is_file($path))
				{
					// we add the filesize to the total size
					$size += filesize($path);

				// if the new path is a directory
				}elseif(is_dir($path))
				{
					// we call this function with the new path
					$handlesize = recursive_directory_size($path);

					// if the function returns more than zero
					if($handlesize >= 0)
					{
						// we add the result to the total size
						$size += $handlesize;

					// else we return -1 and exit the function
					}else{
						return -1;
					}
				}
			}
		}
		// close the directory
		closedir($handle);
	}
	// if the format is set to human readable
	if($format == TRUE)
	{
		// if the total size is bigger than 1 MB
		if($size / 1048576 > 1)
		{
			return round($size / 1048576, 1).' MB';

		// if the total size is bigger than 1 KB
		}elseif($size / 1024 > 1)
		{
			return round($size / 1024, 1).' KB';

		// else return the filesize in bytes
		}else{
			return round($size, 1).' bytes';
		}
	}else{
		// return the total filesize in bytes
		return $size;
	}
}

/*
 * Gets the database filesize
 * @author sam
 * @params 
 */
function database_size() {
	global $wpdb;
	$results = $wpdb->get_results( 'SELECT 
	table_schema "' . DB_NAME . '", 
	SUM(data_length+index_length)/1024/1024 "DatabaseSize", 
	SUM(data_free)/1024/1024 "Free Space in MB" 
	FROM information_schema.TABLES 
	GROUP BY table_schema;', OBJECT );
	if(round($results[0]->DatabaseSize) > 150){
		return '<li class="highlight-no">Your database backup filesize will be <strong>' . round($results[0]->DatabaseSize) . 'MB</strong> <i class="wp-menu-image dashicons-before dashicons-no" style="color: red;"></i></li>';
	}else{
		return '<li class="highlight-yes">Your database backup filesize will be <strong>' . round($results[0]->DatabaseSize) . 'MB</strong> <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
	}
}

/*
 * Checks if gzip is enabled
 * @author sam
 * @params 
 */
function gzip_enabled() {
	$cfg = get_option('s3bubblebackup_options'); 
	if(function_exists('gzopen')) {
        if($cfg['compression'] == 'gz')
            $results = '<li>GZIP is available and active <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
        if($cfg['compression'] == 'none')
            $results = '<li>GZIP is available but inactive <i class="wp-menu-image dashicons-before dashicons-no" style="color: red;"></i></li>';
    }
    else {
        $results = '<li>GZIP is not available, S3Bubble backup <strong>MAY</strong> not function correctly if you have it set <i class="wp-menu-image dashicons-before dashicons-no" style="color: red;"></i></li>';
    }
	return $results;
}

/*
 * Checks if schediling is enabled
 * @author sam
 * @params 
 */
function scheduling_active() {
	if(wp_get_schedule('run_s3bubble_backup_database')){
		$scheduledtime = wp_next_scheduled('run_s3bubble_backup_database');
		$formatscheduledtime = date('F j, Y, H:i:s', $scheduledtime);
    	return '<li>Scheduling is active! <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li><li>Next scheduled update: <strong>' . $formatscheduledtime . '</strong> <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li><li>Current server time: <strong>' . date('F j, Y, H:i:s') . '</strong> <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
	}else{
		return '<li>Scheduling is not active! <i class="wp-menu-image dashicons-before dashicons-no" style="color: red;"></i></li>';
	}
}

/*
 * Checks Memory Limit
 * @author sam
 * @params 
 */
function memory_limit() {
    return '<li>PHP MEMORY_LIMIT: <strong>' . ini_get('memory_limit') . '</strong> | PHP MAX_EXECUTION_TIME: <strong>' . ini_get('max_execution_time') . '</strong> <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
}	

/*
 * Checks Exec Function can be used
 * @author sam
 * @params 
 */
function exec_check($content_dir) {
	if(function_exists('exec')) {
		if(exec('echo EXEC') == 'EXEC'){
			 $output = shell_exec("cd {$content_dir} && du -sh --exclude='s3bubblebackups*'");
			 return '<li>Your setup has passed the backup check function.<i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
		} 
	}else{
		 return '<li>Exec function is not available defaulting to PHP ZIP Archive.<i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i></li>';
	}
}	

/*
 * Checks System files exsist
 * @author sam
 * @params 
 */
function system_files() {
	$cfg = get_option('s3bubblebackup_options'); 
    $is_safe_mode = ini_get('safe_mode') == '1' ? 1 : 0;
	if(!empty($cfg['export_dir'])) {
		if(!is_dir($cfg['export_dir']) && !$is_safe_mode) {
			@mkdir($cfg['export_dir'], 0777, true);
			@chmod($cfg['export_dir'], 0777);
	
			if(is_dir($cfg['export_dir']))
				$s3bubble_msg[] = 'Folder <strong>' . $cfg['export_dir'] . '</strong> was successfully created!';
			else
				$s3bubble_msg[] = $is_safe_mode ? 'PHP Safe Mode is active' : 'Folder <strong>' . $cfg['export_dir'] . '</strong> was not created. Check permissions! <a href="https://s3bubble.com/permissions-error-s3bubble-backup-plugin/" target="_blank">Read Tutorial</a> <i class="wp-menu-image dashicons-before dashicons-no" style="color: red;"></i>';								
		}
		else
			$s3bubble_msg[] = 'Folder <strong>' . $cfg['export_dir'] . '</strong> is available<i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i>';
		
		if(is_dir($cfg['export_dir'])) {
			$dirloops = array('.htaccess', 'index.html');	
			foreach($dirloops as $dirloop) {
				if(!file_exists($cfg['export_dir'] . '/' . $dirloop)) {
					if($file = @fopen($cfg['export_dir'] . '/' . $dirloop, 'w'))  {	
						$cofipr =  ($dirloop == 'index.html')? '' : "";
						fwrite($file, $cofipr);
						fclose($file);
						$s3bubble_msg[] = 'File <strong>' . $dirloop . '</strong> was created';
					}	
					else
						$s3bubble_msg[] = 'File <strong>' . $dirloop . '</strong> was not created. Check permissions! <a href="https://s3bubble.com/permissions-error-s3bubble-backup-plugin/" target="_blank">Read Tutorial</a> <i class="wp-menu-image dashicons-before dashicons-no" style="color: red;"></i>';
				}
				else
					$s3bubble_msg[] = 'File <strong>' . $dirloop . '</strong> is available <i class="wp-menu-image dashicons-before dashicons-yes" style="color: green;"></i>';
			} 
		}
	}
	else {
		$s3bubble_msg[] = 'Specify the folder where the backups will be stored';
	}
	return $s3bubble_msg;
}		

/*
 * check timezones
 */
function time_zone_check(){
	return get_option('timezone_string'); 
}

	
?>