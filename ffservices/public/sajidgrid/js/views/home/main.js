// Filename: views/home/main
define(['jquery', 'underscore', 'backbone', 'text!templates/home/main.html'], function($, _, Backbone, mainHomeTemplate) {

	var mainHomeView = Backbone.View.extend({

		el : $("#apppage"),
		render : function() {
			$("#services-panel").html(mainHomeTemplate);
		},
		events : {
			"keypress #searchbox" : "search"
		},
		search : function(event) {
			var _keycode = event.keyCode || event.charCode;
			if(_keycode === 13) {
				var searchKeyword = $("#searchbox").val();
				alert('I am going to search for ' + searchKeyword);
				window.open("#searchvideos/"+searchKeyword,"_self");
				window.searchingKeyword=searchKeyword; //Setting Global Searching Keyword
				//var href = "#searchvideos/" + searchKeyword + "/1";
				//window.location = href;
			}
		},
	});
	return new mainHomeView;
});
