<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wp Iclean Responsive
 * @since 1.0
 */
get_header(); ?>
<div id="primary" class="site-content medium-8 large-8 columns">
	<div id="content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php // the_posts_navigation(); ?>
                        <div class="pagination text-center">
                            <?php wp_iclean_responsive_paginate_links(); // Pagination ?>
                        </div> 
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; // end have_posts() check ?>
		<!-- Add the pagination functions here. -->
	</div><!-- end #content -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>