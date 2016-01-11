<?php
/* @var $this BookingController */
/* @var $data Booking */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ref_no')); ?>:</b>    
    <?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
    <?php echo CHtml::encode($data->mobile); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('contact_name')); ?>:</b>
    <?php echo CHtml::encode($data->contact_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->getStatusText()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
    <?php echo CHtml::encode($data->date_created); ?>
    <br />

    <b>病历数量:</b>
    <?php echo CHtml::encode($data->countFiles); ?>
    <br />
    
    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('faculty_id')); ?>:</b>
      <?php echo CHtml::encode($data->faculty_id); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('doctor_id')); ?>:</b>
      <?php echo CHtml::encode($data->doctor_id); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('expteam_id')); ?>:</b>
      <?php echo CHtml::encode($data->expteam_id); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('hospital_id')); ?>:</b>
      <?php echo CHtml::encode($data->hospital_id); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('hospital_dept')); ?>:</b>
      <?php echo CHtml::encode($data->hospital_dept); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('booking_target')); ?>:</b>
      <?php echo CHtml::encode($data->booking_target); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('patient_condition')); ?>:</b>
      <?php echo CHtml::encode($data->patient_condition); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('appt_date')); ?>:</b>
      <?php echo CHtml::encode($data->appt_date); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('contact_email')); ?>:</b>
      <?php echo CHtml::encode($data->contact_email); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('contact_weixin')); ?>:</b>
      <?php echo CHtml::encode($data->contact_weixin); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('user_host_ip')); ?>:</b>
      <?php echo CHtml::encode($data->user_host_ip); ?>
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

</div>