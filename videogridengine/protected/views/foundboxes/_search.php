<style type="text/css">
.content-wrap{
	/*margin:0 10px!important;*/
    margin:0;
	position:relative;
}

</style>
<div style="">
<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); 

//echo $form->textField($model, 'title', array('maxlength' => 250));
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'title',
	'value'=>'title',
        'model'=>$model,
        'attribute'=>'title',
	'source'=>$this->createUrl('foundboxes/searchsuggestions'),
	// additional javascript options for the autocomplete plugin
	'options'=>array(
			'showAnim'=>'fold',
	),
));

//echo GxHtml::submitButton(Yii::t('app', 'Search'));
echo GxHtml::submitButton(Yii::t('app', 'Search'),array( 
       'class'=>'btnpad', 
       'maxlength'=>100))
?>

     
<?php $this->endWidget(); ?></div>