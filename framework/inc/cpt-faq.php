<?php
/**
 *
 * Register FAQ post type
 *
 * @file           cpt-faq.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/cpt-faq.php
 */
?>
<?php

// Adds Custom Post Type
add_action('init', 'faq_register'); 

// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-faq_columns', 'faq_edit_columns' );
add_action( 'manage_posts_custom_column', 'faq_column_display', 10, 2 );

// Allows filtering of posts by taxonomy in the admin view
add_action( 'restrict_manage_posts', 'faq_add_taxonomy_categories' ); 

// Add Icons
add_action( 'admin_head', 'faq_icon' );


function faq_register() {  

  global $smof_data;

  if(isset($smof_data['text_faqslug'])){
    $content_slug = $smof_data['text_faqslug'];
    $category_slug = $content_slug . '-category';
  }else{
    $content_slug = 'faq';
    $category_slug = 'faq-category';
  }


  // Adds new post type for FAQ
  $labels = array(
    'name'                => __('FAQ'                     , 'editit'),
    'singular_name'       => __('FAQ'                     , 'editit'),
    'add_new'             => __('Add FAQ'                 , 'editit'),
    'all_items'           => __('All FAQ'                 , 'editit'),
    'add_new_item'        => __('Add FAQ'                 , 'editit'),
    'edit_item'           => __('Edit FAQ'                , 'editit'),
    'new_item'            => __('New FAQ'                 , 'editit'),
    'view_item'           => __('View FAQ'                , 'editit'),
    'search_items'        => __('Search FAQ'              , 'editit'),
    'not_found'           => __('No faq found'            , 'editit'),
    'not_found_in_trash'  => __('No faq found in trash'   , 'editit'), 
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
    'exclude_from_search'   => true
  );

  register_post_type('faq',$args);


  //labels for faq Category custom post type:
  $faq_category_labels = array(
    'name'                  => __( 'FAQ Category'              , 'editit' ),
    'singular_name'         => __( 'FAQ Category'              , 'editit' ),
    'search_items'          => __( 'Search in faq categories'  , 'editit'),
    'all_items'             => __( 'All faq categories'        , 'editit'),
    'most_used_items'       => null,
    'parent_item'           => null,
    'parent_item_colon'     => null,
    'edit_item'             => __( 'Edit faq category'         , 'editit'), 
    'update_item'           => __( 'Update faq category'       , 'editit'),
    'add_new_item'          => __( 'Add new "FAQ Category"'    , 'editit'),
    'new_item_name'         => __( 'New faq category'          , 'editit'),
    'menu_name'             => __( 'Categories'                , 'editit'),
  );
  
  register_taxonomy('faq_category', array('faq'), array(
    'hierarchical'          => true,
    'labels'                => $faq_category_labels,
    'singular_name'         => 'faq Category',
    'show_ui'               => true,
    'query_var'             => true,
    'rewrite'               => array('slug' => $category_slug )
  ));

}



/**
 * Add Columns to FAQ Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function faq_edit_columns( $faq_columns ) {
  $faq_columns = array(
    "cb"                    => "<input type=\"checkbox\" />",
    "title"                 => __('Title'     , 'editit'),
    "faq_category"          => __('Category'  , 'editit'),
    "author"                => __('Author'    , 'editit'),
    "comments"              => __('Comments'  , 'editit'),
    "date"                  => __('Date'      , 'editit'),
  );
  $faq_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
  return $faq_columns;
}

function faq_column_display( $faq_columns, $post_id ) {

  // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

  switch ( $faq_columns ) {

    // Display the faq tags in the column view
    case "faq_category":

    if ( $category_list = get_the_term_list( $post_id, 'faq_category', '', ', ', '' ) ) {
      echo $category_list;
    } else {
      echo __('None', 'editit');
    }
    break;
  }
}



/**
 * Adds taxonomy filters to the faq admin page
 * Code artfully lifed from http://pippinsplugins.com
 */
 
function faq_add_taxonomy_categories() {
  global $typenow;

  // An array of all the taxonomyies you want to display. Use the taxonomy name or slug
  $taxonomies = array( 'faq_category' );

  // must set this to the post type you want the filter(s) displayed on
  if ( $typenow == 'faq' ) {

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
function faq_icon() { ?>
      <style type="text/css" media="screen">
        #adminmenu .menu-icon-faq div.wp-menu-image:before {
          content: "\f125";
        }
      </style>
  <?php } 

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>