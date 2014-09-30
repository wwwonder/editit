<?php
/**
 * Single Template
 *
 *
 * @file           single.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/index.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container">

<?php $select_sidebar = $smof_data['select_postsidebar']; ?>

  <div id="content" class="content <?php echo $select_sidebar; if($select_sidebar != 'no-sidebar'){ echo ' twelve'; }else{ echo ' sixteen'; } ?> columns single">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <?php get_template_part( 'framework/inc/post-format/single', get_post_format() ); ?>

      <?php if($smof_data['switch_postsharebox']) : ?>
        <?php get_template_part( 'framework/inc/sharebox' ); ?>
      <?php endif; ?>

      <?php if($smof_data['switch_postauthorinfo']) : ?>
        <?php get_template_part( 'framework/inc/author' ); ?>
      <?php endif; ?>

      <?php if($smof_data['switch_postrelatedposts']) : ?>

      <?php
        $tags = wp_get_post_tags($post->ID);
        if ($tags) :
      ?>

        <?php
          $first_tag = $tags[0]->term_id;
          $args = array(
                    'tag__in'      => array($first_tag),
                    'post__not_in' => array($post->ID),
                    'showposts'    => 3
                  );
          $my_query = new WP_Query($args);
          if( $my_query->have_posts() ) :

      ?>
      <div id="related-posts" class="related-posts">
        <h3 class="headline"><span><?php _e('Related Posts', 'editit'); ?></span></h3>
        <ul>

          <?php
              while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?><span>(<?php the_time(get_option('date_format')); ?>)</span></a></li>
                <?php
              endwhile;
              wp_reset_query();
          ?>
        </ul>
      </div><!-- end of .related-posts -->
      <?php
          endif;
        endif;
      endif;
      ?>


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