<?php
/*
Template Name: Blog
*/

/**
 * Blog Page Template
 *
 *
 * @file           page-blog.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page-blog.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

<?php
  $select_sidebar = rwmb_meta('editit_selectsidebar');
  $blog_type = rwmb_meta('editit_selectblogpagetype');
?>

  <div id="content" class="content <?php echo $select_sidebar; if($select_sidebar != 'no-sidebar'){ echo ' twelve'; }else{ echo ' sixteen'; } ?> columns blog blog-<?php echo $blog_type; ?>">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (get_the_content() != '') : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry">
        <?php the_content(); ?>
        <div class="clear"></div>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
      </div>
    </article>

    


    <?php endif; ?>
  <?php endwhile; endif; ?>

<?php
    $blogitems = rwmb_meta('editit_selectblogitemsonpage');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
      'post_type'       => 'post',
      'posts_per_page'  => $blogitems,
      'post_status'     => 'publish',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'paged'           => $paged
    );

    $bu_query = $wp_query;
    $wp_query = null; 
    $wp_query = new WP_Query($args);

    $custom_excerpt_length = rwmb_meta('editit_textblogmaxlengthofexcerpt') != '' ? rwmb_meta('editit_textblogmaxlengthofexcerpt') : 120;
    $readmore = true;

    while ( $wp_query->have_posts() ) : $wp_query->the_post();
?>

      <?php get_template_part( 'framework/inc/post-format/content', get_post_format() ); ?>

    <?php endwhile; ?>
    <?php get_template_part( 'framework/inc/nav' ); ?>

  </div>
  <!-- end of .content -->

<?php if($select_sidebar != 'no-sidebar') : ?>
  <?php get_sidebar(); ?>
<?php endif; ?>

</div> <!-- end page-wrap -->

<?php get_footer(); ?>