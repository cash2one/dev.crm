<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs = array(
    '配置',
);
$urlUpdateAdminUserRegion = $this->createUrl('set/updateAdminUserRegion', array('booking_type' => ''));
$urlUpdateRegionDefault = $this->createUrl('set/updateRegionDefault', array('booking_type' => ''));
$adminUserBK = $data->results['adminUserBK'];
$adminUserPB = $data->results['adminUserPB'];
?>
<style>
    .errorMessage{display: none;}
</style>
<h1>修改省市分配</h1>
<br>
<h4>
    <label class="radio-inline">
        <input type="radio" name="bookingType" id="bookingTypePatient" value="1"> 患者端
    </label>
    <label class="radio-inline">
        <input type="radio" name="bookingType" id="bookingTypeDocotr" value="2"> 医生端
    </label>
    <h5 class="booking-type-error errorMessage">请选择预约类型</h5>
</h4>
<br>
<h4>
    <label class="radio-inline">
        <input type="radio" name="setType" id="setTypeArea" value="<?php echo $urlUpdateAdminUserRegion; ?>"> 修改区域
    </label>
    <label class="radio-inline">
        <input type="radio" name="setType" id="setTypeDefault" value="<?php echo $urlUpdateRegionDefault; ?>"> 修改默认人
    </label>
    <h5 class="set-type-error errorMessage">请选择设置类型</h5>
</h4>
<br>
<div>
    <button id="updateAdminUserRegion" class="btn btn-primary">确认</button>
</div>
<br>
<div class="row">
    <div class="col-sm-4">
        <h3>患者端</h3>
        <table class="table">
            <tr class="odd"><th>客服</th><th>区域</th></tr>
            <?php
            foreach ($adminUserBK as $value) {
                echo '<tr class="odd"><td>' . $value->adminUserName . '</td><td>' . $value->state . '</td></tr>';
            }
            ?>
        </table>
    </div>
    <div class="col-sm-4">
        <h3>医生端</h3>
        <table class="table">
            <tr class="odd"><th>客服</th><th>区域</th></tr>
            <?php
            foreach ($adminUserPB as $value) {
                echo '<tr class="odd"><td>' . $value->adminUserName . '</td><td>' . $value->state . '</td></tr>';
            }
            ?>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#updateAdminUserRegion').click(function () {
            var booingType = 0, setUrl;
            $('input[name="bookingType"]').each(function () {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    booingType = $(this).val();
                }
            });
            $('input[name="setType"]').each(function () {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    setUrl = $(this).val();
                }
            });
            if (!booingType) {
                $('.booking-type-error').show();
            } else if (!setUrl) {
                $('.booking-type-error').hide();
                $('.set-type-error').show();
            } else {
                location.href = setUrl + '/' + booingType;
            }
        });
    });
</script>