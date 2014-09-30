<?php
/**
 * Author
 *
 *
 * @file           author.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/author.php
 */
?>
<div id="author-info" class="author-info clearfix">
  <div class="author-image">
    <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '60', '' ); ?></a>
  </div>   
  <div class="author-bio">
    <h4>
      <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" title="<?php printf( __( 'View all posts by %s', 'editit' ), get_the_author() ); ?>" >
        <?php the_author(); ?>
      </a>
    </h4>
    <h5><?php the_author_meta("skills");?></h5>
    <p><?php the_author_meta('description'); ?></p>

    <ul class="social-icons clearfix">

    <?php if(get_the_author_meta("twitter") != '') : ?>
      <li class="social-twitter">
        <a href="<?php the_author_meta("twitter");?>" title="<?php _e( 'Visit Twitter Profile', 'editit'); ?>" target="_blank"><i class="icon icon-twitter"></i></a>
      </li>
    <?php endif; ?>

    <?php if(get_the_author_meta("facebook") != '') : ?>
      <li class="social-facebook">
        <a href="<?php the_author_meta("facebook");?>" title="<?php _e( 'Visit Facebook Profile', 'editit'); ?>" target="_blank"><i class="icon icon-facebook-square"></i></a>
      </li>
    <?php endif; ?>

    <?php if(get_the_author_meta("googleplus") != '') : ?>
      <li class="social-googleplus">
        <a href="<?php the_author_meta("googleplus");?>" title="<?php _e( 'Visit Google+ Profile', 'editit'); ?>" target="_blank"><i class="icon icon-google-plus-square"></i></a>
      </li>
    <?php endif; ?>

    <?php if(get_the_author_meta("skype") != '') : ?>
      <li class="social-skype">
        <a href="<?php the_author_meta("skype");?>" title="<?php _e( 'Contact Skype', 'editit'); ?>" target="_blank"><i class="icon icon-skype"></i></a>
      </li>
    <?php endif; ?>

    <?php if(get_the_author_meta("email") != '') : ?>
      <li class="social-email">
        <a href="mailto:<?php the_author_meta("email");?>" title="<?php _e( 'Email', 'editit'); ?>" target="_blank"><i class="icon icon-envelope-o"></i></a>
      </li>
    <?php endif; ?>

    <?php if(get_the_author_meta("url") != '') : ?>
      <li class="social-url">
        <a href="<?php the_author_meta("url");?>" title="<?php _e( 'Website', 'editit'); ?>" target="_blank"><i class="icon icon-link"></i></a>
      </li>
    <?php endif; ?>

    </ul>

  </div><!-- end of .author-bio -->
</div><!-- end of .author-info -->
