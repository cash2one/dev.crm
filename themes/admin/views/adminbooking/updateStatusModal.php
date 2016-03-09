<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog mt100">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">分配业务员</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'status-form',
                    'action' => $this->createUrl('adminbooking/updateBookingStatus'),
                    'htmlOptions' => array('class' => 'form-inline text-center'),
                    'enableAjaxValidation' => false,
                ));
                echo CHtml::hiddenField("AdminBookingForm[id]", $model->id);
                ?>
                <div class="form-group">
                    <span>预约状态：&nbsp;&nbsp;&nbsp;</span><?php
                    echo $form->dropDownList($model, 'booking_status', $model->loadOptionsBookingStatus(), array(
                        'name' => 'AdminBookingForm[booking_status]',
                        'prompt' => '选择',
                        'class' => 'form-control',
                    ));
                    ?>
                    <button id="addAdminUserBtn" class="btn btn-primary ml15" type="submit" name="yt0">保存</button>
                </div>
                <?php $this->endWidget(); ?>
                <br/><br/><br/>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {
        $('#status-form').submit(function (e) {
            var BK_STATUS_INVALID = '<?php echo StatCode::BK_STATUS_INVALID; ?>';
            if ($('#AdminBookingForm_booking_status').val() == BK_STATUS_INVALID) {
                if (confirm('确认该预约无效吗?')) {
                } else {
                    e.preventDefault();
                    return;
                }
            }
        });
    });
</script>