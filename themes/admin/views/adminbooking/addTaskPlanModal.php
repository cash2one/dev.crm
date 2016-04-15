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
                <div class="mt20 text-right clearfix">
                    <button id='taskSubmit' type="button" class="btn btn-primary">保存任务</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->