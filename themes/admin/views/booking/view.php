<?php
/* @var $this BookingController */
/* @var $output array */
$booking = $data->booking;
//$expertBooked = $data['expertBooked'];
$files = $data->files;
$this->breadcrumbs = array(
    '预约列表' => array('admin'),
    $booking->id,
);
$urlOrderView = $this->createAbsoluteUrl('order/view', array('id' => ''));
$urlChangeBookingStatus = $this->createUrl('booking/changeStatus', array('id' => $booking->id, 'code' => ''));

$this->menu = array(
    //   array('label' => '搜索预约', 'url' => array('search')),
    //   array('label' => '修改预约', 'url' => array('update', 'id' => $booking->id)),
    array('label' => '删除预约', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $booking->id), 'confirm' => '预约#' . $booking->refNo . ' 确认删除?', 'style' => 'color:red', 'returnUrl' => '#success')),
    array('label' => '生成订单', 'url' => array('order/createBKOrder', 'bid' => $booking->id))
);
?>
<a href="<?php echo $this->createUrl('order/createBKOrder', array('bid' => $booking->id)) ?>" class="btn btn-primary">生成订单</a>
<div class="mt10">
    <h1>预约详情 #<?php echo $booking->refNo; ?></h1>
</div>
<style>
    .table-info tbody th{width: 15%;}
    .table-info tbody td{width: 35%;}
</style>
<table class="table table-info mt10" id="yw0">
    <tbody>
        <tr class="even">
            <th>单号</th><td><?php echo $booking->refNo; ?></td>
            <th>状态</th>
            <td>
                <?php echo $booking->bkStatus; ?>
                &nbsp;&nbsp;
                <select id="bkstatus-select" class="select">
                    <option value="">请选择</option>
                    <option value="<?php echo StatCode::BK_STATUS_NEW; ?>">待处理</option>
                    <option value="<?php echo StatCode::BK_STATUS_PROCESSING; ?>">处理中</option>
                    <option value="<?php echo StatCode::BK_STATUS_INVALID; ?>">失效的</option>
                    <option value="<?php echo StatCode::BK_STATUS_DONE; ?>">已完成</option>
                </select>
                &nbsp;&nbsp;
                <a id="bkstatusLink" class="btn-admin btn-default" href="<?php echo $urlChangeBookingStatus; ?>"  data-id="">变更</a>
            </td>
        </tr>
        <tr class="even">
            <th>预约专家</th><td><?php echo $booking->expertName; ?></td>
            <th></th><td></td>
        </tr>
        <tr class="even">
            <th>医院</th><td><?php echo $booking->hospitalName; ?></td>
            <th>科室</th><td><?php echo $booking->hpDeptName; ?></td>
        </tr>        
        <tr class="odd">
            <th>患者姓名</th><td><span class="null"><?php echo $booking->patientName; ?></span></td>
            <th>患者手机</th><td><?php echo $booking->mobile; ?></td>
        </tr>
        <tr class="odd">
            <th>疾病诊断</th><td><?php echo $booking->diseaseName; ?></td>
            <th>病情</th><td><?php echo $booking->diseaseDetail; ?></td>
        </tr>
        <tr class="even">
            <th>创建日期</th><td><?php echo $booking->dateCreated; ?></td>
            <th></th><td></td>
        </tr>
    </tbody>
</table>

<div style="margin-top: 30px">
    <h3>订单</h3>
    <?php
    if (arrayNotEmpty($orderList)) {
        ?>
        <table class="table" id="yw0">
            <tbody>
                <tr class="odd">
                    <th>订单号</th>
                    <th>Ping++ ID</th>
                    <th>订单类型</th>
                    <th>订单标题</th>
                    <th>订单内容</th>
                    <th>金额</th>
                    <th>支付情况</th>
                    <th>查看详情</th>
                </tr>
                <?php
                foreach ($orderList as $order):
                    ?>
                    <?php if (isset($order)): ?>
                        <tr class="odd">
                            <td><?php echo $order->getRefNo(); ?></td>
                            <td><?php echo $order->getPingId(); ?></td>
                            <td><?php echo $order->getOrderType(); ?></td>
                            <td><?php echo $order->getSubject(); ?></td>
                            <td><?php echo $order->getDescription(); ?></td>
                            <td><?php echo $order->getFinalAmount(); ?></td>
                            <td><?php echo $order->getIsPaid(); ?></td>
                            <td><a href="<?php echo $urlOrderView . '/' . $order->getId(); ?>" class="btn-admin btn-default" target="_blank">查看</a></td>
                        <?php endif; ?>
                        <?php
                    endforeach;
                }
                ?>
        </tbody>
    </table>
    <?php
    if (!arrayNotEmpty($orderList)) {
        echo '<p>未生成订单</p>';
    }
    ?>
</div>

<div>
    <h3>病历报告：共 <?php echo count($files) ?>（份）</h3>      
    <?php
    if (arrayNotEmpty($files)):
        echo '<div class="row">';
        foreach ($files as $file):
            ?>
            <div class="col-sm-2 mt10">
                <?php echo CHtml::image($file->fileUrl, '', array('class' => "img-responsive")); ?>
            </div>
            <?php
        endforeach;
        echo '</div>';
    endif;
    ?>
</div>

<script>
    $(document).ready(function () {
        var bkstatusLink = $("#bkstatusLink");
        $("#bkstatus-select").change(function () {
            var id = $(this).val();
            var url = bkstatusLink.attr("href") + "/" + id;
            bkstatusLink.attr('data-id', id);
            bkstatusLink.attr('href', url);
            return false;
        });
        bkstatusLink.click(function (e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            if (dataId == "") {
                alert("请选择状态");
            } else {
                var url = bkstatusLink.attr('href');
                window.location.href = url;
            }
            return false;
        });
    });
</script>
