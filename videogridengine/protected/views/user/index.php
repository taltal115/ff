<?php
 
$user_ID = $userdata->ID;   

$current_user = wp_get_current_user();
$show_email = esc_attr( get_the_author_meta( 'show_email', $user_ID));

function getValItem($val,$name){
    $ret = $val;
    if(isset($_GET['EDIT'])){
        $ret = "<input type='text' name='$name' value='$val' />"; 
    } 
    return $ret;
}    
?>   
    <table class="user_edit_form"><tr><td valign="top" style="width: 430px;">
    <div >
        <?php 
        //echo get_avatar($user_ID, 96); 
        //echo get_wp_user_avatar($user_ID, 96); 
        echo get_wp_user_avatar($user_ID, 'thumbnail');
        echo $usermsg; 
        
        $show_email_check = "";
        $show_email = esc_attr( get_the_author_meta( 'show_email', $user_ID));
        if(trim($show_email) > 0 ) $show_email_check = "checked='checked'";
        
        
        $fullname = $userdata->first_name; 
        if(trim($userdata->last_name) != ""){
            $fullname .= $fullname != ""?" ":"".$userdata->last_name;    
        } 
        if(trim($fullname) == ""){
            $fullname = $userdata->display_name;    
        }

        $fullwebsite = $userdata->user_url;
        if(trim($fullwebsite) != "")
            $fullwebsite = "<a target='_blank' href='$fullwebsite'>$fullwebsite</a>";
        
        $fullshowreel = esc_attr( get_the_author_meta( 'showreel', $user_ID));
        if(trim($fullshowreel) != "")
            $fullshowreel = "<a target='_blank' href='$fullshowreel'>$fullshowreel</a>";
        ?>
        
        
        <div class="top_titles">
        NAME: <?=$fullname?></div>
        <?if( $show_email >0 ){?>
        <div class="top_titles">
        EMAIL: <?=$userdata->user_email?></div>
        <?}
        $youtub = esc_attr( get_the_author_meta( 'youtub', $user_ID) );
        $vimeo = esc_attr( get_the_author_meta( 'vimeo', $user_ID) );
        $facebook = esc_attr( get_the_author_meta( 'facebook', $user_ID) );
        if(trim($youtub.$vimeo.$facebook)!=""){
        ?>
        <div style="position: relative; height: 105px; margin-bottom: 10px;">
        <?if(trim($youtub)!=""){?><a class="social-youtub" href="<?=$youtub;?>" target="_blank"></a><?}?>
        <?if(trim($vimeo)!=""){?><a class="social-vimeo" href="<?=$vimeo;?>" target="_blank"></a><?}?>
        <?if(trim($facebook)!=""){?><a class="social-facebook" href="<?=$facebook;?>" target="_blank"></a><?}
        }?>
        </div>
        <div style="margin-top: 20px;">
            <div class="group_title">
            ARTIST INFO</div>
            <div class="group">
                <div class="sub_title">
                COMPANY: <BR><input readonly="readonly" type="text" name="company" value="<?=esc_attr( get_the_author_meta( 'company', $user_ID) );?>" /></div>
                <div class="sub_title">
                CONTRY: <BR><input readonly="readonly" type="text" name="contry" value="<?=esc_attr( get_the_author_meta( 'contry', $user_ID) );?>" /></div>
            </div>
            <div class="group_title">
            PROFESSION</div>
            <div class="group">
                <textarea readonly="readonly" name="profession" rows="6" cols="50"><?= esc_attr( get_the_author_meta( 'profession', $user_ID) ); ?></textarea>
            </div>
            <div class="group_title">
            SKILLS</div>
            <div class="group">
                <textarea readonly="readonly" name="skills" rows="6" cols="50"><?= esc_attr( get_the_author_meta( 'skills', $user_ID) ); ?></textarea>
            </div>
            <div class="group_title">
            LINKS</div>
            <div class="group">
                <div class="sub_title">
                WEBSITE: <BR><div class="link" ><a target="_blank" href="<?=$userdata->user_url?>"><?=$userdata->user_url?></a></div></div>
                <div class="sub_title">
                SHOWREEL: <BR><div class="link" ><a target="_blank" href="<?=esc_attr( get_the_author_meta( 'showreel', $user_ID) );?>"><?=esc_attr( get_the_author_meta( 'showreel', $user_ID) );?></a></div></div>
            </div>
            <div class="group_title">
            I SELL MORE FOOTAGE HERE</div>
            <div class="group">
                <textarea readonly="readonly" name="sellhere" rows="6" cols="50"><?=esc_attr( get_the_author_meta( 'sellhere', $user_ID) );?></textarea>
            </div>
        </div>
        <?php if($current_user->ID == $user_ID){?>
        <div style="width: 420px; margin: 10px 0 0 0; text-align: right;">
            <a style="color: gray; text-decoration: none;" href="user/edit">EDIT</a>
        </div>
        <?}?>
        
    </div>
    </td>
    <td valign="top">
    <div style="float: left; margin-bottom: 30px; margin-left: 50px;">
        <div id="user_boxs">
                
        </div>    
    </div>
    </td></tr></table> 
<script type="text/javascript">
     var urlBoxs = "/videogridengine/index.php/footage/UserBoxsHtml";
     var idBoxs = "user_boxs";
     var m_BoxsTotal = 0;
     var m_BoxsIndex = 0;
    
     $(document).ready(function() {
        // Handler for .ready() called.
        var userId = '<?= $user_ID ?>'; 
        
        if(getUserBoxsHtml)    
            getUserBoxsHtml(urlBoxs + "?userId="+userId,idBoxs); 
     
    });
    
    function getUserBoxsHtml(url,id) {
        var html = getData(url);
        setUserBoxsHtml(id,html);
    }
    function setUserBoxsHtml(id,html) {
        if(html != "") {
            $( "#"+id ).empty();
            $( "#"+id ).append( html);
        }
    }
    
    function getData(url) {   
        var data = "";
        
        $.ajax({
            type: "GET",
            async: false,
            url: url,
            data: ""
        })
        .done(function( html ) {
            data = html;  
        })
        .fail(function( jqXHR, textStatus ,errorThrown) {
            alert( "Request failed: " + errorThrown );
        });
        
        return data;
    }
</script>
