<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$id = $_POST['studentId'];
		$data = $_POST['params'];
		$out = array();

		$upStud = "
			update students
			set
				first_name = '".$data['first_name']."',
				middle_name = '".$data['middle_name']."',
				last_name = '".$data['last_name']."',
				email_address = '".$data['email_address']."',
				mobile_number = '".$data['mobile_number']."',
				year_section_id = ".$data['section'].",
				updated_at = NOW()
			where
				id = ".$id."
		";
		$rsUpStud = mysqli_query($mysqli, $upStud);
		if ($rsUpStud !== false) {
			$out['status'] = 'success';
		} else {
			$out['status'] = 'error';
			$out['message'] = mysqli_error($mysqli);
		}

		// $upUser = "update users set email_address='".$data['email_address']."', user_type_id=".$data['user_type'].", status_id=".$data['status']." where id = " . $id;
		// $rsUpUser = mysqli_query($mysqli, $upUser);

		// if ($rsUpUser !== false) {
		// 	$upUserInfo = "update user_infos set first_name='".$data['first_name']."', middle_name='".$data['middle_name']."', last_name='".$data['last_name']."', mobile_number='".$data['mobile_number']."' where user_id = ".$id;
		// 	$rsUpUserInfo = mysqli_query($mysqli, $upUserInfo);

		// 	if ($rsUpUserInfo !== false) {
		// 		$out['status'] = 'success';
		// 	} else {
		// 		$out['status'] = 'error';
		// 		$out['message'] = mysqli_error($mysqli);
		// 	}
		// } else {
		// 	$out['status'] = 'error';
		// 	$out['message'] = mysqli_error($mysqli);
		// }

		echo json_encode($out);
	}