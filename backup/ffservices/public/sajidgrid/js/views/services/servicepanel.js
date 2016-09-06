// Filename: views/services/list
define([
    'jquery',
    'underscore',
    'backbone',
    // Pull in the Collection module from above
    'models/service',
    'text!templates/services/servicepanel.html',
    'text!templates/services/videothumb.html'

], function ($, _, Backbone, servicesModel, servicePanelTemplate,videoThumbTemplate) {
    var servicePanelView = Backbone.View.extend({
       // el:$("#serviceslist"),
        initialize:function () {
            searchKeyword = window.searchingKeyword;


            // this.collection = servicesModel;
            // this.collection.bind("add", this.exampleBind);
            // this.collection = servicesModel.add({ name: "Twitter"});
            // this.collection = servicesModel.add({ name: "Facebook"});
            // this.collection = servicesModel.add({ name: "Myspace", score: 20});
        },
        exampleBind:function (model) {
            //console.log(model);
        },

//        events:{
//            "click .x1":"count",
//            "click .x2":"expand",
//            "click .x3 ":"close",
//            "click .x4":"xooma",
//            "click .x5":"xoomb",
//            "click .x6":"xoomc"
//
//        },
//        count:function(event){
//            var target = event.currentTarget;
//            console.log(target);
//            var tid = target.id;
//            var tids = tid.split("_");
//            var id = "#"+tids[0];
//        },
//        expand:function(event){
//            alert('hi');
//            var target = event.currentTarget;
//            console.log(target);
//            var tid = target.id;
//            var tids = tid.split("_");
//            var id = "#"+tids[0];
//
//            var maxwidth = "480px";
//            var currentwidth = $(id).css("width");
//            console.log(currentwidth);
//            if(currentwidth == maxwidth){
//                $(id).css("width",200);
//            } else{
//                $(id).css("width",480);
//            }
//
//        },
//        close:function(event){
//            var target = event.currentTarget;
//            console.log(target);
//            var tid = target.id;
//            var tids = tid.split("_");
//            var id = "#"+tids[0];
//            $(id).hide();
//
//        },
//        xooma:function(event){
//            var target = event.currentTarget;
//            var tid = target.id;
//            var tids = tid.split("_");
//            var id = "#"+tids[0];
//            $(id).css("width",200);
//        },
//        xoomb:function(event){
//            var target = event.currentTarget;
//            var tid = target.id;
//            var tids = tid.split("_");
//            var id = "#"+tids[0];
//            $(id).css("width",360);
//        },
//        xoomc:function(event){
//            var target = event.currentTarget;
//            var tid = target.id;
//            var tids = tid.split("_");
//            var id = "#"+tids[0];
//            $(id).css("width",480);
//        },
//        nextpage:function(){
//            var nextpage = parseInt(this.currentPage, 10);
//            console.log(nextpage);
//            nextpage = nextpage + 1;
//            window.location ="#searchvideos/"+this.searchText+"/"+nextpage;
//        },
//        prevpage:function(){
//            var previouspage = parseInt(this.currentPage, 10);
//            previouspage = previouspage - 1;
//            if(this.currentPage >= 2){
//                window.location ="#searchvideos/"+this.searchText+"/"+previouspage;
//            }
//        },
//        tooltip:function(event){
//            var target = event.currentTarget;
//            var id = target.className;
//            var ids = id.split("_");
//            var clipnum = ids[1];
//            var serviceraw = ids[0];
//            var clip = this.serviceResults[serviceraw][clipnum];
//            var clipflv = clip.flv;
//            //alert(clipflv);
//
//            var properties = {};
//            var elid = "#"+id;
//            properties.height = $(elid).css("height");
//            properties.width = $(elid).css("width");
//            properties.offset = $(elid).offset();
//            // alert(properties.offset.left);
//            var clipflvarray = clipflv.split(".");
//            var clipflvarraylength = clipflvarray.length;
//            var clipflvtypeid = clipflvarraylength - 1;
//            var cliptype = clipflvarray[clipflvtypeid];
//            var clipwrapper ;
//            switch(cliptype){
//                case "flv" : default :
//                clipwrapper = "<embed src=\"http://freevideocoding.com/flvplayer.swf?file="+clipflv+"&autoStart=true\" width=\"320\" height=\"240\" quality=\"high\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></embed>"
//                break;
//                case "mp4":
//                    clipwrapper = "<video width=\"320\" height=\"240\" autoplay=\"autoplay\" controls=\"controls\"><source src=\""+clipflv+"\" type=\"video/mp4\" />Your browser does not support the video tag.</video> ";
//                    break;
//            };
//            $("#dhtmltooltip").show();
//            ddrivetip(clipwrapper,'#2E0854');
//
//
//
//
//        },
//        closetooltip:function(){
//            $("#dhtmltooltip").html(" ");
//            $("#dhtmltooltip").hide();
//            hidedrivetip();
//        },
//        selectvideo:function(event){
//            var target = event.currentTarget;
//            var id = target.id;
//            var ids = id.split("_");
//            var clipnum = ids[1];
//            var serviceraw = ids[0];
//            var clip = this.serviceResults[serviceraw][clipnum];
//
//            if(this.selectedVideos[serviceraw]== undefined){
//                this.selectedVideos[serviceraw]=[];
//            }
//            if(this.selectedVideos[serviceraw][clipnum]== undefined){
//                this.selectedVideos[serviceraw][clipnum] = [];
//                this.selectedVideos[serviceraw][clipnum]["name"]=clip.name;
//                this.selectedVideos[serviceraw][clipnum]["dollar"]=clip.dollar;
//                this.selectedVideos[serviceraw][clipnum]["flv"]=clip.flv;
//                alert(this.selectedVideos[serviceraw][clipnum]["name"] +" "+ serviceraw + "  clip number " + clipnum + " has being added to selection");
//            }else{
//                delete this.selectedVideos[serviceraw][clipnum];
//                alert( serviceraw + "  clip number " + clipnum+ " has already being removed from selection" );
//            }
//
//
//        },
        genereatePanel:function (data) {

//            $("#serviceslist").html("helo222");
//            this.render();
//            return;
            //data is json object of service and it should put the video in its model
//            console.log("servicePanel data: ");
//            console.log(data);

            var renderData = {
                services:data,
                _:_
            };
//
         console.log("renderData: ");
            console.log(renderData);
            //Just Render the Main panel view here
            var serviceCompiledTemplate = _.template(servicePanelTemplate, renderData.services);
            var videoCompiledTemplate = _.template(videoThumbTemplate, renderData.services);

            console.log("videoCompiledTemplate: ");
            console.log(videoCompiledTemplate);

            console.log("serviceCompiledTemplate: ");
            console.log(serviceCompiledTemplate);
           return serviceCompiledTemplate;

            //$("#services-list").html(servicePanelTemplate);

            //it woudl take its main attributes
            //servicepapnelobject. fill attributs

            ///services loop every video in it and create video thumb view
//        window.serviceSearchObjects[data.serviceType].set({
//            current_page:dataObjects.current_page,
//            items_per_page:dataObjects.abc,
//            load_first_page:dataObjects.items_per_page,
//            noOfColumns:dataObjects.noOfColumns,
//            noOfColumns:dataObjects.noOfColumns,
//            offset:dataObjects.offset,
//            searchLanguage:dataObjects.searchLanguage,
//            searchText:dataObjects.searchText,
//            searchType:dataObjects.searchType
//        });
//
//        consol.log( window.serviceSearchObjects);

        },

        render:function (serviceObject) {

            //show general panel with data
            var spanel = this.genereatePanel(serviceObject); // it would return compiled parent panel only no video objects
            $("#serviceslist").append(spanel);
           console.log(this.el) ;

            //           $("#serviceslist").html("helo");
            // var data = {
            // services: this.collection.models,
            // _: _
            // };
            //var compiledTemplate = _.template( servicesListTemplate, data );
//      $("#services-panel").html( servicesListTemplate );

        }
    });
    return servicePanelView;
});
