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
				<?php include('partial/_access.php') ?>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Students</h6>
								</div>
								<a href="add-student.php" class="pull-right btn btn-primary btn-circle btn-sm" title="Add Student"><i class="zmdi zmdi-account-add" style="color: #fff"></i></a>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>First Name</th>
														<th>Middle Name</th>
														<th>Last Name</th>
														<th>Email</th>
														<th>Mobile</th>
														<th>Course</th>
														<th>Year and Section</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$selStudent = "select students.id as student_id, students.*, school_sections.*, school_courses.*, enrollees.* from students inner join (enrollees inner join school_courses on school_courses.id = enrollees.school_course_id inner join school_sections on school_sections.id = enrollees.school_section_id ) on enrollees.student_id = students.id";
														$rsStudent = mysqli_query($mysqli, $selStudent);

														while($student = mysqli_fetch_assoc($rsStudent)):
													?>
													<tr id="row-student<?php echo $student['student_id'] ?>" class="txt-dark">
														<input type="hidden" id="course-id-<?php echo $student['student_id'] ?>" value="<?php echo $student['school_course_id'] ?>">
														<input type="hidden" id="section-id-<?php echo $student['student_id'] ?>" value="<?php echo $student['school_section_id'] ?>">
														<td id=""><?php echo $student['student_id'] ?></td>
														<td id="fname-<?php echo $student['student_id'] ?>"><?php echo $student['first_name'] ?></td>
														<td id="mname-<?php echo $student['student_id'] ?>"><?php echo $student['middle_name'] ?></td>
														<td id="lname-<?php echo $student['student_id'] ?>"><?php echo $student['last_name'] ?></td>
														<td id="email-<?php echo $student['student_id'] ?>"><?php echo $student['email_address'] ?></td>
														<td id="mobile-<?php echo $student['student_id'] ?>"><?php echo $student['mobile_number'] ?></td>
														<td id="course-<?php echo $student['student_id'] ?>"><?php echo $student['description'] ?></td>
														<td id="section-<?php echo $student['student_id'] ?>"><?php echo $student['section'] ?></td>
														<td><button id="btn-edit" class="btn-edit btn btn-primary btn-icon-anim btn-square btn-sm" title="Edit" data-id="<?php echo $student['student_id'] ?>"><i class="fa fa-pencil"></i></button></td>
													</tr>
													<?php endwhile; ?>
												</tbody>
											</table>
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

	<div id="edit-student-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myModalLabel">Edit Student</h5>
				</div>
				<div class="modal-body">
					<!-- Row -->
					<div class="row">
						<div class="col-lg-12">
							<div class="">
								<div class="panel-wrapper collapse in">
									<div class="panel-body pa-0">
										<div class="col-sm-12 col-xs-12">
											<div class="form-wrap">
												<form action="#">
													<div class="form-group" id="edit-alert-message"></div>
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
														<input type="text" class="form-control" required="" name="tb-mobile" id="tb-mobile" placeholder="Mobile Number" maxlength="11">
													</div>
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
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success waves-effect" id="btn-save-edit" data-id="">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- <button data-toggle="modal" data-target="#responsive-modal" class="model_img img-responsive hidden" id="btn-modal">modal<button> -->
	
	<!-- JavaScript -->
	<?php include('partial/_js.php'); ?>

	<!--<script src="dist/js/dashboard-data.js"></script>-->
	<script type="text/javascript">
		$(document).ready(function(){
			keyNumber();
			
			

			$(".btn-edit").on("click",function(){
				$("#edit-alert-message").html('');
				var id = $(this).data('id');

				$("#tb-firstname").val($("#fname-" + id).html());
				$("#tb-middlename").val($("#mname-" + id).html());
				$("#tb-lastname").val($("#lname-" + id).html());
				$("#tb-email").val($("#email-" + id).html());
				$("#tb-mobile").val($("#mobile-" + id).html());
				$("#btn-save-edit").attr("data-id", id);
				console.log($("#course-id-" + id).val());
				fetchCourse($("#course-id-" + id).val());
				fetchSection($("#course-id-" + id).val(),$("#section-id-" + id).val());

				$("#edit-student-modal").modal('show');
			});

			$("#sel-course").on('change', function(){
				fetchSection($(this).val(),0);
			});

			$("#btn-save-edit").on("click", function(){
				var id = $(this).data('id');

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
					url: 'include/edit_student.php',
					type: 'post',
					data: { action: 'get', studentId: id, params: data  },
					success: function(response){
						$(".preloader").hide();
						console.log(response);
						var result = $.parseJSON(response);
						console.log(result["status"]);

						if (result["status"] == 'success'){
							$("#fname-" + id).html($("#tb-firstname").val());
							$("#mname-" + id).html($("#tb-middlename").val());
							$("#lname-" + id).html($("#tb-lastname").val());
							$("#email-" + id).html($("#tb-email").val());
							$("#mobile-" + id).html($("#tb-mobile").val());
							$("#course-" + id).html($("#sel-course").find(":selected").text());
							$("#section-" + id).html($("#sel-section").find(":selected").text());
							
							$("#course-id-" + id).val($("#sel-course").val());
							$("#section-id-" + id).val($("#sel-section").val());

							$("#edit-alert-message").html('<div class="alert alert-success">Student successfully updated.</div>');
							setTimeout(function(){
								$("#edit-student-modal").modal('hide');
							},1500);
						} else {
							$("#edit-alert-message").html('<div class="alert alert-danger">There was and error updating the student.</div>');
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

		function fetchCourse(courseId) {
			var cid = courseId ? courseId : 1;
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
					$('#sel-course').val(cid);
					//fetchSection(cid);
				}
			});
		}

		function fetchSection(courseId,sectionId) {
			var cid = courseId ? courseId : 1;

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

					var sid = sectionId != 0 ? sectionId : $('#sel-section option:first').val();
					$('#sel-section').val(sid);
				}
			});
		}
	</script>
	<?php include('_common-js.php'); ?>
</body>

</html>
