<?php
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/js/multiple-select-master/multiple-select.css");
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlSubmit = $this->createUrl('doctor/createDoctor');
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
    <div class="form-horizontal">
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'fullname', array('size' => 45, 'maxlength' => 45)); ?></label>
            <div>
                <?php echo $form->textField($model, 'fullname', array('class' => 'form-control', 'placeholder' => '此姓名仅供记录用途')); ?>                
                <div class="text-danger "> <?php echo $form->error($model, 'fullname'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'hospital_id', array('class' => '')); ?></label>
            <div>
                <?php
                echo $form->dropDownList($model, 'hospital_id', $model->loadOptionsHospital(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel form-control',
                    'id' => 'hospital'
                ));
                ?>           

            </div>
            <div class="text-danger"><?php echo $form->error($model, 'hospital_id'); ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'hp_dept_id', array('class' => '1')); ?></label>
            <div>
                <?php
//                echo $form->dropDownList($model, 'hp_dept_id', array(
//                    'prompt' => '-- 无 --',
//                    'class' => 'sel form-control',
//                    'id' => 'dept'
//                ));
                ?>           
                <select class="sel form-control " name="DoctorFormAdmin[hp_dept_id]" id="DoctorFormAdmin_hp_dept_id">
                    <option value="">-- 无 --</option>
                </select>
            </div>
            <div class="text-danger"><?php echo $form->error($model, 'hp_dept_id'); ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'medical_title', array('class' => '')); ?></label>
            <div>
                <?php
                echo $form->dropDownList($model, 'medical_title', $model->loadOptionsMedicalTitle(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel form-control ',
                ));
                ?>            

            </div>
            <div class="text-danger "><?php echo $form->error($model, 'medical_title'); ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'academic_title', array('class' => '')); ?></label>
            <div>
                <?php
                echo $form->dropDownList($model, 'academic_title', $model->loadOptionsAcademicTitle(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel form-control ',
                ));
                ?>           

            </div>
            <div class="text-danger "><?php echo $form->error($model, 'academic_title'); ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'career_exp'); ?></label>
            <div>
                <?php echo $form->textarea($model, 'career_exp', array('rows' => 4, 'cols' => 80, 'maxlength' => 200, 'class' => 'form-control')); ?>            
                <div class="text-danger "> <?php echo $form->error($model, 'career_exp'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'honour'); ?></label>
            <div>
                <?php echo $form->textarea($model, 'honour', array('rows' => 4, 'cols' => 80, 'maxlength' => 200, 'class' => 'form-control')); ?>            
                <div class="text-danger "> <?php echo $form->error($model, 'honour'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'description'); ?></label>
            <div>
                <?php echo $form->textarea($model, 'description', array('rows' => 8, 'cols' => 80, 'maxlength' => 200, 'class' => 'form-control')); ?>            
                <div class="text-danger "> <?php echo $form->error($model, 'description'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("select#hospital").change(function () {
            $("select#DoctorFormAdmin_hp_dept_id").attr("disabled", true);
            var hopitalId = $(this).val();
            var actionUrl = "<?php echo $urlAjaxLoadloadHospitalDept; ?>/" + hopitalId;// + hopitalId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                //cache: false,
                //dataType: "html",
                'success': function (data) {
                    console.log(data);
                    $("select#DoctorFormAdmin_hp_dept_id").html(data);
                },
                'error': function (data) {
                },
                complete: function () {
                    $("select#DoctorFormAdmin_hp_dept_id").attr("disabled", false);
                }
            });
            return false;
        });
    });
</script>