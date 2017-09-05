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
									<h6 class="panel-title txt-dark">School Years</h6>
								</div>
								<a href="add-school-year.php" class="pull-right btn btn-primary btn-circle btn-sm" title="Add school year"><i class="fa fa-plus" style="color: #fff"></i></a>
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
														<th>From</th>
														<th>To</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$sel = "select * from school_years";
														$rs = mysqli_query($mysqli, $sel);

														while($row = mysqli_fetch_assoc($rs)):
													?>
													<tr id="row-<?php echo $row['id'] ?>" class="txt-dark">
														<td id=""><?php echo $row['id'] ?></td>
														<td id="from-<?php echo $row['id'] ?>"><?php echo $row['year_from'] ?></td>
														<td id="to-<?php echo $row['id'] ?>"><?php echo $row['year_to'] ?></td>
														<td><button id="btn-edit" class="btn-edit btn btn-primary btn-icon-anim btn-square btn-sm" title="Edit" data-id="<?php echo $row['id'] ?>"><i class="fa fa-pencil"></i></button></td>
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
					<h5 class="modal-title" id="myModalLabel">Edit Year</h5>
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
														<label class="control-label mb-10" for="tb-from">Year From</label>
														<input type="text" class="form-control number-only" name="tb-firstname" required="" maxlength="4" id="tb-from" placeholder="From">
													</div>
													<div class="form-group">
														<label class="control-label mb-10" for="tb-to">Year To</label>
														<input type="text" class="form-control number-only" required="" name="tb-middlename" maxlength="4" id="tb-to" placeholder="To">
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
					<input type="hidden" value="" name="hidden-syid">
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

				$("#tb-from").val($("#from-" + id).html());
				$("#tb-to").val($("#to-" + id).html());
				$('input[name=hidden-syid]').val(id);
				$("#btn-save-edit").attr("data-id", id);
				$("#edit-modal").modal('show');
				
			});

			$("#btn-save-edit").on("click", function(){
				var id = $('input[name=hidden-syid]').val();

				var data = new Object();
				data.from = $("#tb-from").val();
				data.to = $("#tb-to").val();

				$(".preloader").show();
				$.ajax({
					url: 'include/edit_maintenance.php',
					type: 'post',
					data: { action: 'school-year', id: id, params: data  },
					success: function(response){
						$(".preloader").hide();
						var result = $.parseJSON(response);

						if (result["status"] == 'success'){
							$("#from-" + id).html($("#tb-from").val());
							$("#to-" + id).html($("#tb-to").val());

							$("#edit-alert-message").html('<div class="alert alert-success">School year successfully updated.</div>');
							setTimeout(function(){
								$("#edit-modal").modal('hide');
							},1000);
						} else {
							$("#edit-alert-message").html('<div class="alert alert-danger">There was and error updating the school year.</div>');
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
	</script>
	<?php include('_common-js.php'); ?>
</body>

</html>
