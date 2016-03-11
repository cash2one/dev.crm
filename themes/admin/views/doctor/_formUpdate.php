<?php
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . "/js/multiple-select-master/multiple-select.css");
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlSubmit = $this->createUrl('doctor/update', array('id' => $model->id));
$hospitalId = $model->hospital_id;
$deptId = $model->hp_dept_id;
$urlSearchHospital = $this->createUrl('hospital/searchResult');
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
    echo $form->hiddenField($model, 'hospital_id', array('name' => 'DoctorFormAdmin[hospital_id]'));
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
                echo $form->textField($model, 'hospital_name', array('class' => 'form-control', 'placeholder' => '选择医院', 'readonly' => true));
//                echo $form->dropDownList($model, 'hospital_id', $model->loadOptionsHospital(), array(
//                    'prompt' => '-- 无 --',
//                    'class' => 'sel form-control',
//                    'id' => 'hospital'
//                ));
                ?>
            </div>  
            <?php echo $form->error($model, 'hospital_id'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="mb15 form-select">
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
            <?php echo $form->textarea($model, 'career_exp', array('rows' => 4, 'cols' => 80, 'maxlength' => 2000, 'class' => 'form-control')); ?>            
            <div class="text-danger "> <?php echo $form->error($model, 'career_exp'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <label > <?php echo $form->labelEx($model, 'honour'); ?></label>
        <div>
            <?php echo $form->textarea($model, 'honour', array('rows' => 4, 'cols' => 80, 'maxlength' => 1500, 'class' => 'form-control')); ?>            
            <div class="text-danger "> <?php echo $form->error($model, 'honour'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'reason_one'); ?>
        <div>
            <?php echo $form->textField($model, 'reason_one', array('class' => 'form-control')); ?>
            <div class="text-danger "> <?php echo $form->error($model, 'reason_one'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'reason_two'); ?>
        <div>
            <?php echo $form->textField($model, 'reason_two', array('class' => 'form-control')); ?>
            <div class="text-danger "> <?php echo $form->error($model, 'reason_two'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'reason_three'); ?>
        <div>
            <?php echo $form->textField($model, 'reason_three', array('class' => 'form-control')); ?>
            <div class="text-danger "> <?php echo $form->error($model, 'reason_three'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'reason_four'); ?>
        <div>
            <?php echo $form->textField($model, 'reason_four', array('class' => 'form-control')); ?>
            <div class="text-danger "> <?php echo $form->error($model, 'reason_four'); ?></div>
        </div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textarea($model, 'description', array('rows' => 8, 'cols' => 80, 'maxlength' => 500, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'is_contracted'); ?>
        <?php echo $form->checkBox($model, 'is_contracted', array('class' => '')); ?>    
        <div class="text-danger "> <?php echo $form->error($model, 'is_contracted'); ?></div>
    </div>
    <div class="mb15">
        <?php echo $form->labelEx($model, 'role'); ?>
        <?php echo $form->checkBox($model, 'role', array('class' => '')); ?>    
        <div class="text-danger "> <?php echo $form->error($model, 'role'); ?></div>
    </div>
    <div class="mb15">        
        <button type="submit" class="btn btn-success">保存</button>
    </div>
    <?php $this->endWidget(); ?>
</div>
<div class="modal fade mt100" id="hospitalSearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">搜索医院</h4>
            </div>
            <div class="modal-body">
                <form id="searchHp-form" class="form-inline text-center">
                    <div class="form-group">
                        <label class="control-label">医院名</label>
                        <input class="form-control" name="hpName" id="Hospital_hpName" type="text">
                        <button id="searchHp" type="button" class="btn btn-primary">搜索</button>
                    </div>

                </form>
                <div class="mt20">
                    <h4 class="strong">展示结果:</h4>
                    <div id="hpList" class="row">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function () {
        $('select').change(function () {
            $(this).removeClass('error');
            $(this).parents('.form-select').find('.errorMessage').text('');
            $(this).parents('.form-select').find('label').removeClass('error');
        });
        //推荐理由填写规则
        $('#DoctorFormAdmin_reason_two').focus(function () {
            var reson_one = $('#DoctorFormAdmin_reason_one').val();
            if (!reson_one) {
                $('#DoctorFormAdmin_reason_one').focus();
                alert('请先填写推荐理由1');
            }
        });
        $('#DoctorFormAdmin_reason_three').focus(function () {
            var reson_two = $('#DoctorFormAdmin_reason_two').val();
            var reson_one = $('#DoctorFormAdmin_reason_one').val();
            if (!reson_one) {
                $('#DoctorFormAdmin_reason_one').focus();
                alert('请先填写推荐理由1');
            } else if (!reson_two) {
                $('#DoctorFormAdmin_reason_two').focus();
                alert('请先填写推荐理由2');
            }
        });
        $('#DoctorFormAdmin_reason_four').focus(function () {
            var reson_three = $('#DoctorFormAdmin_reason_three').val();
            var reson_two = $('#DoctorFormAdmin_reason_two').val();
            var reson_one = $('#DoctorFormAdmin_reason_one').val();
            if (!reson_one) {
                $('#DoctorFormAdmin_reason_one').focus();
                alert('请先填写推荐理由1');
            } else if (!reson_two) {
                $('#DoctorFormAdmin_reason_two').focus();
                alert('请先填写推荐理由2');
            }
            else if (!reson_three) {
                $('#DoctorFormAdmin_reason_three').focus();
                alert('请先填写推荐理由3');
            }
        });
        //异步获取科室
        getHpDept('<?php echo $hospitalId; ?>');
        
//        $("select#hospital").change(function () {
//            var hopitalId = $(this).val();
//            getHpDept(hopitalId);
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
    });
    function ajaxLoadHospital() {
        $.ajax({
            url: '<?php echo $urlSearchHospital; ?>',
            data: $('#searchHp-form').serialize(),
            success: function (data) {
                setHpHtml(data);
            }
        });
    }
    function setHpHtml(hospitals) {
        var innerHtml = '';
        if (hospitals && hospitals.length > 0) {
            for (var i = 0; i < hospitals.length; i++) {
                var hospital = hospitals[i];
                innerHtml += '<div class="col-sm-6"><span><a class="determineHp" data-id="' + hospital.id + '" data-hpName="' + hospital.name + '" href="javascript:void(0);">' + hospital.name + '</a></span></div>';
            }
        } else {
            innerHtml += '<div class="col-sm-12">未查询到结果</div>';
        }
        $('#hpList').html(innerHtml);
        $('.determineHp').click(function () {
            var hpId = $(this).attr('data-id');
            var hpName = $(this).attr('data-hpName');
            $('#DoctorFormAdmin_hospital_name').val(hpName);
            $('#DoctorFormAdmin_hospital_id').val(hpId);
            $('#hospitalSearchModal').modal('hide');
            getHpDept(hpId);
        });
    }
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
                initDept();
            },
            'error': function (data) {
            },
            complete: function () {
                $("select#DoctorFormAdmin_hp_dept_id").attr("disabled", false);
            }
        });
        return false;
    }
    function initDept(){
        var deptId = '<?php echo $deptId; ?>';
        $('select#DoctorFormAdmin_hp_dept_id').find('option').each(function(){
            var value = $(this).val();
            if(deptId == value){
                $(this).attr('selected',true);
            }
        });
    }
</script>