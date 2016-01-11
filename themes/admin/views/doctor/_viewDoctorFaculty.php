
<h3>相关科室</h3>
<?php
//$model Doctor model.
//$listModel array of Faculty model.
//$showControl boolean.
if (isset($showControl) === false) {
    $showControl = false;
}
if (emptyArray($listModel) === false) {
    echo '<div class="items">';
    foreach ($listModel as $faculty) {
        echo '<div class="view doctor">';
        echo $faculty->getName();
        if (isset($showControl) && $showControl) {
            echo '<div style="float:right;"><a class="btn-delete" href="' . $this->createUrl('faculty/deleteDoctor', array('fid' => $faculty->id, 'did' => $model->id)) . '">删除</a></div>';
        }

        echo '</div>';
    }
    echo '</div>';
}
?>
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
        jQuery('body').on('click','.items .view.doctor .btn-delete',function(){if(confirm('Are you sure you want to delete this faculty?')) {jQuery.yii.submitForm(this,this.href,{});return false;} else return false;});       
    });
    /*]]>*/
</script>