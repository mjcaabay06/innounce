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

	$checkLogs = "select * from login_logs inner join users on users.id = login_logs.user_id where login_logs.user_id = " . $userId . " and login_logs.status_id = 1 and users.password_type_id = 1";
	$rsLogs = mysqli_query($mysqli, $checkLogs);
	$rowLogs = mysqli_num_rows($rsLogs);

	$checkLastLogin = "select * from login_logs where user_id = " . $userId . " order by created_at desc limit 1,1";
	$rsLastLogin = mysqli_query($mysqli, $checkLastLogin);
	$rowLastLogin = mysqli_fetch_assoc($rsLastLogin);

	$selUser = "select * from users inner join user_infos on users.id = user_infos.user_id where users.id = " . $userId;
	$rsUser = mysqli_query($mysqli, $selUser);
	$rowUser = mysqli_fetch_assoc($rsUser);
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
	
	<!-- Morris Charts CSS -->
    <link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
		
	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	<link href="dist/css/custom.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Preloader -->
	<div class="preloader" style="display: none"></div>
	<!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-red">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="index.html">
							<img class="brand-img" src="dist/img/logo.png" alt="brand"/>
							<span class="brand-text" style="text-transform:none">iNnounce</span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="dist/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="#" data-toggle="modal" data-target="#disableLoginFailure"><i class="zmdi zmdi-settings"></i><span>Disable Login Failure</span></a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="#"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
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
				<div class="row">

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-red">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-9 text-center pl-0 pr-0 data-wrap-left" style="min-height: 79px">
													<span class="txt-light block font-13">
														<?php echo isset($rowUser) && $rowUser['last_access'] != '' ? 'Last Access ' . date('l, F j, Y', strtotime($rowUser['last_access'])) . '<br/>' . date('g:i:s A (e O)', strtotime($rowUser['last_access'])) : '' ?>
													</span>
												</div>
												<div class="col-xs-3 text-center  pl-0 pr-0 data-wrap-right" style="min-height: 79px">
													<i class="zmdi zmdi-power txt-light data-right-rep-icon" style="font-size: 40px"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pull-right">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-green">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-9 text-center pl-0 pr-0 data-wrap-left" style="min-height: 79px">
													<span class="txt-light block font-13">
														<?php echo isset($rowLastLogin) ? 'Last Login ' . date('l, F j, Y', strtotime($rowLastLogin['created_at'])) . '<br/>' . date('g:i:s A (e O)', strtotime($rowLastLogin['created_at'])) : '' ?>
													</span>
												</div>
												<div class="col-xs-3 text-center  pl-0 pr-0 data-wrap-right" style="min-height: 79px">
													<i class="zmdi zmdi-sign-in txt-light data-right-rep-icon" style="font-size: 40px"></i>
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
													<span>grouping</span>
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
											<li role="presentation" class="next <?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>">
												<a aria-expanded="true"  data-toggle="tab" role="tab" id="reports_tab_8" href="#reports_8">
													<span>reports</span>
												</a>
											</li>
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
																<div class="checkbox checkbox-success">
																	<input id="a-check-prof" type="checkbox">
																	<label for="a-check-prof" class="control-label mb-5 text-left">
																		Professors
																	</label>
																</div>
																<!-- <label class="control-label mb-5 text-left">Professors</label> -->
																<select multiple class="form-control" id="a-sel-prof" style="height: 200px" disabled>
																	<?php
																		$selProf = "select * from users inner join user_infos on users.id = user_infos.user_id where users.status_id = 1 and users.id != " . $_SESSION["authId"] . " order by user_infos.last_name";
																		$rsProf = mysqli_query($mysqli, $selProf);

																		while($prof = mysqli_fetch_assoc($rsProf)):
																	?>
																		<option value="<?php echo $prof['user_id'] ?>"><?php echo $prof['last_name'] . ', ' . $prof['first_name'] ?></option>
																	<?php endwhile; ?>
																</select>
															</div>
															<div class="form-group col-md-4 col-sm-12 col-xs-12">
																<div class="checkbox checkbox-success">
																	<input id="a-check-stud" type="checkbox">
																	<label for="a-check-stud" class="control-label mb-5 text-left">
																		Students
																	</label>
																</div>
																<!-- <label class="control-label mb-5 text-left">Students</label> -->
																<select multiple class="form-control" id="a-sel-stud" style="height: 200px" disabled>
																	<?php
																		$selCourse = "select * from courses";
																		$rsCourse = mysqli_query($mysqli, $selCourse);
																		while($course = mysqli_fetch_assoc($rsCourse)):
																	?>
																		<optgroup label="<?php echo $course['description'] ?>">
																			<?php
																				$selYS = "select year_sections.id, year_sections.section from year_sections inner join school_years on year_sections.school_year_id = school_years.id where year_sections.course_id = " . $course['id'];
																				$rsYS = mysqli_query($mysqli, $selYS);

																				while($ys = mysqli_fetch_assoc($rsYS)):
																			?>
																				<option value="<?php echo $ys['id'] ?>"><?php echo $ys['section'] ?></option>
																			<?php endwhile; ?>		
																		</optgroup>
																	<?php endwhile; ?>
																	
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
														<div class="form-group">
															<label class="control-label mb-10 text-left col-xs-12">Students:</label>
															<div class="form-group col-md-4 col-sm-12 col-xs-12">
																<select multiple class="form-control" id="g-sel-stud" style="height: 200px">
																	<?php
																		$selCourse = "select courses.* from courses inner join year_sections on courses.id = year_sections.course_id where year_sections.prof_id = " . $_SESSION['authId'] . " group by courses.id";
																		$rsCourse = mysqli_query($mysqli, $selCourse);
																		while($course = mysqli_fetch_assoc($rsCourse)):
																	?>
																		<optgroup label="<?php echo $course['description'] ?>">
																			<?php
																				$selYS = "select year_sections.id, year_sections.section from year_sections inner join school_years on year_sections.school_year_id = school_years.id where year_sections.course_id = " . $course['id'] . " and year_sections.prof_id = " . $_SESSION['authId'];
																				$rsYS = mysqli_query($mysqli, $selYS);

																				while($ys = mysqli_fetch_assoc($rsYS)):
																			?>
																				<option value="<?php echo $ys['id'] ?>"><?php echo $ys['section'] ?></option>
																			<?php endwhile; ?>		
																		</optgroup>
																	<?php endwhile; ?>
																	
																</select>
															</div>
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
																<div class="checkbox checkbox-success">
																	<input id="s-check-prof" type="checkbox">
																	<label for="s-check-prof" class="control-label mb-5 text-left">
																		Professors
																	</label>
																</div>
																<!-- <label class="control-label mb-5 text-left">Professors</label> -->
																<select multiple class="form-control" id="s-sel-prof" style="height: 200px" disabled>
																	<?php
																		$selProf = "select * from users inner join user_infos on users.id = user_infos.user_id where users.status_id = 1 and users.id != " . $_SESSION["authId"] . " order by user_infos.last_name";
																		$rsProf = mysqli_query($mysqli, $selProf);

																		while($prof = mysqli_fetch_assoc($rsProf)):
																	?>
																		<option value="<?php echo $prof['user_id'] ?>"><?php echo $prof['last_name'] . ', ' . $prof['first_name'] ?></option>
																	<?php endwhile; ?>
																</select>
															</div>
															<div class="form-group col-md-4 col-sm-12 col-xs-12">
																<div class="checkbox checkbox-success">
																	<input id="s-check-stud" type="checkbox">
																	<label for="s-check-stud" class="control-label mb-5 text-left">
																		Students
																	</label>
																</div>
																<!-- <label class="control-label mb-5 text-left">Students</label> -->
																<select multiple class="form-control" id="s-sel-stud" style="height: 200px" disabled>
																	<?php
																		$selCourse = "select * from courses";
																		$rsCourse = mysqli_query($mysqli, $selCourse);
																		while($course = mysqli_fetch_assoc($rsCourse)):
																	?>
																		<optgroup label="<?php echo $course['description'] ?>">
																			<?php
																				$selYS = "select year_sections.id, year_sections.section from year_sections inner join school_years on year_sections.school_year_id = school_years.id where year_sections.course_id = " . $course['id'];
																				$rsYS = mysqli_query($mysqli, $selYS);

																				while($ys = mysqli_fetch_assoc($rsYS)):
																			?>
																				<option value="<?php echo $ys['id'] ?>"><?php echo $ys['section'] ?></option>
																			<?php endwhile; ?>		
																		</optgroup>
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
											
											<div  id="reports_8" class="tab-pane fade <?php echo $_SESSION['userType'] == 1 ? '' : 'hidden' ?>" role="tabpanel">
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
											</div>
											
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
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
					<h5 class="modal-title">Change your password.</h5>
				</div>
				<div class="modal-body">
					<p class="control-label text-center" style="text-transform: none; margin-bottom: 5px;"><?php echo $cntPasswordDate > 0 ? 'Your password is already expired.' : 'Your current password is system generated.'; ?> Please change your password.</p>
					<form>
						<div class="form-group col-sm-6 col-sm-offset-3">
							<!-- <label for="tb-password" class="control-label mb-10">New Password:</label> -->
							<input type="password" class="form-control col-sm-6 text-center" id="tb-password" placeholder="Enter new password">
							<div class="hidden" style="color: #cc0000" id="panel-error"></div>
							<div class="clearfix"></div>
						</div>
						<!-- <div class="form-group">
							<label for="message-text" class="control-label mb-10">Message:</label>
							<textarea class="form-control" id="message-text"></textarea>
						</div> -->
					</form>
				</div>
				<div class="modal-footer" style="text-align: center">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
					<button type="button" id="btn-save" class="btn btn-danger">Save Password</button>
				</div>
			</div>
		</div>
	</div>

	<div id="disableLoginFailure" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="mySmallModalLabel">Disable login failure</h5>
				</div>
				<div class="modal-body text-center">
					<div class="form-group" id="panel-notif"></div>
					<div class="form-group">
						<input type="hidden" id="tb-disable-login" value="<?php echo $rowUser['disable_login_failure'] ?>">
						<button class="btn btn-rounded <?php echo $rowUser['disable_login_failure'] == 0 ? 'btn-success disabled' : 'btn-default btn-outline' ?>" id="btn-disable-off">Off</button>
						<button class="btn btn-rounded <?php echo $rowUser['disable_login_failure'] == 0 ? 'btn-default btn-outline' : 'btn-success disabled' ?>" id="btn-disable-on">On</button>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" id="btn-save-disable">Save</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- <button data-toggle="modal" data-target="#responsive-modal" class="model_img img-responsive hidden" id="btn-modal">modal<button> -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- simpleWeather JavaScript -->
	<script src="vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="dist/js/simpleweather-data.js"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- ChartJS JavaScript -->
	<script src="vendors/chart.js/Chart.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/custom.js"></script>
	<!--<script src="dist/js/dashboard-data.js"></script>-->
	<script type="text/javascript">
		$(document).ready(function(){
			<?php if($cntPasswordDate > 0 || $rowLogs == 1): ?>
				$("#responsive-modal").modal('show');
			<?php endif; ?>

			$("#tb-password").focusout(function(){
				checkPassword();
			});
			$("#btn-save").on("click", function(){
				if (checkPassword()) {
					$(".preloader").show();
					$.ajax({
						url: 'include/admin_functions.php',
						type: 'post',
						data: { action: 'change-password', pwd: $("#tb-password").val(), userId: <?php echo $_SESSION['authId'] ?>  },
						success: function(response){
							console.log(response);
							$("#responsive-modal").modal('hide');
							$(".preloader").hide();
						}
					});
				}
			});

			$("#btn-disable-off").on('click', function(){
				if (!$(this).hasClass('disabled')){
					$("#tb-disable-login").val(0);
					$(this).removeClass('btn-default btn-outline');
					$(this).addClass('btn-success disabled');

					$("#btn-disable-on").removeClass('btn-success disabled');
					$("#btn-disable-on").addClass('btn-default btn-outline');
				}
			});

			$("#btn-disable-on").on('click', function(){
				if (!$(this).hasClass('disabled')){
					$("#tb-disable-login").val(1);
					$(this).removeClass('btn-default btn-outline');
					$(this).addClass('btn-success disabled');

					$("#btn-disable-off").removeClass('btn-success disabled');
					$("#btn-disable-off").addClass('btn-default btn-outline');
				}
			});

			$("#btn-save-disable").on("click", function(){
				$(".preloader").show();
				$.ajax({
					url: 'include/admin_functions.php',
					type: 'post',
					data: { action: 'disable-login', val: $("#tb-disable-login").val(), userId: <?php echo $_SESSION['authId'] ?>  },
					success: function(response){
						console.log(response);
						$("#panel-notif").html(response);
						setTimeout(function(){
							$("#disableLoginFailure").modal('hide');
							$("#panel-notif").html('');
						},1000);
						$(".preloader").hide();
					}
				});
			});

			isCheckProf();
			isCheckStud();

			$("#a-send").on("click", function(){
				var err = 0;
				if (!$("#a-check-prof").is(':checked') && !$("#a-check-stud").is(':checked')) {
					//alert("Please select a recipient.");
					err += 1;
				}

				if ($("#a-check-prof").is(':checked')) {
					if ($("#a-sel-prof").val() == null) {
						err += 1;
					}
				}

				if ($("#a-check-stud").is(':checked')) {
					if ($("#a-sel-stud").val() == null) {
						err += 1;
					}
				}

				if (err > 0) {
					alert("Please select a recipient.");
				} else if ($("#a-message").val().trim() == "") {
					alert("Please compose a message.");
				} else {
					sendAnnouncement("include/send_announcement.php");
				}
			});

			$("#g-send").on("click", function(){
				var err = 0;
				if ($("#g-sel-stud").val() == null) {
					err += 1;
				}

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

			$("#s-send").on("click", function(){
				var err = 0;
				if (!$("#s-check-prof").is(':checked') && !$("#s-check-stud").is(':checked')) {
					//alert("Please select a recipient.");
					err += 1;
				}

				if ($("#s-check-prof").is(':checked')) {
					if ($("#s-sel-prof").val() == null) {
						err += 1;
					}
				}

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
</body>

</html>
