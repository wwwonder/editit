<?php
/*
Template Name: Menu
*/
/**
 * Menu
 *
 * @file           page-menu.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page-menu.php
 */

?>

<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

  <div id="content" class="content sixteen columns menu">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (get_the_content()) : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry">
        <?php the_content(); ?>
        <div class="clear"></div>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
      </div>
    </article>
    <?php endif; ?>
  <?php endwhile; endif; ?>
  </div><!-- end of .content -->

  <div id="categories" class="categories menu-categories sixteen columns">
  <?php $menu_categories = get_terms('menu_category');
      if($menu_categories): ?>
        <ul class="clearfix">
          <li><a href="#" data-filter="*" class="active"><?php _e('All', 'editit'); ?></a></li>
          <?php foreach($menu_categories as $menu_category): ?>
            <?php if(rwmb_meta('editit_selectmenucategory')  && !in_array('0', get_post_meta(get_the_ID(), 'editit_selectmenucategory', false))): ?>
              <?php if(in_array($menu_category->term_id, get_post_meta(get_the_ID(), 'editit_selectmenucategory', false))): ?>
                <li><a href="#" data-filter=".term-<?php echo $menu_category->slug; ?>"><?php echo $menu_category->name; ?></a></li>
              <?php endif; ?>
            <?php else: ?>
              <li><a href="#" data-filter=".term-<?php echo $menu_category->slug; ?>"><?php echo $menu_category->name; ?></a></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
  </div><!-- end of .categories -->

  <div class="clear"></div>

  <div id="menu-wrap" class="menu-wrap">

    <?php

      $thumbnail = rwmb_meta('editit_selectshowmenuthumbnail');
      $thumbnail_size = rwmb_meta('editit_selectmenuthumbnailsize');
      $price = rwmb_meta('editit_selectshowmenuprice');
      $excerpt = rwmb_meta('editit_selectshowmenuexcerpt');
      $menuitems = rwmb_meta('editit_selectmenuitemsonpage');

      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
                'post_type'       => 'menu',
                'posts_per_page'  => $menuitems,
                'post_status'     => 'publish',
                'order'           => 'ASC',
                'paged'           => $paged
      );

      $selectedcategories = rwmb_meta('editit_selectmenucategory');
      if($selectedcategories && $selectedcategories[0] == 0) {
        unset($selectedcategories[0]);
      }
      if($selectedcategories){
        $args['tax_query'][] = array(
                                 'taxonomy'  => 'menu_category',
                                 'field'     => 'ID',
                                 'terms'     => $selectedcategories
                               );
      }

      $bu_query = $wp_query;
      $wp_query = null; 
      $wp_query = new WP_Query($args);

      $custom_excerpt_length = rwmb_meta('editit_textmenumaxlengthofexcerpt') != '' ? rwmb_meta('editit_textmenumaxlengthofexcerpt') : 120;
      $readmore = false;

      while ( $wp_query->have_posts() ) : $wp_query->the_post();
        $terms = get_the_terms( get_the_ID(), 'menu_category' );
    ?>

    <article class='<?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->slug.' '; } endif; ?>menu-item sixteen columns'>

      <?php if($thumbnail): ?>
        <?php if ( has_post_thumbnail()): ?>
          <div class='menu-thumbnail <?php echo $thumbnail_size; ?>'>
            <span class='pic'>
              <?php if(rwmb_meta('editit_selectmenulinktosinglepage')): ?>
                <?php if(rwmb_meta('editit_selectmenulinktolightbox')): ?>
                  <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ) ?>" class="lightbox prettyPhoto">
                <?php else: ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="link">
                <?php endif; ?>
                <?php the_post_thumbnail('square'); ?>
              </a>
              <?php else: ?>
                <?php if(rwmb_meta('editit_selectmenulinktolightbox')): ?>
                  <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ) ?>" class="lightbox prettyPhoto" rel="prettyPhoto" title="<?php the_title() ?>">
                    <?php the_post_thumbnail('square'); ?>
                  </a>
                <?php else: ?>
                  <?php the_post_thumbnail('square'); ?>
                <?php endif; ?>
              <?php endif; ?>
            </span>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="menu-content">
        <div class="menu-content-header">
          <div class="menu-title">
            <h2>
            <?php if(rwmb_meta('editit_selectmenulinktosinglepage')): ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <?php else: ?>
              <?php the_title(); ?>
            <?php endif; ?>
            </h2>
          </div>
          <?php if($price): ?>
          <div class="menu-price">
            <h3>
              <?php echo rwmb_meta('editit_textmenupricetext'); ?>
            </h3>
          </div>
          <?php endif; ?>
        </div>
        <?php if($excerpt): ?>
        <div class="menu-excerpt">
          <?php echo get_the_excerpt(); ?>
          <div class="clear"></div>
        </div>
        <?php endif; ?>
      </div>
    </article>

      <?php endwhile; ?>

  </div><!-- end of .menu-wrap -->

  <div class="sixteen columns">
    <?php get_template_part( 'framework/inc/nav' ); ?>
  </div>
  
</div><!-- end of .page-wrap -->

<?php get_footer(); ?>