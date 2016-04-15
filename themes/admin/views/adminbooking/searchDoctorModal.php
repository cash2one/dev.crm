<?php
$urlSearchHospital = $this->createUrl('doctor/searchDoctor', array('name' => ''));
?>
<div class="modal fade mt100" id="searchDoctorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">搜索医生</h4>
            </div>
            <div class="modal-body">
                <form id="searchDoctor-form" class="form-inline text-center">
                    <div class="form-group">
                        <label class="control-label">医生名</label>
                        <input class="form-control" name="doctorName" id="doctorName" type="text">
                        <button id="searchDoctor" type="button" class="btn btn-primary">搜索</button>
                    </div>

                </form>
                <div class="mt20">
                    <h4 class="strong">展示结果:</h4>
                    <div id="doctorList" class="row">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#searchDoctor').click(function () {
            var doctorName = $('#doctorName').val();
            ajaxLoadDoctor(doctorName);
        });
        //搜索回车操作
        $('#doctorName').keydown(function (event) {
            if (event.keyCode == "13") {
                event.preventDefault();
                var doctorName = $('#doctorName').val();
                ajaxLoadDoctor(doctorName);
            }
        });
    });
    function ajaxLoadDoctor(doctorName) {
        var searchUrl = '<?php echo $urlSearchHospital; ?>/' + doctorName;
        $.ajax({
            url: searchUrl,
            success: function (data) {
                setHpHtml(data.doctors);
            },
            error: function () {
                setHpHtml('');
            }
        });
    }
    function setHpHtml(doctors) {
        var innerHtml = '';
        if (doctors && doctors.length > 0) {
            for (var i = 0; i < doctors.length; i++) {
                var doctor = doctors[i];
                innerHtml += '<div class="col-sm-6"><span><a class="determineDoctor" data-mobile="' + doctor.mobile + '" data-doctorName="' + doctor.name + '" href="javascript:void(0);">' + doctor.name + '（' + doctor.hospital_name + ' ' + doctor.hp_dept_name + '）</a></span></div>';
            }
        } else {
            innerHtml += '<div class="col-sm-12">未查询到结果</div>';
        }
        $('#doctorList').html(innerHtml);
        initDoctorClick();
    }
    function initDoctorClick() {
        $('.determineDoctor').click(function () {
            var doctorMobile = $(this).attr('data-mobile') == null ? '' : $(this).attr('data-mobile');
            var doctorName = $(this).attr('data-doctorName');
            $('#AdminBookingForm_expected_doctor_name').val(doctorName);
            $('#AdminBookingForm_expected_doctor_mobile').val(doctorMobile);
            $('#searchDoctorModal').modal('hide');
        });
    }
</script>