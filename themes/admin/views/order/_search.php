<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */
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
		<?php echo $form->textField($model,'ref_no',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bk_id'); ?>
		<?php echo $form->textField($model,'bk_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bk_type'); ?>
		<?php echo $form->textField($model,'bk_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_paid'); ?>
		<?php echo $form->textField($model,'is_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_open'); ?>
		<?php echo $form->textField($model,'date_open'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_closed'); ?>
		<?php echo $form->textField($model,'date_closed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_amount'); ?>
		<?php echo $form->textField($model,'total_amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'discount_percent'); ?>
		<?php echo $form->textField($model,'discount_percent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'discount_amount'); ?>
		<?php echo $form->textField($model,'discount_amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_amount'); ?>
		<?php echo $form->textField($model,'final_amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>3,'maxlength'=>3)); ?>
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