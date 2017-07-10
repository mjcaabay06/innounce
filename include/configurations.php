<?php
	//session_start();
	date_default_timezone_set('Asia/Manila');

	// $host = "localhost";
	// $username = "root";
	// $password = "mvc456$";
	// $dbname = "login_db";
	$url = getenv('JAWSDB_URL');
	$dbparts = parse_url($url);

	$host = $dbparts['host'];
	$username = $dbparts['user'];
	$password = $dbparts['pass'];
	$dbname = ltrim($dbparts['path'],'/');

	$mysqli = mysqli_connect($host, $username, $password, $dbname);

	if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}