<?php
/**
 * Single News Template
 *
 *
 * @file           single-news.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/single-news.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

<?php $select_sidebar = $smof_data['select_newssidebar']; ?>

  <div id="content" class="content <?php echo $select_sidebar; if($select_sidebar != 'no-sidebar'){ echo ' twelve'; }else{ echo ' sixteen'; } ?> columns single">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="post clearfix">

      <?php if ( has_post_thumbnail() ) : ?>
      <div class="post-image">
        <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
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
          <?php the_content(); ?>
          <div class="clear"></div>
        </div>

        <div class="post-content-footer">
          <div class="post-meta">
            <div class="post-tags clearfix"><?php the_terms( $post->ID, 'news_tag', '', ''  ); ?></div>
          </div>
        </div>

      </div>

    </article>

    <?php if( $smof_data['switch_newssharebox'] ) : ?>
      <?php get_template_part( 'framework/inc/sharebox' ); ?>
    <?php endif; ?>

    <?php if( $smof_data['switch_newsauthorinfo'] ) : ?>
      <?php get_template_part( 'framework/inc/author' ); ?>
    <?php endif; ?>

    <?php if( $smof_data['switch_newsrelatedposts'] ) : ?>

      <?php
        $terms = get_the_terms( $post->ID , 'news_tag', 'string');
        if($terms) :
      ?>

      <div id="related-posts" class="related-posts">
        <h3 class="headline"><span><?php _e('Related News', 'editit'); ?></span></h3>
        <ul>

        <?php

          $term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
          $my_query = new WP_Query( array(
                                      'post_type'           => 'news',
                                      'tax_query'           => array(
                                                                 array(
                                                                   'taxonomy' => 'news_tag',
                                                                   'field'    => 'id',
                                                                   'terms'    => $term_ids,
                                                                   'operator' => 'IN'
                                                                 )
                                                               ),
                                      'posts_per_page'      => 4,
                                      'ignore_sticky_posts' => 1,
                                      'orderby'             => 'date',
                                      'post__not_in'        => array($post->ID)
                                    )
                      );

          if( $my_query->have_posts() ) :
            while ($my_query->have_posts()) : $my_query->the_post();

        ?>
          <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?> <span>(<?php the_time(get_option('date_format')); ?>)</span></a></li>
        <?php

            endwhile;
            wp_reset_query();
          endif;

        ?>

        </ul>
      </div><!-- end of .related-posts -->

      <?php endif; ?>

    <?php endif; ?>

    <div id="comments" class="comments"><?php comments_template(); ?></div>
    
    <div class="post-navigation">
      <div class="alignleft prev"><?php previous_post_link('%link', __('Prev Post', 'editit'), FALSE); ?></div>
      <div class="alignright next"><?php next_post_link('%link', __('Next Post', 'editit'), FALSE); ?> </div>
    </div>
  
    <?php endwhile; endif; ?>
  
  </div><!-- end of .content -->

<?php if($select_sidebar != 'no-sidebar') : ?>
  <?php get_sidebar(); ?>
<?php endif; ?>

</div><!-- end of .page-wrap -->

<?php get_footer(); ?>