<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$data = $_POST['params'];
		$out = array();

		switch (strtolower($_POST['action'])) {
			case 'school-year':
				$insYear = "insert into school_years(year_from,year_to) values(" . $data['from'] . "," . $data['to'] . ")";
				$rsInsYear = mysqli_query($mysqli, $insYear);
				if ($rsInsYear !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;

			case 'school-level':
				$insLevel = "insert into school_levels(level,description) values(" . $data['level'] . ",'" . $data['description'] . "')";
				$rsInsLevel = mysqli_query($mysqli, $insLevel);
				if ($rsInsLevel !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;

			case 'school-section':
				$insFixSection = "insert into school_fix_sections(section,school_course_id,school_level_id) values('" . $data['section'] . "'," . $data['course'] . "," . $data['level'] . ")";
				$rsFixSection = mysqli_query($mysqli, $insFixSection);
				if ($rsFixSection !== false) {
					$insSection = "insert into school_sections(section,school_level_id) values('" . $data['section'] . "'," . $data['level'] . ")";
					$rsSection = mysqli_query($mysqli, $insSection);
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
				$insSubject = "insert into school_subjects(code,description) values('" . $data['code'] . "','" . $data['description'] . "')";
				$rsInsSubject = mysqli_query($mysqli, $insSubject);
				if ($rsInsSubject !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;

			case 'school-course':
				$insCourse = "insert into school_courses(description,acronym) values('" . $data['description'] . "','" . $data['acronym'] . "')";
				$rsInsCourse = mysqli_query($mysqli, $insCourse);
				if ($rsInsCourse !== false) {
					$out['status'] = 'success';
				} else {
					$out['status'] = 'error';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'add-enrollee':
				$insEnrollee = "
					insert into
					enrollees(
						student_id,
						school_year_id,
						school_course_id,
						school_section_id
					)
					values(
						" . $data['studentId'] . ",
						1,
						" . $data['courseId'] . ",
						" . $data['sectionId'] . "
					)
				";
				$rsInsEnrolle = mysqli_query($mysqli, $insEnrollee);
				if ($rsInsEnrolle !== false) {
					$enrolleeId = mysqli_insert_id($mysqli);

					if (!empty($data['subjects'])) {
						$subArr = array();
						foreach ($data['subjects'] as $subject) {
							$aa = "(" . $enrolleeId . "," . $subject . ")";
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