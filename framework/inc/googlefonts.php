<?php
/**
 * Google Fonts
 *
 *
 * @file           googlefonts.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/googlefonts.php
 */
?>
<?php
global $smof_data;
$customfont = '';

$default = array(
        'arial',
        'verdana',
        'trebuchet',
        'georgia',
        'times',
        'tahoma',
        'helvetica',
        "'Kozuka Mincho Pro','Kozuka Mincho Std','小塚明朝 Pro R','小塚明朝 Std R','Hiragino Mincho Pro','ヒラギノ明朝 Pro W3','ＭＳ Ｐ明朝','MS PMincho',serif");

$googlefonts = array(
        $smof_data['font_body']['face'],
        $smof_data['font_logo']['face'],
        $smof_data['font_nav']['face'],
        $smof_data['font_titlebarmaintitle']['face'],
        $smof_data['font_titlebarsubtitle']['face'],
        $smof_data['font_sidebarh3']['face'],
        $smof_data['font_footerh3']['face'],
        $smof_data['font_h1']['face'],
        $smof_data['font_h2']['face'],
        $smof_data['font_h3']['face'],
        $smof_data['font_h4']['face'],
        $smof_data['font_h5']['face'],
        $smof_data['font_h6']['face'],
        );
      
foreach($googlefonts as $getfonts) {
  
  if(!in_array($getfonts, $default)) {
    $customfont = str_replace(' ', '+', $getfonts). ':400,400italic,700,700italic|' . $customfont;
  }
}

if($customfont != ''){
  echo "<link href='http://fonts.googleapis.com/css?family=" . substr_replace($customfont ,"",-1) . "&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese' rel='stylesheet' type='text/css'>";
}
?>