<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$message = $_POST['message'];
		$errorSending = array();
		$data = array();
		$num = '';

		foreach(getAllReceivers() as $rcvr) {
			$response = sendViaSemaphore($rcvr['mobile_number'], $message);

			if(empty($response) || !isset($response[0]->status)){
				$errorSending[] = $rcvr['name'];
			}
		}

		saveEmergency($message);

		if(empty($errorSending)){
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