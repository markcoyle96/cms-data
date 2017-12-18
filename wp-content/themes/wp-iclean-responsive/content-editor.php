<?php
/**
 * The default template for home page editor content
 *
 * @package WP iClean Responsive
 * @since 1.0
 */

$home_cnt 		= 1;
$page_cnt_enable	= !empty($home_cnt['page_cnt']['enable']) ? 1 : 0;

if( $page_cnt_enable ) : ?>

<div class="wpcrt-home-part-cnt-wrp wpcrt-home-part-page_cnt clearfix">
	
	<div class="content_wrap row">
		<div class="medium-12 columns">
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="entry-content">
					<?php the_content(); 
					if ( has_post_thumbnail()) { ?>
					<div class="front-page-featured-img text-center">	
					<?php the_post_thumbnail('full'); ?>
					</div>
					<?php } ?>
				</div><!-- .entry-content -->

			<?php endwhile; // end of the loop. ?>
		</div>
	</div><!-- end .content_wrap -->

</div><!-- end .wpcrt-page-cnt-wrp -->

<?php endif ?>