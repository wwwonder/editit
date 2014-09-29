<?php
/**
 * Script & Style Sheet enqueue
 *
 *
 * @file           enqueue.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/enqueue.php
 */


function editit_scripts_basic() {  
  
  /* ------------------------------------------------------------------------ */
  /* Register Scripts */
  /* ------------------------------------------------------------------------ */
  wp_register_script('functions', get_template_directory_uri() . '/framework/js/functions.js', 'jquery', '1.0.0', TRUE);
  wp_register_script('superfish', get_template_directory_uri() . '/framework/js/superfish.js', 'jquery', '1.7.4', TRUE);
  wp_register_script('mobilemenu', get_template_directory_uri() . '/framework/js/mobilemenu.js', 'jquery', '1.1', TRUE);
  wp_register_script('easing', get_template_directory_uri() . '/framework/js/easing.js', 'jquery', '1.3');
  wp_register_script('bootstrap', get_template_directory_uri() . '/framework/js/bootstrap.js', 'jquery', '3.1.1', TRUE);
  wp_register_script('prettyPhoto', get_template_directory_uri() . '/framework/js/prettyPhoto.js', 'jquery', '3.1', TRUE);
  wp_register_script('flexslider', get_template_directory_uri() . '/framework/js/flexslider.js', 'jquery', '2.0', TRUE);
  wp_register_script('waypoints', get_template_directory_uri() . '/framework/js/waypoints.js', 'jquery', '2.0.3', TRUE);
  wp_register_script('waypoints-sticky', get_template_directory_uri() . '/framework/js/waypoints-sticky.js', 'jquery', '1.6.2', TRUE);
  wp_register_script('shortcodes', get_template_directory_uri() . '/framework/js/shortcodes.js', 'jquery', '1.0.0', TRUE);
  wp_register_script('fitvids', get_template_directory_uri() . '/framework/js/fitvids.js', 'jquery', '1.1');
  wp_register_script('modernizr', get_template_directory_uri() . '/framework/js/modernizr.js', 'jquery', '2.7.1', TRUE);
  wp_register_script('calendario', get_template_directory_uri() . '/framework/js/calendario.js', 'jquery', '1.0.0', TRUE);
  wp_register_script('isotope', get_template_directory_uri() . '/framework/js/isotope.js', 'jquery', '2.0', TRUE);


  /* ------------------------------------------------------------------------ */
  /* Enqueue Scripts */
  /* ------------------------------------------------------------------------ */
  wp_enqueue_script('jquery');
  wp_enqueue_script('functions');
  wp_enqueue_script('superfish');
  wp_enqueue_script('mobilemenu');
  wp_enqueue_script('easing');
  wp_enqueue_script('bootstrap');
  wp_enqueue_script('prettyPhoto');
  wp_enqueue_script('flexslider');
  wp_enqueue_script('waypoints');
  wp_enqueue_script('waypoints-sticky');
  wp_enqueue_script('shortcodes');
  wp_enqueue_script('fitvids');
  wp_enqueue_script('modernizr');
  wp_enqueue_script('calendario');

  if( is_page_template('page-portfolio.php') || is_page_template('page-menu.php') || is_page_template('page-event.php') || is_page_template('page-member.php')  ) {
    wp_enqueue_script('isotope');
  }

}
add_action( 'wp_enqueue_scripts', 'editit_scripts_basic' );  


function editit_styles_basic() {

  global $smof_data;

  /* ------------------------------------------------------------------------ */
  /* Register Stylesheets */
  /* ------------------------------------------------------------------------ */
  wp_register_style( 'basic', get_template_directory_uri() . '/framework/css/basic.css', array(), '1.0.0', 'all' );
  wp_register_style( 'headers', get_template_directory_uri() . '/framework/css/headers.css', array(), '1.0.0', 'all' );
  wp_register_style( 'bootstrap', get_template_directory_uri() . '/framework/css/bootstrap.css', array(), '3.1.1', 'all' );
  wp_register_style( 'shortcodes', get_template_directory_uri() . '/framework/css/shortcodes.css', array(), '1.0.0', 'all' );
  wp_register_style( 'flexslider', get_template_directory_uri() . '/framework/css/flexslider.css', array(), '2.0', 'all' );
  wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/framework/css/prettyPhoto.css', array(), '3.1', 'all' );
  wp_register_style( 'icon', get_template_directory_uri() . '/framework/css/icon.css', array(), '4.1.0', 'all' );
  wp_register_style( 'skeleton', get_template_directory_uri() . '/framework/css/skeleton.css', array(), '1.2', 'all' );
  wp_register_style( 'responsive', get_template_directory_uri() . '/framework/css/responsive.css', array(), '1.0.0', 'all' );

  if($smof_data['color_theme'] && file_exists(get_template_directory() . '/framework/css/colorthemes/' . $smof_data['color_theme'] . '.css')){
    wp_register_style( 'colortheme', get_template_directory_uri() . '/framework/css/colorthemes/' . $smof_data['color_theme'] . '.css', array(), '1.0.0', 'all' );
  }else{
    wp_register_style( 'colortheme', get_template_directory_uri() . '/framework/css/colorthemes/default.css', array(), '1.0.0', 'all' );
  }


  /* ------------------------------------------------------------------------ */
  /* Enqueue Stylesheets */
  /* ------------------------------------------------------------------------ */
  wp_enqueue_style( 'basic' );                                                   // CSS Reset & Basic WordPress WYSIWYG Editor Styles
  wp_enqueue_style( 'headers' );                                                 // User select header style
  wp_enqueue_style( 'bootstrap' );                                               // Tooltips
  wp_enqueue_style( 'shortcodes' );                                              // Shortcodes
  wp_enqueue_style( 'flexslider' );                                              // Flexslider (Blog + Portfolio)
  wp_enqueue_style( 'prettyPhoto' );                                             // prettyPhoto (Blog + Portfolio + News + Menu)
  wp_enqueue_style( 'icon' );                                                    // Font Awesome
  wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' );   // Main Stylesheet
  wp_enqueue_style( 'colortheme' );                                              // Color Theme

  if($smof_data['switch_responsive']) {
    wp_enqueue_style( 'skeleton' );                                              // Skelton
    wp_enqueue_style( 'responsive' );                                            // Responsive
  }

}
add_action( 'wp_enqueue_scripts', 'editit_styles_basic', 1 ); 


function editit_styles_admin() {
  wp_register_style( 'admin', get_template_directory_uri() . '/framework/css/admin.css', array(), '1.0.0', 'all' );
  wp_enqueue_style( 'admin' );   
}
add_action('admin_enqueue_scripts', 'editit_styles_admin');

/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */
?>