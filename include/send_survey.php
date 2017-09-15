<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$message = $_POST['message'];
		$course = $_POST['course'];
		$messageID = randomUniqueMsgID();
		$code = createCode('s');
		$egReply = $message . '(Reply: ' . $code . '<space><your reply>)';
		//$message = $message . $egReply;

		$errorSending = array();
		$data = array();
		$num = '';
		$hasLvl = array();
		$hasWordLvl = array();
		$noLvl = array();
		$response = '';
		$mobile = array();
		$aa = array();

		foreach ($_POST['year'] as $year) {
			$selLevel = "select * from enrollees inner join school_sections on school_sections.id = enrollees.school_section_id where school_level_id = " . $year;
			$rsLevel = mysqli_query($mysqli, $selLevel);
			$lvlCount = mysqli_num_rows($rsLevel);

			if ($lvlCount > 0) {
				$hasLvl[] = $year;
				$hasWordLvl[] = fetchLevel($year);
			} else {
				$noLvl[] = fetchLevel($year);
			}
		}

		if (empty($hasLvl)) {
			$yrlvl = '';
			foreach ($noLvl as $lvl) {
				$yrlvl .= $lvl . ', ';
			}
			$data['message'] = "No enrollee for the year level: [" . implode(', ', $noLvl) . "]";
			$data['status'] = "failed";
		} else {
			foreach ($hasLvl as $year) {
				foreach (getStudentReceivers($year,$course) as $studNumber) {
					//$mobile[] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
					$aa['number'] = substr_replace($studNumber['mobile_number'], '63', 0, 1);
					$aa['id'] = $studNumber['student_id'];
					//array_push($mobile, $aa);

					$response = sendViaChikka(substr_replace($studNumber['mobile_number'], '63', 0, 1), $egReply, $messageID);
					if ((int)$response->status == 200) {
						insertRecipient($aa,$messageID,2);
						unset($aa);
						unset($response);
						error_log('>>>>>>>>>>s:'.$response->status);
					} else {
						$errorSending[] = $studNumber['name'];
						error_log('---------s:' . $response->message);
					}
				}
			}

			// $imploded = implode(',', array_map(function($e){ return $e['number']; }, $mobile));
			// $response = sendViaBulksms($imploded, $message);
			// // $response['success'] = true;
			// // $response['api_batch_id'] = randomActivationCode();
			// if ($response['success']) {
			// 	insertMessage($_COOKIE['authId'],$message,2,$response);
			// 	foreach ($mobile as $recipient) {
			// 		insertRecipient($recipient,$response['api_batch_id'],2);
			// 	}
			// 	$data['message'] = "Survey was sent successfully.";
			// 	$data['status'] = "success";
			// } else {
			// 	$data['message'] = "There was an error sending the survey. Please try again.";
			// 	$data['status'] = "failed";
			// }

			if(empty($errorSending)){
				insertMessage($_COOKIE['authId'],$message,2,$messageID,$code);
				$data['message'] = "Survey was sent to: [" . implode(', ', $hasWordLvl) . "]";
				$data['status'] = "success";

				if (isset($noLvl)) {
					$yrlvl = '';
					foreach ($noLvl as $lvl) {
						$yrlvl .= $lvl . ', ';
					}
					$data['message'] .= "<br/>No enrollee for the year level: [" . implode(', ', $noLvl) . "]";
				}
			}else{
				$name = '';
				foreach($errorSending as $errorName){
					$name .= $errorName.", ";
				}
				$data['message'] = "There was an error sending survey to the following:<br/>".$name;
				$data['status'] = "failed";
			}
		}

		// foreach ($_POST['year'] as $year) {
		// 	foreach (getStudentReceivers($year,$course) as $studNumber) {
		// 		$response = sendViaSemaphore($studNumber['mobile_number'], $message);

		// 		if(empty($response) || !isset($response[0]->status)){
		// 			$errorSending[] = $studNumber['name'];
		// 		}
		// 	}
		// }


		// if(empty($errorSending)){
		// 	insertMessage($_COOKIE['authId'],$message,2);
		// 	$data['message'] = "Survey was sent to all recipients.";
		// 	$data['status'] = true;
		// }else{
		// 	$name = '';
		// 	foreach($errorSending as $errorName){
		// 		$name .= $errorName.", ";
		// 	}
		// 	$data['message'] = "There was an error sending survey to the following:<br/>".$name;
		// 	$data['status'] = false;
		// }

		echo json_encode($data);
	}

	function saveSurvey($message) {
		global $mysqli;

		$insert = "insert into surveys(content) values('" . $message . "')";
		$rsInsert = mysqli_query($mysqli, $insert);
	}

	function fetchLevel($id){
		global $mysqli;

		$selLvl = "select * from school_levels where id = " . $id;
		$rsLvl = mysqli_query($mysqli, $selLvl);
		$lvl = mysqli_fetch_assoc($rsLvl);
		return $lvl['description'];
	}