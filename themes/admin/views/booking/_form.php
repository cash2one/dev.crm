<?php
/* @var $this BookingController */
/* @var $model BookingFormAdmin */
/* @var $booking Booking */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'booking-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
   <div class="text-danger"><?php echo $form->errorSummary($model); ?></div>
    <div class="row">
        <?php echo $form->labelEx($model, 'id'); ?>
        <span><?php echo $model->id; ?></span>        
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'ref_no'); ?>
        <span><?php echo $model->ref_no; ?></span>        
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <span><?php echo $model->user_id; ?></span>        
    </div>
    <br />
    <div class="row">
        <?php echo $form->labelEx($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile', array('size' => 11, 'maxlength' => 11)); ?>
        <?php echo $form->error($model, 'mobile'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contact_name'); ?>
        <?php echo $form->textField($model, 'contact_name', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'contact_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', $model->loadOptionsStatus()); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'booking_type'); ?>
        <span><?php echo $model->getBookingTypeText(); ?></span>        
    </div>
    <br />
    <div class="row">
        <?php echo $form->labelEx($model, 'faculty_id'); ?>
        <?php echo $form->dropDownList($model, 'faculty_id', $model->loadOptionsFaculty()); ?>
        <?php echo $form->error($model, 'faculty_id'); ?>
    </div>
    <br />
    <div class="row">
        <?php echo $form->labelEx($model, 'doctor_id'); ?>
        <?php echo $form->textField($model, 'doctor_id'); ?>        
        <?php echo $form->error($model, 'doctor_id'); ?>
    </div>
    <br />
    <div class="row">
        <?php echo $form->labelEx($model, 'expteam_id'); ?>
        <?php echo $form->textField($model, 'expteam_id'); ?>
        <?php echo $form->error($model, 'expteam_id'); ?>
    </div>
    <br />
    <div class="row">
        <?php echo $form->labelEx($model, 'hospital_id'); ?>
        <?php echo $form->textField($model, 'hospital_id'); ?>
        <?php echo $form->error($model, 'hospital_id'); ?>
    </div>  
    <br />
    <div class="row">
        <?php echo $form->labelEx($model, 'hospital_dept'); ?>
        <?php echo $form->textField($model, 'hospital_dept', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'hospital_dept'); ?>
    </div>
    <br />
    <div class="row">
        <?php echo $form->labelEx($model, 'patient_condition'); ?>
        <?php echo $form->textarea($model, 'patient_condition', array('size' => 60, 'rows' => 10, 'cols' => 100, 'maxlength' => 500)); ?>
        <?php echo $form->error($model, 'patient_condition'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'appt_date'); ?>
        <div>日期格式为: yyyy-mm-dd, 例: 2015-05-21</div>
        <?php echo $form->textField($model, 'appt_date'); ?>
        <?php echo $form->error($model, 'appt_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contact_email'); ?>        
        <?php echo $form->textField($model, 'contact_email', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'contact_email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contact_weixin'); ?>
        <?php echo $form->textField($model, 'contact_weixin', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'contact_weixin'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->