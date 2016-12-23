function readMore_show(id) {
//show content of the post - editor
    jQuery(function ($) {
		$( ".content_"+id ).show();
		$( ".toggle_"+id ).hide();
	});
}
function readMore_hide(id) {
//hide content of the post - editor
    jQuery(function ($) {
		$( ".content_"+id ).hide();
		$( ".toggle_"+id ).show();
	});
}
