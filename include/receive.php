<?php
	include("configurations.php");
	include("general_functions.php");

	$msisdn = $_REQUEST['msisdn'];
	$sender = $_REQUEST['sender'];
	$message = $_REQUEST['message'];

	$output = "A message with body " . $message . " was sent from " . $sender . " to " . $msisdn ."\n";
	echo $output;
	error_log($output);

	// Hex-encoded unicode SMS bodies ($_REQUEST['dca']=='16bit') can be decoded to UTF-8
	// (which is typically what you would want to use) with:
	// $decoded_body = mb_convert_encoding(hex2bin($_REQUEST['message']), "UTF-8", "UTF-16");

	// Print the rest of the pushed parameters:
	$res = '';
	foreach ( $_REQUEST as $param => $value ) {
	  $res .= $param . ": " . $value . "<br />";
	}
	echo $res;
?>