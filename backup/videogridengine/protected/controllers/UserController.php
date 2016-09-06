<?php

class UserController extends Controller {  
    
     public function actionIndex() {
        $id = $_GET['id']; 
        $userdata = $this->getUserData($id);
        if ( isset($userdata) ) {
             $this->render('index', array('userdata'=>$userdata,'usermsg'=>$usermsg));
        }
     }
     
     public function actionEdit() {
         $userdata = $this->getUserData();
         if ( isset($userdata) ) {
            // check to see if the form has been posted. If so, validate the fields
            $user_ID = $userdata->ID;
            if(!empty($_POST['action']))
            {
                $errmsg = $this->updateProfile($user_ID);
                // if there are no errors, then process the ad updates
                if($errmsg == '')
                {
                    //do_action('personal_options_update');
                    //$d_url = $_POST['dashboard_url'];
                    wp_redirect( get_option("siteurl").'/videogridengine/index.php/user' );
                    $usermsg = '<div style="background-color:#FFEBE8;border:1px solid #CC0000;">Your profile has been updated.</div>';
                }
                else {
                    $usermsg = '<div style="background-color:#FFEBE8;border:1px solid #CC0000;"><div class="box-red">** ' . $errmsg . ' **</div></div>';
                }    
            } 
            $this->render('edit', array('userdata'=>$userdata,'usermsg'=>$usermsg));    
         }
     }
     
     public function getUserData($id = null){      
        $userdata = null;
        if(isset($id))
            $user = get_userdata($id);//WP_User::get_data_by('id',$id);
        else
            $user = wp_get_current_user();
        if ( !($user->ID > 0)) {
            nocache_headers();
            wp_redirect(get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
            exit();
        }
        return $user;
     }
     public function updateProfile($user_ID){
        require_once(ABSPATH . 'wp-admin/includes/user.php');
        require_once(ABSPATH . WPINC . '/registration.php');
         
        check_admin_referer('update-profile_' . $user_ID);
        $errors = edit_user($user_ID);

        $youtub = $_POST['youtub']; 
        if(isset($youtub)){
            $youtub = $this->getUrlLink($youtub);
            $valid = preg_match("/(www\.)?(youtube\.com|youtu\.be)\/.*/", $youtub);
            if($valid || trim($youtub) == "") update_usermeta( $user_ID, 'youtub', $youtub);
        }
        $vimeo = $_POST['vimeo']; 
        if(isset($vimeo)){
            $vimeo = $this->getUrlLink($vimeo);
            $valid = preg_match("/(www\.)?(vimeo\.com)\/.*/", $vimeo); 
            if($valid || trim($vimeo) == "") update_usermeta( $user_ID, 'vimeo', $vimeo);
        }
        $facebook = $_POST['facebook'];
        if(isset($facebook)){
            $facebook = $this->getUrlLink($facebook);
            $valid = preg_match("/(www\.)?facebook\.com\/[a-zA-Z0-9(\.\?)?]/", $facebook); 
            if($valid || trim($facebook) == "") update_usermeta( $user_ID, 'facebook', $facebook);
        }    
        if(isset($_POST['show_email']))
            update_usermeta( $user_ID, 'show_email', '1' );
        else
            update_usermeta( $user_ID, 'show_email', '' );
                
        if(isset($_POST['company']))
            update_usermeta( $user_ID, 'company', $_POST['company'] );
        if(isset($_POST['contry']))
            update_usermeta( $user_ID, 'contry', $_POST['contry'] );
            
        if(isset($_POST['profession']))
            update_usermeta( $user_ID, 'profession', $_POST['profession'] );
        if(isset($_POST['skills']))
            update_usermeta( $user_ID, 'skills', $_POST['skills'] );
        
        if(isset($_POST['showreel'])){
            $showreel = $this->getUrlLink($_POST['showreel']);  
            update_usermeta( $user_ID, 'showreel', $showreel);
        }
        
        if(isset($_POST['sellhere']))
            update_usermeta( $user_ID, 'sellhere', $_POST['sellhere'] );
             
        if ( is_wp_error( $errors ) ) {
            foreach( $errors->get_error_messages() as $message )
                $errmsg = "$message";
            //exit;
        }
        
        return $errmsg; 
     }
     
     public function getUrlLink($link){
         if(strtolower(substr($link,0,4)) != "http" && trim($link) != "") $link = "http://$link";
         return $link;
     }
}