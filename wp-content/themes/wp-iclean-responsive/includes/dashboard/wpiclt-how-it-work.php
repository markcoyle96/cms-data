<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package iClean
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;




// Action to add menu
add_action('admin_menu', 'wpiclt_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package Album and Image Gallery Plus Lightbox
 * @since 1.0.0
 */

  $theme = wp_get_theme();
  $theme_name  = $theme->name;
  $theme_slug  = $theme->template;
  $theme_version  = $theme->version;
  $theme_description  = $theme->description;
 
  
 add_action( 'admin_enqueue_scripts', 'enqueue_scripts'); 
 
 function enqueue_scripts( $hook ) {
        global $theme_name,$theme_slug;
        if ( "appearance_page_{$theme_slug}" !== $hook ) {
                return;
        }
        wp_enqueue_style( "{$theme_slug}-dashboard-style", get_template_directory_uri() . '/includes/dashboard/css/dashboard-style.css' );
}
 

  

function wpiclt_register_design_page() {
    
    global $theme_name,$theme_slug;
    add_theme_page(
			 $theme_name,
			 $theme_name,
			'edit_theme_options',
			 $theme_slug,
			'wpiclt_designs_page' 
    );
}

/**
 * Function to display plugin design HTML
 * 
 * @package Album and Image Gallery Plus Lightbox
 * @since 1.0.0
 */
function wpiclt_designs_page() {
    
        global $theme_name,$theme_slug,$theme_version,$theme_description;
	$wpos_feed_tabs = wpiclt_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'getting-started';
?>
		
	<div class="wrap aigpl-wrap-custom about-wrap">
        <?php include get_template_directory() . '/includes/dashboard/sections/welcome.php'; ?>
		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'page' => $theme_slug, 'tab' => $tab_key), admin_url('themes.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="aigpl-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'getting-started' ) {
				
				wpiclt_getting_started_page();

			}
			else if( isset($active_tab) && $active_tab == 'support' ) {

				wpiclt_support_page();

			}else if( isset($active_tab) && $active_tab == 'our-themes' ) {

				wpiclt_our_themes_page();

			}

		?>
		</div><!-- end .aigpl-tab-cnt-wrp -->

	</div><!-- end .aigpl-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Album and Image Gallery Plus Lightbox
 * @since 1.0.0
 */
function wpiclt_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wpiclt_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'wpiclt_' . $active_tab;
	$url 			= isset($wpos_feed_tabs[$active_tab]['url']) 			? $wpos_feed_tabs[$active_tab]['url'] 				: '';
	$transient_time = isset($wpos_feed_tabs[$active_tab]['transient_time']) ? $wpos_feed_tabs[$active_tab]['transient_time'] 	: 172800;
	$cache 			= get_transient( $transient_key );
	
	if ( false === $cache ) {
		
		$feed           = wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 120, 'sslverify' => false ) );
		$response_code 	= wp_remote_retrieve_response_code( $feed );
		
		if ( ! is_wp_error( $feed ) && $response_code == 200 ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( $transient_key, $cache, $transient_time );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'wp-iclean-responsive' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Album and Image Gallery Plus Lightbox
 * @since 1.0.0
 */
function wpiclt_help_tabs() {
	$wpos_feed_tabs = array(
                                'getting-started' 	=> array(
                                                            'name'              => __('Getting Started', 'wp-iclean-responsive'),
                                                        ),
                                'support' 	=> array(
                                                            'name'              => __('Support', 'wp-iclean-responsive'),
                                                        ),                                
                                'our-themes' 	=> array(
                                                            'name'              => __('Our Themes', 'wp-iclean-responsive'),
                                                        )                                
                                );
	return $wpos_feed_tabs;
}


function wpiclt_getting_started_page() { ?>
	<div class="post-box-container">
		<div id="poststuff">
			<?php include get_template_directory() . '/includes/dashboard/sections/getting-started.php'; ?>				
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }

function wpiclt_support_page() { ?>
	<div class="post-box-container">
		<div id="poststuff">
			<?php include get_template_directory() . '/includes/dashboard/sections/support.php'; ?>				
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }


function wpiclt_our_themes_page() { ?>
	<div class="post-box-container">
		<div id="poststuff">
			<?php include get_template_directory() . '/includes/dashboard/sections/our-themes.php'; ?>	
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }