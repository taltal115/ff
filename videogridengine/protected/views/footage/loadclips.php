

<?php
    
     //Yii::app()->user->name == "admin"
     $form = $this->beginWidget('GxActiveForm', array(
        'htmlOptions'=>array(
            'enctype' => 'multipart/form-data',
        ),
        'id' => 'loadclips-form',
        'enableAjaxValidation' => false,
        'action' => CHtml::normalizeUrl(Yii::app()->createUrl('footage/loadclips')),
    ));
    
    //echo $form->labelEx($model, 'upload_file',array('class'=>'btn_cmd'));
    echo $form->fileField($model, 'upload_file',array('class'=>'btn_cmd'));
    //echo CHtml::activeFileField($model, 'upload_file');
    echo $form->error($model, 'upload_file',array('class'=>'btn_cmd'));
    echo "<BR>";
    echo "<BR>";
    echo $form->checkBox($model,'delete_all',array('class'=>'btn_cmd'));
    echo $form->labelEx($model, 'delete_all');
    echo "<BR>";
    echo "<BR>";
    echo CHtml::submitButton('Upload',array('class'=>'btn_cmd'));
    
    echo "<div style='color: red; font-weight: bold;'>$userMsg</div>";
    $this->endWidget();

?> 


