<?php
/*
Template Name: Portfolio
*/

/**
 * Portfolio Pages Template
 *
 * @file           page-portfolio.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page-portfolio.php
 */

?>

<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

  <div id="content" class="content sixteen columns portfolio">

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

  <div id="categories" class="categories portfolio-categories sixteen columns clearfix">
  <?php
    $portfolio_categories = get_terms('portfolio_category');
    if($portfolio_categories):
  ?>
        <ul class="clearfix">
          <li><a href="#" data-filter="*" class="active"><?php _e('All', 'editit'); ?></a></li>

          <?php foreach($portfolio_categories as $portfolio_category): ?>
            <?php if(rwmb_meta('editit_selectportfoliocategory')  && !in_array('0', rwmb_meta('editit_selectportfoliocategory'))): ?>
              <?php if(in_array($portfolio_category->term_id, rwmb_meta('editit_selectportfoliocategory'))): ?>
                <li><a href="#" data-filter=".term-<?php echo $portfolio_category->slug; ?>"><?php echo $portfolio_category->name; ?></a></li>
              <?php endif; ?>
            <?php else: ?>
              <li><a href="#" data-filter=".term-<?php echo $portfolio_category->slug; ?>"><?php echo $portfolio_category->name; ?></a></li>
            <?php endif; ?>
          <?php endforeach; ?>

        </ul>
      <?php endif; ?>
  </div><!-- end of .categories -->

  <div class="clear"></div>

  <div id="portfolio-wrap" class="portfolio-wrap">

    <?php

      if(rwmb_meta('editit_selectportfoliocolumn') == 'three'){
        $column = 'one-third';
      }elseif(rwmb_meta('editit_selectportfoliocolumn') == 'two'){
        $column = 'eight';
      }elseif(rwmb_meta('editit_selectportfoliocolumn') == 'one'){
        $column = 'sixteen';
      }else{
        $column = 'four';
      }

      $portfolioitems = rwmb_meta('editit_selectportfolioitemsonpage');
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
        'post_type'       => 'portfolio',
        'posts_per_page'  => $portfolioitems,
        'post_status'     => 'publish',
        'order'           => 'ASC',
        'paged'           => $paged
      );

      $selectedcategories = rwmb_meta('editit_selectportfoliocategory');
      if($selectedcategories && $selectedcategories[0] == 0) {
        unset($selectedcategories[0]);
      }
      if($selectedcategories){
        $args['tax_query'][] = array(
                                 'taxonomy'  => 'portfolio_category',
                                 'field'     => 'ID',
                                 'terms'     => $selectedcategories
                               );
      }

      $bu_query = $wp_query;
      $wp_query = null; 
      $wp_query = new WP_Query($args);

      if( rwmb_meta('editit_selectshowportfoliotitle') ){ $showportfoliotitle = true; }else{ $showportfoliotitle = false; }

      while ( $wp_query->have_posts() ) : $wp_query->the_post();

        $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
        $link = '';
        $embed = '';

        if ( rwmb_meta( 'editit_selectportfoliolinktolightbox' )){

          if( rwmb_meta( 'editit_selectportfoliomedia' ) == "video" && rwmb_meta( 'editit_textareavideoembed' ) != "") {
            $randomid = rand();
            $link = '<a href="#embed-video-' . $randomid . '" class="lightbox prettyPhoto" title="'. get_the_title() .'" rel="prettyPhoto[portfolio]">';
            $embed = '<div id="embed-video-'.$randomid.'" class="embed-video">' . rwmb_meta( 'editit_textareavideoembed' ) . '</div>';
          }else{
            $link = '<a href="'. wp_get_attachment_url( get_post_thumbnail_id() ) .'" class="lightbox prettyPhoto" rel="prettyPhoto[portfolio]" title="'. get_the_title() .'">';
          }

        }else{

          if ( rwmb_meta( 'editit_selectportfoliolinktosinglepage' )){
            $link = '<a href="' . get_permalink() . '" title="' . sprintf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ) . '" class="link">';
          }

        }

    ?>

      <article class='<?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->slug.' '; } endif; ?>portfolio-item <?php if( $showportfoliotitle ){ echo 'showportfoliotitle ';} ?><?php echo $column; ?> columns'>


        <div class='portfolio-thumbnail'>
          <span class='pic'>

            <?php if(has_post_thumbnail()): ?>

              <?php echo $link; ?>
              <?php the_post_thumbnail('portfolio'); ?>
              <?php if( $link != '' ): ?>
              </a>
              <?php endif; ?>

            <?php else: ?>

              <img src="<?php bloginfo('template_directory'); ?>/framework/images/portfolio-noimage.png">

            <?php endif; ?>

          </span>
        </div>


        <?php if( $showportfoliotitle ) : ?>
        <div class="portfolio-content">

          <div class="portfolio-content-header">
            <div class="portfolio-title">
              <h2>
              <?php if( rwmb_meta( 'editit_selectportfoliolinktosinglepage' ) ) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a>
              <?php else: ?>
                <?php the_title(); ?>
              <?php endif; ?>
              </h2>
              <h3>
                <?php echo rwmb_meta( 'editit_subtitle' ); ?>
              </h3>
            </div>
          </div>

        </div><!-- end of .portfolio-content -->
        <?php endif; ?>

        <?php echo $embed; ?>

      </article>

    <?php endwhile; ?>

  </div><!-- end of .portfolio-wrap -->

  <div class="sixteen columns">
    <?php get_template_part( 'framework/inc/nav' ); ?>
  </div>

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>