// Filename: router.js
define(['jquery', 'underscore', 'backbone', 'views/home/main', 'views/services/list', 'views/users/list', 'models/service'],

function($, _, Backbone, mainHomeView, servicesListView, userListView,servicesModel) {
	var AppRouter = Backbone.Router.extend({
		routes : {
			// Define some URL routes
			'searchvideos/:query' : 'showServices',
			
			
			'users' : 'showUsers',

			// Default
			'*actions' : 'defaultAction'
		},
		showServices : function(query) {
			// Call render on the module we loaded in via the dependency array
			// 'views/projects/list'
			console.log('should render services list interface1');
			searchObject=new servicesModel();
			//console.log(searchObject);
			//getting primary searchobject
			
				 searchObject.set(
                {
                    searchText: query,
                    current_page:1
                     
                    
                });
                
                console.log(searchObject);
               
			//Get your collection to Reterive , when the collection is fill ,create objects and change the view from it . from here we would call view only.
            //Use Events Binding when data arrive do something.
			servicesListView.render(searchObject);
//			servicesListView.render();
	},
		// As above, call render on our loaded module
		// 'views/users/list'
		showUsers : function() {
			userListView.render();
		},
		defaultAction : function(actions) {
			// We have no matching route, lets display the home page
			mainHomeView.render();
		}
	});

	var initialize = function() {
		window.servicesURL="http://localhost/findingfootageproject1/ffservices/public/index.php";
		var app_router = new AppRouter;
		Backbone.history.start();
	};
	return {
		initialize : initialize
	};
});
