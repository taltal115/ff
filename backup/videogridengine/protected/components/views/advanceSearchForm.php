<div class="form">


     
     <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'advancesearch-form',
        'action' => CHtml::normalizeUrl(Yii::app()->createUrl('search/foundbox')),
            ));



?>
    
<?php echo CHtml::errorSummary($model); ?>
 
    <div class="row">
        <?php echo CHtml::activeLabel($model,'username'); ?>
        <?php echo CHtml::activeTextField($model,'username') ?>
    </div>
 
    <div class="row">
        <?php echo CHtml::activeLabel($model,'password'); ?>
        <?php echo CHtml::activePasswordField($model,'password') ?>
    </div>
 
    <div class="row rememberMe">
        <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
        <?php echo CHtml::activeLabel($model,'rememberMe'); ?>
    </div>
 
    <div class="row submit">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>
   
             
		

    <?php
    
    //echo GxHtml::submitButton(Yii::t('app', 'Save2'));
//     echo GxHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(Yii::app()->createUrl('search/foundbox')),array(
//    'type'=>'POST',
//    'success'=>'',
//  ));
     
    $this->endWidget();
    
    //}//end else if logged in
  
    ?>
</div><!-- form -->




