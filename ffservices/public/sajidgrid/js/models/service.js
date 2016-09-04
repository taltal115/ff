define(['underscore', 'backbone'], function(_, Backbone) {
	var servicesModel = Backbone.Model.extend({
		defaults : {
			__className : undefined,
			sortOrder : undefined,
			searchText : "",
			searchType : "All",
			serviceType : undefined,
			noOfColumns : "25",
			searchLanguage : "1",
			//pagination parameters
			items_per_page : 10,
			num_display_entries : 11,
			current_page : 1,
			offset : 0,
			load_first_page : false,
			XDEBUG_SESSION_START : 'netbeans-xdebug',
			videoObjects : Array()
		},
		initialize : function() {
		}
	});
	return servicesModel;

});
