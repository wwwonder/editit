<?php
/**
 * Widget : Recent Posts
 *
 *
 * @file           recent-posts.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/widgets/recent-posts.php
 */
?>
<?php

class Widget_Recent_Posts extends WP_Widget {

  /* -- Register widget with WordPress. -- */
  function __construct() {
    parent::__construct(
      'recent_posts', // Base ID
      __('1.[editit] Recent Posts', 'editit'), // Name
      array( 'description' => __( 'Most Recent Posts', 'editit' ), ) // Args
    );
  }


  /* -- Widget Output -- */
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $category = $instance['category'];

    // create wp_query to get latest items
    $args = array(
              'post_type'            => 'post',
              'orderby'              => 'date',
              'order'                => 'DESC',
              'post_status'          => 'publish',
              'posts_per_page'       => $instance["number"],
              'ignore_sticky_posts'  => 1,
            );

    if($category && $category != 0) {

        $args['tax_query'][] = array(
                                 'taxonomy'  => 'category',
                                 'field'     => 'ID',
                                 'terms'     => $category
                               );

    }


    $th_query = null;
    $th_query = new WP_Query($args);

    echo $before_widget;

    if (!empty($title)) { echo $before_title . $title . $after_title; }

    echo '<ul class="widget-recent-post">';

    if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post(); ?>

      <li>
        <?php if($instance['show_date'] != "no" ) : ?>
        <time datetime="<?php the_time('Y-m-d')?>" title="<?php the_time('Y-m-d')?>"><?php the_time(get_option('date_format')); ?></time><br>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a>
      </li>

    <?php endwhile; endif;
    wp_reset_query();

    echo '</ul>';

    echo $after_widget;

  }


  /* -- Widget Update -- */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['category'] = $new_instance['category'];
    $instance['number'] = $new_instance['number'];
    $instance['show_date'] = $new_instance['show_date'];
    return $instance;
  }


  /* -- Widget Backend Form -- */
  function form($instance) {
    
    $defaults = array(
                  'title'     => __('Recent Posts', 'editit'),
                  'category'  => 0,
                  'number'    => 4,
                  'show_date' => 'yes'
                );
    $instance = wp_parse_args((array) $instance, $defaults);


  ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category', 'editit'); ?>:</label>
      <select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>" value="<?php echo $instance['category']; ?>" style="width:97%;">

    <?php
        echo '<option ' .(($instance['category'] == 0)?'selected="selected"':'' ). ' value="0">' . __('All categories', 'editit') . '</option>';
        $post_categories = get_categories('hide_empty=0');
        if($post_categories) {
          foreach($post_categories as $post_category) {
            echo '<option ' .(($instance['category'] == $post_category->term_id)?'selected="selected"':'' ). ' value="' . $post_category->term_id . '">'. $post_category->name .'</option>';
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

    <p>
      <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display Date', 'editit'); ?>:</label>
      <select name="<?php echo $this->get_field_name('show_date'); ?>" id="<?php echo $this->get_field_id('show_date'); ?>" value="<?php echo $instance['show_date']; ?>" style="width:97%;">
        <option value="yes" <?php  echo (($instance['show_date'] == 'yes')?'selected="selected"':'' ); ?>><?php _e('Yes', 'editit'); ?></option>
        <option value="no"  <?php  echo (($instance['show_date'] == 'no')?'selected="selected"':'' ); ?>><?php _e('No', 'editit'); ?></option>
      </select>
    </p>

  <?php
  }

}


/* -- register Widget_Recent_Posts widget -- */
function register_widget_recent_posts() {
  register_widget( 'Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'register_widget_recent_posts' );

?>