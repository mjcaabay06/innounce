<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if($_POST){
		$activationCode = randomActivationCode();
		
		switch(strtolower($_POST['action'])){
			case 'activation-sendemail':
				$userId = $_POST['userId'];
				$message = 'Your activation code is ' . $activationCode . '. And your Password: ' . $_POST['userpass'];
				$email = trim($_POST['email']);

				if(phpMailer($email, "Activation Code", $message)){
					echo "Activation code was sent to your email address.</div>";
					insertActivation($userId, $activationCode);
				} else {
					echo "Activation code not sent!</div>";
				}
				
				break;
			case 'activate':
				$userId = $_POST['userId'];
				$activationCode = $_POST["code"];

				$checkActivation = "select * from account_activations where user_id = " . $userId . " and activation_key = '" . $activationCode . "'";
				$rsActivation = mysqli_query($mysqli, $checkActivation);
				$cntActivation = mysqli_num_rows($rsActivation);

				if ($cntActivation > 0) {
					$updateUser = "update users set status_id = 1 where id = " . $userId . " and status_id = 2";
					$rsUpUser = mysqli_query($mysqli, $updateUser);

					$deleteActivation = "delete from account_activations where user_id = " . $userId . " and activation_key = '" . $activationCode . "'";
					$rsDelUser = mysqli_query($mysqli, $deleteActivation);

					echo "Account activated.";
				} else {
					echo "Please enter your activation code again.";
				}
				break;
			case 'recoverpass-email':
				$data = array();

				$email = $_POST['email'];
				$question = $_POST['secretQuestion'];
				$answer = $_POST['answer'];
				$errorSending = array();
				$diffError = '';
				$error = true;
				$message = '';

				$selUser = "select * from users where secret_question_id = " . $question . " and answer='" . $answer . "'";
				$rsUser = mysqli_query($mysqli, $selUser);
				$row = mysqli_fetch_assoc($rsUser);

				if (isset($row)) {
					$message = 'Your password is ' . $row['password'] . '.';
					$data['status'] = true;
				} else {
					$message = 'Please review your Email Address and Mobile Number. These must be the correct data that you entered during your registratioin.';
					$data['status'] = false;
				}

				if ($data['status']) {
					if(phpMailer($email, "Recovered Password", $message)){
						//echo "<div style='text-align:center;'><h1>Recover password sent!</h1></div>";
						$data['message'] = "Recover password sent!";
						$data['status'] = true;
					} else {
						//echo "<div style='text-align:center;'><h1>Recover password not sent!</h1></div>";
						$data['message'] = "Recover password not sent. Please try to check your internet connection.";
						$data['status'] = false;
					}
				} else {
					//echo "<div style='text-align:center;'>" . $message . "</div>";
					$data['message'] = $message;
				}

				echo json_encode($data);
				break;
			default:
				break;
		}
	}else{
		echo "You are not allowed to access this page.";
	}
?>