<?php
?>
<?php if (count($data->pbOrder) == 0) { ?>
    <tr>
        <td ><?php echo $data->id; ?></td>
        <td ><?php echo $data->getRefNo(); ?></td>
        <td ><?php echo $data->getPatientName(); ?></td>
        <td ><?php echo $data->getCreatorName(); ?></td>
        <td ><?php echo $data->date_created; ?></td>
        <td ><?php echo $data->getDoctorName(); ?></td>
        <td ><?php echo $data->getUserAgent(); ?></td>
        <td ><?php echo $data->getStatus(); ?></td>
        <td ><?php echo $data->getTravelType(); ?></td>
        <td colspan="4" class="text-center">暂无支付单信息</td>
        <td rowspan="1"><a target="_blank" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>" ><img src="<?php echo Yii::app()->baseUrl; ?>/assets/9f55b493/gridview/view.png" alt="查看"></a></td>
    </tr> 
    <?php
} else {
    foreach ($data->pbOrder as $key => $order) {
        ?>
        <tr>
            <?php if ($key == 0) { ?>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->id; ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getRefNo(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getPatientName(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getCreatorName(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->date_created; ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getDoctorName(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getUserAgent(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getStatus(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getTravelType(); ?></td>
            <?php } ?>
            <td><?php echo $order->getRefNo(); ?></td>
            <td><?php echo $order->getOrderType(); ?></td>
            <td><?php echo $order->getFinalAmount(); ?></td>
            <td><?php echo $order->getIsPaid(); ?></td>
<td rowspan="1"><a target="_blank" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>" ><img src="<?php echo Yii::app()->baseUrl; ?>/assets/9f55b493/gridview/view.png" alt="查看"></a></td>
        </tr>
        <?php
    }
}
?>


