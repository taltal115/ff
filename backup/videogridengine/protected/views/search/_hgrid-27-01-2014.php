<!-------------------------- FOR VIDEO THUMBNAILS ---------------------------------->

<!--  <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery-ui.min.js"></script>  -->
<!--<link type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/jquery-ui.css" rel="Stylesheet" />-->





        <style type="text/css">

/*                #preview{
	position:absolute;
        border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
        width: 220px;
        height: 180px;
        top:auto;
        left: auto;
        margin: auto;
        border-radius:8px;
	} */
        </style>  
  

<!--------------------------  eND FOR VIDEO THUMBNAILS ---------------------------------->




<?php
$itemToSelect = Yii::app()->params ['selected_num_item'];
 $paginationCols = explode(',', Yii::app()->params ['paginationcols']);
//Creating Video Box Model widget
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id' => 'videoBox', // additional javascript options for the dialog plugin
    'options' => array('title' => '', 'autoOpen' => false, 'modal' => false, 'height' => 240, 'width' => 320, 'resizable' => false)
        )
)
;
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>


<!-- //$servicesPanels=$jsondata['videoObjects'];-->
<!--Jquery Pagination-->

<style type="text/css">
    .loading {
        display: none;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 30%;
        left: 45%;
    }
	.content-wrap {
    margin: 0 50px;
    position: relative;
}

.p-arrow-left {
    left: -40px;
    position: absolute;
    top: 155px;
}

.p-arrow-right {
    position: absolute;
    right: 98px;
    top: 155px;
}

.content {
    margin: 40px 0;
    width: 100%;
}

#services-Container {
    border: 0 solid red;
    height: 650px;
    margin: auto;
    overflow: hidden;
    position: relative;
    width: 99%;
}

#services-panel #services-Container{height: 670px;}

</style>
<?php
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

//var_dump(Yii::app()->user);
//
//echo Yii::app()->user->isGuest;
//
//exit;
if (Yii::app()->user->isGuest) {

    $this->renderPartial('nouserform');
} else {
    $this->renderPartial('foundboxform', array(
        'model' => new FoundboxPopuForm,
        'buttons' => 'create'));
}

//$this->renderPartial('foundboxform', array(
//    'model' => new FoundboxPopuForm,
//    'buttons' => 'create'));

$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
//echo CHtml::link('open dialog', '#', array(
//'onclick'=>'$("#adddialog").dialog("open"); return false;',
//));
?>

<style type="text/css">
    #adddialog{display:none;}
    #successbox{display:none;}

</style>

<div class="p-arrow-left sliders"><img alt="Scroll Left" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png"></div>
<?php /* ?><div class="p-arrow-left sliders">
  <img alt="Scroll Left"
  mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png"
  src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png"
  mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png">
  </div><? */ ?>

<div id="services-panel">

    <div id="services-Container">
        <ul class="services-list">
<?php
// var_dump($servicesPanels);
//    exit;

foreach ($servicesPanels as $servicePanel) {

    if ($servicePanel['totalResults'] == 0)
        continue;;
    ?>

                <li class="panelData">


                    <div class="heading">
                        <div id="keyimgholder"><a class="btn x6 four-col" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-key.png"  /></a></div>

            <!--                        <a class="gridKey" href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-key.png"/>
                    </a>-->


                        <div class="wrap">

                            <!--                            <div clas="gridKey">
                                             
                            
                                                        <img alt=""
                                                                 src="<?php //echo Yii::app()->request->baseUrl;   ?>/css/fftheme/images/pond-key.png" />
                                                    </div>-->
                            <!-- <div class="hd">
                                <img alt=""
                                     src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-hd.jpg" />
                            </div>  -->
                            <div class="r1">
                                <script>
                                    $(document).ready(function() {
                                        $('.img').removeAttr('title');
                                        //$.tinysort.defaults.attr = 'title';
                                       // $.tinysort.defaults.order = 'asc';
                                        $('#sortBtn<?php echo $servicePanel['serviceType'] ?>').click(function(){
                                            var sortType=$(this).attr('title');
                                            if(sortType=='asc')
                                            {
                                                $.tinysort.defaults.order = 'asc';
                                                $('ul#<?php echo $servicePanel['serviceType'] ?>Thumb>li').tsort();
                                                $(this).attr('title','desc');
                                                    
                                                //$(".sortBtnimg").click(function () {
                                                $(this).attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/up-arrow.jpg")
                                                //})
                                            }
                                            else{
                                                $.tinysort.defaults.order = 'desc';
                                                $('ul#<?php echo $servicePanel['serviceType'] ?>Thumb>li').tsort();
                                                $(this).attr('title','asc');
                                                //$("img").click(function () {
                                                $(this).attr("src","<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/btm-arrow.jpg")
                                                //})
                                            }
                                            //↑ ↓ 
                                        });
                                            
                                            
                                             
                                    });    
                                </script>
                                <div style="border:0px solid red; margin-bottom:40px">

                                    <table width="105%" border="0" cellspacing="1" cellpadding="4">
                                        <tr>
                                            <td valign="top"> <a class="btn x6 four-col" href="javascript:void(0);"> <img
                                                        alt=""
                                                        src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn2.jpg">
                                                </a></td>

                                            <td valign="top">
                                                    <label for="hdCheck<?php echo $servicePanel['serviceType'] ?>"><B>HD</B></label>  <input id="hdCheck<?php echo $servicePanel['serviceType'] ?>" type="checkbox" title="hd" onchange="searchHD(servicPanel<?php echo $servicePanel['serviceType'] ?>,this)"/>
                                            </td>
                                            <td valign="top"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/up-arrow.jpg" style="background:none; border:none 0px; cursor:pointer" id="sortBtn<?php echo $servicePanel['serviceType'] ?>"></td>

                                            <td valign="top"><input type="button" class="btncalender" id="sortDateBtn<?php echo $servicePanel['serviceType'] ?>" onclick="searchByDate(servicPanel<?php echo $servicePanel['serviceType'] ?>,this.value)" /></td>

    <td valign="top">  <!--							<a class="btn x1" href="javascript:void(0);"><img alt="" src="<?php //echo Yii::app()->request->baseUrl;          ?>/css/fftheme/images/pond-btn1.jpg"></a>-->

                                                <select class="dd"
                                                        onchange="item_combo(servicPanel<?php echo $servicePanel['serviceType'] ?>,this.value)">
    <?php
    foreach ($paginationCols as $item) {
        ?>
                                                        <option
                                                            value="<?php echo $item; ?>" <?php if ($item == $itemToSelect) echo "selected='selected'"; ?> >
                                                                <?php echo $item ?>
                                                        </option>
                                                            <?php } ?>


                                                </select> 
                                            </td>

                                            <td valign="top"><a class="btn x3 hide-restore" href="javascript:void(0);"><img
                                                        alt=""
                                                        style="display:none" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn3.jpg" ></a>
                                            </td>                    
                                        </tr>
                                    </table>

                                </div>                                









                            </div>
                            <div class="r2">
                                <span><img alt=""
                                           src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-flower_2.jpg" style="display:none">
                                    <div class="panel-title">
    <?php echo $servicePanel['serviceType'];
    echo '  ' . $servicePanel['totalResults'];
    ?>
                                    </div></span>
                            </div>
                            <div class="r3">
                                <script type="text/javascript">
                                    function SwapImage(ImageUrl,Control)
                                    {
                                        Control.src = ImageUrl;
                  
                                    }
                   
                                </script>
                                <a class="btn x4 one-col" href="javascript:void(0);"><img alt=""
                                                                                          src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn4.jpg" onmouseout  ="SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn4.jpg',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn4-hv.jpg',this);"></a>
                                <a class="btn x5 two-col" href="javascript:void(0);"><img alt=""
                                                                                          src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn5.jpg" onmouseout  ="SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn5.jpg',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn5-hv.jpg',this);"></a>
                                <a class="btn x6 three-col" href="javascript:void(0);"><img
                                        alt=""
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn6.jpg" onmouseout  ="SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn6.jpg',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn6-hv.jpg',this);"></a>
                            </div>
                        </div>
                    </div>
                    <div class="video-list">
                        <div class="video-container">

                            <!--- my changes start ---->

                            <div id="<?php echo $servicePanel['serviceType'] ?>btn"
                                 class="leftArrow">
                                <img alt=""
                                     src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/video_left.png"
                                     onclick="submitAjaxRequest(servicPanel<?php echo $servicePanel['serviceType'] ?>,'<?php echo $servicePanel['serviceType']; ?>','prevous')" onmouseout  ="SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/video_left.png',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/video_left_hv.png',this);" style="cursor:pointer"  />
                            </div>

                            <!-- my changes close ---->

                            <!--- my changes start ---->

                            <div id="<?php echo $servicePanel['serviceType'] ?>btn"
                                 class="rightArrow">
                                <img alt=""
                                     src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/video_right.png"
                                     onclick="submitAjaxRequest(servicPanel<?php echo $servicePanel['serviceType'] ?>,'<?php echo $servicePanel['serviceType']; ?>','next')" onmouseout  ="SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/video_right.png',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/video_right_hv.png',this);" style="cursor:pointer" />
                            </div>

                            <!-- my changes close ---->

                            <div class="scrollbar">
                                <div class="track" style="height:495px;">

                                    <div class="thumb">
                                        <div class="end"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="videos viewport">
                                <div id="<?php echo $servicePanel['serviceType'] ?>loader"
                                     class="loading">
                                    <p>
                                        <img
                                            src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/loader.gif" />

                                    </p>
                                </div>

                                <ul id="<?php echo $servicePanel['serviceType'] ?>Thumb"
                                    class="videos-containers overview">

    <?php
// Generating Video Thumbs//first time result
    foreach ($servicePanel ['videoObjects'] as $videoObject) {
    
        ?>

                                        <li class="video" 
                                            id="<?php echo $videoObject['videoServiceId']; ?>" title="<?php //echo $videoObject['videoName']; ?>">
                                            <script>
                                                $('#<?php echo $videoObject['videoServiceId']; ?>').data('videoData',<?php echo CJSON::encode($videoObject) ?>);

                                            </script>

                                             <div class="img"  id="<?php echo $videoObject['videoFlvURL']; ?>"> 
                                           <!--  <div   id="<?php echo $videoObject['videoFlvURL']; ?>">  -->
                                                 <a id="<?php echo $videoObject['id']?>" href="<?php echo $videoObject['videoDollor']?>" target="_blank">
                                            <img 
                                                  class="<?php echo $videoObject['videoServiceId']; ?>"
                                                    src="<?php echo $videoObject['thumbURL']; ?>" title="<?php //echo $videoObject['videoName']; ?>"   />
                                            </a>


                                            <!--    <img 
                                                    onclick='openVideoDialog("<?php echo $videoObject['videoFlvURL']; ?>","","<?php echo Yii::app()->request->baseUrl . '/css/fftheme/player/flowplayer-3.2.7.swf'; ?>"); return false;'
                                                    class="<?php echo $videoObject['videoServiceId']; ?>"
                                                    src="<?php echo $videoObject['thumbURL']; ?>" title="<?php echo $videoObject['videoName']; ?>"   /> -->
                                            </div> <!--                                            //Right Arrow ()next page
                                                            //left arrow back page
                                                            //dropdown change -->
                                            <div class="options">

                                                <table border="0" cellspacing="1" cellpadding="5">
                                                    <tr>
                                                        <td><a class="fav" onclick='openAddFavDialog("<?php echo $videoObject['videoServiceId']; ?>")' title="" rel="" href="#"></a> 
                                                            <!--                                                        <span  id="<?php echo $videoObject['videoServiceId']; ?>_share" class="share" href="#"></span> -->

                                                        </td>
                                                        <td><span  id="<?php echo $videoObject['videoServiceId']; ?>_share" class="st_sharethis_custom"
                                                                   st_url="<?php echo $videoObject['videoDollor']; ?>"  st_title="<?php echo $videoObject['videoName']; ?>" st_image="<?php echo $videoObject['thumbURL']; ?>" st_summary="Sharing is great! Its fun to share Videos from www.findingfootage.com"

                                                                   ></span></td>
                                                        <td>  <a class="dollar" target="_blank" href="<?php echo $videoObject['videoDollor']; ?>"></a> 
                                                       
                                                        </td>
                                                        <td>
                                                            <a
                                                                class="info" 
                                                                onclick='openVideoDetailDialog("<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('videodetail/videodetail')); ?>", 
                                                                    "<?php echo $videoObject['videoServiceId']; ?>");'
                                                                target="_blank">
                                                            </a>
                                                        </td>
                                                        <td>                                              </td>
                                                        <td style="padding-left:2px"><input
                                                                class="thumb_checkBox"
                                                                id="<?php echo $videoObject['videoServiceId']; ?>_checkbox"
                                                                type="checkbox" />
                                                        </td>
                                                    </tr>
                                                </table>


        <?php //print_r($videoObject)  ?>
                                            </div>
                                        </li>

                                            <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div> <script type="text/javascript">
                        //Creating Object for Pagination
                        servicPanel<?php echo $servicePanel['serviceType'] ?>=
                            {

                            //sortOrder : undefined,
                            hdSearch:0,
                            dateSortOrder : 0,
                            searchText : '<?php echo $servicePanel['searchText'] ?>',
                            searchType : '<?php echo $servicePanel['serviceType'] ?>',

                            //pagination parameters
                            items_per_page : <?php echo Yii::app()->params['selected_num_item']; ?>,
                                                
                            current_page : <?php
                                            $currentPage = Yii::app()->request->getQuery('page');
                                            if ($currentPage == "")
                                                $currentPage = 1;
                                            echo $currentPage;
                                            ?>
              


            //  XDEBUG_SESSION_START : 'netbeans-xdebug'

        };
                                                
                                              

                    </script>
                </li>
    <?php
} // Creating service panel Ends
?>

<!--            <script type="text/javascript">
                    
                    
              
            </script>-->
                
            <script id="videoTemplate" type="text/x-jquery-tmpl">
                
                <li class="video" id="${videoServiceId}">
                    

<!--                    <div class="img">-->
                    <div class="img"  id="${videoFlvURL}" title=""> 
<!--                        <img onclick='openVideoDialog("${videoFlvURL}"," ","<?php echo Yii::app()->request->baseUrl . "/css/fftheme/player/flowplayer-3.2.7.swf"; ?>"); return false;' class="${videoServiceId}" src="${thumbURL}" />-->
                        <a id="${id}?>" href="${videoDollor}" target="_blank">
                        <img  src="${thumbURL}"  class="${videoServiceId}"  title=""   />
</a>

                    </div>

                    <div class="options">
                        <table border="0" cellspacing="1" cellpadding="5">
                            <tr>
                                <td>
                                    <a class="fav" 
                                       onclick='openAddFavDialog("${videoServiceId}")'
                                       title="" 
                                       rel="" 
                                       href="#"/>


<!--  <span  id="<?php echo $videoObject['videoServiceId']; ?>_share" class="share" href="#"></span> -->


                                </td>
                                <td>
                                    <span  
                                        id="${videoServiceId}_share" 
                                        class="st_sharethis_custom" 
                                        st_url=${videoDollor}"
                                        st_title=${videoName}"
                                        st_image=${thumbURL}"
                                        st_summary="Sharing is great! Its fun to share Videos from www.findingfootage.com">
                                    </span>
                                </td>
                                <td> 
                                    <a class="dollar" target="_blank" 
                                       href="${videoDollor}"
                                       ></a> 
                                </td>
                                <td>
                                    <a target='_blank'
                                       class="info" 
                                       onclick='openVideoDetailDialog("<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('videodetail/videodetail')); ?>","${videoServiceId}");'
                                       >
                                    </a>
                                </td>
                                <td>                                              </td>
                                <td style="padding-left:2px"><input
                                        class="thumb_checkBox"
                                        id="${videoServiceId}_checkbox"
                                        type="checkbox" />
                                </td>
                            </tr>
                        </table>

                    </div>
                </li>


                </script>

<?php ?>
            </ul>

            <div class="clear"></div>
        </div>
    </div>
    <div class="p-arrow-right sliders"><img alt="Scroll Right" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"></div>

    <div class="p-arrow-right sliders" style="display:none"><img alt="Scroll Right" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"></div>
<?php /* ?><div class="p-arrow-right sliders">
  <img alt="Scroll Right"
  src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"
  mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"
  mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png">
  </div><? */ ?>
