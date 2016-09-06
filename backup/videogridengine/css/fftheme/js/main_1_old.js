
/// NOT IN USE - GOTO player.js
this.imagePreview = function(){	
	
	/* END CONFIG */
	$(".img").hover(function(e){
		
		$("body").append("<div id='preview'></div>");								 
	
            videoURL=this.id;
            
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

            }
        });
      $('#videoplayer').attr('href', videoURL);	

            $("#preview")

                         .css("top",e.pageY + 10 + "px")
			.css("left",e.pageX + 30 + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
    $(".img").mousemove(function(e){
		$("#preview")
			.css("top",e.pageY + 10 + "px")
			.css("left",e.pageX + 30 + "px");
	});
};


// starting the script on page load
$(document).ready(function(){
    
	// imagePreview();
});