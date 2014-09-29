<?php
/**
 * Sidebar Template
 *
 *
 * @file           sidebar.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/sidebar.php
 */
?>
<div id="sidebar" class="sidebar four columns">

<?php
  global $bu_query;
  if($bu_query){
    $wp_query = $bu_query;
  }

  if(is_page()){
      generated_dynamic_sidebar();
  }else{
    if(is_search() || is_singular('post')){
      dynamic_sidebar('Blog Widgets');
    }elseif(is_singular('news')){
      dynamic_sidebar('News Widgets');
    }elseif(is_archive()){
      if(get_post_type() == 'post'){
        dynamic_sidebar('Blog Widgets');
      }elseif(get_post_type() == 'news'){
        dynamic_sidebar('News Widgets');
      }
    }elseif(is_home()){
      dynamic_sidebar('Blog Widgets');
    }else{
      generated_dynamic_sidebar();
    }
  }

?>

</div> <!-- end of .sidebar -->