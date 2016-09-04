// Filename: views/services/list
define([
    'jquery',
    'underscore',
    'backbone',
    // Pull in the Collection module from above
    'models/service',
    'text!templates/services/videothumb.html'

], function ($, _, Backbone, servicesModel, videoThumbTemplate) {
    var videoThumbPanel = Backbone.View.extend({
       // el:$("#serviceslist"),
        initialize:function ()
        {
            searchKeyword = window.searchingKeyword;
        },
        exampleBind:function (model) {
            //console.log(model);
        },

        genereatePanel:function (data) {

//            $("#serviceslist").html("helo222");
//            this.render();
//            return;
            //data is json object of service and it should put the video in its model
//            console.log("videoThumb data: ");
//            console.log(data);

            var renderData = {
                services:data,
                _:_
            };
//
//            console.log("renderData: ");
//            console.log(renderData);
            //Just Render the Main panel view here
            var compiledTemplate = _.template(videoThumbTemplate, renderData.services);

//            console.log("compiledTemplate: ");
//            console.log(compiledTemplate);
           return compiledTemplate;

            //$("#services-list").html(videoThumbTemplate);

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

        render:function (videoObject) {

            //show general panel with data
            var spanel = this.genereatePanel(videoObject); // it would return compiled parent panel only no video objects
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
    return videoThumbPanel;
});
