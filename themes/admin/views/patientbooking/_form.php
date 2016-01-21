<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);?>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'patient-booking-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

<div class="text-danger"><?php echo $form->errorSummary($model); ?></div>
    <div class="form-horizontal">
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'ref_no'); ?></label>
            <div>
<?php echo $form->textField($model, 'ref_no', array('size' => 14, 'maxlength' => 14, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'ref_no'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'patient_id'); ?></label>
            <div>
<?php echo $form->textField($model, 'patient_id', array('class' => 'form-control')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'patient_id'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'creator_id'); ?></label>
            <div>
<?php echo $form->textField($model, 'creator_id', array('class' => 'form-control')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'creator_id'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'status'); ?></label>
            <div>
<?php echo $form->textField($model, 'status', array('class' => 'form-control')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'status'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'travel_type'); ?></label>
            <div>
<?php echo $form->textField($model, 'travel_type', array('class' => 'form-control')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'travel_type'); ?></div>
            </div>
        </div>

        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'date_start'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_start', array('class' => 'form-control date_start')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'date_start'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'date_end'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_end', array('class' => 'form-control date_end')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'date_end'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'detail'); ?></label>
            <div>
<?php echo $form->textField($model, 'detail', array('size' => 60, 'maxlength' => 1000, 'class' => 'form-control')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'detail'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'appt_date'); ?></label>
            <div>
<?php echo $form->textField($model, 'appt_date', array('class' => 'form-control appt_date')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'appt_date'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'date_confirm'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_confirm', array('class' => 'form-control date_confirm')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'date_confirm'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'remark'); ?></label>
            <div>
<?php echo $form->textField($model, 'remark', array('class' => 'form-control', 'size' => 60, 'maxlength' => 500)); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'remark'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'date_created'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_created', array('class' => 'form-control date_created', 'size' => 60, 'maxlength' => 500)); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'date_created'); ?></div>
            </div>
        </div>

        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'date_updated'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_updated', array('class' => 'form-control date_updated')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'date_updated'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'date_deleted'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_deleted', array('class' => 'form-control date_deleted')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'date_deleted'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <input type="submit" class="btn btn-primary" value="<?php echo $model->isNewRecord ? 'Create' : 'Save'?>" />
        </div>

<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
<script>
 $(document).ready(function () {
           var days = "";
        //开始日期
        var date = $(".date_start").datepicker({
            startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        }).on('changeDate', function (e) {
            $('.date_end').datepicker('setStartDate', getStartTiem(e.date));
        });

        //结束日期
        $(".date_end").datepicker({
            startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight:true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });

        //根据开始时间返回结束时间， +7天
        function getStartTiem(date) {
            var timestamp = date.getTime();
            var newDate = new Date(timestamp + 7 * 24 * 3600 * 1000);
            var startdate = [newDate.getFullYear(), newDate.getMonth() + 1, newDate.getDate()].join('-');
            return startdate;
        }
        $(".appt_date").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight:true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
         $(".date_confirm").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight:true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });  
        $(".date_created").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight:true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        $(".date_updated").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight:true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        $(".date_deleted").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight:true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
});
</script>