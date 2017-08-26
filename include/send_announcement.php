<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$message = $_POST['message'];
		$course = $_POST['course'];

		$errorSending = array();
		$data = array();
		$num = '';

		$hasLvl = array();
		$hasWordLvl = array();
		$noLvl = array();
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
			$response = "";
			foreach ($hasLvl as $year) {
				foreach (getStudentReceivers($year,$course) as $studNumber) {
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
				insertMessage($_SESSION['authId'],$message,1,$response);
				$data['message'] = "Announcement was sent to: [" . implode(', ', $hasWordLvl) . "]";
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
				$data['message'] = "There was an error sending announcement to the following:<br/>".$name;
				$data['status'] = "failed";
			}
		}

		// foreach ($_POST['year'] as $year) {
		// 	$selLevel = "select * from enrollees inner join school_sections on school_sections.id = enrollees.school_section_id where school_level_id = " . $year;
		// 	$rsLevel = mysqli_query($mysqli, $selLevel);
		// 	$lvlCount = mysqli_num_rows($rsLevel);

		// 	if ($lvlCount > 0) {
		// 		foreach (getStudentReceivers($year,$course) as $studNumber) {
		// 			$response = sendViaSemaphore($studNumber['mobile_number'], $message);

		// 			if(empty($response) || !isset($response[0]->status)){
		// 				$errorSending[] = $studNumber['name'];
		// 			}
		// 		}
		// 	} else {
		// 		array_push($noLvl, $year);
		// 	}
		// }

		// if(empty($errorSending)){
		// 	insertMessage($_SESSION['authId'],$message,1);
		// 	$data['message'] = "Announcement was sent to all recipients.";
		// 	$data['status'] = true;

		// 	if (isset($noLvl)) {
		// 		$yrlvl = '';
		// 		foreach ($noLvl as $lvl) {
		// 			$yrlvl .= $lvl . ', ';
		// 		}
		// 		$data['message'] .= "<br/>No enrollee for the year level: " . implode(', ', $noLvl);
		// 	}
		// }else{
		// 	$name = '';
		// 	foreach($errorSending as $errorName){
		// 		$name .= $errorName.", ";
		// 	}
		// 	$data['message'] = "There was an error sending announcement to the following:<br/>".$name;
		// 	$data['status'] = false;
		// }
		

		echo json_encode($data);
	}

	function fetchLevel($id){
		global $mysqli;

		$selLvl = "select * from school_levels where id = " . $id;
		$rsLvl = mysqli_query($mysqli, $selLvl);
		$lvl = mysqli_fetch_assoc($rsLvl);
		return $lvl['description'];
	}