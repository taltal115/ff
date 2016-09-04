<div class="form">
    
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'successbox',
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

echo "<div style='padding:10px 10px 10px 10px;'>Foundboxes has been added succesfully</div>";

$this->endWidget('zii.widgets.jui.CJuiDialog');

$form = $this->beginWidget('GxActiveForm', array(
    'id' => 'foundbox-form',
    'action' => CHtml::normalizeUrl(Yii::app()->createUrl('search/foundbox')),
));

?>

    <input type="button" onclick="showCreate()" id="cmd_addtobox" value="Add Clips To Box" style="background:#803cad; color:#fff; border:1px solid #803cad; border-radius:5px; padding:4px; width: 48%;"/>
    <input type="button" onclick="showCreate()" id="cmd_createnew" value="Create New Box" style="background:gray; color:#fff; border:1px solid #803cad; border-radius:5px; padding:4px; width: 48%;"/>

    <?php echo $form->errorSummary($model); ?>

    <div class="row" style="display: none;">
        
        <?php echo $form->labelEx($model, 'CreateFoundBox');  ?>
        <span style="padding-left:8px;"><?php echo $form->checkBox($model, 'isNewFBox'); ?>
       
        <?php echo $form->error($model, 'isNewFBox'); ?></span>
    </div><!-- row -->
    
    <div id="addtobox" class="row" style="border: 1px solid black; border-radius: 5px;">
        <div style="height: 170px; margin-top: 20px; padding: 10px;">
        <div><? echo $form->labelEx($model, 'SelectedFoundBox'); ?>:</div>
        
        <?
        echo $form->dropDownList($model, 'selectedFBox', array());
         
        echo $form->hiddenField($model, 'foundBoxVideos');  
        ?>
        </div>
        <div style="text-align: center; margin-bottom: 10px;">
        <?
        echo GxHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(Yii::app()->createUrl('search/foundbox')),array(
            'type'=>'POST',
            'error'=>'addError()',
            'success'=>'function(data) {addSuccess(data)}'
          ),array( 'class' => 'btn_cmd' ));
        ?>
        </div>
    </div><!-- end Add -->

    <div id="createnew" class="newfboxdiv" style="border: 1px solid black; border-radius: 5px; display: none;">
        <div style="height: 170px; margin-top: 20px; padding: 10px">
            <div class="row">
                <table border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <td align="left" valign="top"><?php echo $form->labelEx($model,'box title'); ?></td>
                    <td  align="left" valign="top" style="padding-left:5px"><?php echo $form->textField($model, 'title', array('maxlength' => 280)); ?>
                        <?php echo $form->error($model,'title'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><?php echo $form->labelEx($model,'KEYWORDS'); ?></td>
                    <td  align="left" valign="top" style="padding-left:5px"><?php echo $form->textArea($model, 'description'); ?>
                        <?php echo $form->error($model,'description'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><?php echo $form->labelEx($model,'privacy'); ?></td>
                    <td  align="left" valign="top" style="padding-left:5px"><?php echo $form->dropDownList($model, 'privacy', array(1=>"Public",0=>"Private")); ?>
                        <?php echo $form->error($model,'privacy'); ?>
                    </td>
                  </tr>
                </table> 
            </div><!-- row -->
            
        </div>
        <div style="text-align: center; margin-bottom: 10px;">
        <?
        echo GxHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(Yii::app()->createUrl('search/foundbox')),array(
            'type'=>'POST',
            'error'=>'addError()',
            'success'=>'function(data) {addSuccess(data)}',
          ),array( 'class' => 'btn_cmd'));
        ?>
        </div>
    </div><!-- create -->
    
    <?php
  
    $this->endWidget();
    
    //}//end else if logged in
  
    ?>
</div><!-- form -->


<script type="text/javascript">
    function showCreate(){
        var isNew = false;
        if($('#FoundboxPopuForm_isNewFBox').is( ":checked" )){
            $('#createnew').hide(); 
            $('#cmd_createnew').css('background','gray');
            $('#addtobox').toggle(); 
            $('#cmd_addtobox').css('background','#803cad');
        }     
        else{
            $('#createnew').toggle();
            $('#cmd_createnew').css('background','#803cad');
            $('#addtobox').hide(); 
            $('#cmd_addtobox').css('background','gray');
            isNew = true;
        }
        $(':checkbox#FoundboxPopuForm_isNewFBox').prop('checked', isNew);
        return false;
    }
    
    function addError(){
       
    }
    function addSuccess(data){
        if(data != ""){
            alert(data); 
        }else{
            $("#adddialog").dialog("close");
            $("#successbox").dialog("open");
             setTimeout(function() {
            $("#successbox").dialog("close");
            }, 2000);
        }
    }

function updatefoundboxselected(){
    $('.newfboxdiv').hide();
    $('#FoundboxPopuForm_title').val('');
    $('#FoundboxPopuForm_description').val('');
    
    $('#FoundboxPopuForm_selectedFBox').html('');
    var url =  "<?php echo Yii::app()->request->baseUrl; ?>/index.php/foundboxes/getFBoxOptions";
        $.ajax({
            type: "POST",
            url: url,
            success: function(data)
            {
                var obj = $.parseJSON(data);
                var option="";
                        if(obj.length>0){
                            $.each(obj, function (index, value) {
                              option+='<option value="'+value.id+'">'+value.title+'</option>';  
                            });
                        }
                        $('#FoundboxPopuForm_selectedFBox').append(option);        
            }
        });
}
</script>


