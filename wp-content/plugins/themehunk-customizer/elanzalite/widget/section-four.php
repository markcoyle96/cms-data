<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 *  Testimonial Widget
  */
class themehunk_customizer_section_four extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'themehunk-customizer-section-four',
            'description' => 'Show your category post');
        parent::__construct('themehunk-customizer-section-four', __('THunk : Post Style 4','themehunk_customizer'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        // widget content
        echo $before_widget;
        $title = isset($instance['title'])?$instance['title']:__('writing your description','themehunk_customizer');
        $cate = isset($instance['cate']) ? absint($instance['cate']) : 0;
        $count = isset($instance['count']) ? absint($instance['count']) : 3;
        $title_bg_color = isset($instance['title_bg_color'])? $instance['title_bg_color']:'#66cda9';
        $title_txt_color = isset($instance['title_txt_color'])? $instance['title_txt_color']:'#fff';
        $args = array(
            'order' => 'DESC',
            'ignore_sticky_posts' => 1,
            'post_type' => 'post',
           // 'meta_key' => '_thumbnail_id',
            'posts_per_page' => $count, 
            'cat' => $cate
        );
            $latest_posts = new WP_Query($args);
            $catelink = get_category_link( $cate ); 
?>
<section id="section_four">
        <div class="inner_wrap">
            <!-- one -->
            <div class="recent-news">
                <h3 class="title" style="background:<?php echo $title_bg_color;?>; color:<?php echo $title_txt_color;?>"><?php echo $title; ?></h3>
                <?php if($cate): ?>
                <h3 class="view"><a href="<?php echo esc_url($catelink); ?>"><?php _e('View All','themehunk-customizer'); ?></a></h3>
            <?php endif; ?>                   <?php if ( $latest_posts->have_posts() ) { ?>

             <?php  while($latest_posts->have_posts()): $latest_posts->the_post(); ?>
                <!-- one -->
                <div class="post-item">
                    <div class="post-thumb">
                        <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { 
                        the_post_thumbnail( 'section-four' );
                         }
                        ?>
                    </div>
                    <div class="entry-body">
                        <div class="post-item-content">
                            <span class="cat-links">
                            <?php echo THunk_customizer_Cate(); ?>
                            </span>
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="entry-meta">
                                <span class="entry-date"><?php the_time( get_option('date_format') ); ?></span>
                                <span class="comments-link"><?php THunk_Customizer_Comment(); ?></span>
                            </div>
                             <?php the_excerpt(''); ?>
                            <div class="readmore_button">
                            <a href="<?php echo get_permalink(); ?>" rel="nofollow"><?php _e('Continue Reading →','themehunk-cutomizer'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php } wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php
        echo $after_widget;

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance["cate"] = absint($new_instance["cate"]);
        $instance['count'] = strip_tags( $new_instance['count'] );
        $instance["title_bg_color"] = $new_instance["title_bg_color"];
        $instance["title_txt_color"] = $new_instance["title_txt_color"];
        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : __('Latest News','themehunk-customizer');
        $cate = isset($instance['cate']) ? absint($instance['cate']) : 0;
        $count = isset($instance['count']) ? absint($instance['count']) : 3;
        $title_bg_color = isset($instance['title_bg_color']) ? $instance['title_bg_color'] :"#66cda9";
         $title_txt_color = isset($instance['title_txt_color']) ? $instance['title_txt_color'] :"#fff";


$termarr = array('child_of'   => 0);
$terms = get_terms('category' ,$termarr);
$foption = '<option value="0">Random Post Show</option>';
foreach($terms as $cat) {
    $term_id = $cat->term_id;
    $selected1 = ($cate==$term_id)?'selected':'';
$foption .= '<option value="'.$term_id.'" '.$selected1.'>'.$cat->name.'</option>';
}
    ?>

        <div class="clearfix"></div>
         <img src="<?php echo THEMEHUNK_CUSTOMIZER_STYLE4; ?>" />
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Latest News Title','themehunk-customizer'); ?></label>
    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"  class="widefat" value="<?php echo $title; ?>" >
    </p>
     <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of Post Show','elanzalite'); ?></label>
            <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
        <p>
    <p>
    <label for="<?php echo $this->get_field_id('cate'); ?>"><?php _e('Choose Category Show Post','themehunk-customizer'); ?></label>
        <select name="<?php echo $this->get_field_name('cate'); ?>" ><?php echo $foption; ?></select>
    </p>
    <p><label for="<?php echo $this->get_field_id( 'title_bg_color' ); ?>" style="display:block;"><?php _e( 'Title Background Color:','themehunk-customizer' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_bg_color' ); ?>" name="<?php echo $this->get_field_name( 'title_bg_color' ); ?>" type="text" value="<?php echo esc_attr( $title_bg_color ); ?>" />
    </p>
    <p>
     <label for="<?php echo $this->get_field_id( 'title_txt_color' ); ?>" style="display:block;"><?php _e( 'Text Color','themehunk-customizer' ); ?></label> 
      <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_txt_color' ); ?>" name="<?php echo $this->get_field_name( 'title_txt_color' ); ?>" type="text" value="<?php echo esc_attr( $title_txt_color); ?>" />
        </p>
        <?php
    }
}
?>