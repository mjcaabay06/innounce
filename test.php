<?php
	include("include/general_functions.php");

	$response = sendViaChikka('09176710089', 'This is just a test message of coming from Chikka');
	var_dump($response);
 ?>