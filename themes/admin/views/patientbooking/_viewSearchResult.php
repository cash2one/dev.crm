<?php if (count($data->pbOrder) == 0) { ?>
    <tr>
        <td ><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?></td>
        <td ><?php echo $data->getRefNo(); ?></td>
        <td ><?php echo $data->getPatientName(); ?></td>
        <td ><?php echo $data->getCreatorName(); ?></td>
        <td ><?php echo $data->getDoctorName(); ?></td>
        <td ><?php echo $data->getUserAgent(); ?></td>
        <td ><?php echo $data->getStatus(); ?></td>
        <td ><?php echo $data->getTravelType(); ?></td>
        <td colspan="4" class="text-center">暂无支付单信息</td>
    </tr> 
    <?php
} else {
    foreach ($data->pbOrder as $key => $order) {
        ?>
        <tr>
            <?php if ($key == 0) { ?>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getRefNo(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getPatientName(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getCreatorName(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getDoctorName(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getUserAgent(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getStatus(); ?></td>
                <td rowspan="<?php echo count($data->pbOrder); ?>"><?php echo $data->getTravelType(); ?></td>
            <?php } ?>
            <td><?php echo $order->getRefNo(); ?></td>
            <td><?php echo $order->getOrderType(); ?></td>
            <td><?php echo $order->getFinalAmount(); ?></td>
            <td><?php echo $order->getIsPaid(); ?></td>

        </tr>
        <?php
    }
}
?>


