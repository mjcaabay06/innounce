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
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<form action="" id="form-sign-up" method="post">
										<input type="hidden" name="hidden-identifier" value="1" />
										<div class="col-md-6 col-sm-12 col-md-offset-3">
											<div id="add-alert-message"></div>
										</div>
										<div class="col-md-6 col-sm-12 col-md-offset-3">
											<div class="panel panel-default border-panel card-view">
												<div class="panel-heading">
													<a href="school-section.php" class="pull-left" title="Back to school section"><i class="zmdi zmdi-chevron-left" style="color: rgba(23, 126, 193, 0.85);font-weight: bold;font-size: 25px;margin-right: 10px;"></i></a>
													<div class="pull-left">
														<h6 class="panel-title txt-dark">Add School Section</h6>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-wrapper">
													<div class="panel-body">
														<div class="form-group">
															<label class="control-label mb-10" for="tb-section">Section</label>
															<input type="text" class="form-control" name="tb-section" required="" id="tb-section" placeholder="Enter Section">
														</div>
														
														<div class="form-group">
															<label class="control-label mb-10" for="sel-type">Year Level</label>
															<select class="form-control" id="sel-year-level">
															</select>
														</div>

														<div class="form-group">
															<label class="control-label mb-10" for="sel-type">Year Level</label>
															<select class="form-control" id="sel-course">
															</select>
														</div>
													</div>
												</div>
												<div class="form-group text-center">
													<button type="button" id="btn-save-add" class="btn btn-info btn-rounded">Save</button>
												</div>
											</div>
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
			
			fetchSchooLevel();
			fetchCourse();

			$("#btn-save-add").on('click', function(){
				var data = new Object();
				data.section = $("#tb-section").val();
				data.level = $("#sel-year-level").val();
				data.course = $("#sel-course").val();

				$(".preloader").show();
				$.ajax({
					url: 'include/add_maintenance.php',
					type: 'post',
					data: { action: 'school-section', params: data  },
					success: function(response){
						$(".preloader").hide();
						var result = $.parseJSON(response);

						if (result["status"] == 'success') {
							$("#add-alert-message").html('<div class="alert alert-success">You have successfully created a section.</div>');
							setTimeout(function(){
								window.location.href = 'school-section.php';
							},1000);
						} else {
							$("#add-alert-message").html('<div class="alert alert-danger">There was an error creating a section.</div>');
						}
						
					}
				});	
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
		function fetchSchooLevel() {
			$.ajax({
				url: 'include/admin_functions.php',
				type: 'post',
				data: { action: 'fetch-school-level' },
				success: function(response){
					var result = $.parseJSON(response);
					var html = '';

					for(var prod in result){
						html += '<option value="' + result[prod].id + '">' + result[prod].description + '</option>';
					}
					$('#sel-year-level').html(html);
					$('#sel-year-level').val($('#sel-year-level option:first').val());
					//fetchSection(cid);
				}
			});
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
					$('#sel-course').val($('#sel-course option:first').val());
					//fetchSection(cid);
				}
			});
		}
	</script>
	<?php include('_common-js.php'); ?>
</body>

</html>
