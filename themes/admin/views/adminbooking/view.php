<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/adminbooking.css");
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datetimepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.zh-CN.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/custom/task.js", CClientScript::POS_END);

if ($data->booking_type == AdminBooking::BK_TYPE_CRM) {
    $urlLoadFiles = $this->createUrl('adminbooking/adminBookingFile', array('id' => $data->id));
    $urlLoadDCFiles = $this->createUrl('adminbooking/adminBookingFile', array('id' => $data->id, 'type' => 'dc'));
} else if ($data->booking_type == AdminBooking::BK_TYPE_PB) {
    $urlLoadFiles = $this->createUrl('patientbooking/patientMRFiles', array('id' => $data->patient_id));
    $urlLoadDCFiles = $this->createUrl('patientbooking/patientMRFiles', array('id' => $model->patient_id, 'type' => 'dc'));
} else {
    $urlLoadFiles = $this->createUrl('booking/bookingFile', array('id' => $data->id));
    $urlLoadDCFiles = $this->createUrl('booking/bookingFile', array('id' => $data->id, 'type' => 'dc'));
}
$urlUpdateAdminBooking = $this->createUrl('adminbooking/update', array('id' => $data->id));
$urlUploadSummary = $this->createUrl('adminbooking/uploadsummary', array('id' => $data->id, 'bktype' => $data->booking_type));
$deleteTaskUrl = $this->createUrl('adminTask/ajaxDeleteTask', array('id' => ''));
$urlOrderView = $this->createAbsoluteUrl('order/view', array('id' => ''));
$orderList = isset($orderList) ? $orderList : null;
?>
<h1 class="">预约</h1>
<div class="mt30">
    <a href="<?php echo $urlUpdateAdminBooking; ?>" class="btn btn-primary" <?php echo $data->booking_status == StatCode::BK_STATUS_INVALID ? 'disabled' : ''; ?>>修改订单</a>
    <a href="<?php echo $this->createUrl('order/createAdminBKOrder', array('bid' => $data->id)); ?>" class="btn btn-primary" <?php echo $data->booking_status == StatCode::BK_STATUS_INVALID ? 'disabled' : ''; ?>>生成订单</a>
    <a href="<?php echo $this->createUrl('adminBooking/relateDoctor', array('bid' => $data->id)); ?>" class="btn btn-primary" <?php echo $data->booking_status == StatCode::BK_STATUS_INVALID ? 'disabled' : ''; ?>>关联医生</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addBdUserModal" <?php echo $data->booking_status == StatCode::BK_STATUS_INVALID ? 'disabled' : ''; ?>>授权KA/地推</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#addAdminUserModal" <?php echo $data->booking_status == StatCode::BK_STATUS_INVALID ? 'disabled' : ''; ?>>分配业务员</a>
    <a class="btn btn-primary" data-toggle="modal" data-target="#updateStatusModal" <?php echo $data->booking_status == StatCode::BK_STATUS_INVALID ? 'disabled' : ''; ?>>修改预约状态</a>
    <a href="<?php echo $urlUploadSummary; ?>" class="btn btn-primary" <?php echo $data->booking_status == StatCode::BK_STATUS_INVALID ? 'disabled' : ''; ?>>上传出院小结</a>
</div>
<style>
    .border-bottom{border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;}
    .tab-header{display: inline-block;min-width: 6em;}
    .with20{width: 20%;float: left;}
    .form-group{width: auto;}
</style>
<div class="mt30">
    <div class="row">
        <div class="col-md-4 border-bottom">
            <span class="tab-header">预约状态：</span><?php echo $data->getBookingStatue() == null ? '<span class="color-blue">未填写</span>' : $data->getBookingStatue(); ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>地推/KA：</span><?php echo $data->bd_user_name == null ? '<span class="color-blue">未填写</span>' : $data->bd_user_name; ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>业务员：</span><?php echo $data->admin_user_name == null ? '<span class="color-blue">未填写</span>' : $data->admin_user_name; ?>
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
        <div class="col-md-8 border-bottom">
            <span class="tab-header">身份证：</span><?php echo $data->patient_identity == null ? '<span class="color-blue">未填写</span>' : $data->patient_identity; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">地址：</span><?php echo $data->patient_state; ?> 省/市 <?php echo $data->patient_city; ?> 市 <?php echo $data->patient_address; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">疾病诊断：</span><?php echo $data->disease_name == null ? '<span class="color-blue">未填写</span>' : $data->disease_name; ?>
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
            <span class="tab-header">理想医院：</span><?php echo $data->expected_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hospital_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">理想科室：</span><?php echo $data->expected_hp_dept_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hp_dept_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">理想专家：</span><?php echo $data->expected_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_doctor_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">最终手术的医院：</span><?php echo $data->final_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->final_hospital_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">最终手术的医生：</span><?php echo $data->final_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->final_doctor_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">最终手术时间：</span><?php echo $data->final_time == null ? '<span class="color-blue">未填写</span>' : $data->final_time; ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="row">
        <div class="col-sm-12 border-bottom">
            <div class="with20">
                <span>是否确诊：</span><?php echo $data->getDiseaseConfirm() == null ? '<span class="color-blue">未填写</span>' : $data->getDiseaseConfirm(); ?>
            </div>
            <div class="with20">
                <span>患者目的：</span><?php echo $data->getCustomerRequest() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerRequest(); ?>
            </div>
            <div class="with20">
                <span>客户意向：</span><?php echo $data->getCustomerIntention() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerIntention(); ?>
            </div>
            <div class="with20">
                <span>客户类型：</span><?php echo $data->getCustomerType() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerType(); ?>
            </div>
            <div class="with20">
                <span>导流来源：</span><?php echo $data->getCustomerDiversion() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerDiversion(); ?>
            </div>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>付费状态：</span><?php echo $data->getOrderStatus() == null ? '<span class="color-blue">未填写</span>' : $data->getOrderStatus(); ?>
        </div>
        <div class="col-sm-8 border-bottom">
            <span>付费金额：</span><?php echo $data->order_amount == null ? '<span class="color-blue">未填写</span>' : $data->order_amount; ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>客户来源：</span><?php echo $data->getCustomerAgent() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerAgent(); ?>
        </div>
        <div class="col-sm-8 border-bottom">
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
                <td>跟单人员</td>
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
                        <td><?php echo $bktask->content; ?></td>
                        <td><a class="completedTask" href="<?php echo $this->createUrl('adminTask/ajaxCompletedTask', array('id' => $bktask->taskJoinId)) ?>">完成任务</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="5">无跟单记录</td></tr>';
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
                <td>跟单人员</td>
                <td>跟单方式</td>
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
                        <td><?php echo $bktask->content; ?></td>
                        <td><?php echo $bktask->date_done; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="5">无跟单历史</td></tr>';
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
$this->renderPartial('updateStatusModal', array('model' => $model));
?>
<style>
    .datetimepicker-dropdown{z-index: 9999!important;}
</style>
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">跟单任务</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'task-form',
                    'htmlOptions' => array('class' => 'form-horizontal', 'data-action' => $this->createUrl('adminTask/ajaxCreate')),
                    'enableAjaxValidation' => false,
                ));
                echo CHtml::hiddenField("task[booking_id]", $model->id);
                ?>
                <div class="form-group">
                    <label for="inputDate" class="col-sm-2 control-label">计划跟单时间</label>
                    <div class="col-sm-2">
                        <input type="text" id='task_date_plan' name='task[date_plan]' class="form-control" placeholder="计划跟单时间">
                    </div>
                    <label for="inputUser" class="col-sm-2 control-label">跟单人员</label>
                    <div class="col-sm-2">
                        <?php
                        echo $form->dropDownList($model, 'admin_user_id', $model->loadOptionsAdminUser(), array(
                            'name' => 'task[admin_user_id]',
                            'prompt' => '选择',
                            'class' => 'form-control',
                        ));
                        ?>
                    </div>
                    <label for="inputType" class="col-sm-2 control-label">跟单方式</label>
                    <div class="col-sm-2">
                        <select name="task[work_type]" class="form-control" id="task_work_type">
                            <option value="1">电话</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label">跟单内容</label>
                        <textarea id='task_content' name='task[content]' class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="mt20 text-right clearfix">
                    <button id='taskSubmit' type="button" class="btn btn-primary">保存任务</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {
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
            url: '<?php echo $this->createUrl('adminTask/ajaxReadTask', array('id' => '')); ?>/' + id
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
                innerHtml += '<div class="col-sm-2 mt10 docImg"><img src="' + file.absThumbnailUrl + '"/><div class="mt5">' + file.dateCreated + '</div></div>';
            }
        } else {
            var innerHtml = '<div class="col-sm-12 mt10">未上传图片</div>';
        }
        fileDom.html(innerHtml);
    }
</script>