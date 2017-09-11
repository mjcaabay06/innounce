<?php
	include("include/general_functions.php");

	$response = sendViaChikka('639176710089,639053179446', 'This is just a test message coming from Chikka');
	print_r($response);
 ?>