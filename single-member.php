<?php
/**
 * Member Single Template
 *
 *
 * @file           single-member.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/single-member.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container member-single">

  <div id="content" class="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
      if ( rwmb_meta( 'editit_selectmemberlayout', get_the_ID()) == "mediaonleft" ) :
        get_template_part( 'framework/inc/member/media-on-left' );
      elseif ( rwmb_meta( 'editit_selectmemberlayout', get_the_ID()) == "mediaonright" ) :
        get_template_part( 'framework/inc/member/media-on-right' );
      else:
        get_template_part( 'framework/inc/member/fullmedia-on-top' );
      endif;
    ?>

    <?php endwhile; endif; ?>

  </div><!-- end of .content -->
</div><!-- end of .page-wrap -->

<?php get_footer(); ?>