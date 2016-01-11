
<h3>相关疾病</h3>
<?php
//$model Hospital model.
//$listModel array of Faculty model.
//$showControl boolean.
if (isset($showControl) === false) {
    $showControl = false;
}
if (emptyArray($listModel) === false) {
    echo '<div class="view department">';
    foreach ($listModel as $department) {

        echo $department->getName().'　　';
//        if (isset($showControl) && $showControl) {
//            echo '<div style="float:right;"><a class="btn-delete" href="' . $this->createUrl('faculty/deleteHospital', array('fid' => $faculty->id, 'hid' => $model->id)) . '">删除</a></div>';
//        }
    }
    echo '</div>';
}
?>
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function ($) {
        jQuery('body').on('click', '.items .view.hospital .btn-delete', function () {
            if (confirm('Are you sure you want to delete this faculty?')) {
                jQuery.yii.submitForm(this, this.href, {});
                return false;
            } else
                return false;
        });
    });
    /*]]>*/
</script>