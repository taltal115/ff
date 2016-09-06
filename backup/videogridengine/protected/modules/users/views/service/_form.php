<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'service-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'servicename'); ?>
		<?php echo $form->textField($model, 'servicename', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'servicename'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sortorder'); ?>
		<?php echo $form->textField($model, 'sortorder'); ?>
		<?php echo $form->error($model,'sortorder'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('foundboxvideoses')); ?></label>
		<?php echo $form->checkBoxList($model, 'foundboxvideoses', GxHtml::encodeEx(GxHtml::listDataEx(Foundboxvideos::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->