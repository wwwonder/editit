<?php
/**
 * Portfolio Single Template :  Medium Media on Left
 *
 *
 * @file           media-on-left.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/portfolio/media-on-left.php
 */
?>
<?php
  global $smof_data;
  $thumbnail_size = "portfolio-medium";
?>
<article class="portfolio portfolio-single-item portfolio-mediaonleft clearfix">

  <?php if ( rwmb_meta( 'editit_selectportfoliomedia' ) == "video" ): ?>

    <?php if( rwmb_meta('editit_textareavideoembed')): ?>
    <div id="portfolio-video" class="portfolio-video embed-video ten columns">
      <?php echo rwmb_meta('editit_textareavideoembed'); ?>
    </div>
    <?php elseif ( has_post_thumbnail() ) : ?>
    <div id="post-image" class="post-image ten columns">
      <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
        <?php the_post_thumbnail(); ?>
      </a>
    </div>
    <?php endif; ?>

  <?php elseif ( rwmb_meta( 'editit_selectportfoliomedia' ) == "image" ): ?>

    <?php if ( $images = rwmb_meta( 'editit_imagegallery', 'type=image' ) ): ?>

      <?php if ( rwmb_meta( 'editit_selectportfolioimagedisplay' ) == "slider" ): ?>

      <div id="portfolio-slider" class="portfolio-slider flexslider ten columns">
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

      <div id="portfolio-list" class="portfolio-list ten columns">
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
    <div class="portfolio-content">
      <div class="portfolio-content-header">
        <div class="portfolio-title">
          <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        </div>
      </div>
      <div class="portfolio-excerpt">
        <?php the_content(); ?>
        <div class="clear"></div>
      </div>
    </div>

    <?php if( rwmb_meta( 'editit_selectshowportfolioinformation' ) ): ?>
    <div class="portfolio-information">
    <ul>

      <?php for( $i = 1; $i <= 10; $i++ ): ?>
        <?php if( rwmb_meta( 'editit_textportfolioinformationlabel' . $i ) != "" && $smof_data['text_portfolioinformationlabel' . $i] != "" ): ?>
        <li><strong><?php echo $smof_data['text_portfolioinformationlabel' . $i]; ?></strong><?php echo rwmb_meta( 'editit_textportfolioinformationlabel' . $i ); ?></li>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if( rwmb_meta( 'editit_textportfolioinformationlabellinktext' )): ?>
        <li>
          <strong><?php if($smof_data['text_portfolioinformationlinklabel'] != ""){ echo $smof_data['text_portfolioinformationlinklabel']; }else{ _e('Link', 'editit'); } ?></strong>
          <?php if( rwmb_meta( 'editit_urlportfolioinformationlabellinkurl' ) != ""): ?>
            <a href="<?php echo rwmb_meta( 'editit_urlportfolioinformationlabellinkurl' ); ?>"><?php echo rwmb_meta( 'editit_textportfolioinformationlabellinktext' ); ?></a>
          <?php else: ?>
            <?php echo rwmb_meta( 'editit_textportfolioinformationlabellink' ); ?>
          <?php endif; ?>
        </li>
      <?php endif; ?>

    </ul>
    </div>
    <?php endif; ?>

  </div>

</article>