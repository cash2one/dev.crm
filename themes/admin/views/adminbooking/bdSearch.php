<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs = array(
    '预约列表' => array('admin'),
    '搜索',
);

$this->menu = array(
    array('label' => '预约列表', 'url' => array('list')),
//    array('label'=>'创建预约', 'url'=>array('create')),
);
?>

<?php
$urlSearch = $this->createUrl('adminbooking/bdSearchResult');
$urlUserView = $this->createAbsoluteUrl('adminbooking/view');
$urlLoadCity = $this->createUrl('region/loadCities');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/css/bootstrap-datepicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
?>
<style>
    .w10{width: 10%;float: left;padding-right: 5px;}
</style>
<div id = 'searchForm'>
    <div class="mt15 w10">
        <label >预约单号</label>
        <div>
            <input class="form-control" name = 'refNo' value = '' >
        </div>
    </div>
    <div class="mt15 w10">
        <label >患者姓名</label>
        <div>
            <input class="form-control" name = 'patientName' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >患者性别</label>
        <div>
            <select name="patientGender" class="form-control">
                <option value="">选择</option>
                <option value="1">男</option>
                <option value="0">女</option>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >工作进度</label>
        <div>
            <select name="workSchedule" class="form-control">
                <option value="">选择</option>
                <?php
                $bookingStatus = AdminBooking::getOptionsBookingStatus();
                foreach ($bookingStatus as $key => $value) {
                    echo '<option value="' . $key . '">' . $value . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >客服</label>
        <div>
            <select name="adminUserId" class="form-control">
                <option value="">选择</option>
                <?php
                $adminUser = AdminBooking::model()->getAdminUserList();
                foreach ($adminUser as $key => $value) {
                    echo '<option value="' . $key . '">' . $value . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >对接人</label>
        <div>
            <select name="contactNameId" class="form-control">
                <option value="">选择</option>
                <?php
                $bdUser = AdminBooking::model()->getBdUserList();
                foreach ($bdUser as $key => $value) {
                    echo '<option value="' . $key . '">' . $value . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >就诊方式</label>
        <div>
            <select name = 'travelType' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>邀请医生过来</option>
                <option value = '2'>希望转诊治疗</option>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >病情诊断</label>
        <div>
            <input class="form-control" name = 'diseaseName' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >理想医院</label>
        <div>
            <input class="form-control" name = 'expectHp' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >理想科室</label>
        <div>
            <input class="form-control" name = 'expectDept' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >理想专家</label>
        <div>
            <input class="form-control" name = 'expectDoctor' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >最终手术专家</label>
        <div>
            <input class="form-control" name = 'finalDoctor' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >最终手术医院</label>
        <div>
            <input class="form-control" name = 'finalHospital' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >手术时间</label>
        <div>
            <input class="form-control datepicker" name = 'finalTime' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >创建日期</label>
        <div>
            <input class="form-control dateOpen inline-block" name = 'dateCreatedStart' value = '' placeholder="开始时间">
        </div>
    </div> 
    <div class="mt15 w10">
        <label >&nbsp;</label>
        <div>
            <input class="form-control dateClosed inline-block" name = 'dateCreatedEnd' value = '' placeholder="结束时间">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="mt15 w10">
        <label >推送医生</label>
        <div>
            <input class="form-control" name = 'creatorDoctorName' value = ''>
        </div>
    </div>
    
    <div class="mt15 w10">
        <label >推送医生所在医院</label>
        <div>
            <input class="form-control" name = 'creatorDoctorHp' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >推送医生所在科室</label>
        <div>
            <input class="form-control" name = 'creatorDoctorHpDept' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >推送医生所在省份</label>
        <div>
            <select id="creatorDoctorStateId" name="creatorDoctorStateId" class="form-control">
                <option value="">选择省份</option>
                <option value="1">北京</option>
                <option value="2">天津</option>
                <option value="3">河北</option>
                <option value="4">山西</option>
                <option value="5">内蒙古</option>
                <option value="6">辽宁</option>
                <option value="7">吉林</option>
                <option value="8">黑龙江</option>
                <option value="9">上海</option>
                <option value="10">江苏</option>
                <option value="11">浙江</option>
                <option value="12">安徽</option>
                <option value="13">福建</option>
                <option value="14">江西</option>
                <option value="15">山东</option>
                <option value="16">河南</option>
                <option value="17">湖北</option>
                <option value="18">湖南</option>
                <option value="19">广东</option>
                <option value="20">广西</option>
                <option value="21">海南</option>
                <option value="22">重庆</option>
                <option value="23">四川</option>
                <option value="24">贵州</option>
                <option value="25">云南</option>
                <option value="26">西藏</option>
                <option value="27">陕西</option>
                <option value="28">甘肃</option>
                <option value="29">青海</option>
                <option value="30">宁夏</option>
                <option value="31">新疆</option>
                <option value="32">台湾</option>
                <option value="33">香港</option>
                <option value="34">澳门</option>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >推送医生所在城市</label>
        <div>
            <select id="creatorDoctorCityId" name="creatorDoctorCityId" class="form-control">
                <option value="">选择城市</option>
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="mt15 w10">
        <label >支付单号</label>
        <div>
            <input class="form-control" name = 'orderRefNo' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >支付金额</label>
        <div>
            <input class="form-control" name = 'finalAmount' value = ''>
        </div>
    </div>
    <div class="mt15 w10">
        <label >是否支付</label>
        <div>
            <select name = 'isPaid' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>是</option>
                <option value = '0'>否</option>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >费用种类</label>
        <div>
            <select name = 'orderType' class="form-control">
                <option value = ''>全部</option>
                <option value = 'deposit'>订金</option>
                <option value = 'service'>服务费</option>
                <option value = 'surgery'>手术费</option>
                <option value = 'consultation'>会诊费</option>
            </select>
        </div>
    </div>
    <div class="mt15 w10">
        <label >支付开始时间</label>
        <div>
            <input class="form-control datepicker" name = 'dateOpen' value = ''>
        </div>
    </div> 
    <div class="mt15 w10">
        <label >支付结束时间</label>
        <div>
            <input class="form-control datepicker" name = 'dateClosed' value = ''>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="mt15 col-lg-2 col-sm-3 col-xs-6 ">
        <button id = 'btnSearch' type="submit" class="btn btn-primary">搜索</button>
    </div> 
    <div class="clearfix"></div>
</div>

<div id="searchResult">   
</div>


<script>
    $(document).ready(function () {
        var days = "";
        var date = $(".dateOpen").datepicker({
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        }).on('changeDate', function (e) {
            $('.dateClosed').datepicker('setStartDate', getStartTime(e.date));
        });
        $(".dateClosed").datepicker({
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        $(".datepicker").datepicker({
            //startDate: "+0d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            todayHighlight: true,
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        function getStartTime(date) {
            var timestamp = date.getTime();
            var newDate = new Date(timestamp);
            var startdate = [newDate.getFullYear(), newDate.getMonth() + 1, newDate.getDate()].join('-');
            return startdate;
        }
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>?bookingType=2";
        loadUserSearchResult(requestUrl, selectorSearchResult);

        $("#btnSearch").click(function () {
            var searchUrl = '';
            domForm.find("input,select").each(function () {
                // trim
                var value = $.trim($(this).val());
                if (value !== '') {
                    searchUrl += '&' + $(this).attr('name') + '=' + value;
                }
            });
            //searchUrl = '?' + searchUrl.substr(1);
            loadUserSearchResult(requestUrl + searchUrl, selectorSearchResult);
        });

        $("select#stateId").change(function () {
            $("select#cityId").attr("disabled", true);
            var stateId = $(this).val();
            var actionUrl = "<?php echo $urlLoadCity; ?>";// + stateId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                data: {'state': this.value, 'prompt': '选择城市'},
                cache: false,
                // dataType: "html",
                'success': function (data) {
                    $("select#cityId").html(data);
                },
                'error': function (data) {
                },
                complete: function () {
                    $("select#cityId").attr("disabled", false);
                }
            });
            return false;
        });

        $("select#creatorDoctorStateId").change(function () {
            $("select#creatorDoctorCityId").attr("disabled", true);
            var stateId = $(this).val();
            var actionUrl = "<?php echo $urlLoadCity; ?>";// + stateId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                data: {'state': this.value, 'prompt': '选择城市'},
                cache: false,
                // dataType: "html",
                'success': function (data) {
                    $("select#creatorDoctorCityId").html(data);
                },
                'error': function (data) {
                },
                complete: function () {
                    $("select#creatorDoctorCityId").attr("disabled", false);
                }
            });
            return false;
        });
    });
    function loadUserSearchResult(requestUrl, selectorSearchResult) {
        requestUrl = encodeURI(requestUrl);
        $.ajax({
            url: requestUrl,
            async: false,
            success: function (data) {
                $(selectorSearchResult).html(data);
            },
            complete: function () {
                // hide loading gif.
            }
        });
    }

</script>

