this.imagePreview = function () {
    if (jQuery.browser.mobile) {
        //console.log('Client are using a mobile device!');
        return;
    }
    else {
        //console.log('Client are not using a mobile device!');
    }

    /* END CONFIG */
    $(".img").hover(function (e) {
            if ($("#preview").length > 0)
                $("#preview").remove();
            $("body").append("<div id='preview'></div>");

            var height = $("#preview").height();
            var width = $("#preview").width();
            videoURL = this.id;
            videoURL = videoURL.replace("&amp;", "&");
            if (videoURL != "") {
                //console.log(videoURL);
                var iFrameSrc = getIFramSrc(videoURL);
                if (iFrameSrc != null && iFrameSrc.length > 0) {
                    var html = "<iframe width='100%' height='100%' src='" + iFrameSrc + "' frameborder='0'></iframe>";
                    $("#preview").append(html);
                } else if (playWithFlowplayer(videoURL)) {

                    $f("preview", playerVar, {
                        clip: {
                            url: videoURL,
                            autoPlay: true,
                            autoBuffering: true
                        },
                        plugins: {
                            controls: null
                        },
                        onLoad: function () {

                        }
                    });
                } else {
                    $("#preview").append("<video poster='/videogridengine/images/loading.gif' autoplay='autoplay' width='100%' height='100%' id='preview_video' name='media' style='background:black'><source src='" + videoURL + "' type='video/mp4'></video>");
                    //$("#preview").append("<img id='preview_video_loading' src='/wp-content/themes/fftheme/images/loader.gif'/>");
                    $('#preview_video').on('loadstart', function (event) {

                    });

                    $('#preview_video').on('canplay', function (event) {
                        //$('#preview_video').css("display",  "block");
                        //$('#preview_video_loading').css("display",  "none");
                    });
                }
                $('#videoplayer').attr('href', videoURL);
                var top = e.pageY + 10;
                var left = e.pageX + 30;
                if (top + height > $(window).scrollTop() + $(window).height()) {
                    top = e.pageY - height - 10;
                }
                if (left + width > $(window).width()) {
                    left = e.pageX - width - 30;
                }

                $("#preview").css("top", top + "px").css("left", left + "px").fadeIn("fast");
            }
        },
        function () {
            this.title = "";
            if ($("#preview").length > 0)
                $("#preview").remove();
        });
    $(".img").mousemove(function (e) {
        var preview = $("#preview");
        if (preview.length > 0) {
            var height = preview.height();
            var width = preview.width();
            var top = e.pageY + 10;
            var left = e.pageX + 30;
            if (top + height > $(window).scrollTop() + $(window).height()) {
                top = e.pageY - height - 10;
            }
            if (left + width > $(window).width()) {
                left = e.pageX - width - 30;
            }

            preview.css("top", top + "px").css("left", left + "px");
        }
    });
};


// starting the script on page load
$(document).ready(function () {
    imagePreview();
});

function playWithFlowplayer(url) {
    var urlLC = url.toLowerCase();
    if (endsWith(urlLC, ".flv")
        || endsWith(urlLC, ".mp4")
        || endsWith(urlLC, ".mov")) {
        return true;
    }
    return false;
}
function playDetailWithFlowplayer(url) {
    var urlLC = url.toLowerCase();
    if (endsWith(urlLC, ".flv")

        || endsWith(urlLC, ".mov")) { // || endsWith(urlLC,".mp4")
        return true;
    }
    return false;
}

function getIFramSrc(url) {
    if (endsWith(url, "__iframe__")) {
        url = url.replace("&__iframe__", "")
        if (!isExists(url, "?"))
            url = url + "?";
        else
            url = url + "&";
        url = url + "autoplay=true";

        return url;
    }
    /*
     var regex = /<iframe.*?src="(.*?)"/;
     var src = regex.exec(str);
     if(src == null){
     regex = /<iframe.*?src='(.*?)'/;
     src = regex.exec(str);
     }
     if(src.length > 1)
     return src[1];
     */
}

function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

function isExists(str, suffix) {
    return str.indexOf(suffix) !== -1;
}