<div class="form">
<a class="fav" onclick="openAddFavDialog(67421484)" title="" rel="" href="#">test</a>
<?php
     //print_r($jsondata);
?>   
<div style="visibility: hidden;">
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'adddialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Edit Found Box',
        'autoOpen' => false,
        'modal' => true,
        'height' => 320,
        'width' => 500,
    ),
));

$loginModel = new LoginForm();
$loginModel->verifyUser();
if (Yii::app()->user->isGuest) {

    $this->renderPartial('nouserform');
} else {
    $this->renderPartial('editboxform', array(
        'model' => $jsondata,
        'buttons' => 'create'));
}

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
</div>

    
</div>