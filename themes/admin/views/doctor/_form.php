<?php
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/js/multiple-select-master/multiple-select.css");
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
        'id' => 'doctor-form',
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

    <div class="text-danger"><?php echo $form->errorSummary($model); ?></div>

    <div class="hide">
        <input  class="hide" type="text" />
        <input class="hide"  type="password" />
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fullname', array('size' => 45, 'maxlength' => 45)); ?>
        <div class="">
            <?php echo $form->textField($model, 'fullname', array('class' => '', 'placeholder' => '此姓名仅供记录用途')); ?>                    
            <?php echo $form->error($model, 'fullname'); ?>
        </div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'name', array('size' => 45, 'maxlength' => 45)); ?>
        <div class="">
            <?php echo $form->textField($model, 'name', array('class' => '', 'placeholder' => '此姓名将会展示给用户')); ?>                    
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'hospital_id', array('class' => ' ')); ?>
        <div class="">
            <div class="styled-select">
                <?php
                echo $form->dropDownList($model, 'hospital_id', $model->loadOptionsHospital(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel ',
                    'id' => 'hospital'
                ));
                ?>
            </div>  
            <?php echo $form->error($model, 'hospital_id'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'faculty', array('class' => ' ')); ?>
        <div class="">
            <?php echo $form->textField($model, 'faculty', array('size' => 45, 'maxlength' => 45, 'class' => '', 'placeholder' => '所在科室的名称')); ?>                    
            <?php echo $form->error($model, 'faculty'); ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'medical_title', array('class' => ' ')); ?>
        <div class="">
            <div class="styled-select">
                <?php
                echo $form->dropDownList($model, 'medical_title', $model->loadOptionsMedicalTitle(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel ',
                ));
                ?>
            </div>
            <?php echo $form->error($model, 'medical_title'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'academic_title', array('class' => ' ')); ?>
        <div class="">
            <div class="styled-select">
                <?php
                echo $form->dropDownList($model, 'academic_title', $model->loadOptionsAcademicTitle(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel ',
                ));
                ?>
            </div>
            <?php echo $form->error($model, 'academic_title'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textarea($model, 'description', array('rows' => 8, 'cols' => 80, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'search_keywords', array('class' => ' ')); ?>
        <div class="">
            <?php echo $form->textField($model, 'search_keywords', array('size' => 100, 'maxlength' => 100, 'class' => '', 'placeholder' => '如：骨科,肝胆')); ?>
            <?php echo $form->error($model, 'search_keywords'); ?>
        </div>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'gender', array('class' => ' ')); ?>    
        <div class="">
            <?php
            $optionsGender = $model->loadOptionsGender();
            if (emptyArray($optionsGender) === false) {
                echo '<div class="checkbox-groups">';
                foreach ($optionsGender as $key => $option) {
                    echo '<label class="radio-inline">';
                    if ($key == $model->gender) {
                        echo '<input type="radio" name="DoctorForm[gender]" value="' . $key . '" checked>';
                    } else {
                        echo '<input type="radio" name="DoctorForm[gender]" value="' . $key . '">';
                    }
                    echo $option . '</label>';
                }
                echo '</div>';
            }
            ?>
            <?php echo $form->error($model, 'gender'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'mobile', array('class' => ' ')); ?>
        <div class="">
            <?php echo $form->textField($model, 'mobile', array('size' => 45, 'maxlength' => 45)); ?>                    
            <?php echo $form->error($model, 'mobile'); ?>
        </div>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'tel', array('class' => ' ')); ?>
        <div class="">
            <?php echo $form->textField($model, 'tel', array('size' => 45, 'maxlength' => 45)); ?>                    
            <?php echo $form->error($model, 'tel'); ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email', array('class' => ' ')); ?>
        <div class="">
            <?php echo $form->emailField($model, 'email', array('size' => 100, 'maxlength' => 100)); ?>                    
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'wechat', array('class' => ' ')); ?>
        <div class="">
            <?php echo $form->textField($model, 'wechat', array('size' => 45, 'maxlength' => 45)); ?>                    
            <?php echo $form->error($model, 'wechat'); ?>
        </div>
    </div>


    <div class="row">        
        <button type="submit" class="btn btn-success">保存</button>
    </div>
    <?php $this->endWidget(); ?>
</div>