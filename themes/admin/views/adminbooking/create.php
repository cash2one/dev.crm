<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/css/bootstrap-datepicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/highlight.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/main.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/plupload.full.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/zh_CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/ui.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/qiniu.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/highlight.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/adminBooking.js?v=' . time(), CClientScript::POS_END);
$urlUploadFile = $this->createUrl("adminbooking/ajaxSaveAdminFile"); //$this->createUrl("adminbooking/ajaxUploadFile");
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlReturn = $this->createUrl('adminbooking/view', array('id' => ''));
$urlSubmit = $this->createUrl('adminbooking/ajaxCreate');
$urlLoadCity = $this->createUrl('region/loadCities');
$user = $this->getCurrentUser();
?>
<h1 class="">创建预约</h1>
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
    'htmlOptions' => array('class' => 'form-horizontal', 'data-url-return' => $urlReturn, 'data-url-action' => $urlSubmit, 'data-url-uploadFile' => $urlUploadFile),
    'enableAjaxValidation' => false,
        ));
echo CHtml::hiddenField("AdminBookingForm[booking_type]", $model->booking_type);
echo CHtml::hiddenField("AdminBookingForm[patient_id]", $model->patient_id);
echo CHtml::hiddenField("AdminBookingForm[admin_user_id]", $user->id);
echo CHtml::hiddenField("AdminBookingForm[expected_hospital_id]", $model->expected_hospital_id);
echo CHtml::hiddenField("AdminBookingForm[ref_no]", $model->ref_no);
?>
<input type="hidden" id="domain" value="http://7xq93p.com2.z0.glb.qiniucdn.com"> 
<input type="hidden" id="uptoken_url" value="<?php echo $this->createUrl('adminbooking/ajaxUpload'); ?>">
<input id="reportType" type="hidden" name="AdminBookingForm[report_type]" value="mr" />
<div class="mt30">
    <div class="form-group">
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
        <div class="col-md-4">
            <span class="">性别：</span>
            <input type='radio' name='AdminBookingForm[patient_gender]' id='AdminBookingForm_patient_gender_male' value='1'/><label for='AdminBookingForm_patient_gender_male'>&nbsp;男</label>
            &nbsp;&nbsp;
            <input type='radio' name='AdminBookingForm[patient_gender]' id='AdminBookingForm_patient_gender_female' value='2'/><label for='AdminBookingForm_patient_gender_female'>&nbsp;女</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">地址：</span><?php
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
            <span class="tab-header">详细地址：</span><?php echo $form->textField($model, 'patient_address', array('class' => 'form-control w50')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <span class="tab-header">疾病名称：</span><?php echo $form->textField($model, 'disease_name', array('class' => 'form-control w50')); ?>
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
<div class="mt30 hide">
    <h3>病历附件&nbsp;&nbsp;&nbsp;</h3>
    <div class="body">
        <div class="col-md-12">
            <div id="container">
                <a class="btn btn-default btn-lg " id="pickfiles" href="#" >
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>选择文件</span>
                </a>
            </div>
        </div>

        <div style="display:none" id="success" class="col-md-12">
            <div class="alert-success">
                队列全部文件处理完毕
            </div>
        </div>
        <div class="col-md-12 ">
            <table class="table table-striped table-hover text-left"   style="margin-top:40px;display:none">
                <thead>
                    <tr>
                        <th class="col-md-4">Filename</th>
                        <th class="col-md-2">Size</th>
                        <th class="col-md-6">Detail</th>
                    </tr>
                </thead>
                <tbody id="fsUploadProgress">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="form-group">
        <div class="col-md-3">
            <span class="tab-header">理想医院：</span><?php
            echo $form->textField($model, 'expected_hospital_name', array('class' => 'form-control w50'));
//            echo $form->dropDownList($model, 'expected_hospital_id', $model->loadOptionsHospital(), array(
//                'name' => 'AdminBookingForm[expected_hospital_id]',
//                'prompt' => '选择医院',
//                'class' => 'form-control w50',
//            ));
            ?>
            <span><a data-toggle="modal" data-target="#hospitalSearchModal">搜索</a></span>
        </div>
        <div class="col-md-3">
            <span class="tab-header">理想科室：</span><?php
            echo $form->textField($model, 'expected_hp_dept_name', array('class' => 'form-control w50'));
            ?>
            <a data-toggle="modal" data-target="#commonDeptModal">常用科室</a>
        </div>
        <div class="col-md-3">
            <span class="tab-header">理想专家：</span><?php echo $form->textField($model, 'expected_doctor_name', array('class' => 'form-control w50')); ?>
            <a data-toggle="modal" data-target="#searchDoctorModal">搜医生</a>
        </div>
        <div class="col-md-3">
            <span class="tab-header">理想专家电话：</span><?php echo $form->textField($model, 'expected_doctor_mobile', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <span class="tab-header">最终手术的医院：</span><?php
            echo $form->textField($model, 'final_hospital_name', array('class' => 'form-control'));
//            echo $form->dropDownList($model, 'final_hospital_id', $model->loadOptionsHospital(), array(
//                'name' => 'AdminBookingForm[final_hospital_id]',
//                'prompt' => '选择医院',
//                'class' => 'form-control',
//            ));
            ?>
        </div>
        <div class="col-md-3">
            <span class="tab-header">最终手术的专家：</span><?php
            echo $form->textField($model, 'final_doctor_name', array('class' => 'form-control'));
//            echo $form->dropDownList($model, 'final_doctor_id', $model->loadOptionsDoctorProfile(), array(
//                'name' => 'AdminBookingForm[final_doctor_id]',
//                'prompt' => '选择医生',
//                'class' => 'form-control',
//            ));
            ?>
        </div>
        <div class="col-md-3 pr0 pl0">
            <span class="tab-header">最终手术的专家电话：</span><?php echo $form->textField($model, 'final_doctor_mobile', array('class' => 'form-control')); ?>
        </div>
        <div class="col-md-3">
            <span class="tab-header">最终手术时间：</span><?php echo $form->textField($model, 'final_time', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="form-group">
        <div class="col-sm-2">
            <span>是否确诊：</span><?php
            echo $form->dropDownList($model, 'disease_confirm', $model->loadOptionsDiseaseConfirm(), array(
                'name' => 'AdminBookingForm[disease_confirm]',
                //'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
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
        <div class="col-sm-2 pl0 pr0">
            <span>平台渠道来源：</span><?php
            echo $form->dropDownList($model, 'customer_agent', $model->loadOptionsCustomerAgent(), array(
                'name' => 'AdminBookingForm[customer_agent]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2">
            <span>客户满意度：</span><?php
            echo $form->dropDownList($model, 'customer_intention', $model->loadOptionsCustomerIntention(), array(
                'name' => 'AdminBookingForm[customer_intention]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2 ">
            <span>客户类型：</span><?php
            echo $form->dropDownList($model, 'customer_type', $model->loadOptionsCustomerType(), array(
                'name' => 'AdminBookingForm[customer_type]',
                'prompt' => '选择',
                'class' => 'form-control w50',
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <span>公益项目：</span><?php
            echo $form->dropDownList($model, 'is_commonweal', $model->loadOptionIsCommonweal(), array(
                'name' => 'AdminBookingForm[is_commonweal]',
                //'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2">
            <span>B端：</span><?php
            echo $form->dropDownList($model, 'business_partner', $model->loadOptionBusinessPartner(), array(
                'name' => 'AdminBookingForm[business_partner]',
                'prompt' => '否',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-2">
            <span>是否购买保险：</span><?php
            echo $form->dropDownList($model, 'is_buy_insurance', $model->loadOptionIsBuyInsurance(), array(
                'name' => 'AdminBookingForm[is_buy_insurance]',
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
            <span>业务员：&nbsp;&nbsp;&nbsp;</span><input class="form-control" type="text" value="<?php echo $user->username; ?>" readonly/>
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
        <?php //echo CHtml::submitButton('保存', array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php
//搜索医院modal
$this->renderPartial('//doctor/searchHpModal');
$this->renderPartial('commonDept');
$this->renderPartial('searchDoctorModal');
?>
<script>
    $(document).ready(function () {
        //搜索医院弹框
//        $('#AdminBookingForm_expected_hospital_name').click(function () {
//            $('#hospitalSearchModal').modal();
//        }).keyup(function () {
//            $('#AdminBookingForm_expected_hospital_id').val('');
//        });
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
//        $('#hospitalSearchModal').on('hidden.bs.modal', function () {
//            $('#AdminBookingForm_expected_hospital_name').focus();
//        });
        $(".datepicker").datepicker({
            //startDate: "+0d",
            // todayBtn: true,
            autoclose: true,
            maxView: 2,
            todayHighlight: true,
            format: "yyyy-mm-dd",
            language: "zh-CN"
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
    function initHpClick() {
        $('.determineHp').click(function () {
            var hpId = $(this).attr('data-id');
            var hpName = $(this).attr('data-hpName');
            $('#AdminBookingForm_expected_hospital_name').val(hpName);
            //$('#AdminBookingForm_expected_hospital_id').val(hpId);
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