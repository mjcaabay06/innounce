<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	if(!isset($_SESSION['authId']) || empty($_SESSION['authId'])){
		header("Location: login.php");
		exit;
	}

	$startdate = date('Y-m-d',strtotime($_GET['startdate']));
	$enddate = date('Y-m-d',strtotime($_GET['enddate']));
	
	$table = $_GET['type'] == 'login' ? 'login_logs' : 'logout_logs';
	$selCountLogin = "select * from " . $table . " as l where date_format(l.created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by l.created_at";
	$rsCountLogin = mysqli_query($mysqli, $selCountLogin);
	$numCountLogin = mysqli_num_rows($rsCountLogin);
	$rowPerPage = 10;
	$pageCount = intval($numCountLogin) == 0 ? 1 : ceil(intval($numCountLogin) / intval($rowPerPage));
	
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
	<body>
		<body onload=""  style="background-color: #525659;margin: 30px;">
			<div class="container-fluid">
			<?php for($x = 1; $x <= $pageCount; $x++): ?>

				<div class="per-page">
					<div class="text-center">
						<h1 class="mb-10"><?php echo $_GET['type'] == 'login' ? 'Login Report' : 'Logout Report' ?></h1>
						<div class="mb-20"><?php echo date('M j, Y',strtotime($_GET['startdate'])) . '  -  ' . date('M j, Y',strtotime($_GET['enddate'])) ?></div>
					</div>
					<div class="col-sm-12">
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>User Type</th>
									<th>IP Address</th>
									<th>Remarks</th>
									<th>Login Date</th>
								</tr>
							</thead>
							<tbody style="color: #333">
								<?php
									$limit = ($x - 1) * $rowPerPage;
									$selLogin = "select user_infos.*,user_types.type, l.*, date_format(l.created_at, '%b %e, %Y [ %H:%i:%s ]') as login_date from " . $table . " as l left join (users inner join user_infos on user_infos.user_id = users.id inner join user_types on user_types.id = users.user_type_id) on users.id = l.user_id where date_format(l.created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'  order by l.created_at limit " . $limit . "," . $rowPerPage;
									$rsLogin = mysqli_query($mysqli, $selLogin);

									while($user = mysqli_fetch_assoc($rsLogin)):
								?>
								<tr>
									<td><?php echo $user['user_id'] ? $user['last_name'] . ', ' . $user['first_name'] : 'Anonymous' ?></td>
									<td><?php echo $user['user_id'] ? $user['type'] : 'Anonymous' ?></td>
									<td><?php echo $user['ip_address'] ?></td>
									<td><?php echo $user['remarks'] ?></td>
									<td><?php echo $user['login_date'] ?></td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="pagebreak"></div>

			<?php endfor; ?>
			</div>
		</body>
	</body>
</html>