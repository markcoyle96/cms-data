<?php
/**
  Plugin Name: Blog Designer
  Plugin URI: https://wordpress.org/plugins/blog-designer/
  Description: To make your blog design more pretty, attractive and colorful.
  Version: 1.8.4.1
  Author: Solwin Infotech
  Author URI: https://www.solwininfotech.com/
  Requires at least: 4.0
  Tested up to: 4.9

  Text Domain: blog-designer
  Domain Path: /languages/
 */
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

define('BLOGDESIGNER_URL', plugins_url() . '/blog-designer');
define('BLOGDESIGNER_DIR', WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)));
register_activation_hook(__FILE__, 'wp_blog_designer_plugin_activate');
add_action('admin_menu', 'wp_blog_designer_add_menu');
add_action('admin_init', 'wp_blog_designer_reg_function', 5);
add_action('admin_enqueue_scripts', 'wp_blog_designer_admin_stylesheet', 7);
add_action('admin_init', 'wp_blog_designer_save_settings', 10);
add_action('wp_enqueue_scripts', 'wp_blog_designer_front_stylesheet');
add_action('admin_init', 'wp_blog_designer_admin_scripts');
add_action('wp_head', 'wp_blog_designer_stylesheet', 20);
add_shortcode('wp_blog_designer', 'wp_blog_designer_views');
add_action('admin_enqueue_scripts', 'wp_blog_designer_enqueue_color_picker',9);
add_action('wp_head', 'bd_ajaxurl', 5);
add_action('wp_ajax_nopriv_bd_get_page_link', 'bd_get_page_link');
add_action('wp_ajax_bd_get_page_link', 'bd_get_page_link');
add_action('wp_ajax_bd_closed_bdboxes', 'bd_closed_bdboxes');
add_action('wp_ajax_bd_sbtDeactivationform', 'db_sbt_deactivation_form');
add_action('wp_ajax_bd_template_search_result', 'bd_template_search_result');
add_filter('excerpt_length', 'wp_blog_designer_excerpt_length', 999);
add_action('plugins_loaded', 'latest_news_solwin_feed');
add_action('admin_head', 'bdp_upgrade_link_css');

add_action('vc_before_init', 'bd_add_vc_support');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'bd_plugin_links');

require_once BLOGDESIGNER_DIR . '/includes/promo_notice.php';


/**
 * Add support for visual composer
 */
if (!function_exists('bd_add_vc_support')) {

    function bd_add_vc_support() {
        vc_map(array(
            "name" => esc_html__("Blog Designer", "blog-designer"),
            "base" => "wp_blog_designer",
            "class" => "blog_designer_section",
            'show_settings_on_create' => false,
            "category" => esc_html__('Content'),
            "icon" => 'blog_designer_icon',
            "description" => __("Custom Blog Layout", "blog-designer")
        ));
    }

}

/**
 * Add css for upgrade link
 */
if (!function_exists('bdp_upgrade_link_css')) {

    function bdp_upgrade_link_css() {
        echo '<style>.row-actions a.bd_upgrade_link { color: #4caf50; }</style>';
    }

}

if (!function_exists('wp_blog_designer_enqueue_color_picker')) {

    function wp_blog_designer_enqueue_color_picker($hook_suffix) {
        // first check that $hook_suffix is appropriate for your admin page
        if (isset($_GET['page']) && ($_GET['page'] == 'designer_settings' || $_GET['page'] == 'about_blog_designer') || $hook_suffix == 'plugins.php') {
            wp_enqueue_style(array('wp-color-picker', 'wp-jquery-ui-dialog'));
            wp_enqueue_script('my-script-handle', plugins_url('js/admin_script.js', __FILE__), array('wp-color-picker', 'jquery-ui-core', 'jquery-ui-dialog'), false, true);
            wp_localize_script('my-script-handle', 'bdlite_js', array(
                    'nothing_found' => __("Oops, nothing found!", "blog-designer"),
                    'reset_data' => __("Do you want to reset data?", "blog-designer"),
                    'choose_blog_template' => __("Choose the blog template you love", "blog-designer"),
                    'close' => __("Close", "blog-designer"),
                    'set_blog_template' => __("Set Blog Template", "blog-designer"),
                    'default_style_template' => __("Apply default style of this selected template", "blog-designer"),
                    'no_template_exist' => __("No template exist for selection", "blog-designer"),
                )
            );
            wp_enqueue_script('my-chosen-handle', plugins_url('js/chosen.jquery.js', __FILE__));
        }
    }

}

/**
 *
 * @return add menu at admin panel
 */
if (!function_exists('wp_blog_designer_add_menu')) {

    function wp_blog_designer_add_menu() {
        add_menu_page(__('Blog Designer', 'blog-designer'), __('Blog Designer', 'blog-designer'), 'administrator', 'designer_settings', 'wp_blog_designer_menu_function', BLOGDESIGNER_URL . '/images/blog-designer.png');
        add_submenu_page('designer_settings', __('Blog designer Settings', 'blog-designer'), __('Blog Designer Settings', 'blog-designer'), 'manage_options', 'designer_settings', 'wp_blog_designer_add_menu');
        add_submenu_page('designer_settings', __('About Blog Designer', 'blog-designer'), __('About Blog Designer', 'blog-designer'), 'manage_options', 'about_blog_designer', 'wp_blog_designer_about_us');
    }

}

/**
 * Include admin shortcode list page
 */
if (!function_exists('wp_blog_designer_about_us')) {

    function wp_blog_designer_about_us() {
        include_once( 'includes/about_us.php' );
    }

}

/**
 *
 * @return Loads plugin textdomain
 */
if (!function_exists('load_language_files')) {

    function load_language_files() {
        load_plugin_textdomain('blog-designer', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

}

add_action('plugins_loaded', 'load_language_files');

/**
 * Deactive pro version when lite version is activated
 */
if (!function_exists('wp_blog_designer_plugin_activate')) {

    function wp_blog_designer_plugin_activate() {
        if (is_plugin_active('blog-designer-pro/blog-designer-pro.php')) {
            deactivate_plugins('/blog-designer-pro/blog-designer-pro.php');
        }
    }

}

if (!function_exists('latest_news_solwin_feed')) {

    function latest_news_solwin_feed() {
        // Register the new dashboard widget with the 'wp_dashboard_setup' action
        add_action('wp_dashboard_setup', 'solwin_latest_news_with_product_details');
        if (!function_exists('solwin_latest_news_with_product_details')) {

            function solwin_latest_news_with_product_details() {
                add_screen_option('layout_columns', array('max' => 3, 'default' => 2));
                add_meta_box('wp_blog_designer_dashboard_widget', __('News From Solwin Infotech', 'blog-designer'), 'solwin_dashboard_widget_news', 'dashboard', 'normal', 'high');
            }

        }
        if (!function_exists('solwin_dashboard_widget_news')) {

            function solwin_dashboard_widget_news() {
                echo '<div class="rss-widget">'
                . '<div class="solwin-news"><p><strong>' . __('Solwin Infotech News', 'blog-designer') . '</strong></p>';
                wp_widget_rss_output(array(
                    'url' => esc_url('https://www.solwininfotech.com/feed/'),
                    'title' => __('News From Solwin Infotech', 'blog-designer'),
                    'items' => 5,
                    'show_summary' => 0,
                    'show_author' => 0,
                    'show_date' => 1
                ));
                echo '</div>';
                $title = $link = $thumbnail = "";
                //get Latest product detail from xml file

                $file = 'https://www.solwininfotech.com/documents/assets/latest_product.xml';
                define('LATEST_PRODUCT_FILE', $file);
                echo '<div class="display-product">'
                . '<div class="product-detail"><p><strong>' . __('Latest Product', 'blog-designer') . '</strong></p>';
                $response = wp_remote_post(LATEST_PRODUCT_FILE);
                if (is_wp_error($response)) {
                    $error_message = $response->get_error_message();
                    echo "<p>" . __('Something went wrong', 'blog-designer') . " : $error_message" . "</p>";
                } else {
                    $body = wp_remote_retrieve_body($response);
                    $xml = simplexml_load_string($body);
                    $title = $xml->item->name;
                    $thumbnail = $xml->item->img;
                    $link = $xml->item->link;

                    $allProducttext = $xml->item->viewalltext;
                    $allProductlink = $xml->item->viewalllink;
                    $moretext = $xml->item->moretext;
                    $needsupporttext = $xml->item->needsupporttext;
                    $needsupportlink = $xml->item->needsupportlink;
                    $customservicetext = $xml->item->customservicetext;
                    $customservicelink = $xml->item->customservicelink;
                    $joinproductclubtext = $xml->item->joinproductclubtext;
                    $joinproductclublink = $xml->item->joinproductclublink;


                    echo '<div class="product-name"><a href="' . $link . '" target="_blank">'
                    . '<img alt="' . $title . '" src="' . $thumbnail . '"> </a>'
                    . '<a href="' . $link . '" target="_blank">' . $title . '</a>'
                    . '<p><a href="' . $allProductlink . '" target="_blank" class="button button-default">' . $allProducttext . ' &RightArrow;</a></p>'
                    . '<hr>'
                    . '<p><strong>' . $moretext . '</strong></p>'
                    . '<ul>'
                    . '<li><a href="' . $needsupportlink . '" target="_blank">' . $needsupporttext . '</a></li>'
                    . '<li><a href="' . $customservicelink . '" target="_blank">' . $customservicetext . '</a></li>'
                    . '<li><a href="' . $joinproductclublink . '" target="_blank">' . $joinproductclubtext . '</a></li>'
                    . '</ul>'
                    . '</div>';
                }
                echo '</div></div><div class="clear"></div></div>';
            }

        }
    }

}

/**
 * Custom Admin Footer
 */
add_action('current_screen', 'bd_footer');
if (!function_exists('bd_footer')) {

    function bd_footer() {
        if (isset($_GET['page']) && ($_GET['page'] == 'designer_settings' || $_GET['page'] == 'about_blog_designer')) {
            add_filter('admin_footer_text', 'bd_remove_footer_admin', 11);
            if (!function_exists('bd_remove_footer_admin')) {

                function bd_remove_footer_admin() {
                    ob_start();
                    ?>
                    <p id="footer-left" class="alignleft">
                        <?php _e('If you like ', 'blog-designer'); ?>
                        <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-plugins/blog-designer/'); ?>" target="_blank"><strong><?php _e('Blog Designer', 'blog-designer'); ?></strong></a>
                        <?php _e('please leave us a', 'blog-designer'); ?>
                        <a class="bdp-rating-link" data-rated="Thanks :)" target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/blog-designer/reviews?filter=5#new-post'); ?>">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605;</a>
                        <?php _e('rating. A huge thank you from Solwin Infotech in advance!', 'blog-designer'); ?>
                    </p><?php
                    return ob_get_clean();
                }

            }
        }
    }

}

/**
 * Get template list
 */
if (!function_exists('bd_template_list')) {

    function bd_template_list() {
        $tempate_list = array(
            'boxy' => array(
                'template_name' => __('Boxy Template', 'blog-designer'),
                'class' => 'masonry grid odd-even',
                'image_name' => 'boxy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-boxy-blog-template/')
            ),
            'boxy-clean' => array(
                'template_name' => __('Boxy Clean Template', 'blog-designer'),
                'class' => 'masonry grid odd-even',
                'image_name' => 'boxy-clean.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-boxy-clean-blog-template/')
            ),
            'brit_co' => array(
                'template_name' => __('Brit Co Template', 'blog-designer'),
                'class' => 'grid odd-even',
                'image_name' => 'brit_co.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-brit-co-blog-template/')
            ),
            'classical' => array(
                'template_name' => __('Classical Template', 'blog-designer'),
                'class' => 'full-width free',
                'image_name' => 'classical.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-classical-blog-template/')
            ),
            'cool_horizontal' => array(
                'template_name' => __('Cool Horizontal Template', 'blog-designer'),
                'class' => 'horizontal timeline',
                'image_name' => 'cool_horizontal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-cool-horizontal-timeline-blog-template/')
            ),
            'deport' => array(
                'template_name' => __('Deport Template', 'blog-designer'),
                'class' => 'odd-even',
                'image_name' => 'deport.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-deport-blog-template/')
            ),
            'easy_timeline' => array(
                'template_name' => __('Easy Timeline', 'blog-designer'),
                'class' => 'story',
                'image_name' => 'easy_timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-easy-timeline-blog-template/')
            ),
            'elina' => array(
                'template_name' => __('Elina Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'elina.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-elina-blog-template/')
            ),
            'evolution' => array(
                'template_name' => __('Evolution Template', 'blog-designer'),
                'class' => 'full-width free',
                'image_name' => 'evolution.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-evolution-blog-template/')
            ),
            'glossary' => array(
                'template_name' => __('Glossary Template', 'blog-designer'),
                'class' => 'grid masonry odd-even',
                'image_name' => 'glossary.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-glossary-blog-template/')
            ),
            'explore' => array(
                'template_name' => __('Explore Template', 'blog-designer'),
                'class' => 'grid',
                'image_name' => 'explore.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-explore-blog-template/')
            ),
            'hoverbic' => array(
                'template_name' => __('Hoverbic Template', 'blog-designer'),
                'class' => 'grid',
                'image_name' => 'hoverbic.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-hoverbic-blog-template/')
            ),
            'hub' => array(
                'template_name' => __('Hub Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'hub.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-hub-blog-template/')
            ),
            'masonry_timeline' => array(
                'template_name' => __('Masonry Timeline', 'blog-designer'),
                'class' => 'timeline odd-even',
                'image_name' => 'masonry_timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-masonry-timeline-blog-template/')
            ),
            'invert-grid' => array(
                'template_name' => __('Invert Grid Template', 'blog-designer'),
                'class' => 'odd-even',
                'image_name' => 'invert-grid.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-invert-grid-blog-template/')
            ),
            'lightbreeze' => array(
                'template_name' => __('Lightbreeze Template', 'blog-designer'),
                'class' => 'full-width box-view free',
                'image_name' => 'lightbreeze.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-light-breeze-blog-template/')
            ),
            'media-grid' => array(
                'template_name' => __('Media Grid Template', 'blog-designer'),
                'class' => 'odd-even',
                'image_name' => 'media-grid.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-media-grid-blog-template/')
            ),
            'my_diary' => array(
                'template_name' => __('My Diary Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'my_diary.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-my-diary-blog-template/')
            ),
            'navia' => array(
                'template_name' => __('Navia Template', 'blog-designer'),
                'class' => 'odd-even',
                'image_name' => 'navia.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-navia-blog-template/')
            ),
            'news' => array(
                'template_name' => __('News Template', 'blog-designer'),
                'class' => 'odd-even free',
                'image_name' => 'news.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-news-blog-template/')
            ),
            'offer_blog' => array(
                'template_name' => __('Offer Blog Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'offer_blog.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-offer-blog-template/')
            ),
            'overlay_horizontal' => array(
                'template_name' => __('Overlay Horizontal Template', 'blog-designer'),
                'class' => 'horizontal timeline',
                'image_name' => 'overlay_horizontal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-overlay-horizontal-timeline-blog-template/')
            ),
            'nicy' => array(
                'template_name' => __('Nicy Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'nicy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-nicy-blog-template/')
            ),
            'region' => array(
                'template_name' => __('Region Template', 'blog-designer'),
                'class' => 'box-view',
                'image_name' => 'region.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-region-blog-template/')
            ),
            'sharpen' => array(
                'template_name' => __('Sharpen Template', 'blog-designer'),
                'class' => 'full-width box-view',
                'image_name' => 'sharpen.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-sharpen-blog-template/')
            ),
            'spektrum' => array(
                'template_name' => __('Spektrum Template', 'blog-designer'),
                'class' => 'full-width free',
                'image_name' => 'spektrum.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-spektrum-blog-template/')
            ),
            'story' => array(
                'template_name' => __('Story Template', 'blog-designer'),
                'class' => 'timeline',
                'image_name' => 'story.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-story-timeline-blog-template/')
            ),
            'timeline' => array(
                'template_name' => __('Timeline Template', 'blog-designer'),
                'class' => 'odd-even timeline free',
                'image_name' => 'timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-timeline-blog-template/')
            ),
            'winter' => array(
                'template_name' => __('Winter Template', 'blog-designer'),
                'class' => 'box-view',
                'image_name' => 'winter.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-winter-blog-template/')
            ),
            'crayon_slider' => array(
                'template_name' => __('Crayon Slider Template', 'blog-designer'),
                'class' => 'slider',
                'image_name' => 'crayon_slider.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-crayon-slider-blog-template/')
            ),
            'sallet_slider' => array(
                'template_name' => __('Sallet Slider Template', 'blog-designer'),
                'class' => 'slider',
                'image_name' => 'sallet_slider.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-sallet-slider-blog-template/')
            ),
            'sunshiny_slider' => array(
                'template_name' => __('Sunshiny Slider Template', 'blog-designer'),
                'class' => 'slider',
                'image_name' => 'sunshiny_slider.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-sunshiny-slider-blog-template/')
            ),
            'pretty' => array(
                'template_name' => __('Pretty Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'pretty.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-pretty-blog-template/')
            ),
            'tagly' => array(
                'template_name' => __('Tagly Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'tagly.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-tagly-blog-template/')
            ),
            'brite' => array(
                'template_name' => __('Brite Template', 'blog-designer'),
                'class' => 'full-width',
                'image_name' => 'brite.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-brite-blog-template/')
            ),
            'chapter' => array(
                'template_name' => __('Chapter Template', 'blog-designer'),
                'class' => 'grid',
                'image_name' => 'chapter.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-chapter-blog-template/')
            ),
        );
        ksort($tempate_list);
        return $tempate_list;
    }

}

/**
 * Ajax handler for Store closed box id
 */
if (!function_exists('bd_closed_bdboxes')) {

    function bd_closed_bdboxes() {
        $closed = isset($_POST['closed']) ? explode(',', $_POST['closed']) : array();
        $closed = array_filter($closed);
        $page = isset($_POST['page']) ? $_POST['page'] : '';
        if ($page != sanitize_key($page))
            wp_die(0);
        if (!$user = wp_get_current_user())
            wp_die(-1);
        if (is_array($closed))
            update_user_option($user->ID, "bdpclosedbdpboxes_$page", $closed, true);
        wp_die(1);
    }

}

function bd_ajaxurl() {
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}

/**
 * Ajax handler for page link
 */
if (!function_exists('bd_get_page_link')) {

    function bd_get_page_link() {
        if (isset($_POST['page_id'])) {
            echo '<a target="_blank" href="' . get_permalink($_POST['page_id']) . '">' . __('View Blog', 'blog-designer') . '</a>';
        }
        exit();
    }

}

/**
 *
 * @param type $id
 * @param type $page
 * @return type closed class
 */
if (!function_exists('bdp_postbox_classes')) {

    function bdp_postbox_classes($id, $page) {
        if (!isset($_GET['action'])) {
            $closed = array('bdpgeneral');
            $closed = array_filter($closed);
            $page = 'designer_settings';
            $user = wp_get_current_user();
            if (is_array($closed))
                update_user_option($user->ID, "bdpclosedbdpboxes_$page", $closed, true);
        }
        if ($closed = get_user_option('bdpclosedbdpboxes_' . $page)) {
            if (!is_array($closed)) {
                $classes = array('');
            } else {
                $classes = in_array($id, $closed) ? array('closed') : array('');
            }
        } else {
            $classes = array('');
        }
        return implode(' ', $classes);
    }

}

/**
 *
 * @return Set default value
 */
if (!function_exists('wp_blog_designer_reg_function')) {

    function wp_blog_designer_reg_function() {
        $settings = get_option("wp_blog_designer_settings");
        if (empty($settings)) {
            $settings = array(
                'template_category' => '',
                'template_name' => 'classical',
                'template_bgcolor' => '#ffffff',
                'template_color' => '#ffffff',
                'template_ftcolor' => '#2a97ea',
                'template_fthovercolor' => '#999999',
                'template_titlecolor' => '#222222',
                'template_titlebackcolor' => '#ffffff',
                'template_contentcolor' => '#999999',
                'template_readmorecolor' => '#cecece',
                'template_readmorebackcolor' => '#2e93ea',
                'template_alterbgcolor' => '#ffffff',
            );
            update_option("posts_per_page", '5');
            update_option("display_sticky", '1');
            update_option("display_category", '0');
            update_option("social_icon_style", '0');
            update_option("rss_use_excerpt", '1');
            update_option("template_alternativebackground", '1');
            update_option("display_tag", '0');
            update_option("display_author", '0');
            update_option("display_date", '0');
            update_option("facebook_link", '0');
            update_option("twitter_link", '0');
            update_option("google_link", '0');
            update_option("linkedin_link", '0');
            update_option("pinterest_link", '0');
            update_option("display_comment_count", '0');
            update_option("excerpt_length", '75');
            update_option("display_html_tags", '0');
            update_option("read_more_on", '2');
            update_option("read_more_text", 'Read More');
            update_option("template_titlefontsize", '35');
            update_option("content_fontsize", '14');
            update_option("wp_blog_designer_settings", $settings);
        }
    }

}

if (!function_exists('wp_blog_designer_save_settings')) {

    function wp_blog_designer_save_settings() {
        if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'save' && isset($_REQUEST['updated']) && $_REQUEST['updated'] === 'true') {
            if (isset($_POST['blog_page_display'])) {
                update_option("blog_page_display", $_POST['blog_page_display']);
            }
            if (isset($_POST['posts_per_page'])) {
                update_option("posts_per_page", $_POST['posts_per_page']);
            }
            if (isset($_POST['rss_use_excerpt'])) {
                update_option("rss_use_excerpt", $_POST['rss_use_excerpt']);
            }
            if (isset($_POST['display_date'])) {
                update_option("display_date", $_POST['display_date']);
            }
            if (isset($_POST['display_author'])) {
                update_option("display_author", $_POST['display_author']);
            }
            if (isset($_POST['display_sticky'])) {
                update_option("display_sticky", $_POST['display_sticky']);
            }
            if (isset($_POST['display_category'])) {
                update_option("display_category", $_POST['display_category']);
            }
            if (isset($_POST['display_tag'])) {
                update_option("display_tag", $_POST['display_tag']);
            }
            if (isset($_POST['txtExcerptlength'])) {
                update_option("excerpt_length", $_POST['txtExcerptlength']);
            }
            if (isset($_POST['display_html_tags'])) {
                update_option("display_html_tags", $_POST['display_html_tags']);
            } else {
                update_option("display_html_tags", 0);
            }
            if (isset($_POST['readmore_on'])) {
                update_option("read_more_on", $_POST['readmore_on']);
            }
            if (isset($_POST['txtReadmoretext'])) {
                update_option("read_more_text", $_POST['txtReadmoretext']);
            }
            if (isset($_POST['template_alternativebackground'])) {
                update_option("template_alternativebackground", $_POST['template_alternativebackground']);
            }
            if (isset($_POST['social_icon_style'])) {
                update_option("social_icon_style", $_POST['social_icon_style']);
            }
            if (isset($_POST['facebook_link'])) {
                update_option("facebook_link", $_POST['facebook_link']);
            }
            if (isset($_POST['twitter_link'])) {
                update_option("twitter_link", $_POST['twitter_link']);
            }
            if (isset($_POST['google_link'])) {
                update_option("google_link", $_POST['google_link']);
            }
            if (isset($_POST['pinterest_link'])) {
                update_option("pinterest_link", $_POST['pinterest_link']);
            }
            if (isset($_POST['linkedin_link'])) {
                update_option("linkedin_link", $_POST['linkedin_link']);
            }
            if (isset($_POST['display_comment_count'])) {
                update_option("display_comment_count", $_POST['display_comment_count']);
            }
            if (isset($_POST['template_titlefontsize'])) {
                update_option("template_titlefontsize", $_POST['template_titlefontsize']);
            }
            if (isset($_POST['content_fontsize'])) {
                update_option("content_fontsize", $_POST['content_fontsize']);
            }
            if (isset($_POST['custom_css'])) {
                update_option("custom_css", stripslashes($_POST['custom_css']));
            }
            $templates = array();
            $templates['ID'] = $_POST['blog_page_display'];
            $templates['post_content'] = '[wp_blog_designer]';
            wp_update_post($templates);

            $settings = $_POST;
            $settings = is_array($settings) ? $settings : unserialize($settings);
            $updated = update_option("wp_blog_designer_settings", $settings);
        }
    }

}

/**
 *
 * @return Display total downloads of plugin
 */
if (!function_exists('get_total_downloads')) {

    function get_total_downloads() {
        // Set the arguments. For brevity of code, I will set only a few fields.
        $plugins = $response = "";
        $args = array(
            'author' => 'solwininfotech',
            'fields' => array(
                'downloaded' => true,
                'downloadlink' => true
            )
        );
        // Make request and extract plug-in object. Action is query_plugins
        $response = wp_remote_post(
                'http://api.wordpress.org/plugins/info/1.0/', array(
            'body' => array(
                'action' => 'query_plugins',
                'request' => serialize((object) $args)
            )
                )
        );
        if (!is_wp_error($response)) {
            $returned_object = unserialize(wp_remote_retrieve_body($response));
            $plugins = $returned_object->plugins;
        }

        $current_slug = 'blog-designer';
        if ($plugins) {
            foreach ($plugins as $plugin) {
                if ($current_slug == $plugin->slug) {
                    if ($plugin->downloaded) {
                        ?>
                        <span class="total-downloads">
                            <span class="download-number"><?php echo $plugin->downloaded; ?></span>
                        </span>
                        <?php
                    }
                }
            }
        }
    }

}

/**
 *
 * @return Display rating of plugin
 */
$wp_version = get_bloginfo('version');
if ($wp_version > 3.8) {
    if (!function_exists('wp_custom_star_rating')) {

        function wp_custom_star_rating($args = array()) {
            $plugins = $response = "";
            $args = array(
                'author' => 'solwininfotech',
                'fields' => array(
                    'downloaded' => true,
                    'downloadlink' => true
                )
            );

            // Make request and extract plug-in object. Action is query_plugins
            $response = wp_remote_post(
                    'http://api.wordpress.org/plugins/info/1.0/', array(
                'body' => array(
                    'action' => 'query_plugins',
                    'request' => serialize((object) $args)
                )
                    )
            );
            if (!is_wp_error($response)) {
                $returned_object = unserialize(wp_remote_retrieve_body($response));
                $plugins = $returned_object->plugins;
            }
            $current_slug = 'blog-designer';
            if ($plugins) {
                foreach ($plugins as $plugin) {
                    if ($current_slug == $plugin->slug) {
                        $rating = $plugin->rating * 5 / 100;
                        if ($rating > 0) {
                            $args = array(
                                'rating' => $rating,
                                'type' => 'rating',
                                'number' => $plugin->num_ratings,
                            );
                            wp_star_rating($args);
                        }
                    }
                }
            }
        }

    }
}

/**
 *
 * @return Enqueue admin panel required css
 */
if (!function_exists('wp_blog_designer_admin_stylesheet')) {

    function wp_blog_designer_admin_stylesheet() {
        $screen = get_current_screen();

        wp_register_style('wp-blog-designer-admin-support-stylesheets', plugins_url('css/blog_designer_editor_support.css', __FILE__));
        wp_enqueue_style('wp-blog-designer-admin-support-stylesheets');

        if ((isset($_GET['page']) && ( $_GET['page'] == 'designer_settings' || $_GET['page'] == 'about_blog_designer')) || $screen->id == 'dashboard') {
            $adminstylesheetURL = plugins_url('css/admin.css', __FILE__);
            $adminstylesheet = dirname(__FILE__) . '/css/admin.css';
            if (file_exists($adminstylesheet)) {
                wp_register_style('wp-blog-designer-admin-stylesheets', $adminstylesheetURL);
                wp_enqueue_style('wp-blog-designer-admin-stylesheets');
            }

            $adminstylechosenURL = plugins_url('css/chosen.min.css', __FILE__);
            $adminstylechosen = dirname(__FILE__) . '/css/chosen.min.css';
            if (file_exists($adminstylechosen)) {
                wp_register_style('wp-blog-designer-chosen-stylesheets', $adminstylechosenURL);
                wp_enqueue_style('wp-blog-designer-chosen-stylesheets');
            }
            if (isset($_GET['page']) && $_GET['page'] == 'designer_settings') {
                $adminstylearistoURL = plugins_url('css/aristo.css', __FILE__);
                $adminstylearisto = dirname(__FILE__) . '/css/aristo.css';
                if (file_exists($adminstylearisto)) {
                    wp_register_style('wp-blog-designer-aristo-stylesheets', $adminstylearistoURL);
                    wp_enqueue_style('wp-blog-designer-aristo-stylesheets');
                }
            }
            $fontawesomeiconURL = plugins_url('css/font-awesome.min.css', __FILE__);
            $fontawesomeicon = dirname(__FILE__) . '/css/font-awesome.min.css';
            if (file_exists($fontawesomeicon)) {
                wp_register_style('wp-blog-designer-fontawesome-stylesheets', $fontawesomeiconURL);
                wp_enqueue_style('wp-blog-designer-fontawesome-stylesheets');
            }
        }
    }

}

/**
 *
 * @return Enqueue front side required css
 */
if (!function_exists('wp_blog_designer_front_stylesheet')) {

    function wp_blog_designer_front_stylesheet() {
        $fontawesomeiconURL = plugins_url('css/font-awesome.min.css', __FILE__);
        $fontawesomeicon = dirname(__FILE__) . '/css/font-awesome.min.css';
        if (file_exists($fontawesomeicon)) {
            wp_register_style('wp-blog-designer-fontawesome-stylesheets', $fontawesomeiconURL);
            wp_enqueue_style('wp-blog-designer-fontawesome-stylesheets');
        }
        $designer_cssURL = plugins_url('css/designer_css.css', __FILE__);
        $designer_css = dirname(__FILE__) . '/css/designer_css.css';
        if (file_exists($designer_css)) {
            wp_register_style('wp-blog-designer-css-stylesheets', $designer_cssURL);
            wp_enqueue_style('wp-blog-designer-css-stylesheets');
        }
    }

}

/**
 *
 * @return enqueue admin side plugin js
 */
if (!function_exists('wp_blog_designer_admin_scripts')) {

    function wp_blog_designer_admin_scripts() {
        wp_enqueue_script('jquery');
    }

}

/**
 *
 * @return include plugin dynamic css
 */
if (!function_exists('wp_blog_designer_stylesheet')) {

    function wp_blog_designer_stylesheet() {
        if (!is_admin()) {
            $stylesheet = dirname(__FILE__) . '/designer_css.php';

            if (file_exists($stylesheet)) {
                include('designer_css.php');
            }
        }
    }

}

/**
 *
 *  @param type $length
 *  @return int get content length
 */
if (!function_exists('wp_blog_designer_excerpt_length')) {

    function wp_blog_designer_excerpt_length($length) {
        if (get_option('excerpt_length') != '') {
            return get_option('excerpt_length');
        } else {
            return 50;
        }
    }

}

/**
 * @return type
 */
if (!function_exists('wp_blog_designer_views')) {

    function wp_blog_designer_views() {
        ob_start();
        add_filter('excerpt_more', 'bd_remove_continue_reading', 50);
        $settings = get_option("wp_blog_designer_settings");
        if (!isset($settings['template_name']) || empty($settings['template_name'])) {
            $link_message = '';
            if (is_user_logged_in()) {
                $link_message = __('plz go to ', 'blog-designer') . '<a href="' . admin_url('admin.php?page=designer_settings') . '" target="_blank">' . __('Blog Designer Panel', 'blog-designer') . '</a> , ' . __('select Blog Designs & save settings.', 'blog-designer');
            }
            return __("You haven't created any blog designer shortcode.", 'blog-designer') . ' ' . $link_message;
        }
        $theme = $settings['template_name'];
        $cat = '';
        $category = '';
        if (isset($settings['template_category']))
            $cat = $settings['template_category'];

        if (!empty($cat)) {
            foreach ($cat as $catObj):
                $category .= $catObj . ',';
            endforeach;
            $cat = rtrim($category, ',');
        }else {
            $cat = '';
        }
        $posts_per_page = get_option('posts_per_page');
        $paged = blogdesignerpaged();

        $args = array('cat' => $cat, 'posts_per_page' => $posts_per_page, 'paged' => $paged);

        $display_sticky = get_option('display_sticky');
        if ($display_sticky != '' && $display_sticky == 1) {
            $args['ignore_sticky_posts'] = 1;
        }


        $posts = query_posts($args);

        $alter = 1;
        $class = '';
        $alter_class = '';
        if ($theme == 'timeline') {
            ?>
            <div class="timeline_bg_wrap">
                <div class="timeline_back clearfix"><?php
                }
                while (have_posts()) : the_post();
                    if ($theme == 'classical') {
                        $class = ' classical';
                        wp_classical_template($alter_class);
                    } elseif ($theme == 'lightbreeze') {
                        if (get_option('template_alternativebackground') == 0) {
                            if ($alter % 2 == 0) {
                                $alter_class = ' alternative-back';
                            } else {
                                $alter_class = ' ';
                            }
                        }
                        $class = ' lightbreeze';
                        wp_lightbreeze_template($alter_class);
                        $alter ++;
                    } elseif ($theme == 'spektrum') {
                        $class = ' spektrum';
                        wp_spektrum_template();
                    } elseif ($theme == 'evolution') {
                        if (get_option('template_alternativebackground') == 0) {
                            if ($alter % 2 == 0) {
                                $alter_class = ' alternative-back';
                            } else {
                                $alter_class = ' ';
                            }
                        }
                        $class = ' evolution';
                        wp_evolution_template($alter_class);
                        $alter ++;
                    } elseif ($theme == 'timeline') {
                        if ($alter % 2 == 0) {
                            $alter_class = ' even';
                        } else {
                            $alter_class = ' ';
                        }
                        $class = 'timeline';
                        wp_timeline_template($alter_class);
                        $alter ++;
                    } elseif ($theme == 'news') {
                        if (get_option('template_alternativebackground') == 0) {
                            if ($alter % 2 == 0) {
                                $alter_class = ' alternative-back';
                            } else {
                                $alter_class = ' ';
                            }
                        }
                        $class = ' news';
                        wp_news_template($alter_class);
                        $alter ++;
                    }
                endwhile;
                if ($theme == 'timeline') {
                    ?>
                </div>
            </div><?php
        }
        echo '<div class="wl_pagination_box ' . $class . '">';
        echo designer_pagination();
        echo '</div>';
        wp_reset_query();
        $content = ob_get_clean();
        return $content;
    }

}

/**
 *
 * @global type $post
 * @return html display classical design
 */
if (!function_exists('wp_classical_template')) {

    function wp_classical_template($alterclass) {
        ?>
        <div class="blog_template bdp_blog_template classical">
            <?php
            if (has_post_thumbnail()) {
                ?><div class="bd-post-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a></div><?php
            }
            ?>
            <div class="bd-blog-header">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php
                $display_date = get_option('display_date');
                $display_author = get_option('display_author');
                $display_comment_count = get_option('display_comment_count');
                if ($display_date == 0 || $display_author == 0 || $display_comment_count == 0) {
                    ?>
                    <div class="bd-metadatabox">
                        <?php
                        if ($display_author == 0 && $display_date == 0) {
                            ?>
                            <?php _e('Posted by ', 'blog-designer'); ?>
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <span><?php the_author(); ?></span>
                            </a>
                            <?php _e('on', 'blog-designer'); ?>&nbsp;<?php
                            $date_format = get_option('date_format');
                            echo get_the_time($date_format);
                        } elseif ($display_author == 0) {
                            ?>
                            <?php _e('Posted by ', 'blog-designer'); ?>
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <span><?php the_author(); ?></span>
                            </a><?php
                        } elseif ($display_date == 0) {
                            _e('Posted on ', 'blog-designer');
                            $date_format = get_option('date_format');
                            echo get_the_time($date_format);
                        }
                        if ($display_comment_count == 0) {
                            ?>
                            <div class="bd-metacomments">
                                <i class="fa fa-comment"></i><?php comments_popup_link('0', '1', '%'); ?>
                            </div><?php
                        }
                        ?>
                    </div>
                    <?php
                }

                if (get_option('display_category') == 0) {
                    ?>
                    <span class="bd-category-link">
                        <?php
                        echo '<span class="bd-link-label">';
                        echo '<i class="fa fa-folder-open"></i>';
                        _e('Category', 'blog-designer');
                        echo ':&nbsp';
                        echo '</span>';
                        $categories_list = get_the_category_list(', ');
                        if ($categories_list):
                            print_r($categories_list);
                            $show_sep = true;
                        endif;
                        ?>
                    </span><?php
                }

                if (get_option('display_tag') == 0) {
                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list):
                        ?>
                        <div class="bd-tags">
                            <?php
                            echo '<span class="bd-link-label">';
                            echo '<i class="fa fa-tags"></i>';
                            _e('Tags', 'blog-designer');
                            echo ':&nbsp';
                            echo '</span>';
                            print_r($tags_list);
                            $show_sep = true;
                            ?>
                        </div><?php
                    endif;
                }
                ?>
            </div>
            <div class="bd-post-content">
                <?php echo wp_bd_get_content(get_the_ID()); ?>

                <?php
                if (get_option('read_more_on') == 1) {
                    $read_more_class = (get_option('read_more_on') == 1) ? 'bd-more-tag-inline' : 'bd-more-tag';
                    if (get_option('read_more_text') != '') {
                        echo '<a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                    } else {
                        echo ' <a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . __("Continue Reading...", "blog-designer") . '</a>';
                    }
                }
                ?>
            </div>
            <div class="bd-post-footer">
                <?php if ((get_option('facebook_link') == 0) || (get_option('twitter_link') == 0) || (get_option('google_link') == 0) || (get_option('linkedin_link') == 0) || ( get_option('pinterest_link') == 0 )) { ?>
                    <div class="social-component">
                        <?php if (get_option('facebook_link') == 0): ?>
                            <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>" target= _blank class="bd-facebook-share"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('twitter_link') == 0): ?>
                            <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="bd-twitter-share"><i class="fa fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('google_link') == 0): ?>
                            <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="bd-google-share"><i class="fa fa-google-plus"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('linkedin_link') == 0): ?>
                            <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="bd-linkedin-share"><i class="fa fa-linkedin"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('pinterest_link') == 0): ?>
                            <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="bd-pinterest-share"> <i class="fa fa-pinterest"></i></a>
                        <?php endif; ?>
                    </div>
                <?php } ?>
                <?php
                if (get_option('read_more_on') == 2) {
                    if (get_option('read_more_text') != '') {
                        echo '<a class="bd-more-tag" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                    } else {
                        echo ' <a class="bd-more-tag" href="' . get_the_permalink() . '">' . __("Read More", "blog-designer") . '</a>';
                    }
                }
                ?>
            </div>
        </div><?php
    }

}

/**
 *
 * @global type $post
 * @param type $alterclass
 * @return html display lightbreeze design
 */
if (!function_exists('wp_lightbreeze_template')) {

    function wp_lightbreeze_template($alterclass) {
        ?>
        <div class="blog_template bdp_blog_template box-template active lightbreeze <?php echo $alterclass; ?>">
            <?php
            if (has_post_thumbnail()) {
                ?> <div class="bd-post-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a></div> <?php
            }
            ?>
            <div class="bd-blog-header">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php
                $display_date = get_option('display_date');
                $display_author = get_option('display_author');
                $display_category = get_option('display_category');
                $display_comment_count = get_option('display_comment_count');
                if ($display_date == 0 || $display_author == 0 || $display_category == 0 || $display_comment_count == 0) {
                    ?>
                    <div class="bd-meta-data-box"><?php
                        if ($display_author == 0) {
                            ?>
                            <div class="bd-metadate">
                                <i class="fa fa-user"></i><?php _e('Posted by ', 'blog-designer'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><span><?php the_author(); ?></span></a><br />
                            </div><?php
                        }
                        if ($display_date == 0) {
                            $date_format = get_option('date_format');
                            ?>
                            <div class="bd-metauser">
                                <span class="mdate"><i class="fa fa-calendar"></i> <?php echo get_the_time($date_format); ?></span>
                            </div><?php
                        }
                        if ($display_category == 0) {
                            ?>
                            <div class="bd-metacats">
                                <div class="bd-icon-cats"></div>
                                <?php
                                $categories_list = get_the_category_list(', ');
                                if ($categories_list):
                                    print_r($categories_list);
                                    $show_sep = true;
                                endif;
                                ?>
                            </div><?php
                        }
                        if ($display_comment_count == 0) {
                            ?>
                            <div class="bd-metacomments">
                                <div class="bd-icon-comment"></div>
                                <?php comments_popup_link(__('No Comments', 'blog-designer'), __('1 Comment', 'blog-designer'), '% ' . __('Comments', 'blog-designer')); ?>
                            </div><?php }
                            ?>
                    </div>
                <?php } ?>

            </div>
            <div class="bd-post-content">
                <?php echo wp_bd_get_content(get_the_ID()); ?>
                <?php
                if (get_option('read_more_on') == 1) {
                    if (get_option('read_more_text') != '') {
                        echo '<a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                    } else {
                        echo ' <a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . __("Continue Reading...", "blog-designer") . '</a>';
                    }
                }
                ?>
            </div>

            <?php
            if (get_option('display_tag') == 0) {
                $tags_list = get_the_tag_list('', ', ');
                if ($tags_list):
                    ?>
                    <div class="bd-tags">
                        <div class="bd-icon-tags"></div>
                        <?php
                        print_r($tags_list);
                        $show_sep = true;
                        ?>
                    </div><?php
                endif;
            }
            ?>

            <div class="bd-post-footer">
                <?php if ((get_option('facebook_link') == 0) || (get_option('twitter_link') == 0) || (get_option('google_link') == 0) || (get_option('linkedin_link') == 0) || ( get_option('pinterest_link') == 0 )) { ?>
                    <div class="social-component">
                        <?php if (get_option('facebook_link') == 0): ?>
                            <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>" target= _blank class="bd-facebook-share"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('twitter_link') == 0): ?>
                            <a href="<?php echo 'https://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="bd-twitter-share"><i class="fa fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('google_link') == 0): ?>
                            <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="bd-google-share"><i class="fa fa-google-plus"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('linkedin_link') == 0): ?>
                            <a href="<?php echo 'https://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="bd-linkedin-share"><i class="fa fa-linkedin"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('pinterest_link') == 0): ?>
                            <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="bd-pinterest-share"> <i class="fa fa-pinterest"></i></a>
                        <?php endif; ?>
                    </div>
                <?php } ?>

                <?php
                if (get_option('read_more_on') == 2) {
                    if (get_option('read_more_text') != '') {
                        echo '<a class="bd-more-tag" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                    } else {
                        echo '<a class="bd-more-tag" href="' . get_the_permalink() . '">' . __("Read More", "blog-designer") . '</a>';
                    }
                }
                ?>
            </div>

        </div> <?php
    }

}

/**
 *
 * @global type $post
 * @return html display spektrum design
 */
if (!function_exists('wp_spektrum_template')) {

    function wp_spektrum_template() {
        ?>
        <div class="blog_template bdp_blog_template spektrum">
            <?php if (has_post_thumbnail()) { ?>
                <div class="bd-post-image">
                    <?php the_post_thumbnail('full'); ?>
                    <div class="overlay">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                </div>
            <?php } ?>
            <div class="spektrum_content_div">
                <div class="bd-blog-header<?php
                if (get_option('display_date') != 0) {
                    echo ' disable_date';
                }
                ?>">
                         <?php if (get_option('display_date') == 0) { ?>
                        <span class="date">
                            <span class="number-date"><?php the_time('d'); ?></span>
                            <?php the_time('F'); ?>
                        </span>
                    <?php } ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                <div class="bd-post-content"><?php
                    echo wp_bd_get_content(get_the_ID());

                    if (get_option('excerpt_length') > 0) {
                        if (get_option('read_more_on') == 1) {
                            if (get_option('read_more_text') != '') {
                                echo '<a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                            } else {
                                echo ' <a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . __("Read More", "blog-designer") . '</a>';
                            }
                        }
                    }

                    if (get_option('rss_use_excerpt') == 1 && get_option('read_more_on') != 0):
                        ?>
                        <span class="details">
                            <?php
                            global $post;
                            if (get_option('read_more_on') == 2) {
                                if (get_option('read_more_text') != '') {
                                    echo '<a class="bd-more-tag" href="' . get_permalink($post->ID) . '">' . get_option('read_more_text') . ' </a>';
                                } else {
                                    echo ' <a class="bd-more-tag" href="' . get_permalink($post->ID) . '">' . __('Read More', 'blog-designer') . '</a>';
                                }
                            }
                            ?>
                        </span><?php endif; ?>
                </div>
                <?php
                $display_category = get_option('display_category');
                $display_author = get_option('display_author');
                $display_tag = get_option('display_tag');
                $display_comment_count = get_option('display_comment_count');
                if ($display_category == 0 || $display_author == 0 || $display_tag == 0 || $display_comment_count == 0) {
                    ?>
                    <div class="post-bottom">
                        <?php if ($display_category == 0) { ?>
                            <span class="bd-categories">
                                <div class="bd-icon-cats"></div>
                                <?php
                                $categories_list = get_the_category_list(', ');
                                if ($categories_list):
                                    echo '<span class="bd-link-label">';
                                    _e('Categories', 'blog-designer');
                                    echo '</span>';
                                    echo ' : ';
                                    print_r($categories_list);
                                    $show_sep = true;
                                endif;
                                ?>
                            </span><?php
                        }
                        if ($display_author == 0) {
                            ?>
                            <span class="post-by">
                                <div class="bd-icon-author"></div><?php _e('Posted by ', 'blog-designer'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><span><?php the_author(); ?></span></a>
                            </span><?php
                        }
                        if ($display_tag == 0) {
                            $tags_list = get_the_tag_list('', ', ');
                            if ($tags_list):
                                ?>
                                <span class="bd-tags">
                                    <div class="bd-icon-tags"></div>
                                    <?php
                                    print_r($tags_list);
                                    $show_sep = true;
                                    ?>
                                </span><?php
                            endif;
                        }
                        if ($display_comment_count == 0) {
                            ?>
                            <span class="bd-metacomments">
                                <div class="bd-icon-comment"></div>
                                <?php comments_popup_link(__('No Comments', 'blog-designer'), __('1 Comment', 'blog-designer'), '% ' . __('Comments', 'blog-designer')); ?>
                            </span><?php
                        }
                        ?>
                    </div>
                <?php } ?>

                <?php if ((get_option('facebook_link') == 0) || (get_option('twitter_link') == 0) || (get_option('google_link') == 0) || (get_option('linkedin_link') == 0) || ( get_option('pinterest_link') == 0 )) { ?>
                    <div class="social-component spektrum-social">
                        <?php if (get_option('facebook_link') == 0): ?>
                            <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>" target= _blank class="bd-facebook-share"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('twitter_link') == 0): ?>
                            <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="bd-twitter-share"><i class="fa fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('google_link') == 0): ?>
                            <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="bd-google-share"><i class="fa fa-google-plus"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('linkedin_link') == 0): ?>
                            <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="bd-linkedin-share"><i class="fa fa-linkedin"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('pinterest_link') == 0): ?>
                            <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="bd-pinterest-share"> <i class="fa fa-pinterest"></i></a>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div><?php
    }

}

/**
 *
 * @global type $post
 * @param type $alterclass
 * @return html display evolution design
 */
if (!function_exists('wp_evolution_template')) {

    function wp_evolution_template($alterclass) {
        ?>
        <div class="blog_template bdp_blog_template evolution <?php echo $alterclass; ?>">
            <?php if (get_option('display_category') == 0) { ?>
                <div class="bd-categories">
                    <?php
                    $categories_list = get_the_category_list(', ');
                    if ($categories_list):
                        print_r($categories_list);
                        $show_sep = true;
                    endif;
                    ?>
                </div>
            <?php } ?>

            <div class="bd-blog-header">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>

            <?php
            $display_date = get_option('display_date');
            $display_author = get_option('display_author');
            $display_comment_count = get_option('display_comment_count');
            if ($display_date == 0 || $display_author == 0 || $display_comment_count == 0) {
                ?>
                <div class="post-entry-meta"><?php
                    if ($display_date == 0) {
                        $date_format = get_option('date_format');
                        ?>
                        <span class="date">
                            <div class="icon-date"></div>
                            <?php echo get_the_time($date_format); ?>
                        </span><?php
                    }
                    if ($display_author == 0) {
                        ?>
                        <span class="author">
                            <div class="bd-icon-author"></div>
                            <?php _e('Posted by ', 'blog-designer'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                        </span><?php
                    }
                    if ($display_comment_count == 0) {
                        if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                            ?>
                            <span class="comment">
                                <span class="bd-icon-comment"></span>
                                <?php comments_popup_link('0', '1', '%'); ?>
                            </span>
                            <?php
                        endif;
                    }
                    ?>
                </div>
            <?php } ?>

            <?php if (has_post_thumbnail()) { ?>
                <div class="bd-post-image">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?>
                        <span class="overlay"></span>
                    </a>
                </div>
            <?php } ?>

            <div class="bd-post-content">
                <?php
                echo wp_bd_get_content(get_the_ID());

                if (get_option('read_more_on') == 1) {
                    if (get_option('read_more_text') != '') {
                        echo '<a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                    } else {
                        echo ' <a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . __("Continue Reading...", "blog-designer") . '</a>';
                    }
                }
                ?>

            </div>

            <?php
            $display_tag = get_option('display_tag');
            if ($display_tag == 0) {
                $tags_list = get_the_tag_list('', ', ');
                if ($tags_list):
                    ?>
                    <div class="bd-tags">
                        <?php
                        echo '<span class="bd-link-label">';
                        echo '<i class="fa fa-tags"></i>';
                        _e('Tags', 'blog-designer');
                        echo ':&nbsp';
                        echo '</span>';
                        print_r($tags_list);
                        $show_sep = true;
                        ?>
                    </div><?php
                endif;
            }
            ?>

            <div class="bd-post-footer">
                <?php if ((get_option('facebook_link') == 0) || (get_option('twitter_link') == 0) || (get_option('google_link') == 0) || (get_option('linkedin_link') == 0) || ( get_option('pinterest_link') == 0 )) { ?>
                    <div class="social-component">
                        <?php if (get_option('facebook_link') == 0): ?>
                            <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>" target= _blank class="bd-facebook-share"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('twitter_link') == 0): ?>
                            <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="bd-twitter-share"><i class="fa fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('google_link') == 0): ?>
                            <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="bd-google-share"><i class="fa fa-google-plus"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('linkedin_link') == 0): ?>
                            <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="bd-linkedin-share"><i class="fa fa-linkedin"></i></a>
                        <?php endif; ?>
                        <?php if (get_option('pinterest_link') == 0): ?>
                            <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="bd-pinterest-share"> <i class="fa fa-pinterest"></i></a>
                        <?php endif; ?>
                    </div>
                <?php } ?>
                <?php
                if (get_option('read_more_on') == 2) {
                    if (get_option('read_more_text') != '') {
                        echo '<a class="bd-more-tag" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                    } else {
                        echo ' <a class="bd-more-tag" href="' . get_the_permalink() . '">' . __("Read More", "blog-designer") . '</a>';
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }

}

/**
 *
 * @global type $post
 * @return html display timeline design
 */
if (!function_exists('wp_timeline_template')) {

    function wp_timeline_template($alterclass) {
        ?>
        <div class="blog_template bdp_blog_template timeline blog-wrap <?php echo $alterclass; ?>">
            <div class="post_hentry ">
                <div class="post_content_wrap">
                    <div class="post_wrapper box-blog">
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="bd-post-image photo">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?>
                                    <span class="overlay"></span>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="desc">
                            <a href="<?php the_permalink(); ?>">
                                <h3 class="entry-title text-center text-capitalize"><?php the_title(); ?></h3>
                            </a>
                            <?php
                            $display_author = get_option('display_author');
                            $display_comment_count = get_option('display_comment_count');
                            $display_date = get_option('display_date');
                            if ($display_date == 0 || $display_comment_count == 0 || $display_date == 0) {
                                ?>
                                <div class="date_wrap">
                                    <?php if ($display_author == 0) { ?>
                                        <span title="Posted By <?php the_author(); ?>">
                                            <i class="fa fa-user"></i>
                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><span><?php the_author(); ?></span></a>
                                        </span>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php if ($display_comment_count == 0) { ?>
                                        <span class="bd-metacomments">
                                            <div class="bd-icon-comment"></div>
                                            <?php comments_popup_link(__('No Comments', 'blog-designer'), __('1 Comment', 'blog-designer'), '% ' . __('Comments', 'blog-designer')); ?>
                                        </span>
                                    <?php } ?>
                                    <?php if ($display_date == 0) { ?>
                                        <div class="bd-datetime">
                                            <span class="month"><?php the_time('M'); ?></span>
                                            <span class="date"><?php the_time('d'); ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="bd-post-content">
                                <?php
                                echo wp_bd_get_content(get_the_ID());

                                if (get_option('excerpt_length') > 0) {
                                    if (get_option('read_more_on') == 1) {
                                        if (get_option('read_more_text') != '') {
                                            echo '<a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                                        } else {
                                            echo ' <a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . __("Read More", "blog-designer") . '</a>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <?php if (get_option('rss_use_excerpt') == 1 && get_option('read_more_on') != 0): ?>
                                <div class="read_more">
                                    <?php
                                    global $post;
                                    if (get_option('read_more_on') == 2) {
                                        if (get_option('read_more_text') != '') {
                                            echo '<a class="bd-more-tag" href="' . get_permalink($post->ID) . '"><i class="fa fa-plus"></i> ' . get_option('read_more_text') . ' </a>';
                                        } else {
                                            echo ' <a class="bd-more-tag" href="' . get_permalink($post->ID) . '"><i class="fa fa-plus"></i> ' . __('Read more', 'blog-designer') . ' &raquo;</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (get_option('display_category') == 0 || get_option('display_tag') == 0 || (get_option('facebook_link') == 0) || (get_option('twitter_link') == 0) || (get_option('google_link') == 0) || (get_option('linkedin_link') == 0) || ( get_option('pinterest_link') == 0 )) { ?>
                        <footer class="blog_footer text-capitalize">
                            <?php if (get_option('display_category') == 0) { ?>
                                <span class="bd-categories">
                                    <i class="fa fa-folder"></i>
                                    <?php
                                    $categories_list = get_the_category_list(', ');
                                    if ($categories_list):
                                        echo '<span class="bd-link-label">';
                                        _e('Categories', 'blog-designer');
                                        echo '</span>';
                                        echo ' : ';
                                        print_r($categories_list);
                                        $show_sep = true;
                                    endif;
                                    ?>
                                </span>
                                <?php
                            }
                            if (get_option('display_tag') == 0) {
                                $tags_list = get_the_tag_list('', ', ');
                                if ($tags_list):
                                    ?>
                                    <span class="bd-tags">
                                        <i class="fa fa-bookmark"></i>
                                        <?php
                                        echo '<span class="bd-link-label">';
                                        _e('Tags', 'blog-designer');
                                        echo ' : ';
                                        echo '</span>';
                                        print_r($tags_list);
                                        $show_sep = true;
                                        ?>
                                    </span>
                                    <?php
                                endif;
                            }

                            if ((get_option('facebook_link') == 0) || (get_option('twitter_link') == 0) || (get_option('google_link') == 0) || (get_option('linkedin_link') == 0) || ( get_option('pinterest_link') == 0 )) {
                                ?>
                                <div class="social-component">
                                    <?php if (get_option('facebook_link') == 0): ?>
                                        <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>" target= _blank class="bd-facebook-share"><i class="fa fa-facebook"></i></a>
                                    <?php endif; ?>
                                    <?php if (get_option('twitter_link') == 0): ?>
                                        <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="bd-twitter-share"><i class="fa fa-twitter"></i></a>
                                    <?php endif; ?>
                                    <?php if (get_option('google_link') == 0): ?>
                                        <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="bd-google-share"><i class="fa fa-google-plus"></i></a>
                                    <?php endif; ?>
                                    <?php if (get_option('linkedin_link') == 0): ?>
                                        <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="-bd-linkedin-share"><i class="fa fa-linkedin"></i></a>
                                    <?php endif; ?>
                                    <?php if (get_option('pinterest_link') == 0): ?>
                                        <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="bd-pinterest-share"> <i class="fa fa-pinterest"></i></a>
                                    <?php endif; ?>
                                </div><?php }
                                ?>
                        </footer>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }

}

/**
 *
 * @global type $post
 * @return html display news design
 */
if (!function_exists('wp_news_template')) {

    function wp_news_template($alter) {
        ?>
        <div class="blog_template bdp_blog_template news <?php echo $alter; ?>">
            <?php
            $full_width_class = ' full_with_class';
            if (has_post_thumbnail()) {
                $full_width_class = '';
                ?>
                <div class="bd-post-image">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                </div>
                <?php
            }
            ?>
            <div class="post-content-div<?php echo $full_width_class; ?>">
                <div class="bd-blog-header">
                    <?php
                    $display_date = get_option('display_date');
                    if ($display_date == 0) {
                        $date_format = get_option('date_format');
                        ?> <span class="date"><?php echo get_the_time($date_format); ?></span> <?php
                    }
                    ?>

                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php
                    $display_author = get_option('display_author');
                    $display_comment_count = get_option('display_comment_count');
                    if ($display_author == 0 || $display_comment_count == 0) {
                        ?>
                        <div class="bd-metadatabox">
                            <?php
                            if ($display_author == 0) {
                                ?>
                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                    <?php the_author(); ?>
                                </a>
                                <?php
                            }
                            if ($display_comment_count == 0) {
                                comments_popup_link(__('Leave a Comment', 'blog-designer'), __('1 Comment', 'blog-designer'), '% ' . __('Comments', 'blog-designer'), 'comments-link', __('Comments are off', 'blog-designer'));
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="bd-post-content">
                    <?php
                    echo wp_bd_get_content(get_the_ID());
                    ?>

                    <?php
                    if (get_option('read_more_on') == 1) {
                        if (get_option('read_more_text') != '') {
                            echo '<a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                        } else {
                            echo '<a class="bd-more-tag-inline" href="' . get_the_permalink() . '">' . __("Read More", "blog-designer") . '</a>';
                        }
                    }
                    ?>
                </div>

                <?php
                $display_category = get_option('display_category');
                $display_tag = get_option('display_tag');
                if ($display_category == 0 || $display_tag == 0) {
                    ?>
                    <div class="post_cat_tag">
                        <?php if ($display_category == 0) { ?>
                            <span class="bd-category-link"><?php
                                $categories_list = get_the_category_list(', ');
                                if ($categories_list):
                                    echo '<i class="fa fa-bookmark"></i>';
                                    print_r($categories_list);
                                    $show_sep = true;
                                endif;
                                ?>
                            </span><?php
                        }
                        if ($display_tag == 0) {
                            $tags_list = get_the_tag_list('', ', ');
                            if ($tags_list):
                                ?>
                                <span class="bd-tags">
                                    <div class="bd-icon-tags"></div>
                                    <?php
                                    print_r($tags_list);
                                    $show_sep = true;
                                    ?>
                                </span><?php
                            endif;
                        }
                        ?>
                    </div>
                <?php } ?>

                <div class="bd-post-footer">
                    <?php if ((get_option('facebook_link') == 0) || (get_option('twitter_link') == 0) || (get_option('google_link') == 0) || (get_option('linkedin_link') == 0) || ( get_option('pinterest_link') == 0 )) { ?>
                        <div class="social-component">
                            <?php if (get_option('facebook_link') == 0): ?>
                                <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>" target= _blank class="bd-facebook-share"><i class="fa fa-facebook"></i></a>
                            <?php endif; ?>
                            <?php if (get_option('twitter_link') == 0): ?>
                                <a href="<?php echo 'http://twitter.com/share?&url=' . get_the_permalink(); ?>" target= _blank class="bd-twitter-share"><i class="fa fa-twitter"></i></a>
                            <?php endif; ?>
                            <?php if (get_option('google_link') == 0): ?>
                                <a href="<?php echo 'https://plus.google.com/share?url=' . get_the_permalink(); ?>" target= _blank class="bd-google-share"><i class="fa fa-google-plus"></i></a>
                            <?php endif; ?>
                            <?php if (get_option('linkedin_link') == 0): ?>
                                <a href="<?php echo 'http://www.linkedin.com/shareArticle?url=' . get_the_permalink(); ?>" target= _blank class="-bd-linkedin-share"><i class="fa fa-linkedin"></i></a>
                            <?php endif; ?>
                            <?php if (get_option('pinterest_link') == 0): ?>
                                <a href="<?php echo '//pinterest.com/pin/create/button/?url=' . get_the_permalink(); ?>" target= _blank class="bd-pinterest-share"> <i class="fa fa-pinterest"></i></a>
                            <?php endif; ?>
                        </div>
                    <?php } ?>

                    <?php
                    if (get_option('read_more_on') == 2) {
                        if (get_option('read_more_text') != '') {
                            echo '<a class="bd-more-tag" href="' . get_the_permalink() . '">' . get_option('read_more_text') . ' </a>';
                        } else {
                            echo ' <a class="bd-more-tag" href="' . get_the_permalink() . '">' . __("Read More", "blog-designer") . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div><?php
    }

}

/**
 *
 * @global type $wp_version
 * @return html Display setting options
 */
if (!function_exists('wp_blog_designer_menu_function')) {

    function wp_blog_designer_menu_function() {
        global $wp_version;
        ?>
        <div class="wrap">
            <h2><?php _e('Blog Designer Settings', 'blog-designer') ?></h2>
            <div class="updated notice notice-success" id="message">
                <p><?php _e('Blog Designer', 'blog-designer'); ?> : <a href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blogdesigner-lite'); ?>" target="_blank"><?php _e('Live Documentation', 'blog-designer'); ?></a> <?php _e('and', 'blog-designer'); ?> <a href="<?php echo esc_url('http://blogdesigner.solwininfotech.com'); ?>" target="blank"><?php _e('Live Demo', 'blog-designer'); ?></a></p>
                <p><?php _e('Want more blog designer support for all type of archive pages, single post page and much more?', 'blog-designer'); ?> <b><a href="<?php echo esc_url('https://codecanyon.net/item/blog-designer-pro-for-wordpress/17069678?ref=solwin'); ?>" target="blank"><?php _e('Upgrade to PRO', 'blog-designer'); ?></a></b></p>
            </div>
            <?php
            $view_post_link = (get_option('blog_page_display') != 0) ? '<span class="page_link"> <a target="_blank" href="' . get_permalink(get_option('blog_page_display')) . '"> ' . __('View Blog', 'blog-designer') . ' </a></span>' : '';
            if (isset($_REQUEST['bdRestoreDefault']) && isset($_GET['updated']) && 'true' == esc_attr($_GET['updated'])) {
                echo '<div class="updated" ><p>' . __('Blog Designer setting restored successfully.', 'blog-designer') . ' ' . $view_post_link . '</p></div>';
            } else if (isset($_GET['updated']) && 'true' == esc_attr($_GET['updated'])) {
                echo '<div class="updated" ><p>' . __('Blog Designer settings updated.', 'blog-designer') . ' ' . $view_post_link . '</p></div>';
            }
            $settings = get_option("wp_blog_designer_settings");
            if (isset($_SESSION['success_msg'])) {
                ?>
                <div class="updated is-dismissible notice settings-error"><?php
                    echo '<p>' . $_SESSION['success_msg'] . '</p>';
                    unset($_SESSION['success_msg']);
                    ?>
                </div><?php }
                ?>
            <form method="post" action="?page=designer_settings&action=save&updated=true" class="bd-form-class"><?php
                $page = '';
                if (isset($_GET['page']) && $_GET['page'] != '') {
                    $page = $_GET['page'];
                    ?>
                    <input type="hidden" name="originalpage" class="bdporiginalpage" value="<?php echo $page; ?>"><?php }
                ?>
                <div class="wl-pages" >
                    <div class="bd-settings-wrappers bd_poststuff">
                        <div class="bd-header-wrapper">
                            <div class="bd-logo-wrapper pull-left">
                                <h3><?php _e('Blog designer settings', 'blog-designer'); ?></h3>
                            </div>
                            <div class="pull-right">
                                <a id="bd-submit-button" title="<?php _e('Save Changes', 'blog-designer'); ?>" class="button button-primary">
                                    <span><?php _e('Save Changes', 'blog-designer'); ?></span>
                                </a>
                                <a id="bd-show-preview" title="<?php _e('Show Preview', 'blog-designer'); ?>" class="button show_preview button-hero pro-feature" href="#">
                                    <span><?php _e('Preview', 'blog-designer'); ?></span>
                                </a>
                                <a id="bd-reset-button" title="<?php _e('Restore Default', 'blog-designer'); ?>" class="bdp-restore-default button change-theme">
                                    <span><?php _e('Restore Default', 'blog-designer'); ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="bd-menu-setting">
                            <?php
                            $bdpgeneral_class = $dbptimeline_class = $bdpstandard_class = $bdptitle_class = $bdpcontent_class = $bdpmedia_class = $bdpslider_class = $bdpcustomreadmore_class = $bdpsocial_class = '';
                            $bdpgeneral_class_show = $dbptimeline_class_show = $bdpstandard_class_show = $bdptitle_class_show = $bdpcontent_class_show = $bdpmedia_class_show = $bdpslider_class_show = $bdpcustomreadmore_class_show = $bdpsocial_class_show = '';

                            if (bdp_postbox_classes('bdpgeneral', $page)) {
                                $bdpgeneral_class = 'class="bd-active-tab"';
                                $bdpgeneral_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('dbptimeline', $page)) {
                                $dbptimeline_class = 'class="bd-active-tab"';
                                $dbptimeline_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('bdpstandard', $page)) {
                                $bdpstandard_class = 'class="bd-active-tab"';
                                $bdpstandard_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('bdptitle', $page)) {
                                $bdptitle_class = 'class="bd-active-tab"';
                                $bdptitle_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('bdpcontent', $page)) {
                                $bdpcontent_class = 'class="bd-active-tab"';
                                $bdpcontent_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('bdpmedia', $page)) {
                                $bdpmedia_class = 'class="bd-active-tab"';
                                $bdpmedia_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('bdpslider', $page)) {
                                $bdpslider_class = 'class="bd-active-tab"';
                                $bdpslider_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('bdpcustomreadmore', $page)) {
                                $bdpcustomreadmore_class = 'class="bd-active-tab"';
                                $bdpcustomreadmore_class_show = 'style="display: block;"';
                            } elseif (bdp_postbox_classes('bdpsocial', $page)) {
                                $bdpsocial_class = 'class="bd-active-tab"';
                                $bdpsocial_class_show = 'style="display: block;"';
                            } else {
                                $bdpgeneral_class = 'class="bd-active-tab"';
                                $bdpgeneral_class_show = 'style="display: block;"';
                            }
                            ?>
                            <ul class="bd-setting-handle">
                                <li data-show="bdpgeneral" <?php echo $bdpgeneral_class; ?>>
                                    <i class="fa fa-gear"></i>
                                    <span><?php _e('General Settings', 'blog-designer') ?></span>
                                </li>
                                <li data-show="bdpstandard" <?php echo $bdpstandard_class; ?>>
                                    <i class="fa fa-legal"></i>
                                    <span><?php _e('Standard Settings', 'blog-designer') ?></span>
                                </li>
                                <li data-show="bdptitle" <?php echo $bdptitle_class; ?>>
                                    <i class="fa fa-chain"></i>
                                    <span><?php _e('Post Title Settings', 'blog-designer') ?></span>
                                </li>
                                <li data-show="bdpcontent" <?php echo $bdpcontent_class; ?>>
                                    <i class="fa fa-gears"></i>
                                    <span><?php _e('Post Content Settings', 'blog-designer') ?></span>
                                </li>
                                <li data-show="bdpmedia" <?php echo $bdpmedia_class; ?>>
                                    <i class="fa fa-picture-o"></i>
                                    <span><?php _e('Media Settings', 'blog-designer'); ?></span>
                                </li>
                                <li data-show="bdpsocial" <?php echo $bdpsocial_class; ?>>
                                    <i class="fa fa-share-alt"></i>
                                    <span><?php _e('Social Share Settings', 'blog-designer') ?></span>
                                </li>
                            </ul>
                        </div>
                        <div id="bdpgeneral" class="postbox postbox-with-fw-options" <?php echo $bdpgeneral_class_show; ?>>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select blog layout template', 'blog-designer'); ?></div>
                                            <?php _e('Blog Layout', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <div class="select-cover select-cover-template">
                                                <div class="bd_select_template_button_div">
                                                    <input type="button" class="bd_select_template" value="<?php esc_attr_e('Select Template', 'blog-designer'); ?>">
                                                </div>
                                                <input type="hidden" name="template_name" id="template_name" value="<?php
                                                if (isset($settings["template_name"]) && $settings["template_name"] != '') {
                                                    echo $settings["template_name"];
                                                }
                                                ?>" />
                                                <div class="bd_selected_template_image">
                                                    <div <?php
                                                    if (isset($settings['template_name']) && empty($settings['template_name'])) {
                                                        echo ' class="bd_no_template_found"';
                                                    }
                                                    ?>>
                                                            <?php
                                                            if (isset($settings['template_name']) && !empty($settings['template_name'])) {
                                                                $image_name = $settings['template_name'] . '.jpg';
                                                                ?>
                                                            <img src="<?php echo BLOGDESIGNER_URL . '/images/layouts/' . $image_name; ?>" alt="<?php
                                                            if (isset($settings['template_name'])) {
                                                                echo str_replace('_', '-', $settings['template_name']) . ' ';
                                                                esc_attr_e('Template', 'blog-designer');
                                                            }
                                                            ?>" title="<?php
                                                                 if (isset($settings['template_name'])) {
                                                                     echo str_replace('_', '-', $settings['template_name']) . ' ';
                                                                     esc_attr_e('Template', 'blog-designer');
                                                                 }
                                                                 ?>" />
                                                            <label id="bd_template_select_name"><?php
                                                                if (isset($settings['template_name'])) {
                                                                    echo str_replace('_', '-', $settings['template_name']) . ' ';
                                                                    _e('Template', 'blog-designer');
                                                                }
                                                                ?>
                                                            </label>
                                                            <?php
                                                        } else {
                                                            _e('No template exist for selection', 'blog-designer');
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="template_info">
                                                <b><?php _e('Note: ', 'blog-designer'); ?></b>
                                                <?php _e('You can get more template selections with the PRO version.', 'blog-designer'); ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bd-have-caution">
                                            <div class="bd-title-tooltip"><?php _e('Select page for display blog layout', 'blog-designer'); ?></div>
                                            <?php _e(' Select Page for Blog ', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <div class="select-cover">
                                                <?php
                                                echo wp_dropdown_pages(array(
                                                    'name' => 'blog_page_display',
                                                    'echo' => 0,
                                                    'depth' => -1,
                                                    'show_option_none' => '-- ' . __('Select Page', 'blog-designer') . ' --',
                                                    'option_none_value' => '0',
                                                    'selected' => get_option('blog_page_display')));
                                                ?>
                                            </div>
                                            <div class="bdp-setting-description">
                                                <b><?php _e('Caution:', 'blog-designer'); ?></b>
                                                <?php
                                                _e('You are about to select the page for your blog layout, you will lose your page content. There is no undo. Think about it!', 'blog-designer');
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select number of posts to display on page', 'blog-designer'); ?></div>
                                            <?php _e('Blog Pages Show at Most', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <div class="quantity">
                                                <input name="posts_per_page" type="number" step="1" min="1" id="posts_per_page" value="<?php echo get_option('posts_per_page'); ?>" class="small-text" onkeypress="return isNumberKey(event)" />
                                                <div class="quantity-nav">
                                                    <div class="quantity-button quantity-up">+</div>
                                                    <div class="quantity-button quantity-down">-</div>
                                                </div>
                                            </div>
                                            <?php _e('Posts', 'blog-designer'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Filter post via category', 'blog-designer'); ?></div>
                                            <?php _e('Select Post Categories', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <?php $categories = get_categories(array('child_of' => '', 'hide_empty' => 1)); ?>
                                            <select data-placeholder="<?php esc_attr_e('Choose Post Categories', 'blog-designer'); ?>" class="chosen-select" multiple style="width:220px;" name="template_category[]" id="template_category">
                                                <?php foreach ($categories as $categoryObj): ?>
                                                    <option value="<?php echo $categoryObj->term_id; ?>" <?php
                                                    if (@in_array($categoryObj->term_id, $settings['template_category'])) {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>><?php echo $categoryObj->name; ?>
                                                    </option><?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Filter post via tags', 'blog-designer'); ?></div>
                                            <?php _e('Select Post Tags', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <select data-placeholder="<?php esc_attr_e('Choose Post Tags', 'blog-designer'); ?>" class="chosen-select" multiple style="width:220px;" name="" id="">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Filter post via authors', 'blog-designer'); ?></div>
                                            <?php _e('Select Post Authors', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <select data-placeholder="<?php esc_attr_e('Choose Post Authors', 'blog-designer'); ?>" class="chosen-select" multiple style="width:220px;" name="" id=""></select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bd-have-caution">
                                            <div class="bd-title-tooltip"><?php _e('Show Sticky Post', 'blog-designer'); ?></div>
                                            <?php _e('Display Sticky Post', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <?php
                                            $display_sticky = get_option('display_sticky');
                                            $display_sticky = ($display_sticky != '') ? $display_sticky : 1;
                                            ?>
                                            <fieldset class="buttonset">
                                                <input id="display_sticky_1" name="display_sticky" type="radio" value="1" <?php echo checked(1, $display_sticky); ?> />
                                                <label for="display_sticky_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_sticky_0" name="display_sticky" type="radio" value="0" <?php echo checked(0, $display_sticky); ?>/>
                                                <label for="display_sticky_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                            <div class="bdp-setting-description">
                                                <b><?php _e('Caution:', 'blog-designer'); ?></b>
                                                <?php _e('Sticky Post not count in the number of post to be displayed in blog layout page.', 'blog-designer'); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Show post category on blog layout', 'blog-designer'); ?></div>
                                            <?php _e('Display Post Category', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="display_category_1" name="display_category" type="radio" value="1" <?php echo checked(1, get_option('display_category')); ?> />
                                                <label for="display_category_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_category_0" name="display_category" type="radio" value="0" <?php echo checked(0, get_option('display_category')); ?>/>
                                                <label for="display_category_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Show post tag on blog layout', 'blog-designer'); ?></div>
                                            <?php _e('Display Post Tag', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="display_tag_1" name="display_tag" type="radio" value="1" <?php echo checked(1, get_option('display_tag')); ?> />
                                                <label for="display_tag_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_tag_0" name="display_tag" type="radio" value="0" <?php echo checked(0, get_option('display_tag')); ?>/>
                                                <label for="display_tag_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Show post author on blog layout', 'blog-designer'); ?></div>
                                            <?php _e('Display Post Author ', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="display_author_1" name="display_author" type="radio" value="1" <?php echo checked(1, get_option('display_author')); ?> />
                                                <label for="display_author_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_author_0" name="display_author" type="radio" value="0" <?php echo checked(0, get_option('display_author')); ?>/>
                                                <label for="display_author_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Show post published date on blog layout', 'blog-designer'); ?></div>
                                            <?php _e('Display Post Published Date', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="display_date_1" name="display_date" type="radio" value="1" <?php echo checked(1, get_option('display_date')); ?> />
                                                <label for="display_date_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_date_0" name="display_date" type="radio" value="0" <?php echo checked(0, get_option('display_date')); ?>/>
                                                <label for="display_date_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Show post comment on blog layout', 'blog-designer'); ?></div>
                                            <?php _e('Display Comment Count', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="display_comment_count_1" name="display_comment_count" type="radio" value="1" <?php echo checked(1, get_option('display_comment_count')); ?> />
                                                <label for="display_comment_count_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_comment_count_0" name="display_comment_count" type="radio" value="0" <?php echo checked(0, get_option('display_comment_count')); ?>/>
                                                <label for="display_comment_count_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Show post like on blog layout', 'blog-designer'); ?></div>
                                            <?php _e('Display Post Like', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <fieldset class="buttonset">
                                                <input id="display_postlike_1" name="display_postlike" type="radio" value="1" checked="checked"/>
                                                <label for="display_postlike_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_postlike_0" name="display_postlike" type="radio" value="0" />
                                                <label for="display_postlike_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr class="last-tr">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Add custom css for blog layout', 'blog-designer'); ?></div>
                                            <?php _e('Custom CSS', 'blog-designer'); ?>
                                        </td>
                                        <td>
                                            <textarea name="custom_css" id="custom_css"><?php echo stripslashes(get_option('custom_css')); ?></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="bdpstandard" class="postbox postbox-with-fw-options" <?php echo $bdpstandard_class_show; ?>>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Enter main container class name', 'blog-designer'); ?></div>
                                            <?php _e('Main Container Class Name', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <input type="text" placeholder="<?php esc_attr_e('Enter main container class name', 'blog-designer'); ?>"/>
                                        </td>
                                    </tr>

                                    <tr class="blog-templatecolor-tr">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select post template color', 'blog-designer'); ?></div>
                                            <?php _e('Blog Posts Template Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_color" id="template_color" value="<?php echo isset($settings["template_color"]) ? $settings["template_color"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr class="blog-template-tr">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select post background color', 'blog-designer'); ?></div>
                                            <?php _e('Background Color for Blog Posts', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_bgcolor" id="template_bgcolor" value="<?php echo (isset($settings["template_bgcolor"])) ? $settings["template_bgcolor"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr class="blog-template-tr">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enable/Disable alternative background color', 'blog-designer'); ?></div>
                                            <?php _e('Alternative Background Color', 'blog-designer'); ?>
                                        </td>
                                        <td>
                                            <?php $bd_alter = get_option('template_alternativebackground'); ?>
                                            <fieldset class="buttonset">
                                                <input id="template_alternativebackground_1" name="template_alternativebackground" type="radio" value="1" <?php echo checked(1, $bd_alter); ?> />
                                                <label for="template_alternativebackground_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="template_alternativebackground_0" name="template_alternativebackground" type="radio" value="0" <?php echo checked(0, $bd_alter); ?>/>
                                                <label for="template_alternativebackground_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr class="alternative-color-tr">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select alternative background color', 'blog-designer'); ?></div>
                                            <?php _e('Choose Alternative Background Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_alterbgcolor" id="template_alterbgcolor" value="<?php echo (isset($settings["template_alterbgcolor"])) ? $settings["template_alterbgcolor"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select link color', 'blog-designer'); ?></div>
                                            <?php _e('Choose Link Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_ftcolor" id="template_ftcolor" value="<?php echo (isset($settings["template_ftcolor"])) ? $settings["template_ftcolor"] : ''; ?>" data-default-color="<?php echo (isset($settings["template_ftcolor"])) ? $settings["template_ftcolor"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr class="last-tr">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select link hover color', 'blog-designer'); ?></div>
                                            <?php _e('Choose Link Hover Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_fthovercolor" id="template_fthovercolor" value="<?php echo (isset($settings["template_fthovercolor"])) ? $settings["template_fthovercolor"] : ''; ?>" data-default-color="<?php echo (isset($settings["template_fthovercolor"])) ? $settings["template_fthovercolor"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="bdptitle" class="postbox postbox-with-fw-options" <?php echo $bdptitle_class_show; ?>>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Select post title link', 'blog-designer'); ?></div>
                                            <?php _e('Post Title Link', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <fieldset class="buttonset">
                                                <input id="bdp_post_title_link_0" name="bdp_post_title_link" type="radio" value="0"/>
                                                <label for="bdp_post_title_link_0"><?php _e('Disable', 'blog-designer'); ?></label>
                                                <input id="bdp_post_title_link_1" name="bdp_post_title_link" type="radio" value="1" checked="checked"/>
                                                <label for="bdp_post_title_link_1"><?php _e('Enable', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select post title color', 'blog-designer'); ?></div>
                                            <?php _e('Post Title Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_titlecolor" id="template_titlecolor" value="<?php echo (isset($settings["template_titlecolor"])) ? $settings["template_titlecolor"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Select post title link hover color', 'blog-designer'); ?></div>
                                            <?php _e('Post Title Link Hover Color', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <input type="text" name="template_titlehovercolor" id="template_titlehovercolor" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select post title background color', 'blog-designer'); ?></div>
                                            <?php _e('Post Title Background Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_titlebackcolor" id="template_titlebackcolor" value="<?php echo (isset($settings["template_titlebackcolor"])) ? $settings["template_titlebackcolor"] : ''; ?>"/>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <h3 class="bd-table-title"><?php _e('Typography Settings', 'blog-designer'); ?></h3>

                            <div class="bd-typography-wrapper">

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select post title font family', 'blog-designer'); ?></div>
                                        <?php _e('Font Family', 'blog-designer') ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id=""></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select post title font size', 'blog-designer'); ?></div>
                                        <?php _e('Font Size', 'blog-designer') ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="grid_col_space range_slider_fontsize" id="template_postTitlefontsizeInput" data-value="<?php echo get_option('template_titlefontsize'); ?>"></div>
                                        <div class="slide_val">
                                            <span></span>
                                            <input class="grid_col_space_val range-slider__value" name="template_titlefontsize" id="template_titlefontsize" value="<?php echo get_option('template_titlefontsize'); ?>" onkeypress="return isNumberKey(event)" />
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select font weight', 'blog-designer'); ?></div>
                                        <?php _e('Font Weight', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id="">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Enter line height', 'blog-designer'); ?></div>
                                        <?php _e('Line Height', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="quantity">
                                            <input type="number" name="" id="" step="0.1" min="0" value="1.5" onkeypress="return isNumberKey(event)">
                                            <div class="quantity-nav">
                                                <div class="quantity-button quantity-up">+</div>
                                                <div class="quantity-button quantity-down">-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Enable/Disable italic font style', 'blog-designer'); ?></div>
                                        <?php _e('Italic Font Style', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content ">
                                        <input type="checkbox" name="" id="" value="1">
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select text transform style', 'blog-designer'); ?></div>
                                        <?php _e('Text Transform', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id=""></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select text decoration style', 'blog-designer'); ?></div>
                                        <?php _e('Text Decoration', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id=""></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Enter letter spacing', 'blog-designer'); ?></div>
                                        <?php _e('Letter Spacing', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="quantity">
                                            <input type="number" name="" id="" step="1" min="0" value="0" onkeypress="return isNumberKey(event)">
                                            <div class="quantity-nav">
                                                <div class="quantity-button quantity-up">+</div>
                                                <div class="quantity-button quantity-down">-</div>
                                            </div>
                                        </div>
                                        <?php _e('px', 'blog-designer'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="bdpcontent" class="postbox postbox-with-fw-options" <?php echo $bdpcontent_class_show; ?>>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('To display full text for each post, select full text option, otherwise select the summary option.', 'blog-designer'); ?></div>
                                            <?php _e('For each Article in a Feed, Show ', 'blog-designer') ?>
                                        </td>
                                        <td class="rss_use_excerpt">
                                            <?php
                                            $rss_use_excerpt = get_option('rss_use_excerpt');
                                            ?>
                                            <fieldset class="buttonset green">
                                                <input id="rss_use_excerpt_0" name="rss_use_excerpt" type="radio" value="0" <?php echo checked(0, $rss_use_excerpt); ?>/>
                                                <label for="rss_use_excerpt_0"><?php _e('Full Text', 'blog-designer'); ?></label>
                                                <input id="rss_use_excerpt_1" name="rss_use_excerpt" type="radio" value="1" <?php echo checked(1, $rss_use_excerpt); ?> />
                                                <label for="rss_use_excerpt_1"><?php _e('Summary', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr class="excerpt_length">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enter number of words for post content length', 'blog-designer'); ?></div>
                                            <?php _e('Post Content Length', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <div class="quantity">
                                                <input type="number" id="txtExcerptlength" name="txtExcerptlength" value="<?php echo get_option('excerpt_length'); ?>" min="0" step="1" class="small-text" onkeypress="return isNumberKey(event)">
                                                <div class="quantity-nav">
                                                    <div class="quantity-button quantity-up">+</div>
                                                    <div class="quantity-button quantity-down">-</div>
                                                </div>
                                            </div>&nbsp;
                                            <?php _e('Words', 'blog-designer'); ?>
                                        </td>
                                    </tr>
                                    <tr class="excerpt_length">
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('To display text from post content or from post excerpt', 'blog-designer'); ?></div>
                                            <?php _e('Show Content From', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <div class="select-cover">
                                                <select name="" id=""></select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="excerpt_length">
                                        <?php $display_html_tags = get_option('display_html_tags', 0); ?>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Show HTML tags with summary', 'blog-designer'); ?></div>
                                            <?php _e('Display HTML tags with Summary', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="display_html_tags_0" name="display_html_tags" type="radio" value="0" <?php echo checked(0, $display_html_tags); ?> />
                                                <label for="display_html_tags_0"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="display_html_tags_1" name="display_html_tags" type="radio" value="1" <?php echo checked(1, $display_html_tags); ?>/>
                                                <label for="display_html_tags_1"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php $firstletter_big = 0; ?>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Enable first letter as Dropcap', 'blog-designer'); ?></div>
                                            <?php _e('First letter as Dropcap', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">                                            
                                            <fieldset class="buttonset">
                                                <input id="firstletter_big_0" name="firstletter_big" type="radio" value="0" <?php echo checked(0, $firstletter_big); ?> />
                                                <label for="firstletter_big_0"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="firstletter_big_1" name="firstletter_big" type="radio" value="1" <?php echo checked(1, $firstletter_big); ?>/>
                                                <label for="firstletter_big_1"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select post content color', 'blog-designer'); ?></div>
                                            <?php _e('Post Content Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_contentcolor" id="template_contentcolor" value="<?php echo $settings["template_contentcolor"]; ?>"/>
                                        </td>
                                    </tr>
                                    <tr class="read_more_on">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select option for display read more button where to display', 'blog-designer'); ?></div>
                                            <?php _e('Display Read More On', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <?php
                                            $read_more_on = get_option('read_more_on');
                                            $read_more_on = ($read_more_on != '') ? $read_more_on : 2;
                                            ?>
                                            <fieldset class="buttonset three-buttomset">
                                                <input id="readmore_on_0" name="readmore_on" type="radio" value="0" <?php checked(0, $read_more_on); ?>/>
                                                <label id="bdp-options-button" for="readmore_on_0" <?php checked(0, $read_more_on); ?>><?php _e('Disable', 'blog-designer'); ?></label>
                                                <input id="readmore_on_1" name="readmore_on" type="radio" value="1" <?php checked(1, $read_more_on); ?> />
                                                <label id="bdp-options-button" for="readmore_on_1" <?php checked(1, $read_more_on); ?>><?php _e('Same Line', 'blog-designer'); ?></label>
                                                <input id="readmore_on_2" name="readmore_on" type="radio" value="2" <?php checked(2, $read_more_on); ?> />
                                                <label id="bdp-options-button" for="readmore_on_2" <?php checked(2, $read_more_on); ?>><?php _e('Next Line', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr class="read_more_text">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enter read more text label', 'blog-designer'); ?></div>
                                            <?php _e('Read More Text', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="txtReadmoretext" id="txtReadmoretext" value="<?php echo get_option('read_more_text'); ?>" placeholder="Enter read more text">
                                        </td>
                                    </tr>
                                    <tr class="read_more_text_color">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select Read more text color', 'blog-designer'); ?></div>
                                            <?php _e('Read More Text Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_readmorecolor" id="template_readmorecolor" value="<?php echo (isset($settings["template_readmorecolor"])) ? $settings["template_readmorecolor"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr class="read_more_text_background">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select Read more text background color', 'blog-designer'); ?></div>
                                            <?php _e('Read More Text Background Color', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <input type="text" name="template_readmorebackcolor" id="template_readmorebackcolor" value="<?php echo (isset($settings["template_readmorebackcolor"])) ? $settings["template_readmorebackcolor"] : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr class="read_more_text_background last-tr">
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Select Read more text hover background color', 'blog-designer'); ?></div>
                                            <?php _e('Read More Text Hover Background Color', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <input type="text" name="" id="template_readmorebackcolor" value=""/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h3 class="bd-table-title"><?php _e('Typography Settings', 'blog-designer'); ?></h3>
                            <div class="bd-typography-wrapper">

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select post content font family', 'blog-designer'); ?></div>
                                        <?php _e('Font Family', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id=""></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select font size for post content', 'blog-designer'); ?></div>
                                        <?php _e('Font Size', 'blog-designer') ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="grid_col_space range_slider_fontsize" id="template_postContentfontsizeInput" data-value="<?php echo get_option('content_fontsize'); ?>"></div>
                                        <div class="slide_val">
                                            <span></span>
                                            <input class="grid_col_space_val range-slider__value" name="content_fontsize" id="content_fontsize" value="<?php echo get_option('content_fontsize'); ?>" onkeypress="return isNumberKey(event)" />
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select font weight', 'blog-designer'); ?></div>
                                        <?php _e('Font Weight', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id="">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Enter line height', 'blog-designer'); ?></div>
                                        <?php _e('Line Height', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="quantity">
                                            <input type="number" name="" id="" step="0.1" min="0" value="1.5" onkeypress="return isNumberKey(event)">
                                            <div class="quantity-nav">
                                                <div class="quantity-button quantity-up">+</div>
                                                <div class="quantity-button quantity-down">-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Enable/Disable italic font style', 'blog-designer'); ?></div>
                                        <?php _e('Italic Font Style', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <input type="checkbox" name="" id="" value="1">
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select text transform style', 'blog-designer'); ?></div>
                                        <?php _e('Text Transform', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id=""></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Select text decoration style', 'blog-designer'); ?></div>
                                        <?php _e('Text Decoration', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="select-cover">
                                            <select name="" id=""></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-typography-cover pro-feature">
                                    <div class="bd-typography-lable">
                                        <div class="bd-title-tooltip"><?php _e('Enter letter spacing', 'blog-designer'); ?></div>
                                        <?php _e('Letter Spacing', 'blog-designer'); ?>
                                    </div>
                                    <div class="bd-typography-content">
                                        <div class="quantity">
                                            <input type="number" name="" id="" step="1" min="0" value="0" onkeypress="return isNumberKey(event)">
                                            <div class="quantity-nav">
                                                <div class="quantity-button quantity-up">+</div>
                                                <div class="quantity-button quantity-down">-</div>
                                            </div>
                                        </div>
                                        <?php _e('px', 'blog-designer'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="bdpmedia" class="postbox postbox-with-fw-options" <?php echo $bdpmedia_class_show; ?>>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Enable/Disable post image link'); ?></div>
                                            <?php _e('Post Image Link', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <fieldset class="buttonset">
                                                <input id="bdp_post_image_link_0" name="bdp_post_image_link" type="radio" value="0" />
                                                <label for="bdp_post_image_link_0"><?php _e('Disable', 'blog-designer'); ?></label>
                                                <input id="bdp_post_image_link_1" name="bdp_post_image_link" type="radio" value="1" checked="checked"/>
                                                <label for="bdp_post_image_link_1"><?php _e('Enable', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Select post default image', 'blog-designer'); ?></div>
                                            <?php _e('Select Post Default Image', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <input class="button bdp-upload_image_button" type="button" value="<?php esc_attr_e('Upload Image', 'blog-designer'); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Select size of post media', 'blog-designer'); ?></div>
                                            <?php _e('Select Post Media Size', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <div class="select-cover">
                                                <select name="" id=""> </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="bdpsocial" class="postbox postbox-with-fw-options" <?php echo $bdpsocial_class_show; ?>>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Select social share style', 'blog-designer'); ?></div>
                                            <?php _e('Social Share Style', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature">
                                            <fieldset class="buttonset green">
                                                <input id="social_style_0" name="social_style" type="radio" value="0" />
                                                <label for="social_style_0"><?php _e('Custom', 'blog-designer'); ?></label>
                                                <input id="social_style_1" name="social_style" type="radio" value="1" checked="checked" />
                                                <label for="social_style_1"><?php _e('Default', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pro-feature">
                                            <div class="bd-title-tooltip"><?php _e('Select icon theme from available icon theme', 'blog-designer'); ?></div>
                                            <?php _e('Available Icon Themes', 'blog-designer') ?>
                                        </td>
                                        <td class="pro-feature social-share-td">
                                            <div class="social-share-theme">
                                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                    <div class="social-cover social_share_theme_<?php echo $i; ?>">
                                                        <label>
                                                            <input type="radio" id="default_icon_theme_<?php echo $i; ?>" value="" name="default_icon_theme" />
                                                            <span class="bdp-social-icons facebook-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons gmail-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons twitter-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons linkdin-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons pin-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons whatsup-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons telegram-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons pocket-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons mail-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons reddit-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons tumblr-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons skype-icon bdp_theme_wrapper"></span>
                                                            <span class="bdp-social-icons wordpress-icon bdp_theme_wrapper"></span>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Select shape of social icon', 'blog-designer'); ?></div>
                                            <?php _e('Shape of Social Icon', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset green">
                                                <input id="social_icon_style_0" name="social_icon_style" type="radio" value="0" <?php echo checked(0, get_option('social_icon_style')); ?>/>
                                                <label for="social_icon_style_0"><?php _e('Circle', 'blog-designer'); ?></label>
                                                <input id="social_icon_style_1" name="social_icon_style" type="radio" value="1" <?php echo checked(1, get_option('social_icon_style')); ?> />
                                                <label for="social_icon_style_1"><?php _e('Square', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enable/Disable facebook share link', 'blog-designer'); ?></div>
                                            <?php _e('Facebook Share Link', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="facebook_link_1" name="facebook_link" type="radio" value="1" <?php echo checked(1, get_option('facebook_link')); ?> />
                                                <label for="facebook_link_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="facebook_link_0" name="facebook_link" type="radio" value="0" <?php echo checked(0, get_option('facebook_link')); ?>/>
                                                <label for="facebook_link_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enable/Disable Google+ Share link', 'blog-designer'); ?></div>
                                            <?php _e('Google+ Share Link', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="google_link_1" name="google_link" type="radio" value="1" <?php echo checked(1, get_option('google_link')); ?> />
                                                <label for="google_link_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="google_link_0" name="google_link" type="radio" value="0" <?php echo checked(0, get_option('google_link')); ?>/>
                                                <label for="google_link_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enable/Disable linkedin share link', 'blog-designer'); ?></div>
                                            <?php _e('Linkedin Share Link', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="linkedin_link_1" name="linkedin_link" type="radio" value="1" <?php echo checked(1, get_option('linkedin_link')); ?> />
                                                <label for="linkedin_link_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="linkedin_link_0" name="linkedin_link" type="radio" value="0" <?php echo checked(0, get_option('linkedin_link')); ?>/>
                                                <label for="linkedin_link_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr class="last-tr">
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enable/Disable Pinterest share link', 'blog-designer'); ?></div>
                                            <?php _e('Pinterest Share link', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="pinterest_link_1" name="pinterest_link" type="radio" value="1" <?php echo checked(1, get_option('pinterest_link')); ?> />
                                                <label for="pinterest_link_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="pinterest_link_0" name="pinterest_link" type="radio" value="0" <?php echo checked(0, get_option('pinterest_link')); ?>/>
                                                <label for="pinterest_link_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="bd-title-tooltip"><?php _e('Enable/Disable twitter share link', 'blog-designer'); ?></div>
                                            <?php _e('Twitter Share Link', 'blog-designer') ?>
                                        </td>
                                        <td>
                                            <fieldset class="buttonset">
                                                <input id="twitter_link_1" name="twitter_link" type="radio" value="1" <?php echo checked(1, get_option('twitter_link')); ?> />
                                                <label for="twitter_link_1"><?php _e('No', 'blog-designer'); ?></label>
                                                <input id="twitter_link_0" name="twitter_link" type="radio" value="0" <?php echo checked(0, get_option('twitter_link')); ?>/>
                                                <label for="twitter_link_0"><?php _e('Yes', 'blog-designer'); ?></label>
                                            </fieldset>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="inner">
                    <input type="submit" style="display: none;" class="save_blogdesign" value="<?php _e('Save Changes', 'blog-designer'); ?>" />
                    <p class="wl-saving-warning"></p>
                    <div class="clear"></div>
                </div>
            </form>
            <div class="bd-admin-sidebar hidden">
                <div class="bd-help">
                    <h2><?php _e('Help to improve this plugin!', 'blog-designer'); ?></h2>
                    <div class="help-wrapper">
                        <span><?php _e('Enjoyed this plugin?', 'blog-designer'); ?>&nbsp;</span>
                        <span><?php _e('You can help by', 'blog-designer'); ?>
                            <a href="https://wordpress.org/support/plugin/blog-designer/reviews?filter=5#new-post" target="_blank">&nbsp;
                                <?php _e('rate this plugin 5 stars!', 'blog-designer'); ?>
                            </a>
                        </span>
                        <div class="bd-total-download">
                            <?php _e('Downloads:', 'blog-designer'); ?><?php get_total_downloads(); ?>
                            <?php
                            if ($wp_version > 3.8) {
                                wp_custom_star_rating();
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="useful_plugins">
                    <h2>
                        <?php _e('Blog Designer PRO', 'blog-designer'); ?>
                    </h2>
                    <div class="help-wrapper">
                        <div class="pro-content">
                            <ul class="advertisementContent">
                                <li><?php _e("36 Beautiful Blog Templates", 'blog-designer') ?></li>
                                <li><?php _e("5 Unique Timeline Templates", 'blog-designer') ?></li>
                                <li><?php _e("5 Unique Grid Templates", 'blog-designer') ?></li>
                                <li><?php _e("3 Unique Slider Templates", 'blog-designer') ?></li>
                                <li><?php _e("100+ Blog Layout Variations", 'blog-designer') ?></li>
                                <li><?php _e("Multiple Single Post Layout options", 'blog-designer') ?></li>
                                <li><?php _e("Category, Tag, Author & Date Layouts", 'blog-designer') ?></li>
                                <li><?php _e("Post Type & Taxonomy Filter", 'blog-designer') ?></li>
                                <li><?php _e("800+ Google Font Support", 'blog-designer') ?></li>
                                <li><?php _e("600+ Font Awesome Icons Support", 'blog-designer') ?></li>
                            </ul>
                            <p class="pricing_change"><?php _e("Now only at", 'blog-designer') ?> <del>$29</del><ins>$24</ins></p>
                        </div>
                        <div class="pre-book-pro">
                            <a href="<?php echo esc_url('https://codecanyon.net/item/blog-designer-pro-for-wordpress/17069678?ref=solwin'); ?>" target="_blank">
                                <?php _e('Buy Now on Codecanyon', 'blog-designer'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bd-support">
                    <h3><?php _e('Need Support?', 'blog-designer'); ?></h3>
                    <div class="help-wrapper">
                        <span><?php _e('Check out the', 'blog-designer') ?>
                            <a href="<?php echo esc_url('https://wordpress.org/plugins/blog-designer/faq/'); ?>" target="_blank"><?php _e('FAQs', 'blog-designer'); ?></a>
                            <?php _e('and', 'blog-designer') ?>
                            <a href="<?php echo esc_url('https://wordpress.org/support/plugin/blog-designer'); ?>" target="_blank"><?php _e('Support Forums', 'blog-designer') ?></a>
                        </span>
                    </div>
                </div>
                <div class="bd-support">
                    <h3><?php _e('Share & Follow Us', 'blog-designer'); ?></h3>
                    <!-- Twitter -->
                    <div class="help-wrapper">
                        <div style='display:block;margin-bottom:8px;'>
                            <a href="<?php echo esc_url('https://twitter.com/solwininfotech'); ?>" class="twitter-follow-button" data-show-count="false" data-show-screen-name="true" data-dnt="true">Follow @solwininfotech</a>
                            <script>!function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                    if (!d.getElementById(id)) {
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = p + '://platform.twitter.com/widgets.js';
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }
                                }(document, 'script', 'twitter-wjs');</script>
                        </div>
                        <!-- Facebook -->
                        <div style='display:block;margin-bottom:10px;'>
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id))
                                        return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-share-button" data-href="https://wordpress.org/plugins/blog-designer/" data-layout="button"></div>
                        </div>
                        <!-- Google Plus -->
                        <div style='display:block;margin-bottom:8px;'>
                            <!-- Place this tag where you want the +1 button to render. -->
                            <div class="g-plusone" data-count="false" data-href="https://wordpress.org/plugins/blog-designer/"></div>
                            <!-- Place this tag after the last +1 button tag. -->
                            <script type="text/javascript">
                                (function () {
                                    var po = document.createElement('script');
                                    po.type = 'text/javascript';
                                    po.async = true;
                                    po.src = 'https://apis.google.com/js/platform.js';
                                    var s = document.getElementsByTagName('script')[0];
                                    s.parentNode.insertBefore(po, s);
                                })();
                            </script>
                        </div>
                        <div style='display:block;margin-bottom:8px;'>
                            <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                            <script type="IN/Share" data-url="https://wordpress.org/plugins/blog-designer/" ></script>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bd_popupdiv" class="bd-template-popupdiv" style="display: none;">
                <ul class="bd_template_tab">
                    <li class="bd_current_tab">
                        <a href="#all"><?php _e('All', 'blog-designer'); ?></a>
                    </li>
                    <li>
                        <a href="#free"><?php _e('Free', 'blog-designer'); ?></a>
                    </li>
                    <li class="">
                        <a href="#full-width"><?php _e('Full Width', 'blog-designer'); ?></a>
                    </li>
                    <li>
                        <a href="#grid"><?php _e('Grid', 'blog-designer'); ?></a>
                    </li>
                    <li>
                        <a href="#masonry"><?php _e('Masonry', 'blog-designer'); ?></a>
                    </li>
                    <li>
                        <a href="#odd-even"><?php _e('2 Columns', 'blog-designer'); ?></a>
                    </li>
                    <li>
                        <a href="#box-view"><?php _e('Box View', 'blog-designer'); ?></a>
                    </li>
                    <li>
                        <a href="#timeline"><?php _e('Timeline', 'blog-designer'); ?></a>
                    </li>
                    <li>
                        <a href="#slider"><?php _e('Slider', 'blog-designer'); ?></a>
                    </li>
                    <div class="bd-template-search-cover">
                        <input type="text" class="bd-template-search" id="bd-template-search" placeholder="<?php _e('Search Template', 'blog-designer'); ?>" />
                        <span class="bd-template-search-clear"></span>
                    </div>
                </ul>

                <?php
                $tempate_list = bd_template_list();
                echo '<div class="bd-template-cover">';
                foreach ($tempate_list as $key => $value) {
                    if ($key == 'classical' || $key == 'lightbreeze' || $key == 'spektrum' || $key == 'evolution' || $key == 'timeline' || $key == 'news') {
                        $class = 'bp-light';
                    } else {
                        $class = 'bp-pro';
                    }
                    ?>
                    <div class="bd-template-thumbnail <?php echo $value['class'] . ' ' . $class; ?>">
                        <div class="bd-template-thumbnail-inner">
                            <img src="<?php echo BLOGDESIGNER_URL . '/images/layouts/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                            <?php if ($class == 'bp-light') { ?>
                                <div class="bd-hover_overlay">
                                    <div class="bd-popup-template-name">
                                        <div class="bd-popum-select"><a href="#"><?php _e('Select Template', 'blog-designer'); ?></a></div>
                                        <div class="bd-popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', 'blog-designer'); ?></a></div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="bd_overlay"></div>
                                <div class="bd-img-hover_overlay">
                                    <img src="<?php echo BLOGDESIGNER_URL . '/images/pro-tag.png' ?>" alt="Available in Pro" />
                                </div>
                                <div class="bd-hover_overlay">
                                    <div class="bd-popup-template-name">
                                        <div class="bd-popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', 'blog-designer'); ?></a></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <span class="bd-span-template-name"><?php echo $value['template_name']; ?></span>
                    </div>
                    <?php
                }
                echo '</div>';
                echo '<h3 class="no-template" style="display: none;">' . __('No template found. Please try again', 'blog-designer') . '</h3>';
                ?>

            </div>
            <div id="bd-advertisement-popup">
                <div class="bd-advertisement-cover">
                    <a class="bd-advertisement-link" target="_blank" href="<?php echo esc_url('https://codecanyon.net/item/blog-designer-pro-for-wordpress/17069678?ref=solwin'); ?>">
                        <img src="<?php echo BLOGDESIGNER_URL . '/images/bd_advertisement_popup.png'; ?>" />
                    </a>
                </div>
            </div>
        </div>
        <?php
    }

}

/**
 *
 * @param type $args
 * @return type Display Pagination
 */
if (!function_exists('designer_pagination')) {

    function designer_pagination($args = array()) {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        $navigation = '';
        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';

        $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links(array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $GLOBALS['wp_query']->max_num_pages,
            'current' => $paged,
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $query_args),
            'prev_text' => '&larr; ' . __('Previous', 'blog-designer'),
            'next_text' => __('Next', 'blog-designer') . ' &rarr;',
            'type' => 'list',
        ));

        if ($links) :
            $navigation .= '<nav class="navigation paging-navigation" role="navigation">';
            $navigation .= $links;
            $navigation .= '</nav>';
        endif;
        return $navigation;
    }

}

class BDesigner {

    protected $args;

    function __construct($args) {
        $this->args = $args;
    }

    function __get($key) {
        return $this->args[$key];
    }

    function get_pagination_args() {
        global $numpages;

        $query = $this->query;

        switch ($this->type) {
            case 'multipart':
                // Multipart page
                $posts_per_page = 1;
                $paged = max(1, absint(get_query_var('page')));
                $total_pages = max(1, $numpages);
                break;
            case 'users':
                // WP_User_Query
                $posts_per_page = $query->query_vars['number'];
                $paged = max(1, floor($query->query_vars['offset'] / $posts_per_page) + 1);
                $total_pages = max(1, ceil($query->total_users / $posts_per_page));
                break;
            default:
                // WP_Query
                $posts_per_page = intval($query->get('posts_per_page'));
                $paged = max(1, absint($query->get('paged')));
                $total_pages = max(1, absint($query->max_num_pages));
                break;
        }

        return array($posts_per_page, $paged, $total_pages);
    }

    function get_single($page, $class, $raw_text, $format = '%PAGE_NUMBER%') {
        if (empty($raw_text))
            return '';

        $text = str_replace($format, number_format_i18n($page), $raw_text);

        return "<a href='" . esc_url($this->get_url($page)) . "' class='$class'>$text</a>";
    }

    function get_url($page) {
        return ( 'multipart' == $this->type ) ? get_multipage_link($page) : get_pagenum_link($page);
    }

}

/**
 *
 * @return int
 */
if (!function_exists('blogdesignerpaged')) {

    function blogdesignerpaged() {
        if (strstr($_SERVER['REQUEST_URI'], 'paged') || strstr($_SERVER['REQUEST_URI'], 'page')) {
            if (isset($_REQUEST['paged'])) {
                $paged = $_REQUEST['paged'];
            } else {
                $uri = explode('/', $_SERVER['REQUEST_URI']);
                $uri = array_reverse($uri);
                $paged = $uri[1];
            }
        } else {
            $paged = 1;
        }
        /* Pagination issue on home page */
        if (is_front_page()) {
            $paged = get_query_var('page') ? intval(get_query_var('page')) : 1;
        } else {
            $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        }

        return $paged;
    }

}

/**
 * admin scripts
 */
if (!function_exists('bd_admin_scripts')) {

    function bd_admin_scripts() {
        $screen = get_current_screen();
        $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/blog-designer/blog-designer.php', $markup = true, $translate = true);
        $current_version = $plugin_data['Version'];
        $old_version = get_option('bd_version');
        if ($old_version != $current_version) {
            update_option('is_user_subscribed_cancled', '');
            update_option('bd_version', $current_version);
        }
        if ((get_option('is_user_subscribed') != 'yes' && get_option('is_user_subscribed_cancled') != 'yes') || ($screen->base == 'plugins')) {
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-slider');
    }

}
add_action('admin_enqueue_scripts', 'bd_admin_scripts');

/**
 * start session if not
 */
if (!function_exists('bd_session_start')) {

    function bd_session_start() {
        if (version_compare(phpversion(), "5.4.0") != -1) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        } else {
            if (session_id() == '') {
                session_start();
            }
        }
    }

}
add_action('init', 'bd_session_start');

/**
 * subscribe email form
 */
if (!function_exists('bd_subscribe_mail')) {

    function bd_subscribe_mail() {
        $customer_email = get_option('admin_email');
        $current_user = wp_get_current_user();
        $f_name = $current_user->user_firstname;
        $l_name = $current_user->user_lastname;
        if (isset($_POST['sbtEmail'])) {
            $_SESSION['success_msg'] = 'Thank you for your subscription.';
            //Email To Admin
            update_option('is_user_subscribed', 'yes');
            $customer_email = trim($_POST['txtEmail']);
            $customer_name = trim($_POST['txtName']);
            $to = 'plugins@solwininfotech.com';
            $from = get_option('admin_email');

            $headers = "MIME-Version: 1.0;\r\n";
            $headers .= "From: " . strip_tags($from) . "\r\n";
            $headers .= "Content-Type: text/html; charset: utf-8;\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
            $subject = 'New user subscribed from Plugin - Blog Designer';
            $body = '';
            ob_start();
            ?>
            <div style="background: #F5F5F5; border-width: 1px; border-style: solid; padding-bottom: 20px; margin: 0px auto; width: 750px; height: auto; border-radius: 3px 3px 3px 3px; border-color: #5C5C5C;">
                <div style="border: #FFF 1px solid; background-color: #ffffff !important; margin: 20px 20px 0;
                     height: auto; -moz-border-radius: 3px; padding-top: 15px;">
                    <div style="padding: 20px 20px 20px 20px; font-family: Arial, Helvetica, sans-serif;
                         height: auto; color: #333333; font-size: 13px;">
                        <div style="width: 100%;">
                            <strong>Dear Admin (Blog Designer plugin developer)</strong>,
                            <br />
                            <br />
                            Thank you for developing useful plugin.
                            <br />
                            <br />
                            I <?php echo $customer_name; ?> want to notify you that I have installed plugin on my <a href="<?php echo home_url(); ?>">website</a>. Also I want to subscribe to your newsletter, and I do allow you to enroll me to your free newsletter subscription to get update with new products, news, offers and updates.
                            <br />
                            <br />
                            I hope this will motivate you to develop more good plugins and expecting good support form your side.
                            <br />
                            <br />
                            Following is details for newsletter subscription.
                            <br />
                            <br />
                            <div>
                                <table border='0' cellpadding='5' cellspacing='0' style="font-family: Arial, Helvetica, sans-serif; font-size: 13px;color: #333333;width: 100%;">
                                    <?php if ($customer_name != '') {
                                        ?>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                                Name<span style="float:right">:</span>
                                            </th>
                                            <td style="padding: 8px 5px;">
                                                <?php echo $customer_name; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                                Name<span style="float:right">:</span>
                                            </th>
                                            <td style="padding: 8px 5px;">
                                                <?php echo home_url(); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                            Email<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo $customer_email; ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                            Website<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo home_url(); ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                            Date<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo date('d-M-Y  h:i  A'); ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                            Plugin<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo 'Blog Designer'; ?>
                                        </td>
                                    </tr>
                                </table>
                                <br /><br />
                                Again Thanks you
                                <br />
                                <br />
                                Regards
                                <br />
                                <?php echo $customer_name; ?>
                                <br />
                                <?php echo home_url(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $body = ob_get_clean();
            wp_mail($to, $subject, $body, $headers);
        }
        if (get_option('is_user_subscribed') != 'yes' && get_option('is_user_subscribed_cancled') != 'yes') {
            ?>
            <div id="subscribe_widget_bd" style="display:none;">
                <div class="subscribe_widget">
                    <h3><?php _e('Notify to plugin developer and subscribe.', 'blog-designer'); ?></h3>
                    <form class='sub_form' name="frmSubscribe" method="post" action="<?php echo admin_url() . 'admin.php?page=designer_settings'; ?>">
                        <div class="sub_row"><label><?php _e('Your Name: ', 'blog-designer'); ?></label><input placeholder="Your Name" name="txtName" type="text" value="<?php echo $f_name . ' ' . $l_name; ?>" /></div>
                        <div class="sub_row"><label><?php _e('Email Address: ', 'blog-designer'); ?></label><input placeholder="Email Address" required name="txtEmail" type="email" value="<?php echo $customer_email; ?>" /></div>
                        <input class="button button-primary" type="submit" name="sbtEmail" value="Notify & Subscribe" />
                    </form>
                </div>
            </div>
            <?php
        }
        if (isset($_GET['page'])) {
            if (get_option('is_user_subscribed') != 'yes' && get_option('is_user_subscribed_cancled') != 'yes' && $_GET['page'] == 'designer_settings') {
                ?>
                <a style="display:none" href="#TB_inline?max-width=400&height=210&inlineId=subscribe_widget_bd" class="thickbox" id="subscribe_thickbox"></a>
                <?php
            }
        }
        ?>
        <div id="sol_deactivation_widget_cover_bd" style="display:none;">
            <div class="sol_deactivation_widget">
                <h3><?php _e('If you have a moment, please let us know why you are deactivating.', 'blog-designer'); ?></h3>
                <form id="frmDeactivationbd" name="frmDeactivation" method="post" action="">
                    <ul class="sol_deactivation_reasons_ul">
                        <?php $i = 1; ?>
                        <li>
                            <input class="sol_deactivation_reasons" checked name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('I am going to upgrade to PRO version', 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('The plugin suddenly stopped working', 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('The plugin was not working', 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('I have configured plugin but not working with my blog page', 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('Installed & configured well but disturbed my blog page design', 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e("My theme's blog page is better than plugin's blog page design", 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('The plugin broke my site completely', 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('No any reason', 'blog-designer'); ?></label>
                        </li>
                        <?php $i++; ?>
                        <li>
                            <input class="sol_deactivation_reasons" name="sol_deactivation_reasons_bd" type="radio" value="<?php echo $i; ?>" id="bd_reason_<?php echo $i; ?>">
                            <label for="bd_reason_<?php echo $i; ?>"><?php _e('Other', 'blog-designer'); ?></label><br/>
                            <input style="display:none;width: 90%" value="" type="text" name="sol_deactivation_reason_other_bd" class="sol_deactivation_reason_other_bd" />
                        </li>
                    </ul>
                    <input type="submit" name="sbtDeactivationForm" id="sbtDeactivationFormbd" class="button button-secondary" value="submit & deactivate" />
                    <input type="submit" name="sbtDeactivationFormClose" id="sbtDeactivationFormClosebd" class="button button-primary" value="cancel" />
                </form>
            </div>
        </div>
        <a style="display:none" href="#TB_inline?height=500&inlineId=sol_deactivation_widget_cover_bd" class="thickbox" id="deactivation_thickbox_bd"></a>
        <?php
    }

}
add_action('admin_head', 'bd_subscribe_mail', 10);

/**
 * user cancel subscribe
 */
if (!function_exists('wp_ajax_bd_close_tab')) {

    function wp_ajax_bd_close_tab() {
        update_option('is_user_subscribed_cancled', 'yes');
        exit();
    }

}
add_action('wp_ajax_close_tab', 'wp_ajax_bd_close_tab');

if (!function_exists('bd_remove_continue_reading')) {

    function bd_remove_continue_reading($more) {
        return '';
    }

}


if (!function_exists('bd_plugin_links')) {

    function bd_plugin_links($links) {
        $links[] = '<a class="documentation_bd_plugin" target="_blank" href="' . esc_url('https://www.solwininfotech.com/documents/wordpress/blogdesigner-lite/') . '">' . __('Documentation', 'blog-designer') . '</a>';
        $links[] = '<a target="_blank" href="' . esc_url('https://codecanyon.net/item/blog-designer-pro-for-wordpress/17069678?ref=solwin') . '" class="bd_upgrade_link">' . __('Upgrade', 'blog-designer') . '</a>';
        return $links;
    }

}


/**
 * Fusion Page Builder Support
 */
add_action('init', 'fsn_init_blog_designer', 12);

if (!function_exists('fsn_init_blog_designer')) {

    function fsn_init_blog_designer() {
        if (function_exists('fsn_map')) {
            fsn_map(array(
                'name' => __('Blog Designer', 'blog-designer'),
                'shortcode_tag' => 'fsn_blog_designer',
                'description' => __('To make your blog design more pretty, attractive and colorful.', 'blog-designer'),
                'icon' => 'fsn_blog',
            ));
        }
    }

}

add_shortcode('fsn_blog_designer', 'fsn_blog_designer_shortcode');

if (!function_exists('fsn_blog_designer_shortcode')) {

    function fsn_blog_designer_shortcode($atts, $content) {

        ob_start();
        ?>
        <div class="fsn-bdp <?php echo fsn_style_params_class($atts); ?>">
            <?php echo do_shortcode('[wp_blog_designer]') ?>
        </div>
        <?php
        $output = ob_get_clean();
        return $output;
    }

}

/* submit deactivation reason form */
if (!function_exists('db_sbt_deactivation_form')) {

    function db_sbt_deactivation_form() {
        //Email To Admin
        $to = 'pluginsd@solwininfotech.com';
        $from = get_option('admin_email');
        $reason_id = $_POST['deactivation_option'];
        $reason_text = $_POST['deactivation_option_text'];
        if ($reason_id == 9) {
            $reason_text = $_POST['deactivation_option_other'];
        }
        $headers = "MIME-Version: 1.0;\r\n";
        $headers .= "From: " . strip_tags($from) . "\r\n";
        $headers .= "Content-Type: text/html; charset: utf-8;\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        $subject = 'User has deactivated Plugin - Blog Designer';
        $body = '';
        ob_start();
        ?>
        <div style="background: #F5F5F5; border-width: 1px; border-style: solid; padding-bottom: 20px; margin: 0px auto; width: 750px; height: auto; border-radius: 3px 3px 3px 3px; border-color: #5C5C5C;">
            <div style="border: #FFF 1px solid; background-color: #ffffff !important; margin: 20px 20px 0;
                 height: auto; -moz-border-radius: 3px; padding-top: 15px;">
                <div style="padding: 20px 20px 20px 20px; font-family: Arial, Helvetica, sans-serif;
                     height: auto; color: #333333; font-size: 13px;">
                    <div style="width: 100%;">
                        <strong>Dear Admin (Blog Designer plugin developer)</strong>,
                        <br />
                        <br />
                        Thank you for developing useful plugin.
                        <br />
                        <br />
                        I have deactivated plugin because of following reason.
                        <br />
                        <br />
                        <div>
                            <table border='0' cellpadding='5' cellspacing='0' style="font-family: Arial, Helvetica, sans-serif; font-size: 13px;color: #333333;width: 100%;">
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                        Reason ID<span style="float:right">:</span>
                                    </th>
                                    <td style="padding: 8px 5px;">
                                        <?php echo $reason_id; ?>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                        Reason<span style="float:right">:</span>
                                    </th>
                                    <td style="padding: 8px 5px;">
                                        <?php echo $reason_text; ?>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                        Website<span style="float:right">:</span>
                                    </th>
                                    <td style="padding: 8px 5px;">
                                        <?php echo home_url(); ?>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                        Email<span style="float:right">:</span>
                                    </th>
                                    <td style="padding: 8px 5px;">
                                        <?php echo $from; ?>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                        Date<span style="float:right">:</span>
                                    </th>
                                    <td style="padding: 8px 5px;">
                                        <?php echo date('d-M-Y  h:i  A'); ?>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                        Plugin<span style="float:right">:</span>
                                    </th>
                                    <td style="padding: 8px 5px;">
                                        <?php echo 'Blog Designer'; ?>
                                    </td>
                                </tr>
                            </table>
                            <br /><br />
                            Again Thanks you
                            <br />
                            <br />
                            Regards
                            <br />
                            <?php echo home_url(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $body = ob_get_clean();
        //echo $body;
        wp_mail($to, $subject, $body, $headers);
        exit();
    }

}


if (!function_exists('bd_template_search_result')) {

    function bd_template_search_result() {
        $template_name = $_POST['temlate_name'];

        $tempate_list = bd_template_list();
        foreach ($tempate_list as $key => $value) {
            if ($template_name == '') {
                if ($key == 'classical' || $key == 'lightbreeze' || $key == 'spektrum' || $key == 'evolution' || $key == 'timeline' || $key == 'news') {
                    $class = 'bp-light';
                } else {
                    $class = 'bp-pro';
                }
                ?>
                <div class="bd-template-thumbnail <?php echo $value['class'] . ' ' . $class; ?>">
                    <div class="bd-template-thumbnail-inner">
                        <img src="<?php echo BLOGDESIGNER_URL . '/images/layouts/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                        <?php if ($class == 'bp-light') { ?>
                            <div class="bd-hover_overlay">
                                <div class="bd-popup-template-name">
                                    <div class="bd-popum-select"><a href="#"><?php _e('Select Template', 'blog-designer'); ?></a></div>
                                    <div class="bd-popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', 'blog-designer'); ?></a></div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="bd_overlay"></div>
                            <div class="bd-img-hover_overlay">
                                <img src="<?php echo BLOGDESIGNER_URL . '/images/pro-tag.png' ?>" alt="Available in Pro" />
                            </div>
                            <div class="bd-hover_overlay">
                                <div class="bd-popup-template-name">
                                    <div class="bd-popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', 'blog-designer'); ?></a></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <span class="bd-span-template-name"><?php echo $value['template_name']; ?></span>
                </div>
                <?php
            } elseif (preg_match('/' . trim($template_name) . '/', $key)) {
                if ($key == 'classical' || $key == 'lightbreeze' || $key == 'spektrum' || $key == 'evolution' || $key == 'timeline' || $key == 'news') {
                    $class = 'bp-light';
                } else {
                    $class = 'bp-pro';
                }
                ?>
                <div class="bd-template-thumbnail <?php echo $value['class'] . ' ' . $class; ?>">
                    <div class="bd-template-thumbnail-inner">
                        <img src="<?php echo BLOGDESIGNER_URL . '/images/layouts/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                        <?php if ($class == 'bp-light') { ?>
                            <div class="bd-hover_overlay">
                                <div class="bd-popup-template-name">
                                    <div class="bd-popum-select"><a href="#"><?php _e('Select Template', 'blog-designer'); ?></a></div>
                                    <div class="bd-popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', 'blog-designer'); ?></a></div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="bd_overlay"></div>
                            <div class="bd-img-hover_overlay">
                                <img src="<?php echo BLOGDESIGNER_URL . '/images/pro-tag.png' ?>" alt="Available in Pro" />
                            </div>
                            <div class="bd-hover_overlay">
                                <div class="bd-popup-template-name">
                                    <div class="bd-popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', 'blog-designer'); ?></a></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <span class="bd-span-template-name"><?php echo $value['template_name']; ?></span>
                </div>
                <?php
            }
        }
        exit();
    }

}

if(!function_exists('wp_bd_get_content')) {
    function wp_bd_get_content($postid) {
        $content = '';
        $excerpt_length = get_option('excerpt_length');
        $display_html_tags = get_option('display_html_tags', true);
        if (get_option('rss_use_excerpt') == 0) {
            $content = apply_filters('the_content', get_the_content($postid));
        } elseif (get_option('excerpt_length') > 0) {

            if($display_html_tags == 1) {
                $text = get_the_content($postid);
                if (strpos(_x('words', 'Word count type. Do not translate!', 'blog-designer'), 'characters') === 0 && preg_match('/^utf\-?8$/i', get_option('blog_charset'))) {
                    $text = trim(preg_replace("/[\n\r\t ]+/", ' ', $text), ' ');
                    preg_match_all('/./u', $text, $words_array);
                    $words_array = array_slice($words_array[0], 0, $excerpt_length + 1);
                    $sep = '';
                } else {
                    $words_array = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                    $sep = ' ';
                }
                if (count($words_array) > $excerpt_length) {
                    array_pop($words_array);
                    $text = implode($sep, $words_array);
                    $bp_excerpt_data = $text;
                } else {
                    $bp_excerpt_data = implode($sep, $words_array);
                }
                $first_letter = $bp_excerpt_data;
                if (preg_match('#(>|]|^)(([A-Z]|[a-z]|[0-9]|[\p{L}])(.*\R)*(\R)*.*)#m', $first_letter, $matches)) {
                    $top_content = str_replace($matches[2], '', $first_letter);
                    $content_change = ltrim($matches[2]);
                    $bp_content_first_letter = mb_substr($content_change, 0, 1);
                    if (mb_substr($content_change, 1, 1) === ' ') {
                        $bp_remaining_letter = ' ' . mb_substr($content_change, 2);
                    } else {
                        $bp_remaining_letter = mb_substr($content_change, 1);
                    }
                    $spanned_first_letter = '<span class="bp-first-letter">' . $bp_content_first_letter . '</span>';
                    $bottom_content = $spanned_first_letter . $bp_remaining_letter;
                    $bp_excerpt_data = $top_content . $bottom_content;
                    $bp_excerpt_data = wp_bp_close_tags($bp_excerpt_data);
                }
                $content = apply_filters('the_content', $bp_excerpt_data);
            } else {
                $text = apply_filters('the_content', get_the_content($postid));
                $text = apply_filters('the_content', $text);
                $text = str_replace(']]>', ']]&gt;', $text);
                $bp_excerpt_data = wp_trim_words($text, $excerpt_length, '');
                $bp_excerpt_data = apply_filters('wp_bd_excerpt_change', $bp_excerpt_data, $postid);
                $content = $bp_excerpt_data;
            }

        }
        return $content;
    }
}

if(!function_exists('wp_bp_close_tags')) {
    function wp_bp_close_tags($html = '') {
        if($html == '') {
            return;
        }
        #put all opened tags into an array
        preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
        $openedtags = $result[1];
        #put all closed tags into an array
        preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
        $closedtags = $result[1];
        $len_opened = count ( $openedtags );
        # all tags are closed
        if( count ( $closedtags ) == $len_opened ) {
            return $html;
        }
        $openedtags = array_reverse ( $openedtags );
        # close tags
        for( $i = 0; $i < $len_opened; $i++ ) {
            if ( !in_array ( $openedtags[$i], $closedtags ) ) {
                $html .= "</" . $openedtags[$i] . ">";
            } else {
                unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
            }
        }
        return $html;
    }
}
