<?php
/**
 * Menu Single Template :  Full Media on Top
 *
 *
 * @file           fullmedia-on-top.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/menu/fullmedia-on-top.php
 */
?>
<?php
  global $smof_data;
  $thumbnail_size = "portfolio-full";
?>
<article class="menu menu-single-item menu-fullmediaontop clearfix">

  <?php if ( rwmb_meta( 'editit_selectmenumedia' ) == "video" ): ?>

    <?php if( rwmb_meta('editit_textareavideoembed')): ?>
    <div id="menu-video" class="menu-video embed-video sixteen columns">
      <?php echo rwmb_meta('editit_textareavideoembed'); ?>
    </div>
    <?php elseif ( has_post_thumbnail() ) : ?>
    <div id="post-image" class="post-image sixteen columns">
      <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
        <?php the_post_thumbnail(); ?>
      </a>
    </div>
    <?php endif; ?>

  <?php elseif ( rwmb_meta( 'editit_selectmenumedia' ) == "image" ): ?>

    <?php if ( $images = rwmb_meta( 'editit_imagegallery', 'type=image' ) ): ?>

      <?php if ( rwmb_meta( 'editit_selectmenuimagedisplay' ) == "slider" ): ?>

      <div id="menu-slider" class="menu-slider flexslider sixteen columns">
        <ul class="slides">
          <?php foreach( $images as $image ) : ?>
          <li>
             <a href="<?php echo $image['full_url']; ?>" class="lightbox prettyPhoto" title="<?php echo $image['title']; ?>" rel="prettyPhoto[slides]">
               <?php echo wp_get_attachment_image($image['ID'], $thumbnail_size); ?>
             </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <?php else: ?>

      <div id="menu-list" class="menu-list sixteen columns">
        <ul class="slides">
        <?php foreach( $images as $image ) : ?>
          <li class="post-image">
             <a href="<?php echo $image['full_url']; ?>" class="lightbox prettyPhoto" title="<?php echo $image['title']; ?>" rel="prettyPhoto[slides]">
               <?php echo wp_get_attachment_image($image['ID'], $thumbnail_size); ?>
             </a>
          </li>
        <?php endforeach; ?>
        </ul>
      </div>

      <?php endif; ?>

    <?php elseif ( has_post_thumbnail() ) : ?>
    <div id="post-image" class="post-image sixteen columns">
      <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
        <?php the_post_thumbnail(); ?>
      </a>
    </div>
    <?php endif; ?>

  <?php endif; ?>


  <div class="menu-content <?php if( rwmb_meta( 'editit_selectshowmenuinformation' ) ) { echo 'eleven'; } else { echo 'sixteen'; } ?> columns">

    <div class="menu-content-header">
      <div class="menu-title">
        <h2>
          <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>
      </div>

      <div class="menu-price">
        <h3>
          <?php echo rwmb_meta('editit_textmenupricetext'); ?>
        </h3>
      </div>
    </div>
    <div class="menu-excerpt">
      <?php the_content(); ?>
      <div class="clear"></div>
    </div>


    <?php if(rwmb_meta('editit_selectmenudisplaycouponinformation')): ?>
    <div class="menu-coupon-info">
      <ul>
        <?php if(rwmb_meta('editit_textmenupresentationconditiontext')): ?>
          <li><?php _e('Presentation condition', 'editit'); ?> : <?php echo rwmb_meta('editit_textmenupresentationconditiontext'); ?></li>
        <?php endif; ?>
        <?php if(rwmb_meta('editit_textmenuuseconditiontext')): ?>
          <li><?php _e('Use condition', 'editit'); ?> : <?php echo rwmb_meta('editit_textmenuuseconditiontext'); ?></li>
        <?php endif; ?>
        <?php if(rwmb_meta('editit_textmenuexpirationdatetext')): ?>
          <li><?php _e('Expiration date', 'editit'); ?> : <?php echo rwmb_meta('editit_textmenuexpirationdatetext'); ?></li>
        <?php endif; ?>
      </ul>
    </div>
    <?php endif; ?>




  </div>

  <?php if( rwmb_meta( 'editit_selectshowmenuinformation' ) ): ?>
  <div class="menu-information five columns">

    <ul>

      <?php for( $i = 1; $i <= 10; $i++ ): ?>
        <?php if( rwmb_meta( 'editit_textmenuinformationlabel' . $i ) != "" && $smof_data['text_menuinformationlabel' . $i] != "" ): ?>
        <li><strong><?php echo $smof_data['text_menuinformationlabel' . $i]; ?></strong><?php echo rwmb_meta( 'editit_textmenuinformationlabel' . $i ); ?></li>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if( rwmb_meta( 'editit_textmenuinformationlabellinktext' )): ?>
        <li>
          <strong><?php if($smof_data['text_menuinformationlinklabel'] != ""){ echo $smof_data['text_menuinformationlinklabel']; }else{ _e('Link', 'editit'); } ?></strong>
          <?php if( rwmb_meta( 'editit_urlmenuinformationlabellinkurl' ) != ""): ?>
            <a href="<?php echo rwmb_meta( 'editit_urlmenuinformationlabellinkurl' ); ?>"><?php echo rwmb_meta( 'editit_textmenuinformationlabellinktext' ); ?></a>
          <?php else: ?>
            <?php echo rwmb_meta( 'editit_textmenuinformationlabellink' ); ?>
          <?php endif; ?>
        </li>
      <?php endif; ?>

    </ul>

  </div>
  <?php endif; ?>

</article>