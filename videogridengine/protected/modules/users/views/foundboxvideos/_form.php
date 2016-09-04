<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'foundboxvideos-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php //echo $form->labelEx($model,'date_created'); ?>
		<?php //echo $form->textField($model, 'date_created'); ?>
		<?php //echo $form->error($model,'date_created'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model, 'description'); ?>
		<?php echo $form->error($model,'description'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'vid_src_url'); ?>
		<?php echo $form->textField($model, 'vid_src_url', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'vid_src_url'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'vid_flv_path'); ?>
		<?php echo $form->textField($model, 'vid_flv_path', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'vid_flv_path'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'vid_src_id'); ?>
		<?php echo $form->textField($model, 'vid_src_id', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'vid_src_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'vid_thumb_url'); ?>
		<?php echo $form->textField($model, 'vid_thumb_url', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'vid_thumb_url'); ?>
		</div><!-- row -->
                
                <?php
                
                if(Yii::app()->user->name == "admin"){
                ?>
                
		<div class="row">
		<?php echo $form->labelEx($model,'wp_foundbox_id'); ?>
		<?php echo $form->dropDownList($model, 'wp_foundbox_id', GxHtml::listDataEx(Foundbox::model()->findAllAttributes(null,true))); ?>
		<?php echo $form->error($model,'wp_foundbox_id'); ?>
		</div><!-- row -->
                <?php 
                }else{               
                
                ?>
                
                <div class="row">
		<?php echo $form->labelEx($model,'wp_foundbox_id'); ?>
		<?php echo $form->dropDownList($model, 'wp_foundbox_id', GxHtml::listDataEx(Foundbox::model()->findAllAttributes(null,true, 'wp_users_ID=:id', array(':id'=>Yii::app()->user->id)))); ?>
		<?php echo $form->error($model,'wp_foundbox_id'); ?>
		</div><!-- row -->
                <?php  } ?>
                
		<div class="row">
                    
		<?php echo $form->labelEx($model,'wp_service_id'); ?>
		<?php echo $form->dropDownList($model, 'wp_service_id', GxHtml::listDataEx(Service::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'wp_service_id'); ?>
		</div><!-- row -->
               
                
                
               


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->