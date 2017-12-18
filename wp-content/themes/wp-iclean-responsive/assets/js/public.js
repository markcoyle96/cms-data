(function($) {
 jQuery(document).foundation();
})(jQuery);

jQuery(document).ready(function($) {
 	
	// If go to top is enabled
	

		// Go to top functionality
		jQuery(window).load(function() {
			wpcrt_goto_top();
		});

		jQuery(window).scroll(function() {
			wpcrt_goto_top();
		});

		// BacktoTop
		$('#wpcrt-go-to-top').click(function() {
			$('html, body').animate({
				scrollTop: 0
			}, 1000);

			return false;
		});
	
	
	// Display header search
	jQuery(document).on('click', '#wpcrt-search-nav', function(){
		jQuery( "#wpcrt-search-dropdown" ).slideToggle( "slow" ); 
	});

	$('.flypanels-container').flyPanels({
				treeMenu: {
					init: true
				},
	});
	FastClick.attach(document.body);
    
});

// Function to goto top
function wpcrt_goto_top() {
	var y = jQuery(this).scrollTop();
	 if (y > 80) {
	    jQuery('#wpcrt-go-to-top').fadeIn('slow')
	} else {
	    jQuery('#wpcrt-go-to-top').fadeOut('slow')
	}
}