<?php
/**
 *
 * Register Event post type
 *
 * @file           cpt-event.php
 * @package        editit-theme
 * @author         Masato Takahashi
 * @copyright      2013 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit-theme/framework/inc/cpt-event.php
 */
?>
<?php

// Adds Custom Post Type
add_action('init', 'event_register'); 

// Adds columns in the admin view for taxonomies
add_filter( 'manage_edit-event_columns', 'event_edit_columns' );
add_action( 'manage_posts_custom_column', 'event_column_display', 10, 2 );

// Allows filtering of posts by taxonomy in the admin view
add_action( 'restrict_manage_posts', 'event_add_taxonomy_categories' ); 

// Add Icons
add_action( 'admin_head', 'event_icon' );


function event_register() {  

  global $smof_data;

  if(isset($smof_data['text_eventslug'])){
    $content_slug = $smof_data['text_eventslug'] . '-item';
    $category_slug = $smof_data['text_eventslug'] . '-category';
  }else{
    $content_slug = 'event-item';
    $category_slug = 'event-category';
  }


  // Adds new post type for Event
  $labels = array(
    'name'                 => __('Event'                  , 'editit'),
    'singular_name'        => __('Event'                  , 'editit'),
    'add_new'              => __('Add Event'              , 'editit'),
    'all_items'            => __('All Event'              , 'editit'),
    'add_new_item'         => __('Add Event'              , 'editit'),
    'edit_item'            => __('Edit Event'             , 'editit'),
    'new_item'             => __('New Event'              , 'editit'),
    'view_item'            => __('View Event'             , 'editit'),
    'search_items'         => __('Search Event'           , 'editit'),
    'not_found'            => __('No event found'         , 'editit'),
    'not_found_in_trash'   => __('No event found in trash', 'editit'), 
    'parent_item_colon'    => ''
  );

  $args = array(
    'labels'               => $labels,
    'public'               => true,
    'publicly_queryable'   => true,
    'show_ui'              => true, 
    'query_var'            => true,
    'rewrite'              => array('slug' => $content_slug), // Permalinks format
    'capability_type'      => 'post',
    'hierarchical'         => false,
    'menu_position'        => 33,
    'supports'             => array('title','editor','thumbnail','excerpt','comments','page-attributes'),
    'has_archive'          => false,
    'menu_icon'            => '',
  );

  register_post_type('event',$args);


  //labels for event Category custom post type:
  $event_category_labels = array(
    'name'                 => __( 'Event Category'             , 'editit' ),
    'singular_name'        => __( 'Event Category'             , 'editit' ),
    'search_items'         => __( 'Search in event categories' , 'editit'),
    'all_items'            => __( 'All event categories'       , 'editit'),
    'most_used_items'      => null,
    'parent_item'          => null,
    'parent_item_colon'    => null,
    'edit_item'            => __( 'Edit event category'        , 'editit'), 
    'update_item'          => __( 'Update event category'      , 'editit'),
    'add_new_item'         => __( 'Add new "Event Category"'   , 'editit'),
    'new_item_name'        => __( 'New event category'         , 'editit'),
    'menu_name'            => __( 'Categories'                 , 'editit'),
  );
  
  register_taxonomy('event_category', array('event'), array(
    'hierarchical'         => true,
    'labels'               => $event_category_labels,
    'singular_name'        => 'event Category',
    'show_ui'              => true,
    'query_var'            => true,
    'rewrite'              => array('slug' => $category_slug )
  ));

}


/**
 * Add Columns to Event Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function event_edit_columns( $event_columns ) {
  $event_columns = array(
    "cb"              => "<input type=\"checkbox\" />",
    "title"           => __('Title'          , 'editit'),
    "event_thumbnail" => __('Featured Image' , 'editit'),
    "event_category"  => __('Category'       , 'editit'),
    "author"          => __('Author'         , 'editit'),
    "comments"        => __('Comments'       , 'editit'),
    "date"            => __('Date'           , 'editit'),
  );
  $event_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
  return $event_columns;
}

function event_column_display( $event_columns, $post_id ) {

  // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
  
  switch ( $event_columns ) {

    // Display the thumbnail in the column view
    case "event_thumbnail":
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

    // Display the event tags in the column view
    case "event_category":
    
      if ( $category_list = get_the_term_list( $post_id, 'event_category', '', ', ', '' ) ) {
        echo $category_list;
      } else {
        echo __('None', 'editit');
      }
      break;
  }
}


/**
 * Adds taxonomy filters to the event admin page
 * Code artfully lifed from http://pippinsplugins.com
 */
 
function event_add_taxonomy_categories() {
  global $typenow;
  
  // An array of all the taxonomyies you want to display. Use the taxonomy name or slug
  $taxonomies = array( 'event_category' );
 
  // must set this to the post type you want the filter(s) displayed on
  if ( $typenow == 'event' ) {
 
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
function event_icon() { ?>
      <style type="text/css" media="screen">
        #adminmenu .menu-icon-event div.wp-menu-image:before {
          content: "\f145";
        }
      </style>
  <?php } 

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>