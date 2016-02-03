<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/adminbooking.css");
$urlLoadFiles = $this->createUrl('adminbooking/bookingFile', array('id' => $model->id));
$urlUpdateAdminBooking = $this->createUrl('adminbooking/update', array('id' => $model->id));
$urlUploadSummary = $this->createUrl('adminbooking/uploadsummary', array('id' => $model->id));
$orderList = isset($orderList) ? $orderList : null;
?>
<h1 class="">预约患者</h1>
<div class="mt30">
    <a href="<?php echo $urlUpdateAdminBooking; ?>" class="btn btn-primary">修改订单</a>
    <a href="" class="btn btn-primary">生成订单</a>
    <a href="" class="btn btn-primary">关联医生</a>
    <a href="" class="btn btn-primary">授权KA/地推</a>
    <a href="" class="btn btn-primary">分配业务员</a>
    <a href="<?php echo $urlUploadSummary; ?>" class="btn btn-primary">上传出院小结</a>
</div>
<style>
    .border-bottom{border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;}
    .tab-header{display: inline-block;min-width: 6em;}
    .with20{width: 20%;float: left;}
</style>
<div class="mt30">
    <div class="row">
        <div class="col-md-4 border-bottom">
            <span class="tab-header">客户编号：</span><?php echo $model->booking_id == null ? '未填写' : $model->booking_id; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">患者姓名：</span><?php echo $model->patient_name == null ? '未填写' : $model->patient_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">患者电话：</span><?php echo $model->patient_mobile == null ? '未填写' : $model->patient_mobile; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">年龄：</span><?php echo $model->patient_age == null ? '未填写' : $model->patient_age; ?>
        </div>
        <div class="col-md-8 border-bottom">
            <span class="tab-header">身份证：</span><?php echo $model->patient_identity == null ? '未填写' : $model->patient_identity; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">地址：</span><?php echo $model->patient_state; ?> 省/市 <?php echo $model->patient_city; ?> 市 <?php echo $model->patient_address; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">疾病诊断：</span><?php echo $model->disease_name == null ? '未填写' : $model->disease_name; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">病情描述：</span><?php echo $model->disease_detail == null ? '未填写' : $model->disease_detail; ?>
        </div>
        <div class="col-md-12 border-bottom">
            <span class="tab-header">期望手术时间：</span><?php echo $model->expected_time_start == null ? '未填写' : $model->expected_time_start; ?> — <?php echo $model->expected_time_start == null ? '未填写' : $model->expected_time_start; ?>
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
            <span class="tab-header">理想医院：</span><?php echo $model->expected_hospital_name == null ? '未填写' : $model->expected_hospital_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">理想科室：</span><?php echo $model->expected_hp_dept_name == null ? '未填写' : $model->expected_hp_dept_name; ?>
        </div>
        <div class="col-md-4 border-bottom">
            <span class="tab-header">理想专家：</span><?php echo $model->experted_doctor_name == null ? '未填写' : $model->experted_doctor_name; ?>
        </div>
        <div class="col-md-6 border-bottom">
            <span class="tab-header">最终手术的医生：</span><?php echo $model->final_doctor_name == null ? '未填写' : $model->final_doctor_name; ?>
        </div>
        <div class="col-md-6 border-bottom">
            <span class="tab-header">最终手术时间：</span><?php echo $model->final_time == null ? '未填写' : $model->final_time; ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="row">
        <div class="col-sm-12 border-bottom">
            <div class="with20">
                <span>是否确诊：</span><?php echo $model->disease_confirm == null ? '未填写' : $model->disease_confirm; ?>
            </div>
            <div class="with20">
                <span>患者目的：</span><?php echo $model->getCustomerRequest() == null ? '未填写' : $model->getCustomerRequest(); ?>
            </div>
            <div class="with20">
                <span>客户意向：</span><?php echo $model->getCustomerIntention() == null ? '未填写' : $model->getCustomerIntention(); ?>
            </div>
            <div class="with20">
                <span>客户类型：</span><?php echo $model->getCustomerType() == null ? '未填写' : $model->getCustomerType(); ?>
            </div>
            <div class="with20">
                <span>导流来源：</span><?php echo $model->getCustomerDiversion() == null ? '未填写' : $model->getCustomerDiversion(); ?>
            </div>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>跟进状态：</span><?php echo $model->getBookingStatue() == null ? '未填写' : $model->getBookingStatue(); ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>付费状态：</span><?php echo $model->order_status == null ? '未填写' : $model->order_status; ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>付费金额：</span><?php echo $model->order_amount == null ? '未填写' : $model->order_amount; ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>录入日期：</span><?php echo $model->date_created; ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>业务员：</span><?php echo $model->admin_user_name == null ? '未填写' : $model->admin_user_name; ?>
        </div>
        <div class="col-sm-4 border-bottom">
            <span>客户来源：</span><?php echo $model->getCustomerAgent() == null ? '未填写' : $model->getCustomerAgent(); ?>
        </div>
        <div class="col-sm-12 border-bottom">
            <span>特殊备注：</span><?php echo $model->remark == null ? '未填写' : $model->remark; ?>
        </div>
    </div>
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
<script>
    $(document).ready(function () {
        var urlLoadFiles = '<?php echo $urlLoadFiles; ?>';
        $.ajax({
            url: urlLoadFiles,
            success: function (data) {
                if (data.status == 'ok') {
                    setFileHtml(data.results);
                }
            }
        });
    });
    function setFileHtml(results) {
        if (results) {
            var innerHtml = '';
            var files = results.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                innerHtml += '<div class="col-sm-2 mt10 docImg"><img src="' + file.absThumbnailUrl + '"/></div>';
            }
        } else {
            var innerHtml = '<div class="col-sm-12 mt10">未上传图片</div>';
        }
        $('.bookingImgList').html(innerHtml);
    }
</script>