<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	$userLogout = "update users set last_access = NOW() where id = " . $_SESSION['authId'];
	$rsLogout = mysqli_query($mysqli, $userLogout);

	if ($rsLogout !== false) {
		session_destroy();
		header("Location: ./");
	}