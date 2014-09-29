<?php
/*
Template Name: News
*/

/**
 * News Pages Template
 *
 *
 * @file           page-news.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page-news.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

<?php $select_sidebar = rwmb_meta('editit_selectsidebar'); ?>

  <div id="content" class="content <?php echo $select_sidebar; if($select_sidebar != 'no-sidebar'){ echo ' twelve'; }else{ echo ' sixteen'; } ?> columns news news-<?php echo rwmb_meta('editit_selectnewspagetype'); ?>">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (get_the_content() != '') : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry">
        <?php the_content(); ?>
        <div class="clear"></div>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
      </div>
    </article>

    <?php endif; ?>
  <?php endwhile; endif; ?>

<?php
    $newsitems = rwmb_meta('editit_selectnewsitemsonpage');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
      'post_type'       => 'news',
      'posts_per_page'  => $newsitems,
      'post_status'     => 'publish',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'paged'           => $paged
    );

    $bu_query = $wp_query;
    $wp_query = null; 
    $wp_query = new WP_Query($args);

    $custom_excerpt_length = rwmb_meta('editit_textnewsmaxlengthofexcerpt') != '' ? rwmb_meta('editit_textnewsmaxlengthofexcerpt') : 120;
    $readmore = true;

    while ( $wp_query->have_posts() ) : $wp_query->the_post();
?>

<article class="post clearfix">

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="post-image">
    <a href="<?php the_permalink(); ?>" class="link" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
      <?php the_post_thumbnail(); ?>
    </a>
  </div><!-- end of .post-image -->
  <?php endif; ?>

  <div class="post-content">
    <div class="post-content-header">
      <div class="post-title">
        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      </div>
      <div class="post-meta">
        <span class="meta-date"><time datetime="<?php echo date(DATE_W3C); ?>" class="updated"><?php the_time(get_option('date_format')); ?></time></span>
        <span class="sep">|</span>
        <span class="meta-author">By <?php the_author(); ?></span>
        <span class="sep">|</span>
        <span class="meta-category"><?php the_terms( $post->ID, 'news_category', '', ', '  ); ?></span>
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
  </div><!-- end of .post-content -->

</article>

    <?php endwhile; ?>
    <?php get_template_part( 'framework/inc/nav' ); ?>

  </div><!-- end of .content -->

<?php if($select_sidebar != 'no-sidebar') : ?>
  <?php get_sidebar(); ?>
<?php endif; ?>

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>