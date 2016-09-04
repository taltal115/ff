

 
<style type="text/css">

    .pager{
        display: none;
    }
.box_search {
    float: left;
    padding: 28px 10px; 
    color: white; 
    cursor: pointer;
}
.box_menu {
    float: left;
    padding: 35px 10px; 
    color: white; 
    cursor: pointer;
}
</style>
<div style="visibility: hidden; display: none;"> 
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id' => 'hoverplay', // additional javascript options for the dialog plugin
    'options' => array('title' => '', 'autoOpen' => false, 'modal' => false, 'height' => 240, 'width' => 320, 'resizable' => false)
        )
)
;
$this->endWidget('zii.widgets.jui.CJuiDialog');

?>

<?php
$this->breadcrumbs = array(
    Foundbox::label(2),
    Yii::t('app', 'Index'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'Create') . ' ' . Foundbox::label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'Manage') . ' ' . Foundbox::label(2), 'url' => array('admin')),
);
?>
</div>
<div id="services-panel">
    <div id="mydiv">  </div>
    <div id="ver-services-Container">
        <ul class="ver-services-list">
            <li class="service">
                <div class="heading">
                    <div class="wrap">   
                        <div class="box_search" ><div class="innersearch"><?php
                        $this->renderPartial('_search', array(
                            'model' => $model,
                        ));
                        ?></div></div>
                        
                        <? if(!Yii::app()->user->isGuest){ ?>              
                        <dir class="box_menu" onclick="gotoMayFoundBoxes(false)">My FoundBoxes</dir>
                        <dir class="box_menu" onclick="gotoAllFoundBoxes(false)">All FoundBoxes</dir>
                        <? } ?>
                        <h1 style="float: right;padding: 25px 10px; color: white;">Public Found Boxes </h1>    
                    </div>
                </div>
                <div class="video-list">
                    <div class="video-container">
                        <div class="videos">
                           
                           <?php 
                            $page=$_GET['Foundbox_page'];
                            if(isset ($page)){
                                $page--;
                                if($page < 1) $page = 1;
                                $page_url = "/videogridengine/index.php/foundboxes/index?Foundbox_page=$page";
                                if(isset($_GET['Myboxs']))
                                    $page_url .= "&Myboxs";    
                            ?>

                            <a href="<?=$page_url?>">
                            <?php }else{?>
                            <a href="#">
                            <?php } ?> 
                               <div class="p-arrow-leftfb sliderss"><img alt="Scroll Left" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png"></div>
                            </a>

                           <?php
                            $show_myboxs = isset($_GET['Myboxs'])?true:false;
                            $dataProvider2 = $model->searchFoundBoxesByTitle($show_myboxs);
                            
//$dataProvider2->sort->defaultOrder= array('average_rank' => false,'date_created' => false);

                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $dataProvider2,
                                'ajaxUpdate' => false,
                                'template' => '{pager}{summary}{items}',  // {pager}{sorter}{summary}{items}
                                'itemView' => '_view',
                                'itemsTagName' => 'ul',
                                'itemsCssClass' => 'ver-services-container overview',
                                'pager' => array(
                                    'header' => false,
                                    'maxButtonCount' => '9',
                                    'cssFile' => Yii::app()->request->baseUrl . '/css/fftheme/userPager.css',
                                ),
                                'sortableAttributes' => array(
                                    'title',
                                    'status',
                                    'date_created',
                                    'average_rank',
                                ),
                            ));
                            ?> 
                            
                             
                            <?php
                            if(isset ($page)){
                                $page++;
                                $page_url = "/videogridengine/index.php/foundboxes/index?Foundbox_page=$page";
                                if(isset($_GET['Myboxs']))
                                    $page_url .= "&Myboxs";    
                            ?>
                                <a href="<?=$page_url?>">
                            <?php 
                            }else{?>
                                <a href="<?php
                                echo($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http". "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>/index?Foundbox_page=2">
                                <?php
                                
                                }
                                ?>
                             <div class="p-arrow-rightfb sliders"><img alt="Scroll Right" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"></div>
                             
                            </a>
                           
                        </div>
                    </div>
                </div>

                <?php ?>
            </li>
        </ul>

        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    // starting the script on page load
    $(document).ready(function(){
        imagePreview();
    }); 
    
    function StartSearch(text)
    {
        redirectURL = "<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('search?SearchBarForm%5BsearchKeywords%5D="+text+"&direction=h')); ?>";
        window.location.href = redirectURL;
    }  
</script>