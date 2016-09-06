<div class="form">
    <?php
    $postUrl = CHtml::normalizeUrl(Yii::app()->createUrl('footage/addclipform'));
    $form = $this->beginWidget('GxActiveForm', array( 
        'id' => 'foundbox-form',
        'action' => $postUrl,
    ));
    $fBoxVideo = new Foundboxvideos();
    /*
        $fBoxVideo->title = $fboxVideoData['videoName'];
        
        $fBoxVideo->description = "no discription yet..";
        
        $fBoxVideo->date_created = new CDbExpression('NOW()');
        
        $fBoxVideo->vid_flv_path = $fboxVideoData['videoFlvURL'];
    
        $fBoxVideo->vid_src_id = $fboxVideoData['videoServiceId'];
        
        $fBoxVideo->vid_src_url = $fboxVideoData['videoDollor'];
    
        $fBoxVideo->vid_thumb_url = $fboxVideoData['thumbURL'];
    */
    $model = $fBoxVideo;
    ?>
    <input name="FoundboxId" id="Foundbox_id" type="hidden" value="234"> 
    <table border="0" cellspacing="4" cellpadding="0">
        <tr>
            <td >    
                <?php echo $form->labelEx($model,'Name'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'title'); ?>
                <?php echo $form->error($model,'title'); ?>
            </td>
        </tr>
        <tr>
            <td>    
                <?php echo $form->labelEx($model,'Description'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'description'); ?>
                <?php echo $form->error($model,'description'); ?>
            </td>
        </tr>
        <tr>
            <td>    
                <?php echo $form->labelEx($model,'URL'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'vid_src_url'); ?>
                <?php echo $form->error($model,'vid_src_url'); ?>
            </td>
        </tr>
        <tr>
            <td>    
                <?php echo $form->labelEx($model,'Embed'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'vid_flv_path'); ?>
                <?php echo $form->error($model,'vid_flv_path'); ?>
            </td>
        </tr>
        <tr>
            <td>    
                <?php echo $form->labelEx($model,'Thumbnail'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'vid_thumb_url'); ?>
                <?php echo $form->error($model,'vid_thumb_url'); ?>
            </td>
        </tr>
        <tr>
            <td>    
                <?php echo $form->labelEx($model,'Affiliate'); ?>
            </td>
            <td>
                <input name="Affiliate" id="Foundboxvideos_Affiliate" type="text" maxlength="250">
            </td>
        </tr>
        <tr>
            <td>    
                <?php echo $form->labelEx($model,'Cookie link'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'cookie_url'); ?>
                <?php echo $form->error($model,'cookie_url'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <?php echo GxHtml::ajaxSubmitButton('Save',$postUrl,array(
                'type'=>'POST',
                'error'=>'addClipError()',
                'success'=>'function(data) {addClipSuccess(data)}',
                'class' => 'btn',
            )); 
            ?>
            </td>
        </tr>
    </table>
    
    <?      
    $this->endWidget();
    ?>
</div><!-- form -->

<script type="text/javascript">
    function addClipError(){
       
    }
    function addClipSuccess(data){
        if(data != "")
            alert(data); 
        else
            $("#addclipdialog").dialog("close");     
    }
</script>
