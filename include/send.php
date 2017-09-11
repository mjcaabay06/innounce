<?php
	include("configurations.php");
	include("general_functions.php");

	// $response = sendViaBulksms('639176710089', 'This is just a test message.');
	
	// if( $response['success'] ) {
	// 	print_ln( formatted_server_response( $response ) );
	// 	//insertMessage(1,'This is just a test message.',2,$result);
	// }
	// else {
	// 	print_ln( formatted_server_response( $response ) );
	// }

	if (isset($_POST)) {
		$messageID = randomUniqueMsgID();
		$response = sendViaChikka($_POST['numbers'], 'This is just a test message coming from Chikka', $messageID);
		print_r($response);
	}
?>

<form action="" method="post">
	<input type="text" name="numbers">
	<button type="submit">Send</button>
</form>