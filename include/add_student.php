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
				year_section_id
			)
			values(
				'".$params['first_name']."',
				'".$params['middle_name']."',
				'".$params['last_name']."',
				'".$params['email_address']."',
				'".$params['mobile_number']."',
				".$params['section']."
			)
		";
		$rsInStud = mysqli_query($mysqli,$inStud);

		if ($rsInStud !== false) {
			$data['status'] = 'success';
		} else {
			$data['status'] = 'error';
			$data['message'] = mysqli_error($mysqli);
		}

		echo json_encode($data);
	}