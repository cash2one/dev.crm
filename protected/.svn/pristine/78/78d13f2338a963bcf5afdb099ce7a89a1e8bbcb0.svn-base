<?php
/* @var $this MedicalRecordController */
/* @var $model MedicalRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'medical-record-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nric'); ?>
		<?php echo $form->textField($model,'nric',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'nric'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city'); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'occupation'); ?>
		<?php echo $form->textField($model,'occupation'); ?>
		<?php echo $form->error($model,'occupation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_condition'); ?>
		<?php echo $form->textField($model,'patient_condition',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'patient_condition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'surgery_history'); ?>
		<?php echo $form->textField($model,'surgery_history',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'surgery_history'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drug_history'); ?>
		<?php echo $form->textField($model,'drug_history',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drug_history'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disease_history'); ?>
		<?php echo $form->textField($model,'disease_history',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'disease_history'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textField($model,'remark',array('size'=>60,'maxlength'=>200)); ?>
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