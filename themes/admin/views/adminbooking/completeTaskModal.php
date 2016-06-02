<div class="modal fade" id="completeTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog mt100">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">完成跟单</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'complete-task-form',
                    'action' => $this->createUrl('admintask/ajaxCompletedTaskByFinishedUser'),
                    'htmlOptions' => array('class' => 'form-inline text-center'),
                    'enableAjaxValidation' => false,
                ));
                echo CHtml::hiddenField("task[id]");
                ?>
                <div class="form-group">
                    <span>完成人：&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" class="form-control" name="task[finished_user_name]" id="task_finished_user_name"/>
                    <button class="btn btn-primary ml15" type="button" id="completeTaskSubmit">保存</button>
                </div>
                <?php $this->endWidget(); ?>
                <br/><br/><br/>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {
        $('#completeTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body input#task_id').val(id);
        });
        $('#completeTaskSubmit').click(function (e) {
            e.preventDefault();
            var domForm = $('#complete-task-form');
            var actionUrl = domForm.attr('action');
            var formdata = domForm.serialize();
            var finishedUserName = $('#task_finished_user_name').val();
            if (finishedUserName.length === 0) {
                $("#task_finished_user_name-error").remove();
                $("#task_finished_user_name").parents('.form-group').append('<div id="task_finished_user_name-error" class="error text-left mt5">请填写完成人</div>');
            } else {
                $.ajax({
                    url: actionUrl,
                    data: formdata,
                    type: 'post',
                    success: function (data) {
                        if (data.status == 'ok') {
                            location.reload();
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });
    });
</script>