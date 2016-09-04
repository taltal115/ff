<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

		<?php do_action( 'bp_head' ) ?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
        <script type="text/javascript">
            
            function searchVideo(e)
            {


                if (e.keyCode == 13) {
                    var searchKeyword = document.getElementById("searchItem").value;

                    if(searchKeyword!=""){
                    gotoUrl="/videogridengine/index.php/search?SearchBarForm%5BsearchKeywords%5D="+searchKeyword;
                    mainsite="<?php echo get_site_url(); ?>";
                    //alert(gotoUrl);
                    window.window.location.href=mainsite+gotoUrl+"&direction=h";
                    return true;
                }
                    else
                        {
                            var searchKeyword = document.getElementById("searchItem").value="Search";

                        }
                }

            }
        
            function SwapImage(ImageUrl,Control)
            {
                Control.src = ImageUrl;
              
            }
       
       </script>

<style type="text/css">
#header{background:#803cad;}
</style>


	</head>

	<body <?php body_class() ?> id="bp-default">

		<?php do_action( 'bp_before_header' ) ?>

		<div id="header">
			<div id="search-bar" role="search">
                <div class="header-left">
                    <a href="<?php echo home_url( '/index.php' ); ?>" title="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/new-logo.png" alt="logo" /></a>

		 	</div>
			<div class="header-center">
				<div class="nav-links-left">
					<ul style="padding-left:1%">
                        <li class="links"><a href="<?php echo home_url( '/index.php' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/home-icon.png" alt="home" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/home-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/home-icon-hv.png',this);"></a></li>
                        <li><a href="
                                <?php
                                    if (is_user_logged_in()) 
                                    {
                                        $userArrsy = wp_get_current_user();
                                        $loginUserId = $userArrsy->ID;
                                        echo bp_core_get_user_domain($loginUserId); 
                                   }else
                                        {
                                            echo get_site_url() . '/wp-login.php';
                                        }?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/user-icon.png" alt="user" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/user-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/user-icon-hv.png',this);"></a></li>
                        <li><a href="<?php echo home_url( '/index.php' ).'/buy'; ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/cart-icon.png" alt="cart" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/cart-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/cart-icon-hv.png',this);"></a></li>
                        <li><a href="<?php echo home_url( '/videogridengine/index.php/foundboxes' )?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/star-icon.png" alt="star" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/star-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/star-icon-hv.png',this);"></a></li>
                        <li class="search"><input id="searchItem" type="text" onBlur="this.value==''?this.value='Search...':''" onClick="this.value=='Search...'?this.value='':''" value="Search..." class="input-box"  onkeypress="return searchVideo(event)" title="Search" /></li>
                       <li class="dropdown"><div class="drop-text">Sort</div></li>
                        <li class="right-icon"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/nav-icon1.png" alt="icon1" width="37" height="38" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon1.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon1-hv.png',this);"></a></li>
                        <li class="right-icon"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/nav-icon2.png" alt="icon2" width="39" height="38" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon2.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon2-hv.png',this);"></a></li>
                        <li class="right-icon"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/nav-icon3.png" alt="icon3" width="38" height="38" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon3.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon3-hv.png',this);"></a></li>
                        <li class="advance-search" style="width:200px">&nbsp;</li>
                    </ul>
				</div>
			</div>
				<?php /*?><div class="padder">
<!--					<h1 id="logo" role="banner">-->
<!--                        <a href="--><?php //echo home_url(); ?><!--" title="--><?php //_ex( 'Home', 'Home page banner link title', 'buddypress' ); ?><!--">--><?php //bp_site_name(); ?><!--</a>-->
<!--                    </h1>-->

						<form action="<?php echo bp_search_form_action() ?>" method="post" id="search-form">
							<label for="search-terms" class="accessibly-hidden"><?php _e( 'Search for:', 'buddypress' ); ?></label>
							<input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />

							<?php echo bp_search_form_type_select() ?>

							<input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />

							<?php wp_nonce_field( 'bp_search_form' ) ?>

						</form><!-- #search-form -->

				<?php do_action( 'bp_search_login_bar' ) ?>

				</div><?php */?><!-- .padder -->
			</div><!-- #search-bar -->

                        <?php 
                        
                        $uri = $_SERVER['REQUEST_URI'];
                        $leng=strlen($uri);
                        $start=$leng-9;
                        $action=substr($uri,$start,$leng);
                       
                        if($action!='register/'){
                        
                        ?>
			<div id="navigation" role="navigation">
				<?php 
                                if (is_user_logged_in()) {
                                wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'primary', 'fallback_cb' => 'bp_dtheme_main_nav' ) );
                                }//end if
                                ?>
			
                        </div>
                        <?php 
                        }//end if
                        ?>
                        
                        
			<?php do_action( 'bp_header' ) ?>

		</div><!-- 		 -->

		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>
<div class="pageing-container"></div>
		<div id="container">