<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs = array(
    '预约列表' => array('list'),
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
?>

<table id = 'searchForm'>
    <tr>
        <td>预约单号：</td>
        <td><input name = 'bookingRefNo' value = ''></td>
        <td>预约类型：</td>
        <td>
            <select name = 'bkType'>
                <option value = ''>全部</option>
                <option value = '1'>医生</option>
                <option value = '2'>专家团队</option>
                <option value = '9'>快速预约</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>患者姓名：</td>
        <td><input name = 'contactName' value = ''></td>
        <td>疾病名称：</td>
        <td><input name = 'diseaseName' value = ''></td>
    </tr>
    <tr>
        <td>患者来源：</td>
        <td><input name = 'userAgent' value = ''></td>
        <td>处理状态：</td>
        <td>
            <select name = 'bkStatus'>
                <option value = ''>全部</option>
                <option value = '1'>待处理</option>
                <option value = '2'>处理中</option>
                <option value = '3'>专家已确认</option>
                <option value = '4'>患者已接受</option>
                <option value = '8'>已完成</option>
                <option value = '9'>已取消</option>
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
        <td>支付开始时间</td>
        <td>
            <input name = 'dateOpen' value = ''>
        </td>
        <td>支付结束时间</td>
        <td>
            <input name = 'dateClosed' value = ''>
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

