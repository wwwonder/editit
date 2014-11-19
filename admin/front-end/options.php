<div class="wrap" id="of_container">

	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save"><?php _e('Options Updated', 'editit');?></div>
	</div>
	
	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset"><?php _e('Options Reset', 'editit');?></div>
	</div>
	
	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail"><?php _e('Error!', 'editit');?></div>
	</div>
	
	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
	
		<div id="header">
		
			<div class="logo">
				<h2><?php echo THEMENAME; ?></h2>
				<span><?php echo ('v'. THEMEVERSION); ?></span>
			</div>
		
			<div id="js-warning">Warning- This options panel will not work properly without javascript!</div>
			<div class="icon-option"></div>
			<div class="clear"></div>
		
    	</div>

		<div id="info_bar">
		
			<a>
				<div id="expand_options" class="expand">Expand</div>
			</a>
						
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />

			<button id="of_save" type="button" class="button-primary">
				<?php _e('Save All Changes', 'editit');?>
			</button>
			
		</div><!--.info_bar--> 	
		
		<div id="main">
		
			<div id="of-nav">
				<ul>
				  <?php echo $options_machine->Menu ?>
				</ul>
			</div>

			<div id="content">
		  		<?php echo $options_machine->Inputs /* Settings */ ?>
		  	</div>
		  	
			<div class="clear"></div>
			
		</div>
		
		<div class="save_bar"> 
		
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<button id ="of_save" type="button" class="button-primary"><?php _e('Save All Changes', 'editit');?></button>			
			<button id ="of_reset" type="button" class="button submit-button reset-button" ><?php _e('Options Reset', 'editit');?></button>
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
			
		</div><!--.save_bar--> 
 
	</form>
	
	<div style="clear:both;"></div>

</div><!--wrap-->
<div class="smof_footer_info">Slightly Modified Options Framework <strong><?php echo SMOF_VERSION; ?></strong></div>


<script type="text/javascript">
  jQuery(document).ready(function($){
    $(".generalsetting a, #of-option-generalsetting h2").text("<?php _e('General Setting' , 'editit'); ?>");
    $(".customstyle a, #of-option-customstyle h2").text("<?php _e('Custom Style' , 'editit'); ?>");
    $(".typography a, #of-option-typography h2").text("<?php _e('Typography' , 'editit'); ?>");
    $(".header a, #of-option-header h2").text("<?php _e('Header' , 'editit'); ?>");
    $(".blog a, #of-option-blog h2").text("<?php _e('Blog' , 'editit'); ?>");
    $(".news a, #of-option-news h2").text("<?php _e('News' , 'editit'); ?>");
    $(".portfolio a, #of-option-portfolio h2").text("<?php _e('Portfolio' , 'editit'); ?>");
    $(".event a, #of-option-event h2").text("<?php _e('Event' , 'editit'); ?>");
    $(".menus a, #of-option-menus h2").text("<?php _e('Menu' , 'editit'); ?>");
    $(".member a, #of-option-member h2").text("<?php _e('Member' , 'editit'); ?>");
    $(".footer a, #of-option-footer h2").text("<?php _e('Footer' , 'editit'); ?>");
    $(".socialmedia a, #of-option-socialmedia h2").text("<?php _e('Socialmedia' , 'editit'); ?>");
    $(".lightbox a, #of-option-lightbox h2").text("<?php _e('Lightbox' , 'editit'); ?>");
    $(".backupoptions a, #of-option-backupoptions h2").text("<?php _e('Backup Options' , 'editit'); ?>");
  });
</script>






