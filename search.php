<?php
/**
 * Search Result Pages Template
 *
 *
 * @file           search.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/search.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

  <div id="content" class="content sidebar-right twelve columns blog blog-large">

<?php 
  $custom_excerpt_length = 120;
  $readmore = true;
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="post clearfix">

      <div class="post-content">
        <div class="post-content-header">
          <div class="post-title">
            <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
          </div>
          <div class="post-meta">
            <span class="meta-date"><time datetime="<?php echo date(DATE_W3C); ?>" class="updated"><?php the_time(get_option('date_format')); ?></time></span>
            <span class="sep">|</span>
            <span class="meta-author">By <?php the_author(); ?></span>
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

  <?php endwhile;?>

    <?php get_template_part( 'framework/inc/nav' ); ?>

<?php else : ?>

    <h2><?php _e('Not Found', 'editit') ?></h2>

<?php endif; ?>

  </div><!-- end of .content -->

  <?php get_sidebar(); ?>

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>