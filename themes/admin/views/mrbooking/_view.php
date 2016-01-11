<?php
/* @var $this MrbookingController */
/* @var $data MedicalRecordBooking */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ref_no')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('appt_date')); ?>:</b>
    <?php echo CHtml::encode($data->getApptDate() . '  （' . $data->getBufferDays() . '）'); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('faculty_id')); ?>:</b>
    <?php echo CHtml::encode($data->getFacultyName()); ?>
    <br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->status); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->getOwnerUsername()), array('user/view', 'id' => $data->user_id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
    <?php echo CHtml::encode($data->mobile); ?>
    <br />

    <b><?php echo CHtml::encode('相关病历'); ?>:</b>
    <?php echo CHtml::link('查看病历', array('medicalrecord/view', 'id' => $data->mr_id), array('target' => '_blank')); ?>
    <br />


    <?php /*

      <b><?php echo CHtml::encode($data->getAttributeLabel('patient_intention')); ?>:</b>
      <?php echo CHtml::encode($data->patient_intention); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
      <?php echo CHtml::encode($data->email); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('wechat')); ?>:</b>
      <?php echo CHtml::encode($data->wechat); ?>
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