<?php
	include "include/configurations.php";
	include "include/general_functions.php";
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
										<!-- <div class="sp-logo-wrap text-center pa-0 mb-30">
											<a href="index.html">
												<img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
												<span class="brand-text">doodle</span>
											</a>
										</div> -->
										<!-- <div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Need help with your password?</h3>
										</div>	 -->
										<!-- <div class="form-wrap">
											<form action="#">
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
													<input type="email" class="form-control" required="" id="exampleInputEmail_2" placeholder="Enter email">
												</div>
												
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">Reset</button>
												</div>
											</form>
										</div> -->

										<div class="panel panel-default border-panel card-view" id="panel-send-code">
											<div class="panel-heading">
												<div class="text-center">
													<h6 class="panel-title txt-dark">Need help with your password?</h6>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="panel-wrapper">
												<div class="panel-body">
													<div class="form-group" id="alert-message">
														<!-- <div class="alert alert-success hidden" id="alert-message"></div> -->
													</div>
													<div class="form-group">
														<label class="text-center control-label mb-10" style="text-transform: none" for="email-address">Enter email address</label>
														<input type="email" class="form-control" required="" id="email-address" placeholder="Email Address">
													</div>
													<div class="form-group">
														<label class="control-label mb-10 col-sm-12 text-left" style="padding: 0; text-transform: none" for="tb-password">Choose on how you want to recovery your password:</label>
														<div class="radio radio-info col-sm-6">
															<input name="radio" id="radio1" value="via-sms" checked="" type="radio">
															<label for="radio1">
																Via One-Time Password
															</label>
														</div>
														<div class="radio radio-info col-sm-6" style="margin-top: 0">
															<input name="radio" id="radio2" value="via-email" type="radio">
															<label for="radio2">
																Via Secret Question
															</label>
														</div>
														<div class="clearfix"></div>
													</div>
													<div class="form-group hidden" id="panel-sms">
														<label class="text-center control-label mb-10" style="text-transform: none" for="mobile-number">Verify mobile number</label>
														<input type="text" class="form-control" required="" id="mobile-number" placeholder="Mobile Number">
													</div>
													<div class="hidden" id="panel-secret">
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
													</div>
												</div>
											</div>
											<div class="panel-wrapper">
												<div class="form-group text-center">
													<button type="button" id="btn-send" class="btn btn-info btn-rounded">Send</button>
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
							data: { action: "recoverpass-sms", email: $("#email-address").val(), mobile: $("#mobile-number").val() },
							success: function(response){
								console.log(response);
								var result = jQuery.parseJSON(response);
								console.log(result["status"]);

								$("#alert-message").html('');
								if (result["status"] == 'true') {
									$("#alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
									setTimeout(function(){
										window.location.href = 'login.php';
									},1500);
								} else {
									$("#alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
								}
								$(".preloader").hide();
							}
						});
					} else if ($("#radio2").is(':checked')) {
						$(".preloader").show();
						$.ajax({
							url: "include/send_email.php",
							type: "post",
							data: { action: "recoverpass-email", email: $("#email-address").val(), secretQuestion: $("#sel-secret-question").val(), answer: $("#tb-answer").val() },
							success: function(response){
								var result = jQuery.parseJSON(response);
								console.log(result["status"]);

								$("#alert-message").html('');
								if (result["status"] == 'true') {
									$("#alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
									setTimeout(function(){
										window.location.href = 'login.php';
									},1500);
								} else {
									$("#alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
								}
								$(".preloader").hide();
							}
						});
					}
				});
			});

			function checkRadio() {
				if ($("#radio1").is(':checked')) {
					if ($("#panel-sms").hasClass('hidden')) {
						$("#panel-sms").removeClass('hidden');
						$("#panel-secret").addClass('hidden');
					}
				}
				if ($("#radio2").is(':checked')) {
					if ($("#panel-secret").hasClass('hidden')) {
						$("#panel-secret").removeClass('hidden');
						$("#panel-sms").addClass('hidden');
					}
				}
			}
		</script>
	</body>
</html>
