<?php
/**
 * Member Single Template :  Medium Media on Left
 *
 *
 * @file           media-on-left.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/member/media-on-left.php
 */
?>
<?php
  global $smof_data;
  $thumbnail_size = "portfolio-medium";
?>
<article class="member member-single-item member-mediaonleft clearfix">

  <?php if ( rwmb_meta( 'editit_selectmembermedia' ) == "video" ): ?>

    <?php if( rwmb_meta('editit_textareavideoembed')): ?>
    <div id="member-video" class="member-video embed-video ten columns">
      <?php echo rwmb_meta('editit_textareavideoembed'); ?>
    </div>
    <?php elseif ( has_post_thumbnail() ) : ?>
    <div id="post-image" class="post-image ten columns">
      <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
        <?php the_post_thumbnail(); ?>
      </a>
    </div>
    <?php endif; ?>

  <?php elseif ( rwmb_meta( 'editit_selectmembermedia' ) == "image" ): ?>

    <?php if ( $images = rwmb_meta( 'editit_imagegallery', 'type=image' ) ): ?>

      <?php if ( rwmb_meta( 'editit_selectmemberimagedisplay' ) == "slider" ): ?>

      <div id="member-slider" class="member-slider flexslider ten columns">
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

      <div id="member-list" class="member-list ten columns">
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
    <div id="post-image" class="post-image ten columns">
      <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
        <?php the_post_thumbnail(); ?>
      </a>
    </div>
    <?php endif; ?>

  <?php endif; ?>


  <div class="six columns">

    <div class="member-content">
      <div class="member-content-header">
        <div class="member-title">
          <h2>
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr('Permalink to %s'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a>
          </h2>
        </div>
        <div class="member-position">
          <h3>
            <?php echo rwmb_meta('editit_textmemberpositiontext'); ?>
          </h3>
        </div>
      </div>

      <div class="member-excerpt">
        <?php the_content(); ?>
        <div class="clear"></div>
      </div>

      <?php if(rwmb_meta('editit_selectmemberdisplaysocial')): ?>
      <div class="sharebox clearfix">

        <ul class="social-icons clearfix">

          <?php if( rwmb_meta('editit_textmembertwittertext') != '' ): ?>
          <li class="social-twitter">
            <a href="<?php echo rwmb_meta('editit_textmembertwittertext'); ?>" title="<?php _e( 'Twitter', 'editit' ) ?>" target="_blank"><i class="icon icon-twitter"></i></a>
          </li>
          <?php endif; ?>
  
          <?php if( rwmb_meta('editit_textmemberfacebooktext') != '' ): ?>
          <li class="social-facebook">
            <a href="<?php echo rwmb_meta('editit_textmemberfacebooktext'); ?>" title="<?php _e( 'Facebook', 'editit' ) ?>" target="_blank"><i class="icon icon-facebook-square"></i></a>
          </li>
          <?php endif; ?>
  
          <?php if( rwmb_meta('editit_textmembergoogleplustext') != '' ): ?>
          <li class="social-googleplus">
            <a href="<?php echo rwmb_meta('editit_textmembergoogleplustext'); ?>" title="<?php _e( 'Google+', 'editit' ) ?>" target="_blank"><i class="icon icon-google-plus-square"></i></a>
          </li>
          <?php endif; ?>
  
          <?php if( rwmb_meta('editit_textmemberskypetext') != '' ): ?>
          <li class="social-skype">
            <a href="<?php echo rwmb_meta('editit_textmemberskypetext'); ?>" title="<?php _e( 'Skype', 'editit' ) ?>" target="_blank"><i class="icon icon-skype"></i></a>
          </li>
          <?php endif; ?>
  
          <?php if( rwmb_meta('editit_emailmemberemail') != '' ): ?>
          <li class="social-email">
            <a href="mailto:<?php echo rwmb_meta('editit_emailmemberemail'); ?>" title="<?php _e( 'Email', 'editit' ) ?>" target="_blank"><i class="icon icon-envelope-o"></i></a>
          </li>
          <?php endif; ?>
  
          <?php if( rwmb_meta('editit_urlmemberwebsiteurl') != '' ): ?>
          <li class="social-url">
            <a href="<?php echo rwmb_meta('editit_urlmemberwebsiteurl'); ?>" title="<?php _e( 'Website', 'editit' ) ?>" target="_blank"><i class="icon icon-link"></i></a>
          </li>
          <?php endif; ?>

        </ul>
      </div>
      <?php endif; ?>

    </div>

    <?php if(rwmb_meta('editit_selectshowmemberinformation')) : ?>

    <div class="member-information">
      <ul>
      <?php for( $i = 1; $i <= 10; $i++ ): ?>
        <?php if( rwmb_meta( 'editit_textmemberinformationlabel' . $i ) && $smof_data['text_memberinformationlabel' . $i] ): ?>
        <li><strong><?php echo $smof_data['text_memberinformationlabel' . $i]; ?></strong><?php echo rwmb_meta( 'editit_textmemberinformationlabel' . $i ); ?></li>
        <?php endif; ?>
      <?php endfor; ?>
      </ul>
    </div>

    <?php endif; ?>

  </div>

</article>