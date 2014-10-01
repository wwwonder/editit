<?php
/**
 * Widget : Recent Portfolio
 *
 *
 * @file           recent-portfolio.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/widgets/recent-portfolio.php
 */
?>
<?php

class Widget_Recent_Portfolio extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'recent_portfolio', // Base ID
      __('3.[editit] Recent Portfolio', 'editit'), // Name
      array( 'description' => __( 'Most Recent Portfolio', 'editit' ), ) // Args
    );
  }


  // Widget Output
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $number = $instance['number'];
    $category = $instance['category'];

    echo $before_widget;
    echo '<div class="clearfix">';

    if (!empty($title)) { echo $before_title . $title . $after_title; }

    $args = array(
      'post_type'      => 'portfolio',
      'order'          => 'ASC',
      'posts_per_page' => $number
    );

    if($category && $category != 0) {
        $args['tax_query'][] = array(
                                 'taxonomy'  => 'portfolio_category',
                                 'field'     => 'ID',
                                 'terms'     => $category
                               );
    }

    $portfolio = null;
    $portfolio = new WP_Query($args);
    if($portfolio->have_posts()): ?>

   <div class="portfolio-widget-item-wrapper">

    <?php while($portfolio->have_posts()): $portfolio->the_post(); ?>

    <div class="portfolio-widget-item">

    <?php if (has_post_thumbnail()) : ?>

      <?php if( rwmb_meta( 'editit_selectportfoliolinktosinglepage' ) ) : ?>
      <a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>" class="portfolio-pic" rel="bookmark">
        <?php the_post_thumbnail( 'square-mini' ); ?>
      </a>
      <?php else: ?>
        <?php the_post_thumbnail( 'square-mini' ); ?>
      <?php endif; ?>

    <?php endif; ?>

    </div>

    <?php endwhile; ?>

   </div>

    <?php endif; ?>

    <?php 
    wp_reset_query();

    echo '</div>';
    echo $after_widget;

  }


  // Update
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['category'] = $new_instance['category'];
    $instance['number'] = $new_instance['number'];
    return $instance;
  }


  // Backend Form
  function form($instance) {
    
    $defaults = array(
                  'title'    => __('Recent Portfolio', 'editit'),
                  'category' => 0,
                  'number'   => 6
                );
    $instance = wp_parse_args((array) $instance, $defaults);

    // PORTFOLIO FILTER ARRAY
    $portfolio_categories = get_terms('portfolio_category', 'hide_empty=0');
    $portfolio_category_array[0] = 'All categories';
    if($portfolio_categories) {
      foreach($portfolio_categories as $portfolio_category) {
        $portfolio_category_array[$portfolio_category->term_id] = $portfolio_category->name;
      }
    }

  ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category', 'editit'); ?>:</label>
      <select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>" value="<?php echo $instance['category']; ?>" style="width:97%;">
    <?php
        echo '<option ' .(($instance['category'] == 0)?'selected="selected"':'' ). ' value="0">' , __('All categories', 'editit') , '</option>';
        $portfolio_categories = get_terms('portfolio_category', 'hide_empty=0');
        if($portfolio_categories) {
          foreach($portfolio_categories as $portfolio_category) {

            echo '<option ' .(($instance['category'] == $portfolio_category->term_id)?'selected="selected"':'' ). ' value="' . $portfolio_category->term_id . '">'. $portfolio_category->name .'</option>';

          }
        }
    ?>

      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Items to Show', 'editit'); ?>:</label>
      <select name="<?php echo $this->get_field_name('number'); ?>" id="<?php echo $this->get_field_id('number'); ?>" value="<?php echo $instance['number']; ?>" style="width:97%;">
      <?php
        for($i = 1; $i <= 20; $i++) {
         echo '<option value="' . $i . '" ' .(($instance['number'] == $i)?'selected="selected"':'' ). '>' . $i . '</option>';
        }
      ?>
      </select>
    </p>

  <?php
  }

}


// register Widget_Recent_Portfolio widget
function register_widget_recent_portfolio() {
    register_widget( 'Widget_Recent_Portfolio' );
}
add_action( 'widgets_init', 'register_widget_recent_portfolio' );

?>