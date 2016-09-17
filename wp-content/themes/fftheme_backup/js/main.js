function loadData(url, id, sync, type) {
    var origHtml = $( "#"+id ).html();
    var async = true;
    if(sync) async = false;
    if(!type) type = "GET";
    $( "#"+id ).empty();
    $( "#"+id ).append( $( "#loading" ).html());

    $.ajax({
        type: type,
        async: async,
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
            //alert( "Request failed: " + errorThrown );
        });

    return data;
}
function getBoxHtml(url,id) {
    var html = getData(url);
    setBoxHtml(id,html);
}
function setBoxHtml(id,html) {
    if(html != "") {
        $( "#"+id ).empty();
        $( "#"+id ).append( html );
    }
}
function searchVideo(e)
{


    if (e.keyCode == 13) {

        var searchKeyword = document.getElementById("searchItem").value;

        if(searchKeyword != "") {
            StartSearch(searchKeyword);
            return true;
        }
        else
        {
            var searchKeyword = document.getElementById("searchItem").value="Search";

        }
    }

}

function StartSearch(text) {
    gotoUrl="/videogridengine/index.php/search?SearchBarForm%5BsearchKeywords%5D="+text;
    mainsite="<?php echo get_site_url(); ?>";
    //alert(gotoUrl);
    window.window.location.href=mainsite+gotoUrl+"&direction=h";
}

function SwapImage(ImageUrl,Control)
{
    Control.src = ImageUrl;

}

$( document ).ready(function() {

    $("#open").click(function(){
        $("div#iRPanel").slideDown("slow");
    });
    $("#close").click(function(){
        $("div#iRPanel").slideUp("slow");
    });
    $("#toggle a").click(function () {
        $("#toggle a").toggle();
    });
});