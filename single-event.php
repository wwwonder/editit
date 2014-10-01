<?php
/**
 * Single Event Template
 *
 *
 * @file           single-event.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/single-event.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container event-detail">
  <div id="content" class="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php
      if ( rwmb_meta( 'editit_selecteventsinglelayout', get_the_ID()) == "mediaonleft" ) {
        get_template_part( 'framework/inc/event/media-on-left' );
      } else if ( rwmb_meta( 'editit_selecteventsinglelayout', get_the_ID()) == "mediaonright" ) {
        get_template_part( 'framework/inc/event/media-on-right' );
      }else{
        get_template_part( 'framework/inc/event/fullmedia-on-top' );
      }
    ?>

    <?php endwhile; endif; ?>

  </div> <!-- end of .content -->
</div><!-- end of .page-wrap -->

<?php get_footer(); ?>