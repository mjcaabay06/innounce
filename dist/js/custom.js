/* ----- Preloader ----- */
function preloaderLoad() {
    if($('.preloader').length){
        $('.preloader').delay(300).fadeOut(400);
    }
}

/* ----- Send Announcement ----- */
function sendAnnouncement(url) {
	course = $("#a-sel-course").val();
	year = $("#a-sel-year").val();
	subject = $("#a-sel-subject").val();
	section = $("#a-sel-sections").val();


	// prof = !$("#a-check-prof").is(':checked') ? null :$("#a-sel-prof").val();
	// students = !$("#a-check-stud").is(':checked') ? null : $("#a-sel-stud").val();
	message = $("#a-message").val();

	$(".preloader").show();
	$.ajax({
		url: url,
		type: "post",
		data: { course: course, year: year, subject: subject, section: section, message: message },
		success: function(response){
			var result = $.parseJSON(response);

			$("#a-alert-message").html('');
			if (result["status"] == "success") {
				$("#a-alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
				resetAnnouncement();
				setTimeout(function(){
					$("#a-message-list").show();
					$("#a-new-message").hide();
					$("#a-alert-message").html('');
				},1500);
			} else {
				$("#a-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
			}
			$(".preloader").hide();
		}
	});
}

function resetAnnouncement() {
	$("#a-sel-stud option:selected").removeAttr('selected');
	$("#a-check-stud").prop('checked', false);
	$("#a-sel-stud").attr('disabled', '');

	$("#a-check-prof").prop('checked', false);
	$("#a-sel-prof option:selected").removeAttr('selected');
	$("#a-sel-prof").attr('disabled', '');

	$("#a-message").val('');
}

function isCheckProf() {
	$("#a-check-prof").on("change", function(){
		if ($(this).is(':checked')) {
			$("#a-sel-prof").removeAttr('disabled');
		} else {
			$("#a-sel-prof").attr('disabled', '');
		}
	});

	$("#s-check-prof").on("change", function(){
		if ($(this).is(':checked')) {
			$("#s-sel-prof").removeAttr('disabled');
		} else {
			$("#s-sel-prof").attr('disabled', '');
		}
	});
}

function isCheckStud() {
	$("#a-check-stud").on("change", function(){
		if ($(this).is(':checked')) {
			$("#a-sel-stud").removeAttr('disabled');
		} else {
			$("#a-sel-stud").attr('disabled', '');
		}
	});

	$("#s-check-stud").on("change", function(){
		if ($(this).is(':checked')) {
			$("#s-sel-stud").removeAttr('disabled');
		} else {
			$("#s-sel-stud").attr('disabled', '');
		}
	});
}

/* ----- Send Grouping ----- */
function sendGrouping(url) {
	// sections = $("#g-sel-section").val();
	students = $("#g-sel-students").val();
	message = $("#g-message").val();

	$(".preloader").show();
	$.ajax({
		url: url,
		type: 'post',
		data: { action: 'professor',students: students, message: message},
		success: function(response) {
			var result = $.parseJSON(response);

			$("#g-alert-message").html('');
			if (result["status"]) {
				$("#g-alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
				$("#g-sel-stud option:selected").removeAttr('selected');
				$("#g-message").val('');
				setTimeout(function(){
					$("#g-message-list").show();
					$("#g-new-message").hide();
					$("#g-alert-message").html('');
				},1500);
			} else {
				$("#g-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
			}
			$(".preloader").hide();
		}

	});
}

function sendGroupingChairman(url, depId) {
	// sections = $("#g-sel-section").val();
	year = $("#g-sel-year").val();
	message = $("#g-message").val();

	$(".preloader").show();
	$.ajax({
		url: url,
		type: 'post',
		data: { action: 'chairman', depId: depId, year: year, message: message},
		success: function(response) {
			var result = $.parseJSON(response);

			$("#g-alert-message").html('');
			if (result["status"]) {
				$("#g-alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
				$("#g-sel-stud option:selected").removeAttr('selected');
				$("#g-message").val('');
				setTimeout(function(){
					$("#g-message-list").show();
					$("#g-new-message").hide();
					$("#g-alert-message").html('');
				},1500);
			} else {
				$("#g-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
			}
			$(".preloader").hide();
		}

	});
}

function sendGroupingDean(url) {
	// sections = $("#g-sel-section").val();
	year = $("#g-sel-year").val();
	course = $("#g-sel-course").val();
	message = $("#g-message").val();

	$(".preloader").show();
	$.ajax({
		url: url,
		type: 'post',
		data: { action: 'dean', course: course, year: year, message: message},
		success: function(response) {
			var result = $.parseJSON(response);

			$("#g-alert-message").html('');
			if (result["status"]) {
				$("#g-alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
				$("#g-sel-stud option:selected").removeAttr('selected');
				$("#g-message").val('');
				setTimeout(function(){
					$("#g-message-list").show();
					$("#g-new-message").hide();
					$("#g-alert-message").html('');
				},1500);
			} else {
				$("#g-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
			}
			$(".preloader").hide();
		}

	});
}

/* ----- Send Emergency ----- */
function sendEmergency(url) {
	message = $("#e-message").val();

	$(".preloader").show();
	$.ajax({
		url: url,
		type: 'post',
		data: { message: message},
		success: function(response) {
			console.log(response);
			var result = $.parseJSON(response);
			console.log(result["status"]);

			$("#e-alert-message").html('');
			if (result["status"]) {
				$("#e-alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
				$("#e-message").val('');
				setTimeout(function(){
					$("#e-message-list").show();
					$("#e-new-message").hide();
					$("#e-alert-message").html('');
				},1500);
			} else {
				$("#e-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
			}
			$(".preloader").hide();
		}

	});
}

/* ----- Send Survey ----- */
function sendSurvey(url) {
	course = $("#s-sel-course").val();
	year = $("#s-sel-year").val();
	message = $("#s-message").val();

	$(".preloader").show();
	$.ajax({
		url: url,
		type: "post",
		data: { course: course, year: year, message: message },
		success: function(response){
			var result = $.parseJSON(response);

			$("#s-alert-message").html('');
			if (result["status"] == "success") {
				$("#s-alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
				resetSurvey();
				setTimeout(function(){
					$("#s-message-list").show();
					$("#s-new-message").hide();
					$("#s-alert-message").html('');
				},1500);
			} else {
				$("#s-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
			}
			$(".preloader").hide();
		}
	});
}

function resetSurvey() {
	$("#s-sel-stud option:selected").removeAttr('selected');
	$("#s-check-stud").prop('checked', false);
	$("#s-sel-stud").attr('disabled', '');

	$("#s-check-prof").prop('checked', false);
	$("#s-sel-prof option:selected").removeAttr('selected');
	$("#s-sel-prof").attr('disabled', '');

	$("#s-message").val('');
}