<?php
/* @var $this HospitalController */
/* @var $model HospitalForm */
/* @var $form CActiveForm */
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-1.9.1.min.js', CClientScript::POS_HEAD);
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'hospital-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => false,
        ),
        'enableAjaxValidation' => true,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100, 'placeholder' => '用于记录')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'short_name'); ?>
        <?php echo $form->textField($model, 'short_name', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45, 'placeholder' => '用于展示给用户')); ?>
        <?php echo $form->error($model, 'short_name'); ?>
    </div>

    <div class="form-group col-sm-7">
        <label for="HospitalForm_class">医院等级<span class="required">*</span></label>
        <div class="fix-padding-left">
            <?php
            echo $form->dropDownList($model, 'class', $model->getOptionsClass(), array(
                'class' => 'sel form-control',
            ));
            ?>
            <?php echo $form->error($model, 'class'); ?>
        </div>
    </div>

    <div class="form-group col-sm-7">
        <label for="HospitalForm_type">医院类型<span class="required">*</span></label>
        <div class="fix-padding-left">
            <?php
            echo $form->dropDownList($model, 'type', $model->getOptionsType(), array(
                'class' => 'sel form-control',
            ));
            ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
    </div>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textarea($model, 'description', array('class' => 'form-control', 'rows' => 8, 'cols' => 80, 'maxlength' => 500)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'search_keywords'); ?>
        <?php echo $form->textField($model, 'search_keywords', array('class' => 'form-control', 'size' => 45, 'maxlength' => 100, 'placeholder' => '如：骨科, 肝胆, 妇产')); ?>
        <?php echo $form->error($model, 'search_keywords'); ?>
    </div>

    <div class="form-group col-sm-7">
        <p>医院所属地区<span class="red">*</span></p>
        <div class="row">
            <div class="col-sm-4 mb-10 fix-padding-left">
                <div id="country_select_wrapper" class="styled-select">
                    <?php
                    echo $form->dropDownList($model, 'country_id', $model->getOptionsCountry(), array(
                        'id' => 'country-list',
                        'prompt' => '国家 / 地区',
                        'class' => 'sel form-control',
                    ));
                    ?>
                </div>
                <?php echo $form->error($model, 'country_id'); ?>
            </div>

            <div class="col-sm-4 mb-10 fix-padding-left">
                <div class="styled-select">
                    <?php
                    echo $form->dropDownList($model, 'state_id', $model->getOptionsState(), array(
                        'id' => 'state-list',
                        'prompt' => '省份或地区',
                        'class' => 'sel form-control',
                        'ajax' => array(
                            'type' => 'get',
                            'url' => $this->createAbsoluteUrl('/region/loadCities'),
                            'data' => array('id' => 'js:this.value'),
                            'update' => '#city-list',
                        )
                    ));
                    ?>
                </div>
                <?php echo $form->error($model, 'state_id'); ?>
            </div>
            <div class="col-sm-4 fix-padding-left">
                <div id="city_select_wrapper" class="styled-select">
                    <?php echo $form->dropDownList($model, 'city_id', $model->getOptionsCity(), array('id' => 'city-list', 'class' => 'sel form-control', 'prompt' => '城市')); ?>
                </div>
                <?php echo $form->error($model, 'city_id'); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'thumbnail_url'); ?>
        <?php echo $form->textField($model, 'thumbnail_url', array('class' => 'form-control', 'size' => 100, 'maxlength' => 100, 'placeholder' => 'Absolute internet url')); ?>
        <?php echo $form->error($model, 'thumbnail_url'); ?>
    </div>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'image_url'); ?>
        <?php echo $form->textField($model, 'image_url', array('class' => 'form-control', 'size' => 100, 'maxlength' => 100, 'placeholder' => 'Full-size image. Absolute internet url.')); ?>
        <?php echo $form->error($model, 'image_url'); ?>
    </div>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textarea($model, 'address', array('class' => 'form-control', 'rows' => 4, 'cols' => 50, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>

    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>


    <div class="form-group col-sm-7">
        <?php echo $form->labelEx($model, 'website'); ?>
        <?php echo $form->textField($model, 'website', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'website'); ?>
    </div>

    <br/>
    <div class="form-group col-sm-7">
        <input type="submit" class="btn btn-primary" name="yt0" value="<?php echo $model->isNewRecord ? 'Create' : 'Save'; ?>">
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    jQuery(document).ready(function () {

        $("#country-list").change(function (e) {
            var code = $(this).val();
            if (code.length === 0) {
                clearRegionState("#state-list");
                clearRegionCity("#city-list");
            } else {
                loadRegionState(code);
            }
            return false;
        });
    });

    function loadRegionState(code) {
        var actionUrl = "<?php echo $this->createUrl('/region/loadStates'); ?>";
        var update = "#state-list";
        $.ajax({
            type: 'get',
            url: actionUrl,
            cache: false,
            data: {id: code},
            beforeSend: '',
            success: function (response) {
                $(update).html(response);
                if ($(update).find("option").length == 1) {
                    var stateId = $(update).val();
                    loadRegionCity(stateId, "#city-list");
                } else {
                    clearRegionCity("#city-list");
                }
            },
            error: function (response) {
                alert(response);
            },
            dataType: 'html'
        });
    }


    function loadRegionCity(stateId, updateSelector) {
        var actionUrl = "<?php echo $this->createUrl('/region/loadCities'); ?>";
        $.ajax({
            type: 'get',
            url: actionUrl,
            cache: false,
            data: {id: stateId},
            beforeSend: '',
            success: function (response) {
                $(updateSelector).html(response);
            },
            error: function (response) {
                alert(response);
            },
            dataType: 'html'
        });
    }

    function clearRegionState(selector) {
        $(selector).html("<option value=''>省份或地区</option>");
    }

    function clearRegionCity(selector) {
        $(selector).html("<option value=''>城市</option>");
    }
</script>