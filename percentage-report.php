<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	if(!isset($_COOKIE['authId']) || empty($_COOKIE['authId']) || $_COOKIE['userType'] != 1){
		header("Location: login.php");
		exit;
	}

	$userId = $_COOKIE['authId'];
	$checkPasswordDate = "select * from users where id = " . $userId . " and DATE(password_expiry_date) = DATE(NOW())";
	$rsPasswordDate = mysqli_query($mysqli, $checkPasswordDate);
	$cntPasswordDate = mysqli_num_rows($rsPasswordDate);

	// $checkLogs = "select * from login_logs inner join users on users.id = login_logs.user_id where login_logs.user_id = " . $userId . " and login_logs.status_id = 1 and users.password_type_id = 1";
	// $rsLogs = mysqli_query($mysqli, $checkLogs);
	// $rowLogs = mysqli_num_rows($rsLogs);

	// $checkLastLogin = "select * from login_logs where user_id = " . $userId . " order by created_at desc limit 1,1";
	// $rsLastLogin = mysqli_query($mysqli, $checkLastLogin);
	// $rowLastLogin = mysqli_fetch_assoc($rsLastLogin);

	$selUser = "select * from users inner join user_infos on users.id = user_infos.user_id where users.id = " . $userId;
	$rsUser = mysqli_query($mysqli, $selUser);
	$rowUser = mysqli_fetch_assoc($rsUser);

	$startdate = date('Y-m-d',strtotime($_GET['startdate']));
	$enddate = date('Y-m-d',strtotime($_GET['enddate']));
	$selSent = "select count(id) as cnt from sent_messages where date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'";
	$rsSent = mysqli_query($mysqli, $selSent);
	$rowSent = mysqli_fetch_assoc($rsSent);

	$selRes = "select count(id) as cnt from response_messages where date_format(created_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'";
	$rsRes = mysqli_query($mysqli, $selRes);
	$rowRes = mysqli_fetch_assoc($rsRes);

	$selEmg = "select count(id) as cnt from emergency_recipients where date_format(updated_at, '%Y-%m-%d') between '" . $startdate . "' and '" . $enddate . "'";
	$rsEmg = mysqli_query($mysqli, $selEmg);
	$rowEmg = mysqli_fetch_assoc($rsRes);

	$totalReplied = intval($rowRes['cnt']) + intval($rowEmg['cnt']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partial/_head.php'); ?>
</head>

<body>
	<!-- Preloader -->
	<div class="preloader" style="display: none"></div>
	<!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-red">
		<!-- Top Menu Items -->
		<?php include('partial/_header.php'); ?>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<?php include('_left-side-bar.php'); ?>
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				
				<!-- Row -->
				<?php include('partial/_access.php') ?>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Percentage Report from <?php echo date('M j, Y',strtotime($_GET['startdate'])) ?> to <?php echo date('M j, Y',strtotime($_GET['enddate'])) ?></h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-6 col-sm-12 col-md-offset-3 mb-20">
											<div class="flot-container" style="height:250px">
												<div id="flot_pie_chart" class="demo-placeholder"></div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
			</div>
			
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>2017 &copy; Doodle. Pampered by Hencework</p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    <!-- MODAL -->
    <?php include('partial/_modals.php'); ?>

	
	<!-- <button data-toggle="modal" data-target="#responsive-modal" class="model_img img-responsive hidden" id="btn-modal">modal<button> -->
	
	<!-- JavaScript -->
	<?php include('partial/_js.php'); ?>

	<script src="vendors/bower_components/Flot/excanvas.min.js"></script>
	<script src="vendors/bower_components/Flot/jquery.flot.js"></script>
	<script src="vendors/bower_components/Flot/jquery.flot.pie.js"></script>
	<script src="vendors/bower_components/Flot/jquery.flot.resize.js"></script>
	<script src="vendors/bower_components/Flot/jquery.flot.time.js"></script>
	<script src="vendors/bower_components/Flot/jquery.flot.stack.js"></script>
	<script src="vendors/bower_components/Flot/jquery.flot.crosshair.js"></script>
	<script src="vendors/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>


	<!--<script src="dist/js/dashboard-data.js"></script>-->
	<script type="text/javascript">
		$(document).ready(function(){
			keyNumber();

			if( $('#flot_pie_chart').length > 0 ){
				var pie_data = [{
					label: "Sent",
					data: <?php echo $rowSent['cnt'] ?>,
					color: "#469408",
					
				}, {
					label: "Replied",
					data: <?php echo $totalReplied ?>,
					color: "#dc4666",
				}, {
					label: "Not Sent",
					data: 0,
					color:"#177ec1",
				}];

				var pie_op = {
					series: {
						pie: {
							show: true
						}
					},
					legend : {
						backgroundColor: 'transparent',
					},
					grid: {
						hoverable: true
					},
					color: null,
					tooltip: true,
					tooltipOpts: {
						content: "%p.0% (%y.0)", // show percentages, rounding to 2 decimal places
						shifts: {
							x: 20,
							y: 0
						},
						defaultTheme: false
					},
				};
				$.plot($("#flot_pie_chart"), pie_data, pie_op);
			}
		});
		function checkPassword() {
			var pwd = $("#tb-password").val();
			var sc = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
			var num = /[1234567890]/;
			var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
			var error = '';
			var cntError = 0;

			if (pwd.length < 8) {
				error += '&bull; Must at least eight (8) characters long.<br/>';
				cntError += 1;
			}

			if (sc.test(pwd) == false || num.test(pwd) == false) {
				error += '&bull; Must have at least one(1) numeric and special character.<br/>';
				cntError += 1;
			}

			if (capital.test(pwd) == false) {
				error += '&bull; Must have at least one(1) capital letter.<br/>';
				cntError += 1;
			}

			if (cntError > 0) {
				$("#tb-password").css('border-color', 'rgb(204,0,0)');
				$("#panel-error").html(error);
				$("#panel-error").removeClass("hidden");
				return 0;
			} else {
				//$("#tb-password").addClass("passed");
				$("#tb-password").css('border-color', 'rgb(0,128,0)')
				setTimeout(function(){
					$("#tb-password").css('border-color', 'rgba(33, 33, 33, 0.12)');
				},1000);
				$("#panel-error").html('');
				$("#panel-error").addClass("hidden");
				return 1;
			}
		}
	</script>
	<?php include('_common-js.php'); ?>
</body>

</html>
