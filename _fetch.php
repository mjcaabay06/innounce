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
			case 'handled-subjects':
				$selSubject = "select school_subjects.* from professor_subjects inner join school_subjects on school_subjects.id = professor_subjects.school_subject_id where professor_subjects.professor_id = " . $_POST['id'];
				$rsSubject = mysqli_query($mysqli, $selSubject);
				if ($rsSubject !== false) {
					$result = '';

					while ($subject = mysqli_fetch_assoc($rsSubject)) {
						$result .= '<tr><td>' . $subject['code'] . '</td><td>' . $subject['description'] . '</td></tr>';
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
				//$selResponse = "select *, date_format(received_time, '%b %e, %Y [ %H:%i:%s ]') as date_receive from response_messages where referring_batch_id = " . $_POST['id'] . " order by received_time desc";
				$selSent = "select * from sent_messages where batch_id = " . $_POST['id'] . " limit 1";
				$rsSent = mysqli_query($mysqli, $selSent);
				$rowSent = mysqli_fetch_assoc($rsSent);

				$data['mt_id'] = $rowSent['message_type_id'];
				$html = '';

				if ($data['mt_id'] == 3) {
					$selEmergency = "select * from emergency_recipients where batch_id = " . $_POST['id'];
					$rsEmergency = mysqli_query($mysqli, $selEmergency);
					while ($em = mysqli_fetch_assoc($rsEmergency)) {
						$role = explode(":", $em['recipient_id']);
						$response = trim($em['remarks']) == '' ? '<span style="font-style: italic;">No response.</span>' : trim($em['remarks']) == 'a:no' ? '<span style="font-style: italic;">Cellphone Unattended.</span>' : $em['remarks'];
						$query = '';

						if ($role[0] == 's') {
							$query = "select students.student_code,students.first_name, students.middle_name, students.last_name, school_courses.description, school_sections.section as dep from students inner join (enrollees inner join school_sections on school_sections.id = enrollees.school_section_id inner join school_courses on school_courses.id = enrollees.school_course_id) on enrollees.student_id = students.id where students.id = " . $role[1] . " order by students.student_code limit 1";
						} elseif ($role[0] == 'p') {
							$query = "select user_infos.first_name, user_infos.middle_name, user_infos.last_name, user_types.type, departments.description as dep from users inner join user_infos on user_infos.user_id = users.id inner join user_types on user_types.id = users.user_type_id left join departments on departments.id = users.department_id where users.id = " . $role[1] . " limit 1";
						}
						$rs = mysqli_query($mysqli, $query);
						$row = mysqli_fetch_assoc($rs);
						$type = "";
						if ($role[0] == 's'){
							$type = "Students";
						} elseif ($role[0] == 'p'){
							$type = $row['type'];
						}
						$html .= '<tr><td>' . $row['last_name'] . ', ' . $row['first_name'] . '</td><td>' . $type . '</td><td>' . $row['dep'] . '</td><td>' . $response . '</td></tr>';
					}
				} else {
					$selResponse = "select students.student_code,students.first_name, students.middle_name, students.last_name, school_courses.description, school_sections.section, message_recipients.remarks, message_recipients.message_type_id from message_recipients inner join (students inner join (enrollees inner join school_sections on school_sections.id = enrollees.school_section_id inner join school_courses on school_courses.id = enrollees.school_course_id) on enrollees.student_id = students.id) on students.id = message_recipients.student_id where message_recipients.batch_id = " . $_POST['id'] . " order by students.student_code";
					$rsResponse = mysqli_query($mysqli, $selResponse);
					while ($res = mysqli_fetch_assoc($rsResponse)) {
						$response = trim($res['remarks']) == '' ? '<span style="font-style: italic;">No response.</span>' : $res['remarks'] ;
						$html .= '<tr><td>' . $res['last_name'] . ', ' . $res['first_name'] . '</td><td>' . $res['description'] . '</td><td>' . $res['section'] . '</td>';
						
						if ($res['message_type_id'] == 2) {
							$html .= '<td>' . $response . '</td>';
						}

						$html .= '</tr>';

						//$html .= '<tr><td>' . $res['last_name'] . ', ' . $res['first_name'] . '</td><td>' . $res['description'] . '</td><td>' . $res['section'] . '</td></tr>';
					}
				}

				$data['output'] = $html;
				$data['status'] = 'success';

				break;
			case 'departments':
				$selCourse = "select * from school_courses where department_id = " . $_POST['depId'] . ' order by description';
				$rsCourse = mysqli_query($mysqli, $selCourse);
				if ($rsCourse !== false) {
					$opt = '';
					while ($course = mysqli_fetch_assoc($rsCourse)) {
						$opt .= '<option value="' . $course['id'] . '">' . $course['description'] . '</option>';
					}
					$data['status'] = 'success';
					$data['output'] = $opt;
				}
				break;
			case 'a-subject':
				$param = $_POST["params"];

				$selSubject = "select school_subjects.* from enrollees inner join school_sections on school_sections.id = enrollees.school_section_id inner join (enrolled_subjects inner join school_subjects on school_subjects.id = enrolled_subjects.subject_id) on enrolled_subjects.enrollee_id = enrollees.id inner join school_courses on school_courses.id = enrollees.school_course_id where school_sections.school_level_id in (" . implode(',',$param['level']) . ") and enrollees.school_course_id = " . $param['course'] . " group by school_subjects.id order by school_subjects.description";
				$rsSubject = mysqli_query($mysqli, $selSubject);
				if ($rsSubject !== false) {
					$opt = '';
					$cnt = mysqli_num_rows($rsSubject);

					if ($cnt > 0) {
						while ($subject = mysqli_fetch_assoc($rsSubject)) {
							$opt .= '<option value="' . $subject['id'] . '">' . $subject['description'] . '</option>';
						}
					} else {
						$opt .= '<option disabled style="font-style: italic">No specific subjects.</option>';
					}
					
					$data['status'] = 'success';
					$data['output'] = $opt;
				}
				break;
			case 'a-section':
				$param = $_POST["params"];
				$selSection = "select school_sections.* from enrollees inner join school_sections on school_sections.id = enrollees.school_section_id inner join (enrolled_subjects inner join school_subjects on school_subjects.id = enrolled_subjects.subject_id) on enrolled_subjects.enrollee_id = enrollees.id inner join school_courses on school_courses.id = enrollees.school_course_id where school_sections.school_level_id in (" . implode(',',$param['level']) . ") and enrollees.school_course_id = " . $param['course'] . " and school_subjects.id in (" . implode(',',$param['subject']) . ") group by school_sections.id order by school_sections.section";
				$rsSection = mysqli_query($mysqli, $selSection);
				if ($rsSection !== false) {
					$opt = '';
					$cnt = mysqli_num_rows($rsSection);

					if ($cnt > 0) {
						while ($section = mysqli_fetch_assoc($rsSection)) {
							$opt .= '<option value="' . $section['id'] . '">' . $section['section'] . '</option>';
						}
					} else {
						$opt .= '<option disabled style="font-style: italic">No specific sections.</option>';
					}
					$data['status'] = 'success';
					$data['output'] = $opt;
				}

				break;
			default:
				# code...
				break;
		}
		echo json_encode($data);
	}
?>