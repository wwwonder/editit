<?php
/**
 * Columns Select
 *
 *
 * @file           window.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/tinymce/window.php
 */
?>
<?php
while(!is_file('wp-config.php')){
  if(is_dir('../')){ chdir('../'); }
  else die('Could not find WordPress.');
}
include('wp-config.php');

wp_enqueue_script('jquery');
global $wp_scripts;
global $wpdb;

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') )
  wp_die(__('You are not allowed to be here', 'editit'));
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="ja">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="ja">
<!--<![endif]-->
<head>
<title><?php _e('Columns', 'editit') ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript">
var colTxt = ' ';
function init() {
  tinyMCEPopup.resizeToInnerSize();
}

function insertColumns(col) {
  colTxt = ' ';
  switch(col)
  {

    /* 1/3, 2/3 */
    case '3third':
      colTxt += '[one_third]Content here.[/one_third] ';
      colTxt += '[one_third]Content here.[/one_third] ';
      colTxt += '[one_third_last]Content here.[/one_third_last] ';
      break;
    case '1third2third':
      colTxt += '[one_third]Content here.[/one_third] ';
      colTxt += '[two_third_last]Content here.[/two_third_last] ';
      break;
    case '2third1third':
      colTxt += '[two_third]Content here.[/two_third] ';
      colTxt += '[one_third_last]Content here.[/one_third_last] ';
      break;

    /* 1/4, 1/2, 3/4 */
    case '4quarter':
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[one_fourth_last]Content here.[/one_fourth_last] ';
      break;
    case '1half2quarter':
      colTxt += '[one_half]Content here.[/one_half] ';
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[one_fourth_last]Content here.[/one_fourth_last] ';
      break;
    case 'quarterhalfquarter':
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[one_half]Content here.[/one_half] ';
      colTxt += '[one_fourth_last]Content here.[/one_fourth_last] ';
      break;
    case '2quarter1half':
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[one_half_last]Content here.[/one_half_last] ';
      break;
    case '2half':
      colTxt += '[one_half]Content here.[/one_half] ';
      colTxt += '[one_half_last]Content here.[/one_half_last] ';
      break;
    case '1quarter3quarter':
      colTxt += '[one_fourth]Content here.[/one_fourth] ';
      colTxt += '[three_fourth_last]Content here.[/three_fourth_last] ';
      break;
    case '3quarter1quarter':
      colTxt += '[three_fourth]Content here.[/three_fourth] ';
      colTxt += '[one_fourth_last]Content here.[/one_fourth_last] ';
      break;

    /* 1/5, 2/5, 3/5, 4/5 */
    case '5fifth':
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth_last]Content here.[/one_fifth_last] ';
      break;
    case '2fifth31fifth':
      colTxt += '[two_fifth]Content here.[/two_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth_last]Content here.[/one_fifth_last] ';
      break;
    case '1fifth2fifth21fifth':
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[two_fifth]Content here.[/two_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth_last]Content here.[/one_fifth_last] ';
      break;
    case '21fifth2fifth1fifth':
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[two_fifth]Content here.[/two_fifth] ';
      colTxt += '[one_fifth_last]Content here.[/one_fifth_last] ';
      break;
    case '31fifth2fifth':
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[two_fifth_last]Content here.[/two_fifth_last] ';
      break;
    case '3fifth21fifth':
      colTxt += '[three_fifth]Content here.[/three_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth_last]Content here.[/one_fifth_last] ';
      break;
    case '1fifth3fifth1fifth':
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[three_fifth]Content here.[/three_fifth] ';
      colTxt += '[one_fifth_last]Content here.[/one_fifth_last] ';
      break;
    case '21fifth3fifth':
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[three_fifth_last]Content here.[/three_fifth_last] ';
      break;
    case '2fifth3fifth':
      colTxt += '[two_fifth]Content here.[/two_fifth] ';
      colTxt += '[three_fifth_last]Content here.[/three_fifth_last] ';
      break;
    case '3fifth2fifth':
      colTxt += '[three_fifth]Content here.[/three_fifth] ';
      colTxt += '[two_fifth_last]Content here.[/two_fifth_last] ';
      break;
    case '1fifth4fifth':
      colTxt += '[one_fifth]Content here.[/one_fifth] ';
      colTxt += '[four_fifth_last]Content here.[/four_fifth_last] ';
      break;
    case '4fifth1fifth':
      colTxt += '[four_fifth]Content here.[/four_fifth] ';
      colTxt += '[one_fifth_last]Content here.[/one_fifth_last] ';
      break;
  }
  insertText();
}


function insertText(){
  if(window.tinyMCE) {
    window.tinyMCE.execCommand('mceInsertContent', false, colTxt);
    tinyMCEPopup.editor.execCommand('mceRepaint');
    tinyMCEPopup.close();
  }
  return;
}
</script>
<base target="_self" />
<style type="text/css">
img {
  border: none;
}
input[type="text"] {
  font-size: 12px;
  border: 1px solid #777;
  line-height: 14px;
  height: 16px;
}
select {
  font-size: 12px;
}
.panel {
  margin-bottom: 8px;
}
.hdrRow {
  padding-top: 4px;
  padding-bottom: 4px;
  font-weight: bold;
}


 .colPicker {
   margin-bottom: 6px; }

   .colPicker caption {
   }

   .colPicker tr {
     /*display: block;*/
     border-radius: 2px;
     background-color: #EEE;
     border: 1px solid #999;
     margin: 0 0 5px 0;
     cursor: pointer;
     padding: 5px 10px;
   }

   .colPicker tr:hover {
     background-color: #DDD;
   }

     .colPicker td {
       border-radius: 2px;
       padding: 3px;
       text-align: center;
       background-color: #f3f3f3;
       border: 1px solid #999;
       margin: 0 5px;
     }


</style>
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');">
<form name="columnPicker" action="#">

    <div class="panel">

      <table border="0" cellpadding="3" cellspacing="0" width="100%">
      <tr>
        <td class="hdrRow" colspan="3">
          <h3><?php _e('Insert Column Combinations', 'editit') ?></h3>
        </td>
      </tr>
      </table>


      <table cellspacing="10" style="width:100%;">
        <tr>
          <td valign="top" align="center" style="width:25%;">

            <table class="colPicker" style="width:100%;">
              <caption>1/3, 2/3<caption>
              <tbody>
                <tr onclick="insertColumns('3third')">
                  <td width="33.333%">1/3</td>
                  <td width="33.333%">1/3</td>
                  <td width="33.333%">1/3</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('1third2third')">
                  <td width="33.333%">1/3</td>
                  <td colspan="2">2/3</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('2third1third')">
                  <td width="66.666%" colspan="2">2/3</td>
                  <td width="33.333%">1/3</td>
                </tr>
              </tbody>
            </table>

          </td>
          <td valign="top" align="center" style="width:25%;">
            <table class="colPicker" style="width:100%;">
              <caption>1/4, 1/2, 3/4<caption>
              <tbody>
                <tr onclick="insertColumns('4quarter')">
                  <td width="25%">1/4</td>
                  <td width="25%">1/4</td>
                  <td width="25%">1/4</td>
                  <td width="25%">1/4</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('1half2quarter')">
                  <td colspan="2">1/2</td>
                  <td width="25%">1/4</td>
                  <td width="25%">1/4</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('quarterhalfquarter')">
                  <td width="25%">1/4</td>
                  <td colspan="2">1/2</td>
                  <td width="25%">1/4</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('2quarter1half')">
                  <td width="25%">1/4</td>
                  <td width="25%">1/4</td>
                  <td colspan="2">1/2</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('2half')">
                  <td colspan="2">1/2</td>
                  <td colspan="2">1/2</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('1quarter3quarter')">
                  <td width="25%">1/4</td>
                  <td colspan="3">3/4</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('3quarter1quarter')">
                  <td colspan="3">3/4</td>
                  <td width="25%">1/4</td>
                </tr>
              </tbody>
            </table>

          </td>
          <td valign="top" align="center" style="width:25%;">

            <table class="colPicker" style="width:100%;">
              <caption>1/5, 2/5<caption>
              <tbody>
                <tr onclick="insertColumns('5fifth')">
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('2fifth31fifth')">
                  <td colspan="2">2/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('1fifth2fifth21fifth')">
                  <td width="20%">1/5</td>
                  <td colspan="2">2/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('21fifth2fifth1fifth')">
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td colspan="2">2/5</td>
                  <td width="20%">1/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('31fifth2fifth')">
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td colspan="2">2/5</td>
                </tr>
              </tbody>
            </table>

          </td>
          <td valign="top" align="center" style="width:25%;">

            <table class="colPicker" style="width:100%;">
              <caption>3/5, 4/5<caption>
              <tbody>
                <tr onclick="insertColumns('3fifth21fifth')">
                  <td colspan="3">3/5</td>
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('1fifth3fifth1fifth')">
                  <td width="20%">1/5</td>
                  <td colspan="3">3/5</td>
                  <td width="20%">1/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('21fifth3fifth')">
                  <td width="20%">1/5</td>
                  <td width="20%">1/5</td>
                  <td colspan="3">3/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('2fifth3fifth')">
                  <td colspan="2" width="40%">2/5</td>
                  <td colspan="3" width="60%">3/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('3fifth2fifth')">
                  <td colspan="3" width="60%">3/5</td>
                  <td colspan="2" width="40%">2/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('4fifth1fifth')">
                  <td colspan="4">4/5</td>
                  <td width="20%">1/5</td>
                </tr>
              </tbody>
            </table>

            <table class="colPicker" style="width:100%;">
              <tbody>
                <tr onclick="insertColumns('1fifth4fifth')">
                  <td width="20%">1/5</td>
                  <td colspan="4">4/5</td>
                </tr>
              </tbody>
            </table>

          </td>

        </tr>
      </table>

      <hr>

    </div><!-- panel -->

  <div class="mceActionPanel">
    <div style="float: left">
      <input type="button" id="cancel" name="cancel" value="<?php _e('Close', 'editit') ?>" onclick="tinyMCEPopup.close();" />
    </div>
  </div><!-- mceActionPanel -->

</form>
</body>
</html>