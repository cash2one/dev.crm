<?php
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/js/multiple-select-master/multiple-select.css");
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlSubmit = $this->createUrl('doctor/update', array('id' => $model->id));
$hospitalId = $model->hospital_id;
?>
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
        'enableAjaxValidation' => false,
    ));
    echo $form->hiddenField($model, 'id', array('name' => 'DoctorFormAdmin[id]'));
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="mb15">
        <?php echo $form->labelEx($model, 'fullname', array('size' => 45, 'maxlength' => 45)); ?>
        <div class="">
            <?php echo $form->textField($model, 'fullname', array('class' => 'form-control', 'placeholder' => '此姓名仅供记录用途')); ?>                    
            <?php echo $form->error($model, 'fullname'); ?>
        </div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'hospital_id', array('class' => '')); ?>
        <div class="">
            <div class="styled-select">
                <?php
                echo $form->dropDownList($model, 'hospital_id', $model->loadOptionsHospital(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel form-control',
                    'id' => 'hospital'
                ));
                ?>
            </div>  
            <?php echo $form->error($model, 'hospital_id'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="mb15">
        <?php echo $form->labelEx($model, 'hp_dept_id', array('class' => ' ')); ?>
        <div class="">
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
            <?php echo $form->error($model, 'hp_dept_id'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="mb15">
        <?php echo $form->labelEx($model, 'medical_title', array('class' => ' ')); ?>
        <div class="">
            <div class="styled-select">
                <?php
                echo $form->dropDownList($model, 'medical_title', $model->loadOptionsMedicalTitle(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel form-control',
                ));
                ?>
            </div>
            <?php echo $form->error($model, 'medical_title'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="mb15">
        <?php echo $form->labelEx($model, 'academic_title', array('class' => ' ')); ?>
        <div class="">
            <div class="styled-select">
                <?php
                echo $form->dropDownList($model, 'academic_title', $model->loadOptionsAcademicTitle(), array(
                    'prompt' => '-- 无 --',
                    'class' => 'sel form-control',
                ));
                ?>
            </div>
            <?php echo $form->error($model, 'academic_title'); ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="mb15">
        <label > <?php echo $form->labelEx($model, 'career_exp'); ?></label>
        <div>
            <?php echo $form->textarea($model, 'career_exp', array('rows' => 4, 'cols' => 80, 'maxlength' => 200, 'class' => 'form-control')); ?>            
            <div class="text-danger "> <?php echo $form->error($model, 'career_exp'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <label > <?php echo $form->labelEx($model, 'honour'); ?></label>
        <div>
            <?php echo $form->textarea($model, 'honour', array('rows' => 4, 'cols' => 80, 'maxlength' => 200, 'class' => 'form-control')); ?>            
            <div class="text-danger "> <?php echo $form->error($model, 'honour'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textarea($model, 'description', array('rows' => 8, 'cols' => 80, 'maxlength' => 200, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="mb15">        
        <button type="submit" class="btn btn-success">保存</button>
    </div>
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        getHpDept('<?php echo $hospitalId; ?>');
        $("select#hospital").change(function () {
            var hopitalId = $(this).val();
            getHpDept(hopitalId);
        });
    });
    function getHpDept(hopitalId) {
        $("select#DoctorFormAdmin_hp_dept_id").attr("disabled", true);
        var actionUrl = "<?php echo $urlAjaxLoadloadHospitalDept; ?>/" + hopitalId;// + hopitalId + "&prompt=选择城市";
        $.ajax({
            type: 'get',
            url: actionUrl,
            //cache: false,
            //dataType: "html",
            'success': function (data) {
                $("select#DoctorFormAdmin_hp_dept_id").html(data);
            },
            'error': function (data) {
            },
            complete: function () {
                $("select#DoctorFormAdmin_hp_dept_id").attr("disabled", false);
            }
        });
        return false;
    }
</script>