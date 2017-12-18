<?php
/**
 * The Template for displaying all single posts
 *
 * @package WP iClean Responsive
 * @since 1.0
 */

get_header(); ?>
	
	<div id="primary" class="site-content medium-8 large-8 columns">
		<div id="content">
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'content', get_post_format() ); ?>
                    
                    
                                <nav class="nav-single">
				 <?php 
                                the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'wp-iclean-responsive' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'wp-iclean-responsive' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"></span></span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'wp-iclean-responsive' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'wp-iclean-responsive' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"></span></span>',
				) );
                                ?>
				</nav><!-- .nav-single -->
				
				

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>