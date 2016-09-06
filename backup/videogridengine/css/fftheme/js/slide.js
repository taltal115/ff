 $(document).ready(function() { 
     $("#open").click(function(){ 
         $("div#iRPanel").slideDown("slow");
     }); 
     $("#close").click(function(){ 
         $("div#iRPanel").slideUp("slow");
     }); 
     $("#toggle a").click(function () { 
         $("#toggle a").toggle();
     });
 }); 