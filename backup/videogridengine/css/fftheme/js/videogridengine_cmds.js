
// http://bootboxjs.com/examples.html
function show_dialog(title) {
    var form = $("<form class='delform form-inline'><labe class='middle'>" + title + "</label></form>");
    
    var div = bootbox.dialog({
        message: form,
        buttons: {
            "ok" : {
                "label" : "<i class='icon-ok'></i> OK",
                "className" : "btn-sm btn-primary", 
                "callback": function() {
                    return 1; 
                }
            } 
        }

    });
}

function getUrlParams() {
    var params={};window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(str,key,value){params[key] = value;});
    return params;
}

function gotoUrl(url) {
    window.location.href = url;
}
    
function postAjax(postData) { 
    // postData = {postAction:"CMD"};
    // var retVal = postAjax(postData);
    
    var retVal = "";
    
    postUrl = "/videogridengine/index.php/footage/post";
    $.ajax({
        type: "POST",
        async: false,
        url: postUrl,
        data: postData
    })
    .done(function( html ) {
        retVal = html;
        //showAlertMsg(html); 
    })
    .fail(function( jqXHR, textStatus ,errorThrown) {
        alert( "Request failed: " + errorThrown );
    });
    
    return retVal;
}