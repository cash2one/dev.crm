<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */

$this->breadcrumbs = array(
    '预约列表' => array('admin'),
    '搜索',
);

$this->menu = array(
    array('label' => '预约列表', 'url' => array('list')),
//    array('label' => 'Create PatientBooking', 'url' => array('create')),
);
?>

<h1>手术直通车预约搜索</h1>

<?php
$urlSearch = $this->createUrl('patientBooking/searchResult');
$urlUserView = $this->createAbsoluteUrl('patientBooking/view');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
?>



<div id = 'searchForm'>
  <div class="form-group col-sm-2">
        <label >预约单号</label>
        <div>
            <input class="form-control" name = 'bookingRefNo' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >患者姓名</label>
        <div>
            <input class="form-control" name = 'patientName' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >创建人姓名</label>
        <div>
            <input class="form-control" name = 'creatorName' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >预约医生姓名</label>
        <div>
            <input class="form-control" name = 'doctorName' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >就诊方式</label>
        <div>
            <select name = 'travelType' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>邀请医生过来</option>
                <option value = '2'>希望转诊治疗</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >处理状态</label>
        <div>
            <select name = 'status' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>待处理</option>
                <option value = '2'>处理中</option>
                <option value = '3'>已确认专家</option>
                <option value = '8'>已完成手术</option>
                <option value = '9'>已收到出院小结</option>
                <option value = '99'>已取消</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >支付单号</label>
        <div>
            <input name = 'orderRefNo' class="form-control" value = ''>
        </div>
    </div>
    <div class="form-group col-sm-2">
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
    <div class="form-group col-sm-2">
        <label >支付金额</label>
        <div>
            <input name = 'finalAmount' class="form-control" value = ''>
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
        <label >建单时间</label>
        <div>
            <input name = 'dateOpen' class="form-control dateOpen" data-format="yyyy-mm-dd" value = '' placeholder="请输入日期">
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >支付时间</label>
        <div>
            <input name = 'dateClosed' class="form-control dateClosed" data-format="yyyy-mm-dd" value = '' placeholder="请输入日期">
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >患者来源</label>
        <div>
            <select name = 'userAgent' class="form-control">
                <option value = ''>全部</option>
                <option value = 'website'>网站</option>
                <option value = 'wap'>手机网站</option>
                <option value = 'weixin'>微信</option>
                <option value = 'ios'>iOS APP</option>
                <option value = 'android'>Android APP</option>
            </select>
        </div>
    </div>
    
    <div class="form-group col-sm-2 mt24">
        <button id = 'btnSearch' type="submit" class="btn btn-primary">搜索</button>
    </div> 
    <div class="clearfix"></div>
</div>
<div id="searchResult">   
</div>
<script>
    $(document).ready(function () {
        //开始日期
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
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";
loadUserSearchResult(requestUrl+ '?bkType=2', selectorSearchResult);

        $("#btnSearch").click(function () {
            var searchUrl = requestUrl + '?bkType=2';
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

