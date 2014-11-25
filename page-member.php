<?php
/*
Template Name: Member
*/

/**
 * Member Pages Template
 *
 *
 * @file           page-member.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page-member.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

  <div id="content" class="content sixteen columns member">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if ( get_the_content() ) : ?>
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

  <div class="clear"></div>

<?php

  if(rwmb_meta('editit_selectmembercolumn') == 'three'){
    $column = 'one-third';
  }elseif(rwmb_meta('editit_selectmembercolumn') == 'two'){
    $column = 'eight';
  }elseif(rwmb_meta('editit_selectmembercolumn') == 'one'){
    $column = 'sixteen';
  }else{
    $column = 'four';
  }

?>

  <div id="member-wrap" class="member-wrap">

  <?php
    $memberitems = rwmb_meta('editit_selectmemberitemsonpage');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
              'post_type'       => 'member',
              'posts_per_page'  => $memberitems,
              'post_status'     => 'publish',
              'order'           => 'ASC',
              'paged'           => $paged
    );

    $selectedcategories = rwmb_meta('editit_selectmembercategory');
    if($selectedcategories && $selectedcategories[0] == 0) {
      unset($selectedcategories[0]);
    }
    if($selectedcategories){
      $args['tax_query'][] = array(
                               'taxonomy'  => 'member_category',
                               'field'     => 'ID',
                               'terms'     => $selectedcategories
                             );
    }

    $bu_query = $wp_query;
    $wp_query = null; 
    $wp_query = new WP_Query($args);

    $custom_excerpt_length = 110;
    $readmore = false;
    if( rwmb_meta('editit_selectshowmemberexcerpt') ){ $showmemberexcerpt = true; }else{ $showmemberexcerpt = false; }

    while ( $wp_query->have_posts() ) : $wp_query->the_post();

      $link = '';

      if ( rwmb_meta( 'editit_selectmemberlinktosinglepage' )){
        $link = '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="link">';
      }else{
        $link = '<a href="' . wp_get_attachment_url( get_post_thumbnail_id() ) . '" title="' . get_the_title() . '" class="lightbox prettyPhoto" rel="prettyPhoto">';
      }

?>

    <article class='member-item <?php if( $showmemberexcerpt ){ echo 'showmemberexcerpt ';} ?><?php echo $column; ?> columns'>

      <div class='member-thumbnail'>
        <span class='pic'>

          <?php if(has_post_thumbnail()): ?>

            <?php echo $link; ?>
            <?php the_post_thumbnail('square'); ?>
            </a>

          <?php else: ?>

            <img src="<?php bloginfo('template_directory'); ?>/framework/images/square-noimage.png">

          <?php endif; ?>

        </span>
      </div>


      <div class="member-content">
        <div class="member-content-header">
          <div class="member-title">
            <h2>
            <?php if(rwmb_meta('editit_selectmemberlinktosinglepage')): ?>
              <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a>
            <?php else: ?>
              <?php the_title(); ?>
            <?php endif; ?>
            </h2>
            <h3>
              <?php echo rwmb_meta('editit_textmemberpositiontext'); ?>
            </h3>
          </div>
        </div>

        <?php if( $showmemberexcerpt ) : ?>
        <div class="member-excerpt">
          <?php echo get_the_excerpt(); ?>
          <div class="clear"></div>
        </div>
        <?php endif; ?>

        <div class="member-content-footer">
          <div class="member-social">
            <ul class="social-icons clearfix">
              <?php if( rwmb_meta('editit_textmembertwittertext') != '' ): ?>
              <li class="social-twitter">
                <a href="<?php echo rwmb_meta('editit_textmembertwittertext'); ?>" title="<?php _e( 'Twitter', 'editit' ) ?>" target="_blank"><i class="icon icon-twitter"></i></a>
              </li>
              <?php endif; ?>

              <?php if( rwmb_meta('editit_textmemberfacebooktext') != '' ): ?>
              <li class="social-facebook">
                <a href="<?php echo rwmb_meta('editit_textmemberfacebooktext'); ?>" title="<?php _e( 'Facebook', 'editit' ) ?>" target="_blank"><i class="icon icon-facebook-square"></i></a>
              </li>
              <?php endif; ?>

              <?php if( rwmb_meta('editit_textmembergoogleplustext') != '' ): ?>
              <li class="social-googleplus">
                <a href="<?php echo rwmb_meta('editit_textmembergoogleplustext'); ?>" title="<?php _e( 'Google+', 'editit' ) ?>" target="_blank"><i class="icon icon-google-plus-square"></i></a>
              </li>
              <?php endif; ?>

              <?php if( rwmb_meta('editit_textmemberskypetext') != '' ): ?>
              <li class="social-skype">
                <a href="<?php echo rwmb_meta('editit_textmemberskypetext'); ?>" title="<?php _e( 'Skype', 'editit' ) ?>" target="_blank"><i class="icon icon-skype"></i></a>
              </li>
              <?php endif; ?>

              <?php if( rwmb_meta('editit_emailmemberemail') != '' ): ?>
              <li class="social-email">
                <a href="mailto:<?php echo rwmb_meta('editit_emailmemberemail'); ?>" title="<?php _e( 'Email', 'editit' ) ?>" target="_blank"><i class="icon icon-envelope-o"></i></a>
              </li>
              <?php endif; ?>

              <?php if( rwmb_meta('editit_urlmemberwebsiteurl') != '' ): ?>
              <li class="social-url">
                <a href="<?php echo rwmb_meta('editit_urlmemberwebsiteurl'); ?>" title="<?php _e( 'Website', 'editit' ) ?>" target="_blank"><i class="icon icon-link"></i></a>
              </li>
              <?php endif; ?>

            </ul>
          </div>
        </div>

      </div>
    </article>

    <?php endwhile; ?>

  </div><!-- end of .member-wrap -->

  <div class="sixteen columns">
    <?php get_template_part( 'framework/inc/nav' ); ?>
  </div>

</div> <!-- end of .page-wrap -->

<?php get_footer(); ?>