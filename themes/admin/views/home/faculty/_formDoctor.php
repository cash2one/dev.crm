<?php
/**
 * $model  FacultyDoctorJoin
 */
$faculty = $model->getFaculty();
$doctor=$model->getDoctor();
?>
<div class="form" role="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'faculty-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'htmlOptions' => array('class' => "form-horizontal", 'role' => 'form', 'autocomplete' => 'off'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => false,
        ),
        'enableAjaxValidation' => true,
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model, 'faculty_id'); ?>

    <?php if ($model->isNewRecord) { ?>
    <div class="row form-group">        
        <?php echo $form->labelEx($model, 'doctor_id'); ?>
        <?php echo $form->error($model, 'doctor_id'); ?>
        <div>
            <?php
            echo $form->dropDownList($model, 'doctor_id', $model->loadOptionsDoctor(true), array(
                'prompt' => '-- 选择医生 --',
                'class' => 'sel form-control',
            ));
            ?>

        </div>
        <div class="clearfix"></div>
    </div>
       <?php } else { ?>
        <div class="form-group">        
            <?php echo $form->labelEx($model, 'doctor_id'); ?>
            <span><?php echo $doctor->getName(); ?></span>            
            <div class="clearfix"></div>
        </div>
    <?php } ?>
    
     <div class="form-group">        
        <?php echo $form->labelEx($model, 'display_order'); ?>
        <div>
            <?php echo $form->textField($model, 'display_order', array('class' => 'form-control','placeholder'=> '显示的顺序(数字)')); ?>
        </div>
        <?php echo $form->error($model, 'display_order'); ?>
        <div class="clearfix"></div>
    </div>
    
     <div class="form-group">        
        <?php echo $form->labelEx($model, 'visible'); ?>
        <?php echo $form->error($model, 'visible'); ?>
        <div>
            <?php            
            echo $form->dropDownList($model, 'visible', array(0 => '否（N）', 1 => '是（Y）'), array(
                //'prompt' => '-- 选择 --',
                'class' => 'sel form-control',
            ));
            ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <br />
    <div class="buttons">        
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save', array('class'=>'btn btn-info')); 
         echo CHtml::link('取消',array('view', 'id'=>$faculty->id), array('class'=>'btn btn-danger pull-right'));?>
    </div>

    <?php $this->endWidget(); ?>
</div>