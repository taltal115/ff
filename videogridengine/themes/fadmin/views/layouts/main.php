<?php
//if user is login from wordpress it shud get login automaticaly
//if user is already login so we should not proceed its login method again

// echo "I am going to login";
//$loginModel=new LoginForm();
//   $loginModel->verifyUser();
//   echo "I am going to login";
//   exit;
//        

        


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    
<div class="container" id="page">

	<div id="header">
            <div id="logo">Welcome <?php echo ucwords(Yii::app()->user->name);?> Found Box Control Panel</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                                array('label'=>'Home', 'url'=>get_site_url()),
				array('label'=>'My Profile', 'url'=>bp_core_get_user_domain(Yii::app()->user->id)),
				array('label'=>'Login', 'url'=> get_site_url() . '/wp-login.php' , 'visible'=>Yii::app()->user->isGuest),
                                array('label'=>'Found Boxes', 'url'=>array('/users/foundbox/admin'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Found Boxes Videos', 'url'=>array('/users/foundboxvideos/admin'), 'visible'=>!Yii::app()->user->isGuest),

                                                            //array('label'=>'Web Services', 'url'=>array('/users/service/admin'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/users/default/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Finding Footage.<br/>
		All Rights Reserved.<br/>
		<?php echo CHtml::link("Powered By Dacoders","http://www.dacoders.com") ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
