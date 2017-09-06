<?php
	include("configurations.php");
	include("general_functions.php");

	// $result = sendViaBulksms('639176710089, 639053179446', 'This is just a test message.');
	

	// // $var = "639157559924";
	// // echo substr_replace($var, '0', 0, 2);

	// if( $result['success'] ) {
	// 	print_ln( formatted_server_response( $result ) );
	// 	//insertMessage(1,'This is just a test message.',2,$result);
	// }
	// else {
	// 	print_ln( formatted_server_response( $result ) );
	// }
	// return send_message($post_body);

	$hasYear = [1,2,3,4];
	$course = 1;
	$mobile = array();
	$aa = array();

	foreach ($hasYear as $year) {
		foreach (getStudentReceivers($year,$course) as $studNumber) {
			$aa['number'] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
			$aa['id'] = $studNumber['student_id'];
			array_push($mobile, $aa);
		}
	}

	foreach ($mobile as $recipient) {
		echo $recipient['id'] . '<br/>';
	}
?>