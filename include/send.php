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
		// $code = createCode('e');
		// $egReply = '(Reply: ' . $code . '<space><your reply>)';
		// $response = sendViaChikka($_POST['numbers'], 'This is just a test message coming from Chikka' . $egReply, $messageID);
		//var_dump($response);
        $to = $_POST["mobile_number"];
        $request_cost = $_POST["request_cost"];
        $request_id = $_POST["request_id"];

		$response = $chikkaAPI->reply($request_id, $messageID, $to, $request_cost, 'Your reply has been received.');
		if ((int)$response->status == 200) {
			// error_log('>>>>>>>>>>e:' . $result->status);
			var_dump($response);
		} else {
			var_dump($response);
			//error_log('---------e: ' . $result->message);
		}
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
	<?php if (isset($_POST)): ?>
		<label>To: <?php echo $to; ?></label><br />
		<label>Cost: <?php echo $request_cost; ?></label><br />
		<label>Request Id: <?php echo $request_id; ?></label><br />
	<?php endif; ?>
	<input type="text" name="mobile_number" placeholder="Mobile Number" value="639957358261"><br />
	<input type="text" name="request_cost" placeholder="Request Cost"><br />
	<input type="text" name="request_id" placeholder="Request Id" value="5048303030474C4F4245303030303239323930303037303030303030303030303030303036333939353733353832363130303030313630393137323330393134"><br />
	<button type="submit">Send</button>
</form>