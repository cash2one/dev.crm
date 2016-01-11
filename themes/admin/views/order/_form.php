<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales-order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'bk_ref_no'); ?>
		<?php echo $form->textField($model,'bk_ref_no',array('size'=>16,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'bk_ref_no'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'crm_no'); ?>
		<?php echo $form->textField($model,'crm_no',array('size'=>16,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'crm_no'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>50,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows' => 15, 'cols' => 50, 'maxlength' => 1000)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'final_amount'); ?>
		<?php echo $form->textField($model,'final_amount',array('size'=>10,'maxlength'=>10)); ?>元（RMB）
		<?php echo $form->error($model,'final_amount'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'bd_code'); ?>
		<?php echo $form->textField($model,'bd_code',array('size'=>10,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'bd_code'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建订单' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->