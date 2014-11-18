<?php
/**
 * Functions
 *
 *
 * @file           functions.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/functions.php
 */


/* ------------------------------------------------------------------------ */
/* 01.Translation
/* ------------------------------------------------------------------------ */

load_theme_textdomain( 'editit', get_template_directory() . '/framework/languages' );
$locale = get_locale();
$locale_file = get_template_directory() . "/framework/languages/$locale.php";
if ( is_readable($locale_file) ){
  require_once($locale_file);
}



/* ------------------------------------------------------------------------ */
/* 02.Inlcudes
/* ------------------------------------------------------------------------ */

/* -- Include SMOF -- */
require_once('admin/index.php'); // Slightly Modified Options Framework

/* -- Misc Includes -- */
include_once('framework/inc/enqueue.php');
include_once('framework/inc/customcss.php');
include_once('framework/inc/customjs.php');
include_once('framework/inc/meta-box.php');
include_once('framework/inc/breadcrumbs.php');
include_once('framework/inc/shortcodes.php');
include_once('framework/inc/sidebar-generator.php');
include_once('framework/inc/cpt-general.php');
include_once('framework/inc/cpt-news.php');
include_once('framework/inc/cpt-portfolio.php');
include_once('framework/inc/cpt-event.php');
include_once('framework/inc/cpt-menu.php');
include_once('framework/inc/cpt-faq.php');
include_once('framework/inc/cpt-member.php');

/* -- Widget Includes -- */
include_once('framework/inc/widgets/recent-posts.php');
include_once('framework/inc/widgets/recent-news.php');
include_once('framework/inc/widgets/recent-portfolio.php');
include_once('framework/inc/widgets/recent-event.php');
include_once('framework/inc/widgets/contact-info.php');
include_once('framework/inc/widgets/contact-form.php');
include_once('framework/inc/widgets/side-nav.php');
include_once('framework/inc/widgets/embed.php');



/* ------------------------------------------------------------------------ */
/* 03.Basics
/* ------------------------------------------------------------------------ */

/* -- Add Custom Primary Navigation -- */
function register_custom_menu() {
  register_nav_menu('main_navigation', 'Main Navigation');
}
add_action('init', 'register_custom_menu');


/* -- WP 3.1 Post Formats -- */
add_theme_support( 'post-formats', array('gallery', 'link', 'quote', 'audio', 'video'));  


/* -- Post Thumbnails -- */
if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) {

  // Reserved Image Size Names : thumb, thumbnail, medium, large, post-thumbnail
  add_image_size( 'standard-full', 940, 400, true );    // for Blog Full No Sidebar
  add_image_size( 'standard', 700, 300, true );         // for Blog Full With Sidebar
  add_image_size( 'half-full', 470, 300, true );        // for Blog Medium No Sidebar
  add_image_size( 'half', 350, 220, true );             // for Blog Medium With Sidebar
  add_image_size( 'portfolio', 940, 684, true );        // used for portfolio : 940x684,460x335,300x218,220x160
  add_image_size( 'portfolio-full', 940, 475, true );   // used for portfolio single full
  add_image_size( 'portfolio-medium', 580, 350, true ); // used for portfolio single medium
  add_image_size( 'square-full', 940, 940, true );      // used for menu
  add_image_size( 'square', 460, 460, true );           // used for menu
  add_image_size( 'square-mini', 70, 70, true );        // used for widget thumbnail  (portfolio 63px,)

}



/* ------------------------------------------------------------------------ */
/* 04.Sidebar Register
/* ------------------------------------------------------------------------ */

/* -- Register Sidebar -- */
if (function_exists('register_sidebar')) {

  /* -- Blog Widgets -- */
  register_sidebar(array(
    'name' => __('Blog Widgets','editit' ),
    'id'   => 'blog-widgets',
    'description'   => __( 'These are widgets for the Blog sidebar.','editit' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="title headline"><span>',
    'after_title'   => '</span></h3>'
  ));

  /* -- News Widgets -- */
  register_sidebar(array(
    'name' => __('News Widgets','editit' ),
    'id'   => 'news-widgets',
    'description'   => __( 'These are widgets for the News sidebar.','editit' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="title headline"><span>',
    'after_title'   => '</span></h3>'
  ));


  if (isset($smof_data['select_footercolumns'])) {
    if($smof_data['select_footercolumns'] == "4"){ $footercolumns = "four"; }
    elseif($smof_data['select_footercolumns'] ==  "3"){ $footercolumns = "one-third"; }
    elseif($smof_data['select_footercolumns'] ==  "2"){ $footercolumns = "eight"; }
    elseif($smof_data['select_footercolumns'] ==  "1"){ $footercolumns = "sixteen"; }
    else{$footercolumns = "four";}
  }else{
    $footercolumns = "four";
  }

  /* -- Footer Widgets -- */
  register_sidebar(array(
    'name' => __('Footer Widgets','editit' ),
    'id'   => 'footer-widgets',
    'description'   => __( 'These are widgets for the Footer.','editit' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s '.$footercolumns.' columns">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ));

}



/* ------------------------------------------------------------------------ */
/* 05.Admin Area Customize
/* ------------------------------------------------------------------------ */

/* -- Add some user contact fields -- */
function editit_user_contactmethods($user_contactmethods){
  $user_contactmethods['twitter']    = 'Twitter';
  $user_contactmethods['facebook']   = 'Facebook ';
  $user_contactmethods['googleplus'] = 'Google+';
  $user_contactmethods['skype']      = 'Skype';
  $user_contactmethods['skills']     = 'Skills';
  return $user_contactmethods;
}
add_filter('user_contactmethods', 'editit_user_contactmethods');



/* ------------------------------------------------------------------------ */
/* Tips 
/* ------------------------------------------------------------------------ */

/* -- Custom Excerpt Length -- */
function new_excerpt_length($length) {
  global $custom_excerpt_length;
  return $custom_excerpt_length;
}
add_filter('excerpt_length', 'new_excerpt_length', 999 );


/* -- Changing excerpt more -- */
function new_excerpt_more($more) {
  global $smof_data;
  global $post;
  global $readmore;
  if($readmore){
    return ' … <a href="'. get_permalink($post->ID) . '" class="read-more-link">' . '' . __('read more', 'editit') . '</a>';
  }else{
    return ' …';
  }
}
add_filter('excerpt_more', 'new_excerpt_more');


/* -- Pagination -- */
function editit_pagination($pages = '', $range = 2) {
  $showitems = ($range * 2)+1;
  global $paged;
  if(empty($paged)) $paged = 1;
  if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages) {
      $pages = 1;
    }
  }
  if($pages != 1) {
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
    if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
    for ($i=1; $i <= $pages; $i++) {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
        echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
      }
    }
    if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
  }
}


/* -- Remove Meta Generator -- */
if ( has_action( 'wp_head', 'wp_generator' ) ){
  remove_action( 'wp_head', 'wp_generator' );
}

foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
  if ( has_action( $action, 'the_generator' ) ){
    remove_action( $action, 'the_generator' );
  }
}



/* -- Remove hentry class from post_class()  -- */
function remove_hentry( $classes ) {
    $classes = array_diff($classes, array('hentry'));
    return $classes;
}
add_filter('post_class', 'remove_hentry');



/* -- Remove Recent Comments Inline Style -- */
function remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );


/* -- Removes div from wp_page_menu() and replace with ul. -- */
function editit_wp_page_menu ($page_markup) {
  preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
  $divclass = $matches[1];
  $replace = array('<div class="'.$divclass.'">', '</div>');
  $new_markup = str_replace($replace, '', $page_markup);
  $new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
  return $new_markup; 
}
add_filter('wp_page_menu', 'editit_wp_page_menu');



/**
 * This function removes .menu class from custom menus
 * in widgets only and fallback's on default widget lists
 * and assigns new unique class called .menu-widget
 * 
 * Marko Heijnen Contribution
 *
 */
class editit_widget_menu_class {
  public function __construct() {
    add_action( 'widget_display_callback', array( $this, 'menu_different_class' ), 10, 2 );
  }
 
  public function menu_different_class( $settings, $widget ) {
    if( $widget instanceof WP_Nav_Menu_Widget )
      add_filter( 'wp_nav_menu_args', array( $this, 'wp_nav_menu_args' ) );
 
    return $settings;
  }
 
  public function wp_nav_menu_args( $args ) {
    remove_filter( 'wp_nav_menu_args', array( $this, 'wp_nav_menu_args' ) );
 
    if( 'menu' == $args['menu_class'] )
      $args['menu_class'] = 'menu-widget';
 
    return $args;
  }
}

new editit_widget_menu_class();



/* -- Comments Template -- */
function editit_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <li>
    <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <?php echo get_avatar($comment,'54', '' ); ?>
      <header class="comment-author vcard">
        <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
        <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'editit'), get_comment_date(),  get_comment_time()) ?></a></time>
        <?php if ($comment->comment_approved == '0') : ?>
        <em><?php _e('Your comment is awaiting moderation.', 'editit') ?></em>
        <br />
        <?php endif; ?>
        <?php edit_comment_link(__('(Edit)', 'editit'),'  ','') ?>
      </header>
      <div class="comment-body">
        <?php comment_text() ?>
      </div>
      <nav>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </nav>
    </article>
  <!-- </li> is added by wordpress automatically -->
<?php
}


/* -- custom Home Text -- */
function custom_wp_page_menu_args($args) {
  global $smof_data;
  if($smof_data['text_hometext']){
    $args['show_home'] = $smof_data['text_hometext'];
  }else{
    $args['show_home'] = 'Home';
  }
  return $args;
}
add_filter( 'wp_page_menu_args', 'custom_wp_page_menu_args' );


/* ------------------------------------------------------------------------ */
/* Event Calendar
/* ------------------------------------------------------------------------ */

add_action( 'wp_footer', 'editit_add_ajax_script_for_event_calendar' );

function editit_add_ajax_script_for_event_calendar() {
  global $pagetype;
  if(is_page_template('page-event.php') && $pagetype == 'calendar') {
    global $smof_data;
    ?>
    <script>
      //<![CDATA[

      var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
      jQuery(function($){

      <?php // Day of the opening  Defalt:1 Monday ?>
      <?php if($smof_data['select_dayoftheopening']): ?>
        <?php if($smof_data['select_dayoftheopening'] == 'Sunday'): ?>$.Calendario.defaults.startIn = 0;<?php endif; ?>
        <?php if($smof_data['select_dayoftheopening'] == 'Monday'): ?>$.Calendario.defaults.startIn = 1;<?php endif; ?>
        <?php if($smof_data['select_dayoftheopening'] == 'Tuesday'): ?>$.Calendario.defaults.startIn = 2;<?php endif; ?>
        <?php if($smof_data['select_dayoftheopening'] == 'Wednesday'): ?>$.Calendario.defaults.startIn = 3;<?php endif; ?>
        <?php if($smof_data['select_dayoftheopening'] == 'Thursday'): ?>$.Calendario.defaults.startIn = 4;<?php endif; ?>
        <?php if($smof_data['select_dayoftheopening'] == 'Friday'): ?>$.Calendario.defaults.startIn = 5;<?php endif; ?>
        <?php if($smof_data['select_dayoftheopening'] == 'Saturday'): ?>$.Calendario.defaults.startIn = 6;<?php endif; ?>
      <?php endif; ?>

      <?php // Name of the month  Defalt:false ?>
      <?php if($smof_data['select_nameofthemonth']): ?>
        <?php if($smof_data['select_nameofthemonth'] == 'English Abbreviate'): ?>$.Calendario.defaults.displayMonthAbbr = true;<?php endif; ?>
      <?php endif; ?>

      <?php // Name of the day  ?>
      <?php if($smof_data['select_nameoftheday']): ?>
        <?php if($smof_data['select_nameoftheday'] == 'English Abbreviate'): ?>$.Calendario.defaults.displayWeekAbbr = true;<?php endif; ?>
        <?php if($smof_data['select_nameoftheday'] == 'Japanese'): ?>$.Calendario.defaults.weeks = [ '日', '月', '火', '水', '木', '金', '土' ];<?php endif; ?>
      <?php endif; ?>


        var cal = $( '#calendar' ).calendario( {
          onDayClick : function( $el, $contentEl, dateProperties ) {
            for( var key in dateProperties ) {
              console.log( key + ' = ' + dateProperties[ key ] );
            }
          }
        } ),
        $month_num = $( '#month-num' ).html( cal.getMonth() ),
        $month_name_year_num = $( '#month-name-year-num' ).html( cal.getMonthName() + '<br>' + cal.getYear());


        $( '#next-month' ).on( 'click', function() {
          cal.gotoNextMonth( updateMonthYear );
        } );
        $( '#prev-month' ).on( 'click', function() {
          cal.gotoPreviousMonth( updateMonthYear );
        } );
        $( '#current-month' ).on( 'click', function() {
          cal.gotoNow( updateMonthYear );
        } );

        function updateMonthYear() {        
          $month_num.html( cal.getMonth() );
          $month_name_year_num.html( cal.getMonthName() + '<br>' + cal.getYear());
        }


        <?php // Default Event Data View
        $jsondata = editit_show_event_calendar();
        $jsondata = json_encode($jsondata);
        ?>

        cal.setData(<?php echo $jsondata ?>);

        // Click Event
        $('#prev-month,#next-month,#current-month').click(function(){

          jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
              "action": "editit_show_event_calendar",
              "year": cal.getYear(),
              "month": cal.getMonth()
            },
            success: function(data){
              cal.setData(data);
              var json_str = JSON.stringify(data);
              $("#dataview").html(json_str);
            },
            error: function(){
              alert('error');
            }
          });
          return false;

        });

      })

      //]]>
    </script>
    <?php
  }
}

// json出力
add_action( 'wp_ajax_editit_show_event_calendar', 'editit_show_event_calendar_ajax' );
add_action( 'wp_ajax_nopriv_editit_show_event_calendar', 'editit_show_event_calendar_ajax' );

function editit_show_event_calendar_ajax() {

  $jsondata = editit_show_event_calendar();
  $charset = get_bloginfo( 'charset' );
  nocache_headers();
  header( "Content-Type: application/json; charset=$charset" );
  echo json_encode($jsondata);
  die();

}


function editit_show_event_calendar() {

  //Get Post Date
  $year = isset($_POST['year']) ? $_POST['year'] : date('Y');
  $month = isset($_POST['month']) ? $_POST['month'] : date('m');

  //Set FirstDate&LastDate (ex. 2014-01-01,2014.01.31)
  $year_month_firstday = $year . '-' . $month . '-01';
  $year_month_lastday = date("Y-m-t", strtotime($year_month_firstday));

  //Query Set
  $args = array(
    'post_type'    => 'event',
    'post_status'   => 'publish',
    'posts_per_page'  => '-1',
    'meta_query'   =>  array(
                         array(
                           'key'     =>  'editit_dateeventstartdate',
                           'value'   =>  $year_month_lastday,
                           'compare' =>  '<=',
                           'type'    =>  'DATE'
                         ),
                         array(
                           'key'     =>  'editit_dateeventenddate',
                           'value'   =>  $year_month_firstday,
                           'compare' =>  '>=',
                           'type'    =>  'DATE'
                         )
                       )
  );

  //Set Category Query
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




  $wp_query = new WP_Query($args);

  while ( $wp_query->have_posts() ) : $wp_query->the_post();

    // 開始日が空欄なら投稿日セット
    $post_date = get_the_time('Y-m-d');
    $start_date = rwmb_meta('editit_dateeventstartdate');
    $end_date = rwmb_meta('editit_dateeventenddate');

    // 開始日、終了日が空欄なら投稿日セット
    $start_date = isset($start_date) ? $start_date : $post_date;
    $end_date = isset($end_date) ? $end_date : $post_date;

    // 日付を表示用に整形
    $start_date = new DateTime($start_date);
    $start_date = $start_date->format('Y-m-d');
    $end_date = new DateTime($end_date);
    $end_date = $end_date->format('Y-m-d');

    // 終了日が開始日より前なら終了日に開始日をセット
    if($start_date > $end_date){
      $end_date = $start_date;
    }

    // 表示html組み立て
      // 詳細有
      if(rwmb_meta('editit_selecteventlinktosinglepage')){
        $html = "<span><a href='" .  get_permalink() . "'>" . get_the_title() . "</a></span>";
      }else{
      // 詳細無
        // URL有
        if(rwmb_meta('editit_urleventlinkurl') != ''){
          $html = "<span><a href='" . rwmb_meta("editit_urleventlinkurl") . "' target='_blank'>" . get_the_title() . "</a></span>";
        }else{
        // URL無
          $html = "<span>" . get_the_title() . "</span>";
        }
      }

    //開始と終了が同じ
    if($start_date == $end_date){
      $start_date = new DateTime($start_date);
      $eventdate = $start_date->format('m-d-Y');
      $jsondata[$eventdate] .= $html;
    }else{
      $interval   = new DateInterval( 'P1D' ); // 7日間隔
      $start_date = new DateTime($start_date);
      $end_date = new DateTime($end_date);
      $end_date = $end_date->modify( '+1 day' );
      foreach ( new DatePeriod( $start_date, $interval, $end_date ) as $d ) {
        $eventdate = $d->format( "m-d-Y" );
        $jsondata[$eventdate] .= $html;
      }
    }
  endwhile;
  return $jsondata;
}


/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */
?>