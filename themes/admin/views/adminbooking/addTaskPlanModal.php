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
                    'htmlOptions' => array('class' => 'form-horizontal', 'data-action' => $this->createUrl('admintask/ajaxCreate')),
                    'enableAjaxValidation' => false,
                ));
                echo CHtml::hiddenField("task[booking_id]", $model->id);
                ?>
                <div class="form-group">
                    <label for="inputDate" class="col-sm-2 control-label">计划跟单时间</label>
                    <div class="col-sm-2 pl0 pr0">
                        <input type="text" id='task_date_plan' name='task[date_plan]' class="form-control" placeholder="计划跟单时间">
                    </div>
                    <label for="inputUser" class="col-sm-2 control-label">客服</label>
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
                <div class="form-group">
                    <div class="col-sm-12">
                        <p><span>模板</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="togglerTemplete">展开></span></p>
                        <ul class="taskTemplete">
                            <li>已经跟医生确认，患者手术时间是****，医生已经跟患者介绍过平台服务。</li>
                            <li>医生电话无人接听/拒接</li>
                            <li>发送****的支付链接。</li>
                            <li>已经支付服务费。</li>
                            <li>患者年龄超过70岁/小于4岁/手术未满24小时，需要审批，已经反馈给负责人审批。</li>
                            <li>已经收到患者大于70岁/小于4岁/手术未满24小时的审批，已经上传。</li>
                            <li>患者购买保险****，总会诊费****。</li>
                            <li>未收到患者审批截图，反馈给负责人。</li>
                            <li>支付链接发送5天，一直未付费，已经反馈给负责人。</li>
                            <li>术后回访，患者恢复良好，对平台服务满意。</li>
                            <li>术后回访，患者电话拒接/无人接。</li>
                            <li>术后回访上级专家，专家对平台服务满意。</li>
                            <li>病例重复提交，跟进无效。</li>
                            <li>患者手术取消，病例无效。</li>
                        </ul>
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
        $('#togglerTemplete').click(function(){
            var isShow = $('.taskTemplete').is(':visible');
            if(isShow){
                $(this).text('展开>');
            }else{
                $(this).text('收起>');
            }
            $('.taskTemplete').toggle();
        });
        $('.taskTemplete>li').click(function(){
            var taskContent = $(this).text();
            $('#task-form #task_content').val(taskContent);
        });
    });
</script>