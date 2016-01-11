<?php
//$model Faculty.
//$listDoctor array Doctor.
//$showControl boolean.
if (isset($showControl) === false) {
    $showControl = false;
}
if (emptyArray($listDoctor) === false) {
    echo '<div class="items">';
    foreach ($listDoctor as $doctor) {
        echo '<div class="view doctor clearfix">';
        echo CHtml::link(CHtml::encode($doctor->getName()), array('doctor/view', 'id' => $doctor->getId()), array('target' => '_blank'));        
        if (isset($showControl) && $showControl) {
            echo '<ul class="list-inline pull-right" style="margin:0;">
                    <li><a class="btn btn-info btn-sm" href="' . $this->createUrl('faculty/updateDoctor', array('fid' => $model->id, 'did' => $doctor->id)) . '">修改</a></li>
                    <li><a class="btn btn-danger btn-sm btn-delete" href="' . $this->createUrl('faculty/deleteDoctor', array('fid' => $model->id, 'did' => $doctor->id)) . '">删除</a></li>
                </ul>';
        }
        echo '</div>';
    }
    echo '</div>';
}
?>
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function ($) {
        jQuery('body').on('click', '.items .view.doctor .btn-delete', function () {
            if (confirm('Are you sure you want to delete this doctor?')) {
                jQuery.yii.submitForm(this, this.href, {});
                return false;
            } else
                return false;
        });
    });
    /*]]>*/
</script>