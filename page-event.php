<?php
/*
Template Name: Event
*/

/**
 * Pages Template
 *
 *
 * @file           page-event.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2013 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page-event.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container event">

  <div id="content" class="content sixteen columns event">
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
  </div><!-- end of .content -->

  <div id="event-wrap" class="event-wrap clearfix">
    <?php
      if(rwmb_meta('editit_selecteventpagetype') == 'list'){
        $pagetype = 'list';
      }elseif(rwmb_meta('editit_selecteventpagetype') == 'calendar'){
        $pagetype = 'calendar';
      }
    ?>


    <?php if ( $pagetype == 'list' ) : ?>
    <?php

      $today_date = date("Y-m-d");
      $eventitems = rwmb_meta('editit_selecteventitemsonpage');
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
        'post_type'           => 'event',
        'posts_per_page'      => $eventitems,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'paged'               => $paged,
        'meta_key'            => 'editit_dateeventstartdate',
        'orderby'             => 'meta_value',
        'order'               => 'ASC',
        'meta_query'          => array(
                                   array(  'key'     =>  'editit_dateeventenddate',
                                           'value'   =>  $today_date,
                                           'compare' =>  '>=',
                                           'type'    =>  'DATE'
                                   )
                                 )

      );



      $selectedcategories = rwmb_meta('editit_selecteventcategory');
      if($selectedcategories && $selectedcategories[0] == 0) {
        unset($selectedcategories[0]);
      }
      if($selectedcategories){
        $args['tax_query'][] = array(
                                 'taxonomy'  => 'event_category',
                                 'field'     => 'ID',
                                 'terms'     => $selectedcategories
                               );
      }






      $bu_query = $wp_query;
      $wp_query = null;
      $wp_query = new WP_Query($args);


      $thumbnail = rwmb_meta('editit_selectshoweventthumbnail');
      $thumbnail_size = rwmb_meta('editit_selecteventthumbnailsize');
      $excerpt = rwmb_meta('editit_selectshoweventexcerpt');
      $custom_excerpt_length = rwmb_meta('editit_texteventmaxlengthofexcerpt') != '' ? rwmb_meta('editit_texteventmaxlengthofexcerpt') : 110;
      $readmore = true;

      if ( $wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
    ?>

    <article class='event-item <?php echo $column; ?> columns'>

      <?php if($thumbnail): ?>
        <?php if ( has_post_thumbnail()): ?>
          <div class='event-thumbnail <?php echo $thumbnail_size; ?>'>
            <span class='pic'>
              <?php if(rwmb_meta('editit_selecteventlinktosinglepage')): ?>
                <?php if(rwmb_meta('editit_selecteventlinktolightbox')): ?>
                  <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ) ?>" class="lightbox prettyPhoto">
                <?php else: ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="link">
                <?php endif; ?>
                <?php the_post_thumbnail('square'); ?>
              </a>
              <?php else: ?>
                <?php if(rwmb_meta('editit_selecteventlinktolightbox')): ?>
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

      <div class="event-content">
        <div class="event-content-header">
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
          <div class="event-title">
            <h2>
            <?php if(rwmb_meta('editit_selecteventlinktosinglepage')): ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <?php else: ?>
              <?php the_title(); ?>
            <?php endif; ?>
            </h2>
          </div>
        </div>

        <?php if($excerpt): ?>
        <div class="event-excerpt">
          <?php echo get_the_excerpt(); ?>
          <div class="clear"></div>
        </div>
        <?php endif; ?>

      </div>
    </article>


  <?php endwhile; else: ?>

    <div class="no-event-list"><?php _e( 'No Event After Today.', 'editit' ); ?></div>

  <?php endif; ?>



  </div><!-- end of .event-wrap -->

  <div class="sixteen columns">
    <?php get_template_part( 'framework/inc/nav' ); ?>
  </div>

    <?php elseif ( $pagetype == 'calendar' ) : ?>

    <div class="event-calendar-wrap sixteen columns">
      <div class="event-calendar-header clearfix">
        <div class="month-year clearfix">
          <span id="month-num" class="month-num"></span>
          <span id="month-name-year-num" class="month-name-year-num"></span>
        </div>
        <nav class="month-nav clearfix">
          <span id="next-month" class="next-month"><i class="icon icon-chevron-right"></i></span>
          <span id="prev-month" class="prev-month"><i class="icon icon-chevron-left"></i></span>
          <span id="current-month" class="current-month" title="Got to current date"><?php _e( 'Today', 'editit' ); ?></span>
        </nav>
      </div>
      <div id="calendar" class="fc-calendar-container"></div>
    </div>
  </div><!-- end of .event-wrap -->

    <?php endif; ?>

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>