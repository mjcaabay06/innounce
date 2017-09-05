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
		foreach(getAllReceivers() as $rcvr) {
			$mobile[] = substr_replace($rcvr['mobile_number'], '63', 0, 1);
		}

		$response = sendViaBulksms(implode(',', $mobile), $message);
		if (!$response['success']) {
			$data['message'] = "There was an error sending the emergency. Please try again.";
			$data['status'] = false;
		} else {
			insertMessage($_COOKIE['authId'],$message,3,$response);
			foreach ($mobile as $recipient) {
				storeRecipient($response['api_batch_id'],$recipient);
			}
			$data['message'] = "Emergency was sent successfully.";
			$data['status'] = "success";
		}

		#saveEmergency($message);

		// if(empty($errorSending)){
		// 	insertMessage($_COOKIE['authId'],$message,3,$response);
		// 	$data['message'] = "Emergency message was sent to all recipients.";
		// 	$data['status'] = true;
		// }else{
		// 	$name = '';
		// 	foreach($errorSending as $errorName){
		// 		$name .= $errorName.", ";
		// 	}
		// 	$data['message'] = "There was an error sending emergency to the following:<br/>".$name;
		// 	$data['status'] = false;
		// }

		echo json_encode($data);
	}

	function saveEmergency($message) {
		global $mysqli;

		$insert = "insert into emergencies(message) values('" . $message . "')";
		$rsInsert = mysqli_query($mysqli, $insert);
	}

	function storeRecipient($batchId, $recipient){
		global $mysqli;

		$insert = "insert into emergency_recipients(batch_id,recipient) values(" . $batchId . ",'" . $recipient . "')";
		$rs = mysqli_query($mysqli, $insert);
	}