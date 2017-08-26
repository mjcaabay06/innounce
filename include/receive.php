<?php
	include("configurations.php");
	include("general_functions.php");

	$msisdn = $_REQUEST['msisdn'];
	$sender = $_REQUEST['sender'];
	$msg_id = $_REQUEST['msg_id'];
	$message = $_REQUEST['message'];
	$received_time = $_REQUEST['received_time'];
	$referring_msg_id = $_REQUEST['referring_msg_id'];
	$referring_batch_id = $_REQUEST['referring_batch_id'];

	$insResponse = "
		insert into
		response_messages(
			msisdn,
			sender,
			msg_id,
			message,
			received_time,
			referring_msg_id,
			referring_batch_id
		)
		values(
			'" . $msisdn . "',
			'" . $sender . "',
			" . $msg_id . ",
			'" . $message . "',
			'" . $received_time . "',
			" . $referring_msg_id . ",
			" . $referring_batch_id . "
		)
	";
	$rsResponse = mysqli_query($mysqli, $insResponse);
	$output = '';
	if ($rsResponse !== false) {
		$output = "A message with body " . $message . " was sent from " . $sender . " to " . $msisdn ."\n";
	} else {
		$output = mysqli_error($mysqli);
	}
	echo $output;

	// $output = "A message with body " . $message . " was sent from " . $sender . " to " . $msisdn ."\n";
	// echo $output;
	// error_log($output);

	// Hex-encoded unicode SMS bodies ($_REQUEST['dca']=='16bit') can be decoded to UTF-8
	// (which is typically what you would want to use) with:
	// $decoded_body = mb_convert_encoding(hex2bin($_REQUEST['message']), "UTF-8", "UTF-16");

	// Print the rest of the pushed parameters:
	// $res = '';
	// foreach ( $_REQUEST as $param => $value ) {
	//   $res .= $param . ": " . $value . "<br />";
	// }
	// echo $res;
?>