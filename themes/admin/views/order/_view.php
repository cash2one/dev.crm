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

<tr class="view">

    <td>
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    </td>

    <td>
        <?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id' => $data->id)); ?>
    </td>

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
      <?php echo CHtml::encode($data->user_id); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('bk_id')); ?>:</b>
      <?php echo CHtml::encode($data->bk_id); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('bk_type')); ?>:</b>
      <?php echo CHtml::encode($data->bk_type); ?>
      <br />
     */ ?>

    <td>
        <?php echo CHtml::encode($data->bk_ref_no); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->subject); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->description); ?>
    </td>

    <td>
        <?php echo $data->is_paid == 1 ? '已支付' : '未支付'; ?>
    </td>

    <td>
        <?php echo CHtml::encode($payment->uid); ?>
    </td>

    <td>
        <?php echo CHtml::encode($payment->ping_charge_id); ?>
    </td>

    <td>
        <?php echo CHtml::encode($payment->pay_channel); ?>
    </td>

    <td>
        <?php echo CHtml::encode($payment->bill_amount . $payment->bill_currency); ?>
    </td>


    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('is_paid')); ?>:</b>
      <?php echo CHtml::encode($data->is_paid); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_open')); ?>:</b>
      <?php echo CHtml::encode($data->date_open); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_closed')); ?>:</b>
      <?php echo CHtml::encode($data->date_closed); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
      <?php echo CHtml::encode($data->created_by); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('total_amount')); ?>:</b>
      <?php echo CHtml::encode($data->total_amount); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('discount_percent')); ?>:</b>
      <?php echo CHtml::encode($data->discount_percent); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('discount_amount')); ?>:</b>
      <?php echo CHtml::encode($data->discount_amount); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('final_amount')); ?>:</b>
      <?php echo CHtml::encode($data->final_amount); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
      <?php echo CHtml::encode($data->currency); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
      <?php echo CHtml::encode($data->date_created); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_updated')); ?>:</b>
      <?php echo CHtml::encode($data->date_updated); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_deleted')); ?>:</b>
      <?php echo CHtml::encode($data->date_deleted); ?>
      <br />

     */ ?>

</tr>