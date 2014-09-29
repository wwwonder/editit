<?php
/**
 * 404 Page Template
 *
 *
 * @file           404.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/404.php
 */
?>
<?php get_header(); ?>
<div id="no-titlebar-divider" class="no-titlebar-divider"></div>
<div id="page-wrap" class="page-wrap container">
  <div id="page-not-found" class="page-not-found no-sidebar sixteen columns">
    <h1><?php _e( '404 Error', 'editit' ); ?></h1>
    <h2><?php _e( 'Sorry, Page Not Found.', 'editit' ); ?></h2>
    <a href="<?php echo home_url(); ?>" target="_self" class="button"><?php _e( 'Back To Home', 'editit' ); ?></a>
  </div> <!-- end of .page-not-found -->
</div> <!-- end of .page-wrap -->
<?php get_footer(); ?>