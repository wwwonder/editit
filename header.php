<?php
/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/header.php
 */
?>
<?php global $smof_data; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>

<!-- basic setting -->
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php bloginfo('name'); ?> <?php if( is_front_page() && get_bloginfo( 'description' )){ echo '| ';bloginfo( 'description' ); }?><?php wp_title(' - ', true, 'left'); ?></title>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- devices setting -->
<?php if($smof_data['switch_mobilezoom'] == 0) : ?><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><?php endif; ?>


<!-- favicon -->
<?php if($smof_data['media_favicon'] != "") : ?><link rel="shortcut icon" href="<?php echo $smof_data['media_favicon']; ?>"><?php endif; ?>


<!-- pingback -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<!-- google font -->
<?php get_template_part( 'framework/inc/googlefonts'); ?>


<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

  <?php if( $smof_data['select_layoutstyle'] == 'boxedlayout' || $smof_data['select_layoutstyle'] == 'boxedlayoutwithmargin' ) : ?>
  <div id="boxed-layout" class="boxed-layout inner-body">
  <?php else: ?>
  <div id="fullwidths-layout" class="fullwidths-layout inner-body">
  <?php endif; ?>

  <?php if( $smof_data['switch_topbar'] ) : ?>

  <div id="topbar" class="topbar clearfix <?php if( !$smof_data['switch_socialtopbar'] ) { echo 'no-social'; } ?>">

    <div class="container">

      <?php if( $smof_data['textarea_topbartext'] != "" ) : ?>
      <div class="eight columns">
        <div class="topbar-text">
          <?php echo $smof_data['textarea_topbartext']; ?>
          <div class="clear"></div>
        </div>
      </div>
      <?php endif; ?>

      <?php if( $smof_data['switch_socialtopbar'] || $smof_data['switch_searchform'] ) : ?>
      <div class="<?php if( $smof_data['textarea_topbartext'] != "" ) { echo 'eight'; }else{ echo 'sixteen'; } ?> columns<?php if(!$smof_data['switch_socialtopbar']) { echo ' no-social'; } ?>">

        <?php if( $smof_data['switch_searchform'] ) : ?>
        <form action="<?php echo home_url(); ?>/" id="topbar-searchform" class="topbar-searchform" method="get">
          <input type="text" id="topbar-s" name="s" value="" autocomplete="off" />
          <i class="icon icon-search"></i>
          <input type="submit" value="Search" id="topbar-searchsubmit" />
        </form>
        <?php endif; ?>

        <?php if( $smof_data['switch_socialtopbar'] ) : ?>

        <?php get_template_part( 'framework/inc/socialicon' ); ?>

        <?php endif; ?>

      </div>
      <?php endif; ?>

    </div><!-- end of .container -->

  </div><!-- end of .topbar -->
  <?php endif; ?>

  <?php if( $smof_data['header_layout'] != "" ) : ?>
    <?php include_once('framework/inc/headers/header-'.$smof_data['header_layout'].'.php'); ?>
  <?php endif; ?>
