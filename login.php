<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	if (isset($_SESSION['authId'])) {
		header("Location: /admin/index.php");
	}

	$errorMessage = '';
	if ($_POST){
		if (checkLogin($_POST['tb-username'], $_POST['tb-password'])){
			header("Location: ./");
		} else {
			$username = $_POST['tb-username'];
			$checkCredentials = "select * from users where email_address = '" . $username . "' or username = '" . $username . "' or ip_address = '" . getClientIp() . "' limit 1";
			$rsCredentials = mysqli_query($mysqli, $checkCredentials);
			$rowCredentials = mysqli_fetch_assoc($rsCredentials);

			if (!empty($rowCredentials)) {
				if ($rowCredentials['disable_login_failure'] == 0) {
					if ($rowCredentials['failed_login_attempt'] < 2) {
						$upUsers = "update users set failed_login_attempt = (failed_login_attempt + 1), failed_login_time = NOW() where id = " . $rowCredentials['id'];
						$rsUpUsers = mysqli_query($mysqli, $upUsers);

						if ($rsUpUsers !== false) {
							$errorMessage = "You are not authenticated. You only have " . (2 - intval($rowCredentials['failed_login_attempt'])) . " login attempt.";
						}
					} else {
						$upUsers = "update users set status_id = 2 where id = " . $rowCredentials['id'];
						$rsUpUsers = mysqli_query($mysqli, $upUsers);

						if ($rsUpUsers !== false) {
							$errorMessage = "Your account is already locked. Please <a href='contact.php' style='text-decoration: underline;cursor: pointer;'>contact</a> the administrator.";
						}
					}	
				} else {
					$errorMessage = "You are not authenticated.";
				}
			} else {
				if (sendEmail()) {
					$errorMessage = "You are trying to force to login. Please sign-up.";
				}
			}
		}
	}
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
		
		<!-- vector map CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
		<link href="dist/css/custom.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<!-- <div class="preloader-it">
			<div class="la-anim-1"></div>
		</div> -->
		<div class="preloader" style="display: none"></div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.html">
						<img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
						<span class="brand-text" style="text-transform:none">iNnounce</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Don't have an account?</span>
					<a class="inline-block btn btn-info btn-rounded btn-outline" href="signup.php">Sign Up</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign in to iNnounce</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form action="#" method="post">
												<?php if($errorMessage != ''){?>
													<div class="form-group">
														<div class="alert alert-danger alert-dismissable">
															<?=$errorMessage;?>
														</div>
													</div>
												<?php } ?>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Username/Email address</label>
													<input type="text" class="form-control" name="tb-username" required="" id="exampleInputEmail_2" placeholder="Enter username/Email address">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
													<a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="forgot-password.php">forgot password ?</a>
													<div class="clearfix"></div>
													<input type="password" class="form-control" name="tb-password" required="" id="exampleInputpwd_2" placeholder="Enter password">
												</div>
												
												<!-- <div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="checkbox_2" required="" type="checkbox">
														<label for="checkbox_2"> Keep me logged in</label>
													</div>
													<div class="clearfix"></div>
												</div> -->
												<div class="form-group text-center">
													<button type="submit" name="btn-submit" class="btn btn-info btn-rounded">sign in</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>

		<script src="dist/js/custom.js"></script>
	</body>
</html>
