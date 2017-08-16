<?php
	session_start();
	include "include/configurations.php";
	include "include/general_functions.php";

	if(!isset($_SESSION['authId']) || empty($_SESSION['authId'])){
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
					<div class="col-lg-3 col-xs-12">
						<div class="panel panel-default card-view  pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body  pa-0">
									<div class="profile-box">
										<div class="profile-cover-pic">
											<div class="fileupload btn btn-default">
												<span class="btn-text">edit</span>
												<input class="upload" type="file">
											</div>
											<div class="profile-image-overlay"></div>
										</div>
										<div class="profile-info text-center">
											<div class="profile-img-wrap">
												<img class="inline-block mb-10" src="dist/img/mock1.jpg" alt="user"/>
												<div class="fileupload btn btn-default">
													<span class="btn-text">edit</span>
													<input class="upload" type="file">
												</div>
											</div>	
											<h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger"><?php echo $rowUser['first_name'] . ' ' . $rowUser['last_name'] ?></h5>
										</div>	
										<div class="social-info">
											<button class="btn btn-default btn-block btn-outline btn-anim" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i><span class="btn-text">edit profile</span></button>
											<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
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
																							<div class="form-body overflow-hide">
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputuname_1">Name</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-user"></i></div>
																										<input type="text" class="form-control" id="exampleInputuname_1" placeholder="willard bryant">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																										<input type="email" class="form-control" id="exampleInputEmail_1" placeholder="xyz@gmail.com">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputContact_1">Contact number</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-phone"></i></div>
																										<input type="email" class="form-control" id="exampleInputContact_1" placeholder="+102 9388333">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputpwd_1">Password</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-lock"></i></div>
																										<input type="password" class="form-control" id="exampleInputpwd_1" placeholder="Enter pwd" value="password">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10">Gender</label>
																									<div>
																										<div class="radio">
																											<input type="radio" name="radio1" id="radio_1" value="option1" checked="">
																											<label for="radio_1">
																											M
																											</label>
																										</div>
																										<div class="radio">
																											<input type="radio" name="radio1" id="radio_2" value="option2">
																											<label for="radio_2">
																											F
																											</label>
																										</div>
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10">Country</label>
																									<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
																										<option value="Category 1">USA</option>
																										<option value="Category 2">Austrailia</option>
																										<option value="Category 3">India</option>
																										<option value="Category 4">UK</option>
																									</select>
																								</div>
																							</div>
																							<div class="form-actions mt-10">			
																								<button type="submit" class="btn btn-success mr-10 mb-30">Update profile</button>
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
															<button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Save</button>
															<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
														</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											<li class="<?php echo $_SESSION['userType'] == 1 ? 'active' : 'hidden' ?>" role="presentation">
												<a  data-toggle="tab" id="announcement_tab_8" role="tab" href="#announcement_8" aria-expanded="false">
													<span>announcement</span>
												</a>
											</li>
											<li role="presentation" class="<?php echo $_SESSION['userType'] == 2 ? 'active' : 'hidden' ?>">
												<a data-toggle="tab" id="grouping_tab_8" role="tab" href="#grouping_8" aria-expanded="false">
													<span>announcement</span>
												</a>
											</li>
											<li role="presentation" class="<?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>">
												<a data-toggle="tab" id="emergency_tab_8" role="tab" href="#emergency_8" aria-expanded="false">
													<span>emergency</span>
												</a>
											</li>
											<li role="presentation" class="<?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>">
												<a data-toggle="tab" id="survey_tab_8" role="tab" href="#survey_8" aria-expanded="false">
													<span>survey</span>
												</a>
											</li>
											<!-- <li role="presentation" class="next <?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>">
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
											<div  id="announcement_8" class="tab-pane fade <?php echo $_SESSION['userType'] == 1 ? 'in active' : 'hidden' ?>" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
														<div class="form-group" id="a-alert-message"></div>
														<div class="form-group">
															<label class="control-label mb-10 text-left col-xs-12">Recipients:</label>
															<div class="form-group col-md-4 col-sm-12 col-xs-12 col-md-offset-1">
																<!-- <div class="checkbox checkbox-success">
																	<input id="a-check-prof" type="checkbox">
																	
																</div> -->
																<!-- <label class="control-label mb-5 text-left">Professors</label> -->
																<label for="a-sel-course" class="control-label mb-5 text-left">Courses</label>
																<select class="form-control" id="a-sel-course">
																	<?php 
																		$selCourses = "select * from school_courses";
																		$rsCourse = mysqli_query($mysqli, $selCourses);

																		while($course = mysqli_fetch_assoc($rsCourse)):
																	?>
																		<option value="<?php echo $course['id'] ?>"><?php echo $course['description'] ?></option>
																	<?php endwhile; ?>
																</select>
															</div>
															<div class="form-group col-md-4 col-sm-12 col-xs-12">
																<!-- <div class="checkbox checkbox-success">
																	<input id="a-check-stud" type="checkbox">
																	
																</div> -->
																<label for="a-sel-year" class="control-label mb-5 text-left">Year Levels</label>
																<!-- <label class="control-label mb-5 text-left">Students</label> -->
																<select multiple class="form-control" id="a-sel-year" style="height: 200px">
																	<!-- <?php
																		$selYearLevel = "select school_levels.* from school_levels inner join (school_sections inner join enrollees on enrollees.school_section_id = school_sections.id ) on school_sections.school_level_id = school_levels.id  group by school_levels.id order by school_levels.id";
																		$rsYearLevel = mysqli_query($mysqli, $selYearLevel);

																		while($yearLevel = mysqli_fetch_assoc($rsYearLevel)):
																	?>
																		<option value="<?php echo $yearLevel['id'] ?>"><?php echo $yearLevel['description'] ?></option>
																	<?php endwhile; ?> -->
																	
																</select>
															</div>
														</div>
														
														<div class="form-group col-xs-12">
															<label class="control-label mb-10 text-left">Message:</label>
															<textarea class="form-control" rows="5" id="a-message"></textarea>
														</div>
														<div class="form-group col-xs-12">
															<button type="button" id="a-send" class="btn btn-info pull-right">Send</button>
															<div class="clearfix"></div>
														</div>
													</div>
												</div>
											</div>
											<div  id="grouping_8" class="tab-pane fade <?php echo $_SESSION['userType'] == 2 ? 'in active' : 'hidden' ?>" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
														<div class="form-group" id="g-alert-message"></div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12 col-md-offset-1">
															<label for="g-sel-course" class="control-label mb-5 text-left">Courses</label>
															<select class="form-control" id="g-sel-course">
																<?php 
																	$selCourses = "select school_courses.* from users inner join (professor_subjects inner join (enrolled_subjects inner join (enrollees inner join school_courses on school_courses.id = enrollees.school_course_id) on enrollees.id = enrolled_subjects.enrollee_id) on enrolled_subjects.subject_id = professor_subjects.school_subject_id) on professor_subjects.professor_id = users.id where users.id = " . $_SESSION['authId'] . " group by school_courses.id";
																	$rsCourse = mysqli_query($mysqli, $selCourses);

																	while($course = mysqli_fetch_assoc($rsCourse)):
																?>
																	<option value="<?php echo $course['id'] ?>"><?php echo $course['description'] ?></option>
																<?php endwhile; ?>
															</select>
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="g-sel-section" class="control-label mb-5 text-left">Sections Handled</label>
															<select multiple class="form-control" id="g-sel-section" style="height: 200px">
															</select>
														</div>
														
														<div class="form-group col-xs-12">
															<label class="control-label mb-10 text-left">Message:</label>
															<textarea class="form-control" rows="5" id="g-message"></textarea>
														</div>
														<div class="form-group col-xs-12">
															<button type="button" id="g-send" class="btn btn-info pull-right">Send</button>
															<div class="clearfix"></div>
														</div>
													</div>
												</div>
											</div>
											<div  id="emergency_8" class="tab-pane fade <?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
														<div class="form-group" id="e-alert-message"></div>
														<div class="form-group col-xs-12">
															<label class="control-label mb-10 text-left">Message:</label>
															<textarea class="form-control" rows="5" id="e-message"></textarea>
														</div>
														<div class="form-group col-xs-12">
															<button type="button" id="e-send" class="btn btn-info pull-right">Send</button>
															<div class="clearfix"></div>
														</div>
													</div>
												</div>
											</div>
											<div  id="survey_8" class="tab-pane fade <?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>" role="tabpanel">
												<!-- Row -->
												<div class="col-md-12">
													<div class="pt-20">
														<div class="form-group" id="s-alert-message"></div>
														<div class="form-group">
															<label class="control-label mb-10 text-left col-xs-12">Recipients:</label>
															<div class="form-group col-md-4 col-sm-12 col-xs-12 col-md-offset-1">
																<!-- <div class="checkbox checkbox-success">
																	<input id="s-check-prof" type="checkbox">
																	<label for="s-check-prof" class="control-label mb-5 text-left">
																		Professors
																	</label>
																</div> -->
																<label for="s-sel-course" class="control-label mb-5 text-left">Courses</label>
																<!-- <label class="control-label mb-5 text-left">Professors</label> -->
																<select class="form-control" id="s-sel-course">
																	<?php 
																		$selCourses = "select * from school_courses";
																		$rsCourse = mysqli_query($mysqli, $selCourses);

																		while($course = mysqli_fetch_assoc($rsCourse)):
																	?>
																		<option value="<?php echo $course['id'] ?>"><?php echo $course['description'] ?></option>
																	<?php endwhile; ?>
																</select>
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
											
											<!-- <div  id="reports_8" class="tab-pane fade <?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														<div class="followers-wrap">
															<ul class="followers-list-wrap">
																<li class="follow-list">
																	<div class="follo-body">
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Clay Masse</span>
																				<span class="time block truncate txt-grey">No one saves us but ourselves.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="dist/img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Evie Ono</span>
																				<span class="time block truncate txt-grey">Unity is strength</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="dist/img/user2.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Madalyn Rascon</span>
																				<span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="dist/img/user3.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Mitsuko Heid</span>
																				<span class="time block truncate txt-grey">I’m thankful.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="dist/img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Ezequiel Merideth</span>
																				<span class="time block truncate txt-grey">Patience is bitter.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="dist/img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Jonnie Metoyer</span>
																				<span class="time block truncate txt-grey">Genius is eternal patience.</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div> -->
											
											<!-- <div  id="settings_8" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														<div class="">
															<div class="panel-wrapper collapse in">
																<div class="panel-body pa-0">
																	<div class="col-sm-12 col-xs-12">
																		<div class="form-wrap">
																			<form action="#">
																				<div class="form-body overflow-hide">
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputuname_01">Name</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" id="exampleInputuname_01" placeholder="willard bryant">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputEmail_01">Email address</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																							<input type="email" class="form-control" id="exampleInputEmail_01" placeholder="xyz@gmail.com">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputContact_01">Contact number</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-phone"></i></div>
																							<input type="email" class="form-control" id="exampleInputContact_01" placeholder="+102 9388333">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputpwd_01">Password</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-lock"></i></div>
																							<input type="password" class="form-control" id="exampleInputpwd_01" placeholder="Enter pwd" value="password">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10">Gender</label>
																						<div>
																							<div class="radio">
																								<input type="radio" name="radio1" id="radio_01" value="option1" checked="">
																								<label for="radio_01">
																								M
																								</label>
																							</div>
																							<div class="radio">
																								<input type="radio" name="radio1" id="radio_02" value="option2">
																								<label for="radio_02">
																								F
																								</label>
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10">Country</label>
																						<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
																							<option value="Category 1">USA</option>
																							<option value="Category 2">Austrailia</option>
																							<option value="Category 3">India</option>
																							<option value="Category 4">UK</option>
																						</select>
																					</div>
																				</div>
																				<div class="form-actions mt-10">			
																					<button type="submit" class="btn btn-success mr-10 mb-30">Update profile</button>
																				</div>				
																			</form>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div> -->
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

			$("#a-sel-course").val(1);
			fetchYear(1);
			$("#a-sel-course").on('change', function(){
				fetchYear($(this).val());
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

				// if ($("#a-check-stud").is(':checked')) {
				// 	if ($("#a-sel-stud").val() == null) {
				// 		err += 1;
				// 	}
				// }

				if (err > 0) {
					alert("Please select a recipient.");
				} else if ($("#a-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendAnnouncement("include/send_announcement.php");
				}
			});

			fetchSections(1);
			$("#g-sel-course").val(1);
			$("#g-sel-course").on('change', function(){
				fetchSections($(this).val());
			});

			$("#g-send").on("click", function(){
				var err = 0;
				// if ($("#g-sel-stud").val() == null) {
				// 	err += 1;
				// }

				if (err > 0) {
					alert("Please select a recipient.");
				} else if ($("#g-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendGrouping("include/send_grouping.php");
				}
			});

			$("#e-send").on("click", function(){
				if ($("#e-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendEmergency("include/send_emergency.php");
				}
			});


			$("#s-sel-course").val(1);
			fetchYearS(1);
			$("#s-sel-course").on('change', function(){
				fetchYearS($(this).val());
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

				if (err > 0) {
					alert("Please select a recipient.");
				} else if ($("#s-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendSurvey("include/send_survey.php");
				}
			});
		});
		

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
				data: { action: 'fetch-sections', courseId: courseId, profId: <?php echo $_SESSION['authId'] ?> },
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
	</script>

</body>

</html>
