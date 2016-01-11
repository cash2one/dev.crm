<?php
/* @var $this UserDoctorProfileController */
/* @var $model UserDoctorProfile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-doctor-profile-form',
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
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hospital_id'); ?>
		<?php echo $form->textField($model,'hospital_id'); ?>
		<?php echo $form->error($model,'hospital_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hospital_name'); ?>
		<?php echo $form->textField($model,'hospital_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'hospital_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hp_dept_id'); ?>
		<?php echo $form->textField($model,'hp_dept_id'); ?>
		<?php echo $form->error($model,'hp_dept_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hp_dept_name'); ?>
		<?php echo $form->textField($model,'hp_dept_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'hp_dept_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'clinical_title'); ?>
		<?php echo $form->textField($model,'clinical_title'); ?>
		<?php echo $form->error($model,'clinical_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'academic_title'); ?>
		<?php echo $form->textField($model,'academic_title'); ?>
		<?php echo $form->error($model,'academic_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php echo $form->textField($model,'country_id'); ?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state_id'); ?>
		<?php echo $form->textField($model,'state_id'); ?>
		<?php echo $form->error($model,'state_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state_name'); ?>
		<?php echo $form->textField($model,'state_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'state_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_name'); ?>
		<?php echo $form->textField($model,'city_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'city_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_verified'); ?>
		<?php echo $form->textField($model,'date_verified'); ?>
		<?php echo $form->error($model,'date_verified'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verified_by'); ?>
		<?php echo $form->textField($model,'verified_by',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'verified_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_contracted'); ?>
		<?php echo $form->textField($model,'date_contracted'); ?>
		<?php echo $form->error($model,'date_contracted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_deleted'); ?>
		<?php echo $form->textField($model,'date_deleted'); ?>
		<?php echo $form->error($model,'date_deleted'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->