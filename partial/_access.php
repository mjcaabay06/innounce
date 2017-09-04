<?php
	$checkLogs = "select * from login_logs inner join users on users.id = login_logs.user_id where login_logs.user_id = " . $userId . " and login_logs.status_id = 1 and users.password_type_id = 1";
	$rsLogs = mysqli_query($mysqli, $checkLogs);
	$rowLogs = mysqli_num_rows($rsLogs);

	$checkLastLogin = "select * from login_logs where user_id = " . $userId . " order by created_at desc limit 1,1";
	$rsLastLogin = mysqli_query($mysqli, $checkLastLogin);
	$rowLastLogin = mysqli_fetch_assoc($rsLastLogin);

	$checkLastLogout = "select * from logout_logs where user_id = " . $userId . " order by created_at desc limit 1,1";
	$rsLastLogout = mysqli_query($mysqli, $checkLastLogout);
	$rowLastLogout = mysqli_fetch_assoc($rsLastLogout);


	$access_login = '';
	if (isset($rowLastLogin)) {
		$login = new DateTime($rowLastLogin['created_at']);
		$login->setTimezone(new DateTimeZone('Asia/Manila'));
		$access_login = 'Last Login' . $login->format("l, F j, Y") . '<br/>' . $login->format("g:i:s A (e O)");
	}

	$access_logout = '';
	if (isset($rowLastLogout)) {
		$logout = new DateTime($rowLastLogout['created_at']);
		$logout->setTimezone(new DateTimeZone('Asia/Manila'));
		$access_logout = 'Last Access' . $logout->format("l, F j, Y") . '<br/>' . $logout->format("g:i:s A (e O)");
	}
?>
<div class="row">

	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-right">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box bg-red">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-9 text-center pl-0 pr-0 data-wrap-left" style="min-height: 79px">
									<span class="txt-light block font-13">
										<?php echo $access_logout ?>
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
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-right">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box bg-green">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-9 text-center pl-0 pr-0 data-wrap-left" style="min-height: 79px">
									<span class="txt-light block font-13">
										<?php echo $access_login ?>
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