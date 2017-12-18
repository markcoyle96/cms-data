<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @package WP iClean Responsive
 * @since 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><i class="page-links-title">' . __( 'Pages:', 'wp-iclean-responsive' ) . '</i>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '%',
				'separator'   => '',
			) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'wp-iclean-responsive' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->

	</article><!-- #post -->