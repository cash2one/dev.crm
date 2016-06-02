<style>
    .datepicker-dropdown{z-index: 9999!important;}
</style>
<div class="modal fade" id="updateFinalTimeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">补充说明</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'final-time-form',
                    'action' => $this->createUrl('adminbooking/updateFinalTime'),
                    'htmlOptions' => array('class' => 'form-horizontal'),
                    'enableAjaxValidation' => false,
                ));
                echo CHtml::hiddenField("AdminBookingForm[id]", $model->id);
                ?>

                <div class="form-group">
                    <div class="col-sm-5 col-md-3">
                        <label class="control-label">最终手术时间</label>
                    </div>
                    <div class="col-sm-7 col-md-5">
                        <?php echo $form->textField($model, 'final_time', array('class' => 'form-control datepicker', 'placeholder' => '请选择最终手术时间')); ?>
                    </div>
                </div>
                <div class="mt20 text-right clearfix">
                    <button type="submit" class="btn btn-primary">保存</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->