<div class="view">


	<?php echo 'sajid'.GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('servicename')); ?>:
	<?php echo GxHtml::encode($data->servicename); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sortorder')); ?>:
	<?php echo GxHtml::encode($data->sortorder); ?>
	<br />

</div>