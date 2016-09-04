<?php
$foundBoxes = $dataProvider->getData(); // array of foundbox objects

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Foundbox::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Foundbox::label(2), 'url' => array('admin')),
);

?>
<?php

?>

<div id="services-panel">
    
    <div id="ver-services-Container">
 
        <ul class="ver-services-list">
            
            <li class="service">
                <div class="heading">
                    
                    <div class="wrap">
                        <div class="hd">
                            <img alt=""
                                 src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-hd.jpg" />
                        </div>
                        <div class="r1">
                            <a style="display: none;"class="btn x3 hide-restore" href="javascript:void(0);"><img
                                    alt=""
                                    src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn3.jpg"></a>
                        </div>
                        <div class="r2">
                            <span><img alt=""
                                       src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-flower_2.jpg">
                                <div class="panel-title">
                                    <h1 style="padding-left: 10px;">FoundBoxes</h1>
                                </div></span>
                        </div>
                        <div class="r3" >
                        </div>
                    </div>
                </div>
                <div class="video-list">
                    <div class="video-container">
                        <div class="videos viewport">
                        
                  <div class="foundboxesuser">      
                                               <?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>false,
    'template'=>'{pager}{sorter}{summary}{items}',
    'itemView'=>'_view',
    'itemsTagName'=>'ul',
    'itemsCssClass'=>'ahmed',
    'pager'=>array(
        'header'=>false,
        'maxButtonCount'=>'9',
        'cssFile'=>Yii::app()->request->baseUrl.'/css/fftheme/userPager.css',
    ),
    'sortableAttributes'=>array(
        'title',
        'status',
        'date_created',
        'average_rank',
        
    ),
));
?>
                          </div>
                          
                        </div>
                    </div>
                </div>
                 
            </li>
        </ul>
        <div class="clear"></div>
    </div>
</div>