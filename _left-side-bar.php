<?php
	$page = strtolower(basename($_SERVER['PHP_SELF']));
	$send = array('send-announcement.php','send-emergency.php', 'send-survey.php');
	$users = array('staffs.php','students.php', 'add-staff.php', 'add-student.php');
	$staff = array('staffs.php', 'add-staff.php');
	$student = array('students.php', 'add-student.php');
	
	$schoolYear = array('school-year.php', 'add-school-year.php');
	$schoolSection = array('school-section.php', 'add-school-section.php');
	$yearLevel = array('year-level.php', 'add-year-level.php');
	$subject = array('subject.php', 'add-subject.php');
	$course = array('course.php', 'add-course.php');
	$userRole = array('user-roles.php', 'add-user-role.php');
	$department = array('department.php', 'add-department.php');

	$enroll = array('enroll.php', 'add-enrollee.php', 'update-enrollee-subjects.php');
?>

<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
		<li class="navigation-header">
			<span>Main</span> 
			<i class="zmdi zmdi-more"></i>
		</li>
		<li>
			<a <?php echo $page == 'index.php' ? 'class="active"' : '' ?> href="index.php"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
			<a <?php echo in_array($page, $send) ? 'class="active"' : '' ?> href="javascript:void(0);" data-toggle="collapse" data-target="#send_dr"><div class="pull-left"><i class="fa fa-paper-plane mr-20"></i><span class="right-nav-text">Send</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="send_dr" class="collapse collapse-level-1">
				<li>
					<a <?php echo $page == 'send-announcement.php' ? 'class="active-page"' : '' ?> href="send-announcement.php">Announcement</a>
				</li>
				<?php if ($_COOKIE['userType'] == 1) : ?>
					<li>
						<a <?php echo $page == 'send-emergency.php' ? 'class="active-page"' : '' ?>  href="send-emergency.php">Emergency</a>
					</li>
					<li>
						<a <?php echo $page == 'send-survey.php' ? 'class="active-page"' : '' ?>  href="send-survey.php">Survey</a>
					</li>
				<?php endif; ?>
			</ul>
			<?php if ($_COOKIE['userType'] == 1) : ?>
				<a <?php echo in_array($page, $users) ? 'class="active"' : '' ?> href="javascript:void(0);" data-toggle="collapse" data-target="#users_dr"><div class="pull-left"><i class="zmdi zmdi-accounts mr-20"></i><span class="right-nav-text">Users</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
				<ul id="users_dr" class="collapse collapse-level-1">
					<li>
						<a <?php echo in_array($page, $staff) ? 'class="active-page"' : '' ?> href="staffs.php">Staff</a>
					</li>
					<li>
						<a <?php echo in_array($page, $student) ? 'class="active-page"' : '' ?>  href="students.php">Students</a>
					</li>
				</ul>
				<a <?php echo $page == 'percentage-report.php' ? 'class="active"' : '' ?>  href="javascript:void(0);" data-toggle="collapse" data-target="#reports"><div class="pull-left"><i class="fa fa-bar-chart-o mr-20"></i><span class="right-nav-text">Reports</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
				<ul id="reports" class="collapse collapse-level-1">
					<li>
						<a href="#" class="a-reports" data-value="sent">Sent Messages</a>
					</li>
					<li>
						<a href="#" class="a-reports" data-value="receive">Response Messages</a>
					</li>
					<li>
						<a <?php echo $page == 'percentage-report.php' ? 'class="active-page"' : '' ?> href="#" class="a-reports" data-value="percentage">Message Percentage</a>
					</li>
					<li>
						<a href="#" class="a-reports" data-value="login">Logins</a>
					</li>
					<li>
						<a href="#" class="a-reports" data-value="logout">Logouts</a>
					</li>
				</ul>
				<a <?php echo in_array($page, $enroll) ? 'class="active"' : '' ?> href="enroll.php">
					<div class="pull-left">
						<i class="fa fa-sitemap mr-20"></i>
						<span class="right-nav-text">Enrolled</span>
					</div>
					<div class="clearfix"></div>
				</a>
			<?php endif; ?>
		</li>
		<?php if ($_COOKIE['userType'] == 1) : ?>
			<li><hr class="light-grey-hr mb-10"></li>
			<li class="navigation-header">
				<span>Maintenance</span> 
				<i class="zmdi zmdi-more"></i>
			</li>
			<li>
				<a <?php echo in_array($page, $userRole) ? 'class="active"' : '' ?> href="user-roles.php">
					<div class="pull-left">
						<i class="fa fa-child mr-20"></i>
						<span class="right-nav-text">user Role</span>
					</div>
					<div class="clearfix"></div>
				</a>
				<a <?php echo in_array($page, $department) ? 'class="active"' : '' ?> href="department.php">
					<div class="pull-left">
						<i class="fa fa-certificate mr-20"></i>
						<span class="right-nav-text">department</span>
					</div>
					<div class="clearfix"></div>
				</a>
				<a <?php echo in_array($page, $course) ? 'class="active"' : '' ?> href="course.php">
					<div class="pull-left">
						<i class="fa fa-folder-o mr-20"></i>
						<span class="right-nav-text">Courses</span>
					</div>
					<div class="clearfix"></div>
				</a>
				<a <?php echo in_array($page, $subject) ? 'class="active"' : '' ?> href="subject.php">
					<div class="pull-left">
						<i class="zmdi zmdi-book mr-20"></i>
						<span class="right-nav-text">Subjects</span>
					</div>
					<div class="clearfix"></div>
				</a>
				<a <?php echo in_array($page, $schoolSection) ? 'class="active"' : '' ?> href="school-section.php">
					<div class="pull-left">
						<i class="fa fa-bookmark mr-20"></i>
						<span class="right-nav-text">School Sections</span>
					</div>
					<div class="clearfix"></div>
				</a>
				<a <?php echo in_array($page, $yearLevel) ? 'class="active"' : '' ?> href="year-level.php">
					<div class="pull-left">
						<i class="fa fa-level-up mr-20"></i>
						<span class="right-nav-text">Year Levels</span>
					</div>
					<div class="clearfix"></div>
				</a>
				<a <?php echo in_array($page, $schoolYear) ? 'class="active"' : '' ?> href="school-year.php">
					<div class="pull-left">
						<i class="zmdi zmdi-calendar mr-20"></i>
						<span class="right-nav-text">School Year</span>
					</div>
					<div class="clearfix"></div>
				</a>
				
			</li>
		<?php endif; ?>
	</ul>
</div>