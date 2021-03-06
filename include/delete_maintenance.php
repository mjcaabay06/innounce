<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$data = $_POST['params'];
		$out = array();

		switch (strtolower($_POST['action'])) {
			case 'year-level':
				$delLevel = "delete from school_levels where id = " . $data['id'];
				$rsLevel = mysqli_query($mysqli, $delLevel);
				if ($rsLevel !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'department':
				$del = "delete from departments where id = " . $data['id'];
				$rs = mysqli_query($mysqli, $del);
				if ($rs !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'course':
				$del = "delete from school_courses where id = " . $data['id'];
				$rs = mysqli_query($mysqli, $del);
				if ($rs !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'subject':
				$del = "delete from school_subjects where id = " . $data['id'];
				$rs = mysqli_query($mysqli, $del);
				if ($rs !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'student':
				$del = "delete from students where id = " . $data['id'];
				$rs = mysqli_query($mysqli, $del);
				if ($rs !== false) {
					$out['status'] = 'success';

					$delEnrollee = "delete from enrolled_subjects where enrollee_id = (select id from enrollees where student_id = " . $data['id'] . ")";
					$rsEnrollee = mysqli_query($mysqli, $delEnrollee);
					if ($rsEnrollee !== false) {
						$delES = "delete from enrollees where student_id = " . $data['id'];
						$rsES = mysqli_query($mysqli, $delES);
						if ($rsEnrollee !== false) {

						}else {
							$out['status'] = 'failed';
							$out['message'] = mysqli_error($mysqli);
						}
					}else {
						$out['status'] = 'failed';
						$out['message'] = mysqli_error($mysqli);
					}
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'role':
				$del = "delete from user_types where id = " . $data['id'];
				$rs = mysqli_query($mysqli, $del);
				if ($rs !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'section':
				$del = "delete from school_fix_sections where id = " . $data['id'];
				$rs = mysqli_query($mysqli, $del);
				if ($rs !== false) {
					$delSection = "delete from school_sections where id = " . $data['id'];
					$rsSection = mysqli_query($mysqli, $delSection);
					if ($rsSection !== false) {
						$out['status'] = 'success';
					}else {
						$out['status'] = 'failed';
						$out['message'] = mysqli_error($mysqli);
					}
					
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'staff':
				$delInfo = "delete from user_infos where user_id = " . $data['id'];
				$rsInfo = mysqli_query($mysqli, $delInfo);
				if ($rsInfo !== false) {
					$del = "delete from users where id = " . $data['id'];
					$rs = mysqli_query($mysqli, $del);
					if ($rs !== false) {
						$out['status'] = 'success';
					} else {
						$out['status'] = 'failed';
						$out['message'] = mysqli_error($mysqli);
					}
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			default:
				# code...
				break;
		}

		echo json_encode($out);
	}