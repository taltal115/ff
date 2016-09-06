<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model, 'id'); ?>
		<?php //echo $form->textField($model, 'id', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'date_created'); ?>
		<?php //echo $form->textField($model, 'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'vid_src_url'); ?>
		<?php // echo $form->textField($model, 'vid_src_url', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'vid_flv_path'); ?>
		<?php //echo $form->textField($model, 'vid_flv_path', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php // echo $form->label($model, 'vid_src_id'); ?>
		<?php //echo $form->textField($model, 'vid_src_id', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'vid_thumb_url'); ?>
		<?php //echo $form->textField($model, 'vid_thumb_url', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'wp_foundbox_id'); ?>
		<?php echo $form->dropDownList($model, 'wp_foundbox_id', GxHtml::listDataEx(Foundbox::model()->findAllAttributes(null, true, 'wp_users_ID=:id', array(':id'=>Yii::app()->user->id))), array('prompt' => Yii::t('app', 'All'))); ?>	
	</div>
<?php 
if(Yii::app()->user->name=="admin")
        {
?>
	<div class="row">
		<?php echo $form->label($model, 'wp_service_id'); ?>
		<?php echo $form->dropDownList($model, 'wp_service_id', GxHtml::listDataEx(Service::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div><?php } ?>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
