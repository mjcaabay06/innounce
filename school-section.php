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
								<div class="pull-left">
									<h6 class="panel-title txt-dark">School Sections</h6>
								</div>
								<a href="add-school-section.php" class="pull-right btn btn-primary btn-circle btn-sm" title="Add school section"><i class="fa fa-plus" style="color: #fff"></i></a>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="form-group">
										<div id="del-alert-message"></div>
									</div>
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Section</th>
														<th>Year Level</th>
														<th>Course</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$sel = "select school_fix_sections.*, school_levels.description, school_courses.description as course, school_courses.acronym from school_fix_sections inner join school_levels on school_levels.id = school_fix_sections.school_level_id inner join school_courses on school_courses.id = school_fix_sections.school_course_id";
														$rs = mysqli_query($mysqli, $sel);

														while($row = mysqli_fetch_assoc($rs)):
													?>
													<tr id="row-<?php echo $row['id'] ?>" class="txt-dark">
														<input type="hidden" id="school-level-id-<?php echo $row['id'] ?>" value="<?php echo $row['school_level_id'] ?>">
														<input type="hidden" id="school-course-id-<?php echo $row['id'] ?>" value="<?php echo $row['school_course_id'] ?>">
														<td id=""><?php echo $row['id'] ?></td>
														<td id="section-<?php echo $row['id'] ?>"><?php echo $row['section'] ?></td>
														<td id="description-<?php echo $row['id'] ?>"><?php echo $row['description'] ?></td>
														<td id="course-<?php echo $row['id'] ?>"><?php echo $row['course'] ?></td>
														<td>
															<button id="btn-edit" class="btn-edit btn btn-primary btn-icon-anim btn-square btn-sm" title="Edit" data-id="<?php echo $row['id'] ?>"><i class="fa fa-pencil"></i></button>
															<button id="btn-delete" class="btn-delete btn btn-primary btn-icon-anim btn-square btn-sm" title="Delete" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash-o"></i></button>
														</td>
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

	<div id="edit-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myModalLabel">Edit Staff</h5>
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
					<input type="hidden" value="" name="hidden-ssid">
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

				$("#tb-section").val($("#section-" + id).html());
				fetchSchooLevel($("#school-level-id-" + id).val());
				fetchCourse($("#school-course-id-" + id).val());
				$('input[name=hidden-ssid]').val(id);
				$("#btn-save-edit").attr("data-id", id);
				$("#edit-modal").modal('show');
				
			});

			$(".btn-delete").on("click", function(){
				var answer = confirm('Are you sure you want to delete the section?');
				var id = $(this).data('id');
				var data = new Object();
				data.id = id;

				if (answer) {
					$(".preloader").show();
					$.ajax({
						url: 'include/delete_maintenance.php',
						type: 'post',
						data: { action: 'section', params: data  },
						success: function(response){
							$(".preloader").hide();
							var result = $.parseJSON(response);

							if (result["status"] == 'success'){
								$("table tr#row-" + id).remove();
								$("#del-alert-message").html('<div class="alert alert-success">Section successfully deleted.</div>');
								setTimeout(function(){
									$("#del-alert-message").html('');
								},1500);
							} else {
								$("#del-alert-message").html('<div class="alert alert-danger">There was and error deleting the section.</div>');
							}

						}
					});
				}
			});

			$("#btn-save-edit").on("click", function(){
				var id = $('input[name=hidden-ssid]').val();

				var data = new Object();
				data.section = $("#tb-section").val();
				data.level = $("#sel-year-level").val();
				data.course = $("#sel-course").val();

				$(".preloader").show();
				$.ajax({
					url: 'include/edit_maintenance.php',
					type: 'post',
					data: { action: 'school-section', id: id, params: data  },
					success: function(response){
						$(".preloader").hide();
						var result = $.parseJSON(response);

						if (result["status"] == 'success'){
							$("#section-" + id).html($("#tb-section").val());
							$("#description-" + id).html($("#sel-year-level option:selected").text());
							$("#school-level-id-" + id).html($("#sel-year-level").val());
							$("#course-" + id).html($("#sel-course option:selected").text());
							$("#school-course-id-" + id).html($("#sel-course").val());

							$("#edit-alert-message").html('<div class="alert alert-success">Section successfully updated.</div>');
							setTimeout(function(){
								$("#edit-modal").modal('hide');
							},1000);
						} else {
							$("#edit-alert-message").html('<div class="alert alert-danger">There was and error updating the section.</div>');
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

		function fetchSchooLevel(id) {
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
					$('#sel-year-level').val(id);
					//fetchSection(cid);
				}
			});
		}
		function fetchCourse(courseId) {
			var cid = courseId;
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
	</script>
	<?php include('_common-js.php'); ?>
</body>

</html>
