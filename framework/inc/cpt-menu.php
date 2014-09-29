<?php
/**
 *
 * Register Menu post type
 *
 * @file           cpt-menu.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/cpt-menu.php
 */
?>
<?php

// Adds Custom Post Type
add_action('init', 'menu_register'); 

// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-menu_columns', 'menu_edit_columns' );
add_action( 'manage_posts_custom_column', 'menu_column_display', 10, 2 );

// Allows filtering of posts by taxonomy in the admin view
add_action( 'restrict_manage_posts', 'menu_add_taxonomy_categories' ); 

// Add Icons
add_action( 'admin_head', 'menu_icon' );


function menu_register() {  

  global $smof_data;

  if(isset($smof_data['text_menuslug'])){
    $content_slug = $smof_data['text_menuslug'] . '-item';
    $category_slug = $smof_data['text_menuslug'] . '-category';
  }else{
    $content_slug = 'menu-item';
    $category_slug = 'menu-category';
  }


  // Adds new post type for Menu
  $labels = array(
    'name'                => __('Menu'                    , 'editit'),
    'singular_name'       => __('Menu'                    , 'editit'),
    'add_new'             => __('Add Menu'                , 'editit'),
    'all_items'           => __('All Menu'                , 'editit'),
    'add_new_item'        => __('Add Menu'                , 'editit'),
    'edit_item'           => __('Edit Menu'               , 'editit'),
    'new_item'            => __('New Menu'                , 'editit'),
    'view_item'           => __('View Menu'               , 'editit'),
    'search_items'        => __('Search Menu'             , 'editit'),
    'not_found'           => __('No menu found'           , 'editit'),
    'not_found_in_trash'  => __('No menu found in trash'  , 'editit'), 
    'parent_item_colon'   => ''
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true, 
    'query_var'           => true,
    'rewrite'             => array('slug' => $content_slug), // Permalinks format
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'menu_position'       => 32,
    'supports'            => array('title','editor','thumbnail','excerpt','comments','page-attributes'),
    'has_archive'         => false,
    'menu_icon'           => '',
  );

  register_post_type('menu',$args);


  //labels for menu Category custom post type:
  $menu_category_labels = array(
    'name'                => __( 'Menu Category'              , 'editit' ),
    'singular_name'       => __( 'Menu Category'              , 'editit' ),
    'search_items'        => __( 'Search in menu categories'  , 'editit'),
    'all_items'           => __( 'All menu categories'        , 'editit'),
    'most_used_items'     => null,
    'parent_item'         => null,
    'parent_item_colon'   => null,
    'edit_item'           => __( 'Edit menu category'         , 'editit'), 
    'update_item'         => __( 'Update menu category'       , 'editit'),
    'add_new_item'        => __( 'Add new "Menu Category"'    , 'editit'),
    'new_item_name'       => __( 'New menu category'          , 'editit'),
    'menu_name'           => __( 'Categories'                 , 'editit'),
  );
  
  register_taxonomy('menu_category', array('menu'), array(
    'hierarchical'        => true,
    'labels'              => $menu_category_labels,
    'singular_name'       => 'menu Category',
    'show_ui'             => true,
    'query_var'           => true,
    'rewrite'             => array('slug' => $category_slug )
  ));

}



/**
 * Add Columns to Menu Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function menu_edit_columns( $menu_columns ) {
  $menu_columns = array(
    "cb"                  => "<input type=\"checkbox\" />",
    "title"               => __('Title'          , 'editit'),
    "menu_thumbnail"      => __('Featured Image' , 'editit'),
    "menu_category"       => __('Category'       , 'editit'),
    "author"              => __('Author'         , 'editit'),
    "comments"            => __('Comments'       , 'editit'),
    "date"                => __('Date'           , 'editit'),
  );
  $menu_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
  return $menu_columns;
}

function menu_column_display( $menu_columns, $post_id ) {

  // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

  switch ( $menu_columns ) {

    // Display the thumbnail in the column view
    case "menu_thumbnail":
      $width = (int) 35;
      $height = (int) 35;
      $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

      // Display the featured image in the column view if possible
      if ( $thumbnail_id ) {
        $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
      }
      if ( isset( $thumb ) ) {
        echo $thumb;
      } else {
        echo __('None', 'editit');
      }
      break;

    // Display the menu tags in the column view
    case "menu_category":

      if ( $category_list = get_the_term_list( $post_id, 'menu_category', '', ', ', '' ) ) {
        echo $category_list;
      } else {
        echo __('None', 'editit');
      }
      break;
  }
}



/**
 * Adds taxonomy filters to the menu admin page
 * Code artfully lifed from http://pippinsplugins.com
 */
 
function menu_add_taxonomy_categories() {
  global $typenow;

  // An array of all the taxonomyies you want to display. Use the taxonomy name or slug
  $taxonomies = array( 'menu_category' );

  // must set this to the post type you want the filter(s) displayed on
  if ( $typenow == 'menu' ) {

    foreach ( $taxonomies as $tax_slug ) {
      $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
      $tax_obj = get_taxonomy( $tax_slug );
      $tax_name = $tax_obj->labels->name;
      $terms = get_terms($tax_slug);
      if ( count( $terms ) > 0) {
        echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
        echo "<option value=''>$tax_name</option>";
        foreach ( $terms as $term ) {
          echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
        }
        echo "</select>";
      }
    }
  }
}



/**
 * Displays the custom post type icon in the dashboard
 */
function menu_icon() { ?>
      <style type="text/css" media="screen">
        #adminmenu .menu-icon-menu div.wp-menu-image:before {
          content: "\f330";
        }
      </style>
  <?php } 

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>