<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	ucwords(GxHtml::valueEx($model)),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo  ucwords(GxHtml::encode(GxHtml::valueEx($model))); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'date_created',
'title',
'description',
'vid_src_url',
           
'vid_flv_path',
'vid_src_id',
'vid_thumb_url',
array(
			'name' => 'wpFoundbox',
			'type' => 'raw',
			'value' => $model->wpFoundbox !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->wpFoundbox)), array('foundbox/view', 'id' => GxActiveRecord::extractPkValue($model->wpFoundbox, true))) : null,
			),
array(
			'name' => 'wpService',
			'type' => 'raw',
			'value' => $model->wpService !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->wpService)), array('service/view', 'id' => GxActiveRecord::extractPkValue($model->wpService, true))) : null,
			),
	),
)); ?>

