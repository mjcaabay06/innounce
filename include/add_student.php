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
				mobile_number
			)
			values(
				'".$params['first_name']."',
				'".$params['middle_name']."',
				'".$params['last_name']."',
				'".$params['email_address']."',
				'".$params['mobile_number']."'
			)
		";
		$rsInStud = mysqli_query($mysqli,$inStud);

		if ($rsInStud !== false) {
			$studentId = mysqli_insert_id($mysqli);
			
			$insertEnrolee = "
				insert into
				enrollees(
					student_id,
					school_year_id,
					school_course_id,
					school_section_id
				)
				values(
					".$studentId.",
					1,
					".$params['course'].",
					".$params['section']."
				)
			";
			$rsEnrollee = mysqli_query($mysqli, $insertEnrolee);
			if ($rsEnrollee !== false) {
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