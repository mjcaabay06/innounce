<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		print_r($_POST['students']);
		print_r($_POST['prof']);
		print_r($_POST['message']);
	}