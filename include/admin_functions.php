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
			case 'fetch-course':
				$data = array();
				$selCourse = 'select * from school_courses';
				$rsCourse = mysqli_query($mysqli, $selCourse);
				if ($rsCourse !== false){
					while ($course = mysqli_fetch_assoc($rsCourse)){
						array_push($data,$course);
					}
				}
				echo json_encode($data);
				break;
			case 'fetch-section':
				$data = array();
				$selSection = 'select * from school_fix_sections where school_course_id = ' . $_POST['courseId'];
				$rsSection = mysqli_query($mysqli, $selSection);
				if ($rsSection !== false){
					while ($section = mysqli_fetch_assoc($rsSection)){
						array_push($data,$section);
					}
				}
				echo json_encode($data);
				break;
			case 'fetch-school-level':
				$data = array();
				$selLevels = 'select * from school_levels';
				$rsLevels = mysqli_query($mysqli, $selLevels);
				if ($rsLevels !== false){
					while ($level = mysqli_fetch_assoc($rsLevels)){
						array_push($data,$level);
					}
				}
				echo json_encode($data);
				break;
			default:
				break;
		}
	}
?>