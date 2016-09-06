<li class="video" id="<?php echo $foundbox->id ?>Thumb">

    <div class="foundboxes">
        <?php
        echo CHtml::link('<img src="' . Yii::app()->getBaseUrl() . "/" . $data->widget_thumb_url . '" />', array('/users/foundboxvideos/index', 'id' => $data->id));
        ?>      
    </div>  

    <?php
    $foundboxRModel = Foundbox::model()->findByPk($data->id);

    if (Yii::app()->user->name == "admin") {

        $this->widget('CStarRating', array(
            'name' => '' . $data->id,
            'minRating' => 1, //minimal value
            'maxRating' => 5, //max value
            'starCount' => 5, //number of stars
            'value' => ceil($foundboxRModel->average_rank),
            'callback' => '
        function(){
                $.ajax({
                    type: "POST",
                    url: "' . Yii::app()->createUrl('FoundboxRanking/foundboxRanking') . '",
                    data: "' . Yii::app()->request->csrfTokenName . '=' . Yii::app()->request->getCsrfToken() . '&foundboxID=' . $data->id . '&rate=" + $(this).val(),
                    success: function(msg){
                                $("#result").html(msg);
                        }})}'
        ));
        echo "<div id='" . $data->id . "'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $foundboxRModel->average_rank . " avg</div>";
    } else {

        $this->widget('CStarRating', array(
            'name' => '' . $data->id,
            'minRating' => 1, //minimal value
            'maxRating' => 5, //max value
            'starCount' => 5, //number of stars
            'readOnly' => true,
            'value' => ceil($foundboxRModel->average_rank),
            'callback' => '
        function(){
                $.ajax({
                    type: "POST",
                    url: "' . Yii::app()->createUrl('FoundboxRanking/foundboxRanking') . '",
                    data: "' . Yii::app()->request->csrfTokenName . '=' . Yii::app()->request->getCsrfToken() . '&foundboxID=' . $data->id . '&rate=" + $(this).val(),
                    success: function(msg){
                                $("#result").html(msg);
                        }})}'
        ));
        echo "<div id='" . $data->id . "'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $foundboxRModel->average_rank . " avg</div>";
    }//end if not admin
    ?>                            

</li>

