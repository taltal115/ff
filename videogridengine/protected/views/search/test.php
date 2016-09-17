<link type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/jquery-ui.css" rel="Stylesheet" />

<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/main_1.js"></script>
<script type="text/javascript">
    
   var playerVar="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf";

</script>

<style type="text/css">

                #preview{
	position:absolute;
        border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
        width: 260px;
        height: 190px;
        top:auto;
        left: auto;
        margin: auto;
        border-radius:8px;
	} 
        .video img {
            cursor: pointer;
 }
 </style>
  

<?php

//Add JS at run time in header




// Get View Variables
$itemToSelect = Yii::app()->params ['selected_num_item'];Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/css/fftheme/js/flowplayer-3.2.6.min.js', CClientScript::POS_HEAD);
$paginationCols = explode(',', Yii::app()->params ['paginationcols']);
$haveResults = false;

if (isset($jsondata)) {
    $haveResults = true;
    $servicesPanels = $jsondata ['videoObjects'];
} else {
    // leave this fo rnow
    //load no results template
    $this->renderPartial('_noresults');
    Yii::app()->end();
}

//put condition which  view u want to render
$pageDirection =Yii::app()->request->getQuery('direction');
if (!isset($pageDirection))
    $pageDirection = 'h';



switch ($pageDirection) {
    case "h":
        $this->renderPartial('_hgrid', array(
        'servicesPanels' => $servicesPanels
                ));
        break;
    case "v":
        $this->renderPartial('_vgrid', array(
        'servicesPanels' => $servicesPanels
            ));
        break;
    case "m":
 
         $this->renderPartial('_mix', array(
        'servicesPanels' => $servicesPanels
    ));
        break;
}


?>

<script type="text/javascript">
     $(document).ready(function() {
        // Handler for .ready() called.
        var text = $('#SearchBarForm_searchKeywords').val();  
        StartSearch(text); 
        /*
        setTimeout(function(){ 
            var text = $('#SearchBarForm_searchKeywords').val();  
            StartSearch(text);  
        }, 3000);
        */ 
    });
    function StartSearch(text)
    {
<?php
        if(isset($servicesPanels)) {
            $servicesPanelsJs = $servicesPanels;
            $servicesPanelsJs[] = array("serviceType" => "All");
            foreach ($servicesPanelsJs as $servicePanel) { 
            $serviceName = $servicePanel['serviceType'];
            echo "      // -- $serviceName -- //\r\n";
            echo "      if(typeof servicPanel$serviceName !== 'undefined') {\r\n";
            echo "          servicPanel$serviceName.current_page = 1;\r\n";
            echo "          servicPanel$serviceName.searchText = text;\r\n";
            echo "          submitAjaxRequest(servicPanel$serviceName,'$serviceName','');\r\n"; 
            echo "      }\r\n";
            }
            
        } 
?>    
    }  
</script>

