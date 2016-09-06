<div class="form">
    <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'removeClips-form',
        'action' => CHtml::normalizeUrl(Yii::app()->createUrl('footage/removeclipsform')),
    ));
    //echo $form->hiddenField('foundBoxVideos');
    ?>
    <div style="height: 10px;"></div>
    <input name="Foundbox[removeClips]" id="Foundbox_removeClips" type="hidden" >
    <?php echo $form->hiddenField($model, 'id'); ?>
    <?php echo GxHtml::ajaxSubmitButton('Remove All Selected Clips',CHtml::normalizeUrl(Yii::app()->createUrl('footage/removeclipsform')),array(
            'type'=>'POST',
            'success'=>'removeClipsSuccessFoundbox()',
    ));
    $this->endWidget();
    ?> 
</div><!-- form -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'success_remove_clips',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Successfully Removed Clips',
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

echo "<div style='padding:10px 10px 10px 10px;'>Selected Clips Removed Succesfully</div>";

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script type="text/javascript">
    
    function removeClipsSuccessFoundbox(){
    
        $("#removeclipsdialog").dialog("close");
        $("#success_remove_clips").dialog("open");
        setTimeout(function() {
            $("#success_remove_clips").dialog("close");
            location.reload();
        }, 2000);
        
    }
</script>