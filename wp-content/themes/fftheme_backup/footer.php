<div class="clear"></div>
 <footer>
      <div class="footer-wrap">
       		<div class="footer-content">
				<div class="footer-left">
					<section id="main">
						<div class="footer-title"><h3>Main</h3></div>
							<ul>
								<li><a href="<?php echo home_url( '/index.php' ); ?>">Home</a></li>
								<li><a href='
        <?php
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            echo bp_core_get_user_domain($current_user->user_login).''.$current_user->user_login.'/profile';
        } else {
            echo get_site_url() . '/wp-login.php';
        }
 
        ?>'>Profile</a></li>
								<li><a href="<?php echo home_url( '/index.php' ).'/buy'; ?>">Buy</a></li>
								<li><a href="<?php echo home_url( '/videogridengine/index.php/users/foundbox' ); ?>">Foundboxes</a></li>
								<li><a href="<?php echo home_url( '/videogridengine/index.php/users/foundbox/admin' ); ?>">Edit Foundboxes</a></li>
                                                              
							</ul>
					</section>
					<section id="links">
							<div class="footer-title"><h3>Contact</h3></div>
						<ul>
							<li><a href="<?php if (is_user_logged_in()) { echo home_url( '/index.php' ).'/contactus';} else{ echo get_site_url() . '/wp-login.php'; }?>">General Inquiries</a></li>
							<li><a href="<?php if (is_user_logged_in()) { echo home_url( '/index.php' ).'/contactus';} else{ echo get_site_url() . '/wp-login.php'; } ?>">Support</a></li>
                                                        <li><a href="<?php if (is_user_logged_in()) { echo home_url( '/index.php' ).'/contactus';} else{ echo get_site_url() . '/wp-login.php'; } ?>">Advertise Here</a></li>
							<li><a href="#">Follow Us</a></li>
							<li class="footer-icons">
								<a href="https://www.facebook.com/FindingFootage"><img src="<?php bloginfo( 'template_url' ); ?>/images/f.gif" /></a>
								<a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/t.gif" /></a>
								<a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/b.gif"/></a>
							</li>
						</ul>
					</section>
<!--					<section id="resouse">
							<div class="footer-title"><h3>Resource</h3></div>
						<ul>
							<li><a href="#">login</a></li>
							<li><a href="#">profile</a></li>
							<li><a href="#">Forum</a></li>
							<li><a href="#">Agenciest</a></li>
							<li><a href="#">List</a></li>
							<li><a href="#">Add an</a></li>
							<li><a href="#">Agency</a></li>
						</ul>
					</section>-->
					<br clear="all" />
					<div class="copyright">DESIGN BY: Purple studio copyright &copy; 2011 All Rights Reserved | Powered 	by       <a href="http://www.dacoders.com/" target="_blank">DACODERS</a></div>
				</div>
				<div class="footer-right">
					<div class="sign-up">
					join our community - its FREE<br />
					<a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/sin-up-now.gif" alt="sign up"/></a>
					</div>
				</div>
	   		</div>
	  </div>
</footer>
</body>
</html>




