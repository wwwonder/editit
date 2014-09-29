<?php
/*
Template Name: FAQ
*/
/**
 * FAQ
 *
 * @file           page-faq.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page-faq.php
 */
?>

<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

  <div id="content" class="content sixteen columns faq">
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

  <div id="categories" class="categories faq-categories sixteen columns">
  <?php $faq_categories = get_terms('faq_category');
      if($faq_categories): ?>
        <ul class="clearfix">
          <li><a href="#" data-filter="*" class="active"><?php _e('All', 'editit'); ?></a></li>
          <?php foreach($faq_categories as $faq_category): ?>
            <?php if(rwmb_meta('editit_selectfaqcategory')  && !in_array('0', get_post_meta(get_the_ID(), 'editit_selectfaqcategory', false))): ?>
              <?php if(in_array($faq_category->term_id, get_post_meta(get_the_ID(), 'editit_selectfaqcategory', false))): ?>
                <li><a href="#" data-filter=".term-<?php echo $faq_category->slug; ?>"><?php echo $faq_category->name; ?></a></li>
              <?php endif; ?>
            <?php else: ?>
              <li><a href="#" data-filter=".term-<?php echo $faq_category->slug; ?>"><?php echo $faq_category->name; ?></a></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
  </div><!-- end of .categories -->

  <div class="clear"></div>

  <div id="faq-wrap" class="faq-wrap">

    <dl id="faq-list" class="faq-list clearfix">

    <?php
      $faqitems = rwmb_meta('editit_selectfaqitemsonpage');
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
        'post_type'       => 'faq',
        'posts_per_page'  => $faqitems,
        'post_status'     => 'publish',
        'order'           => 'ASC',
        'paged'           => $paged
      );

      $selectedcategories = rwmb_meta('editit_selectfaqcategory');
      if($selectedcategories && $selectedcategories[0] == 0) {
        unset($selectedcategories[0]);
      }
      if($selectedcategories){
        $args['tax_query'][] = array(
                                 'taxonomy'  => 'faq_category',
                                 'field'     => 'ID',
                                 'terms'     => $selectedcategories
        );
      }

      $bu_query = $wp_query;
      $wp_query = null; 
      $wp_query = new WP_Query($args);
      
      while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

      <?php $terms = get_the_terms( get_the_ID(), 'faq_category' ); ?>                

      <section class='<?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->slug.' '; } endif; ?>faq-item sixteen columns'>
        <dt><i class="icon icon-plus-square"></i><?php the_title(); ?></dt>
        <dd><?php the_content(); ?></dd>
      </section>

    <?php endwhile; ?>

    </dl>
  </div><!-- end of .faq-wrap -->
  
  <div class="sixteen columns">
    <?php get_template_part( 'framework/inc/nav' ); ?>
  </div>
  
</div><!-- end of .page-wrap -->

<?php get_footer(); ?>