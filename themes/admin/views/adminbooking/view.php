<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/adminbooking.css");
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datetimepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.zh-CN.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/custom/task.js", CClientScript::POS_END);

//设置订单creater信息
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

if ($data->booking_type == AdminBooking::BK_TYPE_BK) {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $data->patient_id . '&bookingId=' . $data->booking_id;
    //$urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $data->patient_id . '&bookingId=' . $data->booking_id. '&reportType=dc';
    $urlLoadDCFiles = '';
    $urlDeleteFile = $this->createUrl('booking/deleteBookingFile', array('id' => ''));
} else if ($data->booking_type == AdminBooking::BK_TYPE_PB) {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadpatientmr?userId=' . $data->creator_doctor_id . '&patientId=' . $data->patient_id . '&reportType=mr';
    $urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadpatientmr?userId=' . $data->creator_doctor_id . '&patientId=' . $data->patient_id . '&reportType=dc';
    $urlDeleteFile = $this->createUrl('patient/deletepatientmr', array('id' => '')); //add file_id;
} else {
    $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadadminmr?abId=' . $data->id . '&reportType=mr';
    $urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadadminmr?abId=' . $data->id . '&reportType=dc';
    $urlDeleteFile = $this->createUrl('adminbooking/ajaxDeleteAdminFile', array('id' => '')); //add file_id;
}

$urlUpdateAdminBooking = $this->createUrl('adminbooking/update', array('id' => $data->id));
$urlUploadPatientCaseFile = $this->createUrl('adminbooking/uploadsummary', array('id' => $data->id, 'type' => 'mr'));
$urlUploadSummary = $this->createUrl('adminbooking/uploadsummary', array('id' => $data->id, 'type' => 'dc'));
$deleteTaskUrl = $this->createUrl('admintask/ajaxDeleteTask', array('id' => ''));
$urlOrderView = $this->createAbsoluteUrl('order/view', array('id' => ''));
$orderList = isset($orderList) ? $orderList : null;
?>
<h1 class="">预约</h1>
<div class="mt30">
    <a class="btn btn-primary" data-toggle="modal" data-target="#updateStatusModal">修改状态</a>
    <a href="<?php echo $urlUpdateAdminBooking; ?>" class="btn btn-primary" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>修改订单</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addBdUserModal" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>线下推广人员</a>
    <a id="createAdminBKOrder" href="<?php echo $this->createUrl('order/createAdminBKOrder', array('bid' => $data->id)); ?>" class="btn btn-primary" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>生成订单</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addAdminUserModal" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>分配业务员</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addContactUserModal" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>分配对接人</a>
    <a href="<?php echo $this->createUrl('adminbooking/relateDoctor', array('bid' => $data->id)); ?>" class="btn btn-primary" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>关联医生</a>
    <a href="<?php echo $urlUploadPatientCaseFile; ?>" class="btn btn-primary" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>上传病历图片</a>
    <a href="<?php echo $urlUploadSummary; ?>" class="btn btn-primary" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>上传出院小结</a>
</div>
<style>
    .border-bottom{border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;}
    .tab-header{display: inline-block;min-width: 6em;}
    .with20{width: 20%;float: left;}
    .form-group{width: auto;}
</style>
<div class="mt30">
    <div class="row">
        <div class="col-md-2 border-bottom">
            <span class="tab-header">预约状态：</span><?php
            $bookingStatus = $data->getBookingStatus() == null ? '<span class="color-blue">未填写</span>' : $data->getBookingStatus();
            echo $data->booking_status == StatCode::BK_STATUS_NULLIFY ? '<span class="color-red">' . $bookingStatus . '</span>' : $bookingStatus;
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
    <div class="row">
        <div class="col-md-4 border-bottom">
            <span class="tab-header">客户编号：</span><?php echo $data->ref_no == null ? '<span class="color-blue">未填写</span>' : $data->ref_no; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">患者姓名：</span><?php echo $data->patient_name == null ? '<span class="color-blue">未填写</span>' : $data->patient_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">患者电话：</span><?php echo $data->patient_mobile == null ? '<span class="color-blue">未填写</span>' : $data->patient_mobile; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">年龄：</span><?php echo $data->patient_age == null ? '<span class="color-blue">未填写</span>' : $data->patient_age; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">性别：</span><?php echo $data->getPatientGender() == null ? '<span class="color-blue">未填写</span>' : $data->getPatientGender(); ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">身份证：</span><?php echo $data->patient_identity == null ? '<span class="color-blue">未填写</span>' : $data->patient_identity; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">地址：</span><?php echo $data->patient_state; ?> 省/市 <?php echo $data->patient_city; ?> 市 <?php echo $data->patient_address; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">疾病名称：</span><?php echo $data->disease_name == null ? '<span class="color-blue">未填写</span>' : $data->disease_name; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">病情描述：</span><?php echo $data->disease_detail == null ? '<span class="color-blue">未填写</span>' : $data->disease_detail; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">期望手术时间：</span><?php echo $data->expected_time_start == null ? '<span class="color-blue">未填写</span>' : $data->expected_time_start; ?> — <?php echo $data->expected_time_end == null ? '<span class="color-blue">未填写</span>' : $data->expected_time_end; ?>
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
            <span class="tab-header">就诊方式：</span><?php echo $data->getTravelType(true) == null ? '无' : $data->getTravelType(true); ?>
        </div>
        <div class="col-md-8 border-bottom">
            <span class="tab-header">预约详情：</span><?php echo $data->booking_detail == null ? '无' : $data->booking_detail; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">理想医院：</span><?php echo $data->expected_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hospital_name; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">理想科室：</span><?php echo $data->expected_hp_dept_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hp_dept_name; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">理想专家：</span><?php echo $data->expected_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_doctor_name; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">理想专家电话：</span><?php echo $data->expected_doctor_mobile == null ? '<span class="color-blue">未填写</span>' : $data->expected_doctor_mobile; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">最终手术的医院：</span><?php echo $data->final_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->final_hospital_name; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">最终手术的专家：</span><?php echo $data->final_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->final_doctor_name; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">手术专家电话：</span><?php echo $data->final_doctor_mobile == null ? '<span class="color-blue">未填写</span>' : $data->final_doctor_mobile; ?>
        </div>
        <div class="col-md-3 border-bottom">
            <span class="tab-header">最终手术时间：</span><?php echo $data->final_time == null ? '<span class="color-blue">未填写</span>' : $data->final_time; ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="row">
        <div class="col-sm-2 border-bottom">
            <span>是否确诊：</span><?php echo $data->getDiseaseConfirm() == null ? '<span class="color-blue">未填写</span>' : $data->getDiseaseConfirm(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>患者目的：</span><?php echo $data->getCustomerRequest() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerRequest(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>导流来源：</span><?php echo $data->getCustomerDiversion() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerDiversion(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>平台渠道来源：</span><?php echo $data->getCustomerAgent() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerAgent(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>客户满意度：</span><?php echo $data->getCustomerIntention() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerIntention(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>客户类型：</span><?php echo $data->getCustomerType() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerType(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>公益项目：</span><?php echo $data->getIsCommonweal() == null ? '<span class="color-blue">未填写</span>' : $data->getIsCommonweal(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>B端：</span><?php echo $data->getBusinessPartner() == null ? '<span class="color-blue">未填写</span>' : $data->getBusinessPartner(); ?>
        </div>
        <div class="col-sm-2 border-bottom">
            <span>是否购买保险：</span><?php echo $data->getIsBuyInsurance() == null ? '<span class="color-blue">未填写</span>' : $data->getIsBuyInsurance(); ?>
        </div>
        <div class="col-sm-6 border-bottom">
            <span>是否成单：</span><?php echo $data->getIsDeal() == null ? '<span class="color-blue">未填写</span>' : $data->getIsDeal(); ?>
        </div>
        <div class="col-sm-2 border-bottom">销售总额：<?php echo $data->total_amount == null ? '无' : $data->total_amount; ?></div>
        <div class="col-sm-10 border-bottom">实际总收款：<?php echo $data->order_amount == null ? '无' : $data->order_amount; ?></div>
        <div class="col-sm-12 border-bottom">
            <span>录入日期：</span><?php echo $data->date_created; ?>
        </div>
        <div class="col-sm-12 border-bottom">
            <span>特殊备注：</span><?php echo $data->remark == null ? '<span class="color-blue">未填写</span>' : $data->remark; ?>
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
                <td>操作</td>
            </tr>
            <?php
            $adminTasksNotDone = $adminTasks['adminTasksNotDone'];
            if (isset($adminTasksNotDone) && arrayNotEmpty($adminTasksNotDone)) {
                foreach ($adminTasksNotDone as $bktask) {
                    ?>
                    <tr id="task<?php echo $bktask->id; ?>" class="odd">
                        <td><input class="bkTaskId" type="checkbox" value="<?php echo $bktask->id; ?>"></td>
                        <td><?php echo $bktask->date_plan; ?></td>
                        <td><?php echo $bktask->admin_user; ?></td>
                        <td><?php echo $bktask->work_type; ?></td>
                        <td><?php echo $bktask->content; ?></td>
                        <td><a class="completedTask" href="<?php echo $this->createUrl('admintask/ajaxCompletedTask', array('id' => $bktask->taskJoinId)) ?>">完成任务</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="6">无跟单记录</td></tr>';
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
                <td>完成时间</td>
            </tr>
            <?php
            $adminTasksDone = $adminTasks['adminTasksDone'];
            if (isset($adminTasksDone) && arrayNotEmpty($adminTasksDone)) {
                foreach ($adminTasksDone as $bktask) {
                    ?>
                    <tr id="task<?php echo $bktask->id; ?>" class="odd">
                        <td><input class="bkTaskId" type="checkbox" value="<?php echo $bktask->id; ?>"></td>
                        <td><?php echo $bktask->date_plan; ?></td>
                        <td><?php echo $bktask->admin_user; ?></td>
                        <td><?php echo $bktask->work_type; ?></td>
                        <td><?php echo $bktask->content; ?></td>
                        <td><?php echo $bktask->date_done; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="6">无跟单历史</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<div style="mt30">
    <h3>订单</h3>
    <?php
    if (arrayNotEmpty($orderList)) {
        ?>
        <div class="row mt10 mb10">
            <div class="col-sm-3">定金总额：<?php echo $data->deposit_total; ?></div>
            <div class="col-sm-3">已支付定金：<?php echo $data->deposit_paid; ?></div>
            <div class="col-sm-3">服务费总额：<?php echo $data->service_total; ?></div>
            <div class="col-sm-3">已支付服务费：<?php echo $data->service_paid; ?></div>
        </div>
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
                <?php
                foreach ($orderList as $order):
                    ?>
                    <?php if (isset($order)): ?>
                        <tr class="odd">
                            <td><?php echo $order->getRefNo(); ?></td>
                            <td><?php echo $order->getPingId(); ?></td>
                            <td><?php echo $order->getOrderType(); ?></td>
                            <td><?php echo $order->getSubject(); ?></td>
                            <td><?php echo $order->getDescription(); ?></td>
                            <td><?php echo $order->getFinalAmount(); ?></td>
                            <td><?php echo $order->getIsPaid(); ?></td>
                            <td><?php echo $order->date_closed == null ? '未支付' : $order->date_closed; ?></td>
                            <td><a href="<?php echo $urlOrderView . '/' . $order->getId(); ?>" class="btn-admin btn-default" target="_blank">查看</a></td>
                        <?php endif; ?>
                        <?php
                    endforeach;
                }
                ?>
        </tbody>
    </table>
    <?php
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
?>

<script>
    $(document).ready(function () {
        //创建之前先确定KA/地推是否存在
        $('#createAdminBKOrder').click(function (e) {
            e.preventDefault();
            var bdUser = '<?php echo $data->bd_user_name; ?>';
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
                innerHtml += '<div class="col-sm-2 mt10 docImg"><a data-toggle="modal" data-target="#showImgModal" data-src="' + file.absFileUrl + '"><img src="' + file.absFileUrl + '"/></a><div><a class="deleteFile" href="<?php echo $urlDeleteFile; ?>/' + file.id + '">删除图片</a></div><div class="fileDate mt5">' + file.dateCreated + '</div></div>';
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