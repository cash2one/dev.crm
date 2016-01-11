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
?>

<table id = 'searchForm'>
    <tr>
        <td>支付单号:</td>
        <td><input name = 'refNo' value = ''></td>
        <td>费用种类:</td>
        <td><select name = 'orderType'>
                <option value = ''>全部</option>
                <option value = 'deposit'>订金</option>
                <option value = 'service'>服务费</option>
                <option value = 'surgery'>手术费</option>
                <option value = 'consultation'>会诊费</option>
            </select></td>
    </tr>
    <tr>
        <td>Ping++ ID:</td>
        <td><input name = 'pingId' value = ''></td>
        <td>预约类型:</td>
        <td>
            <select name = 'bkType'>
                <option value = ''>全部</option>
                <option value = '1'>患者</option>
                <option value = '2'>手术直通车</option>
            </select>
        </td>
    </tr>

    <tr>
        <td>支付金额:</td>
        <td><input name = 'finalAmount' value = '' placeholder="如：100.00"></td>
        <td>支付状态:</td>
        <td> 
            <select name = 'isPaid'>
                <option value = ''>全部</option>
                <option value = '9'>未支付</option>
                <option value = '1'>已支付</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>建单时间:</td>
        <td>
            <input name = 'dateOpen' value = '' placeholder="yyyy-MM-dd HH:mm:ss">
        </td>
        <td>支付时间:</td>
        <td>
            <input name = 'dateClosed' value = '' placeholder="yyyy-MM-dd HH:mm:ss">
        </td>
    </tr>
    <tr>
        <td>地区:</td>
        <td>
            <input name = 'bdCode' value = '' placeholder="请填写地区名">
        </td>
        <td></td>
        <td></td>
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




