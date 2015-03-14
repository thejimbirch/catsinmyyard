<?php 
//include the S3 class  
$surl = S3BUBBLEBACKUP_PLUGIN_PATH . '/classes/vendor/autoload.php';
use Aws\S3\S3Client;
require_once('inc/functions.php');
$cfg = get_option('s3bubblebackup_options'); 
if(isset($_POST['s3bubble-delete-file'])) {
	$filepath = $cfg['export_dir'] . '/' . $_POST['filename'];
	if (file_exists($filepath)) {
		unlink($filepath);
	}
}
?>
<div class="wrap"> 
	<div id="poststuff">
        <div class="postbox">
            <h3 class="hndle"><span>S3Bubble Backup Protection Status</span></h3>
            <div class="inside">
                <p>
                    <strong>Your site is protected by <a href="https://s3bubble.com" target="_blank">S3Bubble.com</a>.</strong>
                    Your local directory filesize is <strong><?php echo recursive_directory_size_backup($cfg['export_dir'],TRUE); ?>.</strong>
                </p>
                <p><span class="description">Click <strong>download button</strong> to download backup to your computer. Depending on your bandwidth, number of posts and server capabilities, an backup should be performed at a low-traffic hour.</span> All local backups will be removed every hour to avoid server load everything will be stored on S3Bubble.com Amazon S3.</p>
            </div>
        </div>
	</div>
	<h2><div class="dashicons dashicons-cloud" style="font-size: 28px;margin-right: 6px;"></div> S3Bubble Amazon S3 Backups <small style="float: right;font-size: 14px;font-style: italic;">Bucket: <?php echo get_option('s3_bucket_name'); ?></small></h2>
	<?php
	if(!function_exists('curl_multi_exec') || !function_exists('curl_init')) {
		echo "This plugin requires PHP curl to connect to Amazon S3 please contact your hosting to install.";
		exit();
	}
	if(!class_exists('S3Client'))
        require_once($surl);  

	if(!defined('awsAccessKey')) define('awsAccessKey', get_option('s3_access_key'));
	if(!defined('awsSecretKey')) define('awsSecretKey', get_option('s3_secret_key'));
	$client = S3Client::factory(array(
		'key' => awsAccessKey,
		'secret' => awsSecretKey
	));
	try {
		// Get the contents of our bucket
		$iterator = $client -> listObjects(array(
			'Bucket' => get_option('s3_bucket_name')
		));
		?>
		<table id="s3RemoteTable" class="widefat tablesorter"> 
			<thead>
				<tr>
					<th scope="col">#</th>
					<th>File (backup date/time)</th>
					<th>File (backup link/name)</th>
					<th>Filesize</th>
					<th>State</th>
					<th>Download</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th scope="col">#</th>
					<th>File (backup date/time)</th>
					<th>File (backup link/name)</th>
					<th>Filesize</th>
					<th>State</th>
					<th>Download</th>
				</tr>
			</tfoot>
			<?php
			if (isset($iterator['Contents'])) {
					$a = 0;
					foreach ($iterator['Contents'] as $object) {
						$file_parts = pathinfo($object['Key']);
						if(isset($file_parts['extension'])){
							if($file_parts['extension'] == 'sql' || $file_parts['extension'] == 'gz'){
								$fdate = explode("T", $object['LastModified']);	
								$fname = $object['Key'];
								$fsize = $object['Size'];
								$furl  = $client -> getObjectUrl(get_option('s3_bucket_name'), $fname, '+59 minutes');
					            ?>
					            <tr>
					                <td><?php echo ++$a; ?></td>
					                <td id="<?php echo strtotime($object['LastModified']); ?>"><?php echo date('D F j, Y', strtotime($fdate[0])); ?> <?php echo substr($fdate[1], 0, -5); ?></td>
					                <td><?php echo '<a href="' . $furl . '">' . $fname . '</a>'; ?></td>
					                <td><?php echo size_format($fsize, 2); ?></td>
					                <td>Private on Amazon</td>
					                <td><a href="<?php echo $furl; ?>" class="button">Download</a>
					            </tr>
	        <?php }}}} ?>
		</table>
		<?php
	}
	catch (Exception $e) {

		echo '<div id="message" class="updated fade"><p>'.$e -> getMessage().'</p></div>';
	} ?>
</div>
