<?php
/**
 * Widget : Side Nav
 *
 *
 * @file           side-nav.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/widgets/side-nav.php
 */
?>
<?php

class Widget_Side_Nav extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'side_nav', // Base ID
      __('5.[editit] Side Nav', 'editit'), // Name
      array( 'description' => __( 'Display a Side Navigation ', 'editit' ), ) // Args
    );
  }


  // Widget Output
  function widget($args, $instance) {
    extract($args);

    // Get menu
    $nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );
    if ( !$nav_menu ){return;}
    echo $before_widget;
    wp_nav_menu( array( 'depth' => 1, 'menu' => $nav_menu, 'link_after' => '<span class="icon pull-right icon-chevron-right"></span>' ) );
    echo $after_widget;

  }


  // Update
  function update( $new_instance, $old_instance ) {  
    $instance['nav_menu'] = (int) $new_instance['nav_menu'];
    return $instance;
  }


  // Backend Form
  function form( $instance ) {
    $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

    // Get menus
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

    // If no menus exists, direct the user to go and create some.
    if ( !$menus ) {
      echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'editit'), admin_url('nav-menus.php') ) .'</p>';
      return;
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu', 'editit'); ?>:</label>
      <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
    <?php
      foreach ( $menus as $menu ) {
        $selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
        echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
      }
    ?>
      </select>
    </p>
    <?php
  }

}


// register Widget_Side_Nav widget
function register_widget_side_nav() {
    register_widget( 'Widget_Side_Nav' );
}
add_action( 'widgets_init', 'register_widget_side_nav' );

?>