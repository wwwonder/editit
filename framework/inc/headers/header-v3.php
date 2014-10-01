<?php
/**
 * Header V3
 *
 *
 * @file           header-v3.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/headers/header-v3.php
 */
?>
<header id="header-v3" class="header-v3 header clearfix">
  <div class="header-v3-container container">
    <div class="sixteen columns">
      <div class="logo">
        <?php if($smof_data['media_logo'] != "") : ?>
          <a href="<?php echo home_url(); ?>/"><img src="<?php echo $smof_data['media_logo']; ?>" alt="<?php bloginfo('name'); ?>" class="logo-img logo-standard" /></a>
          <?php if($smof_data['media_logoretina'] != '') : ?>
          <a href="<?php echo home_url(); ?>/"><img src="<?php echo $smof_data['media_logoretina'] ?>" width="<?php echo $smof_data['text_logowidth']; ?>" height="<?php echo $smof_data['text_logoheight']; ?>" alt="<?php bloginfo('name'); ?>" class="logo-img logo-retina" /></a>
          <?php endif; ?>
        <?php else : ?>
          <a href="<?php echo home_url(); ?>/" class="logo-text"><?php bloginfo('name'); ?></a>
        <?php endif; ?>
      </div>
      <div id="slogan" class="slogan">
        <?php echo $smof_data['textarea_headerslogantext']; ?>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <div id="navigation" class="navigation sixteen columns clearfix alpha omega">
    <div class="container">
      <div class="sixteen columns">
        <?php wp_nav_menu(array('theme_location' => 'main_navigation', 'menu_id' => 'nav', 'container' => false)); ?>
      </div>
    </div>
  </div>
</header>