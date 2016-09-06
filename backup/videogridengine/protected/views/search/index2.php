<?php
//Add JS at run time in header
Yii::app ()->clientScript->registerScriptFile ( Yii::app ()->request->baseUrl . '/css/fftheme/js/flowplayer-3.2.6.min.js', CClientScript::POS_HEAD );

// Get View Variables
$itemToSelect = Yii::app ()->params ['selected_num_item'];
$paginationCols = explode ( ',', Yii::app ()->params ['paginationcols'] );
$haveResults = false;
if (isset ( $jsondata )) {
	$haveResults = true;
	$servicesPanels = $jsondata ['videoObjects'];
} else {
	// leave this fo rnow
}	 

//Creating Video Box Model widget
$this->beginWidget ( 'zii.widgets.jui.CJuiDialog', 
		array ('id' => 'videoBox',// additional javascript options for the dialog plugin
			  'options' => array ('title' => 'Dialog box 1', 'autoOpen' => false, 'modal' => true ) 
				) 
		)
;
$this->endWidget ( 'zii.widgets.jui.CJuiDialog' );


?>
<!-- //$servicesPanels=$jsondata['videoObjects'];-->
<!--Jquery Pagination-->


<style type="text/css">
.loading {
	display: none;
	width: 100%;
	height: 100%;
}
</style>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
 'id'=>'adddialog',
 // additional javascript options for the dialog plugin
 'options'=>array(
  'title'=>'Dialog box 1',
  'autoOpen'=>false,
  'modal'=>true,  
 ),
));


$this->renderPartial('foundboxform', array(
		'model' => $model,
		'buttons' => 'create'));


$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
echo CHtml::link('open dialog', '#', array(
 'onclick'=>'$("#adddialog").dialog("open"); return false;',
));
?>



<div class="p-arrow-left sliders">
	<img alt="Scroll Left"
		mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png"
		src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png"
		mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png">
</div>

<div id="services-panel">
  
   
    <div id="mydiv">  </div>
    
      
    
	<div id="services-Container">
		<ul class="services-list">
			<?php
                           if($haveResults)
                             {
				foreach ( $servicesPanels as $servicePanel ) 
				{
					?>

				<li>
				<div id="<?php echo $servicePanel['serviceType'] ?>loader"
					class="loading">
					<p>
						<img
							src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/loader.gif" />
						Please Wait
					</p>
				</div>

				<div class="heading">
					<div class="wrap">
						<div class="hd">
							<img alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-hd.jpg" />
						</div>
						<div class="r1">

<!--							<a class="btn x1" href="javascript:void(0);"><img alt="" src="<?php //echo Yii::app()->request->baseUrl;     ?>/css/fftheme/images/pond-btn1.jpg"></a>-->

							<a class="btn x2 one-toggle-three" href="javascript:void(0);"> <img
								alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn2.jpg">
							</a> <select class="dd"
								onchange="item_combo(servicPanel<?php echo $servicePanel['serviceType'] ?>,this.value)">
								<?php
				foreach ( $paginationCols as $item ) {
					?>
									<option
									value="<?php echo $item;?>" <?php if ($item == $itemToSelect) echo "selected='selected'";  ?> >
									<?php echo $item?>
									</option>
									<?php } ?>
									
									
				</select> <a class="btn x3 hide-restore" href="javascript:void(0);"><img
								alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn3.jpg"></a>
						</div>
						<div class="r2">
							<span><img alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-flower_2.jpg">
								<div class="panel-title">
						<?php echo $servicePanel['serviceType']?>
					</div></span>
						</div>
						<div class="r3">
							<a class="btn x4 one-col" href="javascript:void(0);"><img alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn4.jpg"></a>
							<a class="btn x5 two-col" href="javascript:void(0);"><img alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn5.jpg"></a>
							<a class="btn x6 three-col" href="javascript:void(0);"><img
								alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn6.jpg"></a>
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
								onclick="submitAjaxRequest(servicPanel<?php echo $servicePanel['serviceType'] ?>,'<?php echo $servicePanel['serviceType']; ?>','prevous')" />
						</div>

						<!-- my changes close ---->

						<!--- my changes start ---->

						<div id="<?php echo $servicePanel['serviceType'] ?>btn"
							class="rightArrow">
							<img alt=""
								src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/video_right.png"
								onclick="submitAjaxRequest(servicPanel<?php echo $servicePanel['serviceType'] ?>,'<?php echo $servicePanel['serviceType']; ?>','next')" />
						</div>

						<!-- my changes close ---->

						<div class="scrollbar">
							<div class="track">

								<div class="thumb">
									<div class="end"></div>
								</div>

							</div>
						</div>

						<div class="videos viewport">

							<ul id="<?php echo $servicePanel['serviceType'] ?>Thumb"
								class="videos-containers overview">
				
					<?php 
// Generating Video Thumbs
				foreach ( $servicePanel ['videoObjects'] as $videoObject ) {
					?>
							
								<li class="video"
									id="<?php echo $videoObject['videoServiceId']; ?>">
                                                                    <script>
                                                                        $('#<?php echo $videoObject['videoServiceId']; ?>').data('videoData',<?php echo CJSON::encode($videoObject)?>);

                                                                    </script>
									<div class="img">


										<img
											onclick='openVideoDialog("<?php echo $videoObject['videoFlvURL']; ?>",""); return false;'
											class="<?php echo $videoObject['videoServiceId']; ?>"
											src="<?php echo $videoObject['thumbURL']; ?>" />
									</div> <!--                                            //Right Arrow ()next page
                                                                                        //left arrow back page
                                                                                        //dropdown change -->
									<div class="options">
										<a class="fav" title="" rel="" href="#"></a> <a class="share"
											href="#"></a> <a class="dollar" target="_blank"
											href="<?php echo $videoObject['videoDollor']; ?>"></a> <a
											class="info" target="_blank"
											href="<?php echo $videoObject['videoDollor']; ?>"></a> <input
											class="checkBox"
											id="<?php echo $videoObject['videoServiceId']; ?>_checkbox"
											type="checkbox" />
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
                            searchText : '<?php echo $servicePanel['searchText'] ?>',
                            searchType : '<?php echo $servicePanel['serviceType'] ?>',

                            //pagination parameters
                            items_per_page : 10,
                            num_display_entries : 11,
                            current_page : 1,

                            XDEBUG_SESSION_START : 'netbeans-xdebug'

                        };
                            
                          

                    </script>
			</li>
<?php
			} // Creating service panel Ends
			?>
                        
<script type="text/javascript">
                    
                    
                function item_combo(data,value){
                    // data.current_page+=1;
                    data.num_display_entries = value;
                    callAllVideoServices(data);
                }
                    
                    
                function submitAjaxRequest(data,serviceType,action){
                        
                    //var data = this.data;
                     
                    //                        showLoading();
                    //                        $.post("data.php", {var:"foo"}, function(results){
                    //                            $("content").append(results);
                    //                            hideLoading();
                    //                        });        
                       
                     
                  
                    switch(action){
                        case 'next':
                            data.current_page+=1;
                            break;
                        case 'prevous':
                            data.current_page-=1;
                            break;
                        case 'colchange':
                                
                            data.num_display_entries+= $(coleelment).selectvalue;
                                
                            break;
                        default:
                            ;
                    }
                    callAllVideoServices(data);
                }
                function callAllVideoServices(parameters) {
                    $("#"+parameters.searchType+"loader").show();
                    //alert("#"+parameters.searchType+"loader");
                    $("#"+parameters.searchType+"Thumb").fadeOut(1000);
                    //console.log(parameters);
                    //call Ajax Requests to call Results
                        
                    try{
                        $.getJSON(
                        "http://localhost/findingfootageproject1/ffservices/public/index.php",
                        parameters,
                            
                        function(data) {
                                
                            console.log("we recv data");
                            //loop data.videoObjects
                            //
                               
                               
                            $( "#"+data.serviceType+"Thumb").empty();
                    
                            $( "#videoTemplate" ).tmpl( data.videoObjects ).appendTo( "#"+data.serviceType+"Thumb" );;
                            $("#"+data.serviceType+"loader").hide();  
                            $("#"+parameters.searchType+"Thumb").fadeIn(1000);
                          
                        })
                    }
                    catch(e)
                    {
                        alert(e.toSource());
                    }
                        
                        
                }
                      
                function openVideoDialog(videoURL,title)
                {

                    $('#videoplayer').attr('href', videoURL);
                    $("#videoBox").dialog("open");
                    
                    $f("videoBox", "<?php echo Yii::app()->request->baseUrl . '/css/fftheme/player/flowplayer-3.2.7.swf'; ?>", videoURL);
                }  
                
                    function openAddDialog()
                {
  
                    $("#videoBox").dialog("open");
                    
                }
                

            </script>
			<script id="videoTemplate" type="text/x-jquery-tmpl">

                <li class="video" id="${videoServiceId}">
                    <div class="img">
                        <img class="${videoServiceId}" src="${thumbURL}" />
                    </div>

                    <div class="options">
                        <a class="fav" title="" rel="" href="#"></a>
                        <a class="share" href="#"></a>
                        <a class="dollar" target="_blank" href="${videoDollor}"></a>
                        <a class="info" target="_blank" href="${videoDollor}"></a>
                        <input class="checkBox" id="${videoServiceId}" type="checkbox"/>
                    </div>
                </li>

                </script>
<?php
			}
                        else {
                            echo "<li>Sorry No Results Found<li>";
                        }
			?>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<div class="p-arrow-right sliders">
	<img alt="Scroll Right"
		src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"
		mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"
		mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png">
</div>

<script language="javascript">
   
   //$("#mydialogbox")
   
   
</script>


