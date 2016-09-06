<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'foundbox-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'privacy'); ?>
                    
		<?php  
            $privacy_vals = array(0=>"Private",1=>"Public");
            if(Yii::app()->user->name=="admin")
                $privacy_vals[2] = "Home Page";   
            echo $form->dropDownList($model, 'privacy', $privacy_vals) ; ?>
		<?php echo $form->error($model,'privacy'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'widget_thumb_url'); ?>
		<?php echo $form->textField($model, 'widget_thumb_url', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'widget_thumb_url'); ?>
		</div><!-- row -->
<!--		<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model, 'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
		</div> row -->
<!--		<div class="row">
		<?php echo $form->labelEx($model,'date_modified'); ?>
		<?php echo $form->textField($model, 'date_modified'); ?>
		<?php echo $form->error($model,'date_modified'); ?>
		</div> row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php 
            $status_vals = array(0=>"Private",1=>"Public");
            echo $form->dropDownList($model, 'status',$status_vals); 
        ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<?php 
                if(Yii::app()->user->name=="admin")
                    { ?>
                <div class="row">
		<?php echo $form->labelEx($model,'average_rank'); ?>
		<?php echo $form->textField($model, 'average_rank'); ?>
		<?php echo $form->error($model,'average_rank'); ?>
		</div><!-- row -->
                <div class="row">
		<?php echo $form->labelEx($model,'wp_users_ID'); ?>
		<?php echo $form->dropDownList($model, 'wp_users_ID', GxHtml::listDataEx(Users::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'wp_users_ID'); ?>
		</div><!-- row -->
                    <?php }
                    else
                    {   
                      echo  $form->hiddenField($model, 'wp_users_ID' ,array(
        'value'=>Yii::app()->user->id,
        
    ));
                    }
                    ?>   
                
<!--		<label><?php echo GxHtml::encode($model->getRelationLabel('foundboxvideoses')); ?></label>-->

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->