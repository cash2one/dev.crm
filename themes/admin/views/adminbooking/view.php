<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/adminbooking.css");
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datetimepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.zh-CN.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/custom/task.js", CClientScript::POS_END);

$adminBooking = $data->results->adminBooking;
$model = $data->results->model;
$orderList = isset($data->results->orderList) ? $data->results->orderList : null;
$adminTasks = $data->results->adminTasks;
$creator = isset($data->results->creator) ? $data->results->creator : null;
$smsList = $data->results->smsList;
//设置订单creater信息
$bookingCreator = new stdClass();
if (is_null($creator) == false) {
    $bookingCreator->name = $creator->name;
    $bookingCreator->mobile = $creator->mobile == null ? '无' : '<a target="_blank" href="' . $this->createUrl('user/view', array('id' => $creator->userId)) . '">' . substr_replace($creator->mobile, '****', 3, 4) . '</a>' . '   <a data-disease="' . $adminBooking->disease_name . '" data-bookingid="' . $adminBooking->getId() . '" data-mobile="' . $creator->mobile . '" data-toggle="modal" data-target="#sendSmdModal">发短信</a>' . '   <a data-mobile="' . $creator->mobile . '" data-toggle="modal" data-target="#outingCallsModal">打电话</a>';
    $bookingCreator->cTitle = $creator->cTitle;
    $bookingCreator->stateName = $creator->stateName;
    $bookingCreator->cityName = $creator->cityName;
    $bookingCreator->hpName = $creator->hpName;
    $bookingCreator->hpDeptName = $creator->hpDeptName;
} else {
    $bookingCreator->name = '无';
    $bookingCreator->mobile = '无';
    $bookingCreator->cTitle = '无';
    $bookingCreator->stateName = '无';
    $bookingCreator->cityName = '无';
    $bookingCreator->hpName = '无';
    $bookingCreator->hpDeptName = '无';
}

if ($adminBooking->booking_type == AdminBooking::BK_TYPE_BK) {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $adminBooking->patient_id . '&bookingId=' . $adminBooking->booking_id;
    //$urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $adminBooking->patient_id . '&bookingId=' . $adminBooking->booking_id. '&reportType=' . StatCode::MR_REPORTTYPE_DA;
    $urlLoadDCFiles = '';
    $urlDeleteFile = $this->createUrl('booking/deleteBookingFile', array('id' => ''));
} else if ($adminBooking->booking_type == AdminBooking::BK_TYPE_PB) {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadpatientmr?userId=' . $adminBooking->creator_doctor_id . '&patientId=' . $adminBooking->patient_id . '&reportType=' . StatCode::MR_REPORTTYPE_MR;
    $urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadpatientmr?userId=' . $adminBooking->creator_doctor_id . '&patientId=' . $adminBooking->patient_id . '&reportType=' . StatCode::MR_REPORTTYPE_DA;
    $urlDeleteFile = $this->createUrl('patient/deletepatientmr', array('id' => '')); //add file_id;
} else {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadadminmr?abId=' . $adminBooking->id . '&reportType=' . StatCode::MR_REPORTTYPE_MR;
    $urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadadminmr?abId=' . $adminBooking->id . '&reportType=' . StatCode::MR_REPORTTYPE_DA;
    $urlDeleteFile = $this->createUrl('adminbooking/ajaxDeleteAdminFile', array('id' => '')); //add file_id;
}

$urlUpdateAdminBooking = $this->createUrl('adminbooking/update', array('id' => $adminBooking->id));
$urlUploadPatientCaseFile = $this->createUrl('adminbooking/uploadsummary', array('id' => $adminBooking->id, 'type' => StatCode::MR_REPORTTYPE_MR));
$urlUploadSummary = $this->createUrl('adminbooking/uploadsummary', array('id' => $adminBooking->id, 'type' => StatCode::MR_REPORTTYPE_DA));
$deleteTaskUrl = $this->createUrl('admintask/ajaxDeleteTask', array('id' => ''));
$urlOrderView = $this->createAbsoluteUrl('order/view', array('id' => ''));
$ajaxCreateShareTaskUrl = $this->createUrl('admintask/ajaxCreateShareTask', array('id' => $adminBooking->id, 'type' => ''));

if (arrayNotEmpty($orderList)) {
    foreach ($orderList as $order) {
        if ($order->isPaidCode == SalesOrder::ORDER_PAIDED) {
            $adminBooking->order_amount += $order->finalAmount;
        }
    }
}
?>
<style>
    .header-menu>a.btn{margin-bottom: 10px;}
</style>
<h1 class="">预约</h1>
<div class="mt30 header-menu">
    <a class="btn btn-primary" data-toggle="modal" data-target="#updateStatusModal">修改状态</a>
    <a href="<?php echo $urlUpdateAdminBooking; ?>" class="btn btn-primary" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>修改订单</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addBdUserModal" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>线下推广人员</a>
    <a id="createAdminBKOrder" href="<?php echo $this->createUrl('order/createAdminBKOrder', array('bid' => $adminBooking->id)); ?>" class="btn btn-primary" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>生成订单</a>
    <a id="createOfflineOrder" href="<?php echo $this->createUrl('order/createOfflineOrder', array('bid' => $adminBooking->id)); ?>" class="btn btn-primary" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>生成线下支付记录</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addAdminUserModal" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>分配业务员</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addContactUserModal" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>分配对接人</a>
    <a href="<?php echo $this->createUrl('adminbooking/relateDoctor', array('bid' => $adminBooking->id)); ?>" class="btn btn-primary" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>关联医生</a>
    <a href="<?php echo $urlUploadPatientCaseFile; ?>" class="btn btn-primary" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>上传病历图片</a>
    <a href="<?php echo $urlUploadSummary; ?>" class="btn btn-primary" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>上传出院小结</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#shareModal" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>分享地推</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#shareKAModal" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>分享KA</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addCsExplainModal" <?php echo $adminBooking->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>补充说明</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#smsListModal">短信记录</a>
</div>
<style>
    .border-bottom{border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;}
    .tab-header{display: inline-block;min-width: 6em;}
    .with20{width: 20%;float: left;}
    .form-group{width: auto;}
</style>
<div class="mt30">
    <div class="row">
        <div class="col-md-4 col-lg-2 border-bottom">
            <span class="tab-header">预约状态：</span><?php
            $bookingStatus = $adminBooking->getBookingStatus() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getBookingStatus();
            echo $adminBooking->booking_status == StatCode::BK_STATUS_NULLIFY ? '<span class="color-red">' . $bookingStatus . '</span>' : $bookingStatus;
            ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span class="tab-header">工作进度：</span><?php
            echo $adminBooking->getWorkSchedule() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getWorkSchedule();
            ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>线下推广人员：</span><?php echo $adminBooking->bd_user_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->bd_user_name; ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>对接人：</span><?php echo $adminBooking->contact_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->contact_name; ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>业务员：</span><?php echo $adminBooking->admin_user_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->admin_user_name; ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>预约类型：</span><?php echo $adminBooking->getBookingType() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getBookingType(); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="row">
        <div class="col-md-4 border-bottom">
            <span class="tab-header">客户编号：</span><?php echo $adminBooking->ref_no == null ? '<span class="color-blue">未填写</span>' : $adminBooking->ref_no; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">患者姓名：</span><?php echo $adminBooking->patient_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->patient_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">患者电话：</span><?php
            $patientMobile = '';
            if (strIsEmpty($adminBooking->patient_mobile)) {
                $patientMobile = '<span class="color-blue">未填写</span>';
            } else if (strlen($adminBooking->patient_mobile) == 11) {
                $patientMobile = substr_replace($adminBooking->patient_mobile, '****', 3, 4) . '   <a data-disease="' . $adminBooking->disease_name . '" data-bookingid="' . $adminBooking->getId() . '" data-mobile="' . $adminBooking->patient_mobile . '" data-toggle="modal" data-target="#sendSmdModal">发短信</a>' . '   <a data-mobile="' . $adminBooking->patient_mobile . '" data-toggle="modal" data-target="#outingCallsModal">打电话</a>';
            } else {
                $patientMobile = substr_replace($adminBooking->patient_mobile, '***', 2, 3) . '   <a data-mobile="' . $adminBooking->patient_mobile . '" data-toggle="modal" data-target="#outingCallsModal">打电话</a>';
            }
            echo $patientMobile;
            //echo $adminBooking->patient_mobile == null ? '<span class="color-blue">未填写</span>' : $adminBooking->patient_mobile . '   <a data-disease="' . $adminBooking->disease_name . '" data-bookingid="' . $adminBooking->getId() . '" data-mobile="' . $adminBooking->patient_mobile . '" data-toggle="modal" data-target="#sendSmdModal">发短信</a>' . '   <a data-mobile="' . $adminBooking->patient_mobile . '" data-toggle="modal" data-target="#outingCallsModal">打电话</a>';
            ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">年龄：</span><?php
            if ($adminBooking->patient_age == null) {
                $patientAge = '<span class="color-blue">未填写</span>';
            } else {
                $ageArray = explode(',', $adminBooking->patient_age);
                $patientAge = '';
                foreach ($ageArray as $key => $value) {
                    if ($key == 0) {
                        $patientAge .= $value . '岁';
                    } else if ($key == 1) {
                        $patientAge .= $value . '月';
                    }
                }
            }
            echo $patientAge;
            ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">性别：</span><?php echo $adminBooking->getPatientGender() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getPatientGender(); ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">身份证：</span><?php echo $adminBooking->patient_identity == null ? '<span class="color-blue">未填写</span>' : $adminBooking->patient_identity; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">地址：</span><?php echo $adminBooking->patient_state; ?> 省/市 <?php echo $adminBooking->patient_city; ?> 市 <?php echo $adminBooking->patient_address; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">疾病名称：</span><?php echo $adminBooking->disease_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->disease_name; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">病情描述：</span><?php echo $adminBooking->disease_detail == null ? '<span class="color-blue">未填写</span>' : $adminBooking->disease_detail; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">期望手术时间：</span><?php echo $adminBooking->expected_time_start == null ? '<span class="color-blue">未填写</span>' : date('Y-m-d', strtotime($adminBooking->expected_time_start)); ?> — <?php echo $adminBooking->expected_time_end == null ? '<span class="color-blue">未填写</span>' : date('Y-m-d', strtotime($adminBooking->expected_time_end)); ?>
        </div>
    </div>
</div>

<div class="mt30">
    <h3>病历附件&nbsp;&nbsp;&nbsp;</h3>
    <div class="row bookingImgList">

    </div>
</div>

<div class="mt30">
    <div class="row">
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
            <span class="tab-header">就诊方式：</span><?php echo $adminBooking->getTravelType(true) == null ? '无' : $adminBooking->getTravelType(true); ?>
        </div>
        <div class="col-md-8 border-bottom">
            <span class="tab-header">预约详情：</span><?php echo $adminBooking->booking_detail == null ? '无' : $adminBooking->booking_detail; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">理想医院：</span><?php echo $adminBooking->expected_hospital_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->expected_hospital_name; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">理想科室：</span><?php echo $adminBooking->expected_hp_dept_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->expected_hp_dept_name; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">理想专家：</span><?php echo $adminBooking->expected_doctor_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->expected_doctor_name; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">理想专家电话：</span><?php echo $adminBooking->expected_doctor_mobile == null ? '<span class="color-blue">未填写</span>' : $adminBooking->expected_doctor_mobile; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">最终手术的医院：</span><?php echo $adminBooking->final_hospital_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->final_hospital_name; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">最终手术的专家：</span><?php echo $adminBooking->final_doctor_name == null ? '<span class="color-blue">未填写</span>' : $adminBooking->final_doctor_name; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">手术专家电话：</span><?php echo $adminBooking->final_doctor_mobile == null ? '<span class="color-blue">未填写</span>' : $adminBooking->final_doctor_mobile; ?>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">最终手术时间：</span><?php
            echo $adminBooking->final_time == null ? '<span class="color-blue">未填写</span>' : $adminBooking->final_time;
            ?>
            <a class="" data-toggle="modal" data-target="#updateFinalTimeModal">修改</a>
        </div>
        <div class="col-md-6 col-lg-3 border-bottom">
            <span class="tab-header">关联医生：</span><?php echo $adminBooking->doctor_user_name == null ? '<span class="color-blue">未填写</span>' : '<a href="' . $this->createUrl('user/view', array('id' => $adminBooking->doctor_user_id)) . '" target="_blank">' . $adminBooking->doctor_user_name . '</a>'; ?>
        </div>
        <div class="col-md-6 col-lg-9 border-bottom">
            <span class="tab-header">关联时间：</span><?php echo $adminBooking->date_related == null ? '<span class="color-blue">未填写</span>' : $adminBooking->date_related; ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="row">
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>是否确诊：</span><?php echo $adminBooking->getDiseaseConfirm() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getDiseaseConfirm(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>患者目的：</span><?php echo $adminBooking->getCustomerRequest() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getCustomerRequest(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>导流来源：</span><?php echo $adminBooking->getCustomerDiversion() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getCustomerDiversion(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>平台渠道来源：</span><?php echo $adminBooking->getCustomerAgent() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getCustomerAgent(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>客户满意度：</span><?php echo $adminBooking->getCustomerIntention() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getCustomerIntention(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>客户类型：</span><?php echo $adminBooking->getCustomerType() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getCustomerType(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>公益项目：</span><?php echo $adminBooking->getIsCommonweal() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getIsCommonweal(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>服务类型：</span><?php echo $adminBooking->getBookingService() == null ? '普通' : $adminBooking->getBookingService(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>B端：</span><?php echo $adminBooking->getBusinessPartner() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getBusinessPartner(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>是否购买保险：</span><?php echo $adminBooking->getIsBuyInsurance() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getIsBuyInsurance(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>是否成单：</span><?php echo $adminBooking->getIsDeal() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getIsDeal(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">
            <span>是否完成手术：</span><?php echo $adminBooking->getOperationFinished() == null ? '否' : $adminBooking->getOperationFinished(); ?>
        </div>
        <div class="col-md-4 col-lg-2 border-bottom">销售总额：<?php echo $adminBooking->total_amount == null ? '无' : $adminBooking->total_amount; ?></div>
        <div class="col-sm-10 border-bottom">实际总收款：<?php echo $adminBooking->order_amount == null ? '0.00' : $adminBooking->order_amount; ?></div>
        <div class="col-sm-12 border-bottom">
            <span>录入日期：</span><?php echo $adminBooking->date_created; ?>
        </div>
        <div class="col-sm-12 border-bottom">
            <span>上级医生是否接受订单：</span><?php echo $adminBooking->getDoctorAccept() == null ? '<span class="color-blue">未填写</span>' : $adminBooking->getDoctorAccept(); ?>
        </div>
        <div class="col-sm-12 border-bottom">
            <span>医生意见：</span><?php echo $adminBooking->doctor_opinion == null ? '<span class="color-blue">未填写</span>' : $adminBooking->doctor_opinion; ?>
        </div>
        <div class="col-sm-12 border-bottom">
            <span>补充说明：</span><?php echo $adminBooking->cs_explain == null ? '<span class="color-blue">未填写</span>' : $adminBooking->cs_explain; ?>
        </div>
        <div class="col-sm-12 border-bottom">
            <span>特殊备注：</span><?php echo $adminBooking->remark == null ? '<span class="color-blue">未填写</span>' : $adminBooking->remark; ?>
        </div>
    </div>
</div>
<div class="mt30 task">
    <h3>跟单任务&nbsp;&nbsp;&nbsp;<span class="btn btn-primary" data-toggle="modal" data-target="#taskModal">新增</span> <span class="btn btn-primary delete">删除</span></h3>
    <table class="table">
        <tbody>
            <tr class="odd">
                <td class="w10"><input type="checkbox" class="checkAll"> 全选</td>
                <td>待跟单时间</td>
                <td>客服</td>
                <td>跟单方式</td>
                <td>跟单任务</td>
                <td>完成人</td>
                <td>操作</td>
            </tr>
            <?php
            $adminTasksNotDone = $adminTasks['adminTasksNotDone'];
            if (isset($adminTasksNotDone) && arrayNotEmpty($adminTasksNotDone)) {
                foreach ($adminTasksNotDone as $bktask) {
                    ?>
                    <tr id="task<?php echo $bktask->id; ?>" class="odd">
                        <td><input class="bkTaskId" type="checkbox" value="<?php echo $bktask->id; ?>"></td>
                        <td><?php echo $bktask->datePlan; ?></td>
                        <td><?php echo $bktask->adminUser; ?></td>
                        <td><?php echo $bktask->workType; ?></td>
                        <td><?php echo $bktask->content; ?></td>
                        <td><?php echo $bktask->finishedUserName; ?></td>
                        <td>
                            <?php
                            if ($bktask->type == AdminTaskJoin::TASK_TYPE_DA) {
                                echo '<a class="" data-toggle="modal" data-target="#updateStatusModal">完成任务</a>';
                            } else {
                                echo '<a class="" data-id="' . $bktask->taskJoinId . '" data-toggle="modal" data-target="#completeTaskModal">完成任务</a>';
                                ?>
<!--                                <a class="completedTask" href="<?php //echo $this->createUrl('admintask/ajaxCompletedTask', array('id' => $bktask->taskJoinId)) ?>">完成任务</a></td>-->
                        <?php } ?>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="8">无跟单记录</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<div class="mt30 task">
    <h3>跟单历史&nbsp;&nbsp;&nbsp;<span class="btn btn-primary delete">删除</span></h3>
    <table class="table">
        <tbody>
            <tr class="odd">
                <td class="w10"><input type="checkbox" class="checkAll"> 全选</td>
                <td>跟单时间</td>
                <td>客服</td>
                <td>跟单方式</td>
                <td>跟单任务</td>
                <td>完成人</td>
                <td>完成时间</td>
            </tr>
            <?php
            $adminTasksDone = $adminTasks['adminTasksDone'];
            if (isset($adminTasksDone) && arrayNotEmpty($adminTasksDone)) {
                foreach ($adminTasksDone as $bktask) {
                    ?>
                    <tr id="task<?php echo $bktask->id; ?>" class="odd">
                        <td><input class="bkTaskId" type="checkbox" value="<?php echo $bktask->id; ?>"></td>
                        <td><?php echo $bktask->datePlan; ?></td>
                        <td><?php echo $bktask->adminUser; ?></td>
                        <td><?php echo $bktask->workType; ?></td>
                        <td><?php echo $bktask->content; ?></td>
                        <td><?php echo $bktask->finishedUserName; ?></td>
                        <td><?php echo $bktask->dateDone; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="8">无跟单历史</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<div style="mt30">
    <h3>订单</h3>
    <?php
    if (arrayNotEmpty($orderList)) {
        $deposit_total = 0.00;
        $deposit_paid = 0.00;
        $service_total = 0.00;
        $service_paid = 0.00;
        ?>
        <table class="table" id="yw0">
            <tbody>
                <tr class="odd">
                    <th>订单号</th>
                    <th>Ping++ ID</th>
                    <th>订单类型</th>
                    <th>订单标题</th>
                    <th>订单内容</th>
                    <th>金额</th>
                    <th>支付情况</th>
                    <th>支付时间</th>
                    <th>查看详情</th>
                </tr>
                <?php foreach ($orderList as $order): ?>
                    <?php
                    if (isset($order)):
                        if ($order->orderTypeCode == SalesOrder::ORDER_TYPE_DEPOSIT) {
                            $deposit_total += $order->finalAmount;
                            if ($order->isPaidCode == SalesOrder::ORDER_PAIDED) {
                                $deposit_paid += $order->finalAmount;
                            }
                        }
                        if ($order->orderTypeCode == SalesOrder::ORDER_TYPE_SERVICE) {
                            $service_total += $order->finalAmount;
                            if ($order->isPaidCode == SalesOrder::ORDER_PAIDED) {
                                $service_paid += $order->finalAmount;
                            }
                        }
                        ?>
                        <tr class="odd">
                            <td><?php echo $order->refNo; ?></td>
                            <td><?php echo $order->pingId; ?></td>
                            <td><?php echo $order->orderType; ?></td>
                            <td><?php echo $order->subject; ?></td>
                            <td><?php echo $order->description; ?></td>
                            <td><?php echo $order->finalAmount; ?></td>
                            <td><?php echo $order->isPaid; ?></td>
                            <td><?php echo $order->dateClosed == null ? '未支付' : $order->dateClosed; ?></td>
                            <td>
                                <a href="<?php echo $urlOrderView . '/' . $order->id; ?>" class="btn-admin btn-default" target="_blank">查看</a>
                                <?php
                                if ($order->orderTypeCode == SalesOrder::ORDER_TYPE_SERVICE && $order->isPaidCode == SalesOrder::ORDER_UNPAIDED) {
                                    echo '<a class="btn-admin btn-default deleteOrder" href="' . $this->createAbsoluteUrl('order/deleteOrder', array('id' => $order->id)) . '">删除</a>';
                                }
                                ?>
                            </td>
                        <?php endif; ?>
                        <?php
                    endforeach;
                    ?>
            </tbody>
        </table>
        <div class="row mt10 mb10">
            <div class="col-sm-3">定金总额：<?php echo number_format($deposit_total, 2); ?></div>
            <div class="col-sm-3">已支付定金：<?php echo number_format($deposit_paid, 2); ?></div>
            <div class="col-sm-3">服务费总额：<?php echo number_format($service_total, 2); ?></div>
            <div class="col-sm-3">已支付服务费：<?php echo number_format($service_paid, 2); ?></div>
        </div>
        <?php
    }
    if (!arrayNotEmpty($orderList)) {
        echo '<p>未生成订单</p>';
    }
    ?>
</div>
<div class="summary mt30">
    <h3>出院小结&nbsp;&nbsp;&nbsp;</h3>
    <div class="row bookingDcImgList">

    </div>
</div>
<?php
$this->renderPartial('addAdminUserModal', array('model' => $model));
$this->renderPartial('addBdUserModal', array('model' => $model));
$this->renderPartial('addContactUserModal', array('model' => $model));
$this->renderPartial('updateStatusModal', array('model' => $model));
$this->renderPartial('addTaskPlanModal', array('model' => $model));
$this->renderPartial('//user/_showImgModal');
$this->renderPartial('_shareModal', array('data' => $adminBooking, 'bookingCreator' => $bookingCreator, 'orderList' => $orderList));
$this->renderPartial('_shareKAModal', array('data' => $adminBooking));
$this->renderPartial('addCsExplainModal', array('model' => $model));
$this->renderPartial('//sms/_sendSmsModal', array('model' => $model));
$this->renderPartial('outingCallsModal');
$this->renderPartial('//sms/_smsListModal', array('smsList' => $smsList));
$this->renderPartial('updateFinalTimeModal', array('model' => $model));
$this->renderPartial('completeTaskModal');
?>
<script>
    $(document).ready(function () {
        //分享时生成跟单
        $('#shareModal').on('show.bs.modal', function (event) {
            var type = 'BD';
            ajaxCreateShareTask(type);
        });
        $('#shareKAModal').on('show.bs.modal', function (event) {
            var type = 'KA';
            ajaxCreateShareTask(type);
        });
        //删除支付单
        $('a.deleteOrder').click(function (e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            deleteOrder(deleteUrl);
        });
        //创建之前先确定KA/地推是否存在
        $('#createAdminBKOrder').click(function (e) {
            e.preventDefault();
            var bdUser = '<?php echo $adminBooking->bd_user_name; ?>';
            var href = $(this).attr('href');
            if (bdUser) {
                location.href = href;
            } else {
                if (confirm('未分配KA/地推,确认创建订单?')) {
                    location.href = href;
                }
            }
        });
        //日期选择
        $("#task_date_plan").datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left",
            language: "zh-CN"
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
        //全选
        $('.checkAll').click(function () {
            var isChecked = $(this).is(':checked');
            $(this).parents('.table').find("input[type='checkbox']").prop('checked', isChecked);
        });
        $('.delete').click(function () {
            var arrTaskId = new Array();
            var i = 0;
            $(this).parents('.task').find("input.bkTaskId").each(function () {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    arrTaskId[i] = $(this).val();
                    i++;
                }
            });
            if (arrTaskId.length == 0) {
                alert('至少选择一个任务');
            } else {
                if (confirm('确认删除?')) {
                    deleteTask(arrTaskId);
                }
            }
        });
        //异步完成跟单任务
        $('.completedTask').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (confirm('确定完成跟单任务?')) {
                $.ajax({
                    url: url,
                    success: function (data) {
                        if (data.status == 'ok') {
                            location.reload();
                        }
                    }
                });
            }
        });
        var urlLoadFiles = '<?php echo $urlLoadFiles; ?>';
        var urlLoadDcFiles = '<?php echo $urlLoadDCFiles; ?>';
        ajaxLoadFiles(urlLoadFiles, $('.bookingImgList'));
        ajaxLoadFiles(urlLoadDcFiles, $('.bookingDcImgList'));
<?php
if (isset($adminTasksNotDone) && arrayNotEmpty($adminTasksNotDone)) {
    foreach ($adminTasksNotDone as $bktask) {
        echo 'ajaxReadTaks(' . $bktask->taskJoinId . ');';
    }
}
?>
    });
    function deleteOrder(deleteUrl) {
        if (confirm('确定删除这个支付单?')) {
            $.ajax({
                url: deleteUrl,
                success: function (data) {
                    if (data.status == 'ok') {
                        alert('删除成功!');
                        location.reload();
                    } else {
                        alert('删除失败!');
                    }
                },
                error: function () {
                    alert('删除失败!');
                }
            });
        }
    }
    //删除跟单任务
    function deleteTask(arrTaskId) {
        var count = 0;
        for (var i = 0; i < arrTaskId.length; i++) {
            var taskId = arrTaskId[i];
            if (ajaxDeleteTask(taskId)) {
                count++;
            }
        }
    }
    function ajaxDeleteTask(id) {
        var deleteUrl = '<?php echo $deleteTaskUrl; ?>/' + id;
        $.ajax({
            url: deleteUrl,
            success: function (data) {
                if (data.status == 'ok') {
                    $('#task' + id).remove();
                } else {
                    alert('删除失败');
                }
            }
        });
    }
    //页面的跟单任务标记为已读
    function ajaxReadTaks(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('admintask/ajaxReadTask', array('id' => '')); ?>/' + id
        });
    }
    //分享时新建跟单
    function ajaxCreateShareTask(type) {
        var createTaskUrl = '<?php echo $ajaxCreateShareTaskUrl; ?>/' + type;
        console.log(createTaskUrl);
        $.ajax({
            url: createTaskUrl,
            success: function (data) {

            }
        });
    }
    //加载图片
    function ajaxLoadFiles(urlLoadFiles, fileDom) {
        $.ajax({
            url: urlLoadFiles,
            success: function (data) {
                if (data.status == 'ok') {
                    setFileHtml(data.results.files, fileDom);
                }
            }
        });
    }
    function setFileHtml(files, fileDom) {
        if (files && files.length > 0) {
            var innerHtml = '';
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                innerHtml += '<div class="col-md-4 col-lg-2 mt10 docImg"><a data-toggle="modal" data-target="#showImgModal" data-src="' + file.absFileUrl + '"><img src="' + file.absFileUrl + '"/></a><div><a class="deleteFile" href="<?php echo $urlDeleteFile; ?>/' + file.id + '">删除图片</a></div><div class="fileDate mt5">' + file.dateCreated + '</div></div>';
            }
        } else {
            var innerHtml = '<div class="col-sm-12 mt10">未上传图片</div>';
        }
        fileDom.html(innerHtml);
        $('.deleteFile').click(function (e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            if (confirm('确定删除这张图片?')) {
                ajaxDeleteFile(deleteUrl);
            }
        });
    }
    function ajaxDeleteFile(deleteUrl) {
        $.ajax({
            url: deleteUrl,
            success: function (data) {
                if (data.status == 'ok') {
                    location.reload();
                } else {
                    alert('删除失败!');
                }
            }
        });
    }
</script>