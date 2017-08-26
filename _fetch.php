<?php
	session_start();
	include("include/configurations.php");
	include("include/general_functions.php");

	if ($_POST) {
		$data = array();
		switch (strtolower($_POST['action'])) {
			case 'fetch-year-level':
				$selYearLevel = "
						select
							school_levels.*
						from
							school_levels
						inner join
							(
								school_sections inner join enrollees
							on
								enrollees.school_section_id = school_sections.id
							)
						on
							school_sections.school_level_id = school_levels.id
						where
							enrollees.school_course_id = " . $_POST['courseId'] . "
						group by
							school_levels.id
						order by
							school_levels.id";
				$rsYearLevel = mysqli_query($mysqli, $selYearLevel);

				$result = '';
				if (mysqli_num_rows($rsYearLevel) > 0) {
					while ($yearLevel = mysqli_fetch_assoc($rsYearLevel)) {
						$result .= '<option value="' . $yearLevel['id'] . '">' . $yearLevel['description'] . '</option>';
					}
					$data['status'] = 'success';
				} else {
					$result .= '<option disabled><i>No enrollees for this course.</i></option>';
					$data['status'] = 'failed';
				}
				$data['output'] = $result;

				break;
			
			case 'fetch-sections':
				$course = $_POST['courseId'];
				$prof = $_POST['profId'];

				#$selSubject = "select school_subjects.* from professor_subjects inner join school_subjects on school_subjects.id = professor_subjects.school_subject_id where professor_id = " . $prof;
				$selSubject = "select school_subjects.* from users inner join (professor_subjects inner join (enrolled_subjects inner join (enrollees inner join school_courses on school_courses.id = enrollees.school_course_id) on enrollees.id = enrolled_subjects.enrollee_id) on enrolled_subjects.subject_id = professor_subjects.school_subject_id) on professor_subjects.professor_id = users.id inner join school_subjects on school_subjects.id = professor_subjects.school_subject_id where users.id = " . $prof . " and school_courses.id = " . $course . " group by school_subjects.id";
				$rsSubject = mysqli_query($mysqli, $selSubject);

				$result = '';
				if (mysqli_num_rows($rsSubject) > 0) {
					while ($subject = mysqli_fetch_assoc($rsSubject)) {
						$result .= '<optgroup label="' . $subject['description'] . '">';
						$selSection = "select school_sections.*  from school_sections inner join (enrollees inner join enrolled_subjects on enrolled_subjects.enrollee_id = enrollees.id) on enrollees.school_section_id = school_sections.id where enrolled_subjects.subject_id = " . $subject['id'] . " and enrollees.school_course_id = " . $course . " group by school_sections.id";
						$rsSection = mysqli_query($mysqli, $selSection);

						if (mysqli_num_rows($rsSection) > 0) {
							while ($section = mysqli_fetch_assoc($rsSection)) {
								$result .= '<option value="' . $section['id'] . '">' . $section['section'] . '</option>';
							}	
						} else {
							$result .= '<option disabled><i>No enrollees for this subject.</i></option>';
						}
						$result .= '</optgroup>';
					}
					$data['status'] = 'success';
				} else {
					$result .= '<option disabled><i>No enrollees for this course.</i></option>';
					$data['status'] = 'failed';
				}

				$data['output'] = $result;


				break;
			case 'fetch-students':
				$params = $_POST['params'];
				$selStudents = "select students.* from enrollees inner join students on students.id = enrollees.student_id where enrollees.school_section_id in (" . implode(',' , $params['sections']) . ") order by students.last_name";
				$rsStudents = mysqli_query($mysqli, $selStudents);
				if ($rsStudents !== false) {
					$result = '';

					while ($stud = mysqli_fetch_assoc($rsStudents)) {
						$result .= '<option value="' . $stud['id'] . '">' . $stud['last_name'] . ', ' . $stud['first_name'] . '</option>';
					}

					$data['status'] = 'success';
					$data['output'] = $result;
				} else {
					$data['status'] = 'failed';
					$data['output'] = mysqli_error($mysqli);
				}
				break;
			case 'handled-sections':
				$selSection = "select school_sections.*, school_levels.description from professor_subjects inner join (enrolled_subjects inner join (enrollees inner join (school_sections inner join school_levels on school_levels.id = school_sections.school_level_id) on school_sections.id = enrollees.school_section_id) on enrollees.id = enrolled_subjects.enrollee_id) on enrolled_subjects.subject_id = professor_subjects.school_subject_id where professor_subjects.professor_id = " . $_POST['id'] . " group by enrollees.school_section_id";
				$rsSection = mysqli_query($mysqli, $selSection);
				if ($rsSection !== false) {
					$result = '';

					while ($section = mysqli_fetch_assoc($rsSection)) {
						$result .= '<tr><td>' . $section['section'] . '</td><td>' . $section['description'] . '</td></tr>';
					}
					$data['status'] = 'success';
					$data['output'] = $result;
				} else {
					$data['status'] = 'failed';
					$data['output'] = mysqli_error($mysqli);
				}
				break;
			case 'role-section':
				$selHandleCourse = "select * from handle_courses where user_type_id = " . $_POST['id'];
				$rsHandleCourse = mysqli_query($mysqli, $selHandleCourse);
				
				$hc_arr = array();
				while ($hc = mysqli_fetch_assoc($rsHandleCourse)) {
					array_push($hc_arr, $hc['school_course_id']);
				}

				$selCourse = "select * from school_courses";
				$rsCourse = mysqli_query($mysqli, $selCourse);

				$result = '';
				while ($course = mysqli_fetch_assoc($rsCourse)) {
					if (in_array($course['id'], $hc_arr)) {
						$result .= '<option selected="selected" value="' . $course['id'] . '">' . $course['description'] . '</option>';
					} else {
						$result .= '<option value="' . $course['id'] . '">' . $course['description'] . '</option>';
					}
				}
				$data['output'] = $result;
				break;
			case 'user-type':
				$selType = "select * from user_types order by type";
				$rsType = mysqli_query($mysqli, $selType);
				if ($rsType !== false) {
					$result = '';
					while ($type = mysqli_fetch_assoc($rsType)) {
						if ($_POST['id'] == $type['id']) {
							$result .= '<option value="' . $type['id'] . '" selected="selected">' . $type['type'] . '</option>';
						} else {
							$result .= '<option value="' . $type['id'] . '">' . $type['type'] . '</option>';
						}
					}
				}
				$data['output'] = $result;
				break;
			case 'view-response':
				$selResponse = "select *, date_format(received_time, '%b %e, %Y [ %H:%i:%s ]') as date_receive from response_messages where referring_batch_id = " . $_POST['id'] . " order by received_time desc";
				$rsResponse = mysqli_query($mysqli, $selResponse);
				if ($rsResponse !== false) {
					$html = '';
					while ($res = mysqli_fetch_assoc($rsResponse)) {
						$html .= '<tr><td>' . $res['message'] . '</td><td>' . $res['sender'] . '</td><td>' . $res['date_receive'] . '</td></tr>';
					}
					$data['output'] = $html;
					$data['status'] = 'success';
				}
				break;
			default:
				# code...
				break;
		}
		echo json_encode($data);
	}
?>