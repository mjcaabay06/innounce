<?php
	include("/app/include/configurations.php");
	include("/app/include/general_functions.php");
	//date_default_timezone_set('Pacific/Efate');

	//error_log("Hello: " . date('Y-m-d H:i:s',time()));
	$sel = "select * from login_logs order by created_at desc limit 1";
	$rs = mysqli_query($mysqli, $sel);
	$row = mysqli_fetch_assoc($rs);

	echo setDate("Y-m-d H:i:sP", $row['created_at']) . "\n";

	//echo date_default_timezone_get();
?>