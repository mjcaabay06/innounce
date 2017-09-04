<?php
	include("configurations.php");
	include("general_functions.php");

	$result = sendViaBulksms('09176710089', 'This is just a test message.');
	

	// $var = "639157559924";
	// echo substr_replace($var, '0', 0, 2);

	if( $result['success'] ) {
		print_ln( formatted_server_response( $result ) );
		insertMessage(1,'This is just a test message.',2,$result);
	}
	else {
		print_ln( formatted_server_response( $result ) );
	}
	return send_message($post_body);
?>