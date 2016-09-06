<?php

// used for tracking error messages
function pippin_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function pippin_show_error_messages() {
    if($codes = pippin_errors()->get_error_codes()) {
        echo '<div class="pippin_errors">';
            // Loop error codes and display errors
           foreach($codes as $code){
                $message = pippin_errors()->get_error_message($code);
                echo '<span class="error"><strong>' . '</strong> - ' . $message . '</span><br/>';
            }
        echo '</div>';
    }    
}


// register our form css
function pippin_register_css() {
    wp_register_style('pippin-form-css', plugin_dir_url( __FILE__ ) . '/css/forms.css');
}
add_action('init', 'pippin_register_css');

// load our form css
function pippin_print_css() {
    global $pippin_load_css;
 
    // this variable is set to TRUE if the short code is used on a page/post
    if ( ! $pippin_load_css )
        return; // this means that neither short code is present, so we get out of here
 
    wp_print_styles('pippin-form-css');
}
add_action('wp_footer', 'pippin_print_css');

?>