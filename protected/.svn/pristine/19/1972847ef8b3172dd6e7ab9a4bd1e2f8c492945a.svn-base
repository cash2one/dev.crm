<?php
//$model Faculty.
//$listHospital array Hospital.
//$showControl boolean.
if (isset($showControl) === false) {
    $showControl = false;
}
if (emptyArray($listHospital) === false) {
    echo '<div class="items">';
    foreach ($listHospital as $hospital) {
        echo '<div class="view hospital clearfix">';
        echo CHtml::link(CHtml::encode($hospital->getName()), array('hospital/view', 'id' => $hospital->getId()), array('target' => '_blank'));
        if (isset($showControl) && $showControl) {
            echo '<ul class="list-inline pull-right" style="margin:0;">
                    <li><a class="btn btn-info btn-sm" href="' . $this->createUrl('faculty/updateHospital', array('fid' => $model->id, 'hid' => $hospital->id)) . '">修改</a></li>
                    <li><a class="btn btn-danger btn-sm btn-delete" href="' . $this->createUrl('faculty/deleteHospital', array('fid' => $model->id, 'hid' => $hospital->id)) . '">删除</a></li>
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
        jQuery('body').on('click', '.items .view.hospital .btn-delete', function () {
            if (confirm('Are you sure you want to delete this hospital?')) {
                jQuery.yii.submitForm(this, this.href, {});
                return false;
            } else
                return false;
        });
    });
    /*]]>*/
</script>