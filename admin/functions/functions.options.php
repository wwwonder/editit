<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
  function of_options()
  {
    //Access the WordPress Categories via an Array
    $of_categories    = array();  
    $of_categories_obj  = get_categories('hide_empty=0');
    foreach ($of_categories_obj as $of_cat) {
        $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
    $categories_tmp   = array_unshift($of_categories, "Select a category:");    
         
    //Access the WordPress Pages via an Array
    $of_pages       = array();
    $of_pages_obj     = get_pages('sort_column=post_parent,menu_order');    
    foreach ($of_pages_obj as $of_page) {
        $of_pages[$of_page->ID] = $of_page->post_name; }
    $of_pages_tmp     = array_unshift($of_pages, "Select a page:");       
  
    //Testing 
    $of_options_select  = array("one","two","three","four","five"); 
    $of_options_radio   = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");


    //Sample Homepage blocks for the layout manager (sorter)
    $of_options_homepage_blocks = array
    ( 
      "disabled" => array (
        "placebo"     => "placebo", //REQUIRED!
        "block_one"   => "Block One",
        "block_two"   => "Block Two",
        "block_three" => "Block Three",
      ), 
      "enabled" => array (
        "placebo"     => "placebo", //REQUIRED!
        "block_four"  => "Block Four",
      ),
    );

    //Stylesheets Reader
    $alt_stylesheet_path = LAYOUT_PATH;
    $alt_stylesheets = array();
    
    if ( is_dir($alt_stylesheet_path) ) 
    {
        if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
        { 
            while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
            {
                if(stristr($alt_stylesheet_file, ".css") !== false)
                {
                    $alt_stylesheets[] = $alt_stylesheet_file;
                }
            }    
        }
    }

    //Background Images Reader
    $bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
    $bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
    $bg_images = array();
    
    if ( is_dir($bg_images_path) ) {
        if ($bg_images_dir = opendir($bg_images_path) ) { 
            while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
                if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                  natsort($bg_images); //Sorts the array into a natural order
                    $bg_images[] = $bg_images_url . $bg_images_file;
                }
            }    
        }
    }
    

    /*-----------------------------------------------------------------------------------*/
    /* TO DO: Add options/functions that use these */
    /*-----------------------------------------------------------------------------------*/
    
    //More Options
    $uploads_arr    = wp_upload_dir();
    $all_uploads_path   = $uploads_arr['path'];
    $all_uploads    = get_option('of_uploads');
    $other_entries    = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
    $body_repeat    = array("no-repeat","repeat-x","repeat-y","repeat");
    $body_pos       = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
    
    // Image Alignment radio box
    $of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
    
    // Image Links to Options
    $of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


/* ------------------------------------------------------------------------ */
/* General Setting
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "General Setting",
                  "type"      => "heading",
                  "icon"      => "admin-generic"
                );

  /* Layout Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Layout Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Layout Style', 'editit'),
                  "desc"      => '',
                  "id"        => "select_layoutstyle",
                  "std"       => "fullwidth",
                  "type"      => "select",
                  "options"   => array(
                                   'fullwidth'                => __('Fullwidth', 'editit'),
                                   'boxedlayout'              => __('Boxed Layout', 'editit'),
                                   'boxedlayoutwithmargin'    => __('Boxed Layout with margin', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Enable Responsive Layout', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_responsive",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Enable to Zoom on Mobile Devices', 'editit'),
                  "desc"      => __('Default', 'editit') . ': OFF',
                  "id"        => "switch_mobilezoom",
                  "std"       => 0,
                  "type"      => "switch"
                );


  /* Background Setting (only work when Boxed Layout is enabled) ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Background Setting (only work when Boxed Layout is enabled)', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Background Color', 'editit'),
                  "desc"      => __('Default', 'editit') . ": #999999",
                  "id"        => "color_bgcolor",
                  "std"       => "#999999",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Background Image Upload', 'editit'),
                  "desc"      => __('Upload Background Image or Select from Media Library', 'editit'),
                  "id"        => "media_bgimage",
                  "std"       => "",
                  "mod"       => "min",
                  "type"      => "media"
                );

$of_options[] = array(
                  "name"      => __('Background Image Repeat', 'editit'),
                  "desc"      => '',
                  "id"        => "select_bgimagerepeat",
                  "std"       => "repeat",
                  "type"      => "select",
                  "options"   => array(
                                   'repeat'                => __('Repeat', 'editit'),
                                   'no-repeat'             => __('No Repeat', 'editit'),
                                   'repeat-x'              => __('Repeat Horizontal', 'editit'),
                                   'repeat-y'              => __('Repeat Vertical', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Background Image Attachment', 'editit'),
                  "desc"      => '',
                  "id"        => "select_bgimageattachment",
                  "std"       => "fixed",
                  "type"      => "select",
                  "options"   => array(
                                   'fixed'                 => __('Fixed', 'editit'),
                                   'scroll'                => __('Scroll', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Background Image Position', 'editit'),
                  "desc"      => '',
                  "id"        => "select_bgimageposition",
                  "std"       => "center top",
                  "type"      => "select",
                  "options"   => array(
                                   'left top'              => __('Left Top', 'editit'),
                                   'left center'           => __('Left Center', 'editit'),
                                   'left bottom'           => __('Left Bottom', 'editit'),
                                   'right top'             => __('Right Top', 'editit'),
                                   'right center'          => __('Right Center', 'editit'),
                                   'right bottom'          => __('Right Bottom', 'editit'),
                                   'center top'            => __('Center Top', 'editit'),
                                   'center center'         => __('Center Center', 'editit'),
                                   'center bottom'         => __('Center Bottom', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Background Image Size', 'editit'),
                  "desc"      => '',
                  "id"        => "select_bgimagesize",
                  "std"       => "auto",
                  "type"      => "select",
                  "options"   => array(
                                   'auto'                  => __('Auto', 'editit'),
                                   'contain'               => __('Contain', 'editit'),
                                   'cover'                 => __('Cover', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Enable Drop Shadow', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_dropshadow",
                  "std"       => 1,
                  "type"      => "switch"
                );


  /* Logo & Favicon ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Logo &amp; Favicon', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Logo Upload', 'editit'),
                  "desc"      => __('Upload Logo or Select from Media Library', 'editit'),
                  "id"        => "media_logo",
                  "std"       => "",
                  "mod"       => "min",
                  "type"      => "media"
                );

$of_options[] = array(
                  "name"      => __('Retina Logo Upload', 'editit'),
                  "desc"      => __('Retina Logo should be your Logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)', 'editit'),
                  "id"        => "media_logoretina",
                  "std"       => "",
                  "mod"       => "min",
                  "type"      => "media"
                );

$of_options[] = array(
                  "name"      => __('Original Logo Width', 'editit'),
                  "desc"      => __('If Retina Logo uploaded, please enter the width of the Standard Logo you&apos;ve uploaded (not the Retina Logo)', 'editit'),
                  "id"        => "text_logowidth",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Original Logo Height', 'editit'),
                  "desc"      => __('If Retina Logo uploaded, please enter the height of the Standard Logo you&apos;ve uploaded (not the Retina Logo)', 'editit'),
                  "id"        => "text_logoheight",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Favicon Upload', 'editit'),
                  "desc"      => __('16x16px ico/png', 'editit'),
                  "id"        => "media_favicon",
                  "std"       => "",
                  "mod"       => "min",
                  "type"      => "media"
                );


  /* Other Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Other Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Home Text', 'editit'),
                  "desc"      => __('Setting of the link text to the top page displayed by a menu, breadcrumbs.', 'editit') . '<br>' . __('Default', 'editit') . ': Home',
                  "id"        => "text_hometext",
                  "std"       => "Home",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Show Breadcrumbs in Titlebar', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_breadcrumbs",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Tracking Code', 'editit'),
                  "desc"      => __('Paste your Google Analytics Code (or other) here.', 'editit'),
                  "id"        => "textarea_trackingcode",
                  "std"       => "",
                  "type"      => "textarea"
                );

$of_options[] = array(
                  "name"      => __('Custom CSS Code', 'editit'),
                  "desc"      => __('You can add your custom CSS code here. No need to use style tag', 'editit'),
                  "id"        => "textarea_customcsscode",
                  "std"       => "",
                  "type"      => "textarea"
                );

$of_options[] = array(
                  "name"      => __('Custom Javascript Code', 'editit'),
                  "desc"      => __('You can add your custom Javascript code here. No need to use script tag', 'editit'),
                  "id"        => "textarea_customjscode",
                  "std"       => "",
                  "type"      => "textarea"
                );



/* ------------------------------------------------------------------------ */
/* Color Themes
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Color Themes",
                  "type"      => "heading",
                  "icon"      => "art"
                );

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Please choose the Theme Color', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "color_theme",
                  "std"       => "default",
                  "type"      => "images",
                  "options"   => array(
                                   "default"    => get_bloginfo('template_directory')."/framework/images/colorthemes/default.gif",
                                   "mono"       => get_bloginfo('template_directory')."/framework/images/colorthemes/mono.gif"
                                 )
                );



/* ------------------------------------------------------------------------ */
/* Custom Style
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Custom Style",
                  "type"      => "heading",
                  "icon"      => "admin-appearance"
                );

$of_options[] = array(
                  "name"      => __('Enable Custom Style', 'editit'),
                  "desc"      => __('Default', 'editit') . ': OFF',
                  "id"        => "switch_customstyle",
                  "std"       => 0,
                  "type"      => "switch"
                );

  /* General Colors ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('General Style', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Body Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_bodybgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Body Border Top', 'editit'),
                  "desc"      => "",
                  "id"        => "border_bodybordertop",
                  "std"       => array('width' => '0','style' => 'none','color' => '#ffffff'),
                  "type"      => "border"
        ); 

$of_options[] = array(
                  "name"      => __('Selected Text Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_selectedtextbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Selected Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_selectedtextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Link Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_linkcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Link Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_linkhovercolor",
                  "std"       => "",
                  "type"      => "color"
                ); 

$of_options[] = array(
                  "name"      => __('Accent Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_accentcolor",
                  "std"       => "",
                  "type"      => "color"
                ); 



  /* Topbar Colors ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Topbar Style', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Topbar Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbarbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbarborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbartextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Text Link Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbartextlinkcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Text Link Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbartextlinkhovercolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Text Background Color(Option Only Mobile Size)', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbartextbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Social Icon Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbarsocialiconcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Social Icon Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbarsocialiconhovercolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Topbar Social Icon Hover Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_topbarsocialiconhoverbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );



  /* Header Colors ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Header Style', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Header Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headerbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Header Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headerborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Header Height', 'editit'),
                  "desc"      => "",
                  "id"        => "text_headerheight",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Logo Top Margin', 'editit'),
                  "desc"      => "",
                  "id"        => "text_headerlogomargintop",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Slogan Top Margin', 'editit'),
                  "desc"      => "",
                  "id"        => "text_headersloganmargintop",
                  "std"       => "",
                  "type"      => "text"
                );


  /* Slogan Colors ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Slogan Style', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Slogan Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_slogantextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Slogan Text Link Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_slogantextlinkcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Slogan Text Link Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_slogantextlinkhovercolor",
                  "std"       => "",
                  "type"      => "color"
                );


  /* Navigation Colors ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Navigation Style', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

/* Main Menu */
$of_options[] = array(
                  "name"      => __('Main Menu Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenutextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Main Menu Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenubgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Main Menu Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Main Menu Hover */
$of_options[] = array(
                  "name"      => __('Main Menu Hover Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuhovertextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Main Menu Hover Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuhoverbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );


$of_options[] = array(
                  "name"      => __('Main Menu Hover Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuhoverborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Main Menu Active */
$of_options[] = array(
                  "name"      => __('Main Menu Active Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuactivetextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Main Menu Active Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuactivebgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Main Menu Active Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuactiveborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Main Menu Active Hover */
$of_options[] = array(
                  "name"      => __('Main Menu Active Hover Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuactivehovertextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Main Menu Active Hover Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuactivehoverbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Main Menu Active Hover Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavmainmenuactivehoverborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Sub Menu */
$of_options[] = array(
                  "name"      => __('Sub Menu Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenutextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenubgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Border Top Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenubordertopcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Sub Menu Hover */
$of_options[] = array(
                  "name"      => __('Sub Menu Hover Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuhovertextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Hover Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuhoverbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Hover Border Top Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuhoverbordertopcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Hover Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuhoverborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Sub Menu Active */
$of_options[] = array(
                  "name"      => __('Sub Menu Active Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactivetextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Active Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactivebgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Active Border Top Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactivebordertopcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Active Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactiveborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Sub Menu Active Hover */
$of_options[] = array(
                  "name"      => __('Sub Menu Active Hover Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactivehovertextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Active Hover Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactivehoverbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Active Hover Border Top Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactivehoverbordertopcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Sub Menu Active Hover Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavsubmenuactivehoverborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

/* Option Only HeaderV2 HeaderV3 */
$of_options[] = array(
                  "name"      => __('Navigation Background Color (Option Only HeaderV2 HeaderV3 )', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Navigation Border Top Color (Option Only HeaderV2 HeaderV3 )', 'editit'),
                  "desc"      => "",
                  "id"        => "color_headernavbordertopcolor",
                  "std"       => "",
                  "type"      => "color"
                );



  /* Title Bar Colors & Background Image ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Titlebar Style', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Summary Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_titlebarsummarytextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Breadcrumbs Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_titlebarbreadcrumbstextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Breadcrumbs Text Link Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_titlebarbreadcrumbstextlinkcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Breadcrumbs Text Link Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_titlebarbreadcrumbstextlinkhovercolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Border Top Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_titlebarbordertopcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_titlebarborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_titlebarbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Background Image', 'editit'),
                  "desc"      => "",
                  "id"        => "media_titlebarbgimage",
                  "std"       => "",
                  "mod"       => "min",
                  "type"      => "media"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Background Image Repeat Option', 'editit'),
                  "desc"      => "",
                  "id"        => "select_titlebarbgimagerepeat",
                  "std"       => "repeat",
                  "type"      => "select",
                  "options"   => array(
                                   'repeat'                => __('Repeat', 'editit'),
                                   'no-repeat'             => __('No Repeat', 'editit'),
                                   'repeat-x'              => __('Repeat Horizontal', 'editit'),
                                   'repeat-y'              => __('Repeat Vertical', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Titlebar Background Image Position', 'editit'),
                  "desc"      => "",
                  "id"        => "select_titlebarbgimageposition",
                  "std"       => "center top",
                  "type"      => "select",
                  "options"   => array(
                                   'left top'              => __('Left Top', 'editit'),
                                   'left center'           => __('Left Center', 'editit'),
                                   'left bottom'           => __('Left Bottom', 'editit'),
                                   'right top'             => __('Right Top', 'editit'),
                                   'right center'          => __('Right Center', 'editit'),
                                   'right bottom'          => __('Right Bottom', 'editit'),
                                   'center top'            => __('Center Top', 'editit'),
                                   'center center'         => __('Center Center', 'editit'),
                                   'center bottom'         => __('Center Bottom', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Titlebar Background Image Size Option', 'editit'),
                  "desc"      => "",
                  "id"        => "select_titlebarbgimagesize",
                  "std"       => "auto",
                  "type"      => "select",
                  "options"   => array(
                                   'auto'                  => __('Auto', 'editit'),
                                   'contain'               => __('Contain', 'editit'),
                                   'cover'                 => __('Cover', 'editit')
                                 )
                );


  /* Footer Colors ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Footer Style', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Footer Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_footerbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Footer Widget Title Border Bottom Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_footerwidgettitleborderbottomcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Footer Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_footertextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Footer Text Link Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_footertextlinkcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Footer Text Link Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_footertextlinkhovercolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Footer Border Top', 'editit'),
                  "desc"      => "",
                  "id"        => "border_footerbordertop",
                  "std"       => array('width' => '0','style' => 'none','color' => '#ffffff'),
                  "type"      => "border"
                );

$of_options[] = array(
                  "name"      => __('Copyright Background Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_copyrightbgcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Copyright Text Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_copyrighttextcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Copyright Text Link Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_copyrighttextlinkcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Copyright Text Link Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_copyrighttextlinkhovercolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Footer Social Icon Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_footersocialiconcolor",
                  "std"       => "",
                  "type"      => "color"
                );

$of_options[] = array(
                  "name"      => __('Footer Social Icon Hover Color', 'editit'),
                  "desc"      => "",
                  "id"        => "color_footersocialiconhovercolor",
                  "std"       => "",
                  "type"      => "color"
                );































/* ------------------------------------------------------------------------ */
/* Typography
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Typography",
                  "type"      => "heading",
                  "icon"      => "editor-textcolor"
                );

$of_options[] = array(
                  "name"      => __('Enable Custom Typography', 'editit'),
                  "desc"      => __('Default', 'editit') . ': OFF',
                  "id"        => "switch_customtypography",
                  "std"       => 0,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Body Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 13px Arial #444444",
                  "id"        => "font_body",
                  "std"       => array('size' => '13px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('Logo - Text Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 30px Arial #000000",
                  "id"        => "font_logo",
                  "std"       => array('size' => '30px','face' => 'arial','color' => '#000000'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('Navigation Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 13px Arial",
                  "id"        => "font_nav",
                  "std"       => array('size' => '13px','face' => 'arial'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Main Title Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 25px Arial #333333",
                  "id"        => "font_titlebarmaintitle",
                  "std"       => array('size' => '25px','face' => 'arial','color' => '#333333'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('Titlebar Sub Title Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 12px Arial #666666",
                  "id"        => "font_titlebarsubtitle",
                  "std"       => array('size' => '12px','face' => 'arial','color' => '#666666'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('H1 - Headline Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 28px Arial #444444",
                  "id"        => "font_h1",
                  "std"       => array('size' => '28px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );  

$of_options[] = array(
                  "name"      => __('H2 - Headline Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 22px Arial #444444",
                  "id"        => "font_h2",
                  "std"       => array('size' => '22px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );  

$of_options[] = array(
                  "name"      => __('H3 - Headline Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 18px Arial #444444",
                  "id"        => "font_h3",
                  "std"       => array('size' => '18px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('H4 - Headline Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 16px Arial #444444",
                  "id"        => "font_h4",
                  "std"       => array('size' => '16px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('H5 - Headline Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 14px Arial #444444",
                  "id"        => "font_h5",
                  "std"       => array('size' => '15px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('H6 - Headline Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 12px Arial #444444",
                  "id"        => "font_h6",
                  "std"       => array('size' => '14px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('Sidebar Widget Title Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 15px Arial #444444",
                  "id"        => "font_sidebarh3",
                  "std"       => array('size' => '15px','face' => 'arial','color' => '#444444'),
                  "type"      => "typography"
                );

$of_options[] = array(
                  "name"      => __('Footer Widget Title Font', 'editit'),
                  "desc"      => __('Default', 'editit') . ": 15px Arial #FFFFFF",
                  "id"        => "font_footerh3",
                  "std"       => array('size' => '15px','face' => 'arial','color' => '#FFFFFF'),
                  "type"      => "typography"
                );


/* ------------------------------------------------------------------------ */
/* 05.Header
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Header",
                  "type"      => "heading",
                  "icon"      => "admin-tools"
                );

  /* Header Layout ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Select Header Layout', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "header_layout",
                  "std"       => "v1",
                  "type"      => "images",
                  "options"   => array(
                                 "v1" => get_bloginfo('template_directory')."/framework/images/headers/header1.png",
                                 "v2" => get_bloginfo('template_directory')."/framework/images/headers/header2.png",
                                 "v3" => get_bloginfo('template_directory')."/framework/images/headers/header3.png"
                               )
                );

  /* Topbar Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Topbar Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Show Topbar', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_topbar",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Topbar Text (HTML allowed)', 'editit'),
                  "desc"      => '',
                  "id"        => "textarea_topbartext",
                  "std"       => __('Enter Topbar Text (HTML allowed)', 'editit'),
                  "type"      => "textarea"
                );

$of_options[] = array(
                  "name"      => __('Show Social Icons in Topbar', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_socialtopbar",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Show Searchform in Topbar', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_searchform",
                  "std"       => 1,
                  "type"      => "switch"
                );


  /* Header Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Header Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Fixed Header', 'editit'),
                  "desc"      => __('Default', 'editit') . ': OFF',
                  "id"        => "switch_stickyheader",
                  "std"       => 0,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Slogan (HTML allowed)', 'editit'),
                  "desc"      => '',
                  "id"        => "textarea_headerslogantext",
                  "std"       => __('Enter Slogan (HTML allowed)', 'editit'),
                  "type"      => "textarea"
                );





/* ------------------------------------------------------------------------ */
/* 06.Blog
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Blog",
                  "type"      => "heading",
                  "icon"      => "admin-post"
                );

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Blog Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Enable Share-Box on Blog Single', 'editit'),
                  "desc"      => '',
                  "id"        => "switch_postsharebox",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Enable Author Info on Blog Single', 'editit'),
                  "desc"      => '',
                  "id"        => "switch_postauthorinfo",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Enable Related Posts on Blog Single', 'editit'),
                  "desc"      => '',
                  "id"        => "switch_postrelatedposts",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Sidebar Position For Blog Single', 'editit'),
                  "desc"      => '',
                  "id"        => "select_postsidebar",
                  "std"       => "sidebar-right",
                  "type"      => "select",
                  "options"   => array(
                                   'sidebar-right'  => __( 'Right Sidebar', 'editit' ),
                                   'sidebar-left'   => __( 'Left Sidebar', 'editit' ),
                                   'no-sidebar'     => __( 'No Sidebar', 'editit' )
                                 )
                );

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Social Share Box Icons For Blog Single', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Facebook in Social Share Box', 'editit'),
                  "desc"      => '',
                  "id"        => "switch_postshareboxfacebook",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Twitter in Social Share Box', 'editit'),
                  "desc"      => '',
                  "id"        => "switch_postshareboxtwitter",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Google+ in Social Share Box', 'editit'),
                  "desc"      => '',
                  "id"        => "switch_postshareboxgoogleplus",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable E-Mail in Social Share Box', 'editit'),
                  "desc"      => '',
                  "id"        => "switch_postshareboxemail",
                  "std"       => 1,
                  "type"      => "switch"
                );  
















/* ------------------------------------------------------------------------ */
/* 07.News
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "News",
                  "type"      => "heading",
                  "icon"      => "edit"
                );

  /* News Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('News Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                ); 

$of_options[] = array(
                  "name"      => __('News Slug', 'editit'),
                  "desc"      => __('Enter the URL Slug for your News (Default: news) <br /><strong>Go save your permalinks after changing this.</strong>', 'editit'),
                  "id"        => "text_newsslug",
                  "std"       => "news",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Share-Box on News Single', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_newssharebox",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Author Info on News Single', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_newsauthorinfo",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Related News on News Single', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_newsrelatedposts",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Sidebar Position For News Single', 'editit'),
                  "desc"      => "",
                  "id"        => "select_newssidebar",
                  "std"       => "sidebar-right",
                  "type"      => "select",
                  "options"   => array(
                                   'sidebar-right'  => __( 'Right Sidebar', 'editit' ),
                                   'sidebar-left'   => __( 'Left Sidebar', 'editit' ),
                                   'no-sidebar'     => __( 'No Sidebar', 'editit' )
                                 )
                );

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Social Share Box Icons For News Single', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Facebook in Social Share Box', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_newsshareboxfacebook",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Twitter in Social Share Box', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_newsshareboxtwitter",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Google+ in Social Share Box', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_newsshareboxgoogleplus",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Enable E-Mail in Social Share Box', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_newsshareboxemail",
                  "std"       => 1,
                  "type"      => "switch"
                );  



/* ------------------------------------------------------------------------ */
/* 08.Portfolio
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Portfolio",
                  "type"      => "heading",
                  "icon"      => "format-gallery"
                );


  /* Portfolio Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => __('Portfolio Slug', 'editit'),
                  "desc"      => __('Enter the URL Slug for your Portfolio (Default: portfolio) <br /><strong>Go save your permalinks after changing this.</strong>', 'editit'),
                  "id"        => "text_portfolioslug",
                  "std"       => "portfolio",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Enable Related Portfolio on Portfolio Single', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_portfoliorelatedportfolio",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Portfolio Related Portfolio Label', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfoliorelatedportfoliolabel",
                  "std"       => __('Related Projects', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 1', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel1",
                  "std"       => __('Skills', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 2', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel2",
                  "std"       => __('Release Date', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 3', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel3",
                  "std"       => __('Client', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 4', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel4",
                  "std"       => __('Copyright ', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 5', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel5",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 6', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel6",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 7', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel7",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 8', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel8",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 9', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel9",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Portfolio Information Label 10', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlabel10",
                  "std"       => "",
                  "type"      => "text"
                );


$of_options[] = array(
                  "name"      => __('Portfolio Information Link Label', 'editit'),
                  "desc"      => "",
                  "id"        => "text_portfolioinformationlinklabel",
                  "std"       => __('Link', 'editit'),
                  "type"      => "text"
                );




/* ------------------------------------------------------------------------ */
/* 09.Menu
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Menus",
                  "type"      => "heading",
                  "icon"      => "book"
                );

  /* Menu Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => __('Menu Slug', 'editit'),
                  "desc"      => __('Enter the URL Slug for your Menu (Default: menu) <br /><strong>Go save your permalinks after changing this.</strong>', 'editit'),
                  "id"        => "text_menuslug",
                  "std"       => "menu",
                  "type"      => "text"
                ); 


$of_options[] = array(
                  "name"      => __('Menu Information Label 1', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel1",
                  "std"       => __('The number of dishes', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 2', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel2",
                  "std"       => __('The number of people', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 3', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel3",
                  "std"       => __('Condition to use', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 4', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel4",
                  "std"       => __('Last Order', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 5', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel5",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 6', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel6",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 7', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel7",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 8', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel8",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 9', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel9",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Menu Information Label 10', 'editit'),
                  "desc"      => "",
                  "id"        => "text_menuinformationlabel10",
                  "std"       => "",
                  "type"      => "text"
                );







/* ------------------------------------------------------------------------ */
/* 10.Event
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Event",
                  "type"      => "heading",
                  "icon"      => "calendar"
                );

  /* Event List Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Event Column Type Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );



$of_options[] = array(
                  "name"      => __('Language of the date', 'editit'),
                  "desc"      => "",
                  "id"        => "select_languageofthedate",
                  "std"       => "english",
                  "type"      => "select",
                  "options"   => array(
                                   'english'              => __('English', 'editit'),
                                   'japanese'             => __('Japanese', 'editit')
                                 )
                );


  /* Event Calendar Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "general_heading",
                  "std"       => __('Event Calendar Type Options', 'editit'),
                  "icon"      => false,
                  "type"      => "info"
                );




$of_options[] = array(
                  "name"      => __('Event Slug', 'editit'),
                  "desc"      => __('Enter the URL Slug for your Event (Default: event) <br /><strong>Go save your permalinks after changing this.</strong>', 'editit'),
                  "id"        => "text_eventslug",
                  "std"       => "event",
                  "type"      => "text"
                );


$of_options[] = array(
                  "name"      => __('Day of the opening', 'editit'),
                  "desc"      => "",
                  "id"        => "select_dayoftheopening",
                  "std"       => "Monday",
                  "type"      => "select",
                  "options"   => array(
                                   'Sunday'    => __( 'Sunday', 'editit' ),
                                   'Monday'    => __( 'Monday', 'editit' ),
                                   'Tuesday'   => __( 'Tuesday', 'editit' ),
                                   'Wednesday' => __( 'Wednesday', 'editit' ),
                                   'Thursday'  => __( 'Thursday', 'editit' ),
                                   'Friday'    => __( 'Friday', 'editit' ),
                                   'Saturday'  => __( 'Saturday', 'editit' )
                                 )
                );

$of_options[] = array(
                  "name"      => __('Name of the month', 'editit'),
                  "desc"      => "",
                  "id"        => "select_nameofthemonth",
                  "std"       => "English",
                  "type"      => "select",
                  "options"   => array(
                                   'English'               => __( 'English', 'editit' ),
                                   'English Abbreviate'    => __( 'English Abbreviate', 'editit' )
                                 )
                );

$of_options[] = array(
                  "name"      => __('Name of the day', 'editit'),
                  "desc"      => "",
                  "id"        => "select_nameoftheday",
                  "std"       => "English",
                  "type"      => "select",
                  "options"   => array(
                                   'English'               => __( 'English', 'editit' ),
                                   'English Abbreviate'    => __( 'English Abbreviate', 'editit' ),
                                   'Japanese'              => __( 'Japanese', 'editit' )
                                 )
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 1', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel1",
                  "std"       => __('Place', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 2', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel2",
                  "std"       => __('Address', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 3', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel3",
                  "std"       => __('TEL', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 4', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel4",
                  "std"       => __('Cost', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 5', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel5",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 6', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel6",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 7', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel7",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 8', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel8",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 9', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel9",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Event Information Label 10', 'editit'),
                  "desc"      => "",
                  "id"        => "text_eventinformationlabel10",
                  "std"       => "",
                  "type"      => "text"
                );







/* ------------------------------------------------------------------------ */
/* 11.Member
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Member",
                  "type"      => "heading",
                  "icon"      => "groups"
                );


  /* Member Options ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => __('Member Slug', 'editit'),
                  "desc"      => __('Enter the URL Slug for your Member (Default: member) <br /><strong>Go save your permalinks after changing this.</strong>', 'editit'),
                  "id"        => "text_memberslug",
                  "std"       => "member",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Member Information Label 1', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel1",
                  "std"       => __('Birthday', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 2', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel2",
                  "std"       => __('Blood Type', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 3', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel3",
                  "std"       => __('Hometown', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 4', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel4",
                  "std"       => __('Hobby', 'editit'),
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 5', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel5",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 6', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel6",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 7', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel7",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 8', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel8",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 9', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel9",
                  "std"       => "",
                  "type"      => "text"
                );

$of_options[] = array(
                  "name"      => __('Member Information Label 10', 'editit'),
                  "desc"      => "",
                  "id"        => "text_memberinformationlabel10",
                  "std"       => "",
                  "type"      => "text"
                );







/* ------------------------------------------------------------------------ */
/* 12.Footer
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Footer",
                  "type"      => "heading",
                  "icon"      => "admin-tools"
                );

$of_options[] = array(
                  "name"      => __('Enable Widgetized Footer', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_footerwidgets",
                  "std"       => 1,
                  "type"      => "switch"
                ); 

$of_options[] = array(
                  "name"      => __('Footer Widget Columns', 'editit'),
                  "desc"      => "",
                  "id"        => "select_footercolumns",
                  "std"       => "4",
                  "type"      => "select",
                  "options"   => array(
                                   '4' => '4',
                                   '3' => '3',
                                   '2' => '2',
                                   '1' => '1'
                                 )
                );

$of_options[] = array(
                  "name"      => __('Copyright Text (HTML allowed)', 'editit'),
                  "desc"      => "",
                  "id"        => "textarea_copyrighttext",
                  "std"       => "",
                  "type"      => "textarea"
                ); 

$of_options[] = array(
                  "name"      => __('Show Social Icons in Footer', 'editit'),
                  "desc"      => "",
                  "id"        => "switch_socialfooter",
                  "std"       => 1,
                  "type"      => "switch"
                ); 











/* ------------------------------------------------------------------------ */
/* 13.Social Media
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Social Media",
                  "type"      => "heading",
                  "icon"      => "twitter"
                );

$of_options[] = array(
                  "name"      => "",
                  "desc"      => "",
                  "id"        => "introduction",
                  "std"       => __('Enter your Social Media URL to show or leave blank to hide Social Media Icons', 'editit'),
                  "icon"      => true,
                  "type"      => "info"
                );

$of_options[] = array(
                  "name"      => __('Twitter URL', 'editit'),
                  "desc"      => __('Enter your Twitter URL', 'editit'),
                  "id"        => "text_socialtwitter",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Facebook URL', 'editit'),
                  "desc"      => __('Enter URL to your Facebook URL', 'editit'),
                  "id"        => "text_socialfacebook",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Google+ URL', 'editit'),
                  "desc"      => __('Enter URL to your Google+ URL', 'editit'),
                  "id"        => "text_socialgoogleplus",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Skype URL', 'editit'),
                  "desc"      => __('Enter URL to your Skype URL', 'editit'),
                  "id"        => "text_socialskype",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Flickr URL', 'editit'),
                  "desc"      => __('Enter URL to your Flickr URL', 'editit'),
                  "id"        => "text_socialflickr",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Instagram URL', 'editit'),
                  "desc"      => __('Enter URL to your Instagram URL', 'editit'),
                  "id"        => "text_socialinstagram",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Pinterest URL', 'editit'),
                  "desc"      => __('Enter URL to your Pinterest URL', 'editit'),
                  "id"        => "text_socialpinterest",
                  "std"       => "",
                  "type"      => "text"
                );  

$of_options[] = array(
                  "name"      => __('Tumblr URL', 'editit'),
                  "desc"      => __('Enter URL to your Tumblr URL', 'editit'),
                  "id"        => "text_socialtumblr",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('YouTube URL', 'editit'),
                  "desc"      => __('Enter URL to your YouTube URL', 'editit'),
                  "id"        => "text_socialyoutube",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Vimeo URL', 'editit'),
                  "desc"      => __('Enter URL to your Vimeo URL', 'editit'),
                  "id"        => "text_socialvimeo",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Dribbble URL', 'editit'),
                  "desc"      => __('Enter URL to your Dribbble URL', 'editit'),
                  "id"        => "text_socialdribbble",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('GitHub URL', 'editit'),
                  "desc"      => __('Enter URL to your GitHub URL', 'editit'),
                  "id"        => "text_socialgithub",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('LinkedIn URL', 'editit'),
                  "desc"      => __('Enter URL to your LinkedIn URL', 'editit'),
                  "id"        => "text_sociallinkedin",
                  "std"       => "",
                  "type"      => "text"
                ); 

$of_options[] = array(
                  "name"      => __('Mail Address', 'editit'),
                  "desc"      => __('Enter URL to your mail address', 'editit'),
                  "id"        => "text_socialemail",
                  "std"       => "",
                  "type"      => "text"
                ); 


$of_options[] = array(
                  "name"      => __('Show RSS', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_socialshowrss",
                  "std"       => 1,
                  "type"      => "switch"
                );





/* ------------------------------------------------------------------------ */
/* 14.Lightbox Settings
/* ------------------------------------------------------------------------ */
$of_options[] = array(
                  "name"      => "Lightbox",
                  "type"      => "heading",
                  "icon"      => "editor-expand"
                );

$of_options[] = array(
                  "name"      => __('Lightbox Theme', 'editit'),
                  "desc"      => "",
                  "id"        => "select_lightboxtheme",
                  "std"       => "pp_default",
                  "type"      => "select",
                  "options"   => array(
                                   'pp_default'    => __('Default', 'editit'),
                                   'light_rounded' => __('Light Rounded', 'editit'),
                                   'dark_rounded'  => __('Dark Rounded', 'editit'),
                                   'light_square'  => __('Light Square', 'editit'),
                                   'dark_square'   => __('Dark Square', 'editit'),
                                   'facebook'      => __('Facebook', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Animation Speed', 'editit'),
                  "desc"      => "",
                  "id"        => "select_lightboxanimationspeed",
                  "std"       => "fast",
                  "type"      => "select",
                  "options"   => array(
                                   'fast'   => __('Fast', 'editit'),
                                   'slow'   => __('Slow', 'editit'),
                                   'normal' => __('Normal', 'editit')
                                 )
                );

$of_options[] = array(
                  "name"      => __('Background Opacity', 'editit'),
                  "desc"      => "",
                  "id"        => "sliderui_lightboxbackgroundopacity",
                  "std"       => "80",
                  "min"       => "0",
                  "step"      => "1",
                  "max"       => "100",
                  "type"      => "sliderui"
                );

$of_options[] = array(
                  "name"      => __('Show title', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_lightboxshowtitle",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Show Gallery Thumbnails', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_lightboxshowgallerythumbnails",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Autoplay Gallery', 'editit'),
                  "desc"      => __('Default', 'editit') . ': OFF',
                  "id"        => "switch_lightboxautoplaygallery",
                  "std"       => 0,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Autoplay Gallery Speed', 'editit'),
                  "desc"      => __('If autoplay is set to ON, select the slideshow speed in ms. (Default: 5000, 1000 ms = 1 second)', 'editit'),
                  "id"        => "sliderui_lightboxautoplaygalleryspeed",
                  "std"       => "5000",
                  "min"       => "1000",
                  "step"      => "100",
                  "max"       => "10000",
                  "type"      => "sliderui"
                );

$of_options[] = array(
                  "name"      => __('Social Icons', 'editit'),
                  "desc"      => __('Default', 'editit') . ': ON',
                  "id"        => "switch_lightboxsocialicons",
                  "std"       => 1,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Disable Lightbox on Smartphone', 'editit'),
                  "desc"      => __('Switch ON to disable Lightbox on Smartphones. This will link directly to the image', 'editit'),
                  "id"        => "switch_lightboxdisableonsmartphone",
                  "std"       => 0,
                  "type"      => "switch"
                );

$of_options[] = array(
                  "name"      => __('Disable automatic Lightbox for Images', 'editit'),
                  "desc"      => __('If switch ON this will disable automatic Lightbox for Images in the Content.', 'editit'),
                  "id"        => "switch_lightboxdisableautomaticforimages",
                  "std"       => 0,
                  "type"      => "switch"
                );





/* ------------------------------------------------------------------------ */
/* 15.Backup Options
/* ------------------------------------------------------------------------ */

$of_options[] = array(
                  "name"      => "Backup Options",
                  "type"      => "heading",
                  "icon"      => "share-alt2"
                );
        
$of_options[] = array(
                  "name"      => __('Backup and Restore Options', 'editit'),
                  "id"        => "of_backup",
                  "std"       => "",
                  "type"      => "backup",
                  "desc"      => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'editit'),
                );
        
$of_options[] = array(
                  "name"      => __('Transfer Theme Options Data', 'editit'),
                  "id"        => "of_transfer",
                  "std"       => "",
                  "type"      => "transfer",
                  "desc"      => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'editit'),
                );










  }//End function: of_options()
}//End chack if function exists: of_options()
?>