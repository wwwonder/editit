<?php
/**
 * Widget : Embed
 *
 *
 * @file           embed.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/widgets/embed.php
 */
?>
<?php

class Widget_Embed extends WP_Widget {

  /* -- Register widget with WordPress. -- */
  function __construct() {
    parent::__construct(
      'embed', // Base ID
      __('8.[editit] Embed', 'editit'), // Name
      array( 'description' => __( 'Display Embed Video', 'editit' ), ) // Args
    );
  }


  /* -- Widget Output -- */
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $embed = $instance['embed'];
    $description = $instance['description'];

    echo $before_widget;

    if (!empty($title)) { echo $before_title . $title . $after_title; }

    echo '<div class="embed-video">' . $embed . '</div>';
    if (!empty($description)) { echo '<p>' . $description . '</p>'; }

    echo $after_widget;

  }


  /* -- Widget Update -- */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['embed'] = $new_instance['embed'];
    $instance['description'] = $new_instance['description'];
    return $instance;
  }


  /* -- Widget Backend Form -- */
  function form($instance) {
    
    $defaults = array(
                  'title'       => '',
                  'embed'       => '',
                  'description' => ''
                );
    $instance = wp_parse_args((array) $instance, $defaults); ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('embed'); ?>"><?php _e('Embed Code', 'editit'); ?>:</label>
      <textarea class="widefat" id="<?php echo $this->get_field_id('embed'); ?>" name="<?php echo $this->get_field_name('embed'); ?>"><?php echo $instance['embed']; ?></textarea>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'editit'); ?>:</label>
      <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $instance['description']; ?></textarea>
    </p>

  <?php
  }

}


/* -- register Widget_Embed widget -- */
function register_widget_embed() {
  register_widget( 'Widget_Embed' );
}
add_action( 'widgets_init', 'register_widget_embed' );

?>