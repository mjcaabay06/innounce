<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		switch(strtolower($_POST['action'])){
			case 'check-email':
				$data = array();
				$data['status'] = false;
				$selEmail = "select * from users where email_address = '" . $_POST['email'] . "' and status_id = 1";
				$rsEmail =  mysqli_query($mysqli, $selEmail);

				if (mysqli_num_rows($rsEmail) > 0) {
					$data['status'] = true;
				}

				echo json_encode($data);
				break;
			case 'check-username':
				$data = array();
				$data['status'] = false;
				$selUsername = "select * from users where username = '" . $_POST['username'] . "' and status_id = 1";
				$rsUsername =  mysqli_query($mysqli, $selUsername);

				if (mysqli_num_rows($rsUsername) > 0) {
					$data['status'] = true;
				}

				echo json_encode($data);
				break;
			default:
				break;
		}
	}
?>