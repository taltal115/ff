<?php
     
// user registration login form
function pippin_registration_form() {
    
    // only show the registration form to non-logged-in members
    if(!is_user_logged_in()) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        // check to make sure user registration is enabled
        $registration_enabled = get_option('users_can_register');
 
        // only show the registration form if allowed
        if($registration_enabled) {
            $output = pippin_registration_form_fields();
        } else {
            $output = __('User registration is not enabled');
        }
        return $output;
    }
}
add_shortcode('register_form', 'pippin_registration_form');

// registration form fields
function pippin_registration_form_fields() {
 
    ob_start(); ?>   
    <div class="pippin_registration" align="center">
    <div class="pippin_form" align="center">
        <h3 class="pippin_header"><?php _e('Register New Account'); ?></h3>
 
        <?php 
        // show any error messages after form submission
        pippin_show_error_messages(); ?>
 
        <form id="pippin_registration_form" class="" action="" method="POST">
            <fieldset>
                <p style="overflow: hidden;height: 0px;">
                    <!-- label for="pippin_user_Login"><?php _e('Username'); ?></label -->
                    <input name="pippin_user_login" id="pippin_user_login" placeholder="<?php _e('Username'); ?>" class="required" type="text"/>
                </p>
                <p>
                    <!-- label for="pippin_user_email"><?php _e('Email'); ?></label -->
                    <input name="pippin_user_email" id="pippin_user_email" placeholder="<?php _e('Email'); ?>" class="required" type="email"/>
                </p>
                
                <p>
                    <!-- label for="password"><?php _e('Password'); ?></label -->
                    <input name="pippin_user_pass" id="password" placeholder="<?php _e('Password'); ?>" class="required" type="password"/>
                </p>
                <p>
                    <!-- label for="password_again"><?php _e('Password Again'); ?></label -->
                    <input name="pippin_user_pass_confirm" id="password_again" placeholder="<?php _e('Re-enter password'); ?>" class="required" type="password"/>
                </p> 
                <p class="g-recaptcha" data-sitekey="6LejuQcTAAAAADc1-RuJ1Hzpv6njc75b28Bp5w0Z"></p>
                <p>
                    <input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-register-nonce'); ?>"/>
                    <input type="submit" value="<?php _e('Register Your Account'); ?>"/>
                </p>
                <p><input style="margin: 3px 0 0 0;" name="pippin_reg_agree" type="checkbox" <?=$show_email_check?> value="1" /> By clicking “register your account”, you agree to our <a href="terms-of-use" target="_blank">term of use</a> and privacy policy </p>
            </fieldset>
            <div style="height: 50px;"></div>
        </form>
    </div>
    </div> 
    <?php
    return ob_get_clean();
}

// register a new user
function pippin_add_new_member() {
      if (isset( $_POST["pippin_user_login"] ) && wp_verify_nonce($_POST['pippin_register_nonce'], 'pippin-register-nonce')) {
        $user_login        = $_POST["pippin_user_login"];    
        $user_email        = $_POST["pippin_user_email"];
        $user_first     = $_POST["pippin_user_first"];
        $user_last         = $_POST["pippin_user_last"];
        $user_pass        = $_POST["pippin_user_pass"];
        $pass_confirm     = $_POST["pippin_user_pass_confirm"];
        $reg_agree    = $_POST["pippin_reg_agree"];
        
        
        $isCaptcha = false;
        if(isset($_POST['g-recaptcha-response'])){
            $captcha = $_POST['g-recaptcha-response'];
        }
        if(!$captcha){
            pippin_errors()->add('no_captcha', __('Please check the the captcha form'));
        }
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LejuQcTAAAAANXVWyqqJOK2iAXv2BHNP0dySqdL&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
            die; //echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }else
        {
            if($reg_agree > 0){
                $isCaptcha = true;
            }else{
                pippin_errors()->add('no_reg_agree', __('Please agree to our term of use and privacy policy.'));
            }
        }
           
        if(trim($user_login) == ""){ // Not Robot
            $user_login = $user_email;
            
            // this is required for username checks
            require_once(ABSPATH . WPINC . '/registration.php'); 
        
            if($isCaptcha){     
                if(username_exists($user_login)) {
                    // Username already registered
                    //pippin_errors()->add('username_unavailable', __('Username already taken'));
                    pippin_errors()->add('email_used', __('Email already registered'));
                }
                if(!validate_username($user_login)) {
                    // invalid username
                    //pippin_errors()->add('username_invalid', __('Invalid username'));
                    pippin_errors()->add('email_invalid', __('Invalid email'));
                }
                if($user_login == '') {
                    // empty username
                    //pippin_errors()->add('username_empty', __('Please enter a username'));
                    pippin_errors()->add('email_invalid', __('Invalid email'));
                }
                if(!is_email($user_email)) {
                    //invalid email
                    pippin_errors()->add('email_invalid', __('Invalid email'));
                }
                if(email_exists($user_email)) {
                    //Email address already registered
                    pippin_errors()->add('email_used', __('Email already registered'));
                }
                if($user_pass == '') {
                    // passwords do not match
                    pippin_errors()->add('password_empty', __('Please enter a password'));
                }
                if($user_pass != $pass_confirm) {
                    // passwords do not match
                    pippin_errors()->add('password_mismatch', __('Passwords do not match'));
                }
                
                if(username_exists($user_login)) {
                }
                
                $display_name = substr($user_email,0,strpos($user_email,"@"));
                if(trim($display_name) != ""){
                    if(trim($user_first) == "")
                        $user_first = $display_name;
                }
            }
            $errors = pippin_errors()->get_error_messages();
     
            // only create the user in if there are no errors
            if(empty($errors)) {
     
                $new_user_id = wp_insert_user(array(
                        'user_login'        => $user_login,
                        'display_name'      => $display_name,
                        'nickname'          => $display_name,
                        'user_pass'         => $user_pass,
                        'user_email'        => $user_email,
                        'first_name'        => $user_first,
                        'last_name'         => $user_last,
                        'user_registered'   => date('Y-m-d H:i:s'),
                        'role'              => 'subscriber'
                        
                    )
                );
                if($new_user_id) {
                    // send an email to the admin alerting them of the registration
                    wp_new_user_notification($new_user_id);
     
                    // log the new user in
                    wp_setcookie($user_login, $user_pass, true);
                    wp_set_current_user($new_user_id, $user_login);    
                    do_action('wp_login', $user_login);
     
                    // send the newly created user to the home page after logging them in
                    wp_redirect(home_url()); exit;
                }
     
            }
        }else{
            error_log("BEN ZONA IP: ".$_SERVER['REMOTE_ADDR']);
        }  
    }
}
add_action('init', 'pippin_add_new_member');

?>