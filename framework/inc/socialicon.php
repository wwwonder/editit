<?php
/**
 * SocialIcon 
 *
 *
 * @file           socialicon.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/socialicon.php
 */
?>
<?php global $smof_data; ?>
        <ul class="social-icons clearfix">
<?php if($smof_data['text_socialtwitter'] != "") : ?>
          <li class="social-twitter"><a href="<?php echo $smof_data['text_socialtwitter']; ?>" target="_blank" title="Twitter"><i class="icon icon-twitter"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialfacebook'] != "") : ?>
          <li class="social-facebook"><a href="<?php echo $smof_data['text_socialfacebook']; ?>" target="_blank" title="Facebook"><i class="icon icon-facebook-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialgoogleplus'] != "") : ?>
          <li class="social-googleplus"><a href="<?php echo $smof_data['text_socialgoogleplus']; ?>" target="_blank" title="Google+"><i class="icon icon-google-plus-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialskype'] != "") : ?>
          <li class="social-skype"><a href="<?php echo $smof_data['text_socialskype']; ?>" target="_blank" title="Skype"><i class="icon icon-skype"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialflickr'] != "") : ?>
          <li class="social-flickr"><a href="<?php echo $smof_data['text_socialflickr']; ?>" target="_blank" title="Flickr"><i class="icon icon-flickr"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialinstagram'] != "") : ?>
          <li class="social-instagram"><a href="<?php echo $smof_data['text_socialinstagram']; ?>" target="_blank" title="Instagram"><i class="icon icon-instagram"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialpinterest'] != "") : ?>
          <li class="social-pinterest"><a href="<?php echo $smof_data['text_socialpinterest']; ?>" target="_blank" title="Pinterest"><i class="icon icon-pinterest-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialtumblr'] != "") : ?>
          <li class="social-tumblr"><a href="<?php echo $smof_data['text_socialtumblr']; ?>" target="_blank" title="Tumblr"><i class="icon icon-tumblr-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialyoutube'] != "") : ?>
          <li class="social-youtube"><a href="<?php echo $smof_data['text_socialyoutube']; ?>" target="_blank" title="YouTube"><i class="icon icon-youtube-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialvimeo'] != "") : ?>
          <li class="social-vimeo"><a href="<?php echo $smof_data['text_socialvimeo']; ?>" target="_blank" title="Vimeo"><i class="icon icon-vimeo-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialdribbble'] != "") : ?>
          <li class="social-dribbble"><a href="<?php echo $smof_data['text_socialdribbble']; ?>" target="_blank" title="Dribbble"><i class="icon icon-dribbble"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialgithub'] != "") : ?>
          <li class="social-github"><a href="<?php echo $smof_data['text_socialgithub']; ?>" target="_blank" title="GitHub"><i class="icon icon-github-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_sociallinkedin'] != "") : ?>
          <li class="social-linkedin"><a href="<?php echo $smof_data['text_sociallinkedin']; ?>" target="_blank" title="LinkedIn"><i class="icon icon-linkedin-square"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialemail'] != "") : ?>
          <li class="social-email"><a href="mailto:<?php echo $smof_data['text_socialemail']; ?>" title="<?php _e( 'Email', 'editit'); ?>"><i class="icon icon-envelope-o"></i></a></li>
<?php endif; ?>
<?php if($smof_data['text_socialphonenumber'] != "") : ?>
          <li class="social-phonenumber"><a href="tel:<?php echo $smof_data['text_socialphonenumber']; ?>" title="<?php _e('Phone Number', 'editit'); ?>"><i class="icon icon-phone"></i></a></li>
<?php endif; ?>
<?php if($smof_data['switch_socialshowrss']) : ?>
          <li class="social-rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="RSS"><i class="icon icon-rss"></i></a></li>
<?php endif; ?>
        </ul>
