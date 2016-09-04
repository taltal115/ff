<?php

// user profile login form
function pippin_profile_form() {
    
    // only show the profile form to non-logged-in members
    if(!is_user_logged_in() || true) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        // check to make sure user registration is enabled
        $profile_enabled = true;//get_option('users_can_profile');
        
        // only show the registration form if allowed
        if($profile_enabled) {
            $output = pippin_profile_form_fields();
        } else {
            $output = __('User profile is not enabled');
        }
        return $output;
    }
}
add_shortcode('profile_form', 'pippin_profile_form');

// profile form fields
function pippin_profile_form_fields() {
 
    ob_start(); 
    
    auth_redirect_login(); 
    nocache_headers();
    global $userdata; get_currentuserinfo(); // grabs the user info and puts into vars
    // check to see if the form has been posted. If so, validate the fields
    $user_ID = $userdata->ID;
    if(!empty($_POST['action']))
    {
        require_once(ABSPATH . 'wp-admin/includes/user.php');
        require_once(ABSPATH . WPINC . '/registration.php');
        $user_ID = $userdata->ID;
         
        check_admin_referer('update-profile_' . $user_ID);
        $errors = edit_user($user_ID);
        
        if(isset($_POST['twitter']))
            update_usermeta( $user_ID, 'twitter', $_POST['twitter'] );
             
        if ( is_wp_error( $errors ) ) {
            foreach( $errors->get_error_messages() as $message )
            $errmsg = "$message";
            //exit;
        }
        // if there are no errors, then process the ad updates
        if($errmsg == '')
        {
            do_action('personal_options_update');
            $d_url = $_POST['dashboard_url'];
            wp_redirect( get_option("siteurl").'/profile?updated=true' );
        }
        else {
            $errmsg = '<div class="box-red">** ' . $errmsg . ' **</div>';
            $errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';
        }
    } 
    ?>    
    <div class="pippin_registration pippin_form">
        <h3 class="pippin_header"><?php _e('My Profile'); ?></h3>
 
        <?php 
        // show any error messages after form submission
        pippin_show_error_messages(); ?>
        <h2 class="h2top"><?php echo $GLOBALS['_LANG']['_accinfo']; ?></h2>

        <?php if ( isset($_GET['updated']) ) {
        $d_url = $_GET['d'];?>
        <p class="message"><?php _e('Your profile has been updated.','cp')?></p>
        <?php } 
        
        ?>
        <?php //echo get_avatar($user_ID, 96); ?>
        <?php echo get_wp_user_avatar($user_ID, 96); ?>
        <div <?=$errcolor?>><?php echo $errmsg; ?></div>
        <form name="profile" action="" method="post">
            <?php wp_nonce_field('update-profile_' . $user_ID) ?>
            <input type="hidden" name="from" value="profile" />
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
            <input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_ID; ?>" />
            <table class="form-table" style="">
                <tr>
                <th><label for="user_login"><?php _e('Username','cp'); ?></label></th>
                <td><input type="text" name="user_login" class="mid2" id="user_login" value="<?php echo $userdata->user_login; ?>" size="35" maxlength="100" disabled /></td>
                </tr>
                <tr>
                <th><label for="first_name"><?php _e('First Name','cp') ?></label></th>
                <td><input type="text" name="first_name" class="mid2" id="first_name" value="<?php echo $userdata->first_name ?>" size="35" maxlength="100" /></td>
                </tr>
                <tr>
                <th><label for="last_name"><?php _e('Last Name','cp') ?></label></th>
                <td><input type="text" name="last_name" class="mid2" id="last_name" value="<?php echo $userdata->last_name ?>" size="35" maxlength="100" /></td>
                </tr>
                <tr>
                <th><label for="email"><?php _e('Email','cp') ?></label></th>
                <td><input type="text" name="email" class="mid2" id="email" value="<?php echo $userdata->user_email ?>" size="35" maxlength="100" /></td>
                </tr>
                <tr>
                <th><label for="url"> Website URL</label></th>
                <td><input type="text" name="url" class="mid2" id="url" value="<?php echo $userdata->user_url ?>" size="35" maxlength="100" /></td>
                </tr>
                <tr>
                <th><label for="description"><?php echo $GLOBALS['_LANG']['_accme']; ?></label></th>
                <td><textarea name="description" class="mid2" id="description" rows="8" cols="50"><?php echo $userdata->description ?></textarea></td>
                </tr>
                <tr>
                <th><label for="description">Twitter</label></th>
                <td><input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user_ID) ); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <p class="CheckoutBtn"><?php _e('Update Profile »', 'cp')?></p>

        <!--<h2 class="h2top">Personal Information </h2>
        <table class="form-table" style="640px;">-->
        <?php
        do_action('profile_personal_options');
        ?>
        <!--</table>-->
        <h2 class="h2top"><?php echo $GLOBALS['_LANG']['_password']; ?></h2>
        <table class="form-table" style="">

        <?php
        $show_password_fields = apply_filters('show_password_fields', true);
        if ( $show_password_fields ) :
        ?>
        <tr>
        <th><label for="pass1"><?php _e('New Password','cp'); ?></label></th>
        <td>
        <input type="password" name="pass1" class="mid2" id="pass1" size="35" maxlength="50" value="" />
        <small><?php _e('Leave this field blank unless you\'d like to change your password.','cp'); ?></small>
        </td>
        </tr>
        <tr>
        <th><label for="pass1"><?php _e('Password Again','cp'); ?></label></th>
        <td>
        <input type="password" name="pass2" class="mid2" id="pass2" size="35" maxlength="50" value="" />
        <small><?php _e('Type your new password again.','cp'); ?></small></td>
        </tr>
        <tr>
        </tr>
        <?php endif; ?>
        </table>

        <p class="CheckoutBtn"><?php _e('Update Profile »', 'cp')?></p>
        <?php
        if(function_exists('userphoto_exists')){
            echo '<h2 class="h2top">Website Photo </h2>';
            do_action('show_user_profile');

        echo "<div id='user-photo'>";
        if(userphoto_exists($user_ID))
        userphoto($user_ID);
        else
        echo get_avatar($userdata->user_email, 96);
        echo "</div>";
        ?>
        <?php if($userdata->userphoto_image_file): ?>
        <table class="form-table" style="">
        <tr>
        <th> </th>
        <td>
        <p><label><input type="checkbox" name="userphoto_delete" id="userphoto_delete" /> <?php _e('Delete existing photo?','cp') ?></label></p>
        </td>
        </tr>
        </table>
        <?php endif; ?>
        <p class="CheckoutBtn"><?php _e('Update Profile »', 'cp')?></p>
        <?php } ?>
         <p>
            <input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-profile-nonce'); ?>"/>
            <input type="submit" value="<?php _e('Update'); ?>"/>
        </p>
        </form>
    </div>
    <?php
    return ob_get_clean();
}

// checks they are authoized
function auth_redirect_login() {
    $user = wp_get_current_user();
    if ( $user->id == 0 ) {
        nocache_headers();
        wp_redirect(get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }
}

// register a new user
function pippin_update_profile() {
    /*
    if(!empty($_POST['action']))
    {
        require_once(ABSPATH . 'wp-admin/includes/user.php');
        require_once(ABSPATH . WPINC . '/registration.php');
        $user_ID = $userdata->ID;
        $user = $userdata; 
        if ( isset( $_POST['email'] ))
            $user->user_email = sanitize_text_field( wp_unslash( $_POST['email'] ) );
        if ( isset( $_POST['url'] ) ) {
            if ( empty ( $_POST['url'] ) || $_POST['url'] == 'http://' ) {
              $user->user_url = '';
            } else {
              $user->user_url = esc_url_raw( $_POST['url'] );
              $protocols = implode( '|', array_map( 'preg_quote', wp_allowed_protocols() ) );
              $user->user_url = preg_match('/^(' . $protocols . '):/is', $user->user_url) ? $user->user_url : 'http://'.$user->user_url;
            }
        }
        if ( isset( $_POST['first_name'] ) )
            $user->first_name = sanitize_text_field( $_POST['first_name'] );
        if ( isset( $_POST['last_name'] ) )
            $user->last_name = sanitize_text_field( $_POST['last_name'] );
        if ( isset( $_POST['nickname'] ) )
            $user->nickname = sanitize_text_field( $_POST['nickname'] );
        if ( isset( $_POST['display_name'] ) )
            $user->display_name = sanitize_text_field( $_POST['display_name'] );

        if ( isset( $_POST['description'] ) )
            $user->description = trim( $_POST['description'] );

        foreach ( wp_get_user_contact_methods( $user ) as $method => $name ) {
            if ( isset( $_POST[$method] ))
                $user->$method = sanitize_text_field( $_POST[$method] );
        }
  
        $errors = wp_update_user($userdata);
        update_usermeta( $user_ID, 'twitter', $_POST['twitter'] );    
        //check_admin_referer('update-profile_' . $user_ID);
        //$errors = edit_user($user_ID);
        
        if ( is_wp_error( $errors ) ) {
            foreach( $errors->get_error_messages() as $message )
            $errmsg = "$message";
            //exit;
        }
        // if there are no errors, then process the ad updates
        if($errmsg == '')
        {
            do_action('personal_options_update');
            $d_url = $_POST['dashboard_url'];
            wp_redirect( get_option("siteurl").'/profile?updated=true' );
        }
        else {
            $errmsg = '<div class="box-red">** ' . $errmsg . ' **</div>';
            $errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';
        }
    }   
    */  
}
add_action('init', 'pippin_update_profile');
?>