<?php
/* @var $this MrbookingController */
/* @var $model MedicalRecordBooking */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'medical-record-booking-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="text-danger"><?php echo $form->errorSummary($model); ?></div>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_no'); ?>
            <div><?php echo $model->ref_no;?></div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<div><?php echo $model->user_id;?></div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'faculty_id'); ?>
		<?php echo $form->textField($model,'faculty_id'); ?>
		<?php echo $form->error($model,'faculty_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'appt_date'); ?>
		<?php echo $form->textField($model,'appt_date'); ?>
		<?php echo $form->error($model,'appt_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'buffer_days'); ?>
		<?php echo $form->textField($model,'buffer_days'); ?>
		<?php echo $form->error($model,'buffer_days'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_intention'); ?>
		<?php echo $form->textField($model,'patient_intention',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'patient_intention'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wechat'); ?>
		<?php echo $form->textField($model,'wechat',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'wechat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->