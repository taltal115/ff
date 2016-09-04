  
<ul>

                <li class="links">

<script type="text/javascript">
    <?
    $queryBarForm = Yii::app()->request->getQuery('SearchBarForm');
    $queryDirection = Yii::app()->getRequest()->getQuery("direction");
    $searchKeywords = $queryBarForm["searchKeywords"];
    echo "var searchBarFormValue = '$searchKeywords';";
    echo "var searchDirectionValue = '$queryDirection';";
    ?>

    function SwapImage(ImageUrl,Control)
    {
        Control.src = ImageUrl;
      
    }
    
    function SetDirectionUrl(id,dir,text)
    {
        var obj = $("#"+id);
        if(obj) {
            var url = obj.attr("href");
            var startUrl = url.substring(0,url.indexOf("?")+1);
            var newUrl = startUrl+"SearchBarForm%5BsearchKeywords%5D="+text+"&direction="+dir; 
            obj.attr("href",newUrl);
        }
    }
    
    $('#SearchBarForm_searchKeywords').live('keypress',function(e){
       if (e.keyCode == 13) {
            //$('body').append('<div id="mask"><img src="<?php // bloginfo( "template_url" ); ?>/images/loader.gif"  width="50" height="60"/><br />GETTING RESOLUTS...</div>');
            //-- Itsik $('#mask').show();
           var text = $(this).val(); 
           
           StartSearch(text); // Stored At --> /public_html/videogridengine/protected/views/search/index.php --//
           
           SetDirectionUrl("direction_h","h",text);
           SetDirectionUrl("direction_v","v",text);
           SetDirectionUrl("direction_m","m",text);
           
       }           
    });     

</script>
 <div id="mask">
            <p>
            <img width="100px" height="100px" src="<?php bloginfo( "template_url" ); ?>/images/loader.gif" />
        </p>
        </div>
                <a href="<?php echo home_url('/index.php'); ?>"><img
                src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/home-icon.png" alt="home"
                height="47" width="51" onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/home-icon.png',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/home-icon-hv.png',this);"></a></li>
    <li><a href='
        <?php
        if (!Yii::app()->user->isGuest) {
            echo  home_url( '/videogridengine/index.php/user');
        } else {
            echo get_site_url() . '/wp-login.php';
        }
 
        ?>'><img
                src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/user-icon.png" alt="user"
                height="47" width="51" onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/user-icon.png',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/user-icon-hv.png',this);"></a></li>
    <li><a href="<?php echo home_url( '/index.php' ).'/buy'; ?>"><img
                src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/cart-icon.png" alt="cart"
                height="47" width="51" onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/cart-icon.png',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/cart-icon-hv.png',this);"></a></li>
    <li><a href="<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('foundboxes')) ?>"><img
                src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/star-icon.png" alt="star"
                height="47" width="51" onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/star-icon.png',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/star-icon-hv.png',this);"></a></li>


    <li class="search">




        <?php
       //-- Itsik echo CHtml::beginForm(CHtml::normalizeUrl(Yii::app()->createUrl('search')), 'get');
//        $form = $this->beginWidget('CActiveForm', array(
//            'id' => 'login1-form',
//
//            'action' => CHtml::normalizeUrl(Yii::app()->createUrl('search')),
//             'method'=>'get',
//            'enableClientValidation' => true,
//            'clientOptions' => array(
//                'validateOnSubmit' => true,
//            ),
//                ));
//       $dummobj=new CActiveForm();
//               $dummobj->ac
        ?>
        <?php echo CHtml::errorSummary($model); ?>

        <?php //echo CHtml::activeTextField($form,'searchKeywords') ?>
        <?php //echo CHtml::error($form,'searchKeywords');   ?>

<?php echo CHtml::activeTextField($model, 'searchKeywords'); ?>
<button id="searchBTN" onclick="StartSearch($('#SearchBarForm_searchKeywords').val())">SEARCH</button>





<!--        <input value="SEARCH..." name="query" class="input-box" type="text">-->

    </li>
    <li class="dropdown">
        <div class="drop-text">
            <!--<div class="combowrap">-->
            <!--<select class="top-dd" name="combolist">
                <option value="0">Option</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>-->
            <!--</div>-->
            <select class="select-box top-dd">

                <option value="1">ASC</option>
                <option value="2">DSC</option>

            </select>
        </div>
    </li>

    <?php
           $queryStringDirection = Yii::app()->getRequest()->getQuery("direction");
	   $iconSourceH=Yii::app()->request->getBaseUrl(true)."/css/fftheme/images/nav-icon1.png";
	   $iconSourceV=Yii::app()->request->getBaseUrl(true)."/css/fftheme/images/nav-icon2.png";
	   $iconSourceM=Yii::app()->request->getBaseUrl(true)."/css/fftheme/images/nav-icon3.png";
	// echo $queryStringDirection;
	        switch ($queryStringDirection) {
	            case "h":

	                $iconSourceH=Yii::app()->request->getBaseUrl(true)."/css/fftheme/images/nav-icon1-hv.png";

	                break;

	             case "v":
	                    $iconSourceV=Yii::app()->request->getBaseUrl(true)."/css/fftheme/images/nav-icon2-hv.png";


	                break;
	             case "m":
	                $iconSourceM=Yii::app()->request->getBaseUrl(true)."/css/fftheme/images/nav-icon3-hv.png";


	                break;

	            default:
	                break;
	        }

// echo $queryStringDirection;
    
    $pageURL = Yii::app()->getRequest()->getUrl();
    $pageURL = str_replace('&direction=' . $queryStringDirection, '', $pageURL);
    $search=false;
    if(strstr($pageURL,"search"))
    {
       $search=true;
    }

//SearchBarForm[searchKeywords]=mango&direction=v&page=2
    ?>
   <?php if($search==true): ?> 
    <li class="right-icon"><a id="direction_h" href="<?php echo $pageURL ?>&direction=h"><img
               src="<?php echo $iconSourceH; ?>" alt="icon1"
                height="38" width="37" 
                <?php if($queryStringDirection=="h"): ?>
                  onmouseover="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon1.png',this);" 
                 onmouseout= "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon1-hv.png',this);"
                <?php else: ?>
                 onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon1.png',this);" 
                onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon1-hv.png',this);"
                
                <?php endif ?>
                ></a></li>
                
    <li class="right-icon">

        <a id="direction_v" href="<?php echo $pageURL ?>&direction=v"><img
               src="<?php echo $iconSourceV; ?>" alt="icon2"
                height="38" width="39" 
                <?php if($queryStringDirection=="v"): ?>
                  onmouseover="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon2.png',this);" 
                 onmouseout= "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon2-hv.png',this);"
                <?php else: ?>
                 onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon2.png',this);" 
                onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon2-hv.png',this);"
                
                <?php endif ?>
                ></a></li>
           
    <li class="right-icon"><a id="direction_m" href="<?php echo $pageURL ?>&direction=m"><img
                src="<?php echo $iconSourceM; ?>" alt="icon3"
                height="38" width="38" 
                 <?php if($queryStringDirection=="m"): ?>
                  onmouseover="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon3.png',this);" 
                 onmouseout= "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon3-hv.png',this);"
                <?php else: ?>
                 onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon3.png',this);" 
                onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/nav-icon3-hv.png',this);"
                
                <?php endif ?>
                ></a></li>
    <li class="advance-search" style="display:none"><a href="#" onclick='openAdvanceSearchDialog();'><img
                src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/advance-seach-nav_2.png"
                alt="adavace" onmouseout  ="SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/advance-seach-nav_2.png',this);" onmouseover = "SwapImage('<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/fftheme/images/advance-seach-nav_2-hv.png',this);"></a></li>
 <?php endif; ?>               
    <!--        <li class="advance-search">
    <?php //echo $form->hiddenField($model, 'currentpage');   ?>
    <?php //echo $form->error($model, 'currentpages');    ?>
                 <div class="row">
<?php //echo CHtml::submitButton('Search');    ?>
            </div> 
            </li>-->
            

</ul>       <?php echo CHtml::endForm(); ?>        
