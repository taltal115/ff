<div class="form">
    <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'removeBox-form',
        'action' => CHtml::normalizeUrl(Yii::app()->createUrl('footage/removeboxform')),
    ));
    ?>
    <div style="height: 10px;"></div>
    <?php echo $form->hiddenField($model, 'id'); ?>
    <?php echo GxHtml::ajaxSubmitButton('Delete This FoundBox',CHtml::normalizeUrl(Yii::app()->createUrl('footage/removeboxform')),array(
            'type'=>'POST',
            'success'=>'removeBoxSuccessFoundbox()',
    ));
    $this->endWidget();
    ?> 
</div><!-- form -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'success_remove_box',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Successfully Delete FoundBox',
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

echo "<div style='padding:10px 10px 10px 10px;'>FoundBox Deleted Succesfully</div>";

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script type="text/javascript">
    
    function removeBoxSuccessFoundbox(){
        var redirectURL = "/videogridengine/index.php/foundboxes";
        $("#removefoundboxdialog").dialog("close");
        $("#success_remove_box").dialog("open");
        setTimeout(function() {
            $("#success_remove_box").dialog("close");
            window.location.href = redirectURL;
        }, 2000);
        
    }
</script>