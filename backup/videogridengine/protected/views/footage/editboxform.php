<div class="form">
    <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'foundbox-form',
        'action' => CHtml::normalizeUrl(Yii::app()->createUrl('footage/editboxform')),
    ));
    //print_r($model);
    ?>
    <?php echo $form->hiddenField($model, 'id'); ?>
    <div class="row" style="border-bottom:1px solid #ccc; padding:10px 10px 10px 50px; text-align:left">
            <?php echo $form->labelEx($model,'title'); ?>
            <span style="padding-left:50px;"><?php echo $form->textField($model, 'title', array('maxlength' => 280)); ?></span>
            <?php echo $form->error($model,'title'); ?>
    </div><!-- row -->
    <div class="row" style="border-bottom:1px solid #ccc; vertical-align:text-top; padding:10px 10px 10px 55px; text-align:left">
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left" valign="top">    
                <?php echo $form->labelEx($model,'KEYWORDS'); ?>
            </td>
            <td  align="left" valign="top" style="padding-left:5px">
                <?php echo $form->textArea($model, 'description'); ?>
                <?php echo $form->error($model,'description'); ?>
            </td>
        </tr>
    </table>

    </div><!-- row -->
    <div class="row" style="border-bottom:1px solid #ccc;  padding:10px 10px 10px 55px; text-align:left">
        <?php echo $form->labelEx($model,'privacy'); ?>
        <span style="padding-left:25px;"><?php  
            $status_vals = array(0=>"Private",1=>"Public");
            if(Yii::app()->user->name == "admin")
                $status_vals[2] = "Home Page";   
            echo $form->dropDownList($model, 'privacy', $status_vals) ; ?>
        <?php echo $form->error($model,'privacy'); ?></span>
    </div><!-- row -->
    <div align="left" style="padding:10px 10px 10px 150px;">

    <?php echo GxHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(Yii::app()->createUrl('footage/editboxform')),array(
        'type'=>'POST',
        'success'=>'editSuccessFoundbox()',
    )); 
          
    $this->endWidget();
    ?>

    </div>
</div><!-- form -->

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'success_saved_box',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Successfully saved vidoes',
        'autoOpen' => false,
        'modal' => true,
        'height' => 100, 
        'width' => 400,
        'position'=> 'top',
        'show'=>'blind',
        'hide'=>'blind',
        'dialogClass'=> 'noTitleStuff' 
        
    ),
));

echo "<div style='padding:10px 10px 10px 10px;'>Foundboxes has been saved succesfully</div>";

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script type="text/javascript">
    
    function editSuccessFoundbox(){
    
        $("#editdialog").dialog("close");
        $("#success_saved_box").dialog("open");
        setTimeout(function() {
            $("#success_saved_box").dialog("close");
            location.reload();
        }, 2000);
        
    }
</script>

   
