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
		foreach(getAllReceivers() as $rcvr) {
			$response = sendViaBulksms($rcvr['mobile_number'], $message);

			// if(empty($response) || !isset($response[0]->status)){
			// 	$errorSending[] = $rcvr['name'];
			// }
			if (!$response['success']) {
				$errorSending[] = $rcvr['name'];
			} else {
				storeRecipient($response['api_batch_id'],$rcvr['mobile_number']);
			}
		}

		#saveEmergency($message);

		if(empty($errorSending)){
			insertMessage($_SESSION['authId'],$message,3,$response);
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

		$insert = "insert into emergency_recipients(batch_id,recipient) values(" . $batchId . ",'" . $recipient . "')";
		$rs = mysqli_query($mysqli, $insert);
	}