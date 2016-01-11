<?php
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/js/multiple-select-master/multiple-select.css");
$urlSubmit = $this->createUrl('doctor/createExpertTeam', array('id' => $model->getId()));
?>
<style>
    .ms-parent{padding:0;}
    .ms-parent>button.ms-choice{height:34px;line-height:34px;}
    .ms-parent.multiple{min-width:200px !important;}
    .ms-parent.multiple  li.group{background-color:#eee;font-size:1.2em;}
    div.form .radio-inline{display:inline-block;margin-right:1em;}
</style>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'team',
        'action' => $urlSubmit,
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'htmlOptions' => array('class' => "form-horizontal", 'role' => 'form', 'autocomplete' => 'off'),
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
        <?php echo '医生: ' . $model->getName() ?>                
    </div>
    <div class="row">
        <?php echo '医院: ' . $model->getHospitalName() ?>                
    </div>
    <div class="row">
        <?php echo '科室: ' . $model->getHpDeptName() ?>                
    </div>
    <div class="row">
        <?php echo $form->labelEx($teamForm, 'dis_tags'); ?>
        <?php echo $form->textarea($teamForm, 'dis_tags', array('rows' => 2, 'cols' => 80, 'maxlength' => 1000)); ?>
        <?php echo $form->error($teamForm, 'dis_tags'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($teamForm, 'description'); ?>
        <?php echo $form->textarea($teamForm, 'description', array('rows' => 4, 'cols' => 80, 'maxlength' => 1000)); ?>
        <?php echo $form->error($teamForm, 'description'); ?>
    </div>


    <div class="row">        
        <button type="submit" class="btn btn-success">保存</button>
    </div>
    <?php $this->endWidget(); ?>
</div>
