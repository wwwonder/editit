<?php
/**
 * Portfolio Single Template
 *
 *
 * @file           single-portfolio.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/single-portfolio.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container portfolio-detail">

  <div id="content" class="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php
      if ( rwmb_meta( 'editit_selectportfoliosinglelayout', get_the_ID()) == "mediaonleft" ) {
        get_template_part( 'framework/inc/portfolio/media-on-left' );
      } else if ( rwmb_meta( 'editit_selectportfoliosinglelayout', get_the_ID()) == "mediaonright" ) {
        get_template_part( 'framework/inc/portfolio/media-on-right' );
      }else{
        get_template_part( 'framework/inc/portfolio/fullmedia-on-top' );
      }
    ?>

    <?php if( $smof_data['switch_portfoliorelatedportfolio'] ) : // Show related Posts Portfolio specific ?>

    <div class="clear"></div>
    <div id="portfolio-related-post" class="portfolio-related-post clearfix">
      <h3 class="headline sixteen columns"><span><?php if($smof_data['text_portfoliorelatedportfoliolabel']){ echo $smof_data['text_portfoliorelatedportfoliolabel']; }else{ _e('Related Portfolio', 'editit'); } ?></span></h3>

      <?php
        $terms = get_the_terms( $post->ID , 'portfolio_category');
        $term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
        $second_query = new WP_Query( array(
                                        'post_type'           => 'portfolio',
                                        'tax_query'           => array(
                                                                   array(
                                                                     'taxonomy' => 'portfolio_category',
                                                                     'field'    => 'id',
                                                                     'terms'    => $term_ids,
                                                                     'operator' => 'IN'
                                                                   )
                                                                 ),
                                        'posts_per_page'      => 4,
                                        'ignore_sticky_posts' => 1,
                                        'orderby'             => 'date',
                                        'post__not_in'        =>array($post->ID)
                                      )
                        );

        if($second_query->have_posts()) :

          $custom_excerpt_length = 15;
          $readmore = false;

            while ($second_query->have_posts() ) : $second_query->the_post();

              $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
              $link = '';
              $embed = '';

              if ( rwmb_meta( 'editit_selectportfoliolinktolightbox' )) :
      
                if( rwmb_meta( 'editit_selectportfoliomedia' ) == "video" && rwmb_meta( 'editit_textareavideoembed' ) != "") :
      
                  $randomid = rand();
                  $link = '<a href="#embed-video-' . $randomid . '" class="lightbox prettyPhoto" title="'. get_the_title() .'" rel="prettyPhoto[portfolio]">';
                  $embed = '<div id="embed-video-'.$randomid.'" class="embed-video">' . rwmb_meta( 'editit_textareavideoembed' ) . '</div>';
      
                else:
      
                  $link = '<a href="'. wp_get_attachment_url( get_post_thumbnail_id() ) .'" class="lightbox prettyPhoto" rel="prettyPhoto[portfolio]" title="'. get_the_title() .'">';
                  $embed = '';
      
                endif;
      
              else:
      
                if ( rwmb_meta( 'editit_selectportfoliolinktosinglepage' )){
                  $link = '<a href="' . get_permalink() . '" title="' . sprintf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ) . '" class="link">';
                }
      
              endif;

      ?>

      <article class='portfolio-item four showportfoliotitle columns'>

        <?php if ( has_post_thumbnail()): ?>
        <div class='portfolio-thumbnail'>
          <span class='pic'>
            <?php echo $link; ?>
            <?php the_post_thumbnail('portfolio'); ?>
            </a>
          </span>
        </div>
        <?php endif; ?>

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

        </div>

        <?php echo $embed; ?>

      </article>

        <?php endwhile; wp_reset_query(); ?>
      <?php endif; //end $second_query ?>

    </div><!-- end of .portfolio-related-posts -->

    <?php endif; //end related specific ?>

    <?php endwhile; endif; ?>

  </div><!-- end of .content -->

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>
