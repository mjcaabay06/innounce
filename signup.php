<?php
	include "include/configurations.php";
	include "include/general_functions.php";
?>
<?php
	session_start();
	if (isset($_POST['hidden-identifier'])) {
		$passwordType = $_POST['radio'] == 'sys-gen' ? 1 : 2;
		$password = $passwordType == 1 ? randomPassword() : $_POST['tb-password'] ;

		$insertUser = "
			INSERT INTO
				`users`
			(
				`email_address`,
				`username`,
				`password`,
				`secret_question_id`,
				`answer`,
				`user_type_id`,
				`status_id`,
				`password_type_id`,
				`password_expiry_date`,
				`ip_address`,
				`failed_login_attempt`,
				`disable_login_failure`
			)
			VALUES
			(
				'" . mysqli_real_escape_string($mysqli, $_POST['tb-email']) . "',
				'" . mysqli_real_escape_string($mysqli, $_POST['tb-username']) . "',
				'" . mysqli_real_escape_string($mysqli, $password) . "',
				'" . mysqli_real_escape_string($mysqli, $_POST['sel-secret-question']) . "',
				'" . mysqli_real_escape_string($mysqli, $_POST['tb-answer']) . "',
				2,
				2,
				" . mysqli_real_escape_string($mysqli, $passwordType) . ",
				(NOW() + INTERVAL 30 DAY),
				'" . mysqli_real_escape_string($mysqli, getClientIp()) . "',
				0,
				0
			)
		";
		$rsUser = mysqli_query($mysqli, $insertUser);

		if ($rsUser !== false) {
			$userId = mysqli_insert_id($mysqli);

			$insertUserInfo = "
				INSERT INTO
					`user_infos`
				(
					`user_id`,
					`first_name`,
					`middle_name`,
					`last_name`,
					`mobile_number`
				)
				VALUES
				(
					'" . mysqli_real_escape_string($mysqli, $userId) . "',
					'" . mysqli_real_escape_string($mysqli, $_POST['tb-firstname']) . "',
					'" . mysqli_real_escape_string($mysqli, $_POST['tb-middlename']) . "',
					'" . mysqli_real_escape_string($mysqli, $_POST['tb-lastname']) . "',
					'" . mysqli_real_escape_string($mysqli, $_POST['tb-mobile']) . "'
				)
			";
			$rsUserInfo = mysqli_query($mysqli, $insertUserInfo);

			if ($rsUserInfo !== false){
				$_SESSION['tempId'] = $userId;
				$_SESSION['mobile'] = $_POST['tb-mobile'];
				$_SESSION['email'] = $_POST['tb-email'];
				$_SESSION['password'] = $password;
				header("Location: verify.php");
			} else {
				echo mysqli_error($mysqli);die();
			}
		} else {
			echo mysqli_error($mysqli);die();
		}
	} else {
		include "src/Captcha/simple-php-captcha.php";
		$_SESSION['captcha'] = simple_php_captcha();
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
		<style type="text/css">
			.passed{
				border-color: rgb(0,128,0)
			}
			.error{
				border-color: rgb(204,0,0)
			}
		</style>
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
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
					<span class="inline-block pr-10">Already have an account?</span>
					<a class="inline-block btn btn-info btn-rounded btn-outline" href="login.php">Sign In</a>
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
											<h3 class="text-center txt-dark mb-10">Sign up to iNnounce</h3>
											<!-- <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6> -->
										</div>	
										<div class="form-wrap">
											<form action="" id="form-sign-up" method="post">
												<input type="hidden" name="hidden-identifier" value="1" />
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
																<div style="color: #cc0000; display: none" id="error">&bull; Email Address already exist.</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10" for="tb-mobile">Mobile Number</label>
																<input type="text" class="form-control" required="" name="tb-mobile" id="tb-mobile" placeholder="Mobile Number">
															</div>
														</div>
													</div>
												</div>

												<div class="panel panel-default border-panel card-view">
													<div class="panel-heading">
														<div class="text-center">
															<h6 class="panel-title txt-dark">Account Details</h6>
														</div>
														<div class="clearfix"></div>
													</div>
													<div class="panel-wrapper">
														<div class="panel-body">
															<div class="form-group" id="div-username">
																<label class="control-label mb-10" for="tb-username">Username</label>
																<input type="text" class="form-control" required="" name="tb-username" id="tb-username" placeholder="Username">
																<div style="color: #cc0000; display: none" id="error">&bull; Username already exist.</div>
															</div>
															<div class="form-group">
																<label class="control-label mb-10 col-sm-12 text-left" style="padding: 0;" for="tb-password">Choose Password:</label>
																<div class="radio radio-info col-sm-6">
																	<input name="radio" id="radio1" value="sys-gen" checked="" type="radio">
																	<label for="radio1">
																		System Generated
																	</label>
																</div>
																<div class="radio radio-info col-sm-6" style="margin-top: 0">
																	<input name="radio" id="radio2" value="manual" type="radio">
																	<label for="radio2">
																		Manual Input
																	</label>
																</div>
																<div style="clear:both"></div>
															</div>
															<div id="panel-password" class="hidden">
																<div class="form-group">
																	<label class="pull-left control-label mb-10" for="tb-password">Password</label>
																	<input type="password" class="form-control" name="tb-password" id="tb-password" placeholder="Password">
																	<div style="color: #cc0000; display: none" id="panel-error"></div>
																</div>
																<div class="form-group">
																	<label class="pull-left control-label mb-10" for="tb-confirm-password">Confirm Password</label>
																	<input type="password" class="form-control" id="tb-confirm-password" placeholder="Confirm Password">
																	<div style="color: #cc0000; display: none" id="panel-not-match">&bull; Password do not match.</div>
																</div>
															</div>

															<div class="form-group">
																<label class="control-label mb-10" for="sel-secret-question">Secret Question</label>
																<select class="form-control" name="sel-secret-question" id="sel-secret-question">
																	<?php
																		$selectSecretQuestion = "Select * From secret_questions";
																		$rsSecretQuestion = mysqli_query($mysqli, $selectSecretQuestion);

																		while($sq = mysqli_fetch_assoc($rsSecretQuestion)):
																	?>
																		<option value="<?php echo $sq['id'] ?>"><?php echo $sq['question'] ?></option>
																	<?php endwhile; ?>
																</select><br/>
																<input type="text" class="form-control" required="" name="tb-answer" id="tb-answer" placeholder="Your answer">
															</div>

															<div class="form-group">
																<label class="control-label mb-10" for="img-captcha">Captcha</label>
																<br/>
																<input type="hidden" name="tb-hidden-captcha" value="<?php echo $_SESSION['captcha']['code'] ?>">
																<img src="<?php echo $_SESSION['captcha']['image_src'] ?>" id="img-captcha" >
																<input type="text" class="form-control" required="" name="tb-captcha" id="tb-captcha" placeholder="Enter captcha code">
																<div style="color: #cc0000; display: none" id="panel-captcha-error">Captcha failed. Please enter captcha code again.</div>
															</div>
														</div>
													</div>
												</div>
												

												<!-- <div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="checkbox_2" required="" type="checkbox">
														<label for="checkbox_2"> I agree to all <span class="txt-primary">Terms</span></label>
													</div>
													<div class="clearfix"></div>
												</div> -->
												<div class="form-group text-center">
													<button type="button" id="btn-submit" class="btn btn-info btn-rounded">Sign Up</button>
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
		<script type="text/javascript">
			$(document).ready(function(){

				$("#radio1").on('click', function(){
					if (!$("#panel-password").hasClass('hidden')) {
						$("#panel-password").addClass('hidden');
					}
				});
				$("#radio2").on('click', function(){
					if ($("#panel-password").hasClass('hidden')) {
						$("#panel-password").removeClass('hidden');
					}
				});

				// $("#tb-email").keyup(function(){
				// 	if ($(this).val().length > 5) {
				// 		$.ajax({
				// 			url: 'include/functions.php',
				// 			type: 'post',
				// 			data: { action: 'check-email', email: $(this).val() },
				// 			success: function(response){
				// 				var result = jQuery.parseJSON(response);
				// 				if (result['status']){
				// 					$("#div-email").addClass('has-error');
				// 					$("#div-email #error").show();
				// 				} else {
				// 					$("#div-email").removeClass('has-error');
				// 					$("#div-email #error").hide();
				// 				}
				// 			}
				// 		});
				// 	}
				// });
				$("#tb-email").focusout(function(){
					if ($(this).val().length > 5) {
						$.ajax({
							url: 'include/functions.php',
							type: 'post',
							data: { action: 'check-email', email: $(this).val() },
							success: function(response){
								var result = jQuery.parseJSON(response);
								if (result['status']){
									$("#div-email").addClass('has-error');
									$("#div-email #error").show();
								} else {
									$("#div-email").removeClass('has-error');
									$("#div-email #error").hide();
								}
							}
						});
					}
				});
				$("#tb-username").focusout(function(){
					if ($(this).val().length > 3) {
						$.ajax({
							url: 'include/functions.php',
							type: 'post',
							data: { action: 'check-username', username: $(this).val() },
							success: function(response){
								var result = jQuery.parseJSON(response);
								if (result['status']){
									$("#div-username").addClass('has-error');
									$("#div-username #error").show();
								} else {
									$("#div-username").removeClass('has-error');
									$("#div-username #error").hide();
								}
							}
						});	
					}
				});
				$("#tb-password").focusout(function(){
					checkPassword();
				});
				$("#tb-confirm-password").focusout(function(){
					checkPassword();
				});
				$("#tb-captcha").focusout(function(){
					if ($('input[name="tb-hidden-captcha"]').val().toLowerCase() != $('input[name="tb-captcha"]').val().toLowerCase()){
						$("#tb-captcha").parent().addClass('has-error');
						$("#panel-captcha-error").show();
					} else {
						$("#tb-captcha").parent().removeClass('has-error');
						$("#panel-captcha-error").hide();
					}
				});

				$("#btn-submit").on("click", function(){
					var errorCount = 0;

					$(".has-error").each(function(){
						errorCount++;
					});

					if (!errorCount > 0) {
						$("#form-sign-up").submit();
					}
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
					$("#tb-password").parent().addClass('has-error');
					$("#panel-error").html(error);
					$("#panel-error").show();
				} else {
					$("#tb-password").parent().removeClass('has-error');
					$("#panel-error").html('');
					$("#panel-error").hide();
				}
			}

			function confirmPassword() {
				var pwd = $("#tb-password").val();
				var conpwd = $("#tb-confirm-password").val();
				var error = true;

				if (pwd != conpwd) {
					$("#tb-confirm-password").parent().addClass('has-error');
					$("#panel-not-match").show();
				} else {
					$("#tb-confirm-password").parent().removeClass('has-error');
					$("#panel-not-match").hide();
				}
			}
		</script>
	</body>
</html>
