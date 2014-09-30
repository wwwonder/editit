<?php
/**
 * Blog Archive Content
 *
 *
 * @file           content.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/archive/content.php
 */
?>
  <?php global $smof_data; ?>
  <?php $select_sidebar = $smof_data['select_postsidebar']; ?>
  <div id="content" class="content <?php echo $select_sidebar; if($select_sidebar != 'no-sidebar'){ echo ' twelve'; }else{ echo ' sixteen'; } ?> columns blog blog-large">

    <?php while (have_posts()) : the_post(); ?>

    <article class="post clearfix">

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

    <?php endwhile; ?>
    <?php get_template_part( 'framework/inc/nav' ); ?>
  </div><!-- end of .content -->
    <?php if($select_sidebar != 'no-sidebar') : ?>
      <?php get_sidebar(); ?>
    <?php endif; ?>