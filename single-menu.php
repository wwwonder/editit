<?php
/**
 * Menu Single Template
 *
 *
 * @file           single-menu.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/single-menu.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container menu-detail">
  <div id="content" class="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php
      if ( rwmb_meta( 'editit_selectmenusinglelayout', get_the_ID()) == "mediaonleft" ) :
        get_template_part( 'framework/inc/menu/media-on-left' );
      elseif ( rwmb_meta( 'editit_selectmenusinglelayout', get_the_ID()) == "mediaonright" ) :
        get_template_part( 'framework/inc/menu/media-on-right' );
      else:
        get_template_part( 'framework/inc/menu/fullmedia-on-top' );
      endif;
    ?>

    <?php endwhile; endif; ?>

  </div><!-- end of .content -->
</div><!-- end of .page-wrap -->

<?php get_footer(); ?>