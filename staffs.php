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
									<h6 class="panel-title txt-dark">Staffs</h6>
								</div>
								<a href="add-staff.php" class="pull-right btn btn-primary btn-circle btn-sm" title="Add Staff"><i class="zmdi zmdi-account-add" style="color: #fff"></i></a>
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
														<th>First Name</th>
														<th>Middle Name</th>
														<th>Last Name</th>
														<th>Email</th>
														<th>Mobile</th>
														<th>User Type</th>
														<th>Department</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$selStaff = "select *, departments.id as dep_id from users inner join user_infos on users.id = user_infos.user_id inner join user_types on users.user_type_id = user_types.id left join departments on departments.id = users.department_id where users.id != " . $_SESSION['authId'];
														$rsStaff = mysqli_query($mysqli, $selStaff);

														while($staff = mysqli_fetch_assoc($rsStaff)):
													?>
													<tr id="row-staff<?php echo $staff['user_id'] ?>" class="<?php echo $staff['status_id'] == 2 ? 'success' : 'txt-dark' ?>">
														<input type="hidden" id="type-<?php echo $staff['user_id'] ?>" value="<?php echo $staff['user_type_id'] ?>">
														<input type="hidden" id="status-<?php echo $staff['user_id'] ?>" value="<?php echo $staff['status_id'] ?>">
														<input type="hidden" id="dep-id-<?php echo $staff['user_id'] ?>" value="<?php echo $staff['dep_id'] ?>">
														<td id=""><?php echo $staff['user_id'] ?></td>
														<td id="fname-<?php echo $staff['user_id'] ?>"><?php echo $staff['first_name'] ?></td>
														<td id="mname-<?php echo $staff['user_id'] ?>"><?php echo $staff['middle_name'] ?></td>
														<td id="lname-<?php echo $staff['user_id'] ?>"><?php echo $staff['last_name'] ?></td>
														<td id="email-<?php echo $staff['user_id'] ?>"><?php echo $staff['email_address'] ?></td>
														<td id="mobile-<?php echo $staff['user_id'] ?>"><?php echo $staff['mobile_number'] ?></td>
														<td id="user-type-<?php echo $staff['user_id'] ?>"><?php echo $staff['type'] ?></td>
														<td id="department-<?php echo $staff['user_id'] ?>"><?php echo $staff['description'] ?></td>
														<td>
															<button id="btn-view" class="btn-view btn btn-primary btn-icon-anim btn-square btn-sm" title="View Sections" data-id="<?php echo $staff['user_id'] ?>"><i class="fa fa-eye"></i></button>
															<button id="btn-edit" class="btn-edit btn btn-primary btn-icon-anim btn-square btn-sm" title="Edit" data-id="<?php echo $staff['user_id'] ?>"><i class="fa fa-pencil"></i></button>
															<button id="btn-delete" class="btn-delete btn btn-primary btn-icon-anim btn-square btn-sm" title="Delete" data-id="<?php echo $staff['user_id'] ?>"><i class="fa fa-trash-o"></i></button>
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

	<div id="edit-staff-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
														<label class="control-label mb-10" for="sel-type">User Type</label>
														<select class="form-control" id="sel-type">
														</select>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="sel-type">Department</label>
														<select class="form-control" id="sel-deparment">
															<?php
																$selDep = "select * from departments";
																$rsDep = mysqli_query($mysqli, $selDep);

																while($dep = mysqli_fetch_assoc($rsDep)):
															?>
																<option value="<?php echo $dep['id'] ?>"><?php echo $dep['description'] ?></option>
															<?php endwhile; ?>
														</select>
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="sel-status">Status</label>
														<select class="form-control" id="sel-status">
															<option value="1">Active</option>
															<option value="2">Inactive</option>
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
					<input type="hidden" value="" name="hidden-staffid">
					<button type="button" class="btn btn-success waves-effect" id="btn-save-edit" data-id="">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<div id="view-sections-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalSubject" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="myModalSubject">Sections Handle</h5>
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
													<div class="form-group" id="view-alert-message"></div>
													<table class="table mb-0" id="table-view">
														<thead>
															<tr>
																<th>Section</th>
																<th>Year Level</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-success waves-effect" id="btn-update-enrollee" data-id="">Update</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
				</div> -->
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
				console.log($("#dep-id-" + id).val());
				$("#tb-firstname").val($("#fname-" + id).html());
				$("#tb-middlename").val($("#mname-" + id).html());
				$("#tb-lastname").val($("#lname-" + id).html());
				$("#tb-email").val($("#email-" + id).html());
				$("#tb-mobile").val($("#mobile-" + id).html());
				$("#sel-type").val($("#type-" + id).val());
				$("#sel-status").val($("#status-" + id).val());
				$("#sel-deparment").val($("#dep-id-" + id).val());
				$('input[name=hidden-staffid]').val(id);
				$("#btn-save-edit").attr("data-id", id);
				type($("#type-" + id).val());
				$("#edit-staff-modal").modal('show');
				
			});

			$(".btn-delete").on("click", function(){
				var answer = confirm('Are you sure you want to delete the staff?');
				var id = $(this).data('id');
				var data = new Object();
				data.id = id;

				if (answer) {
					$(".preloader").show();
					$.ajax({
						url: 'include/delete_maintenance.php',
						type: 'post',
						data: { action: 'staff', params: data  },
						success: function(response){
							$(".preloader").hide();
							var result = $.parseJSON(response);

							if (result["status"] == 'success'){
								$("table tr#row-staff" + id).remove();
								$("#del-alert-message").html('<div class="alert alert-success">Staff successfully deleted.</div>');
								setTimeout(function(){
									$("#del-alert-message").html('');
								},1500);
							} else {
								$("#del-alert-message").html('<div class="alert alert-danger">There was and error deleting the staff.</div>');
							}

						}
					});
				}
			});

			$(".btn-view").on("click", function(){
				$("#view-sections-modal").modal('show');

				$.ajax({
					url: '_fetch.php',
					type: 'post',
					data: { action: 'handled-sections', id: $(this).data('id') },
					success: function(response){
						var result = $.parseJSON(response);

						if (result['status'] == 'success') {
							$("#table-view tbody").html(result['output']);
						}
					}
				});
			});

			$("#btn-save-edit").on("click", function(){
				var id = $('input[name=hidden-staffid]').val();

				var data = new Object();
				data.first_name = $("#tb-firstname").val();
				data.middle_name = $("#tb-middlename").val();
				data.last_name = $("#tb-lastname").val();
				data.email_address = $("#tb-email").val();
				data.mobile_number = $("#tb-mobile").val();
				data.user_type = $("#sel-type").val();
				data.status = $("#sel-status").val();
				data.department = $("#sel-deparment").val();

				$(".preloader").show();
				$.ajax({
					url: 'include/edit_staff.php',
					type: 'post',
					data: { action: 'get', userId: id, params: data  },
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
							$("#user-type-" + id).html($("#sel-type option:selected").text());
							$("#type-" + id).val($("#sel-type").val());
							$("#status-" + id).val($("#sel-status").val());
							$("#dep-id-" + id).val($("#sel-deparment").val());
							$("#department-" + id).html($("#sel-deparment option:selected").text());

							if ($("#sel-status").val() == '1') {
								$("#row-staff" + id).removeClass('success');
								$("#row-staff" + id).addClass('txt-dark');
							} else {
								$("#row-staff" + id).addClass('success');
								$("#row-staff" + id).removeClass('txt-dark');
							}
							$("#edit-alert-message").html('<div class="alert alert-success">Staff successfully updated.</div>');
							setTimeout(function(){
								$("#edit-staff-modal").modal('hide');
							},1500);
						} else {
							$("#edit-alert-message").html('<div class="alert alert-danger">There was and error updating the staff.</div>');
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
		function type(id) {
			$.ajax({
				url: '_fetch.php',
				type: 'post',
				data: { action: 'user-type', id: id },
				success: function(response){
					var result = $.parseJSON(response);
					$("#sel-type").html(result['output']);
					$("#edit-modal").modal('show');
				}
			});
		}
	</script>
	<?php include('_common-js.php'); ?>
</body>

</html>
