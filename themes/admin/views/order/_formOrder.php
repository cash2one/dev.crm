<?php
/* @var $this SalesTransactionController */
/* @var $model SalesTransaction */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sales-order-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'htmlOptions' => array('class' => "", 'role' => 'form', 'autocomplete' => 'off'),
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnType' => true,
            'validateOnDelay' => 500,
            'errorCssClass' => 'errorMessage',
        ),
        'enableAjaxValidation' => false,
            // 'focus' => array($model, 'password'),
    ));

    echo $form->hiddenField($model, 'bk_ref_no', array('name'=>'order[bk_ref_no]'));
    ?>


    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo '预约单号<br>'; ?>
        <?php echo '<div>' . $model->ref_no . '</div>'; ?>
        <?php echo $form->error($model, 'ref_no'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php echo '<div>' . $model->user_id . '</div>'; ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bk_id'); ?>
        <?php echo '<div>' . $model->bk_id . '</div>'; ?>
        <?php echo $form->error($model, 'bk_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bk_type'); ?>
        <?php echo '<div>' . $model->bk_type . '</div>'; ?>
        <?php echo $form->error($model, 'bk_type'); ?>
    </div>

    <div class="row">
        <?php echo '订单金额<br>'; ?>
        <?php echo $form->textField($model, 'final_amount', array('name' => 'order[final_amount]', 'size' => 12, 'maxlength' => 12)); ?>元（RMB）
        <?php echo $form->error($model, 'final_amount'); ?>
    </div>

    <div class="row">
        <?php echo '订单标题<br>'; ?>
        <?php echo $form->textField($model, 'subject', array('name' => 'order[subject]', 'size' => 50, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'subject'); ?>
    </div>

    <div class="row">
        <?php echo '订单描述<br>'; ?>
        <?php echo $form->textArea($model, 'description', array('name' => 'order[description]', 'rows' => 15, 'cols' => 50, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->