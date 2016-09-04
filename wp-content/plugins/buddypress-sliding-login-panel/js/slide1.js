jQuery.noConflict(); jQuery(document).ready(function() { 
jQuery("#open").click(function(){ jQuery('.tab').css('position','relative'); jQuery("div#iRPanel").slideDown("slow");}); jQuery("#close").click(function(){ jQuery('.tab').css('position','absolute'); jQuery("div#iRPanel").slideUp("fast");}); jQuery("#toggle a").click(function () { jQuery("#toggle a").toggle();});}); 


