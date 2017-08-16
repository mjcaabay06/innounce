<script type="text/javascript">
	function keyNumber(){
		$("#tb-mobile").keydown(function(e){
			if (!((e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8)) {
				e.preventDefault();
			}
		});

		$(".number-only").keydown(function(e){
			if (!((e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 8)) {
				e.preventDefault();
			}
		});
	}
</script>