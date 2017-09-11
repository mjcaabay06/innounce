<?php
	include("configurations.php");
	include("general_functions.php");

	try
    {
        $message_type = $_POST["message_type"];
    }
    catch (Exception $e)
    {
        echo "Error";
        exit(0);
    }

    if (strtoupper($message_type) == "INCOMING")
    {
        try
        {
            $message = $_POST["message"];
            $mobile_number = $_POST["mobile_number"];
            $shortcode = $_POST["shortcode"];
            $timestamp = $_POST["timestamp"];
            $request_id = $_POST["request_id"];

            echo "Accepted";
            exit(0);
        }
        catch (Exception $e)
        {
            echo "Error";
            exit(0);
        }
    }
    else
    {
        echo "Error";
        exit(0);
    }

	error_log($request_id);
	// $output = '';
	// $msisdn = $_REQUEST['msisdn'];
	// $sender = $_REQUEST['sender'];
	// $msg_id = $_REQUEST['msg_id'];
	// $message = $_REQUEST['message'];
	// $received_time = $_REQUEST['received_time'];
	// $referring_msg_id = $_REQUEST['referring_msg_id'];
	// $referring_batch_id = $_REQUEST['referring_batch_id'];

	// //check the response batch id if exist
	// $selMsg = "select * from sent_messages where batch_id = " . $referring_batch_id . " order by created_at desc limit 1";
	// $rsMsg = mysqli_query($mysqli, $selMsg);
	// $cntMsg = mysqli_num_rows($rsMsg);

	// if ($cntMsg > 0) {
	// 	$rowMsg = mysqli_fetch_assoc($rsMsg);

	// 	//enter if message type is emergency
	// 	if ($rowMsg['message_type_id'] == 3) {
	// 		//check if sender exist on the emergency message sent
	// 		$selResponse = "select * from emergency_recipients where batch_id = " . $referring_batch_id . " AND recipient = '" . $sender . "' and (remarks != 'a:no' or remarks is null) order by created_at desc limit 1";
	// 		$rsSelResponse = mysqli_query($mysqli, $selResponse);
	// 		$cntSelResponse = mysqli_num_rows($rsSelResponse);

	// 		if ($cntSelResponse > 0) {
	// 			//update the remarks of recipient base on response
	// 			$rowSelResponse = mysqli_fetch_assoc($rsSelResponse);
	// 			$upEmergency = "update emergency_recipients set remarks='" . $message . "' where id=" . $rowSelResponse['id'];
	// 			$rsUpEmergency = mysqli_query($mysqli, $upEmergency);
	// 			if ($rsUpEmergency !== false) {
	// 				$output = 'success';
	// 			} else {
	// 				$output = mysqli_error($mysqli);
	// 			}
	// 		} else {
	// 			//insert if unknown response
	// 			$insUnkRes = "
	// 				insert into
	// 				unknown_responses(
	// 					msisdn,
	// 					sender,
	// 					msg_id,
	// 					message,
	// 					received_time,
	// 					referring_msg_id,
	// 					referring_batch_id
	// 				)
	// 				values(
	// 					'" . $msisdn . "',
	// 					'" . substr_replace($sender, '0', 0, 2) . "',
	// 					" . $msg_id . ",
	// 					'" . $message . "',
	// 					'" . $received_time . "',
	// 					" . $referring_msg_id . ",
	// 					" . $referring_batch_id . "
	// 				)
	// 			";
	// 			$rsUnkRes = mysqli_query($mysqli, $insUnkRes);
	// 			if ($rsUnkRes !== false) {
	// 				$output = 'success';
	// 			} else {
	// 				$output = mysqli_error($mysqli);
	// 			}
	// 		}
	// 	} else {
	// 		//insert responses for other message types
	// 		$insResponse = "
	// 			insert into
	// 			response_messages(
	// 				msisdn,
	// 				sender,
	// 				msg_id,
	// 				message,
	// 				received_time,
	// 				referring_msg_id,
	// 				referring_batch_id
	// 			)
	// 			values(
	// 				'" . $msisdn . "',
	// 				'" . substr_replace($sender, '0', 0, 2) . "',
	// 				" . $msg_id . ",
	// 				'" . $message . "',
	// 				'" . $received_time . "',
	// 				" . $referring_msg_id . ",
	// 				" . $referring_batch_id . "
	// 			)
	// 		";
	// 		$rsResponse = mysqli_query($mysqli, $insResponse);
	// 		if ($rsResponse !== false) {
	// 			$up = "update message_recipients set remarks = '" . $message . "' where sender = '" . $sender . "' and batch_id = " . $referring_batch_id;
	// 			$rs = mysqli_query($mysqli, $up);
	// 			if ($rs !== false) {
	// 				$output = "A message with body " . $message . " was sent from " . $sender . " to " . $msisdn ."\n";
	// 			} else {
					
	// 			}
				
	// 		} else {
	// 			$output = mysqli_error($mysqli);
	// 		}
	// 	}
	// } else {
	// 	//insert if unknown response
	// 	$insUnkRes = "
	// 		insert into
	// 		unknown_responses(
	// 			msisdn,
	// 			sender,
	// 			msg_id,
	// 			message,
	// 			received_time,
	// 			referring_msg_id,
	// 			referring_batch_id
	// 		)
	// 		values(
	// 			'" . $msisdn . "',
	// 			'" . substr_replace($sender, '0', 0, 2) . "',
	// 			" . $msg_id . ",
	// 			'" . $message . "',
	// 			'" . $received_time . "',
	// 			" . $referring_msg_id . ",
	// 			" . $referring_batch_id . "
	// 		)
	// 	";
	// 	$rsUnkRes = mysqli_query($mysqli, $insUnkRes);
	// 	if ($rsUnkRes !== false) {
	// 		$output = 'success';
	// 	} else {
	// 		$output = mysqli_error($mysqli);
	// 	}
	// }
	// echo $output;

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