<?php
$user_ID = $userdata->ID;   

$show_email_check = "";
$show_email = esc_attr( get_the_author_meta( 'show_email', $user_ID));
if(trim($show_email) > 0 ) $show_email_check = "checked='checked'";    
?>    
<div class="user_edit_form" >
    <?php 
        //echo get_avatar($user_ID, 96); 
        //echo get_wp_user_avatar($user_ID, 96); 
        echo get_wp_user_avatar($user_ID, 'thumbnail');
        echo '<a href="'.Yii::app()->baseUrl.'/avatar" style="margin-left:20px;">Change My Avatar</a>';
        echo $usermsg; 
    ?>
    
    <form name="profile" action="" method="post">
        <?php wp_nonce_field('update-profile_' . $user_ID) ?>
        <input type="hidden" name="from" value="profile" />
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
        <input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />   
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_ID; ?>" />
        
        <div class="top_titles">
        NICKNAME: <BR><input type="text" name="nickname" value="<?=$userdata->user_nicename?>" /></div>
        <div class="top_titles">
        FIRST NAME: <BR><input type="text" name="first_name" value="<?=$userdata->first_name?>" /></div>
        <div class="top_titles">
        LAST NAME: <BR><input type="text" name="last_name" value="<?=$userdata->last_name?>" /></div>
        <div class="top_titles">
        EMAIL: <BR><input type="text" name="email" value="<?=$userdata->user_email?>" /></div>
        <div><input style="margin: 3px 0 0 0;" name="show_email" type="checkbox" <?=$show_email_check?> value="1" /> DISPLAY MY EMAIL TO OTHERS</div>
        <div style="margin-top: 20px;">
            <div class="group_title">
            SOCIAL LINKS</div>
            <div class="group">
                <div class="sub_title">
                YOUTUB: <BR><input type="text" name="youtub" value="<?=esc_attr( get_the_author_meta( 'youtub', $user_ID) );?>" /></div>
                <div class="sub_title">
                VIMEO: <BR><input type="text" name="vimeo" value="<?=esc_attr( get_the_author_meta( 'vimeo', $user_ID) );?>" /></div>
                <div class="sub_title">
                FACEBOOK: <BR><input type="text" name="facebook" value="<?=esc_attr( get_the_author_meta( 'facebook', $user_ID) );?>" /></div>
            </div>
            <div class="group_title">
            ARTIST INFO</div>
            <div class="group">
                <div class="sub_title">
                COMPANY: <BR><input type="text" name="company" value="<?=esc_attr( get_the_author_meta( 'company', $user_ID) );?>" /></div>
                <div class="sub_title">
                CONTRY: <BR><input type="text" name="contry" value="<?=esc_attr( get_the_author_meta( 'contry', $user_ID) );?>" /></div>
            </div>
            <div class="group_title">
            PROFESSION</div>
            <div class="group">
                <textarea name="profession" rows="6" cols="50"><?= esc_attr( get_the_author_meta( 'profession', $user_ID) ); ?></textarea>
            </div>
            <div class="group_title">
            SKILLS</div>
            <div class="group">
                <textarea name="skills" rows="6" cols="50"><?= esc_attr( get_the_author_meta( 'skills', $user_ID) ); ?></textarea>
            </div>
            <div class="group_title">
            LINKS</div>
            <div class="group">
                <div class="sub_title">
                WEBSITE: <BR><input type="text" name="url" value="<?=$userdata->user_url?>" /></div>
                <div class="sub_title">
                SHOWREEL: <BR><input type="text" name="showreel" value="<?=esc_attr( get_the_author_meta( 'showreel', $user_ID) );?>" /></div>
            </div>
            <div class="group_title">
            I SELL MORE FOOTAGE HERE</div>
            <div class="group">
                <textarea name="sellhere" rows="6" cols="50"><?=esc_attr( get_the_author_meta( 'sellhere', $user_ID) );?></textarea>
            </div>
        </div>
        
        <div class="change_password">
            <div class="title">
            Change Your Password </div>
            <?php wp_nonce_field('update-profile_' . $user_ID);
            $show_password_fields = apply_filters('show_password_fields', true);
            if ( $show_password_fields ) :
            ?>
            <div><input type="password" name="pass1" class="mid2" id="pass1" placeholder="Enter Old Password" size="35" maxlength="50" value="" /></div>
            <div><input type="password" name="pass1" class="mid2" id="pass1" placeholder="Enter New Password" size="35" maxlength="50" value="" /></div>
            <div><input type="password" name="pass2" class="mid2" id="pass2" placeholder="Re-enter password" size="35" maxlength="50" value="" /></div>
            <div>Your User Name Is <b><?=$userdata->user_login?><b></div>
            <?php endif; ?>
        </div>
        
        <div style="margin-top: 20px;">
            <input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-profile-nonce'); ?>"/>
            <input class="btn btn-warning" style="font-size: 18px;background-color: #803cad; border: none; color: white; padding: 7px; border-radius: 5px;cursor:pointer;" type="submit" value="<?php _e('Update My Profile'); ?>"/>
            <input onclick="show_remove('Are you sure you want to remove your profile?')" class="btn-sm btn-danger" style="margin-left: 100px;background-color: rgb(239,173,77); border: none; color: white; padding: 5px; border-radius: 5px;cursor:pointer;" type="button" value="<?php _e('Remove My Profile'); ?>"/>
        </div>
        
        <?php
        do_action('profile_personal_options');
        ?>
    </form>
    
</div>

<?php
/** Start Widget **/
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'removeProfile',
    'options'=>array(
        'title'=>'Remove My Profile',
        'autoOpen'=>false,
        'modal'=>true,
        'buttons'=>array(
            'Remove'=>'js:function(){ post_remove("Profile removed successfully!");$(this).dialog("close");}',
            'Cancel'=>'js:function(){ $(this).dialog("close");}',
        ),
    ),
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
/** End Widget **/
/** Start Widget **/
// gotoUrl("'.wp_logout_url(get_permalink()).'"); 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'profileRemoved',
    'options'=>array(
        'title'=>'Remove My Profile',
        'autoOpen'=>false,
        'modal'=>true,
        'buttons'=>array(
            'Close'=>'js:function(){ $(this).dialog("close");}',
        ),
    ),
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
/** End Widget **/
?>
<script>
function show_remove(title) {
    $("#removeProfile").empty().append("<labe class='middle'>" + title + "</label>");
    $("#removeProfile").dialog("open"); 
}
function post_remove(title) {
    postData = {postAction:"REMOVE_PROFILE"};
    var retVal = postAjax(postData);
    //alert(retVal);
    if(!(retVal > 0)){
        title = "Error Removing The Profile!";    
    }
    $("#profileRemoved").empty().append("<labe class='middle'>" + title + "</label>");
    $("#profileRemoved").dialog("open"); 
    if(retVal > 0)
        setTimeout(function() { gotoUrl("index.php"); }, 3000);
}

</script>
