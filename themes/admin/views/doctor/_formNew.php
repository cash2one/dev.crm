<?php
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/js/multiple-select-master/multiple-select.css");
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlSubmit = $this->createUrl('doctor/createDoctor');
$urlSearchHospital = $this->createUrl('hospital/searchResult');
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
    echo CHtml::hiddenField("DoctorFormAdmin[hospital_id]");
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php //echo $form->errorSummary($model); ?>
    <div class="form-horizontal">
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'fullname', array('size' => 45, 'maxlength' => 45)); ?>
            <div>
                <?php echo $form->textField($model, 'fullname', array('class' => 'form-control', 'placeholder' => '此姓名仅供记录用途')); ?>   
                <div class="text-danger "> <?php echo $form->error($model, 'fullname'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'hospital_id', array('class' => '')); ?>
            <div>
                <?php
                echo $form->textField($model, 'hospital_name', array('class' => 'form-control', 'placeholder' => '选择医院', 'readonly' => true));
//                echo $form->dropDownList($model, 'hospital_id', $model->loadOptionsHospital(), array(
//                    'prompt' => '-- 无 --',
//                    'class' => 'sel form-control',
//                    'id' => 'hospital'
//                ));
                ?>           

            </div>
            <div class="text-danger"><?php echo $form->error($model, 'hospital_id'); ?></div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'hp_dept_id', array('class' => '1')); ?>
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
            <?php echo $form->labelEx($model, 'medical_title', array('class' => '')); ?>
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
            <?php echo $form->labelEx($model, 'academic_title', array('class' => '')); ?>
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
            <?php echo $form->labelEx($model, 'description'); ?>
            <div>
                <?php echo $form->textarea($model, 'description', array('rows' => 4, 'cols' => 80, 'maxlength' => 500, 'class' => 'form-control')); ?>            
                <div class="text-danger "> <?php echo $form->error($model, 'description'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'career_exp'); ?>
            <div>
                <?php echo $form->textarea($model, 'career_exp', array('rows' => 4, 'cols' => 80, 'maxlength' => 2000, 'class' => 'form-control')); ?>            
                <div class="text-danger "> <?php echo $form->error($model, 'career_exp'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'honour'); ?>
            <div>
                <?php echo $form->textarea($model, 'honour', array('rows' => 4, 'cols' => 80, 'maxlength' => 1500, 'class' => 'form-control')); ?>            
                <div class="text-danger "> <?php echo $form->error($model, 'honour'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'reason_one'); ?>
            <div>
                <?php echo $form->textField($model, 'reason_one', array('class' => 'form-control')); ?>
                <div class="text-danger "> <?php echo $form->error($model, 'reason_one'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'reason_two'); ?>
            <div>
                <?php echo $form->textField($model, 'reason_two', array('class' => 'form-control')); ?>
                <div class="text-danger "> <?php echo $form->error($model, 'reason_two'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'reason_three'); ?>
            <div>
                <?php echo $form->textField($model, 'reason_three', array('class' => 'form-control')); ?>
                <div class="text-danger "> <?php echo $form->error($model, 'reason_three'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'reason_four'); ?>
            <div>
                <?php echo $form->textField($model, 'reason_four', array('class' => 'form-control')); ?>
                <div class="text-danger "> <?php echo $form->error($model, 'reason_four'); ?></div>
            </div>
        </div>
        
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'is_contracted'); ?>
            <?php echo $form->checkBox($model, 'is_contracted', array('class' => '')); ?>    
            <div class="text-danger "> <?php echo $form->error($model, 'is_contracted'); ?></div>
        </div>
        <div class="form-group col-sm-7">
            <?php echo $form->labelEx($model, 'role'); ?>
            <?php echo $form->checkBox($model, 'role', array('class' => '')); ?>    
            <div class="text-danger "> <?php echo $form->error($model, 'role'); ?></div>
        </div>
        <div class="form-group col-sm-7">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<?php
$this->renderPartial('searchHpModal');
?>
<script type="text/javascript">
    $(document).ready(function () {
        //错误信息清除
        $('input').focus(function () {
            if ($(this).hasClass('error')) {
                $(this).removeClass('error');
                $(this).parents('.form-group').find('.errorMessage').text('');
                $(this).parents('.form-group').find('label').removeClass('error');
            }
        });
        $('select').change(function () {
            $(this).removeClass('error');
            $(this).parents('.form-group').find('.errorMessage').text('');
            $(this).parents('.form-group').find('label').removeClass('error');
        });
        $('textarea').focus(function () {
            if ($(this).hasClass('error')) {
                $(this).removeClass('error');
                $(this).parents('.form-group').find('.errorMessage').text('');
                $(this).parents('.form-group').find('label').removeClass('error');
            }
        });
        //推荐理由填写规则
//        $('#DoctorFormAdmin_reason_two').focus(function () {
//            var reson_one = $('#DoctorFormAdmin_reason_one').val();
//            if (!reson_one) {
//                $('#DoctorFormAdmin_reason_one').focus();
//                alert('请先填写推荐理由1');
//            }
//        });
//        $('#DoctorFormAdmin_reason_three').focus(function () {
//            var reson_two = $('#DoctorFormAdmin_reason_two').val();
//            var reson_one = $('#DoctorFormAdmin_reason_one').val();
//            if (!reson_one) {
//                $('#DoctorFormAdmin_reason_one').focus();
//                alert('请先填写推荐理由1');
//            } else if (!reson_two) {
//                $('#DoctorFormAdmin_reason_two').focus();
//                alert('请先填写推荐理由2');
//            }
//        });
//        $('#DoctorFormAdmin_reason_four').focus(function () {
//            var reson_three = $('#DoctorFormAdmin_reason_three').val();
//            var reson_two = $('#DoctorFormAdmin_reason_two').val();
//            var reson_one = $('#DoctorFormAdmin_reason_one').val();
//            if (!reson_one) {
//                $('#DoctorFormAdmin_reason_one').focus();
//                alert('请先填写推荐理由1');
//            } else if (!reson_two) {
//                $('#DoctorFormAdmin_reason_two').focus();
//                alert('请先填写推荐理由2');
//            }
//            else if (!reson_three) {
//                $('#DoctorFormAdmin_reason_three').focus();
//                alert('请先填写推荐理由3');
//            }
//        });
        //搜索医院弹框
        $('#DoctorFormAdmin_hospital_name').click(function () {
            $('#hospitalSearchModal').modal();
        });
        $('#searchHp').click(function () {
            ajaxLoadHospital();
        });
        //搜索回车操作
        $('#Hospital_hpName').keydown(function (event) {
            if (event.keyCode == "13") {
                event.preventDefault();
                ajaxLoadHospital();
            }
        });

        //根据医院异步加载科室
        $("select#hospital").change(function () {
            $("select#DoctorFormAdmin_hp_dept_id").attr("disabled", true);
            var hopitalId = $(this).val();
            ajaxLoadHpDept(hopitalId);
        });
    });
    function initHpClick() {
        $('.determineHp').click(function () {
            var hpId = $(this).attr('data-id');
            var hpName = $(this).attr('data-hpName');
            $('#DoctorFormAdmin_hospital_name').val(hpName);
            $('#DoctorFormAdmin_hospital_id').val(hpId);
            $('#hospitalSearchModal').modal('hide');
            ajaxLoadHpDept(hpId);
        });
    }
    function ajaxLoadHpDept(hopitalId) {
        $("select#DoctorFormAdmin_hp_dept_id").attr("disabled", true);
        //var hopitalId = $(this).val();
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