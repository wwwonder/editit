<?php
/**
 * Custom CSS
 *
 *
 * @file           customcss.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/customcss.php
 */
?>
<?php

function editit_styles_custom() {
global $smof_data; 
?>

<!-- Custom CSS Codes
========================================================= -->

<style>

/* ------------------------------------------------------------------------ */
/* 05. Boxed Layout */
/* ------------------------------------------------------------------------ */

  <?php if($smof_data['switch_dropshadow']) : ?>
  .boxed-layout {
    -webkit-box-shadow:0px 0px 30px 0px rgba(0, 0, 0, 0.3);
       -moz-box-shadow:0px 0px 30px 0px rgba(0, 0, 0, 0.3);
            box-shadow:0px 0px 30px 0px rgba(0, 0, 0, 0.3);
  }
  <?php endif; ?>

  <?php if($smof_data['select_layoutstyle'] == 'boxedlayoutwithmargin' ) : ?>
  /* -- Boxed Layout with margin -- */
  .boxed-layout {
    margin: 40px auto;
    overflow: hidden;
    -webkit-border-radius: 4px;
       -moz-border-radius: 4px;
            border-radius: 4px;
  }
  <?php endif; ?>

  <?php if($smof_data['select_layoutstyle'] != 'fullwidth' ) : ?>
  /* -- Fixed Header -- */
    @media only screen and (min-width: 960px) {
      .stuck {
        width: 1000px !important;
      }
    }
  <?php endif; ?>



/* ------------------------------------------------------------------------ */
/* 02. General Styles
/* ------------------------------------------------------------------------ */

  /* -- Body Background -- */
  <?php if($smof_data['select_layoutstyle'] == 'boxedlayout' || $smof_data['select_layoutstyle'] == 'boxedlayoutwithmargin' ) : ?>
  body {
    <?php if( rwmb_meta('editit_select_bg')) : // Specific Page Background defined (page, portfolio, event, menu, member) ?>
      <?php
        if(rwmb_meta('editit_color_bgcolor')) { echo 'background-color: ' . rwmb_meta('editit_color_bgcolor') . ';';}
        if(rwmb_meta( 'editit_image_bgimage', 'type=image' )) {$images = rwmb_meta( 'editit_image_bgimage', 'type=image' );foreach ( $images as $image ){ echo 'background-image: url(' . $image["full_url"] . ');'; }}
        if(rwmb_meta('editit_select_bgimagerepeat')) { echo 'background-repeat: ' . rwmb_meta('editit_select_bgimagerepeat') . ';';}
        if(rwmb_meta('editit_select_bgimageattachment')) { echo 'background-attachment: ' . rwmb_meta('editit_select_bgimageattachment') . ';';}
        if(rwmb_meta('editit_select_bgimageposition')) { echo 'background-position: ' . rwmb_meta('editit_select_bgimageposition') . ';';}
        if(rwmb_meta('editit_select_bgimagesize')) { echo '-webkit-background-size: ' . rwmb_meta('editit_select_bgimagesize') . '; -moz-background-size: ' . rwmb_meta('editit_select_bgimagesize') . '; -o-background-size: ' . rwmb_meta('editit_select_bgimagesize') . '; -ms-background-size: ' . rwmb_meta('editit_select_bgimagesize') . '; background-size: ' . rwmb_meta('editit_select_bgimagesize') . ';'; }
      ?>
    <?php else: //If No Specific Page Background ?>
      <?php if ( 'portfolio' == get_post_type() && $smof_data['switch_portfoliobg'] ) : // Specific Portfolio Single Background defined ?>
        <?php
          if($smof_data['color_portfoliobgcolor'] != "") { echo 'background-color: ' . $smof_data['color_portfoliobgcolor'] . ';'; }
          if($smof_data['media_portfoliobgimage'] != "") { echo 'background-image: url(' . $smof_data['media_portfoliobgimage'] . ');'; }
          if($smof_data['select_portfoliobgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_portfoliobgimagerepeat'] . ';'; }
          if($smof_data['select_portfoliobgimageattachment'] != "") { echo 'background-attachment: ' . $smof_data['select_portfoliobgimageattachment'] . ';'; }
          if($smof_data['select_portfoliobgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_portfoliobgimageposition'] . ';'; }
          if($smof_data['select_portfoliobgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_portfoliobgimagesize'] . '; -moz-background-size: ' . $smof_data['select_portfoliobgimagesize'] . '; -o-background-size: ' . $smof_data['select_portfoliobgimagesize'] . '; -ms-background-size: ' . $smof_data['select_portfoliobgimagesize'] . '; background-size: ' . $smof_data['select_portfoliobgimagesize'] . ';'; }
        ?>
      <?php elseif ( 'event' == get_post_type() && $smof_data['switch_eventbg'] ) : // Specific Event Single Background defined ?>
        <?php
          if($smof_data['color_eventbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_eventbgcolor'] . ';'; }
          if($smof_data['media_eventbgimage'] != "") { echo 'background-image: url(' . $smof_data['media_eventbgimage'] . ');'; }
          if($smof_data['select_eventbgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_eventbgimagerepeat'] . ';'; }
          if($smof_data['select_eventbgimageattachment'] != "") { echo 'background-attachment: ' . $smof_data['select_eventbgimageattachment'] . ';'; }
          if($smof_data['select_eventbgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_eventbgimageposition'] . ';'; }
          if($smof_data['select_eventbgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_eventbgimagesize'] . '; -moz-background-size: ' . $smof_data['select_eventbgimagesize'] . '; -o-background-size: ' . $smof_data['select_eventbgimagesize'] . '; -ms-background-size: ' . $smof_data['select_eventbgimagesize'] . '; background-size: ' . $smof_data['select_eventbgimagesize'] . ';'; }
        ?>
      <?php elseif ( 'member' == get_post_type() && $smof_data['switch_memberbg'] ) : //  Specific Member Single Background defined ?>
        <?php
          if($smof_data['color_memberbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_memberbgcolor'] . ';'; }
          if($smof_data['media_memberbgimage'] != "") { echo 'background-image: url(' . $smof_data['media_memberbgimage'] . ');'; }
          if($smof_data['select_memberbgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_memberbgimagerepeat'] . ';'; }
          if($smof_data['select_memberbgimageattachment'] != "") { echo 'background-attachment: ' . $smof_data['select_memberbgimageattachment'] . ';'; }
          if($smof_data['select_memberbgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_memberbgimageposition'] . ';'; }
          if($smof_data['select_memberbgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_memberbgimagesize'] . '; -moz-background-size: ' . $smof_data['select_memberbgimagesize'] . '; -o-background-size: ' . $smof_data['select_memberbgimagesize'] . '; -ms-background-size: ' . $smof_data['select_memberbgimagesize'] . '; background-size: ' . $smof_data['select_memberbgimagesize'] . ';'; }
        ?>
      <?php elseif ( 'menu' == get_post_type() && $smof_data['switch_menubg'] ) : //  Specific Menu Single Background defined ?>
        <?php
          if($smof_data['color_menubgcolor'] != "") { echo 'background-color: ' . $smof_data['color_menubgcolor'] . ';'; }
          if($smof_data['media_menubgimage'] != "") { echo 'background-image: url(' . $smof_data['media_menubgimage'] . ');'; }
          if($smof_data['select_menubgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_menubgimagerepeat'] . ';'; }
          if($smof_data['select_menubgimageattachment'] != "") { echo 'background-attachment: ' . $smof_data['select_menubgimageattachment'] . ';'; }
          if($smof_data['select_menubgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_menubgimageposition'] . ';'; }
          if($smof_data['select_menubgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_menubgimagesize'] . '; -moz-background-size: ' . $smof_data['select_menubgimagesize'] . '; -o-background-size: ' . $smof_data['select_menubgimagesize'] . '; -ms-background-size: ' . $smof_data['select_menubgimagesize'] . '; background-size: ' . $smof_data['select_menubgimagesize'] . ';'; }
        ?>
      <?php else : // Default Background  ?>
        <?php
          if($smof_data['color_bgcolor'] != "") { echo 'background-color: ' . $smof_data['color_bgcolor'] . ';'; }
          if($smof_data['media_bgimage'] != "") { echo 'background-image: url(' . $smof_data['media_bgimage'] . ');'; }
          if($smof_data['select_bgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_bgimagerepeat'] . ';'; }
          if($smof_data['select_bgimageattachment'] != "") { echo 'background-attachment: ' . $smof_data['select_bgimageattachment'] . ';'; }
          if($smof_data['select_bgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_bgimageposition'] . ';'; }
          if($smof_data['select_bgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_bgimagesize'] . '; -moz-background-size: ' . $smof_data['select_bgimagesize'] . '; -o-background-size: ' . $smof_data['select_bgimagesize'] . '; -ms-background-size: ' . $smof_data['select_bgimagesize'] . '; background-size: ' . $smof_data['select_bgimagesize'] . ';'; }
        ?>
      <?php endif; ?>
    <?php endif; ?>
  }
  <?php endif; // end of if(Boxed Layout || Boxed Layout with margin) ?>




  <?php if($smof_data['switch_customstyle'] == true) : // Custom Colors ?>

  /* -- Innner Body -- */
  .inner-body {
    <?php if($smof_data['color_bodybgcolor'] != "") { echo 'background-color: ' . $smof_data['color_bodybgcolor'] . ';'; } ?>
    <?php if($smof_data['border_bodybordertop']['width'] != "") { echo 'border-top-width: ' . $smof_data['border_bodybordertop']['width'] . 'px;'; } ?>
    <?php if($smof_data['border_bodybordertop']['style'] != "") { echo 'border-top-style: ' . $smof_data['border_bodybordertop']['style'] . ';'; } ?>
    <?php if($smof_data['border_bodybordertop']['color'] != "") { echo 'border-top-color: ' . $smof_data['border_bodybordertop']['color'] . ';'; } ?>
  }

  /* -- Selection -- */
  ::selection {
    <?php if($smof_data['color_selectedtextbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_selectedtextbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_selectedtextcolor'] != "") { echo 'color: ' . $smof_data['color_selectedtextcolor'] . ';'; } ?>
  }

  ::-moz-selection {
    <?php if($smof_data['color_selectedtextbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_selectedtextbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_selectedtextcolor'] != "") { echo 'color: ' . $smof_data['color_selectedtextcolor'] . ';'; } ?>
  }



/* ------------------------------------------------------------------------ */
/* 03. Typography
/* ------------------------------------------------------------------------ */

  /* -- Links -- */
  a,
  a:visited {
    <?php if($smof_data['color_linkcolor'] != "") { echo 'color: ' . $smof_data['color_linkcolor'] . ';'; } ?>
  }

  a:hover,
  a:focus {
    <?php if($smof_data['color_linkhovercolor'] != "") { echo 'color: ' . $smof_data['color_linkhovercolor'] . ';'; } ?>
  }




/* ------------------------------------------------------------------------ */
/* 06. Topbar */
/* ------------------------------------------------------------------------ */

  .topbar {
    <?php if($smof_data['color_topbarbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_topbarbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_topbarborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_topbarborderbottomcolor'] . ';'; } ?>
  }

  .topbar .topbar-text {
    <?php if($smof_data['color_topbartextcolor'] != "") { echo 'color: ' . $smof_data['color_topbartextcolor'] . ';'; } ?>
  }

  .topbar .topbar-text a {
    <?php if($smof_data['color_topbartextlinkcolor'] != "") { echo 'color: ' . $smof_data['color_topbartextlinkcolor'] . ';'; } ?>
   }

  .topbar .topbar-text a:hover {
    <?php if($smof_data['color_topbartextlinkhovercolor'] != "") { echo 'color: ' . $smof_data['color_topbartextlinkhovercolor'] . ';'; } ?>
  }


  @media only screen and (max-width: 767px) {
    .topbar .topbar-text {
      <?php if($smof_data['color_topbartextbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_topbartextbgcolor'] . ';'; } ?>
    }
  }


  /* -- Topbar Social -- */
  .topbar ul.social-icons li a:hover{
    <?php if($smof_data['color_topbarsocialiconhoverbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_topbarsocialiconhoverbgcolor'] . ';'; } ?>
  }

  .topbar ul.social-icons li a i {
    <?php if($smof_data['color_topbarsocialiconcolor'] != "") { echo 'color: ' . $smof_data['color_topbarsocialiconcolor'] . ';'; } ?>
  }

  .topbar ul.social-icons li a:hover i {
    <?php if($smof_data['color_topbarsocialiconhovercolor'] != "") { echo 'color: ' . $smof_data['color_topbarsocialiconhovercolor'] . ';'; } ?>
  }


/* ------------------------------------------------------------------------ */
/* 08. Header */
/* ------------------------------------------------------------------------ */

  /* -- Header -- */
  .header {
    <?php if($smof_data['color_headerbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headerbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headerborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headerborderbottomcolor'] . ';'; } ?>
  }

  /* -- Header V1 -- */
  .header-v1 {
    <?php if($smof_data['text_headerheight'] != "") { echo 'height: ' . ( $smof_data['text_headerheight'] + 4 ) . 'px;'; } ?>
  }

  .header-v1 .navigation .sub-menu {
    <?php if($smof_data['text_headerheight'] != "") { echo 'top: ' . $smof_data['text_headerheight'] . 'px;'; } ?>
  }

  .header-v1 .navigation > ul.menu > li > a {
    <?php if($smof_data['text_headerheight'] != "") { echo 'height: ' . $smof_data['text_headerheight'] . 'px;'; } ?>
    <?php if($smof_data['text_headerheight'] != "") { echo 'line-height: ' . $smof_data['text_headerheight'] . 'px;'; } ?>
  }

  /* -- Header V2 V3 -- */


  <?php if($smof_data['switch_mainmenuequalwidthplacement'] == true) : ?>

    .header-v2 .navigation ul.menu,
    .header-v3 .navigation ul.menu {
      display: -webkit-box; /* Android 2~4 */
      -webkit-box-pack: justify; /* Android 2~4 */
      display: -webkit-flex;
      display: -ms-flex;
      display: flex; /*フレキシブルボックス*/
      float: none;
    }

    .header-v2 .navigation ul.menu > li,
    .header-v3 .navigation ul.menu > li {
      flex: 1;
      -webkit-box-flex: 1; /* Android 2~4 */
    }

    .header-v2 .navigation ul.menu > li > a,
    .header-v3 .navigation ul.menu > li > a{
      display: block;
      width: 100%;
      text-align: center;
    }

  <?php endif; // End of Main Menu Equal Width Placement ?>




  .header-v2-container,
  .header-v3-container {
    <?php if($smof_data['text_headerheight'] != "") { echo 'height: ' . $smof_data['text_headerheight'] . 'px;'; } ?>
  }

  .header-v2.header .navigation,
  .header-v3.header .navigation {
    <?php if($smof_data['color_headernavbordertopcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_headernavbordertopcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavbgcolor'] . ';'; } ?>
    <?php if($smof_data['text_headernavheight'] != "") { echo 'height: ' . ($smof_data['text_headernavheight'] + 3) . 'px;'; } ?>
  }


  .header-v2 .navigation ul.menu,
  .header-v3 .navigation ul.menu {
    <?php if($smof_data['text_headernavheight'] != "") { echo 'height: ' . ($smof_data['text_headernavheight'] + 3) . 'px;'; } ?>
  }

  .header-v2 .navigation ul.menu > li > a,
  .header-v3 .navigation ul.menu > li > a {
    <?php if($smof_data['text_headernavheight'] != "") { echo 'height: ' . $smof_data['text_headernavheight'] . 'px !important;;'; } ?>
    <?php if($smof_data['text_headernavheight'] != "") { echo 'line-height: ' . $smof_data['text_headernavheight'] . 'px !important;;'; } ?>
  }

  .header-v2 .navigation .sub-menu,
  .header-v3 .navigation .sub-menu {
    <?php if($smof_data['text_headernavheight'] != "") { echo 'top: ' . $smof_data['text_headernavheight'] . 'px !important;;'; } ?>
  }

  /* -- Logo -- */
  .header .logo {
    <?php if($smof_data['text_headerlogomargintop'] != "") { echo 'margin-top: ' . $smof_data['text_headerlogomargintop'] . 'px;'; } ?>
  }

  /* -- Slogan -- */
  .header .slogan {
    <?php if($smof_data['color_slogantextcolor'] != "") { echo 'color: ' . $smof_data['color_slogantextcolor'] . ';'; } ?>
    <?php if($smof_data['text_headersloganmargintop'] != "") { echo 'margin-top: ' . $smof_data['text_headersloganmargintop'] . 'px;'; } ?>
  }

  .header .slogan a {
    <?php if($smof_data['color_slogantextlinkcolor'] != "") { echo 'color: ' . $smof_data['color_slogantextlinkcolor'] . ';'; } ?>
  }

  .header .slogan a:hover {
    <?php if($smof_data['color_slogantextlinkhovercolor'] != "") { echo 'color: ' . $smof_data['color_slogantextlinkhovercolor'] . ';'; } ?>
  }

  /* -- Main Menu -- */
  .header .navigation ul.menu > li > a {
    <?php if($smof_data['color_headernavmainmenutextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavmainmenutextcolor'] . ';'; } ?>
  }

  .header .navigation ul.menu > li {
    <?php if($smof_data['color_headernavmainmenubgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavmainmenubgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavmainmenuborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavmainmenuborderbottomcolor'] . ';'; } ?>
  }

  /* -- Main Menu Hover -- */
  .header .navigation ul.menu > li:hover > a {
    <?php if($smof_data['color_headernavmainmenuhovertextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavmainmenuhovertextcolor'] . ';'; } ?>
  }

  .header .navigation ul.menu > li:hover {
    <?php if($smof_data['color_headernavmainmenuhoverbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavmainmenuhoverbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavmainmenuhoverborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavmainmenuhoverborderbottomcolor'] . ';'; } ?>
  }

  /* -- Main Menu Active -- */
  .header .navigation ul.menu > li.current_page_item,
  .header .navigation ul.menu > li.current-menu-item,
  .header .navigation ul.menu > li.current-page-ancestor,
  .header .navigation ul.menu > li.current-menu-ancestor,
  .header .navigation ul.menu > li.current-menu-parent,
  .header .navigation ul.menu > li.current_page_ancestor {
    <?php if($smof_data['color_headernavmainmenuactivebgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavmainmenuactivebgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavmainmenuactiveborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavmainmenuactiveborderbottomcolor'] . ';'; } ?>
  }

  .header .navigation ul.menu > li.current_page_item > a,
  .header .navigation ul.menu > li.current-menu-item > a,
  .header .navigation ul.menu > li.current-page-ancestor > a,
  .header .navigation ul.menu > li.current-menu-ancestor > a,
  .header .navigation ul.menu > li.current-menu-parent > a,
  .header .navigation ul.menu > li.current_page_ancestor > a {
    <?php if($smof_data['color_headernavmainmenuactivetextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavmainmenuactivetextcolor'] . ';'; } ?>
  }

  /* -- Main Menu Active Hover -- */
  .header .navigation ul.menu > li.current_page_item:hover,
  .header .navigation ul.menu > li.current-menu-item:hover,
  .header .navigation ul.menu > li.current-page-ancestor:hover,
  .header .navigation ul.menu > li.current-menu-ancestor:hover,
  .header .navigation ul.menu > li.current-menu-parent:hover,
  .header .navigation ul.menu > li.current_page_ancestor:hover {
    <?php if($smof_data['color_headernavmainmenuactivehoverbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavmainmenuactivehoverbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavmainmenuactivehoverborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavmainmenuactivehoverborderbottomcolor'] . ';'; } ?>
  }

  .header .navigation ul.menu > li.current_page_item:hover > a,
  .header .navigation ul.menu > li.current-menu-item:hover > a,
  .header .navigation ul.menu > li.current-page-ancestor:hover > a,
  .header .navigation ul.menu > li.current-menu-ancestor:hover > a,
  .header .navigation ul.menu > li.current-menu-parent:hover > a,
  .header .navigation ul.menu > li.current_page_ancestor:hover > a {
    <?php if($smof_data['color_headernavmainmenuactivehovertextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavmainmenuactivehovertextcolor'] . ';'; } ?>
  }

  /* -- Sub Nav -- */
  .header .navigation .sub-menu {
    <?php if($smof_data['color_headernavmainmenuhoverborderbottomcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_headernavmainmenuhoverborderbottomcolor'] . ';'; } ?>
  }

  /* -- Sub Menu -- */
  .header .navigation .sub-menu li a {
    <?php if($smof_data['color_headernavsubmenutextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavsubmenutextcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenubgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavsubmenubgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenubordertopcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_headernavsubmenubordertopcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavsubmenuborderbottomcolor'] . ';'; } ?>
  }

  /* -- Sub Menu Hover -- */
  .header .navigation .sub-menu li a:hover {
    <?php if($smof_data['color_headernavsubmenuhovertextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavsubmenuhovertextcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuhoverbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavsubmenuhoverbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuhoverbordertopcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_headernavsubmenuhoverbordertopcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuhoverborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavsubmenuhoverborderbottomcolor'] . ';'; } ?>
  }

  /* -- Sub Menu Active -- */
  .header .navigation .sub-menu  li.current_page_item > a,
  .header .navigation .sub-menu  li.current-menu-item > a {
    <?php if($smof_data['color_headernavsubmenuactivetextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavsubmenuactivetextcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuactivebgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavsubmenuactivebgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuactivebordertopcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_headernavsubmenuactivebordertopcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuactiveborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavsubmenuactiveborderbottomcolor'] . ';'; } ?>
  }

  /* -- Sub Menu Active Hover -- */
  .header .navigation .sub-menu  li.current_page_item:hover > a,
  .header .navigation .sub-menu  li.current-menu-item:hover > a {
    <?php if($smof_data['color_headernavsubmenuactivehovertextcolor'] != "") { echo 'color: ' . $smof_data['color_headernavsubmenuactivehovertextcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuactivehoverbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavsubmenuactivehoverbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuactivehoverbordertopcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_headernavsubmenuactivehoverbordertopcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavsubmenuactivehoverborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_headernavsubmenuactivehoverborderbottomcolor'] . ';'; } ?>
  }

  /* -- Header-V2,Header-V3 Nav -- */
  .header-v2 .navigation,
  .header-v3 .navigation {
    <?php if($smof_data['color_headernavbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_headernavbgcolor'] . ';'; } ?>
    <?php if($smof_data['color_headernavbordertopcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_headernavbordertopcolor'] . ';'; } ?>
  }





/* ------------------------------------------------------------------------ */
/* 09. Titlebar */
/* ------------------------------------------------------------------------ */

  .titlebar {
    <?php if($smof_data['color_titlebarbordertopcolor'] != "") { echo 'border-top-color: ' . $smof_data['color_titlebarbordertopcolor'] . ';'; } ?>
    <?php if($smof_data['color_titlebarborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_titlebarborderbottomcolor'] . ';'; } ?>
  }

  .titlebar h2 {
    <?php if($smof_data['color_titlebarsummarytextcolor'] != "") { echo 'color: ' . $smof_data['color_titlebarsummarytextcolor'] . ';'; } ?>
  }

  .breadcrumbs {
    <?php if($smof_data['color_titlebarbreadcrumbstextcolor'] != "") { echo 'color: ' . $smof_data['color_titlebarbreadcrumbstextcolor'] . ';'; } ?>
  }

  .breadcrumbs a {
    <?php if($smof_data['color_titlebarbreadcrumbstextlinkcolor'] != "") { echo 'color: ' . $smof_data['color_titlebarbreadcrumbstextlinkcolor'] . ';'; } ?>
  }

  .breadcrumbs a:hover {
    <?php if($smof_data['color_titlebarbreadcrumbstextlinkhovercolor'] != "") { echo 'color: ' . $smof_data['color_titlebarbreadcrumbstextlinkhovercolor'] . ';'; } ?>
  }


/* ------------------------------------------------------------------------ */
/* 20. Footer
/* ------------------------------------------------------------------------ */

  /* -- Footer -- */
  .footer {
    <?php if($smof_data['color_footerbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_footerbgcolor'] . ';'; } ?>
    <?php if($smof_data['border_footerbordertop']['width'] != "") { echo 'border-top-width: ' . $smof_data['border_footerbordertop']['width'] . 'px;'; } ?>
    <?php if($smof_data['border_footerbordertop']['style'] != "") { echo 'border-top-style: ' . $smof_data['border_footerbordertop']['style'] . ';'; } ?>
    <?php if($smof_data['border_footerbordertop']['color'] != "") { echo 'border-top-color: ' . $smof_data['border_footerbordertop']['color'] . ';'; } ?>
  }

  .footer .widget {
    <?php if($smof_data['color_footertextcolor'] != "") { echo 'color: ' . $smof_data['color_footertextcolor'] . ';'; } ?>
  }

  .footer .widget a{
    <?php if($smof_data['color_footertextlinkcolor'] != "") { echo 'color: ' . $smof_data['color_footertextlinkcolor'] . ';'; } ?>
  }

  .footer .widget a:hover{
    <?php if($smof_data['color_footertextlinkhovercolor'] != "") { echo 'color: ' . $smof_data['color_footertextlinkhovercolor'] . ';'; } ?>
  }

  .footer .widget h3 {
    <?php if($smof_data['color_footerwidgettitleborderbottomcolor'] != "") { echo 'border-bottom-color: ' . $smof_data['color_footerwidgettitleborderbottomcolor'] . ';'; } ?>
  }


  /* -- Copyright -- */
  .copyright {
    <?php if($smof_data['color_copyrightbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_copyrightbgcolor'] . ';'; } ?>
  }

  .copyright .copyright-text {
    <?php if($smof_data['color_copyrighttextcolor'] != "") { echo 'color: ' . $smof_data['color_copyrighttextcolor'] . ';'; } ?>
  }

  .copyright .copyright-text a {
    <?php if($smof_data['color_copyrighttextlinkcolor'] != "") { echo 'color: ' . $smof_data['color_copyrighttextlinkcolor'] . ';'; } ?>
  }

  .copyright .copyright-text a:hover {
    <?php if($smof_data['color_copyrighttextlinkhovercolor'] != "") { echo 'color: ' . $smof_data['color_copyrighttextlinkhovercolor'] . ';'; } ?>
  }

  .copyright ul.social-icons li a i {
    <?php if($smof_data['color_footersocialiconcolor'] != "") { echo 'color: ' . $smof_data['color_footersocialiconcolor'] . ';'; } ?>
  }

  .copyright ul.social-icons li a:hover i {
    <?php if($smof_data['color_footersocialiconhovercolor'] != "") { echo 'color: ' . $smof_data['color_footersocialiconhovercolor'] . ';'; } ?>
  }



/* ------------------------------------------------------------------------ */
/* 24. Accent Color */
/* ------------------------------------------------------------------------ */

  <?php if($smof_data['color_accentcolor'] != "") : ?>

  /* --Blog Single Tag-- */
  .post-content-footer .post-meta .post-tags a:hover {
    background-color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --Pagination-- */
  #pagination a:hover {
    background-color: <?php echo $smof_data['color_accentcolor'] ?>;
    border-color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --Categoty Filter-- */
  .categories ul li a.active {
    background-color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --Event-- */
  .prev-month:hover i,
  .next-month:hover i,
  .current-month:hover { color: <?php echo $smof_data['color_accentcolor'] ?> !important; }

  /* --FAQ-- */
  .faq-item dt.active i:before {
    color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --Member-- */
  .member-item .member-content .member-content-header .member-position h3 {
    color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --Back to top-- */
  #back-to-top:hover {
    background-color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --SideNav-- */
  .widget_side_nav ul li.current_page_item a,
  .widget_side_nav ul li.current_page_item a:hover {
    background-color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --Tag Widget-- */
  .widget_tag_cloud a:hover {
    background-color: <?php echo $smof_data['color_accentcolor'] ?>;
  }

  /* --Flex Slider-- */
  .flex-direction-nav a:hover {
    background-color: <?php echo $smof_data['color_accentcolor'] ?>;
  }
  
  .wooslider-direction-nav a:hover {
    background-color: <?php echo $smof_data['color_accentcolor'] ?> !important;
  }

  <?php endif; // End of Accent Color ?>

  <?php endif; // End of Custom Colors ?>







  <?php if($smof_data['switch_customtypography'] == true) : ?>
  /* Custom Typography ------------------------------------------------------------------------ */

  /* Body ------------------------------------------------------------------------ */
  body {
    font-family: <?php echo $smof_data['font_body']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    font-size: <?php echo $smof_data['font_body']['size']; ?>;
    color: <?php echo $smof_data['font_body']['color']; ?>;
  }

  /* Logo ------------------------------------------------------------------------ */
  .header .logo a.logo-text {
    font: <?php echo $smof_data['font_logo']['style']; ?> <?php echo $smof_data['font_logo']['size']; ?>/1.0 <?php echo $smof_data['font_logo']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_logo']['color']; ?>;
  }

  .header .logo a.logo-text:hover {
    color: <?php echo $smof_data['font_logo']['color']; ?>;
  }

  /* Navigation ------------------------------------------------------------------------ */
  .header .navigation ul.menu > li > a {

    font-family: <?php echo $smof_data['font_nav']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    font-size: <?php echo $smof_data['font_nav']['size']; ?>;

    <?php if($smof_data['font_nav']['style'] == 'normal'): ?>
    font-weight: normal;

    <?php elseif($smof_data['font_nav']['style'] == 'italic'): ?>
    font-weight: normal;
    font-syle: italic;

    <?php elseif($smof_data['font_nav']['style'] == 'bold'): ?>
    font-weight: bold;

    <?php elseif($smof_data['font_nav']['style'] == 'bold italic'): ?>
    font-weight: bold;
    font-syle: italic;

    <?php endif; ?>

  }

  /* Page Title ------------------------------------------------------------------------ */

  .titlebar h1 {
    font: <?php echo $smof_data['font_titlebarmaintitle']['style']; ?> <?php echo $smof_data['font_titlebarmaintitle']['size']; ?>/1.0 <?php echo $smof_data['font_titlebarmaintitle']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_titlebarmaintitle']['color']; ?>;
  }

  /* Page SubTitle ------------------------------------------------------------------------ */
  .titlebar h1 .sub {
    font: <?php echo $smof_data['font_titlebarsubtitle']['style']; ?> <?php echo $smof_data['font_titlebarsubtitle']['size']; ?>/1.0 <?php echo $smof_data['font_titlebarsubtitle']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_titlebarsubtitle']['color']; ?>;
  }

  /* Headlines ------------------------------------------------------------------------ */
  h1{
    font: <?php echo $smof_data['font_h1']['style']; ?> <?php echo $smof_data['font_h1']['size']; ?>/1.6 <?php echo $smof_data['font_h1']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_h1']['color']; ?>;
  }

  h2{
    font: <?php echo $smof_data['font_h2']['style']; ?> <?php echo $smof_data['font_h2']['size']; ?>/1.6 <?php echo $smof_data['font_h2']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_h2']['color']; ?>;
  }

  h3{
    font: <?php echo $smof_data['font_h3']['style']; ?> <?php echo $smof_data['font_h3']['size']; ?>/1.6 <?php echo $smof_data['font_h3']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_h3']['color']; ?>;
  }

  h4{
    font: <?php echo $smof_data['font_h4']['style']; ?> <?php echo $smof_data['font_h4']['size']; ?>/1.6 <?php echo $smof_data['font_h4']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_h4']['color']; ?>;
  }

  h5{
    font: <?php echo $smof_data['font_h5']['style']; ?> <?php echo $smof_data['font_h5']['size']; ?>/1.6 <?php echo $smof_data['font_h5']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_h5']['color']; ?>;
  }

  h6{
    font: <?php echo $smof_data['font_h6']['style']; ?> <?php echo $smof_data['font_h6']['size']; ?>/1.6 <?php echo $smof_data['font_h6']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_h6']['color']; ?>;
  }

  /* Sidebar Widget Title ------------------------------------------------------------------------ */
  .sidebar .widget h3.title {
    font: <?php echo $smof_data['font_sidebarh3']['style']; ?> <?php echo $smof_data['font_sidebarh3']['size']; ?>/1.0 <?php echo $smof_data['font_sidebarh3']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;

    color: <?php echo $smof_data['font_sidebarh3']['color']; ?>;
  }

  /* Footer Widget Title ------------------------------------------------------------------------ */
  .footer .widget h3.title {
    font: <?php echo $smof_data['font_footerh3']['style']; ?> <?php echo $smof_data['font_footerh3']['size']; ?>/1.0 <?php echo $smof_data['font_footerh3']['face']; ?>, Arial, Helvetica, 'Lucida Grande','Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
    color: <?php echo $smof_data['font_footerh3']['color']; ?>;
  }

  <?php endif; // End of Custom Typography ?>



  /* Header ------------------------------------------------------------------------ */
  <?php if($smof_data['media_logoretina'] != '') : ?>
    @media only screen and (-webkit-min-device-pixel-ratio: 2), 
    only screen and (min-device-pixel-ratio: 2) {
      .header .logo .logo-standard { display: none; }
      .header .logo .logo-retina { display: inline; }
    }
  <?php endif; ?>



  /* Titlebar  ------------------------------------------------------------------------ */

  .titlebar {
    <?php if( rwmb_meta('editit_select_titlebarbg')) : // Specific Page Background defined ?>

      <?php if(rwmb_meta('editit_color_titlebarbgcolor')) { echo 'background-color: ' . rwmb_meta('editit_color_titlebarbgcolor') . ';';} ?>
      <?php if(rwmb_meta( 'editit_image_titlebarbgimage', 'type=image' )) {$images = rwmb_meta( 'editit_image_titlebarbgimage', 'type=image' );foreach ( $images as $image ){ echo 'background-image: url(' . $image["full_url"] . ');'; }} ?>
      <?php if(rwmb_meta('editit_select_titlebarbgimagerepeat')) { echo 'background-repeat: ' . rwmb_meta('editit_select_titlebarbgimagerepeat') . ';';} ?>
      <?php if(rwmb_meta('editit_select_titlebarbgimageposition')) { echo 'background-position: ' . rwmb_meta('editit_select_titlebarbgimageposition') . ';';} ?>
      <?php if(rwmb_meta('editit_select_titlebarbgimagesize')) { echo '-webkit-background-size: ' . rwmb_meta('editit_select_titlebarbgimagesize') . '; -moz-background-size: ' . rwmb_meta('editit_select_titlebarbgimagesize') . '; -o-background-size: ' . rwmb_meta('editit_select_titlebarbgimagesize') . '; -ms-background-size: ' . rwmb_meta('editit_select_titlebarbgimagesize') . '; background-size: ' . rwmb_meta('editit_select_titlebarbgimagesize') . ';'; } ?>

    <?php else: //If No Specific Page Background ?>

      <?php if ( 'portfolio' == get_post_type() && $smof_data['switch_portfoliotitlebarbg'] ) : // ポストタイプがポートフォリオで背景が定義されている ?>
  
        <?php
          if($smof_data['color_portfoliotitlebarbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_portfoliotitlebarbgcolor'] . ';'; }
          if($smof_data['media_portfoliotitlebarbgimage'] != "") { echo 'background-image: url(' . $smof_data['media_portfoliotitlebarbgimage'] . ');'; }
          if($smof_data['select_portfoliotitlebarbgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_portfoliotitlebarbgimagerepeat'] . ';'; }
          if($smof_data['select_portfoliotitlebarbgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_portfoliotitlebarbgimageposition'] . ';'; }
          if($smof_data['select_portfoliotitlebarbgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_portfoliotitlebarbgimagesize'] . '; -moz-background-size: ' . $smof_data['select_portfoliotitlebarbgimagesize'] . '; -o-background-size: ' . $smof_data['select_portfoliotitlebarbgimagesize'] . '; -ms-background-size: ' . $smof_data['select_portfoliotitlebarbgimagesize'] . '; background-size: ' . $smof_data['select_portfoliotitlebarbgimagesize'] . ';'; }
        ?>
  
      <?php elseif ( 'event' == get_post_type() && $smof_data['switch_eventtitlebarbg'] ) : // ポストタイプがイベントで背景が定義されている ?>
  
        <?php
          if($smof_data['color_eventtitlebarbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_eventtitlebarbgcolor'] . ';'; }
          if($smof_data['media_eventtitlebarbgimage'] != "") { echo 'background-image: url(' . $smof_data['media_eventtitlebarbgimage'] . ');'; }
          if($smof_data['select_eventtitlebarbgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_eventtitlebarbgimagerepeat'] . ';'; }
          if($smof_data['select_eventtitlebarbgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_eventtitlebarbgimageposition'] . ';'; }
          if($smof_data['select_eventtitlebarbgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_eventtitlebarbgimagesize'] . '; -moz-background-size: ' . $smof_data['select_eventtitlebarbgimagesize'] . '; -o-background-size: ' . $smof_data['select_eventtitlebarbgimagesize'] . '; -ms-background-size: ' . $smof_data['select_eventtitlebarbgimagesize'] . '; background-size: ' . $smof_data['select_eventtitlebarbgimagesize'] . ';'; }
        ?>

      <?php elseif ( 'member' == get_post_type() && $smof_data['switch_membertitlebarbg'] ) : // ポストタイプがメンバーで背景が定義されている ?>
  
        <?php
          if($smof_data['color_membertitlebarbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_membertitlebarbgcolor'] . ';'; }
          if($smof_data['media_membertitlebarbgimage'] != "") { echo 'background-image: url(' . $smof_data['media_membertitlebarbgimage'] . ');'; }
          if($smof_data['select_membertitlebarbgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_membertitlebarbgimagerepeat'] . ';'; }
          if($smof_data['select_membertitlebarbgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_membertitlebarbgimageposition'] . ';'; }
          if($smof_data['select_membertitlebarbgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_membertitlebarbgimagesize'] . '; -moz-background-size: ' . $smof_data['select_membertitlebarbgimagesize'] . '; -o-background-size: ' . $smof_data['select_membertitlebarbgimagesize'] . '; -ms-background-size: ' . $smof_data['select_membertitlebarbgimagesize'] . '; background-size: ' . $smof_data['select_membertitlebarbgimagesize'] . ';'; }
        ?>

      <?php elseif ( 'menu' == get_post_type() && $smof_data['switch_menutitlebarbg'] ) : // ポストタイプがメニューで背景が定義されている ?>
  
        <?php
          if($smof_data['color_menutitlebarbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_menutitlebarbgcolor'] . ';'; }
          if($smof_data['media_menutitlebarbgimage'] != "") { echo 'background-image: url(' . $smof_data['media_menutitlebarbgimage'] . ');'; }
          if($smof_data['select_menutitlebarbgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_menutitlebarbgimagerepeat'] . ';'; }
          if($smof_data['select_menutitlebarbgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_menutitlebarbgimageposition'] . ';'; }
          if($smof_data['select_menutitlebarbgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_menutitlebarbgimagesize'] . '; -moz-background-size: ' . $smof_data['select_menutitlebarbgimagesize'] . '; -o-background-size: ' . $smof_data['select_menutitlebarbgimagesize'] . '; -ms-background-size: ' . $smof_data['select_menutitlebarbgimagesize'] . '; background-size: ' . $smof_data['select_menutitlebarbgimagesize'] . ';'; }
        ?>

      <?php else : // Default Background  ?>

        <?php if($smof_data['switch_customstyle'] == true) : ?>

          <?php
            if($smof_data['color_titlebarbgcolor'] != "") { echo 'background-color: ' . $smof_data['color_titlebarbgcolor'] . ';'; }
            if($smof_data['media_titlebarbgimage'] != "") { echo 'background-image: url(' . $smof_data['media_titlebarbgimage'] . ');'; }
            if($smof_data['select_titlebarbgimagerepeat'] != "") { echo 'background-repeat: ' . $smof_data['select_titlebarbgimagerepeat'] . ';'; }
            if($smof_data['select_titlebarbgimageposition'] != "") { echo 'background-position: ' . $smof_data['select_titlebarbgimageposition'] . ';'; }
            if($smof_data['select_titlebarbgimagesize'] != "") { echo '-webkit-background-size: ' . $smof_data['select_titlebarbgimagesize'] . '; -moz-background-size: ' . $smof_data['select_titlebarbgimagesize'] . '; -o-background-size: ' . $smof_data['select_titlebarbgimagesize'] . '; -ms-background-size: ' . $smof_data['select_titlebarbgimagesize'] . '; background-size: ' . $smof_data['select_titlebarbgimagesize'] . ';'; }
          ?>

        <?php endif; ?>

      <?php endif; ?>
    <?php endif; ?>

  }


  /* Custom CSS Code ------------------------------------------------------------------------ */ 

  <?php if($smof_data['textarea_customcsscode'] != '') { echo $smof_data['textarea_customcsscode']; } ?>

</style>

<?php }
add_action( 'wp_head', 'editit_styles_custom', 100 );
?>