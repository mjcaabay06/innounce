<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$params = $_POST['params'];
		$data = array();
		$password = randomPassword();

		$insertUser = "
			insert into
			users(
				email_address,
				username,
				password,
				user_type_id,
				status_id,
				password_type_id,
				password_expiry_date,
				ip_address,
				failed_login_attempt,
				disable_login_failure
			)
			values(
				'".$params['email_address']."',
				'".$params['username']."',
				'".$password."',
				".$params['user_type'].",
				1,
				1,
				(NOW() + INTERVAL 30 DAY),
				'".getClientIp()."',
				0,
				0
			)
		";
		$rsInsertUser = mysqli_query($mysqli,$insertUser);

		if ($rsInsertUser !== false) {
			$userId = mysqli_insert_id($mysqli);

			$insertUserInfo = "
				insert into
				user_infos(
					user_id,
					first_name,
					middle_name,
					last_name,
					mobile_number
				)
				values(
					".$userId.",
					'".$params['first_name']."',
					'".$params['middle_name']."',
					'".$params['last_name']."',
					'".$params['mobile_number']."'
				)
			";
			$rsInsertUserInfo = mysqli_query($mysqli, $insertUserInfo);
			if ($rsInsertUserInfo !== false) {
				$data['status'] = 'success';
				$message = 'Your generated password is: ' . $password;
				phpMailer($params['email_address'],"Password Generated", $message);
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