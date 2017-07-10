<?php
	//session_start();
	date_default_timezone_set('Asia/Manila');

	$host = "localhost";
	$username = "root";
	$password = "mvc456$";
	$dbname = "login_db";

	$mysqli = mysqli_connect($host, $username, $password, $dbname);

	if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}