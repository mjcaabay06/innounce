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
			default:
				# code...
				break;
		}

		echo json_encode($out);
	}