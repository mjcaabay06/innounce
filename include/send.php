<?php
	//include("configurations.php");
	include("general_functions.php");

	// $response = sendViaBulksms('639176710089', 'This is just a test message.');
	
	// if( $response['success'] ) {
	// 	print_ln( formatted_server_response( $response ) );
	// 	//insertMessage(1,'This is just a test message.',2,$result);
	// }
	// else {
	// 	print_ln( formatted_server_response( $response ) );
	// }
	
	include('Chikka/ChikkaSMS.php');
	$clientId = 'c315accbb28da59c05a6c0b4bc3248be5037c5ccc6cfed219a7507cfc2b01dc8';
	$secretKey = '56f51f5c4a81dc64ba3e0d5be7bb1087c0cb299c5659355f68d7b4910c42e179';
	$shortCode = '292907886';
	$chikkaAPI = new ChikkaSMS($clientId, $secretKey, $shortCode);

	if (isset($_POST)) {
		$messageID = randomUniqueMsgID();
		$response = sendViaChikka($_POST['numbers'], 'This is just a test message coming from Chikka \n\n Reply E1<space><your reply>', $messageID);
		//var_dump($response);
	}
	

	// if ($_POST) {
	// 	if ($chikkaAPI->receiveNotifications() === null) {
	//             header("HTTP/1.1 400 Error");
	//             echo "Message has not been processed.";
	//         }
	//     else{
	//         echo "Message has been successfully processed.";
	//         error_log("----meron");
	//     }
	//     var_dump($chikkaAPI->receiveNotifications());
	// }
?>

<form action="" method="post">
	<input type="text" name="numbers">
	<button type="submit">Send</button>
	<a href="test.php?aa=<?php echo "'This is just a test message'"; ?>" target="_blank">Click</a>
</form>