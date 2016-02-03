<?php
$pbOrder = isset($data->pbOrder) ? $data->pbOrder : null;
?>
<?php if (count($pbOrder) == 0) { ?>
    <tr>
        <td ><?php echo $data->booking_id; ?></td>
        <td ><?php echo $data->getBookingType(); ?></td>
        <td ><?php echo $data->ref_no; ?></td>
        <td ><?php echo $data->patient_name; ?></td>
        <td ><?php echo $data->patient_age; ?></td>
        <td ><?php echo $data->patient_state ?></td>
        <td ><?php echo $data->experted_doctor_name ?></td>
        <td colspan="4" class="text-center">暂无支付单信息</td>
        <td rowspan="1"><a target="_blank" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>" ><img src="/myzd/assets/9f55b493/gridview/view.png" alt="查看"></a></td>
    </tr> 
    <?php
} else {
    foreach ($pbOrder as $key => $order) {
        ?>
        <tr>
            <?php if ($key == 0) { ?>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->booking_id; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->getBookingType(); ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->ref_no; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->patient_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->patient_age; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->patient_state; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->experted_doctor_name; ?></td>
            <?php } ?>
            <td><?php echo $order->getRefNo(); ?></td>
            <td><?php echo $order->getOrderType(); ?></td>
            <td><?php echo $order->getFinalAmount(); ?></td>
            <td><?php echo $order->getIsPaid(); ?></td>
            <td rowspan="1"><a target="_blank" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>" ><img src="/myzd/assets/9f55b493/gridview/view.png" alt="查看"></a></td>
        </tr>
        <?php
    }
}
?>


