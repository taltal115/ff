/*
 * Image preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
// NOT IN USE - GOTO player.js
this.imagePreview = function(){	
	/* CONFIG */
    
		xOffset = -30;
		yOffset = -160;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<div id='preview' style='z-index:1000;'></div>");								 
	
            videoURL=this.href;
            $f("preview", playerVar, {
    clip: {
        url: videoURL,
        autoPlay: true,
        autoBuffering: true
    },
    plugins: {
        controls: null
    },
    onLoad: function(){
        //alert("player loaded");
    }
});
      $('#videoplayer').attr('href', videoURL);	
          var total_width=$( document ).width();
                  if(e.pageX > (total_width/2)) {
              var width = ( e.pageX - 250)-10;
           } else {
                var width = e.pageX+15;
            }
            var total_height=$( document ).height();
            if(e.pageY > (total_height/2)) {
                var height = e.pageY + 110;
            } else {
                var height = (e.pageY)+110;
            }
            $("#preview")
                         .css("top",(e.pageY - 65) + "px")
      //.css("left",(width) + "px")
      .css("left",(e.pageX - 280 - 25) + "px")
      .fadeIn("fast");				
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	 $("a.preview").mousemove(function(e){
              var total_width=$( document ).width();
                  if(e.pageX > (total_width/2)) {
              var width = ( e.pageX - 250)-5;
           } else {
                var width = e.pageX+5;
            }
            var total_height=$( document ).height();
            if(e.pageY > (total_height/2)) {
                var height = e.pageY - 220;
            } else {
                var height = (e.pageY);
            }

    $("#preview")
                 .css("top",(e.pageY - 65) + "px")
     //.css("left",(width) + "px")
      .css("left",(e.pageX -280 - 25) + "px")
  }); 
};


// starting the script on page load
$(document).ready(function(){
   
  
    
	imagePreview();
});