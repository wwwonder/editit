<?php
/**
 * Widget : Contact Form
 *
 *
 * @file           contact-form.php
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/widgets/contact-form.php
 */
?>
<?php

class Widget_Contact_Form extends WP_Widget {

  /* -- Register widget with WordPress. -- */
  function __construct() {
    parent::__construct(
      'contact_form', // Base ID
      __('7.[editit] Contact Form', 'editit'), // Name
      array( 'description' => __( 'Display Contact Form', 'editit' ), ) // Args
    );
  }


  /* -- Widget Output -- */
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $email = $instance['email'];

    if(isset($_POST['formSubmitted'])) {

      if(trim($_POST['cName']) === '' ) {
        $nameError = __('Please enter your name.', 'editit');
        $hasError = true;
      } else {
        $name = trim($_POST['cName']);
      }

      if( trim($_POST['cEmail']) === '' )  {
        $emailError = __('Please enter your email address.', 'editit');
        $hasError = true;
      } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['cEmail']))) {
        $emailError = __('You entered an invalid email address.', 'editit');
        $hasError = true;
      } else {
        $cEmail = trim($_POST['cEmail']);
      }

      if(trim($_POST['cComment']) === '' ) {
        $commentError = __('Please enter a message.', 'editit');
        $hasError = true;
      } else {
        if(function_exists('stripslashes')) {
          $comment = stripslashes(trim($_POST['cComment']));
        } else {
          $comment = trim($_POST['cComment']);
        }
      }

      if(!isset($hasError)) {
        $emailTo = $email;
        if (!isset($emailTo) || empty($emailTo) ){
          $emailTo = get_option('admin_email');
        }
        $subject = 'From '.$name.' ['.$cEmail.'] ';
        $body    = "Name: $name \n\nEmail: $cEmail \n\nMessage: $comment";
        $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
        
        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
      }

    }

    echo $before_widget;
    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

        if(isset($hasError) ) : ?>
            
        <p style="color:#B2950E" >
            <span id="info"><?php _e('sorry, some problems occured with your form submission:', 'editit'); ?>
            <?php 
            if(isset($nameError ))   echo '<br/>- '.$nameError; 
            if(isset($emailError))   echo '<br/>- '.$emailError; 
            if(isset($commentError)) echo '<br/>- '.$commentError; 
            ?>
            
            </span>
        </p>
            
        <?php endif; ?>

        <form action="" id="contactForm" method="post" > 
            <input type="text"  name="cName"    id="cName"    placeholder="<?php _e('Name'    , 'editit'); ?>*"  required >
            <input type="email" name="cEmail"   id="cEmail"   placeholder="<?php _e('Email'   , 'editit'); ?>*" required >
            <textarea           name="cComment" id="cComment" placeholder="<?php _e('Message' , 'editit'); ?>*" required></textarea>
            <input type="submit" class="night left flat"  value="<?php esc_attr_e('Send', 'editit'); ?>" >
            
            <?php if(isset($emailSent) && $emailSent == true) { ?>
            <p style="color:#598527;"><span id="info"><?php _e("Thanks for your Message. Your message sent successfully.", "editit"); ?></span></p>
            <?php } ?>
            
            <input type="hidden" name="formSubmitted" id="formSubmitted" value="true" />
        </form>

    <?php

    echo $after_widget;

  }


  /* -- Widget Update -- */
  function update( $new_instance, $old_instance ) {  
    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);
    $instance['email'] = $new_instance['email'];

    return $instance;
  }


  /* -- Widget Backend Form -- */
  function form($instance) {
    
    $defaults = array(
                  'title'   => __('Contact Form', 'editit'),
                  'email'   => ''
                );
    $instance = wp_parse_args((array) $instance, $defaults);

  ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email', 'editit'); ?>:</label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
    </p>

  <?php
  }

}


/* -- register Widget_Contact_Form widget -- */
function register_widget_contact_form() {
  register_widget( 'Widget_Contact_Form' );
}
add_action( 'widgets_init', 'register_widget_contact_form' );

?>