<style>
    #shareModal>.modal-dialog{width: 500px;}
</style>
<div class="modal" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center strong">预约信息</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                    <div class="col-md-12 border-bottom pad0">
                        <span class="">患者姓名：</span><?php echo $data->patient_name == null ? '<span class="color-blue">未填写</span>' : $data->patient_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom pad0">
                        <span class="">年龄：</span><?php echo $data->patient_age == null ? '<span class="color-blue">未填写</span>' : $data->patient_age; ?>
                    </div>
                    <div class="col-md-12 border-bottom pad0">
                        <span class="">性别：</span><?php echo $data->getPatientGender() == null ? '<span class="color-blue">未填写</span>' : $data->getPatientGender(); ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">患者区域：</span><?php echo $data->patient_state; ?> 省/市 <?php echo $data->patient_city; ?> 市
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">疾病名称：</span><?php echo $data->disease_name == null ? '<span class="color-blue">未填写</span>' : $data->disease_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">病情描述：</span><?php echo $data->disease_detail == null ? '<span class="color-blue">未填写</span>' : $data->disease_detail; ?>
                    </div>
                </div>
                <div class="clearfix mt10">
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">推送医生姓名：</span><?php echo $bookingCreator->name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">推送医生所在医院：</span><?php echo $bookingCreator->hpName; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">推送医生所在科室：</span><?php echo $bookingCreator->hpDeptName; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">就诊方式：</span><?php echo $data->getTravelType(true) == null ? '无' : $data->getTravelType(true); ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">预约详情：</span><?php echo $data->booking_detail == null ? '无' : $data->booking_detail; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">理想医院：</span><?php echo $data->expected_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hospital_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">理想科室：</span><?php echo $data->expected_hp_dept_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hp_dept_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">理想专家：</span><?php echo $data->expected_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_doctor_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">最终手术的医院：</span><?php echo $data->final_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->final_hospital_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">最终手术的专家：</span><?php echo $data->final_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->final_doctor_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">最终手术时间：</span><?php echo $data->final_time == null ? '<span class="color-blue">未填写</span>' : $data->final_time; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">录入日期：</span><?php echo $data->date_created == null ? '<span class="color-blue">未填写</span>' : $data->date_created; ?>
                    </div>
                    <?php
                    $depositPaid = true;
                    $servicePaid = true;
                    $depositCount = 0;
                    $serviceCount = 0;
                    if (arrayNotEmpty($orderList)) {
                        foreach ($orderList as $order):
                            if ($order->order_type == SalesOrder::ORDER_TYPE_DEPOSIT) {
                                $depositCount ++;
                            } elseif ($order->order_type == SalesOrder::ORDER_TYPE_SERVICE) {
                                $serviceCount ++;
                            }
                            if ($order->order_type == SalesOrder::ORDER_TYPE_DEPOSIT && $order->is_paid == SalesOrder::ORDER_UNPAIDED) {
                                $depositPaid = false;
                            }else
                            if ($order->order_type == SalesOrder::ORDER_TYPE_SERVICE && $order->is_paid == SalesOrder::ORDER_UNPAIDED) {
                                $servicePaid = false;
                            }
                        endforeach;
                        ?>
                        <div class="col-md-12 border-bottom">
                            <span class="tab-header">定金支付：</span><?php echo $depositPaid && $depositCount > 0 ? '已支付' : '未支付'; ?>
                        </div>

                        <div class="col-md-12 border-bottom">
                            <span class="tab-header">服务费支付：</span><?php echo $servicePaid && $serviceCount > 0 ? '已支付' : '未支付'; ?>
                        </div>
                        <?php
                    }
                    if (!arrayNotEmpty($orderList)) {
                        ?>
                        <div class="col-md-12 border-bottom">
                            <span class="tab-header">定金支付：</span><?php echo '未生成订单'; ?>
                        </div>

                        <div class="col-md-12 border-bottom">
                            <span class="tab-header">服务费支付：</span><?php echo '未生成订单'; ?>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
