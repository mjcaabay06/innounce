<?php
	function checkLogin($username, $password){
		global $mysqli;	
		$isAuthenticated = false;

		$chkLogin = "select * from users where (username='" . $username . "' or email_address='" . $username . "') and password='" . $password . "' and status_id = 1";
		$rsLogin = mysqli_query($mysqli, $chkLogin);
		$row = mysqli_fetch_assoc($rsLogin);

		if (!empty($row)) {
			$insertLogs = "insert into login_logs(user_id,ip_address,remarks,status_id) values(" . $row['id'] . ",'" . getClientIp() . "','Successful', 1)";
			$rsLogs = mysqli_query($mysqli, $insertLogs);
			if ($rsLogs !== false) {
				if ($row['disable_login_failure'] == 0) {
					$upUsers = "update users set failed_login_attempt = 0 where id = " . $row['id'];
					$rsUpUsers = mysqli_query($mysqli, $upUsers);
				}
				
				// $_COOKIE['authId'] = $row['id'];
				// $_COOKIE['username'] = $row['username'];
				// $_COOKIE['userType'] = $row['user_type_id'];

				setcookie('authId',$row['id'],time() + (86400 * 30));
				setcookie('username',$row['username'],time() + (86400 * 30));
				setcookie('userType',$row['user_type_id'],time() + (86400 * 30));
			}
			$isAuthenticated = true;
		} else {
			$insertLogs = "insert into login_logs(ip_address,remarks,status_id) values('" . getClientIp() . "','Failed', 2)";
			$rsLogs = mysqli_query($mysqli, $insertLogs);
		}

		return $isAuthenticated;
	}

	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    $length = 10;
	    for ($i = 0; $i < $length; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	function randomActivationCode() {
	    $alphabet = '1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    $length = 6;
	    for ($i = 0; $i < $length; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	function sendViaSemaphore($mobile, $message){
		$parameters = array(
			'apikey' => '8850815abd71634b42f382b5a02ac7d6',
		    //'apikey' => 'b72b4e690594d982c5b56fe6ee4270ab',
		    'number' => $mobile,
		    'message' => $message,
		    'sendername' => 'SEMAPHORE'
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$output = curl_exec( $ch );
		curl_close ($ch);

		return json_decode($output);
	}

	function sendViaBulksms($mobile, $message) {
		require_once('bulksms.php');

		//$mobile = substr_replace($mobile, '63', 0, 1);
		$post_body = seven_bit_sms($message, $mobile);
		$result = send_message($post_body);
		// if( $result['success'] ) {
		// 	print_ln( formatted_server_response( $result ) );
		// }
		// else {
		// 	print_ln( formatted_server_response( $result ) );
		// }
		//return send_message($post_body);
		return $result;
	}

	function sendViaChikka($mobile, $message, $messageId) {
		require_once('Chikka/ChikkaSMS.php');

		$clientId = 'c315accbb28da59c05a6c0b4bc3248be5037c5ccc6cfed219a7507cfc2b01dc8';
		$secretKey = '56f51f5c4a81dc64ba3e0d5be7bb1087c0cb299c5659355f68d7b4910c42e179';
		$shortCode = '292907886';
		$chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
		$response = $chikkaAPI->sendText($messageId, $mobile, $message);

		return $response;
	}

	function receiveResponse($requestID, $messageID, $to) {
		require_once('Chikka/ChikkaSMS.php');

		$clientId = 'c315accbb28da59c05a6c0b4bc3248be5037c5ccc6cfed219a7507cfc2b01dc8';
		$secretKey = '56f51f5c4a81dc64ba3e0d5be7bb1087c0cb299c5659355f68d7b4910c42e179';
		$shortCode = '292907886';
		$chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
		$response = $chikkaAPI->reply($requestID, $messageID, $to, 'free', 'Your reply has been received.');

		return $response;
	}

	function randomUniqueMsgID() {
	    $alphabet = '1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    $length = 10;
	    for ($i = 0; $i < $length; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	function sendEmail() {
		$message = 'Someone trying to force a login. IP Address is <b>' . getClientIp() . '</b>';
		$adminEmail = 'doodledummy617@gmail.com';
		return phpMailer($adminEmail, "Brute-force Attack", $message);
	}

	function phpMailer($to, $subject, $message) {
		require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'doodledummy617@gmail.com';                 // SMTP username
		$mail->Password = 'Password123$';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('doodledummy617@gmail.com', 'iNnounce');
		$mail->addAddress($to);     // Add a recipient
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $message;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    //echo 'Message could not be sent.';
		    //echo 'Mailer Error: ' . $mail->ErrorInfo;
		    return false;
		} else {
		    //echo 'Message has been sent';
		    return true;
		}
	}

	function getClientIp() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';

	    //$ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	    // if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
	    //   $ip = $_SERVER['HTTP_CLIENT_IP'];
	    // } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
	    // 	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    // } else {
	    //   $ip = $_SERVER['REMOTE_ADDR'];
	    // }
	    // return $ip;
	}

	function insertActivation($userId, $activationCode) {
		global $mysqli;

		$insertActivation = "insert into account_activations(user_id, activation_key) values(".$userId.", '".$activationCode."')";
		$rsActivation = mysqli_query($mysqli, $insertActivation);

		if ($rsActivation !== false) {

		}
	}

	//echo phpMailer();

	function getStudentReceivers($year, $course) {
		global $mysqli;

		$selStud = "select students.id, students.first_name, students.last_name, students.mobile_number, school_sections.section from students inner join (enrollees inner join school_sections on enrollees.school_section_id = school_sections.id) on enrollees.student_id = students.id where enrollees.school_course_id = " . $course . " and school_sections.school_level_id = " . $year . " and trim(students.mobile_number) != ''";
		$rsStud = mysqli_query($mysqli, $selStud);

		$data = array();
		while($studNumber = mysqli_fetch_assoc($rsStud)) {
			$studData = array(
					'name' => '[' . $studNumber['last_name'] . ',' . $studNumber['first_name'] . '(' . $studNumber['section'] . ')]',
					'mobile_number' => $studNumber['mobile_number'],
					'student_id' => $studNumber['id']
					);
			array_push($data, $studData);
		}

		return $data;
	}

	function getStudentReceivers2($year, $course, $subject, $section) {
		global $mysqli;

		//$selStud = "select students.id, students.first_name, students.last_name, students.mobile_number, school_sections.section from students inner join (enrollees inner join school_sections on enrollees.school_section_id = school_sections.id) on enrollees.student_id = students.id where enrollees.school_course_id = " . $course . " and school_sections.school_level_id = " . $year . " and trim(students.mobile_number) != ''";
		$selStud = "select students.id, students.first_name, students.last_name, students.mobile_number, school_sections.section from students inner join (enrollees inner join school_sections on enrollees.school_section_id = school_sections.id inner join enrolled_subjects on enrolled_subjects.enrollee_id = enrollees.id) on enrollees.student_id = students.id where enrollees.school_course_id = " . $course . " and school_sections.school_level_id in (" . implode(',',$year) . ") and trim(students.mobile_number) != '' and enrollees.school_section_id in (" . implode(',',$section) . ")  and enrolled_subjects.subject_id in (" . implode(',',$subject) . ")";	
		$rsStud = mysqli_query($mysqli, $selStud);

		$data = array();
		while($studNumber = mysqli_fetch_assoc($rsStud)) {
			$studData = array(
					'name' => '[' . $studNumber['last_name'] . ',' . $studNumber['first_name'] . '(' . $studNumber['section'] . ')]',
					'mobile_number' => $studNumber['mobile_number'],
					'student_id' => $studNumber['id']
					);
			array_push($data, $studData);
		}

		return $data;
	}

	function getStudentViaSection($section) {
		global $mysqli;

		$selSection = "select students.id, students.first_name, students.last_name, students.mobile_number, school_sections.section from students inner join (enrollees inner join school_sections on school_sections.id = enrollees.school_section_id) on enrollees.student_id = students.id where students.id = " . $section . " and trim(students.mobile_number) != ''";
		$rsSection = mysqli_query($mysqli, $selSection);

		$data = array();
		while($studNumber = mysqli_fetch_assoc($rsSection)) {
			$studData = array(
					'name' => '[' . $studNumber['last_name'] . ',' . $studNumber['first_name'] . '(' . $studNumber['section'] . ')]',
					'mobile_number' => $studNumber['mobile_number'],
					'student_id' => $studNumber['id']
					);
			array_push($data, $studData);
		}

		return $data;
	}

	function getStudentViaDeparment($year, $depId) {
		global $mysqli;

		$selSection = "select students.id, students.first_name, students.last_name, students.mobile_number, school_sections.section from students inner join (enrollees inner join school_sections on school_sections.id = enrollees.school_section_id) on enrollees.student_id = students.id inner join (school_courses inner join departments on departments.id = school_courses.department_id) on school_courses.id = students.course_id where departments.id = " . $depId . " and school_sections.school_level_id = " . $year . " and trim(students.mobile_number) != ''";
		$rsSection = mysqli_query($mysqli, $selSection);

		$data = array();
		while($studNumber = mysqli_fetch_assoc($rsSection)) {
			$studData = array(
					'name' => '[' . $studNumber['last_name'] . ',' . $studNumber['first_name'] . '(' . $studNumber['section'] . ')]',
					'mobile_number' => $studNumber['mobile_number'],
					'student_id' => $studNumber['id']
					);
			array_push($data, $studData);
		}

		return $data;
	}

	function getProfReceivers($id) {
		global $mysqli;

		$selProf = "select user_infos.first_name, user_infos.last_name, user_infos.mobile_number from users inner join user_infos on users.id = user_infos.user_id where users.id = " . $id . " and trim(user_infos.mobile_number) != ''";
		$rsProf = mysqli_query($mysqli, $selProf);

		$data = array();
		while($profNumber = mysqli_fetch_assoc($rsProf)) {
			$profData = array(
					'name' => '[' . $profNumber['last_name'] . ',' . $profNumber['first_name'] . '(Prof)]',
					'mobile_number' => $profNumber['mobile_number']
					);
			array_push($data, $profData);
		}

		return $data;
	}

	function getAllReceivers() {
		global $mysqli;
		$data = array();

		//select students
		$selStud = "select students.id, students.first_name, students.last_name, students.mobile_number, school_sections.section from enrollees inner join students on students.id = enrollees.student_id inner join school_sections on school_sections.id = enrollees.school_section_id where trim(students.mobile_number) != ''";
		$rsStud = mysqli_query($mysqli, $selStud);
		while($studNumber = mysqli_fetch_assoc($rsStud)) {
			$studData = array(
					'name' => '[' . $studNumber['last_name'] . ',' . $studNumber['first_name'] . '(' . $studNumber['section'] . ')]',
					'mobile_number' => $studNumber['mobile_number'],
					'recipient_id' => 's:' . $studNumber['id']
					);
			array_push($data, $studData);
		}

		//select prof
		$selProf = "select users.id, user_infos.first_name, user_infos.last_name, user_infos.mobile_number from users inner join user_infos on users.id = user_infos.user_id where users.id != " . $_COOKIE['authId'] . " and users.status_id = 1 and trim(user_infos.mobile_number) != ''";
		$rsProf = mysqli_query($mysqli, $selProf);
		while($profNumber = mysqli_fetch_assoc($rsProf)) {
			$profData = array(
					'name' => '[' . $profNumber['last_name'] . ',' . $profNumber['first_name'] . '(Prof)]',
					'mobile_number' => $profNumber['mobile_number'],
					'recipient_id' => 'p:' . $profNumber['id']
					);
			array_push($data, $profData);
		}

		return $data;
	}

	function insertMessage($userId, $message, $typeId, $bacthId, $responseCode) {
		global $mysqli;

		$insertMessage = "
			insert into
			sent_messages(
				response_code,
				batch_id,
				message,
				user_id,
				message_type_id,
				remarks
			)
			values(
				'" . $responseCode . "',
				" . $bacthId . ",
				'" . $message . "',
				" . $userId . ",
				" . $typeId . ",
				'" . $response['success'] . "'
			)
			";
		$rsInsertMessage = mysqli_query($mysqli, $insertMessage);

		if ($rsInsertMessage !== false) {

		} else {
			error_log($response);
			error_log(mysqli_error($mysqli));
		}
	}

	function setDate($format, $date) {
		$date = new DateTime($date);
		$date->setTimezone(new DateTimeZone('Asia/Manila'));
		return $date->format($format);
	}

	function insertRecipient($recipient, $bacthId, $typeId){
		global $mysqli;

		$insert = "
			insert into
			message_recipients(
				batch_id,
				student_id,
				recipient,
				message_type_id
			)
			values(
				" . $bacthId . ",
				" . $recipient['id'] . ",
				'" . $recipient['number'] . "',
				" . $typeId . "
			)
			";
		$result = mysqli_query($mysqli, $insert);

		if ($result !== false) {

		} else {
			error_log(mysqli_error($mysqli));
		}
	}

	function createCode($char) {
		global $mysqli;
		$char = strtoupper($char);

		$getLast = "select auto_increment as id from information_schema.tables where table_name = 'sent_messages'";
		$rs = mysqli_query($mysqli, $getLast);
		$row = mysqli_fetch_assoc($rs);

		$code = $char . $row['id'];

		return $code;
	}

	function insertLogs($message){
		global $mysqli;

		$insLogs = "insert into logs(response) value('" . $message . "')";
	    $rsLogs = mysqli_query($mysqli, $insLogs);
	}

	#sendViaBulksms('639176710089', 'This is just a test message.');
?>