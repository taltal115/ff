<div class="form">


     
     <?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'successbox',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Successfully saved vidoes',
        'autoOpen' => false,
        'modal' => true,
        'height' => 50, 
        'width' => 400,
        'position'=> 'top',
        'show'=>'blind',
        'hide'=>'blind',
        'dialogClass'=> 'noTitleStuff' 
        
    ),
));

echo "Foundboxes has been added succesfully";

//$this->renderPartial('foundboxform', array(
//    'model' => new FoundboxPopuForm,
//    'buttons' => 'create'));

$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
//echo CHtml::link('open dialog', '#', array(
//'onclick'=>'$("#adddialog").dialog("open"); return false;',
//));
     
     
//     echo "SAJID1";
//      if(Yii::app()->user->isGuest){
//          
//     echo CHtml::beginForm();
//     echo CHtml::label('Sorry your are not logged ',null);
//     echo CHtml::link('click here for login',get_site_url().'/wp-login.php');
//     echo CHtml::endForm();
//      
//     
//      }//end if
//    
////var_dump($model);
//      
//    else{
        
    
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'foundbox-form',
        'action' => CHtml::normalizeUrl(Yii::app()->createUrl('search/foundbox')),
            ));

//$form=new GxActiveForm();
   
    // $this->redirect(get_site_url().'/wp-login.php');
    
  
  
Yii::app()->clientScript->registerScript('foundbox', "
$('#fboxx').click(function(){

        if(document.getElementById('FoundboxPopuForm_isNewFBox').checked==true){
	$('.newfboxdiv').hide();
            $(':checkbox#FoundboxPopuForm_isNewFBox').prop('checked', false);
            
}     
        else{
        $('.newfboxdiv').toggle();
        $(':checkbox#FoundboxPopuForm_isNewFBox').prop('checked', true);
         }
	return false;
});

");


?>
    <p class="note" style=" text-align:left; padding:5px 5px 5px 10px;">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required" style="color:#F00">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row" style="border-bottom:1px solid #ccc; padding:10px">
        <?php //echo $form->labelEx($model, 'selectedFBox');// ?>
        <?php echo $form->labelEx($model, 'SelectedFoundBox'); ?>
        <?php
        
      
if (Yii::app()->user->name == "admin") {
    echo $form->dropDownList($model, 'selectedFBox', GxHtml::listDataEx(Foundbox::model()->findAllAttributes(null, true)));
} else {
    $criteria = new CDbCriteria;
    $criteria->compare('wp_users_ID', Yii::app()->user->id, true);
    echo $form->dropDownList($model, 'selectedFBox', GxHtml::listDataEx(Foundbox::model()->findAll($criteria)));
}
?>&nbsp&nbsp
<input type="button" id="fboxx" value="Create" style="background:#803cad; color:#fff; border:1px solid #803cad; border-radius:5px; padding:4px;"/>
<?php
echo $form->hiddenField($model, 'foundBoxVideos')
        ?>
        
        <?php //echo $form->error($model, 'selectedFBoxs'); ?>
    </div><!-- row -->

     <div class="row" style="border-bottom:1px solid #ccc; padding:10px; display: none;">
        <?php echo $form->labelEx($model, 'CreateFoundBox');  ?>
        <span style="padding-left:8px;"><?php echo $form->checkBox($model, 'isNewFBox'); ?>
        <?php //echo $form->checkBox($model, 'isNewFBox',array('size'=>1,'maxlength'=>1, 'value'=>'true', 'uncheckValue'=>'false')); ?>
<!--            <input type="button" id="fboxx" value="Create"/>-->
        <?php echo $form->error($model, 'isNewFBox'); ?></span>
    </div><!-- row -->
    <div class="newfboxdiv" style="display: none;">
         
    <div class="row" style="border-bottom:1px solid #ccc; padding:10px 10px 10px 50px; text-align:left">
		<?php echo $form->labelEx($model,'title'); ?>
        
        
		<span style="padding-left:50px;"><?php echo $form->textField($model, 'title', array('maxlength' => 280)); ?></span>
		<?php echo $form->error($model,'title'); ?>
		</div><!-- row -->
		<div class="row" style="border-bottom:1px solid #ccc; vertical-align:text-top; padding:10px 10px 10px 55px; text-align:left">
		<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">	<?php echo $form->labelEx($model,'description'); ?></td>
    <td  align="left" valign="top" style="padding-left:5px"><?php echo $form->textArea($model, 'description'); ?>
		<?php echo $form->error($model,'description'); ?></td>
  </tr>
</table>

	
		
		</div><!-- row -->
		<div class="row" style="border-bottom:1px solid #ccc;  padding:10px 10px 10px 55px; text-align:left">
		<?php echo $form->labelEx($model,'privacy'); ?>
                    
		<span style="padding-left:25px;"><?php  
                echo $form->dropDownList($model, 'privacy', array(1=>"Public",0=>"Private")) ; ?>
		<?php echo $form->error($model,'privacy'); ?></span>
		</div><!-- row -->
    </div> 
                <!--

                we would create our thumb images from videos 
                <div class="row">
		<?php //echo $form->labelEx($model,'widget_thumb_url'); ?>
		<?php //echo $form->textField($model, 'widget_thumb_url', array('maxlength' => 250)); ?>
		<?php //echo $form->error($model,'widget_thumb_url'); ?>
		</div>
-->

		

    <div align="left" style="padding:10px 10px 10px 150px;"><?php
    
   // echo GxHtml::submitButton(Yii::t('app', 'Save'));

     echo GxHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(Yii::app()->createUrl('search/foundbox')),array(
    'type'=>'POST',
    'success'=>'addedSuccessFoundbox()',
  ));
     
    $this->endWidget();
    
    //}//end else if logged in
  
    ?></div>
</div><!-- form -->


<script type="text/javascript">
    
    function addedSuccessFoundbox(){
    
        $("#adddialog").dialog("close");
        $("#successbox").dialog("open");
         setTimeout(function() {
        $("#successbox").dialog("close");
    }, 2000);
       // window.alert("videos has been added succesfully");
        
    }
    
    </script>


