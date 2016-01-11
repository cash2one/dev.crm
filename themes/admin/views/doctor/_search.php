<?php
/* @var $this DoctorController */
/* @var $model Doctor */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fullname'); ?>
        <?php echo $form->textField($model, 'fullname', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile', array('size' => 11, 'maxlength' => 11)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'hospital_id'); ?>
        <?php echo $form->textField($model, 'hospital_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'medical_title'); ?>
        <?php echo $form->textField($model, 'medical_title', array('size' => 45, 'maxlength' => 45)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'search_keywords'); ?>
        <?php echo $form->textField($model, 'search_keywords', array('size' => 45, 'maxlength' => 45)); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->