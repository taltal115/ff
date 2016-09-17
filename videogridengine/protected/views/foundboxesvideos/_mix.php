<div style="visibility: hidden; display: none;"> 
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array('id' => 'videoBox', 'options' => array('title' => '', 'autoOpen' => false, 'modal' => false, 'height' => 240, 'width' => 320, 'resizable' => false)));

$this->endWidget('zii.widgets.jui.CJuiDialog');

// -- add clip dialog -- //
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'addclipdialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Save Selected Clips to Found Box',
        'autoOpen' => false,
        'modal' => true,
        'height' => 260,
        'width' => 400,
    ),
));

if (Yii::app()->user->name != "admin") {
    $this->renderPartial('../footage/nouserform');
} else {
    $this->renderPartial('../footage/addclipform');    
}
$this->endWidget('zii.widgets.jui.CJuiDialog');

$boxId = $_GET['id'];
$freeClipsId = '234';
?>
</div>

<style type="text/css">
.box_menu {
    float: left;
    padding: 35px 10px; 
    color: white; 
    cursor: pointer;
}
 
</style>
<script type="text/javascript">
function removeSelectedClips() {
    var ids = []; 
    $( '.thumb_checkBox:checked' ).each( function() {
        var id = $(this).attr("id").replace("_checkbox", "");
        var data = $("#data"+id).text();  
        ids.push(data); 
          
    });
    if(ids.length > 0) {
        openDialog('removeclipsdialog');
        $('#Foundbox_removeClips').val(JSON.stringify(ids));
    }
    else {
        alert("Please Select Clips To Remove");
    }
}
</script>
<div id="services-panel">

    <div id="mydiv">  </div>

    <div id="ver-services-Container">

        <ul class="ver-services-list">

            <li class="service">

                <?php 

                if($is_owner>=1)
                {
                     //echo CHtml::link('Edit Found Box', array('/users/foundboxvideos/index', 'id'=>$is_owner));   
                }
                ?>
                <div class="heading"> 

                    <div class="wrap">
                        <?php if($is_owner >= 1 || Yii::app()->user->name == "admin") { ?>
                        <?php          if($boxId == $freeClipsId){ ?>
                        <dir class="box_menu" onclick="openDialog('addclipdialog')">Add New Clip</dir>
                        <?php          } ?>
                        <dir class="box_menu" onclick="openDialog('editdialog')">Edit This Box</dir>
                        <dir class="box_menu" onclick="removeSelectedClips()">Remove Selected Clips</dir>
                        <dir class="box_menu" onclick="openDialog('removefoundboxdialog')">Delete FoundBox</dir>
                        
                        <?php }
                        //$fbUser = WP_User::get_data_by('id',$fbUserID);
                        $fbUser = get_userdata($fbUserID);
                        $fullname = $fbUser->first_name; 
                        if(trim($fbUser->last_name) != ""){
                            $fullname .= $fullname != ""?" ":"".$fbUser->last_name;    
                        } 
                        if(trim($fullname) == ""){
                            $fullname = $fbUser->display_name;    
                        }       
                        $fbUserFullName = $fullname; 
                        ?>
                        <?php if(!Yii::app()->user->isGuest){?>
                        <dir class="box_menu" onclick="gotoMayFoundBoxes(false)">My FoundBoxes</dir>
                        <?php } ?>
                        <a href="/videogridengine/index.php/user?id=<?=$fbUserID?>" class="box_menu" style="margin-left: 10px; color: rgb(255,164,0);">By <?=$fbUserFullName?></a>
                        <h1 style="float: right;padding: 25px 10px; color: white;"><?php echo $title; ?></h1>
                    </div>

                </div>

                <div class="video-list" >

                    <div class="video-container">

                        <div class="videos">



<?php

$this->widget('zii.widgets.CListView', array(

    'dataProvider'=>$dataProvider,

    'ajaxUpdate'=>false,

    'template'=>'{pager}{summary}{items}', // {pager}{sorter}{summary}{items}

    'itemView'=>'_view',

    'itemsTagName'=>'ul',

    'itemsCssClass'=>'ver-services-Container overview',

    'pager'=>array(

        'header'=>false,

        'maxButtonCount'=>'6',

        

    ),

    'sortableAttributes'=>array(

        'title',

        'status',

        'date_created',

        

    ),

));

?>                           

                        </div>

                    </div>

                </div>

                  



            </li>

        </ul>

        <div class="clear"></div>
    </div>

</div>
<div id="container"></div>

<?php 
/*
if($boxId == $freeClipsId){
    $cookiesUrls = $_SESSION["cookiesUrls"];
    if(isset($cookiesUrls)) {
        foreach($cookiesUrls as $key=>$url){   
            echo "<iframe src='$url' style='display: none;' height='0' ></iframe>";
        }
    }
}
*/
?>