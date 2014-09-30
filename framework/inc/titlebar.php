<?php
/**
 * Titlebar
 *
 *
 * @file           titlebar.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/titlebar.php
 */
?>
<?php global $smof_data; ?>

<?php if (is_home()): ?>

  <div id="no-titlebar-divider" class="no-titlebar-divider"></div>

<?php elseif (is_singular('post') || is_singular('news') ):// single post ?>

  <div id="titlebar" class="titlebar no-summary">
    <div class="container">
      <div class="<?php if($smof_data['switch_breadcrumbs']){ echo 'ten'; }else{ echo 'sixteen';} ?> columns clearfix">
        <h1>
          <span class="main"><?php the_title(); ?></span>
        </h1>
      </div>
      <?php if($smof_data['switch_breadcrumbs']) : ?>
      <div id="breadcrumbs" class="breadcrumbs six columns">
        <?php editit_breadcrumbs(); ?>
      </div><!-- end of .breadcrumbs -->
      <?php endif; ?>
    </div>
  </div><!-- end of .titlebar -->

<?php elseif ( is_singular('portfolio') || is_singular('event') || is_singular('menu') || is_singular('member') || is_page() ):// single portfolio, single event, single member, single menu, page ?>

  <?php if (rwmb_meta('editit_titlebar') == 'notitlebar') : ?>

    <div id="no-titlebar-divider" class="no-titlebar-divider"></div>

  <?php elseif (rwmb_meta('editit_titlebar') == 'breadcrumbs') : ?>

    <div id="no-titlebar" class="no-titlebar">
      <div class="container">
        <div id="breadcrumbs" class="breadcrumbs sixteen columns">
          <?php  editit_breadcrumbs(); ?>
        </div><!-- end of .breadcrumbs -->
      </div>
    </div><!-- end of .no-titlebar -->

  <?php elseif(rwmb_meta('editit_titlebar') == 'revslider') : ?>

  <div id="titlebar-revslider" class="titlebar-revslider">
    <div class="container">
      <div class="sixteen columns">
        <?php if(class_exists('RevSlider')){ putRevSlider(rwmb_meta('editit_revolutionslider')); } ?>
      </div>
    </div>
  </div><!-- end of .titlebar-revslider -->

  <?php elseif(rwmb_meta('editit_titlebar') == 'flexslider') : ?>

  <div id="titlebar-flexslider" class="titlebar-flexslider">
    <div class="container">
      <div class="sixteen columns">
        <?php echo do_shortcode('[wooslider slide_page="'.rwmb_meta('editit_flexslider').'" slider_type="slides" limit="5"]'); ?>
      </div>
    </div>
  </div><!-- end of .titlebar-flexslider -->

  <?php else: ?>

  <div id="titlebar" class="titlebar <?php if(rwmb_meta('editit_summary') == ''){ echo 'no-summary'; } ?>">
    <div class="container">
      <div class="<?php if($smof_data['switch_breadcrumbs']){ echo 'ten'; }else{ echo 'sixteen';} ?> columns clearfix">
        <h1>
          <span class="main"><?php the_title(); ?></span><?php if (rwmb_meta('editit_subtitle')) : ?><?php echo '<span class="sub">' . rwmb_meta('editit_subtitle') . '</span>'; ?><?php endif; ?>
        </h1>
        <?php if (rwmb_meta('editit_summary')) : ?><h2><?php echo rwmb_meta('editit_summary'); ?></h2><?php endif; ?>
      </div>
      <?php if($smof_data['switch_breadcrumbs']) : ?>
      <div id="breadcrumbs" class="breadcrumbs six columns <?php if(rwmb_meta('editit_summary')){ echo 'breadcrumbpadding'; } /* to align middle */ ?>">
        <?php editit_breadcrumbs(); ?>
      </div><!-- end of .breadcrumbs -->
      <?php endif; ?>
    </div>
  </div><!-- end of .titlebar -->

  <?php endif; ?>

<?php elseif ( is_search() ):// search ?>

  <div id="titlebar" class="titlebar">
    <div class="container">
      <div class="<?php if($smof_data['switch_breadcrumbs']){ echo 'ten'; }else{ echo 'sixteen';} ?> columns clearfix">
        <h1>
          <span class="main"><?php _e('Search Results for', 'editit') ?> &#34;<?php the_search_query(); ?>&#34;</span>
        </h1>
      </div>
      <?php if($smof_data['switch_breadcrumbs']) : ?>
      <div id="breadcrumbs" class="breadcrumbs six columns">
        <?php editit_breadcrumbs(); ?>
      </div><!-- end of .breadcrumbs -->
      <?php endif; ?>
    </div>
  </div><!-- end of .titlebar -->

<?php elseif ( is_archive()):// archive ?>

  <?php if(get_post_type() == 'post') : ?>

  <div id="titlebar" class="titlebar">
    <div class="container">
      <div class="<?php if($smof_data['switch_breadcrumbs']){ echo 'ten'; }else{ echo 'sixteen';} ?> columns clearfix">
        <h1>
          <span class="main">
        <?php if (is_category()) : ?>
          <?php _e('Archive by Category', 'editit') ?> &#34;<?php single_cat_title(); ?>&#34;
        <?php elseif(is_tag()) : ?>
          <?php _e('Archive by Tagged', 'editit') ?> &#34;<?php single_tag_title(); ?>&#34;
        <?php elseif(is_day()) : ?>
          <?php _e('Archive for', 'editit') ?> <?php the_time('Y/m/d'); ?>
        <?php elseif(is_month()) : ?>
          <?php _e('Archive for', 'editit') ?> <?php the_time('Y/m'); ?>
        <?php elseif(is_year()) : ?>
          <?php _e('Archive for', 'editit') ?> <?php the_time('Y'); ?>
        <?php elseif(is_author()) : ?>
          <?php _e('Author Archive', 'editit') ?>
        <?php elseif(isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
          <?php _e('Archive', 'editit') ?>
        <?php endif; ?>
          </span>
        </h1>
      </div>
      <?php if($smof_data['switch_breadcrumbs']) : ?>
      <div id="breadcrumbs" class="breadcrumbs six columns">
        <?php editit_breadcrumbs(); ?>
      </div><!-- end of .breadcrumbs -->
      <?php endif; ?>
    </div>
  </div><!-- end of .titlebar -->

  <?php elseif(get_post_type() == 'news') : ?>

  <div id="titlebar" class="titlebar">
    <div class="container">
      <div class="<?php if($smof_data['switch_breadcrumbs']){ echo 'ten'; }else{ echo 'sixteen';} ?> columns clearfix">
        <h1>
          <span class="main">
        <?php if (is_tax('news_category') ) : ?>
          <?php _e('Archive by Category', 'editit') ?> &#34;<?php single_cat_title(); ?>&#34;
        <?php elseif(is_tax('news_tag')) : ?>
          <?php _e('Archive by Tagged', 'editit') ?> &#34;<?php single_tag_title(); ?>&#34;
        <?php elseif(is_day()) : ?>
          <?php _e('Archive for', 'editit') ?> <?php the_time('Y/m/d'); ?>
        <?php elseif(is_month()) : ?>
          <?php _e('Archive for', 'editit') ?> <?php the_time('Y/m'); ?>
        <?php elseif(is_year()) : ?>
          <?php _e('Archive for', 'editit') ?> <?php the_time('Y'); ?>
        <?php elseif(is_author()) : ?>
          <?php _e('Author Archive', 'editit') ?>
        <?php elseif(isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
          <?php _e('Archive', 'editit') ?>
        <?php endif; ?>
          </span>
        </h1>
      </div>
      <?php if($smof_data['switch_breadcrumbs']) : ?>
      <div id="breadcrumbs" class="breadcrumbs six columns">
        <?php editit_breadcrumbs(); ?>
      </div><!-- end of .breadcrumbs -->
      <?php endif; ?>
    </div>
  </div><!-- end of .titlebar -->

  <?php endif; ?>

<?php endif; ?>