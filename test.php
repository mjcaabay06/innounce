<?php
	include("include/general_functions.php");

	$response = sendViaChikka('639176710089', 'This is just a test message of coming from Chikka');
	print_r($response);
 ?>