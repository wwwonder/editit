<?php
/**
 * Page Template
 *
 *
 * @file           page.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/page.php
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="page-wrap container <?php if(!rwmb_meta('editit_selectshowpagecontents')){ echo 'hidden'; } ?>">

<?php $select_sidebar = rwmb_meta('editit_selectsidebar'); ?>

  <div id="content" class="content <?php echo $select_sidebar; if($select_sidebar != 'no-sidebar'){ echo ' twelve'; }else{ echo ' sixteen'; } ?> columns">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry">
        <?php the_content(); ?>
        <div class="clear"></div>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
      </div>
    </article>

    <?php comments_template(); ?>

    <?php endwhile; endif; ?>

  </div> <!-- end of .content -->

  <?php if($select_sidebar != 'no-sidebar') : ?>
    <?php get_sidebar(); ?>
  <?php endif; ?>

</div> <!-- end of .page-wrap -->

<?php get_footer(); ?>