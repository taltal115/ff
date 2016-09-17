<?php 
	global $user_ID, $current_user;
	get_currentuserinfo();
	?>
	<div id="iRToppanel"> 
<?php 
	global $user_identity, $user_ID;	
    if(!is_user_logged_in()){
        if(isset($_GET[user_id])){
            $out_user_id = $_GET[user_id];
        }
        $user = get_userdata($out_user_id);
        $user_identity = $user->display_name;  
        $user_ID = $out_user_id;
    }
	// If user is logged in or registered, show dashboard links in panel
	if (is_user_logged_in() || $out_user_id>0) { 
?>
	<div id="iRPanel">
		<div class="content clearfix">
			
            <div class="left border">
			<img src="<?php bloginfo('wpurl') ?>/wp-content/plugins/buddypress-sliding-login-panel/images/logo.png"  alt="Logo" />
				<h2>Welcome back, <?php echo ucwords($user_identity) ?>!</h2>				

                
			</div>
			
                    <?php 
                    function getBaseUrl()
{
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];
     
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
    $pathInfo = pathinfo($currentPath);
     
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];
     
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
     
    // return: http://localhost/myproject/
    return $protocol.$hostName.$pathInfo['dirname']."/";
}
                    ?>
                    
            <div class="left narrow">
                <h2>My Avatar</h2>   			
				<div style="width: 100%; height: 106px;">
                    <a href="<?=Yii::app()->baseUrl?>/index.php/user">
                        <?php echo get_wp_user_avatar($user_ID, 96); ?>
                    </a>
                </div>
			    <ul>
			        <li><a id="avtext" href="<?=Yii::app()->baseUrl?>/avatar">Change My Avatar</a></li>
                    <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/foundboxes/index?Foundbox_page=1&Myboxs" >My FoundBoxes</a></li>    
                </ul>
			</div>
		    
			
            <div class="left narrow">			
				<h2>Profile</h2>				
				<ul>					
					<li><a href="<?=Yii::app()->baseUrl?>/index.php/user">View My Profile</a></li>
					<li><a href="<?=Yii::app()->baseUrl?>/index.php/user/edit">Edit My Profile</a></li>
					<li><a href="<?php echo wp_logout_url(get_permalink())."&redirect_to=index.php"; ?>" rel="nofollow" title="<?php _e('Log out'); ?>"><?php _e('Log out'); ?></a></li>
				</ul>

			
			</div>
		

	
		</div>
         
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login" style="margin-right:-10%;">
	    	<li class="left">&nbsp;</li>
	    	<!-- Logout -->
	        <li><a class="" style="width:50px;" href="<?php echo wp_logout_url(get_permalink()); ?>" rel="nofollow" title="<?php _e('Log out'); ?>"><?php _e('Log out'); ?></a></li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">My Account</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>	
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->

<?php 
	// Else if user is not logged in, show login and register forms
	} else {	
?>
	<div id="iRPanel">
		<div class="content clearfix">
			
            <div class="left border" style="width:250px;">
				<img src="<?php bloginfo('wpurl') ?>/wp-content/plugins/buddypress-sliding-login-panel/images/logo.png"  alt="Logo" />
				<h2>Welcome to <?php bloginfo('name'); ?></h2>		
				<p>Login or Signup to meet new friends, find out what's going on, and connect with others on the site. </p><br/>
				
			</div>
			     
			
            <div class="left" style="width:195px;">
						<?php if (get_option('users_can_register')) : ?>	
				<!-- Register Form -->
				<form name="registerform" id="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
					<h2>Sign Up Now</h2>	
					Registering for this site is easy. Just fill in the fields on the registration page and we'll get a new account set up for you in no time. <br/>
					<input type="submit" name="wp-submit" id="wp-submit" value="<?php _e('Register'); ?>" class="bt_register" />
			     </form>
			<?php else : ?>
				<h1>Registration is closed</h1>
				<p>Sorry, you are not allowed to register by yourself on this site!</p>
				<p>You must either be invited by one of our team member or request an invitation by email.</b>.</p>
				
				<!-- Admin, delete text below later when you are done with configuring this panel -->
				<p style="border-top:1px solid #333;border-bottom:1px solid #333;padding:10px 0;margin-top:10px;color:white"><em>Note: If you are the admin and want to display the register form here, log in to your dashboard, and go to <b>Settings</b> > <b>General</b> and click "Anyone can register".</em></p>
			<?php endif ?>			
			</div>
            <div class="left right" style="width:195px;">
            <form class="clearfix" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post">
					<h2>Forgot Your Password?</h2>
					<label class="grey" for="user_login">Username or E-mail:</label>
					<input class="field" type="text" name="user_login" id="user_login_FP" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="23" />        			
                    <div class="clear"></div>
                     <p>A new password will be e-mailed to you.</p>
					<input type="submit" name="submit" value="Retrieve" class="bt_register" />
					<input type="hidden" name="redirect_to" value="<?php echo bloginfo('wpurl');//$_SERVER['REQUEST_URI']; ?>"/>
			</form>
            </div>
             
			<div class="left right" style="width:195px;">
				<!-- Login Form -->
				<form class="clearfix" action="<?php bloginfo('wpurl') ?>/wp-login.php" method="post">
					<h2>Member Login</h2>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="pwd" id="pwd" size="23" />
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
					<input type="hidden" name="redirect_to" value="<?php echo bloginfo('wpurl');//$_SERVER['REQUEST_URI']; ?>"/>
				</form>
			</div>			 
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login" style="">
	    	<li class="left">&nbsp;</li>
	    	<!-- Login / Register -->
			<li id="toggle">
				<a id="open" class="open" href="#">Log In</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->	
    		
<?php } ?>	

</div> <!--END panel -->	

<!-- End of login page -->
