<style>
    .datetimepicker-dropdown{z-index: 9999!important;}
</style>
<div class="modal fade" id="addCsExplainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">补充说明</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'explain-form',
                    'action' => $this->createUrl('adminbooking/addCsExplain'),
                    'htmlOptions' => array('class' => 'form-horizontal'),
                    'enableAjaxValidation' => false,
                ));
                echo CHtml::hiddenField("AdminBookingForm[id]", $model->id);
                ?>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label">补充说明</label>
                        <?php echo $form->textArea($model, 'cs_explain', array('class' => 'form-control w50', 'maxlength' => 500, 'rows' => 5, 'placeholder' => '请填写说明')); ?>
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