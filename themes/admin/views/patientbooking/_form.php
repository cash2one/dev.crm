<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-booking-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_no'); ?>
		<?php echo $form->textField($model,'ref_no',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'ref_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id'); ?>
		<?php echo $form->error($model,'patient_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creator_id'); ?>
		<?php echo $form->textField($model,'creator_id'); ?>
		<?php echo $form->error($model,'creator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'travel_type'); ?>
		<?php echo $form->textField($model,'travel_type'); ?>
		<?php echo $form->error($model,'travel_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_start'); ?>
		<?php echo $form->textField($model,'date_start'); ?>
		<?php echo $form->error($model,'date_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_end'); ?>
		<?php echo $form->textField($model,'date_end'); ?>
		<?php echo $form->error($model,'date_end'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detail'); ?>
		<?php echo $form->textField($model,'detail',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'appt_date'); ?>
		<?php echo $form->textField($model,'appt_date'); ?>
		<?php echo $form->error($model,'appt_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_confirm'); ?>
		<?php echo $form->textField($model,'date_confirm'); ?>
		<?php echo $form->error($model,'date_confirm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textField($model,'remark',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_updated'); ?>
		<?php echo $form->textField($model,'date_updated'); ?>
		<?php echo $form->error($model,'date_updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_deleted'); ?>
		<?php echo $form->textField($model,'date_deleted'); ?>
		<?php echo $form->error($model,'date_deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->