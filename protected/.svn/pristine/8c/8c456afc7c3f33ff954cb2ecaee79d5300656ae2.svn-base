<?php
/* @var $this FacultyController */
/* @var $model Faculty */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'faculty-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'code'); ?>

        <?php
        if ($model->isNewRecord) {
            echo $form->textField($model, 'code', array('size' => 20, 'maxlength' => 10, 'placeholder' => 'Unique key'));
        } else {
            echo '<div><b>' . $model->code . '</b></div>';
        }
        ?>
        <?php echo $form->error($model, 'code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php
        if ($model->isNewRecord) {
            echo $form->textField($model, 'name', array('size' => 45, 'maxlength' => 45, 'placeholder' => 'Unique name'));
        } else {
            echo '<div><b>' . $model->name . '</b></div>';
        }
        ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">        
        <?php echo $form->labelEx($model, 'disease_list'); ?>
        <div style='color:red;'>用英文 ',' 分开。不可用中文“，”。</div>
        <?php echo $form->textField($model, 'disease_list', array('size' => 100, 'maxlength' => 200, 'placeholder' => '用“,”分开：骨折, 肩周炎, 骨髓炎')); ?>
        <?php echo $form->error($model, 'disease_list'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textarea($model, 'description', array('rows' => 6, 'cols' => 100, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_active'); ?>
        <div>
            <?php
            echo $form->dropDownList($model, 'is_active', array(0 => '否（N）', 1 => '是（Y）'), array(
                'prompt' => '-- 无 --',
                'class' => 'sel',
            ));
            ?>
        </div>  
        <?php echo $form->error($model, 'hospital_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'display_order'); ?>
        <?php echo $form->textField($model, 'display_order'); ?>
        <?php echo $form->error($model, 'display_order'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->