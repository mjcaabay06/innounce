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
    <style type="text/css">
    	.profile-box .profile-cover-pic{
    		min-height: 60px
    	}
    	.profile-box .profile-cover-pic .title{
    		min-height: 50%;
    		line-height: 30px;
    		padding: 0 10px;
    		color: #fff;
    	}

    	.profile-box .profile-info .profile-img-wrap{
    		background-color: #eee;
			height: 80px;
			width: 80px;
			border-radius: 80px;
			position: absolute;
			right: 11px;
			top: 40px;
    	}
    	.profile-box .profile-info .profile-img-wrap img{
    		height: 72px;
			width: 72px;
			border-radius: 72px;
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
					<?php
						if ($_COOKIE['userType'] == 1) {
							$selMsg = "select * from sent_messages where created_at between date_sub(NOW(), interval 10 day) and NOW() order by created_at desc";
						} else {
							$selMsg = "select * from sent_messages where created_at between date_sub(NOW(), interval 10 day) and NOW() and user_id = " . $_COOKIE['authId'] . " order by created_at desc";
						}
						
						$rsMsg = mysqli_query($mysqli, $selMsg);

						while ($msg = mysqli_fetch_assoc($rsMsg)) :
							$type = '';
							$bgColor = '';
							switch ($msg['message_type_id']) {
								case 1:
								case 4:
									$type = 'announcement';
									$color = '#00226c';
									break;
								case 2:
									$type = 'survey';
									$color = "#616161";
									break;
								case 3:
									$type = 'emergency';
									$color = '#E16666';
									break;
							}
					?>
						<div class="col-md-3 col-sm-12">
							<div class="panel panel-default card-view  pa-0">
								<div class="panel-wrapper collapse in">
									<div class="panel-body  pa-0">
										<div class="profile-box">
											<div class="profile-cover-pic">
												<div class="profile-image-overlay" style="background-position: center;background-size: cover;background-color: <?php echo $color ?>;opacity: 1;">
													<div class="title" style="text-transform: uppercase;"><?php echo $type; ?></div>
													<div class="title" style="font-size: 11px; color: #ccc"><?php echo setDate("M j, Y g:i:s A", $msg['created_at']) ?></div>
												</div>
											</div>
											<?php if ($_COOKIE['authId'] != $msg['user_id']) : ?>
												<div class="profile-info text-center">
													<div class="profile-img-wrap" style="background-color: #eee">
														<img class="inline-block mb-10" src="dist/img/150543615312269.jpg" alt="user"/>
													</div>
												</div>
											<?php endif; ?>
											<div class="social-info" style="border-top: 0; padding: 15px; height: 200px; overflow: auto; padding-top: 45px">
												<p><?php echo $msg['message'] ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					
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
			

		});
	</script>

</body>

</html>
