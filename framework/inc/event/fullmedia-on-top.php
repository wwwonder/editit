<?php
/**
 * Event Single Template :  Full Media on Top
 *
 *
 * @file           fullmedia-on-top.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/event/fullmedia-on-top.php
 */
?>
<?php
  global $smof_data;
  $thumbnail_size = "portfolio-full";
?>
<article class="event event-single-item event-fullmediaontop clearfix">

  <?php if ( rwmb_meta( 'editit_selecteventmedia' ) == "video" ): ?>

    <?php if( rwmb_meta('editit_textareavideoembed')): ?>
    <div id="event-video" class="event-video embed-video sixteen columns">
      <?php echo rwmb_meta('editit_textareavideoembed'); ?>
    </div>
    <?php elseif ( has_post_thumbnail() ) : ?>
    <div id="post-image" class="post-image sixteen columns">
      <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
        <?php the_post_thumbnail(); ?>
      </a>
    </div>
    <?php endif; ?>

  <?php elseif ( rwmb_meta( 'editit_selecteventmedia' ) == "image" ): ?>

    <?php if ( $images = rwmb_meta( 'editit_imagegallery', 'type=image' ) ): ?>

      <?php if ( rwmb_meta( 'editit_selecteventimagedisplay' ) == "slider" ): ?>

      <div id="event-slider" class="event-slider flexslider sixteen columns">
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

      <div id="event-list" class="event-list sixteen columns">
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


  <div class="event-content <?php if( rwmb_meta( 'editit_selectshoweventinformation' ) ) { echo 'eleven'; } else { echo 'sixteen'; } ?> columns">
    <div class="event-content-header">
      <div class="event-title">
        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr('Permalink to %s'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      </div>
      <div class="event-date">
        <h3>
              <time datetime="<?php
                echo date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventstartdate' )));
                if( rwmb_meta('editit_dateeventstartdate') != rwmb_meta( 'editit_dateeventenddate' ) ){
                  echo  ' - ' . date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventenddate' )));
                }?>" title="<?php
                echo date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventstartdate' )));
                if( rwmb_meta('editit_dateeventstartdate') != rwmb_meta( 'editit_dateeventenddate' ) ){
                  echo  ' - ' . date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventenddate' )));
                }?>" class="post-date">

                <?php
                  echo date(get_option('date_format'), strtotime(rwmb_meta( 'editit_dateeventstartdate' )));
                ?>
                <?php if( rwmb_meta('editit_dateeventstartdate') != rwmb_meta( 'editit_dateeventenddate' ) ) : ?>
                  <?php
                    echo ' - ' . date(get_option('date_format'), strtotime(rwmb_meta( 'editit_dateeventenddate' )));
                  ?>
                <?php endif; ?>

              </time>
        </h3>
      </div>

    </div>
    <div class="event-excerpt">
      <?php the_content(); ?>
      <div class="clear"></div>
    </div>

  </div>


  <?php if( rwmb_meta( 'editit_selectshoweventinformation' ) ): ?>
  <div class="event-information five columns">
    <ul>
      <?php for( $i = 1; $i <= 10; $i++ ): ?>
        <?php if( rwmb_meta( 'editit_texteventinformationlabel' . $i ) && $smof_data['text_eventinformationlabel' . $i] ): ?>
        <li><strong><?php echo $smof_data['text_eventinformationlabel' . $i]; ?></strong><?php echo rwmb_meta( 'editit_texteventinformationlabel' . $i ); ?></li>
        <?php endif; ?>
      <?php endfor; ?>
    </ul>
  </div>
  <?php endif; ?>

</article>