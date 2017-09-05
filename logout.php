<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	$insertLogout = "insert into logout_logs(user_id,ip_address,remarks) values(" . $_COOKIE['authId'] . ", '" . getClientIp() . "', 'Successful')";
	$rsLogout = mysqli_query($mysqli, $insertLogout);

	if ($rsLogout !== false) {
		setcookie('authId', '', time() - 3600);
		setcookie('username', '', time() - 3600);
		setcookie('userType', '', time() - 3600);

		session_destroy();
		header("Location: ./");
	}