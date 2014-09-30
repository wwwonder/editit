<?php
/**
 * Sharebox
 *
 *
 * @file           sharebox.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/sharebox.php
 */
?>
<?php
global $smof_data;
$post_type = get_post_type();
?>
<?php if ($post_type != ""): ?>

<div class="sharebox clearfix">
  <h4><?php _e('Share This Story.', 'editit'); ?></h4>
  <ul class="social-icons clearfix">

  <?php if( $smof_data["switch_{$post_type}shareboxtwitter"] ): ?>
    <li class="social-twitter">
      <a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" title="<?php _e( 'Twitter', 'editit' ) ?>" target="_blank"><i class="icon icon-twitter"></i></a>
    </li>
  <?php endif; ?>

  <?php if( $smof_data["switch_{$post_type}shareboxfacebook"] ): ?>
    <li class="social-facebook">
      <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="<?php _e( 'Facebook', 'editit' ) ?>" target="_blank"><i class="icon icon-facebook-square"></i></a>
    </li>
  <?php endif; ?>

  <?php if( $smof_data["switch_{$post_type}shareboxgoogleplus"] ): ?>
    <li class="social-googleplus">
      <a href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Google+', 'editit' ) ?>" target="_blank"><i class="icon icon-google-plus-square"></i></a>
    </li>
  <?php endif; ?>

  <?php if( $smof_data["switch_{$post_type}shareboxemail"] ): ?>
    <li class="social-email">
      <a href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>" title="<?php _e( 'Email', 'editit' ) ?>" target="_blank"><i class="icon icon-envelope-o"></i></a>
    </li>
  <?php endif; ?>

  </ul>
</div><!-- end of .sharebox -->

<?php endif; ?>