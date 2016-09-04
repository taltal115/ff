<?php
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo-login.png);
            background-size: 308px;
            height: 172px;
            width: 308px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Finding Footage Video Searching';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


function bp_core_get_user_domain($loginUserId) {
}
function bp_loggedin_user_domain(){
}
function bp_loggedin_user_avatar(){
}

?>