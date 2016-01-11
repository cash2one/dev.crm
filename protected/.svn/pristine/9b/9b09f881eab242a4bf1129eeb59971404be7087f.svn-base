<?php
/* @var $this DoctorController */
/* @var $doctor Doctor */
/* @var $model DoctorAvatar */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Doctors' => array('index'),
    $doctor->getName() => array('view', 'id' => $doctor->getId()),
);

$this->menu = array(
    array('label' => 'View Doctor', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'List Doctor', 'url' => array('index')),
    array('label' => 'Create Doctor', 'url' => array('create')),
    array('label' => 'Update Doctor', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Doctor', 'url' => array('admin')),
);
?>
<h2>添加头像</h2>
<h3><?php echo $doctor->getName(); ?></h3>
<div>
    <?php
    if (isset($doctor->doctorAvatar)) {
        echo CHtml::Image($doctor->getAbsUrlAvatar(false), $doctor->getName(), array('title' => $doctor->getName()));
    }
    ?>
</div>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'doctor-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => false,
        ),
        'enableAjaxValidation' => true,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'uid'); ?>
        <div><?php echo $model->getUID(); ?></div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'image_url'); ?>
        <?php echo $form->textField($model, 'image_url', array('size' => 100, 'maxlength' => 100, 'placeholder' => 'http://image.jpg')); ?>
        <?php echo $form->error($model, 'image_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'thumbnail_url'); ?>
        <?php echo $form->textField($model, 'thumbnail_url', array('size' => 100, 'maxlength' => 100, 'placeholder' => 'http://image.jpg')); ?>
        <?php echo $form->error($model, 'thumbnail_url'); ?>
    </div>




    <br/>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->