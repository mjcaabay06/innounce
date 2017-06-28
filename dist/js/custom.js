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

	$.ajax({
		url: url,
		type: "post",
		data: { prof: prof, students: students, message: message },
		success: function(response){
			console.log(response);
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