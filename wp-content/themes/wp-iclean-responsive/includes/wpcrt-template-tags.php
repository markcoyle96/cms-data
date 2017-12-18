<?php
/**
 * Template functions
 * Handles the small HTML of templates
 *
 * @package WP iClean Responsive
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @package WP iClean Responsive
 * @since 1.0.0
 */
function wp_iclean_responsive_post_stats() {
	
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
	
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	
	$posted_on = sprintf(
		_x( '%s', 'post date', 'wp-iclean-responsive' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
        
        $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on"><i class="fa fa-calendar"></i> ' . $posted_on . '</span><span class="byline"><i class="fa fa-user"></i> ' . $byline . '</span>';
	
	$categories_list = get_the_category_list( __( ', ', 'wp-iclean-responsive' ) );
	if ( $categories_list ) {
		printf( '<span class="cat-links"><i class="fa fa-folder"></i> ' . esc_attr__( '%1$s', 'wp-iclean-responsive' ) . '</span>', $categories_list );
	}
	
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comments"></i> ';
		comments_popup_link( __( 'Leave a comment', 'wp-iclean-responsive' ), __( '1 Comment', 'wp-iclean-responsive' ), __( '% Comments', 'wp-iclean-responsive' ) );
		echo '</span>';
	}
	
}


/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @package WP iClean Responsive
 * @since 1.0.0
 */
if ( ! function_exists( 'wp_iclean_responsive_content_nav' ) ) :

function wp_iclean_responsive_content_nav( $html_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="navigation">
			<span class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Next', 'wp-iclean-responsive' ) ); ?></span>
			<span class="nav-next"><?php previous_posts_link( __( 'Previous <span class="meta-nav"></span>', 'wp-iclean-responsive' ) ); ?></span>
		</nav><!-- .navigation -->
	<?php endif;
}
endif;

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wp_iclean_responsive_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @package WP iClean Responsive
 * @since 1.0.0
 */
if ( ! function_exists( 'wp_iclean_responsive_comment' ) ) :

function wp_iclean_responsive_comment( $comment, $args, $depth ) {
	//$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php esc_attr_e( 'Pingback:', 'wp-iclean-responsive' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'wp-iclean-responsive' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . esc_attr__( 'Post author', 'wp-iclean-responsive' ) . '</span>' : ''
					);
					printf( '<a href="%1$s" class="cmnt-dt"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( esc_attr__( '%1$s at %2$s', 'wp-iclean-responsive' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'wp-iclean-responsive' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'wp-iclean-responsive' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wp-iclean-responsive' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
