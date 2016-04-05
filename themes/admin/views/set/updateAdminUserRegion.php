<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs = array(
    '修改省市分配' => array('index'),
    '修改客服负责区域',
);
$bookingType = Yii::app()->request->getQuery('booking_type', '');
$urlAjaxLoadStateIds = $this->createUrl('set/ajaxLoadStateIds', array('type' => $bookingType, 'adminUserId' => ''));
$urlAjaxLoadAllStateIdsByBookingType = $this->createUrl('set/ajaxLoadAllStateIds', array('type' => $bookingType, 'admin_user_role' => 1));
?>
<style>
    .errorMessage{display: none;}
    .disabled{color: #f00;}
</style>
<h1>修改客服负责区域</h1>
<br>
<h3>客服列表</h3>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'adminuser-form',
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
echo CHtml::hiddenField("AdminUserRegionJoinForm[booking_type]", $bookingType);
?>
<div class="row">
    <?php
    $adminUser = AdminBooking::model()->getAdminUserList();
    foreach ($adminUser as $key => $value) {
        echo '<div class="col-sm-2 mt10"><label class="radio-inline"><input class="adminUser" type="radio" name="AdminUserRegionJoinForm[admin_user_id]" id="' . $key . '" value="' . $key . '"> ' . $value . '</label></div>';
    }
    ?>

</div>
<div class="clearfix mt10 adminuser-error errorMessage">请选择客服人员</div>
<br>
<h3>地区列表</h3>
<div class="mt10 color-gray">
    <label class="checkbox-inline">例：</label>
    <label class="checkbox-inline disabled"><input type="checkbox"  disabled> 北京</label>
    <label class="checkbox-inline">&nbsp;&nbsp;&nbsp;&nbsp;<span class="color-red">*无法选择为该省份已被安排给某客服</span></label>

</div>
<div class="row mt10">
    <?php
    $regionState = RegionState::model()->getAllByCountryId(1);
    foreach ($regionState as $key => $value) {
        echo '<div class="checkbox col-sm-1 mt10"><label class="checkbox-inline checkbox-state"><input type="checkbox" class="state" name="AdminUserRegionJoinForm[state][]" id="state' . $value->id . '" value="' . $value->id . '"> ' . $value->name . '</label></div>';
    }
    ?>
</div>
<br>
<div class="">        
    <button id="btnSubmit" type="button" class="btn btn-primary">保存</button>
</div>
<?php $this->endWidget(); ?>
<script>
    $(document).ready(function () {
        $('#btnSubmit').click(function () {
            var adminUser = false;
            $('.adminUser').each(function () {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    adminUser = true;
                }
            });
            if (adminUser) {
                $('#adminuser-form').submit();
            } else {
                $('.adminuser-error').show();
            }
        });
        $('.adminUser').click(function () {
            $('.adminuser-error').hide();
            $('.checkbox-state').removeClass('disabled');
            $('.state').prop('checked', false);
            $('.state').attr('disabled', false);
            var isChecked = $(this).is(':checked');
            if (isChecked) {
                var adminUserId = $(this).val();
                var urlAjaxLoadStateIds = '<?php echo $urlAjaxLoadStateIds; ?>/' + adminUserId;
                $.ajax({
                    url: urlAjaxLoadStateIds,
                    success: function (data) {
                        setStateChecked(data.stateIds);
                        ajaxLoadAllStateIdsByBookingType();
                    }
                });
            }
        });
    });
    function ajaxLoadAllStateIdsByBookingType() {
        var urlAjaxLoadAllStateIdsByBookingType = '<?php echo $urlAjaxLoadAllStateIdsByBookingType; ?>';
        $.ajax({
            url: urlAjaxLoadAllStateIdsByBookingType,
            success: function (data) {
                setStateDisable(data.stateIds);
            }
        });
    }
    function setStateChecked(stateIds) {
        $('.state').each(function () {
            var stateId = $(this).val();
            for (var i = 0; i < stateIds.length; i++) {
                if (stateIds[i] == stateId) {
                    $(this).prop('checked', true);
                }
            }
        });
    }
    function setStateDisable(stateIds) {
        $('.state').each(function () {
            var stateId = $(this).val();
            var isChecked = $(this).is(':checked');
            for (var i = 0; i < stateIds.length; i++) {
                if (stateIds[i] == stateId && !isChecked) {
                    $(this).attr('disabled', true);
                    $(this).parents('.checkbox-state').addClass('disabled');
                }
            }
        });
    }
</script>

