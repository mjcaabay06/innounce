<?php
	$page = strtolower(basename($_SERVER['PHP_SELF']));
	$users = array('staffs.php','students.php', 'add-staff.php', 'add-student.php');
	$staff = array('staffs.php', 'add-staff.php');
	$student = array('students.php', 'add-student.php');
	
	$schoolYear = array('school-year.php', 'add-school-year.php');
	$schoolSection = array('school-section.php', 'add-school-section.php');
	$yearLevel = array('year-level.php', 'add-year-level.php');
	$subject = array('subject.php', 'add-subject.php');
	$course = array('course.php', 'add-course.php');
?>

<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
		<li class="navigation-header">
			<span>Main</span> 
			<i class="zmdi zmdi-more"></i>
		</li>
		<li>
			<a <?php echo $page == 'index.php' ? 'class="active"' : '' ?> href="index.php"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
			<?php if ($_SESSION['userType'] == 1) : ?>
				<a <?php echo in_array($page, $users) ? 'class="active"' : '' ?> href="javascript:void(0);" data-toggle="collapse" data-target="#users_dr"><div class="pull-left"><i class="zmdi zmdi-accounts mr-20"></i><span class="right-nav-text">Users</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
				<ul id="users_dr" class="collapse collapse-level-1">
					<li>
						<a <?php echo in_array($page, $staff) ? 'class="active-page"' : '' ?> href="staffs.php">Staff</a>
					</li>
					<li>
						<a <?php echo in_array($page, $student) ? 'class="active-page"' : '' ?>  href="students.php">Students</a>
					</li>
				</ul>
				<a href="javascript:void(0);" data-toggle="collapse" data-target="#reports"><div class="pull-left"><i class="fa fa-bar-chart-o mr-20"></i><span class="right-nav-text">Reports</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
				<ul id="reports" class="collapse collapse-level-1">
					<li>
						<a href="#" class="a-reports" data-value="login">Logins</a>
					</li>
					<li>
						<a href="#" class="a-reports" data-value="logout">Logouts</a>
					</li>
				</ul>
			<?php endif; ?>
		</li>
		<li><hr class="light-grey-hr mb-10"></li>
		<li class="navigation-header">
			<span>Maintenance</span> 
			<i class="zmdi zmdi-more"></i>
		</li>
		<li>
			<a <?php echo in_array($page, $schoolYear) ? 'class="active"' : '' ?> href="school-year.php">
				<div class="pull-left">
					<i class="zmdi zmdi-calendar mr-20"></i>
					<span class="right-nav-text">School Year</span>
				</div>
				<div class="clearfix"></div>
			</a>
			<a <?php echo in_array($page, $schoolSection) ? 'class="active"' : '' ?> href="school-section.php">
				<div class="pull-left">
					<i class="zmdi zmdi-calendar mr-20"></i>
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
			<a <?php echo in_array($page, $subject) ? 'class="active"' : '' ?> href="subject.php">
				<div class="pull-left">
					<i class="zmdi zmdi-calendar mr-20"></i>
					<span class="right-nav-text">Subjects</span>
				</div>
				<div class="clearfix"></div>
			</a>
			<a <?php echo in_array($page, $course) ? 'class="active"' : '' ?> href="course.php">
				<div class="pull-left">
					<i class="zmdi zmdi-calendar mr-20"></i>
					<span class="right-nav-text">Courses</span>
				</div>
				<div class="clearfix"></div>
			</a>
		</li>
	</ul>
</div>