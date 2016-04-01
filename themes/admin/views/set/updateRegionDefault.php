<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs = array(
    '修改省市分配' => array('index'),
    '修改默认客服',
);
$bookingType = Yii::app()->request->getQuery('booking_type', '');
$urlAjaxLoadDefaultAdminUser = $this->createUrl('set/ajaxLoadDefaultAdminUser', array('type' => $bookingType));
?>
<style>
    .errorMessage{display: none;}
</style>
<h1>修改默认客服</h1>
<br>
<h3>客服列表</h3>
<h4>默认客服：<span class="defaultAdminUser"></span></h4>
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
        $.ajax({
            url: '<?php echo $urlAjaxLoadDefaultAdminUser; ?>',
            success: function (data) {
                if (data.status == 'ok') {
                    setAdminUserChecked(data.admin_user_id);
                    $('.defaultAdminUser').text(data.admin_user_name);
                }
            }
        });
    });
    function setAdminUserChecked(admin_user_id){
        $('.adminUser').each(function(){
            var adminUser = $(this).val();
            if(adminUser == admin_user_id){
                $(this).prop('checked', true);
            }
        });
    }
</script>

