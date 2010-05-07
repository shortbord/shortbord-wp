jQuery(document).ready(function($) {
	$('#shortbord-send-content').change(function(event) {
		var $this = $(this);
		if($this.is(':checked')) {
			$('#comment-privacy').show();
		} else {
			$('#comment-privacy').hide();
		}
	}).change();
});