<?php
/**
 * Header V1
 *
 *
 * @file           header-v1.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/headers/header-v1.php
 */
?>
<header id="header-v1" class="header-v1 header clearfix">
  <div class="header-v1-container container">
    <div class="four columns">
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
    </div>
    <div id="navigation" class="navigation twelve columns clearfix">
      <?php wp_nav_menu(array('theme_location' => 'main_navigation', 'menu_id' => 'nav', 'container' => false )); ?>
    </div>
  </div>
</header>