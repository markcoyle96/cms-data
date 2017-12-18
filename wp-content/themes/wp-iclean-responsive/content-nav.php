<?php
/**
 * The template used for displaying header navigation
 *
 * @package WordPress
 * @package WP iClean Responsive
 * @since 1.0
 */
?>

<div class="navigation-main small-2 medium-9 large-9 columns">	
						<div class="top-bar" data-topbar role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'wp-iclean-responsive' ); ?>">									
								<div class="medium-11 hide-for-small-only columns">
								<?php if( has_nav_menu('primary') ) { 
									wp_nav_menu( array(
									'theme_location'	=> 'primary',
									'container' 		=> false,
									'depth' 			=> 0,
									'items_wrap' 		=> '<ul class="dropdown menu top-bar-right" data-dropdown-menu>%3$s</ul>',
									'fallback_cb' 		=> '', // workaround to show a message to set up a menu
									'walker' 			=> new Wp_Iclean_Responsive_Nv_Wkr( array(
										'in_top_bar' 	=> true,
										'item_type' 	=> 'li',
										'menu_type' 	=> 'main-menu'
										)),
									));
								 } ?>
								</div><!-- end .top-bar-section -->
								
								
								<?php get_template_part("search-top-nav"); ?>

							
						</div>
				</div><!-- end .navigation-main -->