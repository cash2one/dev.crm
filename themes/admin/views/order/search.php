<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */

$this->breadcrumbs = array(
    'Sales Orders' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => '订单列表', 'url' => array('index')),
//    array('label' => 'Create SalesOrder', 'url' => array('create')),
);
?>

<h1>Manage Sales Orders</h1>
<?php
$urlSearch = $this->createUrl('order/searchResult');
$urlPatientBookingView = $this->createAbsoluteUrl('patientBooking/view');
$urlBookingView = $this->createAbsoluteUrl('booking/view');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
?>

<div id = 'searchForm'>
    <div class="form-group col-sm-2">
        <label >支付单号</label>
        <div>
            <input class="form-control" name = 'refNo' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
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
    <div class="form-group col-sm-2">
        <label >Ping++ ID</label>
        <div>
            <input class="form-control" name = 'pingId' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >预约类型</label>
        <div>
            <select name = 'bkType' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>患者</option>
                <option value = '2'>手术直通车</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >支付金额</label>
        <div>
            <input class="form-control" name = 'finalAmount' value = '' placeholder="如：100.00">
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >支付状态</label>
        <div>
            <select name = 'isPaid' class="form-control">
                <option value = ''>全部</option>
                <option value = '9'>未支付</option>
                <option value = '1'>已支付</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >建单时间</label>
        <div>
            <input class="form-control dateOpen" name = 'dateOpen' value = '' placeholder="yyyy-MM-dd">
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >支付时间</label>
        <div>
            <input class="form-control dateClosed" name = 'dateClosed' value = '' placeholder="yyyy-MM-dd">
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >地区</label>
        <div>
            <input class="form-control" name = 'bdCode' value = '' placeholder="请填写地区名">
        </div>
    </div>

    <div class="form-group col-sm-2 mt24">
        <button id = 'btnSearch' type="submit" class="btn btn-primary">搜索</button>
    </div>
</div>
<div class="clearfix"></div>
<div id="searchResult">   
</div>
<style>
    #searchResult .table td{word-break: break-all; word-wrap:break-word;min-width: 5em;max-width: 50em;vertical-align: middle;}
</style>

<script>
    $(document).ready(function () {
         $(".dateOpen").datepicker({            
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
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
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";
        loadUserSearchResult(requestUrl+ '?he=2', selectorSearchResult);

        $("#btnSearch").click(function () {
            var searchUrl = requestUrl + '?he=2';
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




