<?php
$payments = $data->salesPayments;
$payment = null;
if (arrayNotEmpty($payments)) {
    foreach ($payments as $value) {
        if ($value->payment_status == StatCode::PAY_SUCCESS) {
            $payment = $value;
        }
    }
}
?>
<tr>
    <td><?php echo $data->id; ?></td>
    <td><?php echo $data->getRefNo(); ?></td>
    <td><?php echo is_null($payment) ? '' : $payment->uid; ?></td>
    <td><?php echo is_null($payment) ? '' : $payment->ping_charge_id; ?></td>
    <td><?php echo is_null($payment) ? '' : $payment->channel_trade_no; ?></td>
    <td><?php echo is_null($payment) ? '' : $payment->pay_channel; ?></td>
    <td><?php echo $data->getDateClosed(); ?></td>
    <td><?php echo $data->getSubject(); ?></td>
    <td><?php echo $data->getBdCode(); ?></td>
    <td><?php echo $data->getFinalAmount(); ?></td>
    <td><?php echo $data->getIsPaid(); ?></td>

    <td><?php echo $data->getBkType() == 1 ? '患者' : '手术直通车'; ?></td>
    <td>
        <?php
        if ($data->bk_type == 1) {
            echo CHtml::link(CHtml::encode('查看预约'), array('booking/view', 'id' => $data->bk_id), array('target' => '_blank'));
        } else {
            echo CHtml::link(CHtml::encode('查看预约'), array('patientBooking/view', 'id' => $data->bk_id), array('target' => '_blank'));
        }
        ?>
    </td>
    <td><a target="_blank" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>" ><img src="/myzd/assets/9f55b493/gridview/view.png" alt="查看"></a></td>

</tr>