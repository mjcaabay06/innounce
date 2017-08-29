<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$errorSending = array();
		$data = array();
		$num = '';
		$response = '';

		switch (strtolower($_POST['action'])) {
			case 'professor':
				$message = $_POST['message'];
				$students = $_POST['students'];
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
					insertMessage($_SESSION['authId'],$message,4,$response);
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
				break;
			case 'chairman':
				$message = $_POST['message'];
				$year = $_POST['year'];
				$depId = $_POST['depId'];

				foreach (getStudentViaDeparment($year, $depId) as $studNumber) {
					$response = sendViaBulksms($studNumber['mobile_number'], $message);

					// if(empty($response) || !isset($response[0]->status)){
					// 	$errorSending[] = $studNumber['name'];
					// }
					if (!$response['success']) {
						$errorSending[] = $studNumber['name'];
					}
				}

				if(empty($errorSending)){
					insertMessage($_SESSION['authId'],$message,4,$response);
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
				break;
			case 'dean':
				$message = $_POST['message'];
				$year = $_POST['year'];
				$course = $_POST['course'];

				foreach (getStudentReceivers($year, $course) as $studNumber) {
					$response = sendViaBulksms($studNumber['mobile_number'], $message);

					// if(empty($response) || !isset($response[0]->status)){
					// 	$errorSending[] = $studNumber['name'];
					// }
					if (!$response['success']) {
						$errorSending[] = $studNumber['name'];
					}
				}

				if(empty($errorSending)){
					insertMessage($_SESSION['authId'],$message,4,$response);
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
				break;
			default:
				# code...
				break;
		}
		
		

		

		echo json_encode($data);
	}