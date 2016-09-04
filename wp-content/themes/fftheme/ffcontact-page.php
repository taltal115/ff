<?php
/*
 * Template Name: Finding Contact Us
 *
 * A custom page template without for contact us.
 *
 * @package BuddyPress
 * @subpackage BP_Default
 * @since 1.5
 */
 
//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

}    
//response messages
$not_captcha       = "Please check the the captcha form.";
$missing_content = "Please supply all information.";
$email_invalid   = "Email Address Invalid.";
$message_unsent  = "Message was not sent. Try Again.";
$message_sent    = "Thanks! Your message has been sent.";
 
//user posted variables
$name = $_POST['message_name'];
$email = $_POST['message_email'];
$message = $_POST['message_text'];
$human = $_POST["user_login"]; 
 
//php mailer variables
$to = get_option('admin_email');
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
  'Reply-To: ' . $email . "\r\n";

if($_POST){ 
    $captcha = false;
    $isCaptcha = false;   
    if(isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        my_contact_form_generate_response("error", $not_captcha);
    }else{
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LejuQcTAAAAANXVWyqqJOK2iAXv2BHNP0dySqdL&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
            die; //echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }else
        {
            $isCaptcha = true;
        }
    }
    if(trim($human) == ""){ // Not Robot
        if($isCaptcha){  
            //validate presence of name and message
            if(empty($name) || empty($message)){
                my_contact_form_generate_response("error", $missing_content);
            }
            else{ 
                //validate email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    my_contact_form_generate_response("error", $email_invalid);
                }else //email is valid
                {
                    //ready to go!
                    $sent = wp_mail($to, $subject, strip_tags($message), $headers);
                    if($sent) {
                        my_contact_form_generate_response("success", $message_sent); //message sent!
                        $_POST['message_name'] = "";
                        $_POST['message_email'] = "";
                        $_POST['message_text'] = "";
                    }
                    else {
                        my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
                    }
                    
                }
            }
        }
    }else{
        error_log("BEN ZONA IP: ".$_SERVER['REMOTE_ADDR']);
    }  
}
  
get_header('ff');
?>
<style type="text/css">
    .contact_content {
        color: black; width: 100%; text-align: center;
    }
    .contact_form {
        margin-right: auto; margin-left: auto; width: 320px;    
    }
    .contact_form 
        input[type="text"],
        input[type="password"],
        input[type="email"],
        textarea {
        width: 300px;
        font-size: 22px;
        padding: 4px 8px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
    } 
    .contact_form input[type="text"]:focus, 
    .contact_form input[type="password"]:focus,
    .contact_form input[type="email"]:focus {
        border-color: #aaa;
    }
    .contact_form input[type="submit"] {
        font-size: 14px;
    }
  .error{
    padding: 5px 9px;
    border: 1px solid red;
    color: red;
    border-radius: 3px;
  }
 
  .success{
    padding: 5px 9px;
    border: 1px solid green;
    color: green;
    border-radius: 3px;
  }
 
  form span{
    color: red;
  }
</style>
<div id="primary" class="contact_content">
    <div id="content" role="main">
 
      <?php while ( have_posts() ) : the_post(); ?>
            <h3 class="pippin_header"><?php the_title(); // _e('Support');  ?></h3>
            <div class="contact_form">
              <?php the_content(); ?>
                <div>
                  <?php echo $response; ?>
                  <form action="<?php the_permalink(); ?>" method="post">
                    <p style="overflow: hidden;height: 0px;">
                        <input name="user_login" id="user_login" placeholder="<?php _e('Username'); ?>" class="required" type="text"/>
                    </p>
                    <p><input type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>" placeholder="<?php _e('Name'); ?>" class="required"></p>
                    <p><input type="email" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>" placeholder="<?php _e('Email'); ?>" class="required"></p>
                    <p><textarea type="text" name="message_text" placeholder="<?php _e('Message'); ?>" class="required"><?php echo esc_textarea($_POST['message_text']); ?></textarea></p>
                    <p class="g-recaptcha" data-sitekey="6LejuQcTAAAAADc1-RuJ1Hzpv6njc75b28Bp5w0Z"></p>
                    <input type="hidden" name="submitted" value="1">
                    <p><input type="submit"></p>
                  </form>
                </div>
                 
            </div><!-- .entry-content -->
 
      <?php endwhile; // end of the loop. ?>
 
    </div><!-- #content -->
  </div><!-- #primary -->
<?
get_footer('ff');
?>
