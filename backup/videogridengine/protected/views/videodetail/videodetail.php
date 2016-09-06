

<link rel="stylesheet" type="text/css" href="/videogridengine/css/fftheme/search.css" />

<style type="text/css">
    .content-wrap{
        margin: 0px 0px 0px;
    }
    .vddcontainer {
        width: 100%;  
    }
    .vdlftpanel{
        width: 60%;
        margin: 0;
        float: left;
    }
    .vdcenpanel{
        width: 40%; 
        margin: 10px 0 0 0;
        float: left;
        /*text-align: center; */
    }
    .detail-video-cont{
        position: relative;
        width:90%;
        height: 0;
        padding-bottom: 50.58%;
        max-width:100%;
    }
    .detail-video{
        position: absolute;
        display:block;
        width:100%;
        height: 100%;
        /*width:90%;height:50.58%;*/
        
    }

    #search_boxs{
        float: left; 
        margin-left: 25px;
    }
   #Allcontainer{height: 350px;}
</style>
<div style="display: none;">
<?php
$this->breadcrumbs=array(
	'Videodetail'=>array('/videodetail'),
	'Videodetail',
);


$queryString=Yii::app()->request->getQueryString();
//echo ($queryString);
//$queryString=Yii::app()->request->getQuery("videoDollor");

$videoID=Yii::app()->request->getQuery("videoId");
$videoServiceId=Yii::app()->request->getQuery("videoServiceId");
$videoDollor=Yii::app()->request->getQuery("videoDollor");
$videoName=Yii::app()->request->getQuery("videoName");
$videoFlvURL=Yii::app()->request->getQuery("videoFlvURL");
$thumbURL=Yii::app()->request->getQuery("thumbURL");
$cookieUrl=Yii::app()->request->getQuery("cookie_url"); 
$videoHeight=Yii::app()->request->getQuery("videoHeight");
$videoWidth=Yii::app()->request->getQuery("videoWidth");    
       
  
?>

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
if (Yii::app()->user->isGuest) {

    $this->renderPartial('../search/nouserform');
} else {
    $this->renderPartial('../search/foundboxform', array(
        'model' => new FoundboxPopuForm,
        'buttons' => 'create'));
}

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
</div>
<!--<div style="margin: 0 auto; width:100%; height:400px; overflow: auto;"><object type="text/html" data="<?php //echo $queryString; ?>" style="width:100%; height:400px; margin:1%;"></object></div>
<h1><?php //echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php //echo __FILE__; ?></tt>.
</p>-->
<div class="detail" >
    <div class="vddcontainer">
        <div class="vdlftpanel">
            <?
                 $searchKeywords = explode(" ",$videoName);
                 $searchText = "";
                 $countWords = 0;
                 foreach($searchKeywords as $val){
                     if($searchText != "") $searchText .= "+";
                     $searchText .= $val;
                     $countWords++;
                     if($countWords >= 3) break;
                 }
                 //print_r($searchText);
             ?>
            <!-- iframe src="http://www.findingfootage.com/videogridengine/index.php/footage?searchKeywords=<?= $searchText;?>&items=10" frameborder="0" scrolling="no" style="align:left; width: 100%; height: 420px; overflow: hidden;"></iframe -->
            
            <div class="video-list">
                <div id="Allcontainer" class="video-container">
                    <!-- div id="Allscroll" class="scrollbar" >
                        <div class="track">

                            <div class="thumb">
                                <div class="end"></div>  
                            </div>

                        </div>
                    </div -->

                    <div class="videos viewport">
                        <div id="Allloader" class="loading" style="text-align: center;margin-top: 20%;">
                            <p>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/loader.gif" />
                            </p>
                        </div>
                        <ul id="AllThumb" class="videos-containers overview">
                         

                        </ul>
                    </div>
                    
                    
                </div>
            </div>
            <div id="search_boxs">
                    
            </div>
        </div>
            
        <div class="vdcenpanel" style="text-align: center">
            <div class="detail-first-line">
                <div class="detail-image" >
                    <div id="<?php echo $videoID;?>" ><!--height="<?php //echo $videoHeight;?>" width="<?php //echo $videoWidth;?>"-->
                        <div id="playerCont" class="detail-video-cont">
                            
                        </div>
                        <script language="JavaScript">    
                        $(document).ready(function(){
                            var videoURL = "<?php echo urldecode($videoFlvURL); ?>";
                            var iFrameSrc = getIFramSrc(videoURL);
                            if(iFrameSrc != null && iFrameSrc.length > 0){
                                var html = "<iframe class='detail-video' width='100%' height='100%' src='"+iFrameSrc+"' frameborder='0'  allowfullscreen></iframe>"; 
                                $("#playerCont").append(html);
                            }else if(playDetailWithFlowplayer(videoURL)){
                                $("#playerCont").append("<a href='<?php echo $videoFlvURL; ?>' class='detail-video' id='vplayer'></a>");
                                flowplayer("vplayer", playerVar);
                            }else {
                                $("#playerCont").append("<video class='detail-video' controls autoplay='autoplay' width='100%' height='100%' name='media'><source src='"+videoURL+"' type='video/mp4'>test</video>"); 
                            }
                        });
                        </script>  
                        
                        </br>
                        <h3 class="detail-title">
	                        <?php echo $videoName;?> <a href="<?php echo $videoDollor;?>" class="subtitle-link">Full Details</a>
                        </h3>
                        <div class="detail-cmds">
            <!--                        </br>-->           <a class="addtofav" onclick="openAddFavDialog(<?=$videoID ?>)" title="Add To Box" rel="" href="#"><img src="<?=Yii::app()->request->baseUrl; ?>/css/fftheme/images/star-128.png" alt=""></a>
                            <a class="gotodollar" href="<?php echo $videoDollor; ?>"><img src="<?=Yii::app()->request->baseUrl; ?>/css/fftheme/images/download-btn.png" alt="DOWNLOAD/BUY CLIP"  /></a>
                        </div>
                        </br></br>
                        <span class='st_facebook_large' displayText='Facebook'></span>
                        <span class='st_twitter_large' displayText='Tweet'></span>
                        <span class='st_pinterest_large' displayText='Pinterest'></span>
                        <span class='st_linkedin_large' displayText='LinkedIn'></span>
                        <span class='st_stumbleupon_large' displayText='StumbleUpon'></span>
                        <span class='st_email_large' displayText='Email'></span>
                        <span class='st_sharethis_large' displayText='ShareThis'></span>
                        <script language="javascript" type="text/javascript">
	                        stWidget.addEntry({
		                        title:'<?php echo $videoName; ?>',
		                        summary:'<?php echo $videoName; ?>',
		                        icon: '<?php echo $videoFlvURL; ?>',
                                url:'<?php echo $videoFlvURL; ?>'
	                        }, {button:true} );
                        </script>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('#<?=$videoID?>').data('videoData',{"__className":"FF_DTO_VideoObjectDTO","videoId":"<?=$videoID?>","date_created":"","videoName":"<?=$videoName?>","description":"","videoDollor":"<?=$videoDollor?>","videoFlvURL":"<?=$videoFlvURL?>","videoServiceId":"<?=$videoServiceId?>","thumbURL":"<?=$thumbURL?>","cookie_url":"<?=$cookieUrl?>","wp_service_id":"null"} );
                         }); 
                    </script>
                </div>
           </div>
           <div style="margin-bottom: 20px;">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- FF item page -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-6180570132265761"
                     data-ad-slot="4313365766"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script> 
           </div>
        </div>
    </div>
</div>


                
<script id="videoTemplate" type="text/x-jquery-tmpl"> 
    <li class="video" id="${videoServiceId}">
        <div class="img"  id="${videoFlvURL}" title=""> 
            <a target='_blank' onclick='openVideoDetailDialog("<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('videodetail/videodetail')); ?>","${videoServiceId}", false);'>
                <img  src="${thumbURL}" onmouseover="imagePreview()" class="${videoServiceId}"  title=""   />
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
                    <td>                                              
                    </td>
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

<script type="text/javascript">
    //Creating Object for Pagination
    servicPanelAll =
    {
        //sortOrder : undefined,
        searchText : '',
        searchType : 'All',
        items_per_page : '5',
        current_page : '1'
    }
        
     $(document).ready(function() {
        // Handler for .ready() called.
        var text = '<?= $searchText ?>'; 
        
        if(getBoxsHtml)    
            getBoxsHtml(urlBoxs + "?text="+text,idBoxs); 
        
        if(StartSearchComon)
            StartSearchComon(text); 
        /*
        setTimeout(function(){ 
            StartSearch(text);  
        }, 3000);
        */ 
    });
    function StartSearchComon(text)
    {
        if(typeof servicPanelAll !== 'undefined') {
            servicPanelAll.searchText = text;
            submitAjaxRequest(servicPanelAll,servicPanelAll.searchType,'');
        } 
    }  
    function StartSearch(text)
    {
        redirectURL = "<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('search?SearchBarForm%5BsearchKeywords%5D="+text+"&direction=h')); ?>";
        window.location.href = redirectURL;
    }  
    
    
    var urlBoxs = "/videogridengine/index.php/footage/BoxsHtml";
    var idBoxs = "search_boxs";
    var m_BoxsTotal = 0;
    var m_BoxsIndex = 0;
    
    function getBoxsHtml(url,id) {
        var html = getData(url);
        setBoxHtml(id,html);
    }
    function setBoxHtml(id,html) {
        if(html != "") {
            $( "#"+id ).empty();
            $( "#"+id ).append( html);
        }
    }
    
    function getData(url) {   
        var data = "";
        
        $.ajax({
            type: "GET",
            async: false,
            url: url,
            data: ""
        })
        .done(function( html ) {
            data = html;  
        })
        .fail(function( jqXHR, textStatus ,errorThrown) {
            alert( "Request failed: " + errorThrown );
        });
        
        return data;
    }
    
    function loadData(url, id) { 
        var origHtml = $( "#"+id ).html();
        
        $( "#"+id ).empty();
        $( "#"+id ).append( $( "#loading" ).html());
        
        $.ajax({
            type: "GET",
            async: true,
            url: url,
            data: ""
        })
        .done(function( html ) {
            if(html != "") 
                setBoxHtml(id,html);
            else 
                setBoxHtml(id,origHtml);
        })
        .fail(function( jqXHR, textStatus ,errorThrown) {
            alert( "Request failed: " + errorThrown );
            setBoxHtml(id,origHtml);
        });
        
        
    }
</script>

<?
    if(trim($cookieUrl) != ""){
        echo "<iframe src='$cookieUrl' style='display: none;' height='0' ></iframe>";
        //print_r($cookieUrl);
    }
?>