<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */
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
        'id' => 'admin-user-form',
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
            <label > <?php echo $form->labelEx($model, 'username'); ?></label>
            <div>
                <?php echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'username'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'password'); ?></label>
            <div>
                <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'password'); ?></div>
            </div>
        </div>
<div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'password_raw'); ?></label>
            <div>
                <?php echo $form->passwordField($model, 'password_raw', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'password_raw'); ?></div>
            </div>
        </div>
       <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'password_salt'); ?></label>
            <div>
                <?php echo $form->passwordField($model, 'password_salt', array('size' => 40, 'maxlength' => 40, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'password_salt'); ?></div>
            </div>
        </div>
  <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'role'); ?></label>
            <div>
                <?php echo $form->textField($model, 'role', array('size' => 20, 'maxlength' => 20, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'role'); ?></div>
            </div>
        </div>
  <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'fullname'); ?></label>
            <div>
                <?php echo $form->textField($model, 'fullname', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'fullname'); ?></div>
            </div>
        </div>
     <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'mobile'); ?></label>
            <div>
                <?php echo $form->textField($model, 'mobile', array('size' => 11, 'maxlength' => 11, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'mobile'); ?></div>
            </div>
        </div>
<div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'email'); ?></label>
            <div>
                <?php echo $form->textField($model, 'email', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'email'); ?></div>
            </div>
        </div>
<div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'wechat'); ?></label>
            <div>
                <?php echo $form->textField($model, 'wechat', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'wechat'); ?></div>
            </div>
        </div>
 <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'qq'); ?></label>
            <div>
                <?php echo $form->textField($model, 'qq', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'qq'); ?></div>
            </div>
        </div>
<div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'state_id'); ?></label>
            <div>
                <?php echo $form->textField($model, 'state_id', array('class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'state_id'); ?></div>
            </div>
        </div>
<div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'state_name'); ?></label>
            <div>
                <?php echo $form->textField($model, 'state_name', array('class' => 'form-control','size' => 10, 'maxlength' => 10)); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'state_name'); ?></div>
            </div>
        </div>
<div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'city_id'); ?></label>
            <div>
                <?php echo $form->textField($model, 'city_id', array('class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'city_id'); ?></div>
            </div>
        </div>
<div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'city_name'); ?></label>
            <div>
                <?php echo $form->textField($model, 'city_name', array('class' => 'form-control','size' => 10, 'maxlength' => 10)); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'city_name'); ?></div>
            </div>
        </div>
   <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'is_active'); ?></label>
            <div>
                <?php echo $form->textField($model, 'is_active', array('class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'is_active'); ?></div>
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

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
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