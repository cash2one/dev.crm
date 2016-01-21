<?php
/* @var $this HospitalController */
/* @var $model Hospital */
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
        <label ><?php echo $form->label($model, 'id'); ?></label>
        <div>
            <?php echo $form->textField($model, 'id', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'name'); ?></label>
        <div>
            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'short_name'); ?></label>
        <div>
            <?php echo $form->textField($model, 'short_name', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'country_id'); ?></label>
        <div>
            <?php echo $form->textField($model, 'country_id', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'state_id'); ?></label>
        <div>
            <?php echo $form->textField($model, 'state_id', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'city_id'); ?></label>
        <div>
            <?php echo $form->textField($model, 'city_id', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'address'); ?></label>
        <div>
            <?php echo $form->textField($model, 'address', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'phone'); ?></label>
        <div>
            <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
        </div>
    </div>

    <div class="form-group  col-sm-3">
        <label ><?php echo $form->label($model, 'website'); ?></label>
        <div>
            <?php echo $form->textField($model, 'website', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        </div>
    </div>
    <div class="form-group col-sm-3 mt30">
        <button type="submit" class="btn btn-primary">搜索</button>
    </div> 
    <?php $this->endWidget(); ?>

</div><!-- search-form -->