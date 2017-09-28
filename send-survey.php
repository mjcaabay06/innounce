<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	if(!isset($_COOKIE['authId']) || empty($_COOKIE['authId'])){
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

	$selUser = "select * from users inner join user_infos on users.id = user_infos.user_id inner join user_types on user_types.id = users.user_type_id where users.id = " . $userId;
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
					<div class="col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											<li class="<?php echo $_COOKIE['userType'] == 1 ? '' : 'hidden' ?>" role="presentation">
												<a href="send-announcement.php" aria-expanded="false">
													<span>announcement</span>
												</a>
											</li>
											<li role="presentation" class="<?php echo $_COOKIE['userType'] != 1 ? 'active' : 'hidden' ?>">
												<a data-toggle="tab" id="grouping_tab_8" role="tab" href="#grouping_8" aria-expanded="false">
													<span>announcement</span>
												</a>
											</li>
											<li role="presentation" class="<?php echo $_COOKIE['userType'] == 1 ? '' : 'hidden' ?>">
												<a href="send-emergency.php" aria-expanded="false">
													<span>emergency</span>
												</a>
											</li>
											<li role="presentation" class="<?php echo $_COOKIE['userType'] == 1 ? '' : 'hidden' ?> active">
												<a href="send-survey.php" aria-expanded="false">
													<span>survey</span>
												</a>
											</li>
											<!-- <li role="presentation" class="next <?php echo $_COOKIE['userType'] == 1 ? '' : 'hidden' ?>">
												<a aria-expanded="true"  data-toggle="tab" role="tab" id="reports_tab_8" href="#reports_8">
													<span>reports</span>
												</a>
											</li> -->
											<!-- <li role="presentation" class=""><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>settings</span></a></li>
											<li class="dropdown" role="presentation">
												<a  data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop_7" href="#" aria-expanded="false"><span>More</span> <span class="caret"></span></a>
												<ul id="myTabDrop_7_contents"  class="dropdown-menu">
													<li class=""><a  data-toggle="tab" id="dropdown_13_tab" role="tab" href="#dropdown_13" aria-expanded="true">About</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_14_tab" role="tab" href="#dropdown_14" aria-expanded="false">Followings</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_15_tab" role="tab" href="#dropdown_15" aria-expanded="false">Likes</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_16_tab" role="tab" href="#dropdown_16" aria-expanded="false">Reviews</a></li>
												</ul>
											</li> -->
										</ul>
										<div class="tab-content" id="myTabContent_8">
											
											<div  id="survey_8" class="tab-pane fade in active <?php echo $_COOKIE['userType'] == 1 ? '' : 'hidden' ?>" role="tabpanel">
												<!-- Row -->
												<div class="col-md-12">
													<div class="pt-20 mb-20" id="s-message-list">
														<div class="">
															<button id="s-btn-new" type="button" class="btn btn-sm btn-primary pull-right">
																<i class="fa fa-plus mr-10"></i> New message
															</button>
															<div class="clearfix"></div>
														</div>
														<table class="table mb-0">
															<thead>
																<tr>
																	<th class="hidden">Batch ID</th>
																	<th>Message</th>
																	<th>User</th>
																	<th>Date Sent</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																<?php
																	$selSurvey = "select sent_messages.*, user_infos.*, date_format(sent_messages.created_at, '%b %e, %Y [ %H:%i:%s ]') as date_sent from sent_messages inner join (users inner join user_infos on user_infos.user_id = users.id) on users.id = sent_messages.user_id where sent_messages.message_type_id = 2 order by sent_messages.created_at desc";
																	$rsSurvey = mysqli_query($mysqli, $selSurvey);

																	while($survey = mysqli_fetch_assoc($rsSurvey)):
																?>
																<tr>
																	<td class="hidden"><?php echo $survey['batch_id'] ?></td>
																	<td><?php echo $survey['message'] ?></td>
																	<td><?php echo $survey['last_name'] . ', ' . $survey['first_name'] ?></td>
																	<td><?php echo $survey['date_sent'] ?></td>
																	<td>
																		<button data-id="<?php echo $survey['batch_id'] ?>" id="s-btn-view" class="response-btn-view btn btn-primary btn-square btn-sm" title="View Recipients"><i class="fa fa-eye"></i></button>
																	</td>
																</tr>
																<?php endwhile; ?>
															</tbody>
														</table>
													</div>
													<div class="pt-20" id="s-new-message" style="display: none">
														<div class="">
															<button id="s-btn-cancel" type="button" class="btn btn-sm btn-primary pull-right">
																<i class="fa fa-angle-left mr-10"></i> Cancel
															</button>
															<div class="clearfix"></div>
														</div>
														<div class="form-group" id="s-alert-message"></div>
														<div class="form-group">
															<label class="control-label mb-10 text-left col-xs-12">Recipients:</label>
															<div class="form-group col-md-4 col-sm-12 col-xs-12 col-md-offset-1">
																<div class="mb-20">
																	<label for="s-sel-department" class="control-label mb-5 text-left">Department:</label>
																	<select class="form-control" id="s-sel-department">
																		<?php 
																			$selDep = "select * from departments";
																			$rsDep = mysqli_query($mysqli, $selDep);

																			while($dep = mysqli_fetch_assoc($rsDep)):
																		?>
																			<option value="<?php echo $dep['id'] ?>"><?php echo $dep['description'] ?></option>
																		<?php endwhile; ?>
																	</select>
																</div>
																<div>
																	<label for="s-sel-course" class="control-label mb-5 text-left">Course:</label>
																	<select class="form-control" id="s-sel-course">
																	</select>
																</div>
															</div>
															<div class="form-group col-md-4 col-sm-12 col-xs-12">
																<!-- <div class="checkbox checkbox-success">
																	<input id="s-check-stud" type="checkbox">
																	<label for="s-check-stud" class="control-label mb-5 text-left">
																		Students
																	</label>
																</div> -->
																<!-- <label class="control-label mb-5 text-left">Students</label> -->
																<label for="s-sel-year" class="control-label mb-5 text-left">Year Levels</label>
																<select multiple class="form-control" id="s-sel-year" style="height: 200px">
																<?php
																	$selLevel= "select * from school_levels";
																	$rsLevel = mysqli_query($mysqli, $selLevel);

																	while($level = mysqli_fetch_assoc($rsLevel)):
																?>
																	<option value="<?php echo $level['id'] ?>"><?php echo $level['description'] ?></option>
																<?php endwhile; ?>
																</select>
															</div>
														</div>
														
														<div class="form-group col-xs-12">
															<label class="control-label mb-10 text-left">Message:</label>
															<textarea class="form-control" rows="5" id="s-message"></textarea>
														</div>
														<div class="form-group col-xs-12">
															<button type="button" id="s-send" class="btn btn-info pull-right">Send</button>
															<div class="clearfix"></div>
														</div>
													</div>
												</div>
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
			
			isCheckProf();
			isCheckStud();
			fetchCourse($("#a-sel-department option:first").val(),'a');
			fetchCourse($("#s-sel-department option:first").val(),'s');

			// $("#a-sel-course").val(1);
			// fetchYear(1);
			// $("#a-sel-course").on('change', function(){
			// 	fetchYear($(this).val());
			// });
			$("#a-btn-new").on("click", function(){
				$("#a-new-message").show();
				$("#a-message-list").hide();
			});
			$("#a-btn-cancel").on("click", function(){
				$("#a-new-message").hide();
				$("#a-message-list").show();
			});
			$("#a-send").on("click", function(){
				var err = 0;
				// if (!$("#a-check-prof").is(':checked') && !$("#a-check-stud").is(':checked')) {
				// 	//alert("Please select a recipient.");
				// 	err += 1;
				// }

				// if ($("#a-check-prof").is(':checked')) {
				// 	if ($("#a-sel-prof").val() == null) {
				// 		err += 1;
				// 	}
				// }

				if ($("#a-sel-year").val() == null) {
					err += 1;
				}

				if ($("#a-sel-subject").val() == null) {
					err += 1;
				}

				if ($("#a-sel-sections").val() == null) {
					err += 1;
				}

				if (err > 0) {
					alert("Please select a recipient.");
				} else if ($("#a-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendAnnouncement("include/send_announcement.php");
				}
			});


			fetchSections($("#g-sel-course option:first").val());
			$("#g-sel-course").val($("#g-sel-course option:first").val());
			$("#g-sel-course").on('change', function(){
				fetchSections($(this).val());
			});

			$("#g-btn-new").on("click", function(){
				$("#g-new-message").show();
				$("#g-message-list").hide();
			});
			$("#g-btn-cancel").on("click", function(){
				$("#g-new-message").hide();
				$("#g-message-list").show();
			});
			$("#g-send").on("click", function(){
				var err = 0;
				<?php if ($rowUser['user_type_id'] == 2): ?>
					if ($("#g-sel-students").val() == null) {
						err += 1;
					}
				<?php else: ?>
					if ($("#g-sel-year").val() == null) {
						err += 1;
					}
				<?php endif; ?>

				if (err > 0) {
					alert("Please select a recipient.");
				} else if ($("#g-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					<?php if (in_array($rowUser['user_type_id'], array(2))): ?>
						sendGrouping("include/send_grouping.php");
					<?php elseif (in_array($rowUser['user_type_id'], array(7))): ?>
						sendGroupingChairman("include/send_grouping.php",<?php echo $rowUser['department_id'] ?>);
					<?php elseif (in_array($rowUser['user_type_id'], array(8))): ?>
						sendGroupingDean("include/send_grouping.php");
					<?php endif; ?>
				}
			});

			$("#e-btn-new").on("click", function(){
				$("#e-new-message").show();
				$("#e-message-list").hide();
			});
			$("#e-btn-cancel").on("click", function(){
				$("#e-new-message").hide();
				$("#e-message-list").show();
			});
			$("#e-send").on("click", function(){
				if ($("#e-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendEmergency("include/send_emergency.php");
				}
			});


			// $("#s-sel-course").val(1);
			// fetchYearS(1);
			// $("#s-sel-course").on('change', function(){
			// 	fetchYearS($(this).val());
			// });
			$("#s-btn-new").on("click", function(){
				$("#s-new-message").show();
				$("#s-message-list").hide();
			});
			$("#s-btn-cancel").on("click", function(){
				$("#s-new-message").hide();
				$("#s-message-list").show();
			});
			$("#s-send").on("click", function(){
				var err = 0;
				// if (!$("#s-check-prof").is(':checked') && !$("#s-check-stud").is(':checked')) {
				// 	//alert("Please select a recipient.");
				// 	err += 1;
				// }

				// if ($("#s-check-prof").is(':checked')) {
				// 	if ($("#s-sel-prof").val() == null) {
				// 		err += 1;
				// 	}
				// }

				if ($("#s-check-stud").is(':checked')) {
					if ($("#s-sel-stud").val() == null) {
						err += 1;
					}
				}

				if ($("#s-sel-year").val() == null) {
					err += 1;
				}

				if (err > 0) {
					alert("Please select a recipient.");
				} else if ($("#s-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendSurvey("include/send_survey.php");
				}
			});
			$(".response-btn-view").on("click", function(){
				$(".preloader").show();
				var id = $(this).data('id');
				$.ajax({
					url: '_fetch.php',
					type: 'post',
					data: { action: 'view-response', id: id },
					success: function(response){
						var result = $.parseJSON(response);

						if (result['status'] == 'success') {
							$("table th.a-tab").hide();
							$("table th.b-tab").hide();
							$("table th.r-tab").hide();

							if (result['mt_id'] == 3) {
								$("table th.b-tab").show();
								$("table th.r-tab").show();
							} else if (result['mt_id'] == 2) {
								$("table th.a-tab").show();
								$("table th.r-tab").show();
							} else {
								$("table th.a-tab").show();
							}

							$("#viewResponseModal table tbody").html(result['output']);
							$("#viewResponseModal #response-title").html('Recipients for: ' + id);
							$("#viewResponseModal").modal('show');
							$(".preloader").hide();
						}
					}
				});
			});

			$("#g-sel-section").on('change', function(){
				var data = new Object();
				data.sections = $(this).val();
				fetchStudents(data);
			});

			$("#a-sel-department").on("change", function(){
				fetchCourse($(this).val(),'a');
			});
			$("#s-sel-department").on("change", function(){
				fetchCourse($(this).val(),'s');
			});

			$("#a-sel-course").on("change", function(){
				$("#a-sel-year option:selected").prop("selected", false);
				$("#a-sel-subject").html('');
				$("#a-sel-sections").html('');
			});

			$("#a-sel-year").on("change", function(){
				var data = new Object();
				data.course = $("#a-sel-course").val();
				data.level = $(this).val();
				$("#a-sel-sections").html('');
				$.ajax({
					url: '_fetch.php',
					type: 'post',
					data: { action: 'a-subject', params: data },
					success: function(response) {
						var result = $.parseJSON(response);

						if (result['status'] == 'success') {
							$("#a-sel-subject").html(result['output']);
						}
					}
				});
			});

			$("#a-sel-subject").on("change", function(){
				var data = new Object();
				data.course = $("#a-sel-course").val();
				data.level = $("#a-sel-year").val();
				data.subject = $(this).val();
				$.ajax({
					url: '_fetch.php',
					type: 'post',
					data: { action: 'a-section', params: data },
					success: function(response) {
						var result = $.parseJSON(response);

						if (result['status'] == 'success') {
							$("#a-sel-sections").html(result['output']);
						}
					}
				});
			});
		});
		
		function fetchCourse(depId, type) {
			$.ajax({
				url: '_fetch.php',
				type: 'post',
				data: { action: 'departments', depId: depId },
				success: function(response) {
					var result = $.parseJSON(response);

					if (result['status'] == 'success') {
						$("#" + type + "-sel-course").html(result['output']);
					}
				}
			});
		}

		function fetchYear(courseId){
			$.ajax({
				url: '_fetch.php',
				type: 'post',
				data: { action: 'fetch-year-level', courseId: courseId },
				success: function(response) {
					var result = $.parseJSON(response);

					if (result['status'] == 'success') {
						$("#a-sel-year").removeAttr('disabled', '');
					} else {
						$("#a-sel-year").attr('disabled','');
					}
					$("#a-sel-year").html(result['output']);
				}
			});
		}
		function fetchYearS(courseId){
			$.ajax({
				url: '_fetch.php',
				type: 'post',
				data: { action: 'fetch-year-level', courseId: courseId },
				success: function(response) {
					var result = $.parseJSON(response);

					if (result['status'] == 'success') {
						$("#s-sel-year").removeAttr('disabled', '');
					} else {
						$("#s-sel-year").attr('disabled','');
					}
					$("#s-sel-year").html(result['output']);
				}
			});
		}

		function fetchSections(courseId){
			$.ajax({
				url: '_fetch.php',
				type: 'post',
				data: { action: 'fetch-sections', courseId: courseId, profId: <?php echo $_COOKIE['authId'] ?> },
				success: function(response) {
					var result = $.parseJSON(response);

					if (result['status'] == 'success') {
						$("#g-sel-section").removeAttr('disabled', '');
					} else {
						$("#g-sel-section").attr('disabled','');
					}
					$("#g-sel-section").html(result['output']);
				}
			});
		}

		function fetchStudents(data) {
			$.ajax({
				url: '_fetch.php',
				type: 'post',
				data: { action: 'fetch-students', params: data },
				success: function(response) {
					var result = $.parseJSON(response);

					// if (result['status'] == 'success') {
					// 	$("#g-sel-students").removeAttr('disabled', '');
					// } else {
					// 	$("#g-sel-students").attr('disabled','');
					// }
					$("#g-sel-students").html(result['output']);
				}
			});
		}
	</script>

</body>

</html>
