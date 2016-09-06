<!doctype html>
<html>
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/ie7/skin.css"/>
	<link rel="stylesheet" type="text/css" href="css/fftheme/tango/skin.css" />
	<link rel="stylesheet" type="text/css" href="css/fftheme/ie7/skin.css" />
	<link rel="stylesheet" type="text/css" href="css/fftheme/scrollbar.css" />

	<!-- script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/cufon-yui.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/cufon/cufon-yui.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/cufon/Eras_Demi_ITC_400.font.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/cufon/Eras_Bold_ITC_400.font.js"></script>
	<script type="text/javascript">
		//Cufon.replace('h3, .sign-up', {fontFamily:'Eras Demi ITC'});
		Cufon.replace('.bolg-title, .bolg-right-title, h2', {fontFamily:'Eras Bold ITC'});
	</script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/jquery.tinyscrollbar.min.js"></script -->
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/ffjsapp.js"></script>
</head>
<body>
<header><!-- Start header -->
	<div class="header-wrap">
		<div class="header-left">
			<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/new-logo.png" alt="logo"></a>
		</div>
		<div class="header-center">
			<div class="nav-links-left">
				<ul>
					<li class="links"><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/home-icon.png" alt="home"
						height="47" width="51"></a></li>
					<li><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/user-icon.png" alt="user"
						height="47" width="51"></a></li>
					<li><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/cart-icon.png" alt="cart"
						height="47" width="51"></a></li>
					<li><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/star-icon.png" alt="star"
						height="47" width="51"></a></li>
					<li class="search"><input value="SEARCH..." name="query" class="input-box" type="text"></li>
					<li class="dropdown">
						<div class="drop-text">Sort</div>
					</li>
					<li class="right-icon"><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/nav-icon1.png" alt="icon1"
						height="38" width="37"></a></li>
					<li class="right-icon"><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/nav-icon2.png" alt="icon2"
						height="38" width="39"></a></li>
					<li class="right-icon"><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/nav-icon3.png" alt="icon3"
						height="38" width="38"></a></li>
					<li class="advance-search"><a href="#"><img
						src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/advance-seach.png"
						alt="adavace"></a></li>
				</ul>
			</div>
		</div>
		<div class="header-right">
			<ul>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/member-login.png" alt="member"
					 height="21" width="23">

				<div class="member-login"><a href="#">Log in</a> / <a href="#">Register</a></div>
			</ul>
		</div>
	</div>
</header>
<!-- End Of header -->
<div class="clear"></div>
<div class="content">
<!-- RIGHT SIDE BAR START -->
<div class="sidebar-right">
	<div class="sponser-contaienr">
		<a href="#"><img alt="banner1"
						 src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-banner1.jpg"></a>
		<a href="#"><img alt="banner2"
						 src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-banner2.jpg"></a>
		<a href="#"><img alt="banner3"
						 src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-banner3.jpg"></a>
		<a href="#"><img alt="banner4"
						 src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-banner4.jpg"></a>
	</div>
</div>
<!-- RIGHT SIDE BAR END -->
<div class="main">

		<div class="content-wrap">
		<?php echo $content; ?>
	<div class="p-arrow-left sliders"><img alt="Scroll Left" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png"></div>
	<div id="services-panel">
		<div id="services-Container">
			<ul class="services-list">
				<?php 
				$videos = array( 5, 10, 15 );
				for( $i = 0; $i < 3; $i++ ) { ?>
				<li class="service">
					<div class="heading">
						<div class="wrap">
							<div class="hd"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-hd.jpg" /></div>
							<div class="r1">
								<a class="btn x1" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn1.jpg"></a>
								<a class="btn x2 one-toggle-three" href="javascript:void(0);"><img alt=""
			 src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn2.jpg"></a>
								<a class="btn x3 hide-restore" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn3.jpg"></a>
							</div>
							<div class="r2"><span><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-flower.jpg"></span></div>
							<div class="r3">
								<a class="btn x4 one-col" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn4.jpg"></a>
								<a class="btn x5 two-col" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn5.jpg"></a>
								<a class="btn x6 three-col" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn6.jpg"></a>
							</div>
						</div>
					</div>
					<div class="video-list">
						<div class="video-container">
							<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
							<div class="videos viewport">
								<ul class="videos-containers overview">
									<?php
									for( $j = 0; $j < $videos[ $i ]; $j++ ) { ?>
									<li class="video">
										<div class="img">
											<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-img2.jpg">
										</div>
										<div class="text">
											<img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-text.jpg">
										</div>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="p-arrow-right sliders"><img alt="Scroll Right" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"></div>

</div>


		</div>
</div>
<footer>
	<div class="footer-wrap">
		<div class="footer-content">
			<div class="footer-left">
				<section id="main">
					<div class="footer-title">
						<h3>
							<cufon style="width: 35px; height: 14px;" alt="Main" class="cufon cufon-canvas">
								<canvas style="width: 48px; height: 17px; top: -1px; left: -2px;" height="17"
										width="48"></canvas>
								<cufontext>Main</cufontext>
							</cufon>
						</h3>
					</div>
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Buy</a></li>
						<li><a href="#">Sell Footage</a></li>
						<li><a href="#">Fund Box</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</section>
				<section id="links">
					<div class="footer-title">
						<h3>
							<cufon style="width: 36px; height: 14px;" alt="Links" class="cufon cufon-canvas">
								<canvas style="width: 52px; height: 17px; top: -1px; left: -2px;" height="17"
										width="52"></canvas>
								<cufontext>Links</cufontext>
							</cufon>
						</h3>
					</div>
					<ul>
						<li><a href="#">Advertise us</a></li>
						<li><a href="#">Share with</a></li>
						<li><a href="#">Us</a></li>
						<li><a href="#">follow us</a></li>
						<li class="footer-icons">
							<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/f.gif"></a>
							<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/t.gif"></a>
							<a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/b.gif"></a>
						</li>
					</ul>
				</section>
				<section id="resouse">
					<div class="footer-title">
						<h3>
							<cufon style="width: 64px; height: 14px;" alt="Resource" class="cufon cufon-canvas">
								<canvas style="width: 78px; height: 17px; top: -1px; left: -2px;" height="17"
										width="78"></canvas>
								<cufontext>Resource</cufontext>
							</cufon>
						</h3>
					</div>
					<ul>
						<li><a href="#">login</a></li>
						<li><a href="#">profile</a></li>
						<li><a href="#">Forum</a></li>
						<li><a href="#">Agenciest</a></li>
						<li><a href="#">List</a></li>
						<li><a href="#">Add an</a></li>
						<li><a href="#">Agency</a></li>
					</ul>
				</section>
				<br clear="all">

				<div class="copyright">DESIGN BY: Purple studio copyright � 2011 All Rights Reserved | Powered by <a href="http://www.dacoders.com/" target="_blank">DACODERS</a></div>
			</div>
			<div class="footer-right">
				<div class="sign-up">
					<cufon style="width: 31px; height: 14px;" alt="join " class="cufon cufon-canvas">
						<canvas style="width: 49px; height: 17px; top: -1px; left: -2px;" height="17"
								width="49"></canvas>
						<cufontext>join</cufontext>
					</cufon>
					<cufon style="width: 28px; height: 14px;" alt="our " class="cufon cufon-canvas">
						<canvas style="width: 46px; height: 17px; top: -1px; left: -2px;" height="17"
								width="46"></canvas>
						<cufontext>our</cufontext>
					</cufon>
					<cufon style="width: 83px; height: 14px;" alt="community " class="cufon cufon-canvas">
						<canvas style="width: 101px; height: 17px; top: -1px; left: -2px;" height="17"
								width="101"></canvas>
						<cufontext>community</cufontext>
					</cufon>
					<cufon style="width: 8px; height: 14px;" alt="- " class="cufon cufon-canvas">
						<canvas style="width: 26px; height: 17px; top: -1px; left: -2px;" height="17"
								width="26"></canvas>
						<cufontext>-</cufontext>
					</cufon>
					<cufon style="width: 20px; height: 14px;" alt="its " class="cufon cufon-canvas">
						<canvas style="width: 38px; height: 17px; top: -1px; left: -2px;" height="17"
								width="38"></canvas>
						<cufontext>its</cufontext>
					</cufon>
					<cufon style="width: 36px; height: 14px;" alt="FREE" class="cufon cufon-canvas">
						<canvas style="width: 49px; height: 17px; top: -1px; left: -2px;" height="17"
								width="49"></canvas>
						<cufontext>FREE</cufontext>
					</cufon>
					<br><a href="#"><img
					src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/sin-up-now.gif"
					alt="sign up"></a></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</footer>
</body>
</html>
