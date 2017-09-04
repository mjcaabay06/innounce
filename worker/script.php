<?php
	include("../include/configurations.php");
	include("../include/general_functions.php");
	//date_default_timezone_set('Pacific/Efate');

	//error_log("Hello: " . date('Y-m-d H:i:s',time()));
	$sel = "select * from login_logs order by created_at desc limit 1";
	$rs = mysqli_query($mysqli, $sel);
	$row = mysqli_fetch_assoc($rs);

	$login = new DateTime($row['created_at']);
	$login->setTimezone(new DateTimeZone('Asia/Manila'));
	echo $login->format("Y-m-d H:i:sP") . "\n";
?>