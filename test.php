<?php
	// include("include/configurations.php");
	include("include/general_functions.php");

	// $response = sendViaChikka('639176710089', 'This is just a test message coming from Chikka');
	// print_r($response);
	// echo '<br/>';
	// if ((int)$response->status == 200) {
	// 	echo 'success';
	// } else {
	// 	echo 'failed';
	// }
	// $message = "E1 yes";
	// $response = explode(' ', $message);
	// echo $response[1];

	// $getLast = "select max(id) as id from sent_messages";
	// $rs = mysqli_query($mysqli, $getLast);
	// $row = mysqli_fetch_assoc($rs);
	// echo $row['id'];

	$requestCost = array(
        'free' => 'FREE', 
        '1' =>1, 
        '2.5'=> 2.5, 
        '5'=> 5, 
        '10' => 10, 
        '15' => 15
        );

	echo $requestCost['free'];
 ?>