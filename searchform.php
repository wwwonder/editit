<?php
/**
 * Search Form Template
 *
 *
 * @file           searchform.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/searchform.php
 */
?>
<form action="<?php echo home_url(); ?>/" id="searchform" class="searchform" method="get">
  <input type="text" id="s" name="s" value="<?php _e('Search Here', 'editit') ?>" onfocus="if(this.value=='<?php _e('Search Here', 'editit') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search Here', 'editit') ?>';" autocomplete="off" />
  <i class="icon icon-search"></i>
  <input type="submit" value="Search" id="searchsubmit" />
</form>
