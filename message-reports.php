<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	if(!isset($_COOKIE['authId']) || empty($_COOKIE['authId'])){
		header("Location: login.php");
		exit;
	}

	$startdate = date('Y-m-d',strtotime($_GET['startdate']));
	$enddate = date('Y-m-d',strtotime($_GET['enddate']));
	
	// $table = $_GET['type'] == 'sent' ? 'sent_massages' : 'logout_logs';
	// $selCountLogin = "select * from " . $table . " as l where date_format(l.created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by l.created_at";
	// $rsCountLogin = mysqli_query($mysqli, $selCountLogin);
	// $numCountLogin = mysqli_num_rows($rsCountLogin);
	

	if ($_GET['type'] == 'sent') {
		$selCountSent = "select sent_messages.*, user_infos.*, message_types.*, date_format(sent_messages.created_at, '%b %e, %Y [ %H:%i:%s ]') as date_sent from sent_messages inner join (users inner join user_infos on user_infos.user_id = users.id) on users.id = sent_messages.user_id inner join message_types on message_types.id = sent_messages.message_type_id where date_format(sent_messages.created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by sent_messages.created_at";
		$rsCountSent = mysqli_query($mysqli, $selCountSent);
		$rowCount = mysqli_num_rows($rsCountSent);
	} else {
		$selCountRcv = "select *, date_format(created_at, '%b %e, %Y [ %H:%i:%s ]') as date_receive from response_messages where date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by created_at";
		$rsCountRcv = mysqli_query($mysqli, $selCountRcv);
		$rowCount = mysqli_num_rows($rsCountRcv);

		$selEmergency = "select *, date_format(created_at, '%b %e, %Y [ %H:%i:%s ]') as date_receive from emergency_recipients where remarks is not null and remarks != 'a:no' and date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by created_at";
		$rsEmergency = mysqli_query($mysqli, $selEmergency);
		$cntEmergency = mysqli_num_rows($rsEmergency);

		$selUnk = "select *, date_format(created_at, '%b %e, %Y [ %H:%i:%s ]') as date_receive from unknown_responses where date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by created_at";
		$rsUnk = mysqli_query($mysqli, $selUnk);
		$cntUnk = mysqli_num_rows($rsUnk);
	}

	$rowPerPage = 10;
	$pageCount = intval($rowCount) == 0 ? 1 : ceil(intval($rowCount) / intval($rowPerPage));
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('partial/_head.php'); ?>
		<style type="text/css">
			@media print{
				div#italic small {font-style: italic !important}
			}
			
			.for-all {
				font-size: 13px !important;
				font-family: Tahoma, Verdana, Segoe, sans-serif !important;
				line-height: 15px;
			}
			.res {
				margin: 0
			}
			.ucase{
				text-transform: uppercase;
			}
			.pagebreak{
				page-break-before: always;
			}

			.per-page {
				box-shadow: 0px 0px 5px #333333;
				background-color: #ffffff;
				padding: 1cm;
				margin-bottom: 30px;
			}
			.clear{
				padding: 0;
				margin: 0;
			}
		</style>
		<style type="text/css" media="print, screen, projection">
			@page {
			    @bottom {
			        content: "Page " counter(page) " of " counter(pages);
			    }
			}
		</style>
		<style type="text/css">
			@media print{
				body{
					margin: 0 !important;
					padding: 0 !important;
				}
			}
			.page-header-pd {
				border-top: 9px solid #cf0a2c;
				border-bottom: 0 none;
				padding-top: 28px;
				margin-bottom: 5px;
				margin-top: 0px;
			}
			h5 {
				color: #66a5da !important;
				-webkit-print-color-adjust: exact;
			}
			.per-page {
				height: 8.5in;
				width: 11in;
				margin: 0 auto;
				margin-bottom: 30px;
			}
		</style>
	</head>
		<body onload=""  style="background-color: #525659;margin: 30px;">
			<div class="container-fluid">
			<?php for($x = 1; $x <= $pageCount; $x++): ?>

				<div class="per-page">
					<?php if ($x == 1): ?>
						<div class="text-center">
							<h2 class="mb-5"><?php echo $_GET['type'] == 'sent' ? 'Sent Message Report' : 'Response Message Report' ?></h2>
							<div class="mb-20"><?php echo date('M j, Y',strtotime($_GET['startdate'])) . '  -  ' . date('M j, Y',strtotime($_GET['enddate'])) ?></div>
						</div>
					<?php endif; ?>
					<div class="col-sm-12">
						<?php if ($_GET['type'] == 'sent'): ?>
							<table class="table">
								<thead>
									<tr>
										<th>Batch ID</th>
										<th>Message</th>
										<th>Message Type</th>
										<th>User</th>
										<th>Date Sent</th>
									</tr>
								</thead>
								<tbody style="color: #333">
									<?php
										$limit = ($x - 1) * $rowPerPage;
										$selCountSent = "select sent_messages.*, user_infos.*, message_types.*, date_format(sent_messages.created_at, '%b %e, %Y [ %H:%i:%s ]') as date_sent from sent_messages inner join (users inner join user_infos on user_infos.user_id = users.id) on users.id = sent_messages.user_id inner join message_types on message_types.id = sent_messages.message_type_id where date_format(sent_messages.created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by sent_messages.created_at limit " . $limit . "," . $rowPerPage;
										$rsSent = mysqli_query($mysqli, $selCountSent);

										while($sent = mysqli_fetch_assoc($rsSent)):
									?>
									<tr>
										<td><?php echo $sent['batch_id'] ?></td>
										<td><?php echo $sent['message'] ?></td>
										<td><?php echo $sent['type'] ?></td>
										<td><?php echo $sent['last_name'] . ', ' . $sent['first_name'] ?></td>
										<td><?php echo $sent['date_sent'] ?></td>
									</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						<?php else: ?>
							<table class="table">
								<thead>
									<tr>
										<th>Batch ID</th>
										<th>Reply Message</th>
										<th>Sender Number</th>
										<th>Date Receive</th>
									</tr>
								</thead>
								<tbody style="color: #333">
									<?php
										$limit = ($x - 1) * $rowPerPage;
										$selCountRcv = "select *, date_format(created_at, '%b %e, %Y [ %H:%i:%s ]') as date_receive from response_messages where date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by created_at limit " . $limit . "," . $rowPerPage;
										$rsRcv = mysqli_query($mysqli, $selCountRcv);

										while($rcv = mysqli_fetch_assoc($rsRcv)):
									?>
									<tr>
										<td><?php echo $rcv['referring_batch_id'] ?></td>
										<td><?php echo $rcv['message'] ?></td>
										<td><?php echo $rcv['sender'] ?></td>
										<td><?php echo $rcv['date_receive'] ?></td>
									</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
				<div class="pagebreak"></div>

			<?php endfor; ?>
			<?php if ($_GET['type'] != 'sent'): ?>
				<?php
					$pageEmergency = intval($cntEmergency) == 0 ? 1 : ceil(intval($cntEmergency) / intval($rowPerPage));
					for($x = 1; $x <= $pageEmergency; $x++):
				?>
				
					<div class="per-page">
						<?php if ($x == 1): ?>
							<div class="text-center">
								<h2 class="mb-5"><?php echo 'Emergency Response Message Report' ?></h2>
								<div class="mb-20"><?php echo date('M j, Y',strtotime($_GET['startdate'])) . '  -  ' . date('M j, Y',strtotime($_GET['enddate'])) ?></div>
							</div>
						<?php endif; ?>
						<div class="col-sm-12">
								<table class="table">
									<thead>
										<tr>
											<th>Batch ID</th>
											<th>Reply Message</th>
											<th>Sender Number</th>
											<th>Date Receive</th>
										</tr>
									</thead>
									<tbody style="color: #333">
										<?php
											$limit = ($x - 1) * $rowPerPage;
											$selCountRcv = "select *, date_format(created_at, '%b %e, %Y [ %H:%i:%s ]') as date_receive from emergency_recipients where remarks is not null and remarks != 'a:no' and date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by created_at limit " . $limit . "," . $rowPerPage;
											$rsRcv = mysqli_query($mysqli, $selCountRcv);

											while($rcv = mysqli_fetch_assoc($rsRcv)):
										?>
										<tr>
											<td><?php echo $rcv['batch_id'] ?></td>
											<td><?php echo $rcv['remarks'] ?></td>
											<td><?php echo $rcv['recipient'] ?></td>
											<td><?php echo $rcv['date_receive'] ?></td>
										</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
						</div>
					</div>
					<div class="pagebreak"></div>
				<?php endfor; ?>

				<?php
					$pageUnk = intval($cntUnk) == 0 ? 1 : ceil(intval($cntUnk) / intval($rowPerPage));
					for($x = 1; $x <= $pageUnk; $x++):
				?>
				
					<div class="per-page">
						<?php if ($x == 1): ?>
							<div class="text-center">
								<h2 class="mb-5"><?php echo 'Unknown Response Message Report' ?></h2>
								<div class="mb-20"><?php echo date('M j, Y',strtotime($_GET['startdate'])) . '  -  ' . date('M j, Y',strtotime($_GET['enddate'])) ?></div>
							</div>
						<?php endif; ?>
						<div class="col-sm-12">
								<table class="table">
									<thead>
										<tr>
											<th>Batch ID</th>
											<th>Reply Message</th>
											<th>Sender Number</th>
											<th>Date Receive</th>
										</tr>
									</thead>
									<tbody style="color: #333">
										<?php
											$limit = ($x - 1) * $rowPerPage;
											$selCountRcv = "select *, date_format(created_at, '%b %e, %Y [ %H:%i:%s ]') as date_receive from unknown_responses where date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by created_at limit " . $limit . "," . $rowPerPage;
											$rsRcv = mysqli_query($mysqli, $selCountRcv);

											while($rcv = mysqli_fetch_assoc($rsRcv)):
										?>
										<tr>
											<td><?php echo $rcv['referring_batch_id'] ?></td>
											<td><?php echo $rcv['message'] ?></td>
											<td><?php echo $rcv['sender'] ?></td>
											<td><?php echo $rcv['date_receive'] ?></td>
										</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
						</div>
					</div>
					<div class="pagebreak"></div>
				<?php endfor; ?>
			<?php endif; ?>
			</div>
		</body>
</html>