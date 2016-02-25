<?php
/* @var $this AdminTaskController */
/* @var $model AdminTask */
/* @var $form CActiveForm */
?>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
?>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-task-form',
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
            <label > <?php echo $form->labelEx($model, 'subject'); ?></label>
            <div>
<?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'subject'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'content'); ?></label>
            <div>
<?php echo $form->textField($model, 'content', array('size' => 60, 'maxlength' => 500, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'content'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'url'); ?></label>
            <div>
<?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'url'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'date_created'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_created', array('class' => 'form-control date_created')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'date_created'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'date_updated'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_updated', array('class' => 'form-control date_updated')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'date_updated'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'date_deleted'); ?></label>
            <div>
<?php echo $form->textField($model, 'date_deleted', array('class' => 'form-control date_deleted')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'date_deleted'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <input type="submit" class="btn btn-primary" value="<?php echo $model->isNewRecord ? 'Create' : 'Save' ?>" />
        </div>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(document).ready(function () {
        //开始日期
        $(".date_created").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        $(".date_updated").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        $(".date_deleted").datepicker({
            startDate: "now",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
    });
</script>