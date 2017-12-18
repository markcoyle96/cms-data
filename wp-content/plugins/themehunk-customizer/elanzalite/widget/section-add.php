<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 *  Add Widget
  */
class themehunk_customizer_section_add extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'themehunk-customizer-section-add',
            'description' => 'Show your Ad');
        parent::__construct('themehunk-customizer-section-add', __('THunk : Adsense Widget','themehunk_customizer'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        // widget content
        echo $before_widget;
        $add_code = isset($instance['add_code'])?$instance['add_code']:__('Add Ad code Here','themehunk_customizer');
?>
<section id="section_adver">
        <div class="inner_wrap">
            <div class="adver_wrap" style="text-align: center;">
                <?php echo $add_code;?>
            </div>    
        </div>
    </section>
<?php
        echo $after_widget;

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['add_code'] = $new_instance['add_code'];
        return $instance;
    }

    function form($instance) {
        $add_code = isset($instance['add_code']) ? $instance['add_code'] : __('Add Ad code Here','themehunk-customizer');
    ?>

<div class="clearfix"></div>
    <p>
    <label for="<?php echo $this->get_field_id('add_code'); ?>"><?php _e('Ad','themehunk-customizer'); ?></label>
    <label style="padding-top:0px;font-size: 12px;font-style: italic;"><?php _e('Generate <a target="_blank" href="https://www.google.com/adsense/start/">Google Adsense</a> code and paste it below.','themehunk-customizer'); ?></label>
     <textarea  rows="8" name="<?php echo $this->get_field_name('add_code'); ?>" id="<?php echo $this->get_field_id('add_code'); ?>"  class="widefat" ><?php echo $add_code; ?></textarea>

    </p>
        <?php
    }
}
?>