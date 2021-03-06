<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$errorSending = array();
		$data = array();
		$num = '';
		$response = '';
		$mobile = array();
		$aa = array();
		$messageID = randomUniqueMsgID();

		switch (strtolower($_POST['action'])) {
			case 'professor':
				$message = $_POST['message'];
				$students = $_POST['students'];
				foreach($students as $student) {
					foreach (getStudentViaSection($student) as $studNumber) {
						//$mobile[] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
						$aa['number'] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
						$aa['id'] = $studNumber['student_id'];
						//array_push($mobile, $aa);

						$response = sendViaChikka(substr_replace($studNumber['mobile_number'], '63', 0, 1), $message, $messageID);
						if ((int)$response->status == 200) {
							insertRecipient($aa,$messageID,4);
							unset($aa);
						} else {
							insertFailed($aa,$messageID,4);
							$errorSending[] = $studNumber['name'];
							error_log('---------' . $response->message);
						}
					}
				}

				if(empty($errorSending)){
					insertMessage($_COOKIE['authId'],$message,4, $messageID,'');
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

				// $imploded = implode(',', array_map(function($e){ return $e['number']; }, $mobile));
				// $response = sendViaBulksms($imploded, $message);
				// // $response['success'] = true;
				// // $response['api_batch_id'] = randomActivationCode();
				// if ($response['success']) {
				// 	insertMessage($_COOKIE['authId'],$message,4,$response);
				// 	foreach ($mobile as $recipient) {
				// 		insertRecipient($recipient,$response['api_batch_id'],4);
				// 	}
				// 	$data['message'] = "Announcement was sent successfully.";
				// 	$data['status'] = true;
				// } else {
				// 	$data['message'] = "There was an error sending the announcement. Please try again.";
				// 	$data['status'] = false;
				// }
				break;
			case 'chairman':
				$message = $_POST['message'];
				$years = $_POST['year'];
				$depId = $_POST['depId'];

				foreach($years as $year) {
					foreach (getStudentViaDeparment($year, $depId) as $studNumber) {
						//$mobile[] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
						$aa['number'] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
						$aa['id'] = $studNumber['student_id'];
						//array_push($mobile, $aa);

						$response = sendViaChikka(substr_replace($studNumber['mobile_number'], '63', 0, 1), $message, $messageID);
						if ((int)$response->status == 200) {
							insertRecipient($aa,$messageID,4);
							unset($aa);
						} else {
							insertFailed($aa,$messageID,4);
							$errorSending[] = $studNumber['name'];
							error_log('---------' . $response->message);
						}
					}
				}

				if(empty($errorSending)){
					insertMessage($_COOKIE['authId'],$message,4, $messageID,'');
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

				// $imploded = implode(',', array_map(function($e){ return $e['number']; }, $mobile));
				// $response = sendViaBulksms($imploded, $message);
				// // $response['success'] = true;
				// // $response['api_batch_id'] = randomActivationCode();
				// if ($response['success']) {
				// 	insertMessage($_COOKIE['authId'],$message,4,$response);
				// 	foreach ($mobile as $recipient) {
				// 		insertRecipient($recipient,$response['api_batch_id'],4);
				// 	}
				// 	$data['message'] = "Announcement was sent successfully.";
				// 	$data['status'] = true;
				// } else {
				// 	$data['message'] = "There was an error sending the announcement. Please try again.";
				// 	$data['status'] = false;
				// }
				break;
			case 'dean':
				$message = $_POST['message'];
				$years = $_POST['year'];
				$course = $_POST['course'];

				foreach($years as $year) {
					foreach (getStudentReceivers($year, $course) as $studNumber) {
						//$mobile[] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
						$aa['number'] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
						$aa['id'] = $studNumber['student_id'];
						//array_push($mobile, $aa);

						$response = sendViaChikka(substr_replace($studNumber['mobile_number'], '63', 0, 1), $message, $messageID);
						if ((int)$response->status == 200) {
							insertRecipient($aa,$messageID,4);
							unset($aa);
						} else {
							insertFailed($aa,$messageID,4);
							$errorSending[] = $studNumber['name'];
							error_log('---------' . $response->message);
						}
					}
				}

				if(empty($errorSending)){
					insertMessage($_COOKIE['authId'],$message,4, $messageID,'');
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

				// $imploded = implode(',', array_map(function($e){ return $e['number']; }, $mobile));
				// $response = sendViaBulksms($imploded, $message);
				// // $response['success'] = true;
				// // $response['api_batch_id'] = randomActivationCode();
				// if ($response['success']) {
				// 	insertMessage($_COOKIE['authId'],$message,4,$response);
				// 	foreach ($mobile as $recipient) {
				// 		insertRecipient($recipient,$response['api_batch_id'],4);
				// 	}
				// 	$data['message'] = "Announcement was sent successfully.";
				// 	$data['status'] = true;
				// } else {
				// 	$data['message'] = "There was an error sending the announcement. Please try again.";
				// 	$data['status'] = false;
				// }
				break;
			default:
				# code...
				break;
		}
		
		

		

		echo json_encode($data);
	}