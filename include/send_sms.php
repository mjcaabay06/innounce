<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if($_POST){
		$activationCode = randomActivationCode();
		
		switch(strtolower($_POST['action'])){
			case 'activation-sendsms':
				$userId = $_POST['userId'];
				$errorSending = array();
				$diffError = '';

				$message = 'Your activation code is ' . $activationCode . '. And your Password: ' . $_POST['userpass'];

				$response = sendViaBulksms(trim($_POST['mobile']), $message);

				// if(empty($response) || !isset($response[0]->status)){
				// 	if(isset($response[0])){ //different error
				// 		$diffError = $response[0];
				// 	}
				// 	$errorSending = $_POST['mobile'];
				// }

				if (!$response['success']) {
					$errorSending = $_POST['mobile'];
				}
				
				if(empty($errorSending)){
					echo "Activation code was sent to your mobile number.";
					insertActivation($userId, $activationCode);
				}else{
					echo "There was an error sending text message to:".$errorSending;
					if($diffError != ''){
						echo "Reason:".$diffError;
					}	
				}

				break;
			case 'recoverpass-sms':
				$data = array();
				$email = $_POST['email'];
				$mobile = $_POST['mobile'];
				$errorSending = array();
				$diffError = '';
				$error = false;
				$message = '';

				$selUser = "select * from users inner join user_infos on users.id = user_infos.user_id where users.email_address='".$email."' and user_infos.mobile_number='".$mobile."'";
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

					$response = sendViaBulksms($row['mobile_number'], $message);

					// if(empty($response) || !isset($response[0]->status)){
					// 	if(isset($response[0])){ //different error
					// 		$diffError = $response[0];
					// 	}
					// 	$errorSending = $row['mobile_number'];
					// }

					if (!$response['success']) {
						$errorSending = $row['mobile_number'];
					}

					if(empty($errorSending)){
						$data['message'] = "Message Sent!";
						$data['status'] = true;
					}else{
						$data['message'] = "Message not sent. Please try to check your internet connection.";
						$data['sms-error'] = "There was an error sending text message to: " . $errorSending;
						if($diffError != ''){
							$data['sms-error'] += "Reason: " .$diffError;
						}
						$data['status'] = false;
					}
				} else {
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