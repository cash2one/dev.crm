<?php
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlSearchHospital = $this->createUrl('hospital/searchResult');
$commentDepts = array('普外科', '神经外科', '妇产科', '整形外科', '眼科', '口腔科', '心内科', '消化内科', '泌尿外科', '心胸外科', '骨科', '肛肠科', '乳腺外科', '运动医学科', '血管外科', '耳鼻咽喉头颈外科', '小儿外科', '肝胆外科', '介入科', '胃肠外科');
?>
<div class="modal fade mt100" id="commonDeptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">常见科室</h4>
            </div>
            <div class="modal-body">
                <div>常用科室,点击选择:</div>
                <div class="row">
                    <?php
                    foreach ($commentDepts as $value) {
                        echo '<div class="col-sm-6"><span><a class="commonDept" data-dept="' . $value . '" href="javascript:void(0);">' . $value . '</a></span></div>';
                    }
                    ?>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.commonDept').click(function () {
            var deptName = $(this).attr('data-dept');
            $('#AdminBookingForm_expected_hp_dept_name').val(deptName);
            $('#commonDeptModal').modal('hide');
        });
    });
</script>