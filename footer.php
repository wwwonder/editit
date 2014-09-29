<?php
/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/footer.php
 */
?>
<?php global $smof_data; ?>

  <?php if($smof_data['switch_footerwidgets']) : ?>
  <footer id="footer" class="footer clearfix">
    <div class="container clearfix">
      <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widgets')); ?>
    </div>
  </footer><!-- end of .footer -->
  <?php endif; ?>

  <div id="copyright" class="copyright clearfix">
    <div class="container">
      <div class="copyright-text eight columns">
        <?php if($smof_data['textarea_copyrighttext'] != "") : ?>
          <?php echo $smof_data['textarea_copyrighttext']; ?>
        <?php else: ?>
          &copy; Copyright <?php echo date("Y"); echo " "; bloginfo('name'); ?>
        <?php endif; ?>
      </div>

      <?php if($smof_data['switch_socialfooter']) : ?>
      <div class="eight columns">
        <?php get_template_part( 'framework/inc/socialicon' ); ?>
      </div>
      <?php endif; ?>

    </div>
  </div><!-- end of .copyright -->

  </div><!-- end of layoutt -->

  <div id="back-to-top" class="back-to-top"><i class='icon icon-angle-up'></i></div>

  <?php if($smof_data['textarea_trackingcode'] != '') { echo $smof_data['textarea_trackingcode']; } ?>

  <?php wp_footer(); ?>

</body>
</html>