<?php
/* @var $this UserDoctorProfileController */
/* @var $model UserDoctorProfile */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hospital_id'); ?>
		<?php echo $form->textField($model,'hospital_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hospital_name'); ?>
		<?php echo $form->textField($model,'hospital_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hp_dept_id'); ?>
		<?php echo $form->textField($model,'hp_dept_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hp_dept_name'); ?>
		<?php echo $form->textField($model,'hp_dept_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'clinical_title'); ?>
		<?php echo $form->textField($model,'clinical_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'academic_title'); ?>
		<?php echo $form->textField($model,'academic_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id'); ?>
		<?php echo $form->textField($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state_id'); ?>
		<?php echo $form->textField($model,'state_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state_name'); ?>
		<?php echo $form->textField($model,'state_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_name'); ?>
		<?php echo $form->textField($model,'city_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_verified'); ?>
		<?php echo $form->textField($model,'date_verified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'verified_by'); ?>
		<?php echo $form->textField($model,'verified_by',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_contracted'); ?>
		<?php echo $form->textField($model,'date_contracted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_deleted'); ?>
		<?php echo $form->textField($model,'date_deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_updated'); ?>
		<?php echo $form->textField($model,'date_updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->