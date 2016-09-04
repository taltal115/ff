
$(document).ready(function () {
    
    sliding=true;
    try{
        
        $(document).mousemove(function(event) {
            //
        });
    
        $(this).mousemove(function (e) {
            window.XPOS=e.pageX;
            window.YPOS=e.pageY;
        })

        $( 'div.video-container' ).each( function() {
            $(this).tinyscrollbar();
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
            var liNode = $(this).parents("li");
            liNode.animate({
                width : '0px'
            }, function() {
                $( 'div.heading', this ).hide();
            });

            var vcontainer = liNode.find( 'div.video-container' )
            if($(vcontainer).length > 0)
                vcontainer.tinyscrollbar_update();    
        });
        
        $( 'a.one-col' ).click(function () {
            
            $("ul li.panelData").css("display", "block"); // this will show all grids
            sliding=true;
            //temp code
            
            var liNode = $(this).parents("li");
            var selectedComponent = liNode;
            selectedComponent.data('fullWidth',false);

            liNode.css({
                width : "245px"
            }).find( ".hd" ).hide();
            
            var vcontainer = liNode.find( 'div.video-container' );
            if($(vcontainer).length > 0)
                vcontainer.tinyscrollbar_update();    
            //  withKeyIcon();
            //code for key icon
            if(typeof(Storage)!=="undefined") {
                var title=liNode.find( '.panel-title' ).text();
                var t= trim1(title);
                var t1=t.split(" ");
              
                var ser = t1[0];
                localStorage[ser] = 1;
                /*
                if(ser=='Fotolia'){
                    localStorage.Fotolia=1;
                }else if(ser=='ClipDealer'){
                    localStorage.ClipDealer=1;
                }else if(ser=='Pond5'){   
                    localStorage.Pond5=1;
                }
                */
            }//end is storage
            else{}
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
            var vcontainer = liNode.find( 'div.video-container' );
            if($(vcontainer).length > 0)
                vcontainer.tinyscrollbar_update();     
            //code for key icon
            if(typeof(Storage)!=="undefined") {
                var title=liNode.find( '.panel-title' ).text();
                var t= trim1(title);
                var t1=t.split(" ");
              
                var ser=t1[0];
                localStorage[ser] = 2;
                /*
                if(ser=='Fotolia'){
                    localStorage.Fotolia=2;
                }else if(ser=='ClipDealer'){
                    localStorage.ClipDealer=2;
                }else if(ser=='Pond5'){   
                    localStorage.Pond5=2;
                }
                */
            }//end is storage
            else{}  
           //end key icon code
        });
        
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
            var vcontainer = liNode.find( 'div.video-container' );
            if($(vcontainer).length > 0)
                vcontainer.tinyscrollbar_update(); 
              //code for key icon
            if(typeof(Storage)!=="undefined") {
                // localStorage.Fotolia=1;
                var title=liNode.find( '.panel-title' ).text();
                var t= trim1(title);
                var t1=t.split(" ");
              
                var ser=t1[0];
                localStorage[ser] = 3;
                /*
                if(ser=='Fotolia'){
                    localStorage.Fotolia=3;
                }else if(ser=='ClipDealer'){
                    localStorage.ClipDealer=3; 
                }else if(ser=='Pond5'){   
                    localStorage.Pond5=3;
                }
                */
            }//end is storage
            else{}
            
        //end key icon code
        });

        var m_preFullWidthPanelDataLeft = 0;
        $('a.four-col').click(function () {
            
            var liNode = $(this).parents("li");
            var sPanelWidth=$("#services-panel").width()-70;
            var listPanels=$('ul.services-list').children();
            // console.log("event start");
            $.each(listPanels, function() {
                if($(this).is('li')) {
                    if(liNode.get(0)==$(this).get(0)){ 
                        var selectedComponent=$(this);
                        var isFullWidth=selectedComponent.data('fullWidth');
                        if(!isFullWidth || isFullWidth==undefined ){
                            selectedComponent.data('fullWidth',true);
                            var ulWidth = 0;
                            $("ul li.panelData").each(function() {
                                ulWidth = ulWidth + $(this).width()
                            });
                            
                            var pane = $( 'ul.services-list' ), left = parseInt( pane.css( 'left' ).replace( 'px', '' ) ), slideBy = ulWidth;
                            left = isNaN( left ) ? 0 : left;
                            m_preFullWidthPanelDataLeft = left;
                            
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
                    }else {
                        //  $("ul li.panelData").css("display", "block"); // this will show all grids
                        if(typeof(Storage)!=="undefined") {
                            var title=liNode.find( '.panel-title' ).text();
                            var t = trim1(title);
                            var t1 = t.split(" ");
                          
                            var ser = t1[0];
                            var cols=localStorage[ser];
                            if(cols==1){
                                selectedComponent.data('fullWidth',false);
                                selectedComponent.css({
                                    width : "245px"
                                }).find( ".hd" ).hide();
                            }
                            else if(cols==2){
                                selectedComponent.data('fullWidth',false);
                                selectedComponent.css({
                                    width : "350px"
                                }).find( ".hd" ).show();
                            }
                            else if(cols==3){
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
                            
                            var pane = $( 'ul.services-list' );
                           pane.animate({
                                left : m_preFullWidthPanelDataLeft
                           }); 
                        }//end is storage
                        else{
                            selectedComponent.data('fullWidth',false);
                            selectedComponent.css({
                                width : "475px" 
                            }).find( ".hd" ).show();
                        }
                        sliding=true;                  
                    }
                  }else {
                        var selectedComponent=$(this);
                        selectedComponent.toggle();
                       // $("ul li.panelData").css("display", "block"); // this will show all grids
                  }
                }
            });
                
            var vcontainer = liNode.find( 'div.video-container' ); 
            if($(vcontainer).length > 0)
                vcontainer.tinyscrollbar_update(); 
        });
        
        $( 'div.sliders' ).click( function() {
            var isLeftArrow = false;
            var thisArrowLeft =  $( this ).offset().left;
            var thisArrowWidth =  $( this ).width();
            if( $( this ).hasClass( 'p-arrow-left' ) ) 
                isLeftArrow = true;
                           
            if(sliding==true){
               var ulWidth = 0;
               var boxWidth = 0;
               var boxLeft = 0;
               
               var lastBox = null;
               var newLeft = 0;
               var isNewLeftSet = false;
               
               
               $("ul li.panelData").each(function() {
                    boxWidth = $(this).width();
                    boxLeft = $(this).offset().left; 
                    ulWidth = ulWidth + boxWidth;   

                    if(!isNewLeftSet) {
                        if(isLeftArrow){
                            if(boxLeft > thisArrowLeft){  
                                newLeft = (lastBox.position().left) * -1;
                                newLeft = newLeft > 0 ? 0 : newLeft;
                                isNewLeftSet = true;
                            }
                        }
                        else {   
                            if((boxLeft+boxWidth) > thisArrowLeft){  
                                newLeft = ($(this).position().left) * -1;
                                newLeft += (thisArrowLeft - boxWidth - thisArrowWidth - 45);
                                isNewLeftSet = true;
                            }
                        }
                    } 
                    lastBox = $(this);
               });  
                
               if(isNewLeftSet) {
                   var pane = $( 'ul.services-list' );
                   pane.animate({
                        left : newLeft
                   }); 
               }
                /*
                var pane = $( 'ul.services-list' ), left = parseInt( pane.css( 'left' ).replace( 'px', '' ) ), slideBy = movBoxWidth;     
                left = isNaN( left ) ? 0 : left;
                
                if( isLeftArrow ) {
                    
                    //newLeft = left + slideBy;
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
                    var minLeft = (containerWidth - childsWidth) - 30;
                    minLeft = minLeft > 0 ? 0 : minLeft;
                    //newLeft = left - slideBy;
                    newLeft = newLeft < minLeft ? minLeft : newLeft;
                    var widthp = newLeft * -1;
                    //if(widthp < ulWidth){
                        pane.animate({
                            left : newLeft
                        });
                    //}
                }
                 */
            } else {
               var fullBox = null;
               var preBox = null;
               var nexBox = null;
               var fullIndex = null;
               var myArray = [];
               var myIndex = 0;
               $("ul li.panelData").each(function() {
                   myArray[myIndex] = $(this);
                   if($(this).css("display") == "block") {
                        fullIndex = myIndex;
                    }
                   myIndex++;
               });
               if(fullIndex != null) {
                   fullBox = myArray[fullIndex];
                   if(fullIndex > 0)
                    preBox = myArray[fullIndex-1];
                   else
                    preBox = myArray[myArray.length-1];
                  
                   if(fullIndex < (myArray.length - 1))
                    nexBox = myArray[fullIndex+1];
                   else
                    nexBox = myArray[1];
                   var fullBoxLeft = fullBox.width();
                   var pane = $( 'ul.services-list' );  
                   if(!isLeftArrow){
                       fullBox.css("width",nexBox.width());
                       pane.css("left",-preBox.width());
                       nexBox.css("width", fullBoxLeft);
                       
                       fullBox.css("display","none");
                       nexBox.css("display","block"); 
                       
                       selectedComponent = nexBox; 
                   }
                   else {
                       fullBox.css("width",preBox.width());
                       pane.css("left", preBox.width());
                       preBox.css("width", fullBoxLeft);
                       
                       fullBox.css("display","none"); 
                       preBox.css("display","block"); 
                       
                       selectedComponent = preBox;
                   }
                   fullBox.data('fullWidth',false);
                   selectedComponent.data('fullWidth',true);
               }
               pane.animate({
                    left : 0
               }); 
               var vcontainer = selectedComponent.find(".video-container"); 
               if($(vcontainer).length > 0)
                    vcontainer.tinyscrollbar_update(); 
           }//end if sliding
        }).find( 'img' ).hover( function() {
            this.src = $( this ).attr( 'mouseinpic' );
            }, function() {
                this.src = $( this ).attr( 'mouseoutpic' );
        });

        } catch(e){
            console.log(e);
        }
// -- End Of document ready -- //     
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
            if(data.current_page > 1)
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
    //return;
    $("#"+parameters.searchType+"loader").show();
    $("#"+parameters.searchType+"Thumb").fadeOut(1000);
    
   // console.log(parameters);
    //call Ajax Requests to call Results
    try{
        $.getJSON(
        
           //"http://localhost/findingfootageproject1/ffservices/public/index.php",
           "http://www.findingfootage.com/ffservices/public/index.php",
            parameters,

            function(data) {
                if(data){
                    //console.log("we recv data");
                    //console.log(data.videoObjects);
                    var searchType = parameters.searchType;
                    
                    var count = 1;
                    var itemsperpage = data.items_per_page;
                    var dataObjects = null;
                    if(searchType=="All"){
                        jQuery.each(data.videoObjects , function(index, json){
                            if(dataObjects == null){
                                dataObjects = json.videoObjects;
                            }else{
                     
                                dataObjects = dataObjects.concat(json.videoObjects); 
                            }
                        });
                        dataObjects = shuffle(dataObjects);
                    }
                    else {
                        dataObjects = data.videoObjects;   
                    }
                        
                    if(dataObjects == ""){
                        // -- No Data -- //
                        $("#"+searchType+"Thumb").html("<li><br><strong>Sorry No Results Found</strong></li>");
                        
                    }
                    else { 
                        $("#"+searchType+"Thumb").empty();
                        $("#videoTemplate" ).tmpl( dataObjects ).appendTo( "#"+searchType+"Thumb" );
                        $("#"+data.videoObjects.videoServiceId).data('videoData',JSON.stringify(data.videoObjects));
                        
                        count = 1;
                        $.each(dataObjects, function() {
                            if(count <= itemsperpage){
                                $("#"+this.videoServiceId).data('videoData',this);
                                
                                stWidget.addEntry({
                                    "service":"sharethis",
                                    "element":document.getElementById(this.videoServiceId+'_share'),
                                    "url":this.videoDollor,
                                    "title":this.videoName,
                                    "image":this.thumbURL,
                                    "summary":"Sharing is great! Its fun to share Videos from www.findingfootage.com"
                                }); 
                            }
                        });
                    }
                    
                    $("#"+searchType+"loader").hide();
                    $("#"+searchType+"Thumb").fadeIn(1000);
                    if($("#"+searchType+"scroll").length > 0){
                        var vcontainer = $("#"+searchType+"container");
                        if($(vcontainer).length > 0)
                            vcontainer.tinyscrollbar_update();
                    }
                }
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

function openVideoDetailDialog(url,videoThumbId) {
    openVideoDetailDialog(url,videoThumbId,true);    
}
function openVideoDetailDialog(url,videoThumbId, blank) {
    var data1=$('#data'+videoThumbId).html();

    if(data1!='' && data1!=null && data1!=undefined){
        $('#'+videoThumbId).data('videoData',data1);
    }
    
    videoDetails=$('#'+videoThumbId).data('videoData');
       
    if( typeof videoDetails === 'string' ) {
         videoDetails=jQuery.parseJSON(videoDetails);
    }
    videoDetails['videoId'] = videoThumbId;
    console.log(videoDetails);
    var recursiveEncoded = $.param(videoDetails);
    var recursiveDecoded = decodeURIComponent($.param(videoDetails));
    //recursiveEncoded += "&id=" + videoThumbId;
    
    redirectURL=url+"?"+recursiveEncoded;
    //alert(redirectURL);
    if(blank == false){
        window.location.href = redirectURL;
    }
    else {
        window.open(redirectURL, '_blank');
        window.focus();
    }
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



function openDialog(dialogId)
{    
    $("#"+dialogId).dialog("open");
}

function openAddDialog()
{    
    selectedVideoThumbsData = getAllSelectedVideoThumbsData();
    if(selectedVideoThumbsData != ""){
        //updatefoundboxselected();
        $("#adddialog").dialog("open");  
        $('#FoundboxPopuForm_foundBoxVideos').val(JSON.stringify(selectedVideoThumbsData));       
        //alert($('#FoundboxPopuForm_foundBoxVideos').val());
        deSelectallVideoThumbs();
    }else{
        alert("Please Select Clips");
    }
}
function openAddFavDialog(favVideoThumbId)
{
    updatefoundboxselected();                   
    $("#adddialog").dialog("open");
    var selectedVideoThumbsData = new Array();
    selectedVideoThumbsData.push($('#'+favVideoThumbId).data('videoData'));
    console.log(JSON.stringify(selectedVideoThumbsData));
    $('#FoundboxPopuForm_foundBoxVideos').val(JSON.stringify(selectedVideoThumbsData));
    
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

function gotoMayFoundBoxes(blank) {
    redirectURL = "/videogridengine/index.php/foundboxes/index?Foundbox_page=1&Myboxs";
    if(blank == true){
        window.open(redirectURL, '_blank');
        window.focus();    
    }
    else {
        window.location.href = redirectURL;
    }
}

function gotoAllFoundBoxes(blank) {
    redirectURL = "/videogridengine/index.php/foundboxes/index?Foundbox_page=1";
    if(blank == true){
        window.open(redirectURL, '_blank');
        window.focus();    
    }
    else {
        window.location.href = redirectURL;
    }
}



