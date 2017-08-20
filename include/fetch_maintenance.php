<?php
	session_start();
	include("configurations.php");
	include("general_functions.php");

	if ($_POST) {
		$out = array();

		switch (strtolower($_POST['action'])) {
			case 'enrolled-subjects':
				$selSubject = "select enrolled_subjects.id, school_subjects.* from enrolled_subjects inner join enrollees on enrollees.id = enrolled_subjects.enrollee_id inner join school_subjects on school_subjects.id = enrolled_subjects.subject_id where enrollees.id = " . $_POST['id'];
				$rsSubject = mysqli_query($mysqli, $selSubject);
				if ($rsSubject !== false) {
					$out['status'] = 'success';

					$fetch = '';
					while($sub = mysqli_fetch_assoc($rsSubject)){
						$fetch .= '<tr><td>' . $sub['code'] . '</td><td>' . $sub['description'] . '</td><td></td></tr>';
					}
					$out['message'] = $fetch;
				} else {
					$out['status'] = 'failed';
					$out['message'] = mysqli_error($mysqli);
				}
				break;
			case 'student':
				$selActiveStudent = "select * from enrollees inner join students on students.id = enrollees.student_id where enrollees.school_year_id = 1 and students.student_code = '" . $_POST['code'] . "'";
				$rsActiveStudent = mysqli_query($mysqli, $selActiveStudent);
				$cntActiveStudent = mysqli_num_rows($rsActiveStudent);
				if ($cntActiveStudent > 0) {
					$out['status'] = 'failed';
					$out['message'] = 'Student already enrolled for this school year.';
				} else {
					$selStudent = "select students.*, school_courses.description, school_courses.acronym from students inner join school_courses on school_courses.id = students.course_id where students.id not in (select student_id from enrollees where school_year_id = 1) and students.student_code = '" . $_POST['code'] . "'";
					$rsStudent = mysqli_query($mysqli, $selStudent);
					$cntStudent = mysqli_num_rows($rsStudent);
					$row = mysqli_fetch_assoc($rsStudent);

					if ($cntStudent > 0) {
						$out['status'] = 'success';
						$out['data'] = $row;

						$selSection = "select * from school_sections where section like '%" . $row['acronym'] . "' order by section";
						$rsSection = mysqli_query($mysqli, $selSection);
						$sel = '';
						while($section = mysqli_fetch_assoc($rsSection)){
							$sel .= '<option value="' . $section['id'] . '">' . $section['section'] . '</option>';
						}
						$out['sel'] = $sel;

					} else {
						$out['status'] = 'failed';
						$out['message'] = 'Student Id not found.';
					}
				}
				break;
			case 'add-subject':
				$selSubject = "select * from school_subjects where code = '" . $_POST['code'] . "'";
				$rsSubject = mysqli_query($mysqli, $selSubject);
				$cntSubject = mysqli_num_rows($rsSubject);
				$rowSubject = mysqli_fetch_assoc($rsSubject);
				if ($cntSubject > 0) {
					$out['status'] = 'success';
					$out['data'] = $rowSubject;
				} else {
					$out['status'] = 'failed';
					$out['message'] = 'Subject not found.';
				}
				break;
			default:
				# code...
				break;
		}

		echo json_encode($out);
	}