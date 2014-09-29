<?php
/**
 *
 * Register News post type
 *
 * @file           cpt-news.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/cpt-news.php
 */
?>
<?php

// Adds Custom Post Type
add_action('init', 'news_register'); 

// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-news_columns', 'news_edit_columns' );
add_action( 'manage_posts_custom_column', 'news_column_display', 10, 2 );

// Allows filtering of posts by taxonomy in the admin view
add_action( 'restrict_manage_posts', 'news_add_taxonomy_categories' ); 

// Add Icons
add_action( 'admin_head', 'news_icon' );


function news_register() {  

  global $smof_data;

  if(isset($smof_data['text_newsslug'])){
    $content_slug = $smof_data['text_newsslug'] . '-item';
    $category_slug = $smof_data['text_newsslug'] . '-category';
    $tag_slug = $smof_data['text_newsslug'] . '-tag';
  }else{
    $content_slug = 'news-item';
    $category_slug = 'news-category';
    $tag_slug = 'news-tag';
  }

  // Adds new post type for News
  $labels = array(
    'name'                => __('News'                   , 'editit'),
    'singular_name'       => __('News'                   , 'editit'),
    'add_new'             => __('Add News'               , 'editit'),
    'all_items'           => __('All News'               , 'editit'),
    'add_new_item'        => __('Add News'               , 'editit'),
    'edit_item'           => __('Edit News'              , 'editit'),
    'new_item'            => __('New News'               , 'editit'),
    'view_item'           => __('View News'              , 'editit'),
    'search_items'        => __('Search News'            , 'editit'),
    'not_found'           => __('No news found'          , 'editit'),
    'not_found_in_trash'  => __('No news found in trash' , 'editit'), 
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
    'menu_position'       => 30,
    'supports'            => array('title','editor','thumbnail','excerpt','comments','page-attributes'),
    'has_archive'         => false,
    'menu_icon'           => '',
  );

  register_post_type('news',$args);


  //labels for news Category custom post type:
  $news_category_labels = array(
    'name'                => __( 'News Category'              , 'editit' ),
    'singular_name'       => __( 'News Category'              , 'editit' ),
    'search_items'        => __( 'Search in news categories'  , 'editit'),
    'all_items'           => __( 'All news categories'        , 'editit'),
    'most_used_items'     => null,
    'parent_item'         => null,
    'parent_item_colon'   => null,
    'edit_item'           => __( 'Edit news category'         , 'editit'), 
    'update_item'         => __( 'Update news category'       , 'editit'),
    'add_new_item'        => __( 'Add new "News Category"'    , 'editit'),
    'new_item_name'       => __( 'New news category'          , 'editit'),
    'menu_name'           => __( 'Categories'                 , 'editit'),
  );
  
  register_taxonomy('news_category', array('news'), array(
    'hierarchical'        => true,
    'labels'              => $news_category_labels,
    'singular_name'       => 'news Category',
    'show_ui'             => true,
    'query_var'           => true,
    'rewrite'             => array('slug' => $category_slug )
  ));


  //labels for news Tag custom post type
  $news_tag_labels = array(
    'name'                => __( 'News Tags'              , 'editit' ),
    'singular_name'       => __( 'News Tags'              , 'editit' ),
    'search_items'        => __( 'Search in "News Tags"'  , 'editit' ),
    'popular_items'       => __( 'Popular "News Tags"'    , 'editit' ),
    'all_items'           => __( 'All News Tags'          , 'editit' ),
    'most_used_items'     => null,
    'parent_item'         => null,
    'parent_item_colon'   => null,
    'edit_item'           => __( 'Edit "News tag"'        , 'editit' ), 
    'update_item'         => __( 'Update "News tag"'      , 'editit' ),
    'add_new_item'        => __( 'Add new "News tag"'     , 'editit' ),
    'new_item_name'       => __( 'New "News tag"'         , 'editit' ),
    'separate_items_with_commas'     => __( 'Separate "News Tags" with commas'       , 'editit' ),
    'add_or_remove_items'            => __( 'Add or remove "News tag"'               , 'editit' ),
    'choose_from_most_used'          => __( 'Choose from the most used "News tags"'  , 'editit' ),
    'menu_name'           => __( 'Tags'                   , 'editit' ),
  );

  register_taxonomy('news_tag',array('news'),array(
    'hierarchical'           => false,
    'labels'                 => $news_tag_labels,
    'show_ui'                => true,
    'update_count_callback'  => '_update_post_term_count',
    'query_var'              => true,
    'rewrite'                => array('slug' => $tag_slug )
  ));

}



/**
 * Add Columns to News Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function news_edit_columns( $news_columns ) {
  $news_columns = array(
    "cb"             => "<input type=\"checkbox\" />",
    "title"          => __('Title'          , 'editit'),
    "news_thumbnail" => __('Featured Image' , 'editit'),
    "news_category"  => __('Category'       , 'editit'),
    "author"         => __('Author'         , 'editit'),
    "comments"       => __('Comments'       , 'editit'),
    "date"           => __('Date'           , 'editit'),
  );
  $news_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
  return $news_columns;
}

function news_column_display( $news_columns, $post_id ) {

  // Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
  
  switch ( $news_columns ) {

    // Display the thumbnail in the column view
    case "news_thumbnail":
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

    // Display the news tags in the column view
    case "news_category":

      if ( $category_list = get_the_term_list( $post_id, 'news_category', '', ', ', '' ) ) {
        echo $category_list;
      } else {
        echo __('None', 'editit');
      }
      break;

  }
}



/**
 * Adds taxonomy filters to the news admin page
 * Code artfully lifed from http://pippinsplugins.com
 */
 
function news_add_taxonomy_categories() {
  global $typenow;

  // An array of all the taxonomyies you want to display. Use the taxonomy name or slug
  $taxonomies = array( 'news_category' );

  // must set this to the post type you want the filter(s) displayed on
  if ( $typenow == 'news' ) {

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
function news_icon() { ?>
      <style type="text/css" media="screen">
        #adminmenu .menu-icon-news div.wp-menu-image:before {
          content: "\f464";
        }
      </style>
  <?php }

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>