
<?php // var_dump( Yii::app()->videoservices->jsonResults);

if(isset (Yii::app()->videoservices->jsonResults))
{
    
    $videoThumbs = Yii::app()->videoservices->jsonResults;
//    echo "<pre>";
//     print_r($servicesPanels);
    $totalPages= $videoThumbs['totalPages'];
    //echo $totalPages;
    $item_count =$totalPages;
	$page_size =1 ;//Yii::app()->params['selected_num_item'];

	$pages =new CPagination($item_count);
       
	$pages->setPageSize($page_size);

	// simulate the effect of LIMIT in a sql query
	$end =($pages->offset+$pages->limit <= $item_count ? $pages->offset+$pages->limit : $item_count);

	$sample =range($pages->offset+1, $end);

}



?>

<div class="pageing-area">
    <div class="pageing-container">
        <div class="pageing-area-wrapper">
            <div class="pageing-area-left">
                <a href="#" onclick="openAddDialog();">Add</a> / <a href="#" onclick="selectAllVideoThumbs();">Select All</a> / <a href="#" onclick="deSelectallVideoThumbs();">Select None</a>
<!--              implement following Jquery Methods
              selectAllVideoThumbs()
              deSelectallVideoThumbs()-->
            
            </div>
            <div class="pageing-area-mid">
                
                    <?php 
                     if(isset ($pages))
                     {
                         $this->widget('CLinkPager', array(
	'currentPage'=>$pages->getCurrentPage(),
	'itemCount'=>$item_count,
	'pageSize'=>$page_size,
	'maxButtonCount'=>6,
	
	'header'=>'',
));
//                    $this->widget('CListPager', array(
//	'pages'=>$pages,'header'=>''
//));
                    
                    
}
                    
                    ?>
                
            </div>
            <div class="pageing-area-right">
            <!--    <a href="#">Dispaly <?php //echo $totalPages// ?></a> -->
            </div>
            
            
        </div>
    </div>
</div>


<!--<script type="text/javascript">
		$(function() {
			$("#demo5").paginate({
				count 		: <?php echo $totalPages ?>,
				start 		: 1,
				display     : 10,
				border					: true,
				border_color			: '#fff',
				text_color  			: '#fff',
				background_color    	: 'black',	
				border_hover_color		: '#ccc',
				text_hover_color  		: '#000',
				background_hover_color	: '#fff', 
				images					: false,
				mouse					: 'press',
				onChange     			: function(page){
                                   $.redirect( location.href, { 'SearchBarForm[currentpage]' : page });
                                   return;

                                   gotoURL=window.location.href;//"&SearchBarForm[currentpage]="+page;
                                    alert(gotoURL);
                                    var urlArray = currentURL.split('SearchBarForm[currentpage]');
                                    console.log(urlArray);
                                    gotoURL= urlArray[0]+"SearchBarForm[currentpage]="+page;  
                alert(gotoURL);
                //window.window.location.href=gotoURL; 
                                                                                         //alert('I am going to change the page to'+page);
											//$('._current','#paginationdemo').removeClass('_current').hide();
											//$('#p'+page).addClass('_current').show();
										  }
			});
		});
                
                jQuery.redirect = function(url, params) {

    url = url || window.location.href || '';
    url =  url.match(/\?/) ? url : url + '?';

    for ( var key in params ) {
        var re = RegExp( ';?' + key + '=?[^&;]*', 'g' );
        url = url.replace( re, '');
        url += ';' + key + '=' + params[key]; 
    }  
    // cleanup url 
    url = url.replace(/[;&]$/, '');
    url = url.replace(/\?[;&]/, '?'); 
    url = url.replace(/[;&]{2}/g, ';');
    // $(location).attr('href', url);
    window.location.replace( url ); 
};

		</script>-->
                
<div class="clear"></div>
