<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */

$this->breadcrumbs = array(
    '预约列表' => array('list'),
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
?>

<table id = 'searchForm'>
    <tr>
        <td>预约单号：</td>
        <td><input name = 'bookingRefNo' value = ''></td>
        <td>患者姓名：</td>
        <td><input name = 'patientName' value = ''></td>
    </tr>
    <tr>
        <td>创建人姓名：</td>
        <td><input name = 'creatorName' value = ''></td>
        <td>预约医生姓名：</td>
        <td><input name = 'doctorName' value = ''></td>
    </tr>
    <tr>
        <td>就诊方式：</td>
        <td>
            <select name = 'travelType'>
                <option value = ''>全部</option>
                <option value = '1'>邀请医生过来</option>
                <option value = '2'>希望转诊治疗</option>
            </select>
        </td>
        <td>处理状态：</td>
        <td>
            <select name = 'status'>
                <option value = ''>全部</option>
                <option value = '1'>待处理</option>
                <option value = '2'>处理中</option>
                <option value = '3'>已确认专家</option>
                <option value = '8'>已完成手术</option>
                <option value = '9'>已收到出院小结</option>
                <option value = '99'>已取消</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>支付单号</td>
        <td><input name = 'orderRefNo' value = ''></td>
        <td>支付状态：</td>
        <td> 
            <select name = 'isDepositPaid'>
                <option value = ''>全部</option>
                <option value = '0'>未支付</option>
                <option value = '1'>已支付</option>
                <option value = '2'>支付失败</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>支付金额</td>
        <td><input name = 'finalAmount' value = ''></td>
        <td>费用种类</td>
        <td><select name = 'orderType'>
                <option value = ''>全部</option>
                <option value = 'deposit'>订金</option>
                <option value = 'service'>服务费</option>
                <option value = 'surgery'>手术费</option>
                <option value = 'consultation'>会诊费</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>建单时间</td>
        <td>
            <input name = 'dateOpen' value = ''>
        </td>
        <td>支付时间</td>
        <td>
            <input name = 'dateClosed' value = ''>
        </td>
    </tr>
    <tr>
        <td>患者来源</td>
        <td>
            <select name = 'userAgent'>
                <option value = ''>全部</option>
                <option value = 'website'>网站</option>
                <option value = 'wap'>手机网站</option>
                <option value = 'weixin'>微信</option>
                <option value = 'ios'>iOS APP</option>
                <option value = 'android'>Android APP</option>
            </select>
        </td>
    </tr>
</table>
<button id = 'btnSearch' type = 'button'>搜索</button>

<?php
echo '<br>----------------------------------------------------查询结果-------------------------------------------------------------------------<br>';
?>
<div id="searchResult">   
</div>


<script>
    $(document).ready(function () {
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";


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

