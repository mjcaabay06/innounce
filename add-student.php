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

	// $checkLogs = "select * from login_logs inner join users on users.id = login_logs.user_id where login_logs.user_id = " . $userId . " and login_logs.status_id = 1 and users.password_type_id = 1";
	// $rsLogs = mysqli_query($mysqli, $checkLogs);
	// $rowLogs = mysqli_num_rows($rsLogs);

	// $checkLastLogin = "select * from login_logs where user_id = " . $userId . " order by created_at desc limit 1,1";
	// $rsLastLogin = mysqli_query($mysqli, $checkLastLogin);
	// $rowLastLogin = mysqli_fetch_assoc($rsLastLogin);

	$selUser = "select * from users inner join user_infos on users.id = user_infos.user_id where users.id = " . $userId;
	$rsUser = mysqli_query($mysqli, $selUser);
	$rowUser = mysqli_fetch_assoc($rsUser);
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
    <?php include('partial/_modals.php'); ?>

	
	<!-- <button data-toggle="modal" data-target="#responsive-modal" class="model_img img-responsive hidden" id="btn-modal">modal<button> -->
	
	<!-- JavaScript -->
	<?php include('partial/_js.php'); ?>


	<!--<script src="dist/js/dashboard-data.js"></script>-->
	<script type="text/javascript">
		$(document).ready(function(){
			keyNumber();
			

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
