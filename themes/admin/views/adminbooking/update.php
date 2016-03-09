<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/css/bootstrap-datepicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.custom.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/adminBooking.js', CClientScript::POS_END);

$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlReturn = $this->createUrl('adminbooking/view', array('id' => ''));
$urlSubmit = $this->createUrl('adminbooking/ajaxUpdate');
$urlLoadCity = $this->createUrl('region/loadCities');
if ($model->booking_type == AdminBooking::BK_TYPE_CRM) {
    $urlUploadFile = $this->createUrl("adminbooking/ajaxUploadFile");
    $urlLoadFiles = $this->createUrl('adminbooking/adminBookingFile', array('id' => $model->id));
} else if ($model->booking_type == AdminBooking::BK_TYPE_PB) {
    $urlUploadFile = $this->createUrl("patientbooking/ajaxUploadMRFile");
    $urlLoadFiles = $this->createUrl('patientbooking/patientMRFiles', array('id' => $model->patient_id));
} else {
    $urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
    $urlLoadFiles = $this->createUrl('booking/bookingFile', array('id' => $model->id));
}
?>
<h1 class="">预约患者</h1>
<style>
    .border-bottom{border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;}
    .tab-header{display: inline-block;min-width: 6em;}
    .with20{width: 20%;float: left;}
    .form-group{width: 100%;border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;padding-top: 5px;}
    .form-control{display: inline-block;width: auto;}
    .w50{width: 50%;}
    .w100{width: 100%;}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'booking-form',
    'htmlOptions' => array('class' => 'form-horizontal', 'data-bkType' => $model->booking_type, 'data-url-return' => $urlReturn, 'data-url-action' => $urlSubmit, 'data-url-uploadFile' => $urlUploadFile),
    'enableAjaxValidation' => false,
        ));
echo CHtml::hiddenField("AdminBookingForm[id]", $model->id);
echo CHtml::hiddenField("AdminBookingForm[booking_id]", $model->booking_id);
echo CHtml::hiddenField("AdminBookingForm[booking_type]", $model->booking_type);
echo CHtml::hiddenField("AdminBookingForm[booking_status]", $model->booking_status);
echo CHtml::hiddenField("AdminBookingForm[patient_id]", $model->patient_id);
echo CHtml::hiddenField("AdminBookingForm[admin_user_id]", $model->admin_user_id);
echo CHtml::hiddenField("AdminBookingForm[travel_type]", $model->travel_type);
echo CHtml::hiddenField("AdminBookingForm[expected_hospital_id]", $model->expected_hospital_id);
?>
<div class="mt30">
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">客户编号：</span><?php echo $form->textField($model, 'ref_no', array('class' => 'form-control w50', 'disabled' => true)); ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">患者姓名：</span><?php echo $form->textField($model, 'patient_name', array('class' => 'form-control w50')); ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">患者电话：</span><?php echo $form->textField($model, 'patient_mobile', array('class' => 'form-control w50')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">年龄：</span><?php echo $form->textField($model, 'patient_age', array('class' => 'form-control w50')); ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">身份证：</span><?php echo $form->textField($model, 'patient_identity', array('class' => 'form-control w50')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">地址：</span>
            <?php
            echo $form->dropDownList($model, 'state_id', $model->loadOptionsState(), array(
                'name' => 'AdminBookingForm[state_id]',
                'prompt' => '选择省份',
                'class' => 'form-control w50',
            ));
            ?> 省/市
        </div>
        <div class="col-md-3">
            <?php
            echo $form->dropDownList($model, 'city_id', $model->loadOptionsCity(), array(
                'name' => 'AdminBookingForm[city_id]',
                'prompt' => '选择城市',
                'class' => 'form-control w50',
            ));
            ?> 市
        </div>
        <div class="col-md-4">
            <?php echo $form->textField($model, 'patient_address', array('class' => 'form-control w100')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <span class="tab-header">疾病诊断：</span><?php echo $form->textField($model, 'disease_name', array('class' => 'form-control w50')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <span class="tab-header">病情描述：</span><?php echo $form->textArea($model, 'disease_detail', array('class' => 'form-control w50', 'maxlength' => 1000)); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <span class="tab-header">期望手术时间：</span><?php echo $form->textField($model, 'expected_time_start', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?> — <?php echo $form->textField($model, 'expected_time_end', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <h3>病历附件&nbsp;&nbsp;&nbsp;</h3>
    <div class="row bookingImgList">

    </div>
    <div class="mb20 row">
        <div class="col-sm-6">
            <div id="uploaderBooking" class="mt20 uploader">
                <div class="imglist">
                    <ul class="filelist"></ul>
                </div>
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                    </div>
                </div>
                <div class="statusBar clearfix" style="display:none;">
                    <div class="progress" style="display: none;">
                        <span class="text">0%</span>
                        <span class="percentage" style="width: 0%;"></span>
                    </div>
                    <div class="info">共0张（0B），已上传0张</div>
                    <div class="">
                        <!-- btn 继续添加 -->
                        <div id="filePicker2" class=""></div>                          
                    </div>
                    <!--                    <div class="mt40 clearfix">
                                            <button id="btnSubmit" class="statusBar uploadBtn btn btn-primary col-sm-4 col-sm-offset-1">提交</button>
                                        </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">理想医院：</span><?php
            echo $form->textField($model, 'expected_hospital_name', array('class' => 'form-control'));
//            echo $form->dropDownList($model, 'expected_hospital_id', $model->loadOptionsHospital(), array(
//                'name' => 'AdminBookingForm[expected_hospital_id]',
//                'prompt' => '选择医院',
//                'class' => 'form-control w50',
//            ));
            ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">理想科室：</span><?php
            echo $form->textField($model, 'expected_hp_dept_name', array('class' => 'form-control'));
//            echo $form->dropDownList($model, 'expected_hp_dept_id', $model->loadOptionsDepartment(), array(
//                'name' => 'AdminBookingForm[expected_hp_dept_id]',
//                'prompt' => '选择医院',
//                'class' => 'form-control w50',
//            ));
            ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">理想专家：</span><?php echo $form->textField($model, 'experted_doctor_name', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">最终手术的医院：</span><?php
            echo $form->textField($model, 'final_hospital_name', array('class' => 'form-control'));
//            echo $form->dropDownList($model, 'final_hospital_id', $model->loadOptionsHospital(), array(
//                'name' => 'AdminBookingForm[final_hospital_id]',
//                'prompt' => '选择医院',
//                'class' => 'form-control',
//            ));
            ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">最终手术的医生：</span><?php
            echo $form->textField($model, 'final_doctor_name', array('class' => 'form-control'));
//            echo $form->dropDownList($model, 'final_doctor_id', $model->loadOptionsDoctorProfile(), array(
//                'name' => 'AdminBookingForm[final_doctor_id]',
//                'prompt' => '选择医生',
//                'class' => 'form-control',
//            ));
            ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">最终手术时间：</span><?php echo $form->textField($model, 'final_time', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="form-group">
        <div class="col-sm-2">
            <span>是否确诊：</span><select class="form-control" name="AdminBookingForm[disease_confirm]" id="AdminBookingForm_disease_confirm">
                <option value="">--选择--</option>
                <option value="1">是</option>
                <option value="0">否</option>
            </select>
        </div>
        <div class="col-sm-2">
            <span>患者目的：</span><?php
            echo $form->dropDownList($model, 'customer_request', $model->loadOptionsCustomerRequest(), array(
                'name' => 'AdminBookingForm[customer_request]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2">
            <span>导流来源：</span><?php
            echo $form->dropDownList($model, 'customer_diversion', $model->loadOptionsCustomerDiversion(), array(
                'name' => 'AdminBookingForm[customer_diversion]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2">
            <span>客户来源：</span><?php
            echo $form->dropDownList($model, 'customer_agent', $model->loadOptionsCustomerAgent(), array(
                'name' => 'AdminBookingForm[customer_agent]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2">
            <span>客户意向：</span><?php
            echo $form->dropDownList($model, 'customer_intention', $model->loadOptionsCustomerIntention(), array(
                'name' => 'AdminBookingForm[customer_intention]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2">
            <span>客户类型：</span><?php
            echo $form->dropDownList($model, 'customer_type', $model->loadOptionsCustomerType(), array(
                'name' => 'AdminBookingForm[customer_type]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>

    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <span>特殊备注：</span><?php echo $form->textArea($model, 'remark', array('class' => 'form-control w50', 'maxlength' => 1000)); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <span>业务员：&nbsp;&nbsp;&nbsp;</span><input class="form-control" type="text" value="<?php echo $model->admin_user_name; ?>" readonly/>
            <?php
//            echo $form->dropDownList($model, 'admin_user_id', $model->loadOptionsAdminUser(), array(
//                'name' => 'AdminBookingForm[admin_user_id]',
//                'prompt' => '选择',
//                'class' => 'form-control',
//            ));
            ?>
        </div>

    </div>
</div>
<div class="mt30">
    <div class="buttons">
        <button id="btnSubmitForm" class="btn btn-primary" type="button" name="yt0">保存</button>
        <?php //echo CHtml::submitButton('保存', array('class' => 'btn btn-primary'));  ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php
//搜索医院modal
$this->renderPartial('//doctor/searchHpModal');
?>
<script>
    $(document).ready(function () {
        initForm();
        //搜索医院弹框
        $('#AdminBookingForm_expected_hospital_name').click(function () {
            $('#hospitalSearchModal').modal();
        }).keyup(function () {
            $('#AdminBookingForm_expected_hospital_id').val('');
        });
        $('#searchHp').click(function () {
            ajaxLoadHospital();
        });
        //搜索回车操作
        $('#Hospital_hpName').keydown(function (event) {
            if (event.keyCode == "13") {
                event.preventDefault();
                ajaxLoadHospital();
            }
        });
        //隐藏搜索医院弹框后，医院获得焦点
        $('#hospitalSearchModal').on('hidden.bs.modal', function () {
            $('#AdminBookingForm_expected_hospital_name').focus();
        });
        $(".datepicker").datepicker({
            startDate: "+1d",
            todayBtn: true,
            autoclose: true,
            maxView: 3,
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        var urlLoadFiles = '<?php echo $urlLoadFiles; ?>';
        $.ajax({
            url: urlLoadFiles,
            success: function (data) {
                if (data.status == 'ok') {
                    setFileHtml(data.results);
                }
            }
        });
        $("select#AdminBookingForm_state_id").change(function () {
            //$("select#city_id_id").attr("disabled", true);
            var stateId = $(this).val();
            var actionUrl = "<?php echo $urlLoadCity; ?>";// + stateId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                data: {'state': this.value, 'prompt': '选择城市'},
                cache: false,
                // dataType: "html",
                'success': function (data) {
                    $("select#AdminBookingForm_city_id").html(data);
                    // jquery mobile fix.
                    captionText = $("select#AdminBookingForm_city_id>option:first-child").text();
                    $("#AdminBookingForm_city_id-button>span:first-child").text(captionText);
                },
                'error': function (data) {
                },
                complete: function () {
                    //$("select#city_id_id").attr("disabled", false);
                }
            });
            return false;
        });
        $("select#AdminBookingForm_expected_hospital_id").change(function () {
            $("select#AdminBookingForm_expected_hp_dept_id").attr("disabled", true);
            var hopitalId = $(this).val();
            var actionUrl = "<?php echo $urlAjaxLoadloadHospitalDept; ?>/" + hopitalId;// + hopitalId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                //cache: false,
                //dataType: "html",
                'success': function (data) {
                    $("select#AdminBookingForm_expected_hp_dept_id").html(data);
                },
                'error': function (data) {
                },
                complete: function () {
                    $("select#AdminBookingForm_expected_hp_dept_id").attr("disabled", false);
                }
            });
            return false;
        });
    });
    function initForm() {
        var disease_confirm = '<?php echo $model->disease_confirm; ?>';
        var order_status = '<?php echo $model->order_status; ?>';
        $('select#AdminBookingForm_disease_confirm>option').each(function () {
            if ($(this).val() == disease_confirm) {
                $(this).attr('selected', 'selected');
            }
        });
        $('select#AdminBookingForm_order_status>option').each(function () {
            if ($(this).val() == order_status) {
                $(this).attr('selected', 'selected');
            }
        });
    }
    function setFileHtml(results) {
        if (results) {
            var innerHtml = '';
            var files = results.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                innerHtml += '<div class="col-sm-2 mt10 docImg"><img src="' + file.absThumbnailUrl + '"/><div class="mt5">' + file.dateCreated + '</div></div>';
            }
        } else {
            var innerHtml = '<div class="col-sm-12 mt10">未上传图片</div>';
        }
        $('.bookingImgList').html(innerHtml);
    }
    function initHpClick() {
        $('.determineHp').click(function () {
            var hpId = $(this).attr('data-id');
            var hpName = $(this).attr('data-hpName');
            $('#AdminBookingForm_expected_hospital_name').val(hpName);
            $('#AdminBookingForm_expected_hospital_id').val(hpId);
            $('#hospitalSearchModal').modal('hide');
            //ajaxLoadHpDept(hpId);
        });
    }
    function ajaxLoadHpDept(hopitalId) {
        $("select#AdminBookingForm_expected_hp_dept_id").attr("disabled", true);
        //var hopitalId = $(this).val();
        var actionUrl = "<?php echo $urlAjaxLoadloadHospitalDept; ?>/" + hopitalId;// + hopitalId + "&prompt=选择城市";
        $.ajax({
            type: 'get',
            url: actionUrl,
            //cache: false,
            //dataType: "html",
            'success': function (data) {
                $("select#AdminBookingForm_expected_hp_dept_id").html(data);
            },
            'error': function (data) {
            },
            complete: function () {
                $("select#AdminBookingForm_expected_hp_dept_id").attr("disabled", false);
            }
        });
        return false;
    }
</script> 