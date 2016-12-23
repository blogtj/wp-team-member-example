$(document).ready(function() {

	for ( index = 0; index < script_params.posts.length; ++index ) {

	    var id = script_params.posts[index];

		$( ".content_"+id ).hide();

		$( ".toggle_"+id ).click(function(){
			$( ".content_"+id ).show();
			$( ".toggle_"+id ).hide();
		});

		$( ".readless_"+id ).click(function(){
			$( ".content_"+id ).hide();
			$( ".toggle_"+id ).show();
		});
	}

});
