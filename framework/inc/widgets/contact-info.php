<?php
/**
 * Widget : Contact Information
 *
 *
 * @file           contact-info.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/widgets/contact-info.php
 */
?>
<?php

class Widget_Contact_Info extends WP_Widget {

  /* -- Register widget with WordPress. -- */
  function __construct() {
    parent::__construct(
      'contact_info', // Base ID
      __('6.[editit] Contact Info', 'editit'), // Name
      array( 'description' => __( 'Display Contact Info', 'editit' ), ) // Args
    );
  }


  /* -- Widget Output -- */
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);

    echo $before_widget;
    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
    ?>

    <address>
      <ul>

      <?php if($instance['address']): ?>
        <li class="address"><?php echo $instance['address']; ?></li>
      <?php endif; ?>
      <?php if($instance['tel']): ?>
        <li class="tel"><strong><?php _e( 'Tel', 'editit' ) ?>:</strong> <?php echo $instance['tel']; ?></li>
      <?php endif; ?>
      <?php if($instance['fax']): ?>
        <li class="fax"><strong><?php _e( 'Fax', 'editit' ) ?>:</strong> <?php echo $instance['fax']; ?></li>
      <?php endif; ?>
      <?php if($instance['email']): ?>
        <li class="email"><strong><?php _e( 'Email', 'editit' ) ?>:</strong> <a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a></li>
      <?php endif; ?>
      <?php if($instance['web']): ?>
        <li class="web"><strong><?php _e( 'Website', 'editit' ) ?>:</strong> <a href="<?php echo $instance['web']; ?>"><?php echo $instance['web']; ?></a></li>
      <?php endif; ?>
      <?php if($instance['map']): ?>
        <li class="map"><strong><?php _e( 'Map', 'editit' ) ?>:</strong> <?php echo $instance['map']; ?></li>
      <?php endif; ?>

      </ul>
    </address>

    <?php
    echo $after_widget;

  }


  /* -- Widget Update -- */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['address'] = $new_instance['address'];
    $instance['tel'] = $new_instance['tel'];
    $instance['fax'] = $new_instance['fax'];
    $instance['email'] = $new_instance['email'];
    $instance['web'] = $new_instance['web'];
    $instance['map'] = $new_instance['map'];
    return $instance;
  }


  /* -- Widget Backend Form -- */
  function form($instance) {
    
    $defaults = array(
                  'title'   => __('Contact Info', 'editit'),
                  'address' => '',
                  'tel'     => '',
                  'fax'     => '',
                  'email'   => '',
                  'web'     => '',
                  'map'     => ''
                );
    $instance = wp_parse_args((array) $instance, $defaults);

  ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('tel'); ?>"><?php _e('Tel', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('tel'); ?>" name="<?php echo $this->get_field_name('tel'); ?>" value="<?php echo $instance['tel']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $instance['fax']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('web'); ?>"><?php _e('Website', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('web'); ?>" name="<?php echo $this->get_field_name('web'); ?>" value="<?php echo $instance['web']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('map'); ?>"><?php _e('Map', 'editit'); ?>:</label>
      <textarea class="widefat" id="<?php echo $this->get_field_id('map'); ?>" name="<?php echo $this->get_field_name('map'); ?>"><?php echo $instance['map']; ?></textarea>
    </p>

  <?php
  }

}


/* -- register Widget_Contact_Info widget -- */
function register_widget_contact_info() {
  register_widget( 'Widget_Contact_Info' );
}
add_action( 'widgets_init', 'register_widget_contact_info' );

?>