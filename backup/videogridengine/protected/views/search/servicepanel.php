<?php 

$serviceData=$serviceData;

//print_r($serviceData);
//
//exit;


?>
<li>
<div class="heading">
                                    <div class="wrap">
                                        <div class="hd"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-hd.jpg" /></div>
                                        <div class="r1">
                                              
                                               <!--<a class="btn x1" href="javascript:void(0);"><img alt="" src="<?php //echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn1.jpg"></a>-->
                                            
                                            <a class="btn x2 one-toggle-three" href="javascript:void(0);"><img alt=""
                                                                                                               src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn2.jpg"></a>
                                            <select class="dd">
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="75">75</option>
                                                <option value="100">100</option>
                                            </select>
                                            <a class="btn x3 hide-restore" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn3.jpg"></a>
                                        </div>
                                        <div class="r2"><span><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-flower_2.jpg"><div class="panel-title">Panel 1</div></span></div>
                                        <div class="r3">
                                            <a class="btn x4 one-col" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn4.jpg"></a>
                                            <a class="btn x5 two-col" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn5.jpg"></a>
                                            <a class="btn x6 three-col" href="javascript:void(0);"><img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/pond-btn6.jpg"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-list">
                                    <div class="video-container">
                                        <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                                        <div class="videos viewport">
                                            <ul class="videos-containers overview">
                                                 
                                                <?php  foreach ($serviceData['videoObjects'] as $videoObject){ ?>
                                                <li class="video" id="<?php echo $videoObject['videoServiceId']; ?>">
                                                    <div class="img">
                                                        <img class="<?php echo $videoObject['videoServiceId']; ?>" src="<?php echo $videoObject['thumbURL'];  ?>" />
                                                    </div>

                                                    <div class="options">
                                                        <a class="fav" title="" rel="" href="#"></a>
                                                        <a class="share" href="#"></a>
                                                        <a class="dollar" target="_blank" href="<?php echo $videoObject['videoDollor']; ?>"></a>
                                                        <a class="info" target="_blank" href="<?php echo $videoObject['videoDollor']; ?>"></a>
                                                        <input class="checkBox" id="<?php echo $videoObject['videoServiceId']; ?>_checkbox" type="checkbox"/>
                                                    </div>
                                                </li>
                                                  <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
    
</li>