<?php
	include("/app/include/configurations.php");
	include("/app/include/general_functions.php");
	// include("../include/configurations.php");
	// include("../include/general_functions.php");
	

	$sel = "select * from sent_messages where status = 0 and (created_at + interval 5 minute) < NOW() and message_type_id = 3 order by created_at";
	$rs = mysqli_query($mysqli, $sel);
	$cnt = mysqli_num_rows($rs);

	if ($cnt > 0) {
		while($row = mysqli_fetch_assoc($rs)) {
			$upResponse = "update emergency_recipients set remarks = 'a:no' where remarks is null and batch_id = " . $row['batch_id'];
			$rsResponse = mysqli_query($mysqli, $upResponse);

			if ($rsResponse !== false) {
				$upMsg = "update sent_messages set status = 1 where id = " . $row['id'];
				$rsMsg = mysqli_query($mysqli, $upMsg);

				if ($rsMsg !== false) {
					echo 'success';
					error_log('success');
				} else {
					error_log(mysqli_error($mysqli));
				}
			} else {
				error_log(mysqli_error($mysqli));
			}
		}
	}

	//echo date_default_timezone_get();

	//date_default_timezone_set('Pacific/Efate');

	//error_log("Hello: " . date('Y-m-d H:i:s',time()));
	// $sel = "select * from login_logs order by created_at desc limit 1";
	// $rs = mysqli_query($mysqli, $sel);
	// $row = mysqli_fetch_assoc($rs);

	// echo setDate("Y-m-d H:i:sP", $row['created_at']) . "\n";
?>