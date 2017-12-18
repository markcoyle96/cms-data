<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WP iClean Responsive
 * @since 1.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		

		<?php
		// If post thumbnail is there and featured image is not hide on index, home and archieve page
		if ( has_post_thumbnail()) {
			$format = get_post_format();
		?>
			<div class="post-thumbnail">
				<span class="deco-lines deco-lines-top"></span>
				<?php 

				if ( get_post_gallery() ) {
	            	$gallery = get_post_gallery( get_the_ID(), false );

		            if( !empty($gallery['ids']) ) {

		           	 	$ids = explode( ",", $gallery['ids'] );?>
		           	 	<div class="orbit" data-orbit>
							<ul class="orbit-container">
								<?php foreach( $ids as $id ) :
								$link   = wp_get_attachment_url( $id );?>
								<li class="orbit-slide">
									<img src="<?php echo esc_url($link); ?>" class="orbit-image" alt="<?php esc_attr_e('Gallery image','wp-iclean-responsive') ?>" />
								</li>
								<?php
							endforeach;?>
							</ul>
			        	</div>
        		<?php } // End of inner if
        		} else { ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('full'); ?></a>
				<?php } ?>

				<div class="large-icon">
					<div class="post-icon ">
						<div class="post-icon-inner">
							<span><i class="<?php echo esc_attr(wp_iclean_responsive_post_format_cls( $format )); ?>"></i></span>
						</div><!-- end post-icon-inner -->
						<div class="post-icon-outer"><span></span></div><!-- end post-icon-outer -->
					</div><!-- end featured-post-icon -->
				</div><!-- end .large-icon -->
				<span class="deco-lines deco-lines-bottom"></span>
			</div><!-- end .post-thumbnail -->
		<?php } ?>
		<header class="title">			
			
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php endif; // is_single() ?>
			
			<div class="entry-meta">
				<?php
				if( !is_page() ) { 
					wp_iclean_responsive_post_stats(); // Post Stats Meta
				}
				?>
				
				<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php
							/** This filter is documented in author.php */
							$author_bio_avatar_size = apply_filters( 'wp_iclean_responsive_author_avatar_size', 68 );
							echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
							?>
						</div><!-- .author-avatar -->
						<div class="author-description">
							<h2><?php printf( __( 'About %s', 'wp-iclean-responsive' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
							<div class="author-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wp-iclean-responsive' ), get_the_author() ); ?>
								</a>
							</div><!-- .author-link	-->
						</div><!-- .author-description -->
					</div><!-- .author-info -->
				<?php endif; ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		
		<div class="entry-content">
			<?php
				if(is_single() ) {
					the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp-iclean-responsive' ) );
				} else {
					the_excerpt();
				?>

				<a href="<?php the_permalink();?>" class="button post-btn" ><?php esc_html_e('Continue reading', 'wp-iclean-responsive'); ?></a>
					

				<?php }
			?>
			<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><i class="page-links-title">' . __( 'Pages:', 'wp-iclean-responsive' ) . '</i>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '%',
				'separator'   => '',
			) ); ?>
		</div><!-- .entry-content -->

		
	</article><!-- #post -->