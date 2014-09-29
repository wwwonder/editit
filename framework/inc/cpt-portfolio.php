<?php
/**
 *
 * Register Portfolio post type
 *
 * @file           cpt-portfolio.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/cpt-portfolio.php
 */
?>
<?php

// Adds Custom Post Type
add_action('init', 'portfolio_register'); 

// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-portfolio_columns', 'portfolio_edit_columns' );
add_action( 'manage_posts_custom_column', 'portfolio_column_display', 10, 2 );

// Allows filtering of posts by taxonomy in the admin view
add_action( 'restrict_manage_posts', 'portfolio_add_taxonomy_categories' ); 

// Add Icons
add_action( 'admin_head', 'portfolio_icon' );


function portfolio_register() {  

  global $smof_data;

  if(isset($smof_data['text_portfolioslug'])){
    $content_slug = $smof_data['text_portfolioslug'] . '-item';
    $category_slug = $smof_data['text_portfolioslug'] . '-category';
  }else{
    $content_slug = 'portfolio-item';
    $category_slug = 'portfolio-category';
  }


  // Adds new post type for Portfolio
  $labels = array(
    'name'                => __('Portfolio'                    , 'editit'),
    'singular_name'       => __('Portfolio'                    , 'editit'),
    'add_new'             => __('Add Portfolio'                , 'editit'),
    'all_items'           => __('All Portfolio'                , 'editit'),
    'add_new_item'        => __('Add Portfolio'                , 'editit'),
    'edit_item'           => __('Edit Portfolio'               , 'editit'),
    'new_item'            => __('New Portfolio'                , 'editit'),
    'view_item'           => __('View Portfolio'               , 'editit'),
    'search_items'        => __('Search Portfolio'             , 'editit'),
    'not_found'           => __('No portfolio found'           , 'editit'),
    'not_found_in_trash'  => __('No portfolio found in trash'  , 'editit'), 
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
    'menu_position'       => 31,
    'supports'            => array('title','editor','thumbnail','excerpt','comments','page-attributes'),
    'has_archive'         => false,
    'menu_icon'           => '',
  );

  register_post_type('portfolio',$args);


  //labels for portfolio Category custom post type:
  $portfolio_category_labels = array(
    'name'                => __( 'Portfolio Category'             , 'editit' ),
    'singular_name'       => __( 'Portfolio Category'             , 'editit' ),
    'search_items'        => __( 'Search in portfolio categories' , 'editit'),
    'all_items'           => __( 'All portfolio categories'       , 'editit'),
    'most_used_items'     => null,
    'parent_item'         => null,
    'parent_item_colon'   => null,
    'edit_item'           => __( 'Edit portfolio category'        , 'editit'), 
    'update_item'         => __( 'Update portfolio category'      , 'editit'),
    'add_new_item'        => __( 'Add new "Portfolio Category"'   , 'editit'),
    'new_item_name'       => __( 'New portfolio category'         , 'editit'),
    'menu_name'           => __( 'Categories'                     , 'editit'),
  );

  register_taxonomy('portfolio_category', array('portfolio'), array(
    'hierarchical'        => true,
    'labels'              => $portfolio_category_labels,
    'singular_name'       => 'portfolio Category',
    'show_ui'             => true,
    'query_var'           => true,
    'rewrite'             => array('slug' => $category_slug )
  ));

}



/**
 * Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function portfolio_edit_columns( $portfolio_columns ) {
  $portfolio_columns = array(
    "cb"                  => "<input type=\"checkbox\" />",
    "title"               => __('Title'          , 'editit'),
    "portfolio_thumbnail" => __('Featured Image' , 'editit'),
    "portfolio_category"  => __('Category'       , 'editit'),
    "author"              => __('Author'         , 'editit'),
    "comments"            => __('Comments'       , 'editit'),
    "date"                => __('Date'           , 'editit'),
  );
  $portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
  return $portfolio_columns;
}

function portfolio_column_display( $portfolio_columns, $post_id ) {

  // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

  switch ( $portfolio_columns ) {

    // Display the thumbnail in the column view
    case "portfolio_thumbnail":
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

    // Display the portfolio tags in the column view
    case "portfolio_category":
    
      if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
        echo $category_list;
      } else {
        echo __('None', 'editit');
      }
      break;
  }
}



/**
 * Adds taxonomy filters to the portfolio admin page
 * Code artfully lifed from http://pippinsplugins.com
 */
 
function portfolio_add_taxonomy_categories() {
  global $typenow;
  
  // An array of all the taxonomyies you want to display. Use the taxonomy name or slug
  $taxonomies = array( 'portfolio_category' );

  // must set this to the post type you want the filter(s) displayed on
  if ( $typenow == 'portfolio' ) {

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
function portfolio_icon() { ?>
      <style type="text/css" media="screen">
        #adminmenu .menu-icon-portfolio div.wp-menu-image:before {
          content: "\f161";
        }
      </style>
  <?php }

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>