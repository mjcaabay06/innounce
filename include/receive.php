<?php
	include("configurations.php");
	include("general_functions.php");

	include('Chikka/ChikkaSMS.php');
	$clientId = 'c315accbb28da59c05a6c0b4bc3248be5037c5ccc6cfed219a7507cfc2b01dc8';
	$secretKey = '56f51f5c4a81dc64ba3e0d5be7bb1087c0cb299c5659355f68d7b4910c42e179';
	$shortCode = '292907886';
	$chikkaAPI = new ChikkaSMS($clientId, $secretKey, $shortCode);

	if ($_POST){
		$message_type = $_POST["message_type"];
		

        if (strtoupper($message_type) == "INCOMING") {
        	$message = $_POST["message"];
	        $mobile_number = $_POST["mobile_number"];
	        $shortcode = $_POST["shortcode"];
	        $timestamp = $_POST["timestamp"];
	        $request_id = $_POST["request_id"];

	        insertLogs($message . ' - ' . $mobile_number);

	        //error_log(implode(',',array_map(function($v, $k){ return sprintf("%s='%s'",$k, $v); }, $_POST) ) );

        	$output = '';
			$msisdn = $shortcode;
			$sender = $mobile_number;
			//$msg_id = $_REQUEST['msg_id'];
			$message = $message;
			$code = explode(' ', strtoupper($message));
			$response = strtoupper($code[1]);
			$received_time = date('M j, Y',$timestamp);
			//$referring_msg_id = $_REQUEST['referring_msg_id'];
			$referring_batch_id = $request_id;

			//check the response batch id if exist
			$selMsg = "select * from sent_messages where response_code = '" . $code[0] . "' order by created_at desc limit 1";
			$rsMsg = mysqli_query($mysqli, $selMsg);
			$cntMsg = mysqli_num_rows($rsMsg);

			if ($cntMsg > 0) {
				$rowMsg = mysqli_fetch_assoc($rsMsg);

				//enter if message type is emergency
				if ($rowMsg['message_type_id'] == 3) {
					//check if sender exist on the emergency message sent
					$selResponse = "select * from emergency_recipients where batch_id = " . $rowMsg['batch_id'] . " AND recipient = '" . $sender . "' and (remarks != 'a:no' or remarks is null) order by created_at desc limit 1";
					$rsSelResponse = mysqli_query($mysqli, $selResponse);
					$cntSelResponse = mysqli_num_rows($rsSelResponse);

					if ($cntSelResponse > 0) {
						//update the remarks of recipient base on response
						$rowSelResponse = mysqli_fetch_assoc($rsSelResponse);
						$upEmergency = "update emergency_recipients set remarks='" . $response . "', updated_at = '" . $received_time . "' where id=" . $rowSelResponse['id'];
						$rsUpEmergency = mysqli_query($mysqli, $upEmergency);
						if ($rsUpEmergency !== false) {
							$output = 'success';
						} else {
							$output = mysqli_error($mysqli);
						}
					} else {
						//insert if unknown response
						$insUnkRes = "
							insert into
							unknown_responses(
								msisdn,
								sender,
								message,
								received_time,
								referring_batch_id
							)
							values(
								'" . $msisdn . "',
								'" . substr_replace($sender, '0', 0, 2) . "',
								'" . $message . "',
								'" . $received_time . "',
								" . $rowMsg['batch_id'] . "
							)
						";
						$rsUnkRes = mysqli_query($mysqli, $insUnkRes);
						if ($rsUnkRes !== false) {
							$output = 'success';
						} else {
							$output = mysqli_error($mysqli);
						}
					}
				} else {
					//insert responses for other message types
					$insResponse = "
						insert into
						response_messages(
							msisdn,
							sender,
							message,
							received_time,
							referring_batch_id
						)
						values(
							'" . $msisdn . "',
							'" . substr_replace($sender, '0', 0, 2) . "',
							'" . $response . "',
							'" . $received_time . "',
							" . $rowMsg['batch_id'] . "
						)
					";
					$rsResponse = mysqli_query($mysqli, $insResponse);
					if ($rsResponse !== false) {
						$up = "update message_recipients set remarks = '" . $response . "' where recipient = '" . $sender . "' and batch_id = " . $rowMsg['batch_id'];
						$rs = mysqli_query($mysqli, $up);
						if ($rs !== false) {
							$output = "A message with body " . $response . " was sent from " . $sender . " to " . $msisdn ."\n";
						} else {
							error_log('mysqli_error: ' . mysqli_error($mysqli));
						}
						
					} else {
						$output = mysqli_error($mysqli);
					}
				}
			} else {
				//insert if unknown response
				$insUnkRes = "
					insert into
					unknown_responses(
						msisdn,
						sender,
						message,
						received_time,
						referring_batch_id
					)
					values(
						'" . $msisdn . "',
						'" . substr_replace($sender, '0', 0, 2) . "',
						'" . $message . "',
						'" . $received_time . "',
						0
					)
				";
				$rsUnkRes = mysqli_query($mysqli, $insUnkRes);
				if ($rsUnkRes !== false) {
					$output = 'success';
				} else {
					$output = mysqli_error($mysqli);
				}
			}
			error_log($output);

			$messageID = randomUniqueMsgID();
			$result = receiveResponse($request_id, $messageID, $mobile_number);
			if ((int)$result->status == 200) {
				insertLogs('Accepted response for: ' . $mobile_number . ' - ' . $result->status);
				error_log('>>>>>>>>>>e:' . $result->status);
			} else {
				insertLogs('Reject response for: ' . $mobile_number . ' - ' . $result->message);
				error_log('---------e: ' . implode(',',$result));
			}
        }
	}
	// try
 //    {
 //        $message_type = $_POST["message_type"];
 //    }
 //    catch (Exception $e)
 //    {
 //        echo "Error";
 //        exit(0);
 //    }

 //    if (strtoupper($message_type) == "INCOMING")
 //    {
 //        try
 //        {
 //            $message = $_POST["message"];
 //            $mobile_number = $_POST["mobile_number"];
 //            $shortcode = $_POST["shortcode"];
 //            $timestamp = $_POST["timestamp"];
 //            $request_id = $_POST["request_id"];

 //            echo "Accepted";
 //            exit(0);
 //        }
 //        catch (Exception $e)
 //        {
 //            echo "Error";
 //            exit(0);
 //        }
 //    }
 //    else
 //    {
 //        echo "Error";
 //        exit(0);
 //    }

	// error_log('-----'.$request_id);
	

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