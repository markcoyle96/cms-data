<?php
/**
 * The template for displaying Comments
 *
 * @package WP iClean Responsive
 * @since 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

		<?php if ( have_comments() ) : ?>

		<div id="comments" class="comments-area">

			<h2 class="comments-title">
                            <?php
                                $comments_number = get_comments_number();
                                if ( '1' === $comments_number ) {
                                        /* translators: %s: post title */
                                        printf( esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'wp-iclean-responsive' ), get_the_title() );
                                } else {
                                        printf(
                                                /* translators: 1: number of comments, 2: post title */
                                                esc_html(
                                                        '%1$s thought on &ldquo;%2$s&rdquo;',
                                                        '%1$s thoughts on &ldquo;%2$s&rdquo;',
                                                        $comments_number,
                                                        'comments title',
                                                        'wp-iclean-responsive'
                                                ),
                                                esc_html( number_format_i18n( $comments_number )),
                                               get_the_title()
                                        );
                                }
                                ?>
			</h2>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'wp_iclean_responsive_comment', 'style' => 'ol' ) ); ?>
			</ol><!-- .commentlist -->
                        
                       

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'wp-iclean-responsive' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wp-iclean-responsive' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wp-iclean-responsive' ) ); ?></div>
			</nav>
			<?php endif; // check for comment navigation ?>

			<?php
			/* If there are no comments and comments are closed, let's leave a note.
			 * But we only want the note on posts and pages that had comments in the first place.
			 */
			if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.' , 'wp-iclean-responsive' ); ?></p>
			<?php endif; ?>

		</div><!-- #comments .comments-area -->
		<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

