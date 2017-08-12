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
	</div>
</div>


<div id="reportsModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="report-title" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form action="reports.php" target="_blank" method="get">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title" id="report-title"></h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="type" value="">
					<div class="form-group">
						<div class="col-sm-12 col-md-6">
							<label class="control-label mb-10 text-left">From:</label>
							<input class="form-control" id="report-from" name="startdate" type="text" data-mask="99/99/9999" value=""/>
						</div>
						<div class="col-sm-12 col-md-6">
							<label class="control-label mb-10 text-left">To:</label>
							<input class="form-control" id="report-to" name="enddate" type="text" data-mask="99/99/9999" value=""/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info" id="btn-generate" data-value="">Generate</button>
				</div>
			</form>
		</div>
	</div>
</div>