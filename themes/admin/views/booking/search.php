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

<h1>患者预约搜索</h1>

<?php
$urlSearch = $this->createUrl('booking/searchResult');
$urlUserView = $this->createAbsoluteUrl('booking/view');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
?>

<div id = 'searchForm'>
    <div class="form-group col-sm-3">
        <label >预约单号</label>
        <div>
            <input class="form-control col-sm-3" name = 'bookingRefNo' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label >预约类型</label>
        <div>
            <select name = 'bkType' class="form-control col-sm-3">
                <option value = ''>全部</option>
                <option value = '1'>医生</option>
                <option value = '2'>专家团队</option>
                <option value = '9'>快速预约</option>
            </select>
        </div>
    </div>
    <div class="form-group  col-sm-3 ">
        <label >患者姓名</label>
        <div>
            <input class="form-control col-sm-3" name = 'contactName' value = ''>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label >疾病名称</label>
        <div>
            <input class="form-control" name = 'diseaseName' value = ''>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label >患者来源</label>
        <div>
            <input class="form-control" name = 'userAgent' value = ''>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label >处理状态</label>
        <div>
            <select name = 'bkStatus' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>待处理</option>
                <option value = '2'>处理中</option>
                <option value = '3'>专家已确认</option>
                <option value = '4'>患者已接受</option>
                <option value = '8'>已完成</option>
                <option value = '9'>已取消</option>
            </select>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label >支付单号</label>
        <div>
            <input class="form-control" name = 'orderRefNo' value = ''>
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label >支付状态</label>
        <div>
            <select name = 'isDepositPaid' class="form-control">
                <option value = ''>全部</option>
                <option value = '0'>未支付</option>
                <option value = '1'>已支付</option>
                <option value = '2'>支付失败</option>
            </select>
        </div>
    </div>
    <div class="form-group  col-sm-3">
        <label >支付金额</label>
        <div>
            <input class="form-control" name = 'finalAmount' value = ''>
        </div>
    </div>
    <div class="form-group  col-sm-3">
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
    <div class="form-group  col-sm-3">
        <label >支付开始时间</label>
        <div>
            <input class="form-control dateOpen" name = 'dateOpen' value = ''>
        </div>
    </div> 
    <div class="form-group  col-sm-3">
        <label >支付结束时间</label>
        <div>
            <input class="form-control dateClosed" name = 'dateClosed' value = ''>
        </div>
    </div> 

    <div class="form-group col-sm-3 mt30">
        <button id = 'btnSearch' type="submit" class="btn btn-primary">搜索</button>
    </div> 
    <div class="clearfix"></div>
</div>

<div id="searchResult">   
</div>


<script>
    $(document).ready(function () {
         var days = "";
            var date= $(".dateOpen").datepicker({            
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
             }).on('changeDate', function (e) {
            $('.dateClosed').datepicker('setStartDate', getStartTiem(e.date));
        });
         $(".dateClosed").datepicker({            
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
          function getStartTiem(date) {
            var timestamp = date.getTime();
            var newDate = new Date(timestamp);
            var startdate = [newDate.getFullYear(), newDate.getMonth() + 1, newDate.getDate()].join('-');
            return startdate;
        }
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";
        loadUserSearchResult(requestUrl+'?bookingType=1', selectorSearchResult);

        $("#btnSearch").click(function () {
            var searchUrl = requestUrl + '?bookingType=1';
            domForm.find("input,select").each(function () {
                // trim
                var value = $.trim($(this).val());
                if (value !== '') {
                    searchUrl += '&' + $(this).attr('name') + '=' + value;
                }
            });
            loadUserSearchResult(searchUrl, selectorSearchResult);
        });

    });
    function loadUserSearchResult(requestUrl, selectorSearchResult) {
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

