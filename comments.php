<?php
/**
 * Comment Template
 *
 *
 * @file           comments.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/comments.php
 */
?>
<?php
// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'editit'); ?></p>
  <?php
    return;
  }
?>


<?php if ( have_comments() ) : ?>
    
    <h3 class="headline"><span><?php comments_number( __('No Comments', 'editit'), __('1 Comment', 'editit'), __('% Comments', 'editit') );?></span></h3>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav class="comments-navi">
        <div class="comments-pre-page"><?php previous_comments_link() ?></div>
        <div class="comment-next-page"><?php next_comments_link() ?></div>
    </nav>
    <?php endif; ?>
  
    <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=editit_comment'); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav class="comments-navi">
        <div class="comments-pre-page"><?php previous_comments_link() ?></div>
        <div class="comment-next-page"><?php next_comments_link() ?></div>
    </nav>
    <?php endif; ?>
    
    <div class="clear"></div>

<?php else : // this is displayed if there are no comments so far ?>

    <?php if ( comments_open() ) : ?>
    <!-- If comments are open, but there are no comments. -->

    <?php elseif(get_post_type() == "post" || get_post_type() == "news") : // comments are closed ?>
    <!-- If comments are closed. -->
    <p class="nocomments"><?php _e("Comments are closed.", "editit"); ?></p>

    <?php endif; ?>

<?php endif; ?>


<?php 
    $req = get_option( 'require_name_email' );
    $comments_args = array(
            
            'must_log_in' => '<p>'. sprintf( __("You must be %s logged in %s to post a comment", "editit"), '<a href="'.wp_login_url( get_permalink() ).'">', '</a>' ) .'</p>',
            
            'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'editit' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            // change the title of send button 
            'label_submit'=> __('Submit' , 'editit' ) ,
            // change the title of the reply section
            'title_reply'=>'<h3 class="headline"><span>' . __('Leave a Reply', 'editit') . '</span></h3>',
            // remove "Text or HTML to be displayed after the set of comment fields"
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            // redefine your own textarea (the comment body)
            'comment_field' => '<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" placeholder="'. __('Comment' , 'editit' ). '" ></textarea>',
            'fields' => 
                apply_filters( 'comment_form_default_fields', 
                    array(
                        'author' => '<input type="text"  name="author" id="author" placeholder="'. __('Name (required)' , 'editit' ). '" value="'. esc_attr($comment_author). '"     size="22" tabindex="1" '. ( $req ? "aria-required='true' required" : "" ) .' />',
                        'email'  => '<input type="email" name="email"  id="email"  placeholder="'. __('Email (required)', 'editit' ). '" value="'. esc_attr($comment_author_email). '" tabindex="2" ' . ( $req ? "aria-required='true' required" : "" ) .' />',
                        'url'    => '<input type="url"   name="url"    id="url"    placeholder="'. __('Website'         , 'editit' ). '" value="'. esc_attr($comment_author_url). '" size="22" tabindex="3" />' 
                        )
                )
    );
    
    comment_form($comments_args);
    
 ?>