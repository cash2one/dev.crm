<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ref_no'); ?>
        <?php echo $form->textField($model, 'ref_no', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile', array('size' => 11, 'maxlength' => 11)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'contact_name'); ?>
        <?php echo $form->textField($model, 'contact_name', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->dropDownlist($model, 'status', $model->loadOptionsStatus(),array(
            'prompt'=>'-- 状态 --'
        )); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'booking_type'); ?>
        <?php echo $form->dropDownlist($model, 'booking_type', $model->loadOptionsBookingType(), array(
            'prompt'=>'-- 分类 -- '
        )); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'faculty_id'); ?>
        <?php echo $form->dropDownlist($model, 'faculty_id', $model->loadOptionsFaculty(), array(
            'prompt'=>'-- 科室 --'
        )); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'doctor_id'); ?>
        <?php echo $form->textField($model, 'doctor_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'expteam_id'); ?>
        <?php echo $form->dropDownlist($model, 'expteam_id', $model->loadOptionsExpertTeam(), array(
            'prompt'=>'-- 专家团队 --'
        )); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'hospital_id'); ?>
        <?php echo $form->textField($model, 'hospital_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'hospital_dept'); ?>
        <?php echo $form->dropDownlist($model, 'hospital_dept', $model->loadOptionsHospitalDept()); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'patient_condition'); ?>
        <?php echo $form->textField($model, 'patient_condition', array('size' => 60, 'maxlength' => 500)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'appt_date'); ?>
        <?php echo $form->textField($model, 'appt_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'contact_email'); ?>
        <?php echo $form->textField($model, 'contact_email', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'contact_weixin'); ?>
        <?php echo $form->textField($model, 'contact_weixin', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'date_created'); ?>
        <?php echo $form->textField($model, 'date_created'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'date_updated'); ?>
        <?php echo $form->textField($model, 'date_updated'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('搜索', array('class'=>'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->