
//dailogPos=null;
//isOpenhoverPlayer=false;
//currentMousePos=null;
//tops=0;
//left=0;
$(document).ready(function () {

    sliding=true;
   // currentMousePos = { x: -1, y: -1 };
    try{
        
       
//$("#download_now").tooltip({ effect: 'slide'});
  $(document).mousemove(function(event) {
//        currentMousePos.x = event.pageX;
//        currentMousePos.y = event.pageY;

//         closeOnMouseOut();
//        $("#pl").html("position is="+currentMousePos.x+"x"+currentMousePos.y+" dialog top="+tops);
    });
    
        $(this).mousemove(function (e) {
            window.XPOS=e.pageX;
            window.YPOS=e.pageY;
        })

        $( 'div.video-container' ).each( function() {
            $(this).tinyscrollbar();
        //VideoApp.scrollbar( $( this ) );
        });
        $( 'a.one-toggle-three' ).click(function () {
            var li = $(this).parents( "li" );
            if( li.width() == 245 ) {   
                $( 'a.three-col', li ).trigger( 'click' );
            } else {
                $( 'a.one-col', li ).trigger( 'click' );
            }
        });
        $('a.hide-restore').click(function () {
          //  alert('hi');
            var liNode = $(this).parents("li");
            liNode.animate({
                width : '0px'
            }, function() {
                $( 'div.heading', this ).hide();
            });

            liNode.find( 'div.video-container' ).tinyscrollbar_update();
        });
        $( 'a.one-col' ).click(function () {
            $("ul li.panelData").css("display", "block"); // this will show all grids
             sliding=true;
            //temp code
            
                var liNode = $(this).parents("li");
               var selectedComponent=liNode;
               selectedComponent.data('fullWidth',false);
//                                    selectedComponent.css({
//                                        width : "245px"
//                                     }).find( ".hd" ).hide();
            
            //
//            var liNode = $(this).parents("li");
//           
            liNode.css({
                width : "245px"
            }).find( ".hd" ).hide();
 
            liNode.find( 'div.video-container' ).tinyscrollbar_update();
          //  withKeyIcon();
        //code for key icon
       if(typeof(Storage)!=="undefined") {
               // localStorage.Fotolia=1;
        var title=liNode.find( '.panel-title' ).text();
        var t= trim1(title);
        var t1=t.split(" ");
      
        var ser=t1[0];
        if(ser=='Fotolia'){

        localStorage.Fotolia=1;
        }else
            if(ser=='ClipDealer'){
                localStorage.ClipDealer=1;
            
        }
    
    else if(ser=='Pond5'){   
                 localStorage.Pond5=1;
        }
        
        }//end is storage
        else{}
            
       //end key icon code
        
        //        VideoApp.loadPlugin( 'tinyscrollbar', function() {
        //            liNode.find( 'div.video-container' ).tinyscrollbar_update();
        //        });
        });
        $( 'a.two-col' ).click(function () {
            $("ul li.panelData").css("display", "block"); // this will show all grids
             sliding=true;
            var liNode = $(this).parents("li");
                    
               var selectedComponent=liNode;
               selectedComponent.data('fullWidth',false);
            liNode.css({
                width : "350px"
            }).find( ".hd" ).show();
            liNode.find( 'div.video-container' ).tinyscrollbar_update();
              
              //code for key icon
       if(typeof(Storage)!=="undefined") {
               // localStorage.Fotolia=1;
        var title=liNode.find( '.panel-title' ).text();
        var t= trim1(title);
        var t1=t.split(" ");
      
        var ser=t1[0];
        if(ser=='Fotolia'){

        localStorage.Fotolia=2;
        }else
            if(ser=='ClipDealer'){
                localStorage.ClipDealer=2;
            
        }
    
    else if(ser=='Pond5'){   
                 localStorage.Pond5=2;
        }
        
        }//end is storage
        else{}
            
       //end key icon code
        });
        ;
        $('a.three-col').click(function () {
             $("ul li.panelData").css("display", "block"); // this will show all grids
              sliding=true;
                     var liNode = $(this).parents("li");
               var selectedComponent=liNode;
               selectedComponent.data('fullWidth',false);
          //  console.log(liNode);
            liNode.css({
                width : "475px"
            }).find( ".hd" ).show();
            liNode.find( 'div.video-container' ).tinyscrollbar_update();
              //code for key icon
       if(typeof(Storage)!=="undefined") {
               // localStorage.Fotolia=1;
        var title=liNode.find( '.panel-title' ).text();
        var t= trim1(title);
        var t1=t.split(" ");
      
        var ser=t1[0];
        if(ser=='Fotolia'){

        localStorage.Fotolia=3;
        }else
            if(ser=='ClipDealer'){
                localStorage.ClipDealer=3;
            
        }
    
    else if(ser=='Pond5'){   
                 localStorage.Pond5=3;
        }
        
        }//end is storage
        else{}
            
       //end key icon code
        });

        $('a.four-col').click(function () {
            var liNode = $(this).parents("li");
            var sPanelWidth=$("#services-panel").width()-125;
            
            var listPanels=$('ul.services-list').children();
           // console.log("event start");
            $.each(listPanels, function() {
                    
                // console.log($(this).is('li'));
                    
                if($(this).is('li'))
                {
                    
                    
                    
                    //                            console.log("start1");
                    //                            console.log(liNode.get(0));
                    //                             console.log("end");
                    // console.log("start2");
                    //                            console.log($(this).get(0));
                    //                            console.log("end");
                    if(liNode.get(0)==$(this).get(0))
                    { 
//                        console.log("hii");
                        var selectedComponent=$(this);
                        var isFullWidth=selectedComponent.data('fullWidth');
//                        console.log(isFullWidth);
                        if(!isFullWidth || isFullWidth==undefined )
                            {
                                
                                
                                    selectedComponent.data('fullWidth',true);
                                                  //code for panel left
                                    var ulWidth = 0;
           $("ul li.panelData").each(function() {
            ulWidth = ulWidth + $(this).width()
           });
    
            var pane = $( 'ul.services-list' ), left = parseInt( pane.css( 'left' ).replace( 'px', '' ) ), slideBy = ulWidth;
            left = isNaN( left ) ? 0 : left;
       
                var newLeft = left + slideBy;
                newLeft = newLeft > 0 ? 0 : newLeft;
                pane.animate({
                    left : newLeft
                });
              
                        //end code for set panel left
                                    selectedComponent.css({
                                        width : sPanelWidth
                                    }).find( ".hd" ).show();
                                    sliding=false;

          
                                    
                                    // $("ul li.panelData").css("display", "none"); // this will hide other all grids
                                    
 
                            }else
                                {
      //  $("ul li.panelData").css("display", "block"); // this will show all grids
         if(typeof(Storage)!=="undefined") {

        var title=liNode.find( '.panel-title' ).text();
        var t= trim1(title);
        var t1=t.split(" ");
      
        var ser=t1[0];
        if(ser=='Fotolia'){

        var cols1=localStorage.Fotolia;
        if(cols1==1){
                selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "245px"
                                         }).find( ".hd" ).hide();
        }
        else if(cols1==2){
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "350px"
                                     }).find( ".hd" ).show();
        }
        else if(cols1==3){
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "475px" 
                                    }).find( ".hd" ).show();
        }else{
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "350px"
                                     }).find( ".hd" ).show();
        }
        
        
        
        }else
            if(ser=='ClipDealer'){
                     var cols2=localStorage.ClipDealer;
        if(cols2==1){
                selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "245px"
                                         }).find( ".hd" ).hide();
        }
        else if(cols2==2){
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "350px"
                                     }).find( ".hd" ).show();
        }
        else if(cols2==3){
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "475px" 
                                    }).find( ".hd" ).show();
        }else{
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "350px"
                                     }).find( ".hd" ).show();
        }
            
        }
    
    else if(ser=='Pond5'){   
             var cols3=localStorage.Pond5;
        if(cols3==1){
                selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "245px"
                                         }).find( ".hd" ).hide();
        }
        else if(cols3==2){
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "350px"
                                     }).find( ".hd" ).show();
        }
        else if(cols3==3){
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "475px" 
                                    }).find( ".hd" ).show();
        }else{
            selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "350px"
                                     }).find( ".hd" ).show();
        }
        }
        
        }//end is storage
        else{
            
            
              selectedComponent.data('fullWidth',false);
                                    selectedComponent.css({
                                        width : "475px" 
                                    }).find( ".hd" ).show();
                                    
                                     
        }
                                    //here work////////////
//                                    selectedComponent.data('fullWidth',false);
//                                    selectedComponent.css({
//                                        width : "475px" 
//                                    }).find( ".hd" ).show();
                                    // window.alert("end if");
                                    sliding=true;
                                    
                                }
                                
                    //                                  console.log("hi");
                    //                                console.log($(this));
                    //                                console.log(liNode);
                               
                    }
                    else
                    {
                        var selectedComponent=$(this);
                        selectedComponent.toggle();
                       // $("ul li.panelData").css("display", "block"); // this will show all grids
                    }
                }
            });
                
            //console.log(listPanels);
            // console.log(liNode.get(0));
            //            liNode.css({
            //             width : sPanelWidth
            //            }).find( ".hd" ).show();
            liNode.find( 'div.video-container' ).tinyscrollbar_update();
            $("ul li.panelData").css("width", "1100px"); // this will show all grids
        });


        $( 'div.sliders' ).click( function() {
            //
            
           
          if(sliding==true){
           
            
            var ulWidth = 0;
           $("ul li.panelData").each(function() {
            ulWidth = ulWidth + $(this).width()
           });
            
            //
           
            var pane = $( 'ul.services-list' ), left = parseInt( pane.css( 'left' ).replace( 'px', '' ) ), slideBy = 200;
            left = isNaN( left ) ? 0 : left;
            if( $( this ).hasClass( 'p-arrow-left' ) ) {
                var newLeft = left + slideBy;
                newLeft = newLeft > 0 ? 0 : newLeft;
                pane.animate({
                    left : newLeft
                });
               
               
            } 
            else {
                var childsWidth = 0, containerWidth = pane.parent().width();
                pane.children().each( function() {
                    childsWidth += $( this ).width() + 20;
               
                });
                var minLeft = containerWidth - childsWidth;
                minLeft = minLeft > 0 ? 0 : minLeft;
                var newLeft = left - slideBy;
                newLeft = newLeft < minLeft ? minLeft : newLeft;
                var widthp=newLeft*-1;
                if(widthp+660<ulWidth){
                pane.animate({
                    left : newLeft
                });
            }//
      
            }
            //alert(ulWidth+"="+widthp);
           }//end if sliding
        }).find( 'img' ).hover( function() {
            this.src = $( this ).attr( 'mouseinpic' );
        }, function() {
            this.src = $( this ).attr( 'mouseoutpic' );
        });
        
    //        $('#keyimgholder').click(function () {
    ////         makealert('hi-key');
    //        var liNode = $(this).parents("li");
    //      //  console.log(liNode);
    //        liNode.css({
    //            //width : "475px"
    //           // width : "950px"
    //        }).find( ".hd" ).show();
    //        liNode.find( 'div.video-container' ).tinyscrollbar_update();
    //    });


    } catch(e)
{
     console.log(e);
    }
});


/*
 * My code of H_grid javascript
 *
 *
 *
 */

function searchByDate(data,value){
    // data.current_page+=1;
    if(data.dateSortOrder==0)
    data.dateSortOrder = 1;
else
    data.dateSortOrder = 0;
    callAllVideoServices(data);
}

function searchHD(data,chkBox){
    // data.current_page+=1;
    
    if(chkBox.checked)
    data.hdSearch = 1;
else
    data.hdSearch = 0;
    callAllVideoServices(data);
}


function item_combo(data,value){

    // data.current_page+=1;
    data.items_per_page = value;
    callAllVideoServices(data);
}

//method call for inner paginations
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

function shuffle(o){ //v1.0
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
}
function callAllVideoServices(parameters) {
    $("#"+parameters.searchType+"loader").show();
    //alert("#"+parameters.searchType+"loader");
    $("#"+parameters.searchType+"Thumb").fadeOut(1000);
   // console.log(parameters);
    //call Ajax Requests to call Results
    try{
        $.getJSON(
        
           //"http://localhost/findingfootageproject1/ffservices/public/index.php",
           "http://www.findingfootage.com/ffservices/public/index.php",
            parameters,

            function(data) {
                
                console.log("we recv data");
                             console.log(data.videoObjects);
                    //          alert("1="+data.videoObjects);
                //loop data.videoObjects
                //
                var dataObjects=null;
                if(data.searchType=="All"){
                    
                    $("#Allloader").show();
                    $("#AllThumb").fadeOut(1000);
                    jQuery.each(data.videoObjects , function(index, json){
                      // console.log("json is now =="); 
                       
                      // json =JSON.stringify(json);
          
             if(dataObjects==null){
             dataObjects=json.videoObjects;
           

         }else{
             
             dataObjects = dataObjects.concat(json.videoObjects); 
                    }
                    // console.log(dataObjects); 

                            });
                    
           dataObjects=shuffle(dataObjects);
                    $("#AllThumb").empty();
//                console.log("mix");
                
                
                
//                console.log(dataObjects);
                
                $( "#videoTemplate" ).tmpl(dataObjects).appendTo("#AllThumb");
                
                ;
                $("#"+dataObjects.videoServiceId).data('videoData',JSON.stringify(dataObjects));
               // console.log($("#"+data.videoObjects.videoServiceId));

                $.each(dataObjects, function() {
                    
                    $("#"+this.videoServiceId).data('videoData',JSON.stringify(this));

                });
                
                 
                $.each(dataObjects, function() {
                    //   console.log(this);
                    
                    stWidget.addEntry({
                    
                   
                        "service":"sharethis",
                        "element":document.getElementById(this.videoServiceId+'_share'),
                        "url":this.videoDollor,
                        "title":this.videoName,
                        "image":this.thumbURL,
                        "summary":"Sharing is great! Its fun to share Videos from www.findingfootage.com"
                    });

                });
             

                $("#Allloader").hide();
                $("#AllThumb").fadeIn(1000);
                $( 'div.video-container' ).tinyscrollbar_update();
                    //render mix interface 
                     //get all video objects for each loop put then into a arrray
                     
                     //for each 
                     ///
                }
                

                if(data.videoObjects=="")
                {
                    $( "#"+data.serviceType+"Thumb").html("<li><br><strong>No More Videos for this Section</strong></li>");
                    $("#"+data.serviceType+"loader").hide();
                    $("#"+parameters.searchType+"Thumb").fadeIn(1000);
                    $( 'div.video-container' ).tinyscrollbar_update();
                    //$(".rightArrow").hide();
                    // $(".leftArrow").hide();
                    return ;
                }
                $( "#"+data.serviceType+"Thumb").empty();
                //console.log(data.videoObjects);
                $( "#videoTemplate" ).tmpl( data.videoObjects ).appendTo( "#"+data.serviceType+"Thumb" );
                ;
                $("#"+data.videoObjects.videoServiceId).data('videoData',JSON.stringify(data.videoObjects));
               // console.log($("#"+data.videoObjects.videoServiceId));

                $.each(data.videoObjects, function() {
                    $("#"+this.videoServiceId).data('videoData',JSON.stringify(this));

                });
                
                 
                $.each(data.videoObjects, function() {
                    //   console.log(this);
                    
                    stWidget.addEntry({
                    
                   
                        "service":"sharethis",
                        "element":document.getElementById(this.videoServiceId+'_share'),
                        "url":this.videoDollor,
                        "title":this.videoName,
                        "image":this.thumbURL,
                        "summary":"Sharing is great! Its fun to share Videos from www.findingfootage.com"
                    });

                });
             

                $("#"+data.serviceType+"loader").hide();
                $("#"+parameters.searchType+"Thumb").fadeIn(1000);
                $( 'div.video-container' ).tinyscrollbar_update();
                
            //      var liNode = $(this).parents("li");


            //liNode.find( 'div.video-container' ).tinyscrollbar_update();

            })
    }
    catch(e)
    {
      //  console.log(e);
    }


}

JSON.stringify = JSON.stringify || function (obj) {
    var t = typeof (obj);
    if (t != "object" || obj === null) {
        // simple data type
        if (t == "string") obj = '"'+obj+'"';
        return String(obj);
    }
    else {
        // recurse array or object
        var n, v, json = [], arr = (obj && obj.constructor == Array);
        for (n in obj) {
            v = obj[n];
            t = typeof(v);
            if (t == "string") v = '"'+v+'"';
            else if (t == "object" && v !== null) v = JSON.stringify(v);
            json.push((arr ? "" : '"' + n + '":') + String(v));
        }
        return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
    }
  
                      
//stButtons.locateElements();
};



function openVideoDialog(videoURL,title,player)
{
 


    var playerVar = player ;
    // $('#videoBox').find('.ui-dialog-titlebar').hide();



    $('#videoplayer').attr('href', videoURL);
    var x =window.XPOS;
    var y =window.YPOS-window.pageYOffset;
//    var x =window.pageXOffset
//    var y =window.pageYOffset
//    alert("x="+x+" y="+y);

    // $('#videoBox').dialog("option", { position: [e.pageX+5, e.pageY+5] });
    
    $("#videoBox").dialog( "option", "position", [x,y]);
    $("#videoBox").dialog("open");

    $f("videoBox", playerVar , videoURL);

}

function openVideoDetailDialog(url,videoThumbId)
{
var data1=$('#data'+videoThumbId).html();

if(data1!='' && data1!=null && data1!=undefined){
    $('#'+videoThumbId).data('videoData',data1);
}
//var mydata=$('#'+videoThumbId).data('videoData');
//alert(mydata);
    videoDetails=$('#'+videoThumbId).data('videoData');
    
     if( typeof videoDetails === 'string' ) {
     videoDetails=jQuery.parseJSON(videoDetails);
 }

    console.log(videoDetails);
    var recursiveEncoded = $.param(videoDetails);
    var recursiveDecoded = decodeURIComponent($.param(videoDetails));

//    alert(recursiveEncoded);
//    alert(recursiveDecoded);
    redirectURL=url+"?"+recursiveEncoded;
    //window.location.href=redirectURL;
    window.open(redirectURL, '_blank');
    window.focus();

   // console.log(redirectURL);
//                    var playerVar = player ;
//                    $('#videoBox').find('.ui-dialog-titlebar').hide();
//                    $('#videoplayer').attr('href', videoURL);
//                    $("#videoBox").dialog("open");
//
//                    $f("videoBox", playerVar , videoURL);
}


function getAllSelectedVideoThumbsData()
{
    updatefoundboxselected();
    //return Array of Data of selected Video Thumbs
    var selectedVideoThumbsData=new Array();
    var selectedVideoThumbs= $("input:checked");
    //console.log(selectedVideoThumbs);
    $.each(selectedVideoThumbs, function() {

        videoThumbIdArray=$(this).attr('id').split('_');
        ;
        videoThumbId=videoThumbIdArray[0];
       // console.log(videoThumbId);
        // $('#'+videoThumbId).data('videoData')

        selectedVideoThumbsData.push($('#'+videoThumbId).data('videoData'));
    // console.log($('#'+videoThumbId).data('videoData'));
    //$("#"+this.videoServiceId).data('videoData',JSON.stringify(this));

    });
//    console.log("selectedVideoThumbsData");
//    console.log(selectedVideoThumbsData);

    return selectedVideoThumbsData;
}
function openAddDialog()
{
    

updatefoundboxselected();

    $("#adddialog").dialog("open");
    selectedVideoThumbsData= getAllSelectedVideoThumbsData();
    //$('#FoundboxPopuForm_foundBoxVideos').val('sajid');
    //loop to each slect checkbox and get its id
    //then run foreach loop on there id and get there data object like this $('#37938666').data('videoData')
    // convert tht js object to string JSON.stringify(oject)
    // and store into hidden field with concatinate
    //   $('#37938666').data('videoData')
    //then concatinate
    //$('#FoundboxPopuForm_foundBoxVideos').val(JSON.stringify($('#37938666').data('videoData')));
    $('#FoundboxPopuForm_foundBoxVideos').val(JSON.stringify(selectedVideoThumbsData));
//console.log('sajid');

// console.log(selectedVideoThumbsData);

// console.log($('#FoundboxPopuForm_foundBoxVideos'));
}


function openAddFavDialog(favVideoThumbId)
{
updatefoundboxselected();
    $("#adddialog").dialog("open");

    var selectedVideoThumbsData=new Array();
    selectedVideoThumbsData.push($('#'+favVideoThumbId).data('videoData'));
    // videoThumbsData=$('#'+favVideoThumbId).data('videoData');

    $('#FoundboxPopuForm_foundBoxVideos').val(JSON.stringify(selectedVideoThumbsData));

//    console.log("selectedVideoThumbsData");
//    console.log(selectedVideoThumbsData);



}//end function

function selectAllVideoThumbs(){
    // thumb_checkBox
    $(":checkbox.thumb_checkBox").prop("checked", true);
}

function deSelectallVideoThumbs(){

    $(":checkbox.thumb_checkBox").prop("checked", false);

}

function openAdvanceSearchDialog(){

    $("#advanceSearchdialog").dialog("open");
    

}



   function playOnMouseOver(videoURL,player){
       
       var urls=videoURL.split(",");
       var videos=new Array(); 
        
//       var videos = [], results = videoURL;
for (var i = 0; i < urls.length-1;i++) {
    videos.push(urls[i]);
}
   
      var v=videos[0];


    var playerVar = player ;
   
    //$('#videoplayer').attr('href', v);
    var x =window.XPOS;
    var y =window.YPOS-window.pageYOffset;

    $("#hoverplay").dialog( "option", "position", [x,y]);
     $(".ui-dialog-titlebar").hide();
 
     $("#hoverplay").dialog("open");
    //  isOpenhoverPlayer=true;
    //  dailogPos= $("#hoverplay").dialog("open").offset();
//         tops=dailogPos.top;
//        left=dailogPos.left;

    //$f("videoBox", playerVar , videoURL);
          $f("hoverplay", playerVar, {
    clip: {
        url: "",
        autoPlay: true,
        autoBuffering: true
    },

    playlist: videos
          ,
          
    plugins: {
        controls: {
                playlist: true
            }
      //  controls: null
    },
    onLoad: function(){
        //alert("player loaded");
    }
});
    //
    
    
    
   }
   
   function closeOnMouseOut(){
   
//   if(isOpenhoverPlayer){
//       var y=currentMousePos.y;
//       var x= currentMousePos.x;
//       if(y<=tops+240 && x>=left+320){
//          return;
//       }
//  
//
//   }
       $('#hoverplay').dialog('close');
      // isOpenhoverPlayer=false;
            return false;
    
       
   }
   
   
   function trim1 (str) {
    str = str.replace(/^\s+/, '');
    for (var i = str.length - 1; i >= 0; i--) {
        if (/\S/.test(str.charAt(i))) {
            str = str.substring(0, i + 1);
            break;
        }
    }
    return str;
}

   function updatefoundboxselected(){
    $('.newfboxdiv').hide();
    $('#FoundboxPopuForm_title').val('');
    $('#FoundboxPopuForm_description').val('');
    
    $('#FoundboxPopuForm_selectedFBox').html('');
    var url =  "<?php echo Yii::app()->request->baseUrl; ?>/index.php/foundboxes/getFBoxOptions";
        $.ajax({
            type: "POST",
            url: url,
            success: function(data)
            {
                var obj = $.parseJSON(data);
                var option="";
                        if(obj.length>0){
                            $.each(obj, function (index, value) {
                              option+='<option value="'+value.id+'">'+value.title+'</option>';  
                            });
                        }
                        $('#FoundboxPopuForm_selectedFBox').append(option);     
            }
        });
}
   


