<?php
	include("configurations.php");
	include("general_functions.php");

	$response = sendViaBulksms('639176710089', 'This is just a test message.');
	insertMessage(1,'This is just a test message.',2,$response);

	// $var = "639157559924";
	// echo substr_replace($var, '0', 0, 2);
?>