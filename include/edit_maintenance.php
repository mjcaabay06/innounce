<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$id = empty($_POST['id']) ? 0 : $_POST['id'];
		$data = $_POST['params'];
		$out = array();

		switch (strtolower($_POST['action'])) {
			case 'school-year':
				$upYear = "update school_years set year_from = " . $data['from'] . ", year_to = " . $data['to'] . " where id = " . $id;
				$rsUpYear = mysqli_query($mysqli, $upYear);
				if ($rsUpYear !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;

			case 'school-level':
				$upLevel = "update school_levels set level = " . $data['level'] . ", description = '" . $data['description'] . "' where id = " . $id;
				$rsUpLevel = mysqli_query($mysqli, $upLevel);
				if ($rsUpLevel !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'school-section':
				$upFixSection = "update school_fix_sections set section='" . $data['section'] . "', school_course_id=" . $data['course'] . ", school_level_id=" . $data['level'] . " where id = " . $id;
				$rsUpFixSection = mysqli_query($mysqli, $upFixSection);
				if ($rsUpFixSection !== false) {
					$upSection = "update school_sections set section='" . $data['section'] . "', school_level_id=" . $data['level'] . " where id = " . $id;;
					$rsSection = mysqli_query($mysqli, $upSection);
					if ($rsSection !== false) {
						$out['status'] = 'success';
					} else {
						$out['status'] = 'error';
						$out['message'] = mysqli_error($mysqli);
					}
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;

			case 'school-subject':
				$upSubject = "update school_subjects set code = '" . $data['code'] . "', description = '" . $data['description'] . "' where id = " . $id;
				$rsUpSubject = mysqli_query($mysqli, $upSubject);
				if ($rsUpSubject !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;

			case 'school-course':
				$upCourse = "update school_courses set description = '" . $data['description'] . "', acronym = '" . $data['acronym'] . "' where id = " . $id;
				$rsUpCourse = mysqli_query($mysqli, $upCourse);
				if ($rsUpCourse !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'enrollee-subject':
				$delSubjects = "delete from enrolled_subjects where enrollee_id = " . $data['enrolleeId'];
				$rsDelSubjects = mysqli_query($mysqli, $delSubjects);
				if ($rsDelSubjects !== false) {
					$subArr = array();
					foreach ($data['subjects'] as $subject) {
						$aa = "(" . $data['enrolleeId'] . "," . $subject . ")";
						array_push($subArr, $aa);
					}

					$insSubject = "insert into enrolled_subjects(enrollee_id, subject_id) values" . implode(',', $subArr);
					$rsInsSubject = mysqli_query($mysqli, $insSubject);
					if ($rsInsSubject !== false) {
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
			case 'staff-subject':
				$delSubjects = "delete from professor_subjects where professor_id = " . $data['staffId'];
				$rsDelSubjects = mysqli_query($mysqli, $delSubjects);
				if ($rsDelSubjects !== false) {
					$subArr = array();
					foreach ($data['subjects'] as $subject) {
						$aa = "(" . $data['staffId'] . "," . $subject . ")";
						array_push($subArr, $aa);
					}

					$insSubject = "insert into professor_subjects(professor_id, school_subject_id) values" . implode(',', $subArr);
					$rsInsSubject = mysqli_query($mysqli, $insSubject);
					if ($rsInsSubject !== false) {
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
			case 'enrollee-section':
				$upSection = "update enrollees set school_section_id = " . $data['section'] . " where id = " . $data['id'];
				$rsSection = mysqli_query($mysqli, $upSection);
				if ($rsSection !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'handle-course':
				$delCourse = "delete from handle_courses where user_type_id = " . $data['id'];
				$rsDelCourse = mysqli_query($mysqli, $delCourse);

				if ($rsDelCourse !== false) {
					$subArr = array();
					foreach ($data['courses'] as $course) {
						$aa = "(" . $data['id'] . "," . $course . ")";
						array_push($subArr, $aa);
					}
					$insHandleCourse = "insert into handle_courses(user_type_id,school_course_id) values " . implode(',', $subArr);
					$rsHandleCourse = mysqli_query($mysqli, $insHandleCourse);
					if ($rsHandleCourse !== false) {
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
			case 'school-department':
				$upDepartment = "update departments set description = '" . $data['department'] . "' where id = " . $data['id'];
				$rsDepartment = mysqli_query($mysqli, $upDepartment);
				if ($rsDepartment !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
				break;
			default:
				# code...
				break;
		}

		echo json_encode($out);
	}