<?php
/**
 * $model  FacultyHospitalJoin
 */
?>
<div class="form" role="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'hospital-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'enableAjaxValidation' => true,
    ));
    ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model, 'hospital_id'); ?>
    <div class="row form-group">        
        <?php echo $form->labelEx($model, 'group'); ?>
        <?php echo $form->error($model, 'group'); ?>
        <div>
            <?php
            echo $form->dropDownList($model, 'group', $model->loadOptionsDeptGroup(), array(
                'prompt' => '选择科室',
                'class' => 'sel form-control',
            ));
            ?>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="row form-group">        
        <?php echo $form->labelEx($model, 'name'); ?>
        <div>
            <?php
            echo $form->textfield($model, 'name', array('class' => 'form-control'));
            ?>
        </div>
        <?php echo $form->error($model, 'name'); ?>
        <div class="clearfix"></div>
    </div>
    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton('Add'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>