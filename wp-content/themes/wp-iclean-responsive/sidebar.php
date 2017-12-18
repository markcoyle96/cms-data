<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WP iClean Responsive
 * @since 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="medium-4 large-4 columns widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>