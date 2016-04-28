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

$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlReturn = $this->createUrl('adminbooking/view', array('id' => ''));
$urlSubmit = $this->createUrl('adminbooking/ajaxUpdate');
$urlLoadCity = $this->createUrl('region/loadCities');

$urlUploadFile = $this->createUrl("adminbooking/ajaxSaveAdminFile"); //$this->createUrl("booking/ajaxUploadFile");
//$urlLoadFiles = 'http://localhost/file.myzd.com/api/loadadminmr?abId=' . $model->id . '&reportType=mr'; //$this->createUrl('booking/bookingFile', array('id' => $model->id));
if ($data->booking_type == AdminBooking::BK_TYPE_BK) {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $data->patient_id . '&bookingId=' . $data->booking_id;
} else if ($data->booking_type == AdminBooking::BK_TYPE_PB) {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadpatientmr?userId=' . $data->creator_doctor_id . '&patientId=' . $data->patient_id . '&reportType=mr';
} else {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadadminmr?abId=' . $data->id . '&reportType=mr';
}
?>
<h1 class="">修改预约</h1>
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
echo CHtml::hiddenField("AdminBookingForm[work_schedule]", $model->work_schedule);
echo CHtml::hiddenField("AdminBookingForm[patient_id]", $model->patient_id);
echo CHtml::hiddenField("AdminBookingForm[admin_user_id]", $model->admin_user_id);
echo CHtml::hiddenField("AdminBookingForm[bd_user_id]", $model->bd_user_id);
echo CHtml::hiddenField("AdminBookingForm[bd_user_name]", $model->bd_user_name);
echo CHtml::hiddenField("AdminBookingForm[travel_type]", $model->travel_type);
echo CHtml::hiddenField("AdminBookingForm[expected_hospital_id]", $model->expected_hospital_id);
echo CHtml::hiddenField("AdminBookingForm[ref_no]", $model->ref_no);
?>
<input type="hidden" id="domain" value="http://7xq93p.com2.z0.glb.qiniucdn.com"> 
<input type="hidden" id="uptoken_url" value="<?php echo $this->createUrl('adminbooking/ajaxUpload'); ?>">
<input id="reportType" type="hidden" name="AdminBookingForm[report_type]" value="mr" />
<div class="mt30">
    <div class="row">
        <div class="col-md-2 border-bottom">
            <span class="tab-header">预约状态：</span><?php
            $bookingStatus = $data->getBookingStatus() == null ? '<span class="color-blue">未填写</span>' : $data->getBookingStatus();
            echo $data->booking_status == StatCode::BK_STATUS_INVALID ? '<span class="color-red">' . $bookingStatus . '</span>' : $bookingStatus;
            ?>
        </div>
        <div class="col-md-2 border-bottom">
            <span class="tab-header">工作进度：</span><?php
            echo $data->getWorkSchedule() == null ? '<span class="color-blue">未填写</span>' : $data->getWorkSchedule();
            ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>线下推广人员：</span><?php echo $data->bd_user_name == null ? '<span class="color-blue">未填写</span>' : $data->bd_user_name; ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>对接人：</span><?php echo $data->contact_name == null ? '<span class="color-blue">未填写</span>' : $data->contact_name; ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>业务员：</span><?php echo $data->admin_user_name == null ? '<span class="color-blue">未填写</span>' : $data->admin_user_name; ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>预约类型：</span><?php echo $data->getBookingType() == null ? '<span class="color-blue">未填写</span>' : $data->getBookingType(); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">客户编号：</span><?php echo $model->ref_no; ?>
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
        <div class="col-md-4">
            <span class="">性别：</span>
            <input type='radio' name='AdminBookingForm[patient_gender]' id='AdminBookingForm_patient_gender_male' value='1'/><label for='AdminBookingForm_patient_gender_male'>&nbsp;男</label>
            &nbsp;&nbsp;
            <input type='radio' name='AdminBookingForm[patient_gender]' id='AdminBookingForm_patient_gender_female' value='2'/><label for='AdminBookingForm_patient_gender_female'>&nbsp;女</label>
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
<div class="mt30">
    <h3>病历附件&nbsp;&nbsp;&nbsp;</h3>
    <div class="row bookingImgList">

    </div>
    <div class="mb20 row hide">
        <div class="col-sm-12">
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
                <div>
                    <button id="btnSubmit" class="btn btn-primary">上传</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$bookingCreator = new stdClass();
if (is_null($creator) == false) {
    $bookingCreator->name = $creator->name;
    $bookingCreator->mobile = $creator->mobile == null ? '无' : '<a target="_blank" href="' . $this->createUrl('user/view', array('id' => $creator->user_id)) . '">' . $creator->mobile . '</a>';
    $bookingCreator->cTitle = $creator->clinical_title == null ? '无' : $creator->getClinicalTitle(true);
    $bookingCreator->stateName = $creator->state_name == null ? '无' : $creator->state_name;
    $bookingCreator->cityName = $creator->city_name == null ? '无' : $creator->city_name;
    $bookingCreator->hpName = $creator->hospital_name == null ? '无' : $creator->hospital_name;
    $bookingCreator->hpDeptName = $creator->hp_dept_name == null ? '无' : $creator->hp_dept_name;
} else {
    $bookingCreator->name = '无';
    $bookingCreator->mobile = '无';
    $bookingCreator->cTitle = '无';
    $bookingCreator->stateName = '无';
    $bookingCreator->cityName = '无';
    $bookingCreator->hpName = '无';
    $bookingCreator->hpDeptName = '无';
}
?>
<div class="mt30">
    <div class="form-group">
        <div class="col-md-4 border-bottom">
            <span class="tab-header">推送医生姓名：</span><?php echo $bookingCreator->name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">推送医生手机：</span><?php echo $bookingCreator->mobile; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">推送医生临床职称：</span><?php echo $bookingCreator->cTitle; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">推送医生所在省市：</span><?php echo $bookingCreator->stateName == $bookingCreator->cityName ? $bookingCreator->stateName : $bookingCreator->stateName . ' ' . $bookingCreator->cityName; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">推送医生所在医院：</span><?php echo $bookingCreator->hpName; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">推送医生所在科室：</span><?php echo $bookingCreator->hpDeptName; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">就诊方式：</span><?php echo $data->getTravelType(true) == null ? '无' : $data->getTravelType(true); ?>
        </div>
        <div class="col-md-8 border-bottom">
            <span class="tab-header">预约详情：</span><?php echo $data->booking_detail == null ? '无' : $data->booking_detail; ?>
        </div>
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
//            echo $form->dropDownList($model, 'expected_hp_dept_id', $model->loadOptionsDepartment(), array(
//                'name' => 'AdminBookingForm[expected_hp_dept_id]',
//                'prompt' => '选择医院',
//                'class' => 'form-control w50',
//            ));
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
        <div class="col-sm-2">
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
            <span>服务类型：</span><?php
            echo $form->dropDownList($model, 'booking_service_id', $model->loadOptionBookingService(), array(
                'name' => 'AdminBookingForm[booking_service_id]',
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
        <div class="col-sm-2">
            <span>销售总额：</span><?php
            echo $form->numberField($model, 'total_amount', array('class' => 'form-control w50'));
            ?>
        </div>
        <div class="col-sm-2">
            <span>是否成单：</span><?php
            echo $form->dropDownList($model, 'is_deal', $model->loadOptionIsDeal(), array(
                'name' => 'AdminBookingForm[is_deal]',
                'class' => 'form-control',
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <span>补充说明：</span><?php echo $form->textArea($model, 'cs_explain', array('class' => 'form-control w50', 'maxlength' => 500)); ?>
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
        <?php //echo CHtml::submitButton('保存', array('class' => 'btn btn-primary'));   ?>
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
        initForm();
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
        $(".datepicker").datepicker({
            //startDate: "+0d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            todayHighlight: true,
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
        var patient_gender = '<?php echo $model->patient_gender; ?>';
        var expected_hp_dept_name = '<?php echo $model->expected_hp_dept_name; ?>';
        if (patient_gender == 1) {
            $('#AdminBookingForm_patient_gender_male').prop('checked', true);
        } else if (patient_gender == 2) {
            $('#AdminBookingForm_patient_gender_female').prop('checked', true);
        }
        $('#AdminBookingForm_expected_hp_dept_name>option').each(function () {
            if ($(this).val() == expected_hp_dept_name) {
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
                innerHtml += '<div class="col-sm-2 mt10 docImg"><img src="' + file.absFileUrl + '"/><div class="mt5">' + file.dateCreated + '</div></div>';
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
            //$('#AdminBookingForm_expected_hospital_id').val(hpId);
            $('#hospitalSearchModal').modal('hide');
        });
    }
</script> 