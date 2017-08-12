<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	$insertLogout = "insert into logout_logs(user_id,ip_address,remarks) values(" . $_SESSION['authId'] . ", '" . getClientIp() . "', 'Successful')";
	$rsLogout = mysqli_query($mysqli, $insertLogout);

	if ($rsLogout !== false) {
		session_destroy();
		header("Location: ./");
	}