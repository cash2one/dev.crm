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
    <div class="text-danger"><?php echo $form->errorSummary($model); ?></div>
    <?php echo $form->hiddenField($model, 'hospital_id'); ?>
    <div class="form-group">        
        <?php echo $form->labelEx($model, 'group'); ?>
        <div>
            <?php
            echo $form->dropDownList($model, 'group', $model->loadOptionsDeptGroup(), array(
                'prompt' => '选择科室',
                'class' => 'sel form-control',
            ));
            ?>
             <div class="text-danger"><?php echo $form->error($model, 'group'); ?></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">        
        <?php echo $form->labelEx($model, 'name'); ?>
        <div>
            <?php
            echo $form->textfield($model, 'name', array('class' => 'form-control'));
            ?>
        </div>
        <div class="text-danger"><?php echo $form->error($model, 'name'); ?></div>
        <div class="clearfix"></div>
    </div>
    <br />
    <div class="form-group">
        <button type="submit" class="btn btn-primary">添加</button>
    </div>

    <?php $this->endWidget(); ?>
</div>