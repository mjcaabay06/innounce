<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$params = $_POST['params'];
		$data = array();

		$inStud = "
			insert into
			students(
				first_name,
				middle_name,
				last_name,
				email_address,
				mobile_number,
				course_id
			)
			values(
				'".$params['first_name']."',
				'".$params['middle_name']."',
				'".$params['last_name']."',
				'".$params['email_address']."',
				'".$params['mobile_number']."',
				".$params['course']."
			)
		";
		$rsInStud = mysqli_query($mysqli,$inStud);

		if ($rsInStud !== false) {
			$studentId = mysqli_insert_id($mysqli);
			
			$studentCode = $params['acronym'] . '-' . str_pad($studentId, 5, '0', STR_PAD_LEFT);
			$upStudent = "update students set student_code = '" . $studentCode . "' where id = " . $studentId;
			$rsUpStudent = mysqli_query($mysqli, $upStudent);
			if ($rsUpStudent !== false) {
				$data['status'] = 'success';
			} else {
				$data['status'] = 'error';
				$data['message'] = mysqli_error($mysqli);
			}
		} else {
			$data['status'] = 'error';
			$data['message'] = mysqli_error($mysqli);
		}

		echo json_encode($data);
	}