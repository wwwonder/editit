<?php
/**
 *
 * @file           cpt-general.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/cpt-general.php
 */
?>
<?php

function editit_editpage_custom_title( $title ){

  $screen = get_current_screen();

  switch ($screen->post_type) {
    case 'menu':
      $title = __('Enter Menu Name Here'   , 'editit');
      break;
    case 'event':
      $title = __('Enter Event Name Here'  , 'editit');
      break;
    case 'faq':
      $title = __('Enter Question Here'    , 'editit');
      break;
    case 'member':
      $title = __('Enter Member Name Here' , 'editit');
      break;
  }

  return $title;

}
add_filter( 'enter_title_here', 'editit_editpage_custom_title' );

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>