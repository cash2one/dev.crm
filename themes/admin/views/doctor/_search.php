<?php
/* @var $this DoctorController */
/* @var $model Doctor */
/* @var $form CActiveForm */
?>

<div class="row form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>
    <div class="form-group  col-sm-3">
        <label > <?php echo $form->label($model, 'id'); ?></label>
        <div>
            <?php echo $form->textField($model, 'id', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label > <?php echo $form->label($model, 'fullname'); ?></label>
        <div>
            <?php echo $form->textField($model, 'fullname', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label > <?php echo $form->label($model, 'mobile'); ?></label>
        <div>
            <?php echo $form->textField($model, 'mobile', array('class' => 'form-control', 'size' => 11, 'maxlength' => 11)); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label > <?php echo $form->label($model, 'hospital_id'); ?></label>
        <div>
            <?php echo $form->textField($model, 'hospital_id', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label > <?php echo $form->label($model, 'medical_title'); ?></label>
        <div>
            <?php echo $form->textField($model, 'medical_title', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label > <?php echo $form->label($model, 'search_keywords'); ?></label>
        <div>
            <?php echo $form->textField($model, 'search_keywords', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
        </div>
    </div>
    <div class="form-group col-sm-3 mt30">
        <button type="submit" class="btn btn-primary">搜索</button>
    </div> 

    <?php $this->endWidget(); ?>

</div><!-- search-form -->