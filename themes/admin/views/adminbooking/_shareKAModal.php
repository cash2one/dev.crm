<style>
    #shareKAModal>.modal-dialog{width: 400px;}
</style>
<div class="modal" id="shareKAModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <span class="tab-header">疾病名称：</span><?php echo $data->disease_name == null ? '<span class="color-blue">未填写</span>' : $data->disease_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">病情描述：</span><?php echo $data->disease_detail == null ? '<span class="color-blue">未填写</span>' : $data->disease_detail; ?>
                    </div>
                </div>
                <div class="clearfix mt10">
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">理想医院：</span><?php echo $data->expected_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hospital_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">理想专家：</span><?php echo $data->expected_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_doctor_name; ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">所需服务：</span><?php echo $data->getCustomerRequest() == null ? '<span class="color-blue">未填写</span>' : $data->getCustomerRequest(); ?>
                    </div>
                    <div class="col-md-12 border-bottom">
                        <span class="tab-header">期望手术时间：</span>
                        <div>
                            <?php echo $data->expected_time_start == null ? '<span class="color-blue">未填写</span>' : date('Y-m-d', strtotime($data->expected_time_start)); ?> — <?php echo $data->expected_time_end == null ? '<span class="color-blue">未填写</span>' : date('Y-m-d', strtotime($data->expected_time_end)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
