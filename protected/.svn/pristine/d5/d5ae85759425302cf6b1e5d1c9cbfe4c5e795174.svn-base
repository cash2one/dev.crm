<?php
/* @var $this MrbookingController */
/* @var $model MedicalRecordBooking */
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
		<?php echo $form->label($model,'ref_no'); ?>
		<?php echo $form->textField($model,'ref_no',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mr_id'); ?>
		<?php echo $form->textField($model,'mr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'faculty_id'); ?>
		<?php echo $form->textField($model,'faculty_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appt_date'); ?>
		<?php echo $form->textField($model,'appt_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'buffer_days'); ?>
		<?php echo $form->textField($model,'buffer_days'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_intention'); ?>
		<?php echo $form->textField($model,'patient_intention',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wechat'); ?>
		<?php echo $form->textField($model,'wechat',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_updated'); ?>
		<?php echo $form->textField($model,'date_updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_deleted'); ?>
		<?php echo $form->textField($model,'date_deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->