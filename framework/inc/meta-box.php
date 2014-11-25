<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign


add_action( 'admin_init', 'editit_register_meta_boxes' );
function editit_register_meta_boxes(){

  // Make sure there's no errors when the plugin is deactivated or during upgrade
  if ( !class_exists( 'RW_Meta_Box' ) )
    return;

  global $meta_boxes;
  global $smof_data;
  global $wpdb;

  $prefix = 'editit_';
  $meta_boxes = array();


  /* ----------------------------------------------------- */
  // Number of Entries
  for ($i=1; $i <= 50; $i++) {
    $number_of_entries_array[$i] = $i;
  }


  /* ----------------------------------------------------- */
  // PORTFOLIO FILTER ARRAY
  $portfolio_types = get_terms('portfolio_category', 'hide_empty=0');
  $portfolio_types_array[0] = __( 'All categories', 'editit' );
  if($portfolio_types) {
    foreach($portfolio_types as $portfolio_type) {
      $portfolio_types_array[$portfolio_type->term_id] = $portfolio_type->name;
    }
  }


  /* ----------------------------------------------------- */
  // EVENT FILTER ARRAY
  $event_types = get_terms('event_category', 'hide_empty=0');
  $event_types_array[0] = __( 'All categories', 'editit' );
  if($event_types) {
    foreach($event_types as $event_type) {
      $event_types_array[$event_type->term_id] = $event_type->name;
    }
  }


  /* ----------------------------------------------------- */
  // MENU FILTER ARRAY
  $menu_types = get_terms('menu_category', 'hide_empty=0');
  $menu_types_array[0] = __( 'All categories', 'editit' );
  if($menu_types) {
    foreach($menu_types as $menu_type) {
      $menu_types_array[$menu_type->term_id] = $menu_type->name;
    }
  }


  /* ----------------------------------------------------- */
  // FAQ FILTER ARRAY
  $faq_types = get_terms('faq_category', 'hide_empty=0');
  $faq_types_array[0] = __( 'All categories', 'editit' );
  if($faq_types) {
    foreach($faq_types as $faq_type) {
      $faq_types_array[$faq_type->term_id] = $faq_type->name;
    }
  }


  /* ----------------------------------------------------- */
  // Member FILTER ARRAY
  $member_types = get_terms('member_category', 'hide_empty=0');
  $member_types_array[0] = __( 'All categories', 'editit' );
  if($member_types) {
    foreach($member_types as $member_type) {
      $member_types_array[$member_type->term_id] = $member_type->name;
    }
  }


  /* ----------------------------------------------------- */
  // REVSLIDER ARRAY
  $revolutionslider = array();
  
  
  if(class_exists('RevSlider')){
    $revolutionslider[0] = __( 'Select a Slider', 'editit' );
    $slider = new RevSlider();
    $arrSliders = $slider->getArrSliders();
    foreach($arrSliders as $revSlider) { 
      $revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
    }
  }
  else{
    $revolutionslider[0] = __( 'Install RevolutionSlider Plugin first...', 'editit' );
  }


  /* ----------------------------------------------------- */
  // WOOSLIDER ARRAY
  if(class_exists('WooSlider')){
  
    $flexslider = get_terms('slide-page');
    $flexslider_array[0] = __( 'Select a Slider', 'editit' );
    if($flexslider) {
      foreach($flexslider as $slider) {
        $flexslider_array[$slider->slug] = $slider->name;
      }
    }
    
  }
  else{
    $flexslider_array[0] = __( 'Install WooSlider Plugin first...', 'editit' );
  }


  /* ----------------------------------------------------- */
  // 01.Page Layout Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'pagelayoutsettings',
    'title'         => __( 'Layout Setting', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // Sidebar
      array(
        'name'     => __( 'Sidebar', 'editit' ),
        'id'       => "{$prefix}selectsidebar",
        'type'     => 'select',
        'options'  => array(
                        'sidebar-right'  => __( 'Right Sidebar', 'editit' ),
                        'sidebar-left'   => __( 'Left Sidebar', 'editit' ),
                        'no-sidebar'     => __( 'No Sidebar', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'sidebar-right'

      ),

      array(
        'name'     => __( 'Show Page Contents', 'editit' ),
        'id'       => "{$prefix}selectshowpagecontents",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      )

    )
  );


  /* ----------------------------------------------------- */
  // 02.Blog Page Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'blogpagesettings',
    'title'         => __( 'Blog Page Settings (If Blog Template chosen)', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Select Page Type', 'editit' ),
        'id'       => "{$prefix}selectblogpagetype",
        'type'     => 'select',
        'options'  => array(
                        'large'    => __( 'Large Image', 'editit' ),
                        'medium'   => __( 'Medium Image', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'large'
      ),

      array(
        'name'     => __( 'Items on Page', 'editit' ),
        'id'       => "{$prefix}selectblogitemsonpage",
        'type'     => 'select',
        'options'  => $number_of_entries_array,
        'multiple' => false,
        'std'      => 10
      ),

      array(
        'name'     => __( 'Max Length of Excerpt', 'editit' ),
        'id'       => "{$prefix}textblogmaxlengthofexcerpt",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '120',
        'clone'    => false
      )

    )
  );


  /* ----------------------------------------------------- */
  // 03.News Page Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'newspagesettings',
    'title'         => __( 'News Page Settings (If News Template chosen)', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Select Page Type', 'editit' ),
        'id'       => "{$prefix}selectnewspagetype",
        'type'     => 'select',
        'options'  => array(
                        'large'    => __( 'Large Image', 'editit' ),
                        'medium'   => __( 'Medium Image', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'large'
      ),

      array(
        'name'     => __( 'Items on Page', 'editit' ),
        'id'       => "{$prefix}selectnewsitemsonpage",
        'type'     => 'select',
        'options'  => $number_of_entries_array,
        'multiple' => false,
        'std'      => 10
      ),

      array(
        'name'     => __( 'Max Length of Excerpt', 'editit' ),
        'id'       => "{$prefix}textnewsmaxlengthofexcerpt",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '120',
        'clone'    => false
      )

    )
  );


  /* ----------------------------------------------------- */
  // 04.Portfolio Page Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'portfoliopagesettings',
    'title'         => __( 'Portfolio Page Settings (If Portfolio Template chosen)', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Select Categories', 'editit' ),
        'id'       => "{$prefix}selectportfoliocategory",
        'type'     => 'select',
        'options'  => $portfolio_types_array,
        'multiple' => true,
        'desc'     => __( 'Choose what portfolio category you want to display on this page.', 'editit' )
      ),

      array(
        'name'     => __( 'Select Portfolio Column', 'editit' ),
        'id'       => "{$prefix}selectportfoliocolumn",
        'type'     => 'select',
        'options'  => array(
                        'four'    => __( '4 Columns', 'editit' ),
                        'three'   => __( '3 Columns', 'editit' ),
                        'two'     => __( '2 Columns', 'editit' ),
                        'one'     => __( '1 Column', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'four'
      ),

      array(
        'name'     => __( 'Items on Page', 'editit' ),
        'id'       => "{$prefix}selectportfolioitemsonpage",
        'type'     => 'select',
        'options'  => $number_of_entries_array,
        'multiple' => false,
        'std'      => 12
      ),

      array(
        'name'     => __( 'Show Title', 'editit' ),
        'id'       => "{$prefix}selectshowportfoliotitle",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      )

    )
  );


  /* ----------------------------------------------------- */
  // 05.Menu Page Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'menupagesettings',
    'title'         => __( 'Menu Page Settings (If Menu Template chosen)', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Select Categories', 'editit' ),
        'id'       => "{$prefix}selectmenucategory",
        'type'     => 'select',
        'options'  => $menu_types_array,
        'multiple' => true,
        'desc'     => __( 'Choose what menu category you want to display on this page.', 'editit' )
      ),

      array(
        'name'     => __( 'Items on Page', 'editit' ),
        'id'       => "{$prefix}selectmenuitemsonpage",
        'type'     => 'select',
        'options'  => $number_of_entries_array,
        'multiple' => false,
        'std'      => 10
      ),

      array(
        'name'     => __( 'Show Thumbnail', 'editit' ),
        'id'       => "{$prefix}selectshowmenuthumbnail",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      ),

      array(
        'name'     => __( 'Select Thumbnail Size', 'editit' ),
        'id'       => "{$prefix}selectmenuthumbnailsize",
        'type'     => 'select',
        'options'  => array(
                        'large'     => __( 'Large(160x160)', 'editit' ),
                        'medium'     => __( 'Medium(120x120)', 'editit' ),
                        'small'      => __( 'Small(80x80)', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'medium'
      ),

      array(
        'name'     => __( 'Show Price', 'editit' ),
        'id'       => "{$prefix}selectshowmenuprice",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      ),

      array(
        'name'     => __( 'Show Excerpt', 'editit' ),
        'id'       => "{$prefix}selectshowmenuexcerpt",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      ),

      array(
        'name'     => __( 'Max Length of Excerpt', 'editit' ),
        'id'       => "{$prefix}textmenumaxlengthofexcerpt",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '120',
        'clone'    => false
      )


    )
  );



  /* ----------------------------------------------------- */
  // 06.Event Page Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'eventpagesettings',
    'title'         => __( 'Event Page Settings (If Event Template chosen)', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Select Page Type', 'editit' ),
        'id'       => "{$prefix}selecteventpagetype",
        'type'     => 'select',
        'options'  => array(
                        'list'      => __( 'List', 'editit' ),
                        'calendar'  => __( 'Calendar', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'grid'
      ),

      array(
        'name'     => __( 'Select Categories', 'editit' ),
        'id'       => "{$prefix}selecteventcategory",
        'type'     => 'select',
        'options'  => $event_types_array,
        'multiple' => true,
        'desc'     => __( 'Choose what event category you want to display on this page.', 'editit' )
      ),

      // Heading
      array(
        'type'     => 'heading',
        'name'     => __( 'Settings for List Type Event Page', 'editit' ),
        'id'       => 'fake_id'
      ),

      array(
        'name'     => __( 'Items on Page', 'editit' ),
        'id'       => "{$prefix}selecteventitemsonpage",
        'type'     => 'select',
        'options'  => $number_of_entries_array,
        'multiple' => false,
        'std'      => 10
      ),

      array(
        'name'     => __( 'Show Thumbnail', 'editit' ),
        'id'       => "{$prefix}selectshoweventthumbnail",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      ),

      array(
        'name'     => __( 'Select Thumbnail Size', 'editit' ),
        'id'       => "{$prefix}selecteventthumbnailsize",
        'type'     => 'select',
        'options'  => array(
                        'large'     => __( 'Large(160x160)', 'editit' ),
                        'medium'     => __( 'Medium(120x120)', 'editit' ),
                        'small'      => __( 'Small(80x80)', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'medium'
      ),

      array(
        'name'     => __( 'Show Excerpt', 'editit' ),
        'id'       => "{$prefix}selectshoweventexcerpt",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      ),

      array(
        'name'     => __( 'Max Length of Excerpt', 'editit' ),
        'id'       => "{$prefix}texteventmaxlengthofexcerpt",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '120',
        'clone'    => false
      )

    )
  );


  /* ----------------------------------------------------- */
  // 07.FAQ Page Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'faqpagesettings',
    'title'         => __( 'FAQ Page Settings (If FAQ Template chosen)', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Select Categories', 'editit' ),
        'id'       => "{$prefix}selectfaqcategory",
        'type'     => 'select',
        'options'  => $faq_types_array,
        'multiple' => true,
        'desc'     => __( 'Choose what FAQ category you want to display on this page.', 'editit' )
      ),

      array(
        'name'     => __( 'Items on Page', 'editit' ),
        'id'       => "{$prefix}selectfaqitemsonpage",
        'type'     => 'select',
        'options'  => $number_of_entries_array,
        'multiple' => false,
        'std'      => 10
      )

    )
  );


  /* ----------------------------------------------------- */
  // 08.Member Page Settings
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'            => 'memberpagesettings',
    'title'         => __( 'Member Page Settings (If Member Template chosen)', 'editit' ),
    'pages'         => array('page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Select Categories', 'editit' ),
        'id'       => "{$prefix}selectmembercategory",
        'type'     => 'select',
        'options'  => $member_types_array,
        'multiple' => true,
        'desc'     => __( 'Choose what member category you want to display on this page.', 'editit' )
      ),

      array(
        'name'     => __( 'Select Member Column', 'editit' ),
        'id'       => "{$prefix}selectmembercolumn",
        'type'     => 'select',
        'options'  => array(
                        'four'    => __( '4 Columns', 'editit' ),
                        'three'   => __( '3 Columns', 'editit' ),
                        'two'     => __( '2 Columns', 'editit' ),
                        'one'     => __( '1 Column', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'four'
      ),

      array(
        'name'     => __( 'Items on Page', 'editit' ),
        'id'       => "{$prefix}selectmemberitemsonpage",
        'type'     => 'select',
        'options'  => $number_of_entries_array,
        'multiple' => false,
        'std'      => 10
      ),

      array(
        'name'     => __( 'Show Excerpt', 'editit' ),
        'id'       => "{$prefix}selectshowmemberexcerpt",
        'type'     => 'select',
        'options'  => array(
                        '0' => __( 'No', 'editit' ),
                        '1' => __( 'Yes', 'editit' ),
                      ),
        'multiple' => false,
        'std'      => '1'
      ),

    )
  );


  /* ----------------------------------------------------- */
  // 09.Post Format Settings
  /* ----------------------------------------------------- */

  /* Gallery Setting */
  $meta_boxes[] = array(
    'id'            => 'postformatgallerysettings',
    'title'         => __( 'Gallery Setting  (only work when Gallery Format is selected)', 'editit' ),
    'pages'         => array('post'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // IMAGE ADVANCED (WP 3.5+)
      array(
        'name'     => __( 'Gallery Image Upload (Max 10pic)', 'editit' ),
        'id'       => "{$prefix}imagegallery",
        'type'     => 'image_advanced',
        'max_file_uploads'  => 10
      )
    )
  );


  /* Link Setting */
  $meta_boxes[] = array(
    'id'            => 'postformatlinksettings',
    'title'         => __( 'Link Setting  (only work when Link Format is selected)', 'editit' ),
    'pages'         => array('post'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // URL
      array(
        'name'     => __( 'Link URL', 'editit' ),
        'desc'     => __( 'Example: http://www.google.com', 'editit' ),
        'id'       => "{$prefix}urllinkurl",
        'type'     => 'url',
        'std'      => ''
      )
    )
  );


  /* Quote Setting */
  $meta_boxes[] = array(
    'id'            => 'postformatquotesettings',
    'title'         => __( 'Quote Setting  (only work when Quote Format is selected)', 'editit' ),
    'pages'         => array('post'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // Source Name
      array(
        'name'     => __( 'Source Name', 'editit' ),
        'id'       => "{$prefix}textquotesourcename",
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      ),

      // Source URL
      array(
        'name'     => __( 'Source URL', 'editit' ),
        'id'       => "{$prefix}urlquotesourceurl",
        'type'     => 'url',
        'std'      => ''
      )
    )
  );

  /* Audio Setting */
  $meta_boxes[] = array(
    'id'            => 'postformataudiosettings',
    'title'         => __( 'Audio Setting  (only work when Audio Format is selected)', 'editit' ),
    'pages'         => array('post'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // Audio Embed
      array(
        'name'     => __( 'Audio Embed', 'editit' ),
        'desc'     => __( 'Enter Audio Embed Code', 'editit' ),
        'id'       => "{$prefix}textareaaudioembed",
        'type'     => 'textarea',
        'cols'     => 20,
        'rows'     => 3
      )
    )
  );


  /* Video Setting */
  $meta_boxes[] = array(
    'id'            => 'postformatvideosettings',
    'title'         => __( 'Video Setting  (only work when Video Format is selected)', 'editit' ),
    'pages'         => array('post'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // Video Embed
      array(
        'name'     => __( 'Video Embed', 'editit' ),
        'desc'     => __( 'Enter Video Embed Code', 'editit' ),
        'id'       => "{$prefix}textareavideoembed",
        'type'     => 'textarea',
        'cols'     => 20,
        'rows'     => 3
      )
    )
  );


  /* ----------------------------------------------------- */
  // 10.Portfolio Settings
  /* ----------------------------------------------------- */


  /* Portfolio Page Setting */
  $meta_boxes[] = array(
    'id'            => 'portfoliopagesettings',
    'title'         => __( 'Portfolio Page Setting', 'editit' ),
    'pages'         => array('portfolio'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( '[ Featured Image ] is displayed on the portfolio page.', 'editit' ),
        'id'   => 'fake_id'
      ),

      array(
        'name'     => __( 'Link to Single', 'editit' ),
        'id'       => "{$prefix}selectportfoliolinktosinglepage",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      ),

      array(
        'name'     => __( 'Link to Lightbox', 'editit' ),
        'id'       => "{$prefix}selectportfoliolinktolightbox",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      )

    )
  );


  /* Portfolio Single Layout Setting */
  $meta_boxes[] = array(
    'id'            => 'portfoliosinglelayoutsetting',
    'title'         => __( 'Portfolio Single Layout Setting', 'editit' ),
    'pages'         => array('portfolio'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Portfolio Single Layout', 'editit' ),
        'id'       => "{$prefix}selectportfoliosinglelayout",
        'type'     => 'select',
        'options'  => array(
                        'mediaonleft'    => __( 'Media On Left', 'editit' ),
                        'mediaonright'   => __( 'Media On Right', 'editit' ),
                        'fullmediaontop' => __( 'Full Media On Top', 'editit' )
        ),
        'multiple' => false,
        'std'      => 'mediaonleft'
      ),

      array(
        'name'     => __( 'Portfolio Image Display', 'editit' ),
        'id'       => "{$prefix}selectportfolioimagedisplay",
        'type'     => 'select',
        'options'  => array(
                        'slider'   => __( 'Slider', 'editit' ),
                        'noslider' => __( 'No Slider', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'slider'
      ),

      array(
        'name'     => __( 'Show Portfolio Information', 'editit' ),
        'id'       => "{$prefix}selectshowportfolioinformation",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      )

    )
  );


  /* Portfolio Media */
  $meta_boxes[] = array(
    'id'            => 'portfoliomedia',
    'title'         => __( 'Portfolio Media', 'editit' ),
    'pages'         => array('portfolio'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( 'When [ Gallery Image ] or [ Video Embed ] are not set, featured image is displayed in original aspect ratio.', 'editit' ),
        'id'   => 'fake_id'
      ),

      // SELECT BOX
      array(
        'name'     => __( 'Portfolio Media', 'editit' ),
        'id'       => "{$prefix}selectportfoliomedia",
        'type'     => 'select',
        'options'  => array(
          'image'  => __( 'Image', 'editit' ),
          'video'  => __( 'Video', 'editit' )
        ),
        'multiple' => false,
        'std'      => 'image'
      ),

      // IMAGE ADVANCED (WP 3.5+)
      array(
        'name'     => __( 'Gallery Image Upload (Max 10pic)', 'editit' ),
        'id'       => "{$prefix}imagegallery",
        'type'     => 'image_advanced',
        'max_file_uploads'  => 10
      ),

      // Audio Embed
      array(
        'name'     => __( 'Video Embed', 'editit' ),
        'desc'     => __( 'Enter Video Embed Code', 'editit' ),
        'id'       => "{$prefix}textareavideoembed",
        'type'     => 'textarea',
        'cols'     => 20,
        'rows'     => 3
      )

    )
  );








  /* Portfolio Information */

  for($i = 1; $i <= 10; $i++) {
    if($smof_data['text_portfolioinformationlabel'. $i]){$field_type[$i] = "text";}else{$field_type[$i] = "hidden";}
  }

  $meta_boxes[] = array(
    'id'            => 'portfolioinformation',
    'title'         => __( 'Portfolio Information', 'editit' ),
    'pages'         => array('portfolio'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( 'You can set the Portfolio Information Label in [ Appearance > Theme Options > Portfolio ].', 'editit' ),
        'id'   => 'fake_id'
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel1'],
        'id'       => "{$prefix}textportfolioinformationlabel1",
        'desc'     => '',
        'type'     => $field_type[1],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel2'],
        'id'       => "{$prefix}textportfolioinformationlabel2",
        'desc'     => '',
        'type'     => $field_type[2],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel3'],
        'id'       => "{$prefix}textportfolioinformationlabel3",
        'desc'     => '',
        'type'     => $field_type[3],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel4'],
        'id'       => "{$prefix}textportfolioinformationlabel4",
        'desc'     => '',
        'type'     => $field_type[4],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel5'],
        'id'       => "{$prefix}textportfolioinformationlabel5",
        'desc'     => '',
        'type'     => $field_type[5],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel6'],
        'id'       => "{$prefix}textportfolioinformationlabel6",
        'desc'     => '',
        'type'     => $field_type[6],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel7'],
        'id'       => "{$prefix}textportfolioinformationlabel7",
        'desc'     => '',
        'type'     => $field_type[7],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel8'],
        'id'       => "{$prefix}textportfolioinformationlabel8",
        'desc'     => '',
        'type'     => $field_type[8],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel9'],
        'id'       => "{$prefix}textportfolioinformationlabel9",
        'desc'     => '',
        'type'     => $field_type[9],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_portfolioinformationlabel10'],
        'id'       => "{$prefix}textportfolioinformationlabel10",
        'desc'     => '',
        'type'     => $field_type[10],
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => __( 'Link Text', 'editit' ),
        'id'       => "{$prefix}textportfolioinformationlabellinktext",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => __( 'Link URL', 'editit' ),
        'id'       => "{$prefix}urlportfolioinformationlabellinkurl",
        'desc'     => '',
        'type'     => 'url',
        'std'      => '',
        'clone'    => false
      )
    )
  );


  /* ----------------------------------------------------- */
  // 11. Menu Settings
  /* ----------------------------------------------------- */

  /* Menu Price */
  $meta_boxes[] = array(
    'id'            => 'menuprice',
    'title'         => __( 'Menu Price', 'editit' ),
    'pages'         => array('menu'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Price', 'editit' ),
        'id'       => "{$prefix}textmenupricetext",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      )
    )
  );


  /* Menu Page Setting */
  $meta_boxes[] = array(
    'id'            => 'menupagesettings',
    'title'         => __( 'Menu Page Setting', 'editit' ),
    'pages'         => array('menu'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( '[ Featured Image ] is displayed on the menu page.', 'editit' ),
        'id'   => 'fake_id'
      ),

      array(
        'name'     => __( 'Link to Single', 'editit' ),
        'id'       => "{$prefix}selectmenulinktosinglepage",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      ),

      array(
        'name'     => __( 'Link to Lightbox', 'editit' ),
        'id'       => "{$prefix}selectmenulinktolightbox",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      )

    )
  );



  /* Menu Single Layout Setting */
  $meta_boxes[] = array(
    'id'            => 'menusinglelayoutsetting',
    'title'         => __( 'Menu Single Layout Setting', 'editit' ),
    'pages'         => array('menu'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // SELECT BOX
      array(
        'name'     => __( 'Menu Single Layout', 'editit' ),
        'id'       => "{$prefix}selectmenusinglelayout",
        'type'     => 'select',
        'options'  => array(
                        'mediaonleft'    => __( 'Media On Left', 'editit' ),
                        'mediaonright'   => __( 'Media On Right', 'editit' ),
                        'fullmediaontop' => __( 'Full Media On Top', 'editit' )
        ),
        'multiple' => false,
        'std'      => 'mediaonleft'
      ),
  
      array(
        'name'     => __( 'Menu Image Display', 'editit' ),
        'id'       => "{$prefix}selectmenuimagedisplay",
        'type'     => 'select',
        'options'  => array(
                        'slider'   => __( 'Slider', 'editit' ),
                        'noslider' => __( 'No Slider', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'slider'
      ),

      array(
        'name'     => __( 'Show Menu Information', 'editit' ),
        'id'       => "{$prefix}selectshowmenuinformation",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      )

    )
  );


  /* Menu Media */
  $meta_boxes[] = array(
    'id'            => 'menumedia',
    'title'         => __( 'Menu Media', 'editit' ),
    'pages'         => array('menu'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( 'When [ Gallery Image ] or [ Video Embed ] are not set, featured image is displayed in original aspect ratio.', 'editit' ),
        'id'   => 'fake_id'
      ),

      // SELECT BOX
      array(
        'name'     => __( 'Menu Media', 'editit' ),
        'id'       => "{$prefix}selectmenumedia",
        'type'     => 'select',
        'options'  => array(
          'image'  => __( 'Image', 'editit' ),
          'video'  => __( 'Video', 'editit' )
        ),
        'multiple' => false,
        'std'      => 'image'
      ),

      // IMAGE ADVANCED (WP 3.5+)
      array(
        'name'     => __( 'Gallery Image Upload (Max 10pic)', 'editit' ),
        'id'       => "{$prefix}imagegallery",
        'type'     => 'image_advanced',
        'max_file_uploads'  => 10
      ),

      // Video Embed
      array(
        'name'     => __( 'Video Embed', 'editit' ),
        'desc'     => __( 'Enter Video Embed Code', 'editit' ),
        'id'       => "{$prefix}textareavideoembed",
        'type'     => 'textarea',
        'cols'     => 20,
        'rows'     => 3
      )

    )
  );



  if($smof_data['text_menuinformationlabel1']){$field_type1 = "text";}else{$field_type1 = "hidden";}
  if($smof_data['text_menuinformationlabel2']){$field_type2 = "text";}else{$field_type2 = "hidden";}
  if($smof_data['text_menuinformationlabel3']){$field_type3 = "text";}else{$field_type3 = "hidden";}
  if($smof_data['text_menuinformationlabel4']){$field_type4 = "text";}else{$field_type4 = "hidden";}
  if($smof_data['text_menuinformationlabel5']){$field_type5 = "text";}else{$field_type5 = "hidden";}
  if($smof_data['text_menuinformationlabel6']){$field_type6 = "text";}else{$field_type6 = "hidden";}
  if($smof_data['text_menuinformationlabel7']){$field_type7 = "text";}else{$field_type7 = "hidden";}
  if($smof_data['text_menuinformationlabel8']){$field_type8 = "text";}else{$field_type8 = "hidden";}
  if($smof_data['text_menuinformationlabel9']){$field_type9 = "text";}else{$field_type9 = "hidden";}
  if($smof_data['text_menuinformationlabel10']){$field_type10 = "text";}else{$field_type10 = "hidden";}


  /* Menu Information */
  $meta_boxes[] = array(
    'id'            => 'menuinformation',
    'title'         => __( 'Menu Information', 'editit' ),
    'pages'         => array('menu'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( 'You can set the Menu Information Label in [ Appearance > Theme Options > Menu ].', 'editit' ),
        'id'   => 'fake_id'
      ),

      // Menu Information
      array(
        'name'     => $smof_data['text_menuinformationlabel1'],
        'id'       => "{$prefix}textmenuinformationlabel1",
        'desc'     => '',
        'type'     => $field_type1,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel2'],
        'id'       => "{$prefix}textmenuinformationlabel2",
        'desc'     => '',
        'type'     => $field_type2,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel3'],
        'id'       => "{$prefix}textmenuinformationlabel3",
        'desc'     => '',
        'type'     => $field_type3,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel4'],
        'id'       => "{$prefix}textmenuinformationlabel4",
        'desc'     => '',
        'type'     => $field_type4,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel5'],
        'id'       => "{$prefix}textmenuinformationlabel5",
        'desc'     => '',
        'type'     => $field_type5,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel6'],
        'id'       => "{$prefix}textmenuinformationlabel6",
        'desc'     => '',
        'type'     => $field_type6,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel7'],
        'id'       => "{$prefix}textmenuinformationlabel7",
        'desc'     => '',
        'type'     => $field_type7,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel8'],
        'id'       => "{$prefix}textmenuinformationlabel8",
        'desc'     => '',
        'type'     => $field_type8,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel9'],
        'id'       => "{$prefix}textmenuinformationlabel9",
        'desc'     => '',
        'type'     => $field_type9,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_menuinformationlabel10'],
        'id'       => "{$prefix}textmenuinformationlabel10",
        'desc'     => '',
        'type'     => $field_type10,
        'std'      => '',
        'clone'    => false
      )


    )
  );


  /* ----------------------------------------------------- */
  // 12. Event Settings
  /* ----------------------------------------------------- */

  /* Event Page Setting */
  $meta_boxes[] = array(
    'id'            => 'eventpagesettings',
    'title'         => __( 'Event Page Setting', 'editit' ),
    'pages'         => array('event'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( '[ Featured Image ] is displayed on the event page.', 'editit' ),
        'id'   => 'fake_id'
      ),

      array(
        'name'     => __( 'Link to Single', 'editit' ),
        'id'       => "{$prefix}selecteventlinktosinglepage",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      ),

      array(
        'name'     => __( 'Link to Lightbox', 'editit' ),
        'id'       => "{$prefix}selecteventlinktolightbox",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      )

    )
  );


  /* Event Single Layout Setting */
  $meta_boxes[] = array(
    'id'            => 'eventsinglelayoutsetting',
    'title'         => __( 'Event Single Layout Setting', 'editit' ),
    'pages'         => array('event'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // SELECT BOX
      array(
        'name'     => __( 'Event Single Layout', 'editit' ),
        'id'       => "{$prefix}selecteventsinglelayout",
        'type'     => 'select',
        'options'  => array(
                        'mediaonleft'    => __( 'Media On Left', 'editit' ),
                        'mediaonright'   => __( 'Media On Right', 'editit' ),
                        'fullmediaontop' => __( 'Full Media On Top', 'editit' )
        ),
        'multiple' => false,
        'std'      => 'mediaonleft'
      ),
  
      array(
        'name'     => __( 'Event Image Display', 'editit' ),
        'id'       => "{$prefix}selecteventimagedisplay",
        'type'     => 'select',
        'options'  => array(
                        'slider'   => __( 'Slider', 'editit' ),
                        'noslider' => __( 'No Slider', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'slider'
      ),

      array(
        'name'     => __( 'Show Event Information', 'editit' ),
        'id'       => "{$prefix}selectshoweventinformation",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      )

    )
  );


  /* Event Media */
  $meta_boxes[] = array(
    'id'            => 'eventMedia',
    'title'         => __( 'Event Media', 'editit' ),
    'pages'         => array('event'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( 'When [ Gallery Image ] or [ Video Embed ] are not set, featured image is displayed in original aspect ratio.', 'editit' ),
        'id'   => 'fake_id'
      ),

      // SELECT BOX
      array(
        'name'     => __( 'Event Media', 'editit' ),
        'id'       => "{$prefix}selecteventmedia",
        'type'     => 'select',
        'options'  => array(
                        'image'  => __( 'Image', 'editit' ),
                        'video'  => __( 'Video', 'editit' )
        ),
        'multiple'    => false,
        'std'         => 'image'
      ),

      // IMAGE ADVANCED (WP 3.5+)
      array(
        'name'     => __( 'Event Image Upload (Max 10pic)', 'editit' ),
        'id'       => "{$prefix}imagegallery",
        'type'     => 'image_advanced',
        'max_file_uploads'  => 10
      ),

      // Video Embed
      array(
        'name'     => __( 'Video Embed', 'editit' ),
        'desc'     => __( 'Enter Video Embed Code', 'editit' ),
        'id'       => "{$prefix}textareavideoembed",
        'type'     => 'textarea',
        'cols'     => 20,
        'rows'     => 3
      )

    )
  );



  if($smof_data['text_eventinformationlabel1']){$field_type1 = "text";}else{$field_type1 = "hidden";}
  if($smof_data['text_eventinformationlabel2']){$field_type2 = "text";}else{$field_type2 = "hidden";}
  if($smof_data['text_eventinformationlabel3']){$field_type3 = "text";}else{$field_type3 = "hidden";}
  if($smof_data['text_eventinformationlabel4']){$field_type4 = "text";}else{$field_type4 = "hidden";}
  if($smof_data['text_eventinformationlabel5']){$field_type5 = "text";}else{$field_type5 = "hidden";}
  if($smof_data['text_eventinformationlabel6']){$field_type6 = "text";}else{$field_type6 = "hidden";}
  if($smof_data['text_eventinformationlabel7']){$field_type7 = "text";}else{$field_type7 = "hidden";}
  if($smof_data['text_eventinformationlabel8']){$field_type8 = "text";}else{$field_type8 = "hidden";}
  if($smof_data['text_eventinformationlabel9']){$field_type9 = "text";}else{$field_type9 = "hidden";}
  if($smof_data['text_eventinformationlabel10']){$field_type10 = "text";}else{$field_type10 = "hidden";}

  $today_date = date('Y-m-d');


  /* Event Information */
  $meta_boxes[] = array(
    'id'            => 'eventinformation',
    'title'         => __( 'Event Information', 'editit' ),
    'pages'         => array('event'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // DATE
      array(
        'name'     => __( 'Event Start Date', 'editit' ),
        'id'       => "{$prefix}dateeventstartdate",
        'type'     => 'date',
        'std'      => $today_date,
        'js_options' => array(
                          'dateFormat'      => 'yy-mm-dd',
                          'changeMonth'     => true,
                          'changeYear'      => true,
                          'showButtonPanel' => true
                        ),
      ),

      // DATE
      array(
        'name'     => __( 'Event End Date', 'editit' ),
        'id'       => "{$prefix}dateeventenddate",
        'type'     => 'date',
        'std'      => $today_date,
        'js_options' => array(
                          'dateFormat'      => 'yy-mm-dd',
                          'changeMonth'     => true,
                          'changeYear'      => true,
                          'showButtonPanel' => true
                        ),
      ),

      array(
        'name'     => __( 'Event Link URL(If not link to single page)', 'editit' ),
        'id'       => "{$prefix}urleventlinkurl",
        'type'     => 'url',
        'std'      => '',
      ),


      array(
        'type' => 'heading',
        'name' => __( 'You can set the Event Information Label in [ Appearance > Theme Options > Event ].', 'editit' ),
        'id'   => 'fake_id'
      ),

      // Event Information
      array(
        'name'     => $smof_data['text_eventinformationlabel1'],
        'id'       => "{$prefix}texteventinformationlabel1",
        'desc'     => '',
        'type'     => $field_type1,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel2'],
        'id'       => "{$prefix}texteventinformationlabel2",
        'desc'     => '',
        'type'     => $field_type2,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel3'],
        'id'       => "{$prefix}texteventinformationlabel3",
        'desc'     => '',
        'type'     => $field_type3,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel4'],
        'id'       => "{$prefix}texteventinformationlabel4",
        'desc'     => '',
        'type'     => $field_type4,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel5'],
        'id'       => "{$prefix}texteventinformationlabel5",
        'desc'     => '',
        'type'     => $field_type5,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel6'],
        'id'       => "{$prefix}texteventinformationlabel6",
        'desc'     => '',
        'type'     => $field_type6,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel7'],
        'id'       => "{$prefix}texteventinformationlabel7",
        'desc'     => '',
        'type'     => $field_type7,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel8'],
        'id'       => "{$prefix}texteventinformationlabel8",
        'desc'     => '',
        'type'     => $field_type8,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel9'],
        'id'       => "{$prefix}texteventinformationlabel9",
        'desc'     => '',
        'type'     => $field_type9,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_eventinformationlabel10'],
        'id'       => "{$prefix}texteventinformationlabel10",
        'desc'     => '',
        'type'     => $field_type10,
        'std'      => '',
        'clone'    => false
      )

    )
  );



  /* ----------------------------------------------------- */
  // 13. Member Settings
  /* ----------------------------------------------------- */



  /* Member Page Setting */
  $meta_boxes[] = array(
    'id'            => 'memberpagesettings',
    'title'         => __( 'Member Page Setting', 'editit' ),
    'pages'         => array('member'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( '[ Featured Image ] is displayed on the member page.', 'editit' ),
        'id'   => 'fake_id'
      ),

      array(
        'name'     => __( 'Link to Single', 'editit' ),
        'id'       => "{$prefix}selectmemberlinktosinglepage",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      ),

    )
  );



  /* Member Layout Setting */
  $meta_boxes[] = array(
    'id'            => 'memberlayoutsetting',
    'title'         => __( 'Member Layout Setting', 'editit' ),
    'pages'         => array('member'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      // SELECT BOX
      array(
        'name'     => __( 'Member Layout', 'editit' ),
        'id'       => "{$prefix}selectmemberlayout",
        'type'     => 'select',
        'options'  => array(
                        'mediaonleft'    => __( 'Media On Left', 'editit' ),
                        'mediaonright'   => __( 'Media On Right', 'editit' ),
                        'fullmediaontop' => __( 'Full Media On Top', 'editit' )
        ),
        'multiple' => false,
        'std'      => 'mediaonleft'
      ),

      array(
        'name'     => __( 'Show Member Information', 'editit' ),
        'id'       => "{$prefix}selectshowmemberinformation",
        'type'     => 'select',
        'options'  => array(
                        0 => __( 'No', 'editit' ),
                        1 => __( 'Yes', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 1
      )

    )
  );



  /* Member Media */
  $meta_boxes[] = array(
    'id'            => 'membermedia',
    'title'         => __( 'Member Media', 'editit' ),
    'pages'         => array('member'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'type' => 'heading',
        'name' => __( 'When [ Gallery Image ] or [ Video Embed ] are not set, featured image is displayed in original aspect ratio.', 'editit' ),
        'id'   => 'fake_id'
      ),

      // SELECT BOX
      array(
        'name'     => __( 'Member Media', 'editit' ),
        'id'       => "{$prefix}selectmembermedia",
        'type'     => 'select',
        'options'  => array(
          'image'  => __( 'Image', 'editit' ),
          'video'  => __( 'Video', 'editit' )
        ),
        'multiple' => false,
        'std'      => 'image'
      ),

      // IMAGE ADVANCED (WP 3.5+)
      array(
        'name'     => __( 'Gallery Image Upload (Max 10pic)', 'editit' ),
        'id'       => "{$prefix}imagegallery",
        'type'     => 'image_advanced',
        'max_file_uploads'  => 10
      ),

      // Video Embed
      array(
        'name'     => __( 'Video Embed', 'editit' ),
        'desc'     => __( 'Enter Video Embed Code', 'editit' ),
        'id'       => "{$prefix}textareavideoembed",
        'type'     => 'textarea',
        'cols'     => 20,
        'rows'     => 3
      )

    )
  );






  /* Member Social Information */
  $meta_boxes[] = array(
    'id'            => 'membersocialinfo',
    'title'         => __( 'Member Social Information', 'editit' ),
    'pages'         => array('member'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(

      array(
        'name'     => __( 'Email', 'editit' ),
        'id'       => "{$prefix}emailmemberemail",
        'desc'     => '',
        'type'     => 'email',
        'std'      => ''
      ),

      array(
        'name'     => __( 'Website URL', 'editit' ),
        'id'       => "{$prefix}urlmemberwebsiteurl",
        'desc'     => '',
        'type'     => 'url',
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => __( 'Twitter', 'editit' ),
        'id'       => "{$prefix}textmembertwittertext",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => __( 'Facebook', 'editit' ),
        'id'       => "{$prefix}textmemberfacebooktext",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => __( 'Google+', 'editit' ),
        'id'       => "{$prefix}textmembergoogleplustext",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => __( 'Skype', 'editit' ),
        'id'       => "{$prefix}textmemberskypetext",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      )


    )
  );


  if($smof_data['text_memberinformationlabel1']){$field_type1 = "text";}else{$field_type1 = "hidden";}
  if($smof_data['text_memberinformationlabel2']){$field_type2 = "text";}else{$field_type2 = "hidden";}
  if($smof_data['text_memberinformationlabel3']){$field_type3 = "text";}else{$field_type3 = "hidden";}
  if($smof_data['text_memberinformationlabel4']){$field_type4 = "text";}else{$field_type4 = "hidden";}
  if($smof_data['text_memberinformationlabel5']){$field_type5 = "text";}else{$field_type5 = "hidden";}
  if($smof_data['text_memberinformationlabel6']){$field_type6 = "text";}else{$field_type6 = "hidden";}
  if($smof_data['text_memberinformationlabel7']){$field_type7 = "text";}else{$field_type7 = "hidden";}
  if($smof_data['text_memberinformationlabel8']){$field_type8 = "text";}else{$field_type8 = "hidden";}
  if($smof_data['text_memberinformationlabel9']){$field_type9 = "text";}else{$field_type9 = "hidden";}
  if($smof_data['text_memberinformationlabel10']){$field_type10 = "text";}else{$field_type10 = "hidden";}


  /* Member Information */
  $meta_boxes[] = array(
    'id'            => 'memberinformation',
    'title'         => __( 'Member Information', 'editit' ),
    'pages'         => array('member'),
    'context'       => 'normal',
    'priority'      => 'high',
    'fields'        => array(


      array(
        'name'     => __( 'Member Position', 'editit' ),
        'id'       => "{$prefix}textmemberpositiontext",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      ),

      array(
        'type' => 'heading',
        'name' => __( 'You can set the Member Information Label in [ Appearance > Theme Options > Member ].', 'editit' ),
        'id'   => 'fake_id'
      ),


      // Member Information
      array(
        'name'     => $smof_data['text_memberinformationlabel1'],
        'id'       => "{$prefix}textmemberinformationlabel1",
        'desc'     => '',
        'type'     => $field_type1,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel2'],
        'id'       => "{$prefix}textmemberinformationlabel2",
        'desc'     => '',
        'type'     => $field_type2,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel3'],
        'id'       => "{$prefix}textmemberinformationlabel3",
        'desc'     => '',
        'type'     => $field_type3,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel4'],
        'id'       => "{$prefix}textmemberinformationlabel4",
        'desc'     => '',
        'type'     => $field_type4,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel5'],
        'id'       => "{$prefix}textmemberinformationlabel5",
        'desc'     => '',
        'type'     => $field_type5,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel6'],
        'id'       => "{$prefix}textmemberinformationlabel6",
        'desc'     => '',
        'type'     => $field_type6,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel7'],
        'id'       => "{$prefix}textmemberinformationlabel7",
        'desc'     => '',
        'type'     => $field_type7,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel8'],
        'id'       => "{$prefix}textmemberinformationlabel8",
        'desc'     => '',
        'type'     => $field_type8,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel9'],
        'id'       => "{$prefix}textmemberinformationlabel9",
        'desc'     => '',
        'type'     => $field_type9,
        'std'      => '',
        'clone'    => false
      ),

      array(
        'name'     => $smof_data['text_memberinformationlabel10'],
        'id'       => "{$prefix}textmemberinformationlabel10",
        'desc'     => '',
        'type'     => $field_type10,
        'std'      => '',
        'clone'    => false
      )


    )
  );



  /* ----------------------------------------------------- */
  // 14.Titlebar Settings (Page, Portfolio, Menu, Event, Member)
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'           => 'titlebarsettings',
    'title'        => __( 'Titlebar Settings', 'editit' ),
    'pages'        => array( 'page', 'portfolio', 'menu', 'event', 'member' ),
    'context'      => 'normal',
    'priority'     => 'high',
    'fields'       => array(

      // Title Bar
      array(
        'name'     => __( 'Titlebar', 'editit' ),
        'id'       => "{$prefix}titlebar",
        'type'     => 'select',
        'options'  => array(
          'titlebar'      => __( 'Default Titlebar', 'editit' ),
          'breadcrumbs'   => __( 'Only Breadcrumbs', 'editit' ),
          'notitlebar'    => __( 'No Titlebar', 'editit' ),
          'revslider'     => __( 'Revolution Slider', 'editit' ),
          'flexslider'    => __( 'FlexSlider', 'editit' )
        ),
        'multiple' => false,
        'std'      => array( 'titlebar' )
      ),

      // Sub Title
      array(
        'name'     => __( 'Sub Title', 'editit' ),
        'id'       => "{$prefix}subtitle",
        'desc'     => '',
        'type'     => 'text',
        'std'      => '',
        'clone'    => false
      ),

      // Summary
      array(
        'name'     => __( 'Summary', 'editit' ),
        'id'       => "{$prefix}summary",
        'desc'     => '',
        'type'     => 'textarea',
        'std'      => '',
        'cols'     => 20,
        'rows'     => 3
      ),

      // Heading
      array(
        'type'     => 'heading',
        'name'     => __( 'Background settings for Titlebar section', 'editit' ),
        'id'       => 'fake_id'
      ),

      // Enable Titlebar Background
      array(
        'name'     => __( 'Enable Titlebar Background', 'editit' ),
        'id'       => "{$prefix}select_titlebarbg",
        'type'     => 'select',
        'options'  => array(
                '0' => __( 'No', 'editit' ),
                '1' => __( 'Yes', 'editit' ),
                ),
        'multiple' => false,
        'std'      => '0'
      ),

      // Titlebar Background Color
      array(
        'name'     => __( 'Background Color', 'editit' ),
        'id'       => "{$prefix}color_titlebarbgcolor",
        'type'     => 'color'
      ),

      // Background Image Upload
      array(
        'name'     => __( 'Background Image Upload', 'editit' ),
        'id'       => "{$prefix}image_titlebarbgimage",
        'type'     => 'image_advanced',
        'max_file_uploads'  => 1
      ),

      // Titlebar Background Repeat
      array(
        'name'     => __( 'Background Image Repeat', 'editit' ),
        'id'       => "{$prefix}select_titlebarbgimagerepeat",
        'type'     => 'select',
        'options'  => array(
                'no-repeat' => __( 'No Repeat', 'editit' ),
                'repeat'    => __( 'Repeat', 'editit' ),
                'repeat-x'  => __( 'Repeat Horizontal', 'editit' ),
                'repeat-y'  => __( 'Repeat Vertical', 'editit' )
                ),
        'multiple' => false,
        'std'      => 'repeat'
      ),

      // Titlebar Background Position
      array(
        'name'     => __( 'Background Image Position', 'editit' ),
        'id'       => "{$prefix}select_titlebarbgimageposition",
        'type'     => 'select',
        'options'  => array(
                         'left top'      => __( 'Left Top', 'editit' ),
                         'left center'   => __( 'Left Center', 'editit' ),
                         'left bottom'   => __( 'Left Bottom', 'editit' ),
                         'right top'     => __( 'Right Top', 'editit' ),
                         'right center'  => __( 'Right Center', 'editit' ),
                         'right bottom'  => __( 'Right Bottom', 'editit' ),
                         'center top'    => __( 'Center Top', 'editit' ),
                         'center center' => __( 'Center Center', 'editit' ),
                         'center bottom' => __( 'Center Bottom', 'editit' )
                      ),
        'multiple' => false,
        'std'      => 'center top'
      ),

      // Titlebar Background Size
      array(
        'name'     => __( 'Background Image Size', 'editit' ),
        'id'       => "{$prefix}select_titlebarbgimagesize",
        'type'     => 'select',
        'options'  => array(
                'auto'    => __( 'Auto', 'editit' ),
                'contain' => __( 'Contain', 'editit' ),
                'cover'   => __( 'Cover', 'editit' ),
                ),
        'multiple'    => false,
        'std'         => 'auto'
      ),

      // Heading
      array(
        'type'     => 'heading',
        'name'     => __( 'Select Slider', 'editit' ),
        'id'       => 'fake_id'
      ),

      // Revolution Slider
      array(
        'name'     => __( 'Revolution Slider', 'editit' ),
        'id'       => "{$prefix}revolutionslider",
        'type'     => 'select',
        'options'  => $revolutionslider,
        'multiple' => false
      ),

      // FlexSlider
      array(
        'name'     => __( 'FlexSlider', 'editit' ),
        'id'       => $prefix . "flexslider",
        'type'     => 'select',
        'options'  => $flexslider_array,
        'multiple' => false
      )
    )
  );



  /* ----------------------------------------------------- */
  // 15. Background Settings (Page, Portfolio, Menu, Event, Member)
  /* ----------------------------------------------------- */

  $meta_boxes[] = array(
    'id'        => 'styling',
    'title'     => __('Background Settings', 'editit'),
    'pages'     => array( 'page', 'portfolio', 'menu', 'event', 'member' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      // Heading
      array(
        'type' => 'heading',
        'name' => __( 'Please note that you need to set site layout to "Boxed" in order to see custom background.', 'editit' ),
        'id'   => 'fake_id'
      ),

      // Enable Background
      array(
        'name'      => __( 'Enable Background?', 'editit' ),
        'id'        => "{$prefix}select_bg",
        'type'      => 'select',
        'options'   => array(
                         '0' => __( 'No', 'editit' ),
                         '1' => __( 'Yes', 'editit' )
                       ),
        'multiple'  => false,
        'std'       => '0'
      ),

      // Background Color
      array(
        'name'      => __( 'Background Color', 'editit' ),
        'id'        => "{$prefix}color_bgcolor",
        'type'      => 'color'
      ),

      // Background Image
      array(
        'name'      => __( 'Background Image', 'editit' ),
        'id'        => "{$prefix}image_bgimage",
        'type'      => 'image_advanced',
        'max_file_uploads' => 1
      ),

      // Background Image Repeat Option
      array(
        'name'      => __( 'Background Image Repeat', 'editit' ),
        'id'        => "{$prefix}select_bgimagerepeat",
        'type'      => 'select',
        'options'   => array(
                         'repeat'    => __( 'Repeat', 'editit' ),
                         'no-repeat' => __( 'No Repeat', 'editit' ),
                         'repeat-x'  => __( 'Repeat Horizontal', 'editit' ),
                         'repeat-y'  => __( 'Repeat Vertical', 'editit' )
                       ),
        'multiple'  => false,
        'std'       => 'repeat'
      ),

      // Background Image Attachment Option
      array(
        'name'      => __( 'Background Image Attachment', 'editit' ),
        'id'        => "{$prefix}select_bgimageattachment",
        'type'      => 'select',
        'options'   => array(
                         'fixed'     => __( 'Fixed', 'editit' ),
                         'scroll'    => __( 'Scroll', 'editit' )
                       ),
        'multiple'  => false,
        'std'       => 'fixed'
      ),

      // Background Image Position Option
      array(
        'name'      => __( 'Background Image Position', 'editit' ),
        'id'        => "{$prefix}select_bgimageposition",
        'type'      => 'select',
        'options'   => array(
                         'left top'      => __( 'Left Top', 'editit' ),
                         'left center'   => __( 'Left Center', 'editit' ),
                         'left bottom'   => __( 'Left Bottom', 'editit' ),
                         'right top'     => __( 'Right Top', 'editit' ),
                         'right center'  => __( 'Right Center', 'editit' ),
                         'right bottom'  => __( 'Right Bottom', 'editit' ),
                         'center top'    => __( 'Center Top', 'editit' ),
                         'center center' => __( 'Center Center', 'editit' ),
                         'center bottom' => __( 'Center Bottom', 'editit' )
              ),
        'multiple'  => false,
        'std'       => 'left top'
      ),

      // Background Image Size Option
      array(
        'name'      => __( 'Background Image Size', 'editit' ),
        'id'        => "{$prefix}select_bgimagesize",
        'type'      => 'select',
        'options'   => array(
                         'auto'     => __( 'Auto', 'editit' ),
                         'contain'  => __( 'Contain', 'editit' ),
                         'cover'    => __( 'Cover', 'editit' ),
                       ),
        'multiple'  => false,
        'std'       => 'auto'
      )
    )
  );




  foreach ( $meta_boxes as $meta_box ){
    new RW_Meta_Box( $meta_box );
  }
}