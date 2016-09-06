<div class="form">
<div id="successbox">Foundboxes has been added succesfully</div>
    <form id="foundbox-form" action="/videogridengine/index.php/search/foundbox" method="post">    
    <p class="note" style=" text-align:left; padding:5px 5px 5px 10px;">
        Fields with <span class="required" style="color:#F00">*</span> are required.
    </p>

    <div class="row" style="border-bottom:1px solid #ccc; padding:10px">
    <label for="FoundboxPopuForm_SelectedFoundBox">Selected Found Box</label>        
    <select name="FoundboxPopuForm[selectedFBox]" id="FoundboxPopuForm_selectedFBox">
    </select>&nbsp&nbsp
    <input type="submit" name="yt0" value="Save" id="yt0" /><br/>
            
<input type="button" id="fboxx" value="Create" style="background:#803cad; color:#fff; border:1px solid #803cad; border-radius:5px; padding:4px;"/>
<input name="FoundboxPopuForm[foundBoxVideos]" id="FoundboxPopuForm_foundBoxVideos" type="hidden" />        
            </div><!-- row -->

     <div class="row" style="border-bottom:1px solid #ccc; padding:10px; ">
        <label for="FoundboxPopuForm_CreateFoundBox">Create Found Box</label>        <span style="padding-left:8px;"><input id="ytFoundboxPopuForm_isNewFBox" type="hidden" value="0" name="FoundboxPopuForm[isNewFBox]" /><input name="FoundboxPopuForm[isNewFBox]" id="FoundboxPopuForm_isNewFBox" value="1" type="checkbox" />        <!--            <input type="button" id="fboxx" value="Create"/>-->
        </span>
    </div><!-- row -->
    <div class="newfboxdiv" >
         
    <div class="row" style="border-bottom:1px solid #ccc; padding:10px 10px 10px 50px; text-align:left">
        <label for="FoundboxPopuForm_title" class="required">Title <span class="required">*</span></label>        
        
        <span style="padding-left:50px;"><input maxlength="280" name="FoundboxPopuForm[title]" id="FoundboxPopuForm_title" type="text" value="Title" /></span>
                </div><!-- row -->
        <div class="row" style="border-bottom:1px solid #ccc; vertical-align:text-top; padding:10px 10px 10px 55px; text-align:left">
        <table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">    <label for="FoundboxPopuForm_description" class="required">Description <span class="required">*</span></label></td>
    <td  align="left" valign="top" style="padding-left:5px"><textarea name="FoundboxPopuForm[description]" id="FoundboxPopuForm_description">Description</textarea>        </td>
  </tr>
</table>

    
        </div><!-- row -->
        <div class="row" style="border-bottom:1px solid #ccc;  padding:10px 10px 10px 55px; text-align:left">
        <label for="FoundboxPopuForm_privacy" class="required">Privacy <span class="required">*</span></label>                    
        <span style="padding-left:25px;"><select name="FoundboxPopuForm[privacy]" id="FoundboxPopuForm_privacy">
<option value="1">Public</option>
<option value="0">Private</option>
</select>        </span>
        </div><!-- row -->
<div align="left" style="padding:10px 10px 10px 150px;"><input type="submit" name="yt1" value="Save" id="yt1" />    </div> 
                <!--

                we would create our thumb images from videos 
                <div class="row">
                                </div>
-->

        

</form>
</div><!-- form -->