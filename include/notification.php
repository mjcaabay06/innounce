<?php
	include("configurations.php");
	include("general_functions.php");

	include('Chikka/ChikkaSMS.php');
	$clientId = 'c315accbb28da59c05a6c0b4bc3248be5037c5ccc6cfed219a7507cfc2b01dc8';
	$secretKey = '56f51f5c4a81dc64ba3e0d5be7bb1087c0cb299c5659355f68d7b4910c42e179';
	$shortCode = '292907886';
	$chikkaAPI = new ChikkaSMS($clientId, $secretKey, $shortCode);

	if ($_POST) {
		$message_type = $_POST["message_type"];

		if (strtoupper($message_type) == "OUTGOING") {
			error_log(implode(',',$_POST));
		}
	}
?>