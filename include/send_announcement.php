<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$message = $_POST['message'];
		$errorSending = array();
		$data = array();
		$num = '';

		if (!empty($_POST['students'])) {
			foreach($_POST['students'] as $student) {
				foreach(getStudentReceivers($student) as $studNumber) {
					$response = sendViaSemaphore($studNumber['mobile_number'], $message);

					if(empty($response) || !isset($response[0]->status)){
						$errorSending[] = $studNumber['name'];
					}
				}
			}
		}
		if (!empty($_POST['prof'])) {
			foreach($_POST['prof'] as $prof) {
				foreach(getProfReceivers($prof) as $profNumber) {
					$response = sendViaSemaphore($profNumber['mobile_number'], $message);
					if(empty($response) || !isset($response[0]->status)){
						$errorSending[] = $profNumber['name'];
					}
					
				}
			}
		}

		if(empty($errorSending)){
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