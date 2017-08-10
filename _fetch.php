<?php
	session_start();
	include("include/configurations.php");
	include("include/general_functions.php");

	if ($_POST) {
		switch (strtolower($_POST['action'])) {
			case 'fetch-year-level':
				$data = [];
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

				echo json_encode($data);

				break;
			
			case 'fetch-sections':
				$data = [];
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

				echo json_encode($data);

				break;
			default:
				# code...
				break;
		}
	}
?>