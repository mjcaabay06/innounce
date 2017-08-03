<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	if(!isset($_SESSION['authId']) || empty($_SESSION['authId']) || $_SESSION['userType'] != 1){
		header("Location: login.php");
		exit;
	}

	$userId = $_SESSION['authId'];
	$checkPasswordDate = "select * from users where id = " . $userId . " and DATE(password_expiry_date) = DATE(NOW())";
	$rsPasswordDate = mysqli_query($mysqli, $checkPasswordDate);
	$cntPasswordDate = mysqli_num_rows($rsPasswordDate);

	$checkLogs = "select * from login_logs inner join users on users.id = login_logs.user_id where login_logs.user_id = " . $userId . " and login_logs.status_id = 1 and users.password_type_id = 1";
	$rsLogs = mysqli_query($mysqli, $checkLogs);
	$rowLogs = mysqli_num_rows($rsLogs);

	$checkLastLogin = "select * from login_logs where user_id = " . $userId . " order by created_at desc limit 1,1";
	$rsLastLogin = mysqli_query($mysqli, $checkLastLogin);
	$rowLastLogin = mysqli_fetch_assoc($rsLastLogin);

	$selUser = "select * from users inner join user_infos on users.id = user_infos.user_id where users.id = " . $userId;
	$rsUser = mysqli_query($mysqli, $selUser);
	$rowUser = mysqli_fetch_assoc($rsUser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>iNnounce</title>
	<meta name="description" content="Doodle is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Doodle Admin, Doodleadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Morris Charts CSS -->
    <link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
		
	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	<link href="dist/css/custom.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Preloader -->
	<div class="preloader" style="display: none"></div>
	<!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-red">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="index.html">
							<img class="brand-img" src="dist/img/logo.png" alt="brand"/>
							<span class="brand-text" style="text-transform:none">iNnounce</span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="dist/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="#" data-toggle="modal" data-target="#disableLoginFailure"><i class="zmdi zmdi-settings"></i><span>Disable Login Failure</span></a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="index.php"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
					<?php if ($_SESSION['userType'] == 1) : ?>
						<a class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#users_dr"><div class="pull-left"><i class="zmdi zmdi-accounts mr-20"></i><span class="right-nav-text">Users</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
						<ul id="users_dr" class="collapse collapse-level-1">
							<li>
								<a href="staffs.php">Staff</a>
							</li>
							<li>
								<a class="active-page" href="students.php">Students</a>
							</li>
						</ul>
					<?php endif; ?>
				</li>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				
				<!-- Row -->
				<div class="row">

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-red">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-9 text-center pl-0 pr-0 data-wrap-left" style="min-height: 79px">
													<span class="txt-light block font-13">
														<?php echo isset($rowUser) && $rowUser['last_access'] != '' ? 'Last Access ' . date('l, F j, Y', strtotime($rowUser['last_access'])) . '<br/>' . date('g:i:s A (e O)', strtotime($rowUser['last_access'])) : '' ?>
													</span>
												</div>
												<div class="col-xs-3 text-center  pl-0 pr-0 data-wrap-right" style="min-height: 79px">
													<i class="zmdi zmdi-power txt-light data-right-rep-icon" style="font-size: 40px"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-green">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-9 text-center pl-0 pr-0 data-wrap-left" style="min-height: 79px">
													<span class="txt-light block font-13">
														<?php echo isset($rowLastLogin) ? 'Last Login ' . date('l, F j, Y', strtotime($rowLastLogin['created_at'])) . '<br/>' . date('g:i:s A (e O)', strtotime($rowLastLogin['created_at'])) : '' ?>
													</span>
												</div>
												<div class="col-xs-3 text-center  pl-0 pr-0 data-wrap-right" style="min-height: 79px">
													<i class="zmdi zmdi-sign-in txt-light data-right-rep-icon" style="font-size: 40px"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="col-sm-12">
									<a href="staffs.php" class="pull-left" title="Back to staffs"><i class="zmdi zmdi-chevron-left" style="color: rgba(23, 126, 193, 0.85);font-weight: bold;font-size: 25px;margin-right: 10px;"></i></a>
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Add Student</h6>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<form action="" id="form-sign-up" method="post">
										<input type="hidden" name="hidden-identifier" value="1" />
										<div class="col-sm-12">
											<div id="add-alert-message"></div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="panel panel-default border-panel card-view">
												<div class="panel-heading">
													<div class="text-center">
														<h6 class="panel-title txt-dark">Personal Information</h6>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-wrapper">
													<div class="panel-body">
														<div class="form-group">
															<label class="control-label mb-10" for="tb-firstname">First Name</label>
															<input type="text" class="form-control" name="tb-firstname" required="" id="tb-firstname" placeholder="First Name">
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="tb-middlename">Middle Name</label>
															<input type="text" class="form-control" required="" name="tb-middlename" id="tb-middlename" placeholder="Middle Name">
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="tb-lastname">Last Name</label>
															<input type="text" class="form-control" required="" name="tb-lastname" id="tb-lastname" placeholder="Last Name">
														</div>
														<div class="form-group" id="div-email">
															<label class="control-label mb-10" for="tb-email">Email address</label>
															<input type="email" class="form-control" required="" name="tb-email" id="tb-email" placeholder="Email Address">
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="tb-mobile">Mobile Number</label>
															<input type="text" class="form-control" required="" name="tb-mobile" id="tb-mobile" placeholder="Mobile Number" maxlength="11">
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6 col-sm-12">
											<div class="panel panel-default border-panel card-view">
												<div class="panel-heading">
													<div class="text-center">
														<h6 class="panel-title txt-dark">School Information</h6>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-wrapper">
													<div class="panel-body">
														<div class="form-group">
															<label class="control-label mb-10" for="sel-course">Course</label>
															<select class="form-control" id="sel-course">
															</select>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="sel-section">Section</label>
															<select class="form-control" id="sel-section">
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group text-center">
											<button type="button" id="btn-save-add" class="btn btn-info btn-rounded">Save</button>
										</div>
									</form>
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
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
					<h5 class="modal-title">Change your password.</h5>
				</div>
				<div class="modal-body">
					<p class="control-label text-center" style="text-transform: none; margin-bottom: 5px;"><?php echo $cntPasswordDate > 0 ? 'Your password is already expired.' : 'Your current password is system generated.'; ?> Please change your password.</p>
					<form>
						<div class="form-group col-sm-6 col-sm-offset-3">
							<!-- <label for="tb-password" class="control-label mb-10">New Password:</label> -->
							<input type="password" class="form-control col-sm-6 text-center" id="tb-password" placeholder="Enter new password">
							<div class="hidden" style="color: #cc0000" id="panel-error"></div>
							<div class="clearfix"></div>
						</div>
						<!-- <div class="form-group">
							<label for="message-text" class="control-label mb-10">Message:</label>
							<textarea class="form-control" id="message-text"></textarea>
						</div> -->
					</form>
				</div>
				<div class="modal-footer" style="text-align: center">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
					<button type="button" id="btn-save" class="btn btn-danger">Save Password</button>
				</div>
			</div>
		</div>
	</div>

	<div id="disableLoginFailure" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="mySmallModalLabel">Disable login failure</h5>
				</div>
				<div class="modal-body text-center">
					<div class="form-group" id="panel-notif"></div>
					<div class="form-group">
						<input type="hidden" id="tb-disable-login" value="<?php echo $rowUser['disable_login_failure'] ?>">
						<button class="btn btn-rounded <?php echo $rowUser['disable_login_failure'] == 0 ? 'btn-success disabled' : 'btn-default btn-outline' ?>" id="btn-disable-off">Off</button>
						<button class="btn btn-rounded <?php echo $rowUser['disable_login_failure'] == 0 ? 'btn-default btn-outline' : 'btn-success disabled' ?>" id="btn-disable-on">On</button>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" id="btn-save-disable">Save</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	
	<!-- <button data-toggle="modal" data-target="#responsive-modal" class="model_img img-responsive hidden" id="btn-modal">modal<button> -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- simpleWeather JavaScript -->
	<script src="vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="dist/js/simpleweather-data.js"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- ChartJS JavaScript -->
	<script src="vendors/chart.js/Chart.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/custom.js"></script>
	<!--<script src="dist/js/dashboard-data.js"></script>-->
	<script type="text/javascript">
		$(document).ready(function(){
			keyNumber();
			<?php if($cntPasswordDate > 0 || $rowLogs == 1): ?>
				$("#responsive-modal").modal('show');
			<?php endif; ?>

			$("#tb-password").focusout(function(){
				checkPassword();
			});
			$("#btn-save").on("click", function(){
				if (checkPassword()) {
					$(".preloader").show();
					$.ajax({
						url: 'include/admin_functions.php',
						type: 'post',
						data: { action: 'change-password', pwd: $("#tb-password").val(), userId: <?php echo $_SESSION['authId'] ?>  },
						success: function(response){
							console.log(response);
							$("#responsive-modal").modal('hide');
							$(".preloader").hide();
						}
					});
				}
			});

			$("#btn-disable-off").on('click', function(){
				if (!$(this).hasClass('disabled')){
					$("#tb-disable-login").val(0);
					$(this).removeClass('btn-default btn-outline');
					$(this).addClass('btn-success disabled');

					$("#btn-disable-on").removeClass('btn-success disabled');
					$("#btn-disable-on").addClass('btn-default btn-outline');
				}
			});

			$("#btn-disable-on").on('click', function(){
				if (!$(this).hasClass('disabled')){
					$("#tb-disable-login").val(1);
					$(this).removeClass('btn-default btn-outline');
					$(this).addClass('btn-success disabled');

					$("#btn-disable-off").removeClass('btn-success disabled');
					$("#btn-disable-off").addClass('btn-default btn-outline');
				}
			});

			$("#btn-save-disable").on("click", function(){
				$(".preloader").show();
				$.ajax({
					url: 'include/admin_functions.php',
					type: 'post',
					data: { action: 'disable-login', val: $("#tb-disable-login").val(), userId: <?php echo $_SESSION['authId'] ?>  },
					success: function(response){
						console.log(response);
						$("#panel-notif").html(response);
						setTimeout(function(){
							$("#disableLoginFailure").modal('hide');
							$("#panel-notif").html('');
						},1000);
						$(".preloader").hide();
					}
				});
			});

			$("#btn-save-add").on('click', function(){
				var data = new Object();
				data.first_name = $("#tb-firstname").val();
				data.middle_name = $("#tb-middlename").val();
				data.last_name = $("#tb-lastname").val();
				data.email_address = $("#tb-email").val();
				data.mobile_number = $("#tb-mobile").val();
				data.course = $("#sel-course").val();
				data.section = $("#sel-section").val();

				$(".preloader").show();
				$.ajax({
					url: 'include/add_student.php',
					type: 'post',
					data: { action: 'post', params: data  },
					success: function(response){
						$(".preloader").hide();
						console.log(response);
						var result = $.parseJSON(response);
						console.log(result["status"]);

						if (result["status"] == 'success') {
							$("#add-alert-message").html('<div class="alert alert-success">You have successfully created a student.</div>');
							setTimeout(function(){
								window.location.href = 'students.php';
							},1500);
						} else {
							$("#add-alert-message").html('<div class="alert alert-danger">There was an error creating a student.</div>');
						}
						
					}
				});	
			});

			fetchCourse();
			$("#sel-course").on('change', function(){
				fetchSection($(this).val());
			});
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

		function fetchCourse() {
			$.ajax({
				url: 'include/admin_functions.php',
				type: 'post',
				data: { action: 'fetch-course' },
				success: function(response){
					var result = $.parseJSON(response);
					var html = '';

					for(var prod in result){
						html += '<option value="' + result[prod].id + '">' + result[prod].description + '</option>';
					}
					$('#sel-course').html(html);
					fetchSection($('#sel-course option:first').val());
				}
			});
		}

		function fetchSection(courseId) {
			var cid = courseId;

			$.ajax({
				url: 'include/admin_functions.php',
				type: 'post',
				data: { action: 'fetch-section', courseId: cid },
				success: function(response){
					var result = $.parseJSON(response);
					var html = '';

					for(var prod in result){
						html += '<option value="' + result[prod].id + '">' + result[prod].section + '</option>';
					}
					$('#sel-section').html(html);
					$('#sel-section').val($('#sel-section option:first').val());
				}
			});
		}
	</script>
	<?php include('_common-js.php'); ?>
</body>

</html>
