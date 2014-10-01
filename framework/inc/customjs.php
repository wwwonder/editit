<?php
/**
 * Custom Javascript
 *
 *
 * @file           customjs.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/customjs.php
 */
?>
<?php
function editit_js_custom() {
global $smof_data; 
?>

<script type="text/javascript">

jQuery(document).ready(function($){

  /* ------------------------------------------------------------------------ */
  /* Add PrettyPhoto */
  /* ------------------------------------------------------------------------ */
  var lightboxArgs = {
    <?php if($smof_data["select_lightboxanimationspeed"]): ?>
    animation_speed: '<?php echo strtolower($smof_data["select_lightboxanimationspeed"]); ?>',
    <?php endif; ?>
    overlay_gallery: <?php if($smof_data["switch_lightboxshowgallerythumbnails"]) { echo 'true'; } else { echo 'false'; } ?>,
    autoplay_slideshow: <?php if($smof_data["switch_lightboxautoplaygallery"]) { echo 'true'; } else { echo 'false'; } ?>,
    <?php if($smof_data["select_lightboxanimationspeed"]): ?>
    slideshow: <?php echo $smof_data['sliderui_lightboxautoplaygalleryspeed']; ?>,
    <?php endif; ?>
    /* light_rounded / dark_rounded / light_square / dark_square / facebook */
    <?php if($smof_data["select_lightboxtheme"]): ?>
    theme: '<?php echo $smof_data['select_lightboxtheme']; ?>', 
    <?php endif; ?>
    <?php if($smof_data["sliderui_lightboxbackgroundopacity"]): ?>
    opacity: <?php echo $smof_data['sliderui_lightboxbackgroundopacity'] / 100; ?>,
    <?php endif; ?>
    show_title: <?php if($smof_data["switch_lightboxshowtitle"]) { echo 'true'; } else { echo 'false'; } ?>,
    <?php if(!$smof_data["switch_lightboxsocialicons"]) { echo 'social_tools: "",'; } ?>
    deeplinking: false,
    allow_resize: true,       /* Resize the photos bigger than viewport. true/false */
    counter_separator_label: '/',   /* The separator for the gallery counter 1 "of" 2 */
    default_width: 940,
    default_height: 529
  };

  <?php if($smof_data["switch_lightboxdisableautomaticforimages"] == 0): ?>
    $('a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img)').prettyPhoto(lightboxArgs);
  <?php endif; ?>

  $('a[class^="prettyPhoto"], a[rel^="prettyPhoto"]').prettyPhoto(lightboxArgs);

  <?php if($smof_data["switch_lightboxdisableonsmartphone"] == 1): ?>
  var windowWidth = window.screen.width < window.outerWidth ? window.screen.width : window.outerWidth;
  var mobile = windowWidth < 500;
  if(mobile){
    $('a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img), a[class^="prettyPhoto"]').unbind('click.prettyphoto');
  }

  <?php endif; ?>

  <?php if($smof_data['switch_stickyheader'] == true) : ?>

    if (/Android|BlackBerry|iPhone|iPad|iPod|webOS/i.test(navigator.userAgent) === false) {
      $('.header-v1, .header-v2 .navigation, .header-v3 .navigation').waypoint('sticky');
    }

  <?php endif; ?>

});



  /* Custom Javascript Code ------------------------------------------------------------------------ */ 
  <?php if($smof_data['textarea_customjscode'] != '') { echo $smof_data['textarea_customjscode']; } ?>


</script>
  
<?php }
add_action( 'wp_footer', 'editit_js_custom', 100 );
?>