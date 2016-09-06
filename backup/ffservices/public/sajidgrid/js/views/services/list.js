// Filename: views/services/list
define([
    'jquery',
    'underscore',
    'backbone',
    // Pull in the Collection module from above
    'collections/services',
    'text!templates/services/list.html',
    'views/services/servicepanel'

], function ($, _, Backbone, servicesCollection, servicesListTemplate, servicePanelView) {
    var servicesListView = Backbone.View.extend({
        el:$("#services-panel"),
        me:this,

        initialize:function () {
            searchKeyword = window.searchingKeyword;
            window.servicesPanels = new Array();

            // this.collection = servicesCollection;
            // this.collection.bind("add", this.exampleBind);
            // this.collection = servicesCollection.add({ name: "Twitter"});
            // this.collection = servicesCollection.add({ name: "Facebook"});
            // this.collection = servicesCollection.add({ name: "Myspace", score: 20});
        },
        exampleBind:function (model) {
            //console.log(model);
        },
        searchVideos:function (searchObject) {
            var jsonSource = window.servicesURL;
            var self = this;
            window.mainSearchObject = searchObject;
            servicesCollection.url = jsonSource;
            servicesCollection.fetch({
                data:searchObject.toJSON(),
                processData:true,
                silent:true,
                success:function () {
                    console.log(servicesCollection);
                    //var servicesPanels =dataObjects.at(0).toJSON();//videoObjects;
                    if (servicesCollection.length > 0) {
                        self.extractData(servicesCollection.at(0).toJSON(), self);
                    } //send JSON for rendreing
                    else {
                        var noResultsTemplate = "No Results Found";
                        self.render(noResultsTemplate);
                    }
                    //console.log(servicesCollection.at(0).get('videoObjects'));
                }

            });


            // $.getJSON(jsonSource, searchObject.toJSON(), this.extractData);


        },
        extractData:function (dataObjects, displayObject) {

            //search text and items per page is empty
            window.mainSearchObject.set({
                current_page:dataObjects.current_page,
                items_per_page:dataObjects.abc,
                load_first_page:dataObjects.items_per_page,
                noOfColumns:dataObjects.noOfColumns,
                noOfColumns:dataObjects.noOfColumns,
                offset:dataObjects.offset,
                searchLanguage:dataObjects.searchLanguage,
                searchText:dataObjects.searchText,
                searchType:dataObjects.searchType
            });


            var servicesPanels = dataObjects.videoObjects; //Get Services Panels


            // console.log(servicesPanels);
            ;


            for (servicepanel in servicesPanels) {
                //window.servicesPanels.push(servicesPanels[servicepanel]);
                displayObject.createServicePanel(servicesPanels[servicepanel]);
                //console.log(servicepanel);
            }
            console.log(window.servicesPanels);


        },
        createServicePanel:function (serviceObject) {
            //console.log("create Service Panel Called" + serviceObject);
            //console.log(serviceObject);
            //Create Service Panel Object fill the data and compile into template
            servicePanelViewObject = new servicePanelView({id:serviceObject.serviceType,el :$("#serviceslist")});
            serviceview = servicePanelViewObject.render(serviceObject);
            window.servicesPanels.push(servicePanelViewObject);


        },
        addVideo:function (container, videosObjects) {

        },
        showLoaddingBar:function (status, display) {
            //for data retriving show data bar and if we dont have data in screen hide scrollers

        },
        events:{
            "click .x1":"count",
            "click .x2":"expand",
            "click .x3 ":"close",
            "click .x4":"xooma",
            "click .x5":"xoomb",
            "click .x6":"xoomc"

        },
        count:function(event){
            var target = event.currentTarget;
            console.log(target);
            var tid = target.id;
            var tids = tid.split("_");
            var id = "#"+tids[0];
        },
        expand:function(event){
            alert('hi');
            var target = event.currentTarget;
            console.log(target);
            var tid = target.id;
            var tids = tid.split("_");
            var id = "#"+tids[0];

            var maxwidth = "480px";
            var currentwidth = $(id).css("width");
            console.log(currentwidth);
            if(currentwidth == maxwidth){
                $(id).css("width",200);
            } else{
                $(id).css("width",480);
            }

        },
        close:function(event){
            var target = event.currentTarget;
            console.log(target);
            var tid = target.id;
            var tids = tid.split("_");
            var id = "#"+tids[0];
            $(id).hide();

        },
        xooma:function(event){
            var target = event.currentTarget;
            var tid = target.id;
            var tids = tid.split("_");
            var id = "#"+tids[0];
            $(id).css("width",200);
        },
        xoomb:function(event){
            var target = event.currentTarget;
            var tid = target.id;
            var tids = tid.split("_");
            var id = "#"+tids[0];
            $(id).css("width",360);
        },
        xoomc:function(event){
            var target = event.currentTarget;
            var tid = target.id;
            var tids = tid.split("_");
            var id = "#"+tids[0];
            $(id).css("width",480);
        },
        nextpage:function(){
            var nextpage = parseInt(this.currentPage, 10);
            console.log(nextpage);
            nextpage = nextpage + 1;
            window.location ="#searchvideos/"+this.searchText+"/"+nextpage;
        },
        prevpage:function(){
            var previouspage = parseInt(this.currentPage, 10);
            previouspage = previouspage - 1;
            if(this.currentPage >= 2){
                window.location ="#searchvideos/"+this.searchText+"/"+previouspage;
            }
        },
        tooltip:function(event){
            var target = event.currentTarget;
            var id = target.className;
            var ids = id.split("_");
            var clipnum = ids[1];
            var serviceraw = ids[0];
            var clip = this.serviceResults[serviceraw][clipnum];
            var clipflv = clip.flv;
            //alert(clipflv);

            var properties = {};
            var elid = "#"+id;
            properties.height = $(elid).css("height");
            properties.width = $(elid).css("width");
            properties.offset = $(elid).offset();
            // alert(properties.offset.left);
            var clipflvarray = clipflv.split(".");
            var clipflvarraylength = clipflvarray.length;
            var clipflvtypeid = clipflvarraylength - 1;
            var cliptype = clipflvarray[clipflvtypeid];
            var clipwrapper ;
            switch(cliptype){
                case "flv" : default :
                clipwrapper = "<embed src=\"http://freevideocoding.com/flvplayer.swf?file="+clipflv+"&autoStart=true\" width=\"320\" height=\"240\" quality=\"high\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></embed>"
                break;
                case "mp4":
                    clipwrapper = "<video width=\"320\" height=\"240\" autoplay=\"autoplay\" controls=\"controls\"><source src=\""+clipflv+"\" type=\"video/mp4\" />Your browser does not support the video tag.</video> ";
                    break;
            };
            $("#dhtmltooltip").show();
            ddrivetip(clipwrapper,'#2E0854');




        },
        closetooltip:function(){
            $("#dhtmltooltip").html(" ");
            $("#dhtmltooltip").hide();
            hidedrivetip();
        },
        selectvideo:function(event){
            var target = event.currentTarget;
            var id = target.id;
            var ids = id.split("_");
            var clipnum = ids[1];
            var serviceraw = ids[0];
            var clip = this.serviceResults[serviceraw][clipnum];

            if(this.selectedVideos[serviceraw]== undefined){
                this.selectedVideos[serviceraw]=[];
            }
            if(this.selectedVideos[serviceraw][clipnum]== undefined){
                this.selectedVideos[serviceraw][clipnum] = [];
                this.selectedVideos[serviceraw][clipnum]["name"]=clip.name;
                this.selectedVideos[serviceraw][clipnum]["dollar"]=clip.dollar;
                this.selectedVideos[serviceraw][clipnum]["flv"]=clip.flv;
                alert(this.selectedVideos[serviceraw][clipnum]["name"] +" "+ serviceraw + "  clip number " + clipnum + " has being added to selection");
            }else{
                delete this.selectedVideos[serviceraw][clipnum];
                alert( serviceraw + "  clip number " + clipnum+ " has already being removed from selection" );
            }


        },
        render:function (searchObject) {
            console.log("element");
               console.log(this.el);
            $("#services-panel").html(servicesListTemplate); //
            this.showLoaddingBar(true, this);
            this.searchVideos(searchObject);


            // var data = {
            // services: this.collection.models,
            // _: _
            // };
            //var compiledTemplate = _.template( servicesListTemplate, data );
            //  $("#services-panel").html(template);
        },


    });
    return new servicesListView;
});
