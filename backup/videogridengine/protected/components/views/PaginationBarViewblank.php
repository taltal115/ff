

<div class="pageing-area">
    <div class="pageing-container">
        <div class="pageing-area-wrapper">
            <div class="pageing-area-left">
                <?php 
                
//                    if(Yii::app()->user->isGuest)
//                    {
//                      echo "<a href='#' onclick='openAddDialog();'>Add</a>";
//                      
//                      //$controllerID=$this->getController()->getUniqueId();
//                      
//                      //if($controllerID=="search")
//                      echo " <a href='#'>Select All</a> / <a href='#'>Select None</a>";   
//                      
//                   
//                     
//                    }
                    
                ?>
               
                
               
                
<!--              implement following Jquery Methods
              selectAllVideoThumbs()
              deSelectallVideoThumbs()-->
             
            </div>
            <div class="pageing-area-mid">
                
                    
            </div>
            <div class="pageing-area-right">
                <a href="#"> </a>
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
