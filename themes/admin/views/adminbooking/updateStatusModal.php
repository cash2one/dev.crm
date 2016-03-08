<div class="modal fade" id="addAdminUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog mt100">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">分配业务员</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'booking-form',
                    'action'=>$this->createUrl('adminbooking/addAdminUser'),
                    'htmlOptions' => array('class' => 'form-inline text-center'),
                    'enableAjaxValidation' => false,
                ));
                echo CHtml::hiddenField("AdminBookingForm[id]", $model->id);
                ?>
                <div class="form-group">
                    <span>业务员：&nbsp;&nbsp;&nbsp;</span><?php
                    echo $form->dropDownList($model, 'admin_user_id', $model->loadOptionsAdminUser(), array(
                        'name' => 'AdminBookingForm[admin_user_id]',
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