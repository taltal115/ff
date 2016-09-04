<?php   
//if user is login from wordpress it shud get login automaticaly
//if user is already login so we should not proceed its login method again
$loginModel = new LoginForm();
$loginModel->verifyUser();

?>

<!doctype html>
<html>
    <head>
        <!-- https://developers.facebook.com/tools/debug/og/object/ -->       
        <meta property="og:title" content="Finding Footage" /> 
        <meta property="og:image" content="http://www.findingfootage.com/videogridengine/images/logo.png" /> 
        <meta property="og:description" content="gives you fast and easy access to multiple video stocks at once, and expand your results. join us to find dozens of free clips online..." /> 
    
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="shortcut icon" href="http://www.findingfootage.com/videogridengine/images/fficon.png?v=1" />
        <?php
        $cs = Yii::app()->clientScript;

        $cs->scriptMap = array(
            'jquery.js' => Yii::app()->baseUrl . '/css/fftheme/js/jquery.js',
        //                'jquery-ui.min.js'=>false,
        //            'jquery-ui.css'=>false,
        );

        //Yii::app()->clientScript->registerCoreScript('jquery-ui.min.js',CClientScript::POS_HEAD);
        //$cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/jquery-ui.min.js', CClientScript::POS_HEAD);  
        $cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/jquery.js', CClientScript::POS_HEAD);
        $cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/jquery_tinyscrollbar.pack.js', CClientScript::POS_HEAD);
        $cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/videogridengine.js', CClientScript::POS_HEAD);
        $cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/videogridengine_cmds.js', CClientScript::POS_HEAD);
        $cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/jquery.tmpl.js', CClientScript::POS_HEAD);
        //$cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/flowplayer-3.2.6.min.js  ', CClientScript::POS_HEAD);

        ?>

        <!-------------------------- FOR VIDEO THUMBNAILS ---------------------------------->
            
        <?

        $cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/flowplayer-3.2.6.min.js', CClientScript::POS_HEAD); 
        $cs->registerScriptFile(Yii::app()->baseUrl . '/css/fftheme/js/player.js', CClientScript::POS_HEAD);

        ?>  
        <script type="text/javascript">
            var playerVar="<?=Yii::app()->baseUrl?>/css/fftheme/player/flowplayer-3.2.7.swf";
        </script>
        <!--------------------------  END FOR VIDEO THUMBNAILS ---------------------------------->


        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "086adda6-4aac-4cee-bbdc-b87d90f733cc", doNotHash: false, doNotCopy: false, hashAddressBar: false,onhover: false});</script>
 

        <script type='text/javascript' src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/jquery/jquery.form.js?ver=2.73"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/slide.js"></script>

   
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/style.css" rel="stylesheet" type="text/css">
		<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/tooltip.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/ie7/skin.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/tango/skin.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/ie7/skin.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/scrollbar.css" />
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/cufon/cufon-yui.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/cufon/Eras_Demi_ITC_400.font.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/cufon/Eras_Bold_ITC_400.font.js"></script>
        <script type="text/javascript">
                Cufon.replace('h3, .sign-up', {fontFamily:'Eras Demi ITC'});
                Cufon.replace('.bolg-title, .bolg-right-title, h2', {fontFamily:'Eras Bold ITC'});
        </script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/js/jquery.tinysort.min.js"></script>

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
  
    
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-57796105-1', 'auto');
          ga('send', 'pageview');

        </script>
  
        <!-- link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/assets/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/assets/js/bootbox.min.js"></script -->
        
        
    </head> 
    <body>
        <?php $this->widget('LoginSlider');  ?>    
        <header ><!-- Start header -->
            <div class="header-wrap">
                <div class="header-left">
                    <a href="<?php echo home_url('/index.php'); ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/new-logo.png" alt="logo">
                    </a>
                </div>
                <div class="header-center">
                    <div class="nav-links-left">
                        <?php $this->widget('SearchBar'); ?>
                    </div>
                    
                </div>
                <div class="header-right">
                    
                        
<?php
// var_dump(Yii::app()->user->isGuest);
//             print_r(Yii::app()->user->name);
//             print_r(Yii::app()->user->id);
if (!Yii::app()->user->isGuest) {

    //get current wordpress loged in user infomration
    // $current_user=wp_get_current_user();
    // echo $current_user->ID;
    ?>
                       <div id="toplogpanel">
                       <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/member-login.png" alt="member"
                             height="21" width="23">
                      <div class="member-login">Welcome, <a href='<?php echo bp_core_get_user_domain(Yii::app()->user->id); ?>'><?php echo Yii::app()->user->name; ?>!</a></div>
                       </div>

<?php
} else {
    ?>

<!--                            <div class="member-login"> <a href='<?php echo get_site_url(); ?>/register'> New Member </a> / <a href='<?php echo get_site_url(); ?>/wp-login.php'> Login </a></div>-->
                             <?php }
                             ?>         

                    
                </div>
            </div>
        </header>
        
        
        <?php // $this->widget('PaginationBar'); ?> 
        <div class="pageing-container">
            <div class="pageing-area-wrapper">
                <div class="pageing-area-left">
                    <a href="#" onclick="openAddDialog();">SAVE SELECTED CLIPS</a> / <a href="#" onclick="deSelectallVideoThumbs();">SELECT NONE</a>
                </div>
            </div>
        </div>
        <!-- End Of header -->
        <div class="clear"></div>
        <!-- Paginaiton-->
        <!-- Pagination END -->
        <div class="content">
            <!-- RIGHT SIDE BAR START -->
               <!-- div class="sidebar-right">
	            <div class="sponser-contaienr">
		            <a href="#"><img alt="banner1"
						             src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/ADS.png"></a>
		            <a href="#"><img alt="banner2"
						             src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/ADS.png"></a>
		            <a href="#"><img alt="banner3"
						             src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/ADS.png"></a>
		            <a href="#"><img alt="banner4"
						             src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/ADS.png"></a>
	            </div>
            </div -->         
            <!-- RIGHT SIDE BAR END -->
            <div class="main">

                <div class="content-wrap">
                        <?php echo $content; ?>
                </div>


            </div>
        </div>
        <div class="clear"></div>
        
        <?
             get_footer('ff');
         ?>
        
    </body>  
</html>
