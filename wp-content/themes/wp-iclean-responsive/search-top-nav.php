<?php
/**
 * The template used for displaying header search
 *
 * @package WordPress
 * @package WP iClean Responsive
 * @since 1.0
 */
?>

<div class="small-12 medium-1 columns search-nav">

	<div  id="wpcrt-search-nav">
		<span class="wpcrt-search-nav"><i class="fa fa-search fa-2"></i></span>		
	</div><!--wpcrt-search-nav-->

	<div id="wpcrt-search-dropdown">

		<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">	
			<div>			
				<input placeholder="<?php esc_attr_e('Type search term and press enter', 'wp-iclean-responsive' ); ?>" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
			</div>
		</form><!-- end #searchform -->

	</div><!--wpcrt-search-dropdown-->

</div><!-- end .search-nav -->


