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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partial/_head.php'); ?>
    <style type="text/css">
    	.form-control-static{
    		padding:0;
    	}
    </style>
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
										
										<div class="col-md-10 col-sm-12 col-md-offset-1">
											<div class="panel panel-default border-panel card-view">
												<div class="panel-heading">
													<a href="enroll.php" class="pull-left" title="Back to enrollees"><i class="zmdi zmdi-chevron-left" style="color: rgba(23, 126, 193, 0.85);font-weight: bold;font-size: 25px;margin-right: 10px;"></i></a>
													<div class="pull-left">
														<h6 class="panel-title txt-dark">Update Enrollee Subjects</h6>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-wrapper">
													<div class="panel-body">
														<div class="form-group">
															<div id="add-alert-message"></div>
														</div>
														<!-- <div class="form-group">
															<div class="input-group">
																<input type="text" class="form-control" name="tb-student-code" required="" id="tb-student-code" placeholder="Enter Student Id">
																<span class="input-group-btn">
																	<button class="btn btn-info" id="btn-search" type="button"><i class="fa fa-search"></i></button>
																</span>
															</div>
															
														</div> -->
														<div id="search-body">
															<?php
																$selStudent = "select school_courses.description,school_courses.id as course_id, school_sections.section,students.* from enrollees inner join students on students.id = enrollees.student_id inner join school_courses on school_courses.id = enrollees.school_course_id inner join school_sections on school_sections.id = enrollees.school_section_id where enrollees.id = " . $_GET['eid'];
																$rsStudent = mysqli_query($mysqli, $selStudent);
																$row = mysqli_fetch_assoc($rsStudent);
															?>
															<input type="hidden" name="enrollee-id" value="<?php echo $_GET['eid'] ?>">
															<input type="hidden" name="student-id" value="<?php echo $_GET['id'] ?>">
															<input type="hidden" name="course-id" value="<?php echo $_GET['course_id'] ?>">
															<form>
																<div class="row">
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-3">Student ID:</label>
																			<div class="col-md-9">
																				<p class="form-control-static"><?php echo $row['student_code'] ?></p>
																			</div>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="col-md-12">
																				<p class="form-control-static"><?php echo $row['section'] . ' - ' . $row['description'] ?></p>
																			</div>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-3">First name:</label>
																			<div class="col-md-9">
																				<p class="form-control-static" id="p-first-name"><?php echo $row['first_name'] ?></p>
																			</div>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-3">Last name:</label>
																			<div class="col-md-9">
																				<p class="form-control-static"><?php echo $row['last_name'] ?></p>
																			</div>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-3">Email:</label>
																			<div class="col-md-9">
																				<p class="form-control-static"><?php echo $row['email_address'] ?></p>
																			</div>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="control-label col-md-3">Mobile:</label>
																			<div class="col-md-9">
																				<p class="form-control-static"><?php echo $row['mobile_number'] ?></p>
																			</div>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																</div>
															
																<div class="subject-body col-md-8 col-md-offset-2">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="form-group">
																				<div class="input-group">
																					<input type="text" class="form-control" name="tb-subject-code" required="" id="tb-subject-code" placeholder="Enter Subject Id">
																					<span class="input-group-btn">
																						<button class="btn btn-info" id="btn-add-subject" type="button"><i class="fa fa-plus"></i></button>
																					</span>
																				</div>
																			</div>
																			<div class="form-group">
																				<div id="subject-alert-message"></div>
																			</div>
																			<div class="form-group">
																				<table class="table">
																					<thead>
																						<th>Code</th>
																						<th>Description</th>
																						<th></th>
																					</thead>
																					<tbody id="table-subject">
																						<?php
																							$selSubject = "select enrolled_subjects.*,school_subjects.*,school_subjects.id as sid from enrolled_subjects inner join school_subjects on school_subjects.id = enrolled_subjects.subject_id where enrolled_subjects.enrollee_id = " . $_GET['eid'];
																							$rsSubject = mysqli_query($mysqli, $selSubject);
																							while($sub = mysqli_fetch_assoc($rsSubject)):
																						?>
																						<tr id="sub-<?php echo $sub['sid'] ?>" data-id="<?php echo $sub['sid'] ?>"><td><?php echo $sub['code'] ?></td><td><?php echo $sub['description'] ?></td><td><button type="button" title="Remove" class="btn btn-primary btn-square btn-sm" onclick="remove(<?php echo $sub['sid'] ?>)"><i class="fa fa-times"></i></button></td></tr>
																						<?php endwhile; ?>
																					</tbody>
																				</table>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group text-center">
																			<button type="button" id="btn-submit-enrollee" class="btn btn-info btn-rounded">Save</button>
																		</div>
																	</div>
																</div>
															</form>
														</div>

													</div>
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


			$("#btn-add-subject").on("click", function(){
				var subjectCode = $("input[name='tb-subject-code']").val();
				$(".preloader").show();
				$("#subject-alert-message").html('');

				$.ajax({
					url: 'include/fetch_maintenance.php',
					type: 'post',
					data: { action: 'add-subject', code: subjectCode },
					success: function(response){
						var result = $.parseJSON(response);

						if (result['status'] == 'success') {
							var checkSubject = 0;
							$("#table-subject tr").each(function(){
								if ($(this).data('id') == result['data'].id) {
									checkSubject++;
								}
							});

							if (checkSubject > 0) {
								$("#subject-alert-message").html('<div class="alert alert-danger">Subject already added.</div>');
							} else {
								var tr = '<tr id="sub-' + result['data'].id + '" data-id="' + result['data'].id + '"><td>' + result['data'].code + '</td><td>' + result['data'].description + '</td><td><button type="button" title="Remove" class="btn btn-primary btn-square btn-sm" onclick="remove(' + result['data'].id + ')"><i class="fa fa-times"></i></button></td></tr>';
								$("#table-subject").append(tr);
							}
						} else {
							$("#subject-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
						}
						$(".preloader").hide();
					}
				});
			});

			$("#btn-submit-enrollee").on("click", function(){
				var data = new Object();
				data.studentId = $("input[name=student-id]").val();
				data.courseId = $("input[name=course-id]").val();
				data.enrolleeId = $("input[name=enrollee-id]").val();

				var subject = new Array();
				$("#table-subject tr").each(function(){
					subject.push($(this).data('id'));
				});
				data.subjects = subject;

				$(".preloader").show();

				$.ajax({
					url: 'include/edit_maintenance.php',
					type: 'post',
					data: { action: 'enrollee-subject', params: data },
					success: function(response){
						var result = $.parseJSON(response);
						
						if (result['status'] == 'success') {
							
							// $("#table-subject").html('');
							// $("input[name='tb-subject-code']").val('');
							// $(".subject-body").removeClass('active');
							// $(".subject-body").hide();
							// $("#btn-remove-subject").hide();
							// $("#btn-enroll-subject").show();
							// $("#search-body").hide();
							// $("#tb-student-code").val('');
							$("#add-alert-message").html('<div class="alert alert-success">Subject successfully updated.</div>');
							
							setTimeout(function(){
								$("#add-alert-message").html('');
							},2000);
						} else {
							$("#add-alert-message").html('<div class="alert alert-danger">There was a problem enrolling the student.</div>');
						}

						$(".preloader").hide();
					}
				});
			});

			
		});
		function remove(id) {
			$("#sub-"+id).remove();
		}
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
