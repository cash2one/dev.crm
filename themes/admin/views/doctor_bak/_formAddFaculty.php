<?php
/**
 * $model  FacultyDoctorJoin
 */
?>
<div class="form" role="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'doctor-form',
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

    <div class="text-danger"><?php echo $form->errorSummary($model); ?></div>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <div class="row form-group">        
        <?php echo $form->labelEx($model, 'faculty_id'); ?>
        <?php echo $form->error($model, 'faculty_id'); ?>
        <div>
            <?php
            echo $form->dropDownList($model, 'faculty_id', $model->loadOptionsFaculty(true), array(
                'prompt' => '选择科室',
                'class' => 'sel form-control',
            ));
            ?>

        </div>
        <div class="clearfix"></div>
    </div>


    <br />
    <div class="row buttons">
        <?php echo CHtml::submitButton('Add'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>