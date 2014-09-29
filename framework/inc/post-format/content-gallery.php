<?php
/**
 * Blog Page Gallery Content
 *
 *
 * @file           content-gallery.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/post-format/content-gallery.php
 */
?>
<?php
global $select_sidebar;
global $blog_type;

if ($blog_type == 'medium') {
  if($select_sidebar != 'no-sidebar'){
    $thumbnail_size = 'half';
  }else{
    $thumbnail_size = 'half-full';
  }
}else {
  if($select_sidebar != 'no-sidebar'){
    $thumbnail_size = 'standard';
  }else{
    $thumbnail_size = 'standard-full';
  }
}
?>

<article class="post clearfix">

  <?php if ( $images = rwmb_meta( 'editit_imagegallery', 'type=image' ) ): ?>
  <div class="post-gallery flexslider">
    <ul class="slides">
      <?php foreach( $images as $image ) : ?>
      <li>
         <a href="<?php the_permalink(); ?>" class="link" title="<?php echo $image['title']; ?>">
           <?php echo wp_get_attachment_image($image['ID'], $thumbnail_size); ?>
         </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php elseif ( has_post_thumbnail() ) : ?>
  <div class="post-image">
    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" class="link" rel="bookmark">
      <?php the_post_thumbnail(); ?>
    </a>
  </div>
  <?php endif; ?>

  <div class="post-content">

    <div class="post-content-header">
      <div class="post-title">
        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      </div>
      <div class="post-meta">
        <span class="meta-date"><time datetime="<?php echo date(DATE_W3C); ?>" class="updated"><?php the_time(get_option('date_format')); ?></time></span>
        <span class="sep">|</span>
        <span class="meta-author">By <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php printf( esc_attr__('View all posts by %s', 'editit'), get_the_author() ); ?>"><?php the_author(); ?></a></span>
        <span class="sep">|</span>
        <span class="meta-category"><?php the_category(', '); ?></span>
        <?php if ( comments_open() ) : ?>
        <span class="sep">|</span>
        <span class="meta-comment"><?php comments_popup_link(__('No Comments', 'editit'), __('1 Comment', 'editit'), __('% Comments', 'editit'), 'comments-link', ''); ?></span>
        <?php endif; ?>
      </div>
    </div>

    <div class="post-excerpt">
      <?php echo get_the_excerpt(); ?>
      <div class="clear"></div>
    </div>
  </div>

</article>
