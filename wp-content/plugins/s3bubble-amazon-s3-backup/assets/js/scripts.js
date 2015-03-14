jQuery(document).ready(function($) {
	/*
	 * general functions
	 */
	function getDayFormatted() {
		var d = new Date();
		var weekday = new Array(7);
		weekday[0] = "Sunday";
		weekday[1] = "Monday";
		weekday[2] = "Tuesday";
		weekday[3] = "Wednesday";
		weekday[4] = "Thursday";
		weekday[5] = "Friday";
		weekday[6] = "Saturday";
		return weekday[d.getDay()];
	}


	$.tablesorter.addParser({
		id : "remote",
		is : function() {
			return false;
		},
		format : function(s, table, cell) {
			return $(cell).attr('id') || s;
		},
		type : "numeric"
	});
	$.tablesorter.addParser({
		id : "local",
		is : function() {
			return false;
		},
		format : function(s, table, cell) {
			return $(cell).attr('id') || s;
		},
		type : "numeric"
	});
	$("#s3LocalTable").tablesorter({
		headers : {
			1 : {
				sorter : "local"
			}
		}
	});
	$("#s3RemoteTable").tablesorter({
		headers : {
			1 : {
				sorter : "remote"
			}
		},
		sortList: [[1,1]] 
	});
	/*
	 * format database date info
	 */
	$('#severy').on('change', function() {
		updateDBAlert();
		return false;
	});
	$('#database-hours').on('change', function() {
		updateDBAlert();
		return false;
	});
	$('#database-minutes').on('change', function() {
		updateDBAlert();
		return false;
	});
	$('#database-seconds').on('change', function() {
		updateDBAlert();
		return false;
	});
	$('#speriod').on('change', function() {
		updateDBAlert();
		return false;
	});
	function updateDBAlert() {
		$('#database-time-section').show();
		// Every hour
		if ($('#speriod').val() === '3600') {
			var d = new Date();
			var n = d.getMinutes();
			$('#database-time-section').hide();
			$('#database-time-info').html('<span id="database-time-info-inner">Your database backup will run every <span id="s3bubble-database-interval">hour</span> at ' + n + ' minutes past.</span>');
			if (parseInt($('#severy').val()) === 1) {
				$('#s3bubble-database-interval').html('hour');
			} else {
				$('#s3bubble-database-interval').html($('#severy').val() + ' hours');
			}
			// Every day
		} else if ($('#speriod').val() === '86400') {
			$('#database-time-info').html('<span id="database-time-info-inner">Your database backup will run every <span id="s3bubble-database-interval">day</span> at <span id="s3bubble-database-time">now</span>.</span>');
			if (parseInt($('#severy').val()) === 1) {
				$('#s3bubble-database-interval').html('day');
			} else {
				$('#s3bubble-database-interval').html($('#severy').val() + ' days');
			}
			$('#s3bubble-database-time').html($('#database-hours').val() + ':' + $('#database-minutes').val());
			// Every week
		} else if ($('#speriod').val() === '604800') {
			$('#database-time-info').html('<span id="database-time-info-inner">Your database backup will run every <span id="s3bubble-database-interval">week</span> at <span id="s3bubble-database-time">now</span>.</span>');
			if (parseInt($('#severy').val()) === 1) {
				$('#s3bubble-database-interval').html('week on ' + getDayFormatted());
			} else {
				$('#s3bubble-database-interval').html($('#severy').val() + ' weeks on ' + getDayFormatted());
			}
			$('#s3bubble-database-time').html($('#database-hours').val() + ':' + $('#database-minutes').val());
			// Every month
		} else if ($('#speriod').val() === '2592000') {
			$('#database-time-info').html('<span id="database-time-info-inner">Your database backup will run every <span id="s3bubble-database-interval">month</span> at <span id="s3bubble-database-time">now</span>.</span>');
			if (parseInt($('#severy').val()) === 1) {
				$('#s3bubble-database-interval').html('month on ' + getDayFormatted());
			} else {
				$('#s3bubble-database-interval').html($('#severy').val() + ' months on ' + getDayFormatted());
			}
			$('#s3bubble-database-time').html($('#database-hours').val() + ':' + $('#database-minutes').val());
		}
	}

	/*
	 * format filesystem date info
	 */
	$('#fevery').on('change', function() {
		updateFSAlert();
		return false;
	});
	$('#fperiod').on('change', function() {
		updateFSAlert();
		return false;
	});
	$('#filesystem-fhours').on('change', function() {
		updateFSAlert();
		return false;
	});
	$('#filesystem-fminutes').on('change', function() {
		updateFSAlert();
		return false;
	});

	function updateFSAlert() {
		$('#filesystem-time-section').show();
		// Every hour
		if ($('#fperiod').val() === '86400') {
			$('#filesystem-time-info').html('<span id="filesystem-time-info-inner">Your filesystem backup will run every <span id="s3bubble-filesystem-interval">day</span> at <span id="s3bubble-filesystem-time">now</span>.</span>');
			if (parseInt($('#fevery').val()) === 1) {
				$('#s3bubble-filesystem-interval').html('day');
			} else {
				$('#s3bubble-filesystem-interval').html($('#fevery').val() + ' days');
			}
			$('#s3bubble-filesystem-time').html($('#filesystem-fhours').val() + ':' + $('#filesystem-fminutes').val());
			// Every week
		} else if ($('#fperiod').val() === '604800') {
			$('#filesystem-time-info').html('<span id="filesystem-time-info-inner">Your filesystem backup will run every <span id="s3bubble-filesystem-interval">week</span> at <span id="s3bubble-filesystem-time">now</span>.</span>');
			if (parseInt($('#fevery').val()) === 1) {
				$('#s3bubble-filesystem-interval').html('week on ' + getDayFormatted());
			} else {
				$('#s3bubble-filesystem-interval').html($('#fevery').val() + ' weeks on ' + getDayFormatted());
			}
			$('#s3bubble-filesystem-time').html($('#filesystem-fhours').val() + ':' + $('#filesystem-fminutes').val());
			// Every month
		} else if ($('#fperiod').val() === '2592000') {
			$('#filesystem-time-info').html('<span id="filesystem-time-info-inner">Your filesystem backup will run every <span id="s3bubble-filesystem-interval">month</span> at <span id="s3bubble-filesystem-time">now</span>.</span>');
			if (parseInt($('#fevery').val()) === 1) {
				$('#s3bubble-filesystem-interval').html('month on ' + getDayFormatted());
			} else {
				$('#s3bubble-filesystem-interval').html($('#fevery').val() + ' months on ' + getDayFormatted());
			}
			$('#s3bubble-filesystem-time').html($('#filesystem-fhours').val() + ':' + $('#filesystem-fminutes').val());
		}
	}

	/*
	 * clear backup folder
	 */
	$('#s3bubble-clear-all').on('click', function() {

		var r = confirm("Please confirm you would like to empty local backups directory!");
		if (r == true) { 
			var data = {
				'action' : 's3bubble_backup_clear_all'
			};
			$.post(ajaxurl, data, function(response) {
				alert('Directory successfully emptied.');
				location.reload();
			});
		}

		return false;
	});

});
