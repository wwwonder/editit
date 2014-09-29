<?php
/**
 *
 * Register Member post type
 *
 * @file           cpt-member.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/cpt-member.php
 */
?>
<?php

// Adds Custom Post Type
add_action('init', 'member_register'); 

// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-member_columns', 'member_edit_columns' );
add_action( 'manage_posts_custom_column', 'member_column_display', 10, 2 );

// Allows filtering of posts by taxonomy in the admin view
add_action( 'restrict_manage_posts', 'member_add_taxonomy_categories' ); 

// Add Icons
add_action( 'admin_head', 'member_icon' );


function member_register() {  

  global $smof_data;

  if(isset($smof_data['text_memberslug'])){
    $content_slug = $smof_data['text_memberslug'] . '-item';
    $category_slug = $smof_data['text_memberslug'] . '-category';
  }else{
    $content_slug = 'member-item';
    $category_slug = 'member-category';
  }


  // Adds new post type for Member
  $labels = array(
    'name'                => __('Member'                     , 'editit'),
    'singular_name'       => __('Member'                     , 'editit'),
    'add_new'             => __('Add Member'                 , 'editit'),
    'all_items'           => __('All Member'                 , 'editit'),
    'add_new_item'        => __('Add Member'                 , 'editit'),
    'edit_item'           => __('Edit Member'                , 'editit'),
    'new_item'            => __('New Member'                 , 'editit'),
    'view_item'           => __('View Member'                , 'editit'),
    'search_items'        => __('Search Member'              , 'editit'),
    'not_found'           => __('No member found'            , 'editit'),
    'not_found_in_trash'  => __('No member found in trash'   , 'editit'), 
    'parent_item_colon'   => ''
  );

  $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true, 
    'query_var'             => true,
    'rewrite'               => array('slug' => $content_slug), // Permalinks format
    'capability_type'       => 'post',
    'hierarchical'          => false,
    'menu_position'         => 34,
    'supports'              => array('title','editor','thumbnail','excerpt','comments','page-attributes'),
    'has_archive'           => false,
    'menu_icon'             => '',
  );

  register_post_type('member',$args);


  //labels for member Category custom post type:
  $member_category_labels = array(
    'name'                  => __( 'Member Category'              , 'editit' ),
    'singular_name'         => __( 'Member Category'              , 'editit' ),
    'search_items'          => __( 'Search in member categories'  , 'editit'),
    'all_items'             => __( 'All member categories'        , 'editit'),
    'most_used_items'       => null,
    'parent_item'           => null,
    'parent_item_colon'     => null,
    'edit_item'             => __( 'Edit member category'         , 'editit'), 
    'update_item'           => __( 'Update member category'       , 'editit'),
    'add_new_item'          => __( 'Add new "Member Category"'    , 'editit'),
    'new_item_name'         => __( 'New member category'          , 'editit'),
    'menu_name'             => __( 'Categories'                   , 'editit'),
  );
  
  register_taxonomy('member_category', array('member'), array(
    'hierarchical'          => true,
    'labels'                => $member_category_labels,
    'singular_name'         => 'member Category',
    'show_ui'               => true,
    'query_var'             => true,
    'rewrite'               => array('slug' => $category_slug )
  ));

}



/**
 * Add Columns to Member Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function member_edit_columns( $member_columns ) {
  $member_columns = array(
    "cb"                    => "<input type=\"checkbox\" />",
    "title"                 => __('Title'          , 'editit'),
    "member_thumbnail"      => __('Featured Image' , 'editit'),
    "member_category"       => __('Category'       , 'editit'),
    "author"                => __('Author'         , 'editit'),
    "comments"              => __('Comments'       , 'editit'),
    "date"                  => __('Date'           , 'editit'),
  );
  $member_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
  return $member_columns;
}

function member_column_display( $member_columns, $post_id ) {

  // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

  switch ( $member_columns ) {

    // Display the thumbnail in the column view
    case "member_thumbnail":
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

    // Display the member tags in the column view
    case "member_category":

      if ( $category_list = get_the_term_list( $post_id, 'member_category', '', ', ', '' ) ) {
        echo $category_list;
      } else {
        echo __('None', 'editit');
      }
      break;
  }
}



/**
 * Adds taxonomy filters to the member admin page
 * Code artfully lifed from http://pippinsplugins.com
 */
 
function member_add_taxonomy_categories() {
  global $typenow;

  // An array of all the taxonomyies you want to display. Use the taxonomy name or slug
  $taxonomies = array( 'member_category' );

  // must set this to the post type you want the filter(s) displayed on
  if ( $typenow == 'member' ) {

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
function member_icon() { ?>
      <style type="text/css" media="screen">
        #adminmenu .menu-icon-member div.wp-menu-image:before {
          content: "\f307";
        }
      </style>
  <?php } 

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>