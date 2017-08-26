<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$message = $_POST['message'];
		#$sections = $_POST['sections'];
		$students = $_POST['students'];
		$errorSending = array();
		$data = array();
		$num = '';

		foreach($students as $student) {
			foreach (getStudentViaSection($student) as $studNumber) {
				$response = sendViaBulksms($studNumber['mobile_number'], $message);

				// if(empty($response) || !isset($response[0]->status)){
				// 	$errorSending[] = $studNumber['name'];
				// }
				if (!$response['success']) {
					$errorSending[] = $studNumber['name'];
				}
			}
		}

		if(empty($errorSending)){
			insertMessage($_SESSION['authId'],$message,4);
			$data['message'] = "Announcement was sent to all recipients.";
			$data['status'] = true;
		}else{
			$name = '';
			foreach($errorSending as $errorName){
				$name .= $errorName.", ";
			}
			$data['message'] = "There was an error sending announcement to the following:<br/>".$name;
			$data['status'] = false;
		}

		echo json_encode($data);
	}