<?php
/**
 * Welcome section.
 *
 * @package iClean
 */

?>
 <h1>
	<?php
	// Translators: %1$s - Theme name, %2$s - Theme version.
	echo esc_html( sprintf( __( 'Welcome to %1$s - V %2$s', 'wp-iclean-responsive' ), $theme_name, $theme_version ) );
	?>
        </h1>
        <div class="about-text"><?php echo esc_html( $theme_description ); ?></div>
        <a target="_blank" href="<?php echo esc_url( "https://www.wponlinesupport.com/themes/" ); ?>" class="wp-badge">iClean</a>
