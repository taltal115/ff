


<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model, 'id'); ?>
		<?php //echo $form->textField($model, 'id', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model, 'privacy'); ?>
        <?php
        echo $form->dropDownList($model, 'privacy', array(
            '' => 'Any',
            '0' => 'Private',
            '1' => 'Public',
        ));
        ?>
    </div>
    

	<div class="row">
		<?php //echo $form->label($model, 'widget_thumb_url'); ?>
		<?php //echo $form->textField($model, 'widget_thumb_url', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'date_created'); ?>
		<?php // echo $form->textField($model, 'date_created'); 
                /*
                $this->widget('zii.widgets.jui.CJuiDatePicker',
	array(
		// you must specify name or model/attribute
		'model'=>$model,
		'attribute'=>'date_created',
		//'name'=>'date_created',

		// optional: what's the initial value/date?
		//'value' => $model->projectDateStart
		'value' => $model->date_created,

		// optional: change the language
		//'language' => 'de',
		//'language' => 'fr',
		//'language' => 'es',
		//'language' => 'pt-BR',

		/* optional: change visual
		 * themeUrl: "where the themes for this widget are located?"
		 * theme: theme name. Note that there must be a folder under themeUrl with the theme name
		 * cssFile: specifies the css file name under the theme folder. You may specify a
		 *          single filename or an array of filenames
		 * try http://jqueryui.com/themeroller/
		*/
		//'themeUrl' => Yii::app()->baseUrl.'/css/jui' ,
		//'theme'=>'pool',	//try 'bee' also to see the changes
		//'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),


		//  optional: jquery Datepicker options
                /*
		'options' => array(
			// how to change the input format? see http://docs.jquery.com/UI/Datepicker/formatDate
			'dateFormat'=>'mm/dd/yy',

			// user will be able to change month and year
			'changeMonth' => 'true',
			'changeYear' => 'true',

			// shows the button panel under the calendar (buttons like "today" and "done")
			'showButtonPanel' => 'true',

			// this is useful to allow only valid chars in the input field, according to dateFormat
			'constrainInput' => 'false',

			// speed at which the datepicker appears, time in ms or "slow", "normal" or "fast"
			'duration'=>'fast',

			// animation effect, see http://docs.jquery.com/UI/Effects
			'showAnim' =>'slide',
		),


		 
	)
);
                */
                ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'date_modified'); ?>
		<?php //echo $form->textField($model, 'date_modified'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'status'); ?>
		<?php //echo $form->textField($model, 'status'); ?>
	</div>
        <?php 
        if(Yii::app()->user->name=="admin")
        {
        ?>
	<div class="row">
		<?php echo $form->label($model, 'wp_users_ID'); ?>
		<?php echo $form->dropDownList($model, 'wp_users_ID', GxHtml::listDataEx(Users::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>
        <?php } ?>    
	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>