

<?php

$itemToSelect = Yii::app()->params ['selected_num_item'];

$paginationCols = explode(',', Yii::app()->params ['paginationcols']);
$haveResults = false;

if (isset($dataProvider)) {
    $haveResults = true;
    $videoThumbs = $dataProvider;//$jsondata ['videoObjects'];
} else {
    $this->renderPartial('_noresults');
    Yii::app()->end();
}
?>
<div style="visibility: hidden; display: none;"> 
<?php
// -- add dialog -- //
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'adddialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Add Videos to Found Box',
        'autoOpen' => false,
        'modal' => true,
        'height' => 320,
        'width' => 500,
    ),
));

$loginModel = new LoginForm();
$loginModel->verifyUser();
if (Yii::app()->user->isGuest) {

    $this->renderPartial('../footage/nouserform');
} else {
    $this->renderPartial('../footage/addboxform', array(    // ../search/foundboxform
        'model' => new FoundboxPopuForm,
        'buttons' => 'create'));
}

$this->endWidget('zii.widgets.jui.CJuiDialog');

// -- edit dialog -- //
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'editdialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Edit Found Box',
        'autoOpen' => false,
        'modal' => true,
        'height' => 250,
        'width' => 400,
    ),
));

if (Yii::app()->user->isGuest) {

    $this->renderPartial('../footage/nouserform');
} else {
    $this->renderPartial('../footage/editboxform', array(
        'model' => $jsondata,
        'buttons' => 'create'));
}

$this->endWidget('zii.widgets.jui.CJuiDialog');


// -- Remove Selected Clips dialog -- //
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'removeclipsdialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Remove Selected Clips',
        'autoOpen' => false,
        'modal' => true,
        'height' => 100,
        'width' => 250,
    ),
));

if (Yii::app()->user->isGuest) {

    $this->renderPartial('../footage/nouserform');
} else {
    $this->renderPartial('../footage/removeclipsform', array(
        'model' => $jsondata,
        'buttons' => 'create'));
}

$this->endWidget('zii.widgets.jui.CJuiDialog');

// -- Remove Found Box dialog -- //
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'removefoundboxdialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Delete FoundBox',
        'autoOpen' => false,
        'modal' => true,
        'height' => 100,
        'width' => 250,
    ),
));

if (Yii::app()->user->isGuest) {

    $this->renderPartial('../footage/nouserform');
} else {
    $this->renderPartial('../footage/removeboxform', array(
        'model' => $jsondata,
        'buttons' => 'create'));
}

$this->endWidget('zii.widgets.jui.CJuiDialog');
?> 
</div> 
<?php
$this->renderPartial("_mix", array("dataProvider" => $dataProvider, "title"=>$title, "is_owner"=>$is_owner, 'fbUserID'=>$fbUserID));
?>
<script type="text/javascript">
    function StartSearch(text)
    {
        redirectURL = "<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('search?SearchBarForm%5BsearchKeywords%5D="+text+"&direction=h')); ?>";
        window.location.href = redirectURL;
    }  
</script>


