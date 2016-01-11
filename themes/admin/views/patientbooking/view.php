<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */
$booking = $data->booking;
$creator = $data->creator;
$patient = $data->patient;
$patientMR = $data->patientMR;
$files = $data->mrfiles;

$urlDoctor = $this->createAbsoluteUrl('user/view', array('id' => $creator->id));
$urlOrderView = $this->createAbsoluteUrl('order/view', array('id' => ''));

$this->breadcrumbs = array(
    '预约列表' => array('list'),
    $booking->id,
);

$this->menu = array(
    //array('label'=>'Create PatientBooking', 'url'=>array('create')),
    //array('label'=>'Update PatientBooking', 'url'=>array('update', 'id'=>$booking->id)),
    //array('label'=>'Delete PatientBooking', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$booking->id),'confirm'=>'Are you sure you want to delete this item?')),
    //array('label' => 'Manage PatientBooking', 'url' => array('admin')),
    array('label' => '预约列表', 'url' => array('list')),
    array('label' => '生成订单', 'url' => array('order/createPBOrder', 'bid' => $booking->id)),
    array('label' => '关联医生', 'url' => array('relateDoctor', 'bid' => $booking->id))
);

$urlChangeBookingStatus = $this->createUrl('patientbooking/changeStatus', array('id' => $booking->id, 'code' => ''));
?>


<h1>预约详情 - 医生端 #<?php echo $booking->refNo; ?></h1>

<table class="detail-view" id="yw0">
    <tbody>
        <tr class="odd"><th>ID</th><td><?php echo $booking->id; ?></td></tr>
        <tr class="even"><th>单号</th><td><?php echo $booking->refNo; ?></td></tr>
        <tr class="even"><th>状态</th>
            <td>
                <?php echo $booking->status; ?>
                &nbsp;&nbsp;
                <select id="bkstatus-select" class="select">
                    <option value="0">请选择</option>
                    <option value="1">待处理</option>
                    <option value="2">处理中</option>
                    <option value="7">失效的</option>
                    <option value="8">已完成</option>
                </select>
                &nbsp;&nbsp;
                <a id="bkstatusLink" href="<?php echo $urlChangeBookingStatus; ?>"  data-id="0">变更</a>
            </td>
        </tr>
        <tr class="even"><th>医生姓名</th><td><?php echo $creator->name; ?></td></tr>
        <tr class="even"><th>医生手机</th><td><a href="<?php echo $urlDoctor; ?>" target="_blank"><?php echo $creator->mobile; ?></a></td></tr>
        <tr class="even"><th>就诊方式</th><td><?php echo $booking->travelType; ?></td></tr>
        <tr class="even"><th>最早</th><td><?php echo $booking->dateStart; ?></td></tr>
        <tr class="even"><th>最晚</th><td><?php echo $booking->dateEnd; ?></td></tr>
        <tr class="even"><th>预约详情</th><td><?php echo $booking->detail; ?></td></tr>
        <tr class="even"><th>备注</th><td><?php echo $booking->remark; ?></td></tr>
        <tr class="even"><th>创建日期</th><td><?php echo $booking->dateCreated; ?></td></tr>
    </tbody>
</table>
<table class="detail-view">
    <tbody>
        <?php if (isset($patient)): ?>
            <tr class="odd"><th>患者姓名</th><td><span class="null"><?php echo $patient->name; ?></span></td></tr>        
            <tr class="odd"><th>患者手机</th><td><span class="null"><?php echo $patient->mobile; ?></span></td></tr>
            <tr class="odd"><th>性别</th><td><?php echo $patient->gender; ?></td></tr>
            <tr class="odd"><th>年龄</th><td><?php echo $patient->age; ?></td></tr>
            <tr class="odd"><th>省份</th><td><?php echo $patient->placeState; ?></td></tr>
            <tr class="odd"><th>城市</th><td><?php echo $patient->placeCity; ?></td></tr>
            <tr class="odd"><th>疾病诊断</th><td><?php echo $patient->diseaseName; ?></td></tr>
            <tr class="odd"><th>病情描述</th><td><?php echo $patient->diseaseDetail; ?></td></tr>
        <?php endif; ?>
    </tbody>
</table>


<table class="detail-view" id="yw0">
    <tbody>
        <?php if (isset($userDoctor)): ?>
            <tr class="odd"><th>关联医生</th><td><?php echo $userDoctor->name; ?></td></tr>
            <tr class="odd"><th>关联医生医院</th><td><?php echo $userDoctor->hospital_name; ?></td></tr>
            <tr class="odd"><th>关联医生科室</th><td><?php echo $userDoctor->hp_dept_name; ?></td></tr>
        <?php endif; ?>
        <?php if (isset($userDoctor) === false): ?>
            <tr class="odd"><th>关联医生</th><td><?php echo '未关联医生'; ?></td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="margin-top: 30px">
    <h3>订单</h3>
    <?php
    if (arrayNotEmpty($orderList)) {
        ?>
        <table class="detail-view" id="yw0">
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
                            <td><a href="<?php echo $urlOrderView . '/' . $order->getId(); ?>" target="_blank">查看</a></td>
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
        foreach ($files as $file):
            ?>
            <div>
                <?php echo CHtml::image($file->fileUrl, '', array('class' => "img-responsive")); ?>
            </div>
            <?php
        endforeach;
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
            if (dataId == "0") {
                alert("请选择状态");
            } else {
                var url = bkstatusLink.attr('href');
                window.location.href = url;
            }
            return false;
        });
    });
</script>