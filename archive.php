<?php
/**
 * Archive Pages Template
 *
 *
 * @file           archive.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/archive.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">
<?php 
  $custom_excerpt_length = 120;
  $readmore = true;
?>
  <?php get_template_part( 'framework/inc/archive/content', get_post_type() ); ?>

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>