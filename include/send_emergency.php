<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$message = $_POST['message'];
		$errorSending = array();
		$data = array();
		$num = '';
		$response = '';

		$mobile = array();
		$aa = array();
		$messageID = randomUniqueMsgID();
		$code = createCode('e');
		$egReply = $message . '(Reply: ' . $code . '<space><your reply>)';
		//$message = $message . $egReply;

		foreach(getAllReceivers() as $rcvr) {
			$aa['number'] = substr_replace($rcvr['mobile_number'], '63', 0, 1);
			$aa['id'] = $rcvr['recipient_id'];
			//array_push($mobile, $aa);

			$response = sendViaChikka(substr_replace($rcvr['mobile_number'], '63', 0, 1), $egReply, $messageID);
			if ((int)$response->status == 200) {
				storeRecipient($messageID,$aa);
				error_log('>>>>>>>>>>e:' . $response->status);
			} else {
				$errorSending[] = $rcvr['name'];
				error_log('---------e:' . $response->description);

			}
			unset($aa);
			unset($response);
		}

		// $imploded = implode(',', array_map(function($e){ return $e['number']; }, $mobile));
		// $response = sendViaBulksms($imploded, $message);
		// // $response['success'] = true;
		// // $response['api_batch_id'] = randomActivationCode();
		// if (!$response['success']) {
		// 	$data['message'] = "There was an error sending the emergency. Please try again.";
		// 	$data['status'] = false;
		// } else {
		// 	insertMessage($_COOKIE['authId'],$message,3,$response);
		// 	foreach ($mobile as $recipient) {
		// 		storeRecipient($response['api_batch_id'],$recipient);
		// 	}
		// 	$data['message'] = "Emergency was sent successfully.";
		// 	$data['status'] = "success";
		// }

		#saveEmergency($message);

		if(empty($errorSending)){
			insertMessage($_COOKIE['authId'],$message,3,$messageID,$code);
			$data['message'] = "Emergency message was sent to all recipients.";
			$data['status'] = true;
		}else{
			$name = '';
			foreach($errorSending as $errorName){
				$name .= $errorName.", ";
			}
			$data['message'] = "There was an error sending emergency to the following:<br/>".$name;
			$data['status'] = false;
		}

		echo json_encode($data);
	}

	function saveEmergency($message) {
		global $mysqli;

		$insert = "insert into emergencies(message) values('" . $message . "')";
		$rsInsert = mysqli_query($mysqli, $insert);
	}

	function storeRecipient($batchId, $recipient){
		global $mysqli;

		$insert = "insert into emergency_recipients(batch_id,recipient_id,recipient) values(" . $batchId . ",'" . $recipient['id'] . "','" . $recipient['number'] . "')";
		$rs = mysqli_query($mysqli, $insert);
	}