<?php
     

          
     echo CHtml::beginForm();
     echo CHtml::label('Sorry your are not logged ',null);
     echo CHtml::link('click here for login',get_site_url().'/wp-login.php');
     echo CHtml::endForm();
     
?>