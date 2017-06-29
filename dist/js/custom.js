/* ----- Preloader ----- */
function preloaderLoad() {
    if($('.preloader').length){
        $('.preloader').delay(300).fadeOut(400);
    }
}

/* ----- Send Announcement ----- */
function sendAnnouncement(url) {
	prof = !$("#a-check-prof").is(':checked') ? null :$("#a-sel-prof").val();
	students = !$("#a-check-stud").is(':checked') ? null : $("#a-sel-stud").val();
	message = $("#a-message").val();

	$(".preloader").show();
	$.ajax({
		url: url,
		type: "post",
		data: { prof: prof, students: students, message: message },
		success: function(response){
			//console.log(response);
			var result = jQuery.parseJSON(response);
			console.log(result["status"]);

			$("#a-alert-message").html('');
			if (result["status"] == 'true') {
				$("#a-alert-message").html('<div class="alert alert-success">' + result['message'] + '</div>');
			} else {
				$("#a-alert-message").html('<div class="alert alert-danger">' + result['message'] + '</div>');
			}
			$(".preloader").hide();
		}
	});
}

function isCheckProf() {
	$("#a-check-prof").on("change", function(){
		if ($(this).is(':checked')) {
			$("#a-sel-prof").removeAttr('disabled');
		} else {
			$("#a-sel-prof").attr('disabled', '');
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
}