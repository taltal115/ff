define([
  'jquery',
  'underscore',
  'backbone',
  'models/service'
], function($, _, Backbone, servicesModel){
  var servicesCollection = Backbone.Collection.extend({
    model: servicesModel,
    initialize: function(){

   }
// ,
//      parse: function(response) {
//          console.log(response)
//
//      }

  });

  return new servicesCollection;
});
