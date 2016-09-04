<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('foundbox-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php 

if(Yii::app()->user->name=="admin")
{
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'foundbox-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'id',
            'title',
            
            
            array(
                'name' => 'privacy',
                'value' => '$data->privacyParser($data)',
                'filter' => array(
                    '' => 'Any',
                    '0' => 'Private',
                    '1' => 'Public',
                ),
            ),
            //'widget_thumb_url',
            'date_created',
            
              'date_modified',
            'average_rank',
              'status',
              array(
              'name'=>'wp_users_ID',
              'value'=>'GxHtml::valueEx($data->wpUsers)',
              'filter'=>GxHtml::listDataEx(Users::model()->findAllAttributes(null, true)),
              ),
            
            array(
                'class' => 'CButtonColumn',
            ),
        ),
    ));
}
else
{
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'foundbox-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'id',
            'title',
            'description',
            'privacy',
            array(
                'name' => 'privacy',
                'value' => '$data->privacyParser($data)',
                'filter' => array(
                    '' => 'Any',
                    '0' => 'Private',
                    '1' => 'Public',
                ),
            ),
            'widget_thumb_url',
            'date_created',
            
              'date_modified',
              'status',
              
             
            array(
                'class' => 'CButtonColumn',
            ),
        ),
    ));
}


?>