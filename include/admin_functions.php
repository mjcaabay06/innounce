<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		switch(strtolower($_POST['action'])){
			case 'change-password':
				$userId = $_POST['userId'];
				$password = $_POST['pwd'];

				$updateUser = "update users set password='" . $password . "', password_expiry_date=DATE(NOW() + INTERVAL 30 DAY), password_type_id=2 where id = " . $userId;
				$rsUser = mysqli_query($mysqli, $updateUser);

				if ($rsUser !== false) {
					echo 'Password successfully changed.';
				}

				break;
			case 'send-unlock':
				$email = $_POST['email'];
				$message = 'Please unlock my account. This is my Email Address: ' . $email;
				$adminEmail = 'dummyaccnt123@yahoo.com';
				
				// if (mail($adminEmail, "Unlock Account", $message)) {
				// 	echo '<div class="alert alert-success">Email has been sent to the administrator.</div>';
				// }

				if (phpMailer($adminEmail, "Unlock Account", $message)) {
					echo '<div class="alert alert-success">Email has been sent to the administrator.</div>';
				}
				break;
			case 'disable-login':
				$userId = $_POST['userId'];
				$val = $_POST['val'];

				$upUser = "update users set disable_login_failure=" . $val . " where id = " . $userId;
				$rsUser = mysqli_query($mysqli, $upUser);
				if ($rsUser !== false) {
					echo '<div class="alert alert-success">Changes done.</div>';
				}
				break;
			default:
				break;
		}
	}
?>