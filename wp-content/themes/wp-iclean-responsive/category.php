<?php
/**
 * The template for displaying Category pages
 * 
 * Used to display archive-type pages for posts in a category.
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package WordPress
 * @subpackage WP iClean Responsive
 * @since 1.0.0
 */

get_header(); ?>

	<section id="primary" class="site-content medium-8 large-8 columns">
		<div id="content">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
                        <?php
				the_archive_title( '<h1 class="archive-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
                        ?>    
			
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile; ?>
                        <div class="pagination text-center">
                            <?php wp_iclean_responsive_paginate_links(); // Pagination ?>
                        </div> 
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>