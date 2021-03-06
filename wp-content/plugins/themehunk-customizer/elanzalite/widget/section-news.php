<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

  /*
  * Add Widget
  */
class themehunk_customizer_section_news extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'themehunk-customizer-section-news',
            'description' => 'Show your News');
        parent::__construct('themehunk-customizer-section-news', __('THunk : News Slider','themehunk_customizer'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        // widget content
        echo $before_widget;
        $title = isset($instance['title'])?$instance['title']:__('Breaking News','themehunk_customizer');
        $fcount = isset($instance['fcount']) ? absint($instance['fcount']) : 4;
        $fcate = isset($instance['fcate']) ? absint($instance['fcate']) : 0;
        $news_bg_color = isset($instance['news_bg_color'])? $instance['news_bg_color']:'#0e0e0e';
        $news_tle_color = isset($instance['news_tle_color'])? $instance['news_tle_color']:'#fff';
        $news_post_tle_color = isset($instance['news_post_tle_color'])? $instance['news_post_tle_color']:'#66cda9';
        $news_post_tme_color = isset($instance['news_post_tme_color'])? $instance['news_post_tme_color']:'#bbb';
        $news_post_tme_bgcolor = isset($instance['news_post_tme_bgcolor'])? $instance['news_post_tme_bgcolor']:'#403f3f';

        $args = array(
            'order' => 'DESC',
            'post_type' => 'post',
            'meta_key' => '_thumbnail_id',
            'posts_per_page' => $fcount, 
            'cat' => $fcate
        );
            $featured_posts = new WP_Query($args);
?>
<div class="breaking-new" style="background:<?php echo $news_bg_color;?>">
    <div class="inner-wrap">
    <div class="new-title">
        <h3 style="color:<?php echo $news_tle_color;?>"><?php echo $title; ?></h3>
    </div>
<div class="news-ticker-wrap">
<marquee behavior="scroll" direction="left" onmouseover="stop();"  onmouseout="start();">
<?php if ( $featured_posts->have_posts() ) { ?>
    <ul class="news-ticker">
        <?php  while ($featured_posts->have_posts()): $featured_posts->the_post();?>
        <li><span style="color:<?php echo $news_post_tme_color;?>; background:<?php echo $news_post_tme_bgcolor;?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')). ' ago';?></span><a style="color:<?php echo $news_post_tle_color;?>"  target=_blank href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>  
        <?php endwhile; ?>  
    </ul>
<?php } wp_reset_postdata(); ?>
</marquee>
</div>
  </div>
</div>
<?php
        echo $after_widget;

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance["fcount"] = absint($new_instance["fcount"]);
        $instance["fcate"] = absint($new_instance["fcate"]);
        $instance["news_bg_color"] = $new_instance["news_bg_color"];
        $instance["news_tle_color"] = $new_instance["news_tle_color"];
        $instance["news_post_tle_color"] = $new_instance["news_post_tle_color"];
        $instance["news_post_tme_color"] = $new_instance["news_post_tme_color"];
        $instance["news_post_tme_bgcolor"] = $new_instance["news_post_tme_bgcolor"];
        return $instance;
    }

    function form($instance) {
      $title = isset($instance['title']) ? esc_attr($instance['title']) : __('Breaking News','themehunk-customizer');  
      $fcate = isset($instance['fcate']) ? absint($instance['fcate']) : 0;
      $fcount = isset($instance['fcount']) ? absint($instance['fcount']) : 4;
      $news_bg_color = isset($instance['news_bg_color']) ? $instance['news_bg_color'] :"#0e0e0e";
      $news_tle_color = isset($instance['news_tle_color']) ? $instance['news_tle_color'] :"#fff";
      $news_post_tle_color = isset($instance['news_post_tle_color']) ? $instance['news_post_tle_color'] :"#66cda9";
      $news_post_tme_color = isset($instance['news_post_tme_color']) ? $instance['news_post_tme_color'] :"#bbb";
      $news_post_tme_bgcolor = isset($instance['news_post_tme_bgcolor']) ? $instance['news_post_tme_bgcolor'] :"#403f3f";


$termarr = array('child_of'   => 0);
$terms = get_terms('category' ,$termarr);
$foption = '<option value="0">Recent Post Show</option>';
foreach($terms as $cat) {
    $term_id = $cat->term_id;
    $selected1 = ($fcate==$term_id)?'selected':'';
$foption .= '<option value="'.$term_id.'" '.$selected1.'>'.$cat->name.'</option>';
}
    ?>
<div class="clearfix"></div>
   <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','themehunk-customizer'); ?></label>
    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"  class="widefat" value="<?php echo $title; ?>" >
    </p>
    <p><label for="<?php echo $this->get_field_id('fcount'); ?>"><?php _e('Number of Post Show','elanzalite'); ?></label>
            <input id="<?php echo $this->get_field_id('fcount'); ?>" name="<?php echo $this->get_field_name('fcount'); ?>" type="text" value="<?php echo $fcount; ?>" size="3" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('fcate'); ?>"><?php _e('Choose Category Show Post','themehunk-customizer'); ?></label>
        <select name="<?php echo $this->get_field_name('fcate'); ?>" ><?php echo $foption; ?></select>
    </p>
   <p><label for="<?php echo $this->get_field_id( 'news_bg_color' ); ?>" style="display:block;"><?php _e( 'Background Color:','themehunk-customizer' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'news_bg_color' ); ?>" name="<?php echo $this->get_field_name( 'news_bg_color' ); ?>" type="text" value="<?php echo esc_attr( $news_bg_color ); ?>" />
    </p>

    <p><label for="<?php echo $this->get_field_id( 'news_tle_color' ); ?>" style="display:block;"><?php _e( 'Tilte Color:','themehunk-customizer' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'news_tle_color' ); ?>" name="<?php echo $this->get_field_name( 'news_tle_color' ); ?>" type="text" value="<?php echo esc_attr( $news_tle_color ); ?>" />
    </p>
    <p><label for="<?php echo $this->get_field_id( 'news_post_tle_color' ); ?>" style="display:block;"><?php _e( 'Post Tilte Color:','themehunk-customizer' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'news_post_tle_color' ); ?>" name="<?php echo $this->get_field_name( 'news_post_tle_color' ); ?>" type="text" value="<?php echo esc_attr($news_post_tle_color); ?>" />
    </p>
    <p><label for="<?php echo $this->get_field_id( 'news_post_tme_bgcolor' ); ?>" style="display:block;"><?php _e( 'Post Time Background Color:','themehunk-customizer' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'news_post_tme_bgcolor' ); ?>" name="<?php echo $this->get_field_name( 'news_post_tme_bgcolor' ); ?>" type="text" value="<?php echo esc_attr($news_post_tme_bgcolor); ?>" />
    </p>
    <p><label for="<?php echo $this->get_field_id( 'news_post_tme_color' ); ?>" style="display:block;"><?php _e( 'Post Time Color:','themehunk-customizer' ); ?></label> 
    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'news_post_tme_color' ); ?>" name="<?php echo $this->get_field_name( 'news_post_tme_color' ); ?>" type="text" value="<?php echo esc_attr($news_post_tme_color); ?>" />
    </p>

        <?php
    }
}
?>