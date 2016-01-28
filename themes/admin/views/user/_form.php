<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="text-danger"><?php echo $form->errorSummary($model); ?></div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wechat'); ?>
		<?php echo $form->textField($model,'wechat',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'wechat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login_attempts'); ?>
		<?php echo $form->textField($model,'login_attempts'); ?>
		<?php echo $form->error($model,'login_attempts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salt'); ?>
		<?php echo $form->textField($model,'salt',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'salt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_raw'); ?>
		<?php echo $form->textField($model,'password_raw',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'password_raw'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'terms'); ?>
		<?php echo $form->textField($model,'terms'); ?>
		<?php echo $form->error($model,'terms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_activated'); ?>
		<?php echo $form->textField($model,'date_activated'); ?>
		<?php echo $form->error($model,'date_activated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_login_time'); ?>
		<?php echo $form->textField($model,'last_login_time'); ?>
		<?php echo $form->error($model,'last_login_time'); ?>
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