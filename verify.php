<?php
	session_start();
	if(!isset($_SESSION['tempId']) || empty($_SESSION['tempId'])){
		header("Location: login.php");
		exit;
	}else{
		// include('../include/configuration.php');

		// if ($_POST['btn-submit']) {
		// 	$insertProduct = $dbh->prepare("insert into product_categories(category_name, created_at, updated_at, user_id) values(:category_name, NOW(), NOW(), :user_id)");
		// 	$insertProduct->execute(array(
		// 			':category_name' => $_REQUEST['category_name'],
		// 			':user_id' => $_COOKIE['authId'],
		// 		));
		// 	header("Location: list-category.php");
		// }

		include "include/configurations.php";
		include "include/general_functions.php";
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
				<!-- <div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Don't have an account?</span>
					<a class="inline-block btn btn-info btn-rounded btn-outline" href="signup.html">Sign Up</a>
				</div> -->
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
										<div class="panel panel-default border-panel card-view" id="panel-send-code">
											<div class="panel-heading">
												<div class="text-center">
													<h6 class="panel-title txt-dark">Activate your account.</h6>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="panel-wrapper">
												<div class="panel-body">
													<div class="form-group">
														<div class="alert alert-success hidden" id="alert-success">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 col-sm-12 text-left" style="padding: 0; text-transform: none" for="tb-password">Choose where you want to send your account code:</label>
														<div class="radio radio-info col-sm-6">
															<input name="radio" id="radio1" value="via-sms" checked="" type="radio">
															<label for="radio1">
																Via SMS
															</label>
														</div>
														<div class="radio radio-info col-sm-6" style="margin-top: 0">
															<input name="radio" id="radio2" value="via-email" type="radio"">
															<label for="radio2">
																Via Email Address
															</label>
														</div>
														<div class="clearfix"></div>
													</div>
													<div class="form-group hidden" id="panel-sms">
														<label class="text-center control-label mb-10" style="text-transform: none" for="mobile-number">Verify mobile number</label>
														<input type="text" class="form-control" required="" id="mobile-number" placeholder="Mobile Number" value="<?php echo isset($_SESSION['mobile']) ? $_SESSION['mobile'] : '' ?>">
													</div>
													<div class="form-group hidden" id="panel-email">
														<label class="text-center control-label mb-10" style="text-transform: none" for="email-address">Verify email address</label>
														<input type="email" class="form-control" required="" id="email-address" placeholder="Email Address" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>">
													</div>
												</div>
											</div>
											<div class="panel-wrapper">
												<div class="form-group text-center">
													<button type="button" id="btn-send" class="btn btn-info btn-rounded">Send</button>
												</div>
											</div>
										</div>

										<div class="panel panel-default border-panel card-view hidden" id="panel-activate">
											<div class="panel-heading">
												<div class="text-center">
													<h6 class="panel-title txt-dark">Activate your account.</h6>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="panel-wrapper">
												<div class="panel-body">
													<div class="form-group">
														<div class="alert alert-success hidden" id="alert-activate-success">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 col-sm-12 text-left" style="padding: 0; text-transform: none" for="tb-password">Enter your activation code here:</label>
														<div class="col-sm-2" style="padding: 0 10px">
															<input type="text" class="form-control text-center ac-num" maxlength="1" style="font-size: 20px;" >
														</div>
														<div class="col-sm-2" style="padding: 0 10px">
															<input type="text" class="form-control text-center ac-num" maxlength="1" style="font-size: 20px;" >
														</div>
														<div class="col-sm-2" style="padding: 0 10px">
															<input type="text" class="form-control text-center ac-num" maxlength="1" style="font-size: 20px;" >
														</div>
														<div class="col-sm-2" style="padding: 0 10px">
															<input type="text" class="form-control text-center ac-num" maxlength="1" style="font-size: 20px;" >
														</div>
														<div class="col-sm-2" style="padding: 0 10px">
															<input type="text" class="form-control text-center ac-num" maxlength="1" style="font-size: 20px;" >
														</div>
														<div class="col-sm-2" style="padding: 0 10px">
															<input type="text" class="form-control text-center ac-num" maxlength="1" style="font-size: 20px;" >
														</div>
													</div>
												</div>
											</div>
											<div class="panel-wrapper">
												<div class="form-group text-center">
													<button type="button" id="btn-activate" class="btn btn-info btn-rounded">Activate</button>
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
		<script type="text/javascript">
			$(document).ready(function(){
				checkRadio();
				$('input[name="radio"]').on("change", function(){
					checkRadio();
				});

				$("#btn-send").on("click", function(){
					if ($("#radio1").is(':checked')) {
						$(".preloader").show();
						$.ajax({
							url: "include/send_sms.php",
							type: "post",
							data: { action: "activation-sendsms", mobile: $("#mobile-number").val(), userId: <?php echo $_SESSION['tempId'] ?>, userpass: "<?php echo $_SESSION['password'] ?>" },
							success: function(response){
								$("#alert-success").removeClass('hidden');
								$("#alert-success").html(response);

								setTimeout(function(){
									if (!$("#panel-send-code").hasClass('hidden')) {
										$("#panel-send-code").addClass('hidden');
										$("#panel-activate").removeClass('hidden');
									}
									$("#alert-success").addClass('hidden');
									$("#alert-success").html('');
								},1000);
								$(".preloader").hide();
							}
						});
					} else if ($("#radio2").is(':checked')) {
						$(".preloader").show();
						$.ajax({
							url: "include/send_email.php",
							type: "post",
							data: { action: "activation-sendemail", email: $("#email-address").val(), userId: <?php echo $_SESSION['tempId'] ?>, userpass: "<?php echo $_SESSION['password'] ?>" },
							success: function(response){
							console.log(response);
								$("#alert-success").removeClass('hidden');
								$("#alert-success").html(response);
								setTimeout(function(){
									if (!$("#panel-send-code").hasClass('hidden')) {
										$("#panel-send-code").addClass('hidden');
										$("#panel-activate").removeClass('hidden');
									}
									$("#alert-success").addClass('hidden');
									$("#alert-success").html('');
								},1000);
								$(".preloader").hide();
							}
						});
					}
					
				});
				$("#btn-activate").on("click", function(){
					var acnum = '';
					$(".ac-num").each(function(){
						acnum += $(this).val();
					});
					$.ajax({
						url: "include/send_email.php",
						type: "post",
						data: { action: "activate", code: acnum, userId: <?php echo $_SESSION['tempId'] ?> },
						success: function(response){
							$("#alert-activate-success").removeClass('hidden');
							$("#alert-activate-success").html(response);
							setTimeout(function(){
								$("#alert-activate-success").addClass('hidden');
								$("#alert-activate-success").html('');
								<?php session_destroy(); ?>
								window.location.href = 'login.php';
							},1000);
						}
					});
				});
			});

			function checkRadio() {
				if ($("#radio1").is(':checked')) {
					if ($("#panel-sms").hasClass('hidden')) {
						$("#panel-sms").removeClass('hidden');
						$("#panel-email").addClass('hidden');
					}
				}
				if ($("#radio2").is(':checked')) {
					if ($("#panel-email").hasClass('hidden')) {
						$("#panel-email").removeClass('hidden');
						$("#panel-sms").addClass('hidden');
					}
				}
			}
		</script>
	</body>
</html>
