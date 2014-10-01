<?php
/**
 * Index Template
 *
 *
 * @file           index.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/index.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

  <div id="content" class="content sidebar-right twelve columns blog blog-large">

    <?php
      $custom_excerpt_length = 120;
      $readmore = true;
    ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php get_template_part( 'framework/inc/post-format/content', get_post_format() ); ?>

    <?php endwhile; ?>
    
    <?php get_template_part( 'framework/inc/nav' ); ?>
  
    <?php else : ?>
  
      <h2><?php _e('Not Found', 'editit') ?></h2>
  
    <?php endif; ?>

  </div><!-- end of .content -->

  <?php get_sidebar(); ?>

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>