<?php edit_post_link(__('Edit this page.', 'buddypress'), '<div class="edit-link">', '</div>'); ?>
<div class="clear"></div>
 <footer>
      <div class="footer-wrap">
       		<div class="footer-content">
				<div class="footer-left">
					<section id="main">
						<div id="footer">
							<div class="left">
								<p><a href="<?php echo home_url( '/index.php' ); ?>">Home</a></p>
								<p><a href='
        <?php
								if (is_user_logged_in()) {
									$current_user = wp_get_current_user();
									echo bp_core_get_user_domain($current_user->user_login).''.$current_user->user_login.'/profile';
								} else {
									echo get_site_url() . '/wp-login.php';
								}
								?>'>Profile</a></p>
								<p><a href="<?php echo home_url( '/index.php' ).'/buy'; ?>">Buy</a></p>
								<p><a href="<?php echo home_url( '/videogridengine/index.php/foundboxes/index' ); ?>">Foundboxes</a></p>
								<p><a href="<?php echo home_url( '/sitemap' ); ?>">Site Map</a></p>
							</div>
							<div class="center">
								<p><a href="<?php if (is_user_logged_in()) { echo home_url( '/index.php' ).'/contactus';} else{ echo get_site_url() . '/wp-login.php'; }?>">General Inquiries</a>
								<p><a href="<?php echo home_url( '/index.php' ).'/press-release'; ?>">Press Release</a>
								<p><a href="<?php echo home_url( '/index.php' ).'/articles-blog'; ?>">Articles & Blog</a>
								<p><a href="<?= home_url( '/terms-of-use' )?>">Terms of Use</a>
							</div>
							<div class="right">
								<p class="footer-icons">
									<a href="https://www.facebook.com/FindingFootage" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/images/new/DesktopSlicing/fb-icon.png" /></a>
									<a href="https://twitter.com/FindingFootage" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/images/new/DesktopSlicing/tw-icon.png" /></a>
									<a href="https://vimeo.com/findingfootage" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/images/new/DesktopSlicing/Vimeo-icon.png"/></a>
								</p>
								<p class="copyright">Copyright &copy; 2016 All Rights Reserved.</p>
								<div class="sign-up">
									join our community - its FREE<br />
									<a href="<?php echo get_site_url() . '/register/'; ?>"><div class="sign-up-button">
											<img src="<?php bloginfo( 'template_url' ); ?>/images/new/DesktopSlicing/signup-icon.png" alt="">
											Sign Up Now
										</div></a>
								</div>
							</div>
						</div>
					</div>
				  </div>
      
</footer>
</body>
</html>

