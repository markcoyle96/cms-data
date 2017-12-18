<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @package WP iClean Responsive
 * @since 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content medium-8 large-8 columns">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			
			<header class="page-header">
				<?php if ( have_posts() ) : ?>
                                        <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wp-iclean-responsive' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                <?php else : ?>
                                        <h1 class="page-title"><?php esc_html_e('Nothing Found', 'wp-iclean-responsive' ); ?></h1>
                                <?php endif; ?>
			</header>
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			
			<?php wp_iclean_responsive_content_nav( 'nav-below' ); ?>
			
		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<?php if ( have_posts() ) : ?>
                                                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wp-iclean-responsive' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                        <?php else : ?>
                                                <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'wp-iclean-responsive' ); ?></h1>
                                        <?php endif; ?>
				</header>

				<div class="entry-content">
					<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'wp-iclean-responsive' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>