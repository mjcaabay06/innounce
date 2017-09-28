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

<script src="dist/js/bootstrap-datepicker.min.js"></script>
<script src="dist/js/custom.js"></script>

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
					data: { action: 'change-password', pwd: $("#tb-password").val(), userId: <?php echo $_COOKIE['authId'] ?>  },
					success: function(response){
						console.log(response);
						$("#responsive-modal").modal('hide');
						$(".preloader").hide();
					}
				});
			}
		});

		$("#tb-change-password").focusout(function(){
			checkChangePassword();
		});
		$("#btn-change-save").on("click", function(){
			if (checkChangePassword()) {
				$(".preloader").show();
				$.ajax({
					url: 'include/admin_functions.php',
					type: 'post',
					data: { action: 'change-password', pwd: $("#tb-change-password").val(), userId: <?php echo $_COOKIE['authId'] ?>  },
					success: function(response){
						console.log(response);
						$("#alert-change-message").html('<div class="alert alert-success">' + response + '</div>');
						setTimeout(function(){
							$("#changePassword").modal('hide');
							$("#tb-change-password").val('');
							$("#panel-change-error").html('');
						},1500);
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
				data: { action: 'disable-login', val: $("#tb-disable-login").val(), userId: <?php echo $_COOKIE['authId'] ?>  },
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

		$(".a-reports").on("click", function(){
			var type = $(this).data('value');

			if (type == 'login') {
				$("#report-title").html('Generate Login Report');
			} else if (type == 'sent') {
				$("#report-title").html('Generate Sent Messages Report');
			} else if (type == 'receive') {
				$("#report-title").html('Generate Response Messages Report');
			} else if (type == 'percentage') {
				$("#report-title").html('Generate Response Messages Report');
				$("#reportsModal form").attr('action', 'percentage-report.php');
				$("#reportsModal form").removeAttr('target');
			} else {
				$("#report-title").html('Generate Logout Report');
			}
			$("input[name=type]").val(type);
			$("#report-from").val('');
			$("#report-to").val('');
			$("#reportsModal").modal('show');
		});

		$("#btn-generate").on('click', function(){
			$("#reportsModal").modal('hide');
		});

		$("#report-from").datepicker();
		$("#report-to").datepicker();
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
	function checkChangePassword() {
		var pwd = $("#tb-change-password").val();
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
			$("#tb-change-password").css('border-color', 'rgb(204,0,0)');
			$("#panel-change-error").html(error);
			$("#panel-change-error").removeClass("hidden");
			return 0;
		} else {
			//$("#tb-password").addClass("passed");
			$("#tb-change-password").css('border-color', 'rgb(0,128,0)')
			setTimeout(function(){
				$("#tb-change-password").css('border-color', 'rgba(33, 33, 33, 0.12)');
			},1000);
			$("#panel-change-error").html('');
			$("#panel-change-error").addClass("hidden");
			return 1;
		}
	}
</script>