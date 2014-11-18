<?php
/**
 * Shortcodes
 *
 *
 * @file           shortcodes.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/shortcodes.php
 */
?>
<?php

/*-----------------------------------------------------------------------------------*/
/* 01.Columns
/*-----------------------------------------------------------------------------------*/

// 1/3
function editit_column_one_third( $atts, $content = null ) {
  return '<div class="one-third">' . do_shortcode($content) . '</div>';
}
function editit_column_one_third_last( $atts, $content = null ) {
  return '<div class="one-third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 2/3
function editit_column_two_third( $atts, $content = null ) {
  return '<div class="two-third">' . do_shortcode($content) . '</div>';
}
function editit_column_two_third_last( $atts, $content = null ) {
  return '<div class="two-third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 1/4
function editit_column_one_fourth( $atts, $content = null ) {
  return '<div class="one-fourth">' . do_shortcode($content) . '</div>';
}
function editit_column_one_fourth_last( $atts, $content = null ) {
  return '<div class="one-fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 1/2
function editit_column_one_half( $atts, $content = null ) {
  return '<div class="one-half">' . do_shortcode($content) . '</div>';
}
function editit_column_one_half_last( $atts, $content = null ) {
  return '<div class="one-half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 3/4
function editit_column_three_fourth( $atts, $content = null ) {
  return '<div class="three-fourth">' . do_shortcode($content) . '</div>';
}
function editit_column_three_fourth_last( $atts, $content = null ) {
  return '<div class="three-fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 1/5
function editit_column_one_fifth( $atts, $content = null ) {
  return '<div class="one-fifth">' . do_shortcode($content) . '</div>';
}
function editit_column_one_fifth_last( $atts, $content = null ) {
  return '<div class="one-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 2/5
function editit_column_two_fifth( $atts, $content = null ) {
  return '<div class="two-fifth">' . do_shortcode($content) . '</div>';
}
function editit_column_two_fifth_last( $atts, $content = null ) {
  return '<div class="two-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 3/5
function editit_column_three_fifth( $atts, $content = null ) {
  return '<div class="three-fifth">' . do_shortcode($content) . '</div>';
}
function editit_column_three_fifth_last( $atts, $content = null ) {
  return '<div class="three-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 4/5
function editit_column_four_fifth( $atts, $content = null ) {
  return '<div class="four-fifth">' . do_shortcode($content) . '</div>';
}
function editit_column_four_fifth_last( $atts, $content = null ) {
  return '<div class="four-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 1/6
function editit_column_one_sixth( $atts, $content = null ) {
  return '<div class="one-sixth">' . do_shortcode($content) . '</div>';
}
function editit_column_one_sixth_last( $atts, $content = null ) {
  return '<div class="one-sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

// 5/6
function editit_column_five_sixth( $atts, $content = null ) {
  return '<div class="five-sixth">' . do_shortcode($content) . '</div>';
}
function editit_column_five_sixth_last( $atts, $content = null ) {
  return '<div class="five-sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}



/*-----------------------------------------------------------------------------------*/
/* 02.Space
/*-----------------------------------------------------------------------------------*/
function editit_space( $atts, $content = null) {

  extract( shortcode_atts( array(
    'height'  => '30'
    ), $atts ) );
      
  if( $height == '' ) {
    $return = '';
  }else{
    $return = 'style="height: ' . $height . 'px;"';
  }
      
  return '<div class="space" ' . $return . '></div>';

}



/*-----------------------------------------------------------------------------------*/
/* 03.HR Dividers
/*-----------------------------------------------------------------------------------*/
function editit_divider( $atts, $content = null) {
  extract( shortcode_atts( array(
    'style'  => '1',
    'margin' => ''
  ), $atts ) );
      
  if($margin == '') {
    $divider_margin = "";
  } else{
    $divider_margin = "style='margin:" . $margin . " !important;'";
  }

  return '<div class="hr hr' . $style . '" ' . $divider_margin . '></div>';  
}



/*-----------------------------------------------------------------------------------*/
/* 04.Headline */
/*-----------------------------------------------------------------------------------*/
function editit_headline( $atts, $content = null){
  extract(shortcode_atts(array(
    'heading'   => 'h3',
    'style'     => '1',
    'title'     => 'Title',
    'align'     => 'left',
    'margin'    => '',
    'id'        => ''
  ), $atts));

  if($margin == '') {
    $headline_margin = "";
  } else{
    $headline_margin = "style='margin:" . $margin . " !important;'";
  }

  return '<' . $heading . ' class="headline headline' . $style . ' ' . $align . '" ' . $headline_margin . ' id="' . $id . '"><span>' . $title . '</span></' . $heading . '>';
}



/*-----------------------------------------------------------------------------------*/
/* 05.Accordion */
/*-----------------------------------------------------------------------------------*/
function editit_accordion( $atts, $content = null){

  extract(shortcode_atts(array(
    'title' => '',
    'icon' => '',
    'open' => "false"
  ), $atts));

  if($icon == '') {
    $accordion_icon = "";
  }else{
    $accordion_icon = "<i class='icon icon-" . $icon . "'></i>";
  }

  if($open == "true") {
    $accordion_open = "active";
  }else{
    $accordion_open = '';
  }

  return '<div class="accordion"><div class="accordion-title ' . $accordion_open . '">' . $accordion_icon . '' . $title . '<span class="icon toggle"></span></div><div class="accordion-inner"><p>' . do_shortcode($content) . '</p></div></div>';

}



/*-----------------------------------------------------------------------------------*/
/* 06.Tabs */
/*-----------------------------------------------------------------------------------*/
function editit_tabgroup( $atts, $content = null ) {
  $GLOBALS['tab_count'] = 0;
  $i = 1;
  $randomid = rand();

  do_shortcode( $content );

  if( is_array( $GLOBALS['tabs'] ) ){
  
    foreach( $GLOBALS['tabs'] as $tab ){  
      if( $tab['icon'] != '' ){
        $icon = '<i class="icon icon-' . $tab['icon'] . '"></i>';
      }
      else{
        $icon = '';
      }
      $tabs[] = '<li class="tab"><a href="#panel' . $randomid . $i . '">' . $icon . $tab['title'] . '</a></li>';
      $panes[] = '<div class="panel" id="panel' . $randomid . $i . '"><p>' . $tab['content'] . '</p></div>';
      $i++;
      $icon = '';
    }
    $return = '<div class="tabset"><ul class="tabs">' . implode( "\n", $tabs ) . '</ul>' . implode( "\n", $panes ) . '</div>';
  }
  return $return;
}

function editit_tab( $atts, $content = null) {
  extract(shortcode_atts(array(
      'title' => '',
      'icon'  => ''
  ), $atts));
  
  $x = $GLOBALS['tab_count'];
  $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'icon' => $icon, 'content' =>  $content );
  $GLOBALS['tab_count']++;
}



/*-----------------------------------------------------------------------------------*/
/* 07.Styled Tables */
/*-----------------------------------------------------------------------------------*/
function editit_styled_table( $atts, $content = null) {

  extract( shortcode_atts( array(
    'style'   => '1'
  ), $atts ) );
      
  return '<div class="styled-table style-' . $style . '">' . do_shortcode($content) . '</div>';

}



/*-----------------------------------------------------------------------------------*/
/* 08.Google Font */
/*-----------------------------------------------------------------------------------*/
function editit_googlefont( $atts, $content = null) {
  extract( shortcode_atts( array(
    'font'   => 'ABeeZee',
    'size'   => '40px',
    'margin' => '0px'
  ), $atts ) );

  $default = array(
        'arial',
        'verdana',
        'trebuchet',
        'georgia',
        'times',
        'tahoma',
        'helvetica',
        "mincho"
  );

  if(!in_array($font, $default)) {

   $google = preg_replace("/ /","+",$font);
   return '<link href="http://fonts.googleapis.com/css?family='.$google.'&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese" rel="stylesheet" type="text/css">
          <div class="googlefont" style="font-family:\'' .$font. '\', serif !important; font-size:' .$size. ' !important; margin: ' .$margin. ' !important;">' . do_shortcode($content) . '</div>';

  }else{

    if($font != 'mincho') {
      return '<div class="googlefont" style="font-family:\'' .$font. '\', serif !important; font-size:' .$size. ' !important; margin: ' .$margin. ' !important;">' . do_shortcode($content) . '</div>';
    }else{
      return '<div class="googlefont" style="font-family: \'Kozuka Mincho Pro\',\'Kozuka Mincho Std\',\'小塚明朝 Pro R\',\'小塚明朝 Std R\',\'Hiragino Mincho Pro\',\'ヒラギノ明朝 Pro W3\',\'ＭＳ Ｐ明朝\',\'MS PMincho\',serif, serif !important; font-size:' .$size. ' !important; margin: ' .$margin. ' !important;">' . do_shortcode($content) . '</div>';
    }

  }

}



/*-----------------------------------------------------------------------------------*/
/* 09.Highlight
/*-----------------------------------------------------------------------------------*/
function editit_highlight( $atts, $content = null) {
  extract( shortcode_atts( 
    array( 
      'color'             => '',
      'background_color'  => '',
      'style'             => 'yellow'
    ), $atts ) 
  );

  if(empty($color) && empty($background_color)){
    switch ($style) {
      case 'yellow':
        $color = '#665B42';
        $background_color = '#FFF7A8';
        break;
      case 'blue':
        $color = '#5096B9';
        $background_color = '#E7F6FD';
        break;
      case 'green':
        $color = '#5D8F22';
        $background_color = '#EDFAE1';
        break;
      case 'red':
        $color = '#FFF4F4';
        $background_color = '#EC6A6A';
        break;
      case 'pink':
        $color = '#E46161';
        $background_color = '#FDEAEA';
        break;
      default:
        $color = '#665B42';
        $background_color = '#FFF7A8';
        break;
    }
  }

  return '<span class="" style="color:'.esc_attr($color).'; background-color:'.esc_attr($background_color).'" >' . do_shortcode($content) . '</span>';

}



/*-----------------------------------------------------------------------------------*/
/* 10.Icons
/*-----------------------------------------------------------------------------------*/
function editit_icon( $atts, $content = null ) {

  extract(shortcode_atts(array(
    'icon'       => 'check',
    'size'       => 'small',
    'color'      => '#000000',
    'background' => '#ffffff',
    'align'      => 'center',
    'circle'     => 'false',
    'spin'       => 'false',
    'rotate'     => 'normal'
  ), $atts));

  if($size == 'large') {
    $icon_size = ' icon-large';
  }elseif($size == 'medium') {
    $icon_size = ' icon-medium';
  }elseif($size == 'small') {
    $icon_size = ' icon-small';
  }else{
    $icon_size = ' icon-small';
  }

  if($circle == 'true') {
    $icon_circ = ' icon-circ';
    $icon_bgcolor = ' background-color:' . $background . ';';
    $icon_color = ' color: ' . $color . ';';
    $icon_align = ' style="text-align: '.$align.' !important;"';
  }else{
    $icon_circ = '';
    $icon_bgcolor = ' background-color: transparent;';
    $icon_color = ' color: ' . $color . ';';
    $icon_align = ' style="text-align: '.$align.' !important;"';
  }

  if($spin == 'true') {
    $icon_spin = ' icon-spin';
    $icon_rotate = '';
  }else{
    $icon_spin = '';

    if($rotate == '90') {
      $icon_rotate = ' icon-rotate-90';
    }elseif($rotate == '180'){
      $icon_rotate = ' icon-rotate-180';
    }elseif($rotate == '270'){
      $icon_rotate = ' icon-rotate-270';
    }else{
      $icon_rotate = '';
    }

  }

  $out = '<div class="retina-icon"' . $icon_align . '><i class="icon icon-' . $icon . '' . $icon_size . '' . $icon_circ . '' . $icon_spin . '' . $icon_rotate . '" style="' . $icon_bgcolor . '' . $icon_color . '"></i></div>';
  return $out;

}



/*-----------------------------------------------------------------------------------*/
/* 11.Buttons 
/*-----------------------------------------------------------------------------------*/
function editit_buttons( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'link'      => '#',
    'size'      => 'medium',
    'target'    => '_self',
    'lightbox'  => 'false', 
    'color'     => 'white',
    'icon'      => ''
  ), $atts));

  if($lightbox == 'true') {
    $buttons_lightbox = 'prettyPhoto ';
  }else{
    $buttons_lightbox = '';
  }

  if($icon == '') {
    $buttons_icon = '';
  }else{
    $buttons_icon = '<i class="icon icon-' . $icon . '"></i>';
  }

  return '<a href="' . $link . '" class="' . $buttons_lightbox . 'button ' . $size . ' ' . $color . '" rel="slides[buttonlightbox]" target="' . $target . '">' . $buttons_icon . do_shortcode($content) . '</a>';

}



/*-----------------------------------------------------------------------------------*/
/* 12.List */
/*-----------------------------------------------------------------------------------*/
function editit_list( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'border'         => 'true',
    'border_style'   => 'solid',
  ), $atts));


  if($border == 'true') {

    if($border_style == 'dotted'){
      $border_class = 'bordered dotted';
    }else{
      $border_class = 'bordered';
    }

  }else{
    $border_class = '';
  }

  $out = '<ul class="styled-list ' . $border_class . '">'. do_shortcode($content) . '</ul>';
  return $out;
}

/*-----------------------------------------------------------------------------------*/

function editit_list_item( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'icon'      => 'ok'
  ), $atts));
  $out = '<li><i class="icon icon-'.$icon.'"></i>'. do_shortcode($content) . '</li>';
  return $out;
}



/*-----------------------------------------------------------------------------------*/
/* 13.Box */
/*-----------------------------------------------------------------------------------*/
function editit_box($atts, $content = null) {
  extract(shortcode_atts(array(
    'img'           => '',
    'url'           => '',
    'target'        => '_self',
    'color'         => '#444',
    'background'    => '#ffffff',
    'align'         => 'left',
    'padding'       => '',
    'border'        => 'true',
    'border_width'  => '1',
    'border_style'  => 'solid',
    'border_color'  => '#e3e3e3'
  ), $atts));


  if($img != '') {

    if($border == 'true') {
      $image_margin_bottom = 'style="margin-bottom: -' . $border_width . 'px"';
    }else{
      $image_margin_bottom = '';
    }

    $img_box = '<div class="image-box" ' . $image_margin_bottom . '>';

    if($url != '') {
      $img_box .= '<a href="' . $url . '" target="' . $target . '"><img src="' . $img . '"></a>';
    }else{
      $img_box .= '<img src="' . $img . '">';
    }

    $img_box .= '</div>';

  }else{
    $img_box .= '';
  }

  if($padding == '') {
    $box_padding = "";
  } else{
    $box_padding = "padding:" . $padding . " !important;";
  }



  if($border == 'true') {
    $box_border = 'style="border: ' . $border_width . 'px ' . $border_style . ' ' . $border_color . '; color: ' . $color . '; background-color: ' . $background . '; text-align: ' . $align . '; ' . $box_padding . '"';
  }else{
    $box_border = 'style="color: ' . $color . '; background-color: ' . $background . '; text-align: ' . $align . '; ' . $box_padding . '"';
  }



  $out = $img_box . '<div class="box" ' . $box_border . '>' . do_shortcode($content) . '</div>';


  return $out;
}



/*-----------------------------------------------------------------------------------*/
/* 14.Icon Box */
/*-----------------------------------------------------------------------------------*/
function editit_icon_box($atts, $content = null) {
  extract(shortcode_atts(array(
    'icon'          => 'check',
    'icon_color'    => '#000000',
    'title'         => ''
  ), $atts));

  if($title != '') {
    $icon_box_tile = '<h4 class="icon-box-title">' . $title . '</h4>';
  }

  $out = '<div class="icon-box"><span class="icon-box-icon"><i class="icon icon-' . $icon . '" style="color:' . $icon_color . ';"></i></span>' . $icon_box_tile . '<div class="icon-box-content">' . do_shortcode($content) . '</div></div>';

  return $out;
}



/*-----------------------------------------------------------------------------------*/
/* 15.Video Embed */
/*-----------------------------------------------------------------------------------*/
function editit_video_embed($atts) {
  extract(shortcode_atts(array(
    'type'  => '',
    'id'  => '',
    'width'   => false,
    'height'  => false,
    'autoplay'  => ''
  ), $atts));
  
  if ($height && !$width){
    $width = intval($height * 16 / 9);
  }
  if (!$height && $width){
    $height = intval($width * 9 / 16);
  }
  if (!$height && !$width){
    $height = 315;
    $width = 560;
  }
  
  $autoplay = ($autoplay == 'yes' ? '1' : false);
    
  if($type == "vimeo"){

    $return = "<div class='embed-video'><iframe src='http://player.vimeo.com/video/$id?autoplay=$autoplay&amp;title=0&amp;byline=0&amp;portrait=0' width='$width' height='$height' class='iframe'></iframe></div>";

  }else if($type == "youtube"){

    $return = "<div class='embed-video'><iframe src='http://www.youtube.com/embed/$id?HD=1;rel=0;showinfo=0' width='$width' height='$height' class='iframe'></iframe></div>";

  }else if($type == "dailymotion"){

    $return = "<div class='embed-video'><iframe src='http://www.dailymotion.com/embed/video/$id?width=$width&amp;autoPlay={$autoplay}&foreground=%23FFFFFF&highlight=%23CCCCCC&background=%23000000&logo=0&hideInfos=1' width='$width' height='$height' class='iframe'></iframe></div>";

  }else if($type == "niconico"){

    $return = "<div class='embed-video'><script type='text/javascript' src='http://ext.nicovideo.jp/thumb_watch/$id?w=$width&amp;h=$height'></script><noscript>このページではJavaScriptを使用しています。</noscript></div>";

  }

  if (!empty($id)){
    return $return;
  }
}



/*-----------------------------------------------------------------------------------*/
/* 16. Responsive Image
/*-----------------------------------------------------------------------------------*/
function editit_responsive_image( $atts, $content = null ) {

  extract(shortcode_atts(array(), $atts));
  return '<span class="responsive-image">' . do_shortcode($content) . '</span>';

}



/*-----------------------------------------------------------------------------------*/
/* 17. Google Maps
/*-----------------------------------------------------------------------------------*/

add_action('wp_head', 'gmaps_header');
 
function gmaps_header() {
  ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <?php
}

function editit_google_maps($atts) {

  // default atts
  $atts = shortcode_atts(array( 
    'lat'   => '0', 
    'lon'    => '0',
    'id' => 'map',
    'z' => '1',
    'w' => '400',
    'h' => '300',
    'maptype' => 'ROADMAP',
    'address' => '',
    'kml' => '',
    'kmlautofit' => 'yes',
    'marker' => '',
    'markerimage' => '',
    'traffic' => 'no',
    'bike' => 'no',
    'fusion' => '',
    'start' => '',
    'end' => '',
    'infowindow' => '',
    'infowindowdefault' => 'yes',
    'directions' => '',
    'hidecontrols' => 'false',
    'scale' => 'false',
    'scrollwheel' => 'true',
    'style' => ''
  ), $atts);
                  
  $returnme = '<div id="' .$atts['id'] . '" style="width:' . $atts['w'] . 'px;height:' . $atts['h'] . 'px;" class="google_map ' . $atts['style'] . '"></div>';
  
  //directions panel
  if($atts['start'] != '' && $atts['end'] != '') 
  {
    $panelwidth = $atts['w']-20;
    $returnme .= '<div id="directionsPanel" style="width:' . $panelwidth . 'px;height:' . $atts['h'] . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>';
  }

  $returnme .= '
  <script type="text/javascript">
    var latlng = new google.maps.LatLng(' . $atts['lat'] . ', ' . $atts['lon'] . ');
    var myOptions = {
      zoom: ' . $atts['z'] . ',
      center: latlng,
      scrollwheel: ' . $atts['scrollwheel'] .',
      scaleControl: ' . $atts['scale'] .',
      disableDefaultUI: ' . $atts['hidecontrols'] .',
      mapTypeId: google.maps.MapTypeId.' . $atts['maptype'] . '
    };
    var ' . $atts['id'] . ' = new google.maps.Map(document.getElementById("' . $atts['id'] . '"),
    myOptions);
    ';
        
    //kml
    if($atts['kml'] != '') 
    {
      if($atts['kmlautofit'] == 'no') 
      {
        $returnme .= '
        var kmlLayerOptions = {preserveViewport:true};
        ';
      }
      else
      {
        $returnme .= '
        var kmlLayerOptions = {preserveViewport:false};
        ';
      }
      $returnme .= '
      var kmllayer = new google.maps.KmlLayer(\'' . html_entity_decode($atts['kml']) . '\',kmlLayerOptions);
      kmllayer.setMap(' . $atts['id'] . ');
      ';
    }

    //directions
    if($atts['start'] != '' && $atts['end'] != '') 
    {
      $returnme .= '
      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay.setMap(' . $atts['id'] . ');
        directionsDisplay.setPanel(document.getElementById("directionsPanel"));

        var start = \'' . $atts['start'] . '\';
        var end = \'' . $atts['end'] . '\';
        var request = {
          origin:start, 
          destination:end,
          travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });


      ';
    }
    
    //traffic
    if($atts['traffic'] == 'yes')
    {
      $returnme .= '
      var trafficLayer = new google.maps.TrafficLayer();
      trafficLayer.setMap(' . $atts['id'] . ');
      ';
    }
  
    //bike
    if($atts['bike'] == 'yes')
    {
      $returnme .= '      
      var bikeLayer = new google.maps.BicyclingLayer();
      bikeLayer.setMap(' . $atts['id'] . ');
      ';
    }
    
    //fusion tables
    if($atts['fusion'] != '')
    {
      $returnme .= '      
      var fusionLayer = new google.maps.FusionTablesLayer(' . $atts['fusion'] . ');
      fusionLayer.setMap(' . $atts['id'] . ');
      ';
    }
  
    //address
    if($atts['address'] != '')
    {
      $returnme .= '
        var geocoder_' . $atts['id'] . ' = new google.maps.Geocoder();
      var address = \'' . $atts['address'] . '\';
      geocoder_' . $atts['id'] . '.geocode( { \'address\': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          ' . $atts['id'] . '.setCenter(results[0].geometry.location);
          ';
          
          if ($atts['marker'] !='')
          {
            //add custom image
            if ($atts['markerimage'] !='')
            {
              $returnme .= 'var image = "'. $atts['markerimage'] .'";';
            }
            $returnme .= '
            var marker = new google.maps.Marker({
              map: ' . $atts['id'] . ', 
              ';
              if ($atts['markerimage'] !='')
              {
                $returnme .= 'icon: image,';
              }
            $returnme .= '
              position: ' . $atts['id'] . '.getCenter()
            });
            ';

            //infowindow
            if($atts['infowindow'] != '') 
            {
              //first convert and decode html chars
              $thiscontent = htmlspecialchars_decode($atts['infowindow']);
              $returnme .= '
              var contentString = \'' . $thiscontent . '\';
              var infowindow = new google.maps.InfoWindow({
                content: contentString
              });
                    
              google.maps.event.addListener(marker, \'click\', function() {
                infowindow.open(' . $atts['id'] . ',marker);
              });
              ';

              //infowindow default
              if ($atts['infowindowdefault'] == 'yes')
              {
                $returnme .= '
                  infowindow.open(' . $atts['id'] . ',marker);
                ';
              }
            }
          }
      $returnme .= '
        } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
      });
      ';
    }

    //marker: show if address is not specified
    if ($atts['marker'] != '' && $atts['address'] == '')
    {
      //add custom image
      if ($atts['markerimage'] !='')
      {
        $returnme .= 'var image = "'. $atts['markerimage'] .'";';
      }

      $returnme .= '
        var marker = new google.maps.Marker({
        map: ' . $atts['id'] . ', 
        ';
        if ($atts['markerimage'] !='')
        {
          $returnme .= 'icon: image,';
        }
      $returnme .= '
        position: ' . $atts['id'] . '.getCenter()
      });
      ';

      //infowindow
      if($atts['infowindow'] != '') 
      {
        $returnme .= '
        var contentString = \'' . $atts['infowindow'] . '\';
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
              
        google.maps.event.addListener(marker, \'click\', function() {
          infowindow.open(' . $atts['id'] . ',marker);
        });
        ';
        //infowindow default
        if ($atts['infowindowdefault'] == 'yes')
        {
          $returnme .= '
            infowindow.open(' . $atts['id'] . ',marker);
          ';
        }       
      }
    }
    
    $returnme .= '</script>';
    
    
    return $returnme;
}



/*-----------------------------------------------------------------------------------*/
/* 18. Recent Posts
/*-----------------------------------------------------------------------------------*/
function editit_recent_posts( $atts, $content = null) {
  extract( shortcode_atts( array(
    'title'          => __('Recent Posts', 'editit'),
    'category'       => '',
    'number'         => '5',
    'thumbnail'      => 'no',
    'date'           => 'yes',
    'excerpt'        => 'no',
    'excerpt_length' => '40',
    'read_more'      => 'yes',
    'heading'        => 'h3',
    'heading_style'  => '1'
  ), $atts ) );

  if ($title != ""){
    $out = '<' . $heading . ' class="headline headline' . $heading_style . '"><span>' . $title . '</span></h3>';
  }

  // create wp_query to get latest items
  $args = array(
            'post_type'            => 'post',
            'orderby'              => "date",
            'post_status'          => 'publish',
            'posts_per_page'       => $number,
            'ignore_sticky_posts'  => 1
          );

  if($category) {

    $args['tax_query'][] = array(
                             'taxonomy'  => 'category',
                             'field'     => 'slug',
                             'terms'     => $category
                           );

  }


  global $custom_excerpt_length;
  global $readmore;

  $custom_excerpt_length = $excerpt_length != '' ? $excerpt_length : 30;
  $readmore =  $read_more == 'yes' ? true : false;

  $th_query = null;
  $th_query = new WP_Query($args);

  if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();

    $out .= '<article class="recent-post clearfix">';

    if(has_post_thumbnail() && ($thumbnail == "yes") ) :
      $out .= '<div class="post-image">';
      $out .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">';
      $out .= get_the_post_thumbnail(get_the_ID(), 'square' );
      $out .= '</a></div>';
    endif;

    $out .= '<div class="post-content">
               <div class="post-content-header">
            ';

    if($date != "no" ) :
      $out .= '<div class="post-date">
                 <time datetime="' . get_the_time('Y-m-d') . '" title="' . get_the_time('Y-m-d') . '">' . get_the_time(get_option('date_format')) . '</time>
               </div>
              ';
    endif;

    $out .= '<div class="post-title">
               <h4><a href="' . get_the_permalink() . '" title="' . sprintf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ) . '">' . get_the_title() . '</a></h4>
             </div>
            ';

    $out .= '</div>';

    if($excerpt != "no" ) :
      $out .= '<div class="post-excerpt">' . get_the_excerpt() . '
                 <div class="clear"></div>
               </div>
              ';
    endif;

    $out .= '</div>
           </article>';

  endwhile; endif;
  wp_reset_query();

  return $out; 
}



/*-----------------------------------------------------------------------------------*/
/* 19. Recent News
/*-----------------------------------------------------------------------------------*/
function editit_recent_news( $atts, $content = null) {
  extract( shortcode_atts( array(
    'title'          => __('Recent News', 'editit'),
    'category'       => '',
    'number'         => '5',
    'thumbnail'      => 'no',
    'date'           => 'yes',
    'excerpt'        => 'no',
    'excerpt_length' => '40',
    'read_more'      => 'yes',
    'heading'        => 'h3',
    'heading_style'  => '1'
  ), $atts ) );


  if ($title != ""){
    $out = '<' . $heading . ' class="headline headline' . $heading_style . '"><span>' . $title . '</span></h3>';
  }

  // create wp_query to get latest items -----------
  $args = array(
            'post_type'            => 'news',
            'orderby'              => "date",
            'post_status'          => 'publish',
            'posts_per_page'       => $number,
            'ignore_sticky_posts'  => 1
          );


  if($category) {

    $args['tax_query'][] = array(
                             'taxonomy'  => 'news_category',
                             'field'     => 'slug',
                             'terms'     => $category
                           );

  }


  global $custom_excerpt_length;
  global $readmore;

  $custom_excerpt_length = $excerpt_length != '' ? $excerpt_length : 30;
  $readmore =  $read_more == 'yes' ? true : false;

  $th_query = null;
  $th_query = new WP_Query($args);

  if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();

    $out .= '<article class="recent-news clearfix">';

    if(has_post_thumbnail() && ($thumbnail == "yes") ) :
      $out .= '<div class="post-image">';
      $out .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">';
      $out .= get_the_post_thumbnail(get_the_ID(), 'square' );
      $out .= '</a></div>';
    endif;

    $out .= '<div class="post-content">
               <div class="post-content-header">
            ';

    if($date != "no" ) :
      $out .= '<div class="post-date">
                 <time datetime="' . get_the_time('Y-m-d') . '" title="' . get_the_time('Y-m-d') . '">' . get_the_time(get_option('date_format')) . '</time>
               </div>
              ';
    endif;

    $out .= '<div class="post-title">
               <h4><a href="' . get_the_permalink() . '" title="' . sprintf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ) . '">' . get_the_title() . '</a></h4>
             </div>
            ';

    $out .= '</div>';


    if($excerpt != "no" ) :
      $out .= '<div class="post-excerpt">' . get_the_excerpt() . '
                 <div class="clear"></div>
               </div>
              ';
    endif;

    $out .= '</div>
           </article>';

  endwhile; endif;
  wp_reset_query();


  return $out; 
}



/*-----------------------------------------------------------------------------------*/
/* 20. Recent Portfolio
/*-----------------------------------------------------------------------------------*/
function editit_recent_portfolio( $atts, $content = null) {
  extract( shortcode_atts( array(
    'title'           => __('Recent Portfolio', 'editit'),
    'number'          => '5',
    'category'        => '',
    'show_title'      => 'yes',
    'heading'        => 'h3',
    'heading_style'  => '1'
  ), $atts ) );


  if ($title != ""){
    $out = '<' . $heading . ' class="headline headline' . $heading_style . '"><span>' . $title . '</span></h3>';
  }
    $out .= '<div>';
  // create wp_query to get latest items -----------
  $args = array(
            'post_type'            => 'portfolio',
            'order'                => 'ASC',
            'post_status'          => 'publish',
            'posts_per_page'       => $number,
            'ignore_sticky_posts'  => 1
          );

  if($category) {

    $args['tax_query'][] = array(
                             'taxonomy'  => 'portfolio_category',
                             'field'     => 'slug',
                             'terms'     => $category
                           );

  }


  if( $show_title == 'yes' ){ $showportfoliotitle = true; $showportfoliotitleclass = 'showportfoliotitle '; }else{ $showportfoliotitle = false; $showportfoliotitleclass = ''; }



  $th_query = null;
  $th_query = new WP_Query($args);

  if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();

    $out .= '<article class="recent-portfolio-item ' . $showportfoliotitleclass . 'clearfix">';


    $link = '';
    $embed = '';

    if ( rwmb_meta( 'editit_selectportfoliolinktolightbox' )){

      if( rwmb_meta( 'editit_selectportfoliomedia' ) == "video" && rwmb_meta( 'editit_textareavideoembed' ) != "") {
        $randomid = rand();
        $link = '<a href="#embed-video-' . $randomid . '" class="lightbox prettyPhoto" title="'. get_the_title() .'" rel="prettyPhoto[portfolio]">';
        $embed = '<div id="embed-video-'.$randomid.'" class="embed-video">' . rwmb_meta( 'editit_textareavideoembed' ) . '</div>';
      }else{
        $link = '<a href="'. wp_get_attachment_url( get_post_thumbnail_id() ) .'" class="lightbox prettyPhoto" rel="prettyPhoto" title="'. get_the_title() .'">';
      }

    }else{

      if ( rwmb_meta( 'editit_selectportfoliolinktosinglepage' )){
        $link = '<a href="' . get_permalink() . '" title="' . sprintf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ) . '" class="link">';
      }

    }

    if ( has_post_thumbnail()):
      $out .= '<div class="portfolio-thumbnail">';
      $out .= '<span class="pic">';
      $out .= $link;
      $out .= get_the_post_thumbnail(get_the_ID(), 'portfolio' );
      if( $link != '' ):
        $out .= '</a>';
       endif;

      $out .= '</span>';
      $out .= '</div>';
    endif;

    if( $showportfoliotitle ) :
      $out .= '<div class="portfolio-content">';
      $out .= '<div class="portfolio-content-header"><div class="portfolio-title"><h2>';

      if( rwmb_meta( 'editit_selectportfoliolinktosinglepage' ) ) :
        $out .= '<a href="' . get_the_permalink() . '" title="' . sprintf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ) . '" rel="bookmark">' . get_the_title() . '</a>';
      else:
        $out .= get_the_title();
      endif;

      $out .= '</h2><h3>';
      $out .= rwmb_meta( 'editit_subtitle' );
      $out .= '</h3></div>';
      $out .= '</div>';
    endif;

    $out .= $embed;
    $out .= '</article>';

  endwhile; endif;
  wp_reset_query();
    $out .= '</div>';
    $out .= '<div class="clearfix"></div>';

  return $out; 
}



/*-----------------------------------------------------------------------------------*/
/* 21. Recent Event
/*-----------------------------------------------------------------------------------*/
function editit_recent_event( $atts, $content = null) {
  extract( shortcode_atts( array(
    'title'  => __('Recent Event', 'editit'),
    'category'       => '',
    'number'         => '5',
    'thumbnail'      => 'no',
    'date'           => 'yes',
    'excerpt'        => 'no',
    'excerpt_length' => '40',
    'read_more'      => 'yes',
    'heading'        => 'h3',
    'heading_style'  => '1'
  ), $atts ) );


  if ($title != ""){
    $out = '<' . $heading . ' class="headline headline' . $heading_style . '"><span>' . $title . '</span></h3>';
  }

  $today_date = date("Y-m-d");

  $args = array(
    'post_type'           => 'event',
    'post_status'         => 'publish',
    'posts_per_page'      => $number,
    'ignore_sticky_posts' => 1,
    'orderby'             => 'meta_value',
    'meta_key'            => 'editit_dateeventstartdate',
    'order'               => 'ASC',
    'meta_query'          => array(
                               array(  'key'     =>  'editit_dateeventenddate',
                                       'value'   =>  $today_date,
                                       'compare' =>  '>=',
                                       'type'    =>  'DATE'
                               )
                             )
  );


  if($category) {

      $args['tax_query'][] = array(
                               'taxonomy'  => 'event_category',
                               'field'     => 'slug',
                               'terms'     => $category
                             );

  }


  global $custom_excerpt_length;
  global $readmore;
  global $smof_data;

  $custom_excerpt_length = $excerpt_length != '' ? $excerpt_length : 30;
  $readmore =  $read_more == 'yes' ? true : false;

  $th_query = null;
  $th_query = new WP_Query($args);

  if( $th_query->have_posts() ):  while ($th_query->have_posts()) : $th_query->the_post();

    $out .= '<article class="recent-news clearfix">';

    if(has_post_thumbnail() && ($thumbnail == "yes") ) :
      $out .= '<div class="post-image">';
      if(rwmb_meta('editit_selecteventlinktosinglepage')):
        $out .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">' . get_the_post_thumbnail(get_the_ID(), 'square' ) . '</a>';
      else:
        $out .= get_the_post_thumbnail(get_the_ID(), 'square' );
      endif;
      $out .= '</div>';
    endif;

    $out .= '<div class="post-content">
               <div class="post-content-header">
            ';

    if($date != "no" ) :
      $out .= '<div class="post-date">
                 <time datetime="' . date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventstartdate' )));
      if( rwmb_meta('editit_dateeventstartdate') != rwmb_meta( 'editit_dateeventenddate' ) ){
        $out .= ' - ' . date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventenddate' )));
      }

      $out .= '" title="' . date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventstartdate' )));

      if( rwmb_meta('editit_dateeventstartdate') != rwmb_meta( 'editit_dateeventenddate' ) ){
        $out .= ' - ' . date('Y-m-d', strtotime(rwmb_meta( 'editit_dateeventenddate' )));
      }

      $out .= '">';

      $out .= date(get_option('date_format'), strtotime(rwmb_meta( 'editit_dateeventstartdate' )));

      if( rwmb_meta('editit_dateeventstartdate') != rwmb_meta( 'editit_dateeventenddate' ) ){

        $out .= ' - ' . date(get_option('date_format'), strtotime(rwmb_meta( 'editit_dateeventenddate' )));

      }

      $out .= '</time>';

    endif;

    $out .= '<div class="post-title"><h4>';

      if(rwmb_meta('editit_selecteventlinktosinglepage')):
        $out .= '<a href="' . get_the_permalink() . '" title="' . sprintf( esc_attr__('Permalink to %s', 'editit'), the_title_attribute('echo=0') ) . '" rel="bookmark">' . get_the_title() . '</a>';
      else:
        $out .= get_the_title();
      endif;

    $out .= '</h4></div>';



    $out .= '</div>';


    if($excerpt != "no" ) :
      $out .= '<div class="post-excerpt">' . get_the_excerpt() . '
                 <div class="clear"></div>
               </div>
              ';
    endif;

    $out .= '</div>
           </article>';

  endwhile; endif;
  wp_reset_query();


  return $out; 

}



/*-----------------------------------------------------------------------------------*/
/* 22. Blockquote
/*-----------------------------------------------------------------------------------*/
function editit_blockquote( $atts, $content = null) {
  extract( shortcode_atts( array(), $atts ) );
      
  return '<blockquote><p>' . do_shortcode($content) . '</p></blockquote>';
}



/* ----------------------------------------------------- */
/* Pre Process Shortcodes */
/* フィルターより前にショートコードを実行させるためのTips
/* http://www.viper007bond.com/2009/11/22/wordpress-code-earlier-shortcodes/
/* ----------------------------------------------------- */

function pre_process_shortcode($content) {
    global $shortcode_tags;
 
    // 現在のショートコード群をバックアップをとってから、すべて削除する
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();

    // 01.Columns
    add_shortcode('one_third', 'editit_column_one_third');
    add_shortcode('one_third_last', 'editit_column_one_third_last');
    add_shortcode('two_third', 'editit_column_two_third');
    add_shortcode('two_third_last', 'editit_column_two_third_last');
    add_shortcode('one_half', 'editit_column_one_half');
    add_shortcode('one_half_last', 'editit_column_one_half_last');
    add_shortcode('one_fourth', 'editit_column_one_fourth');
    add_shortcode('one_fourth_last', 'editit_column_one_fourth_last');
    add_shortcode('three_fourth', 'editit_column_three_fourth');
    add_shortcode('three_fourth_last', 'editit_column_three_fourth_last');
    add_shortcode('one_fifth', 'editit_column_one_fifth');
    add_shortcode('one_fifth_last', 'editit_column_one_fifth_last');
    add_shortcode('two_fifth', 'editit_column_two_fifth');
    add_shortcode('two_fifth_last', 'editit_column_two_fifth_last');
    add_shortcode('three_fifth', 'editit_column_three_fifth');
    add_shortcode('three_fifth_last', 'editit_column_three_fifth_last');
    add_shortcode('four_fifth', 'editit_column_four_fifth');
    add_shortcode('four_fifth_last', 'editit_column_four_fifth_last');
    add_shortcode('one_sixth', 'editit_column_one_sixth');
    add_shortcode('one_sixth_last', 'editit_column_one_sixth_last');
    add_shortcode('five_sixth', 'editit_column_five_sixth');
    add_shortcode('five_sixth_last', 'editit_column_five_sixth_last');

    // 02.Space
    add_shortcode('space', 'editit_space');

    // 03.Divider
    add_shortcode('divider', 'editit_divider');

    // 04.Headline
    add_shortcode('headline', 'editit_headline');

    // 05.Accordion
    add_shortcode('accordion', 'editit_accordion');

    // 06.Tabs
    add_shortcode( 'tabgroup', 'editit_tabgroup' );
    add_shortcode( 'tab', 'editit_tab' );

    // 07.Styled Table
    add_shortcode('styled_table', 'editit_styled_table');

    // 08.Google Font
    add_shortcode('googlefont', 'editit_googlefont');

    // 09.Highlight
    add_shortcode('highlight', 'editit_highlight');

    // 10.Icons
    add_shortcode('icon', 'editit_icon');

    // 11.Buttons
    add_shortcode('buttons', 'editit_buttons');

    // 12.List
    add_shortcode('list', 'editit_list');
    add_shortcode('list_item', 'editit_list_item');

    // 13.Box
    add_shortcode('box', 'editit_box');

    // 14.Icon Box
    add_shortcode('icon_box', 'editit_icon_box');

    // 15.Video Embed
    add_shortcode('video_embed', 'editit_video_embed');

    // 16.Responsive Image
    add_shortcode('responsive_image', 'editit_responsive_image');

    // 17.Google Maps
    add_shortcode('google_maps', 'editit_google_maps');

    // 18.Recent Posts
    add_shortcode('recent_posts', 'editit_recent_posts');

    // 19.Recent News
    add_shortcode('recent_news', 'editit_recent_news');

    // 20.Recent Portfolio
    add_shortcode('recent_portfolio', 'editit_recent_portfolio');

    // 21.Recent Event
    add_shortcode('recent_event', 'editit_recent_event');

    // 22.Blockquote
    add_shortcode('blockquote', 'editit_blockquote');


    // ショートコードを実行 (直前の行で加えた当該のショートコードのみ)
    $content = do_shortcode($content);
 
    // 元のショートコード群を復元する
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}

 
add_filter('the_content', 'pre_process_shortcode', 7);

// Allow Shortcodes in Widgets
add_filter('widget_text', 'pre_process_shortcode', 7);

/*-----------------------------------------------------------------------------------*/
/* Add TinyMCE Buttons to Editor */
/*-----------------------------------------------------------------------------------*/
add_action('init', 'add_button');

function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons_3', 'register_button_3');
   }  
}  

// Define Position of TinyMCE Icons
function register_button_3($buttons) {  
   array_push($buttons, "columns", "space", "divider", "headline", "accordion", "tabs", "styled_table", "googlefont", "highlight", "icon", "buttons", "list", "box", "icon_box", "video_embed", "responsive_image", "google_maps", "recent_posts", "recent_news", "recent_portfolio", "recent_event");  
   return $buttons;  
}


function add_plugin($plugin_array) {
   $plugin_array['columns'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['space'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['divider'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['headline'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['accordion'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['styled_table'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['googlefont'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['highlight'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['icon'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['buttons'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['list'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['box'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['icon_box'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['video_embed'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['responsive_image'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['google_maps'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['recent_posts'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['recent_news'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['recent_portfolio'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['recent_event'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['blockquote'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';

   return $plugin_array;  
}

?>