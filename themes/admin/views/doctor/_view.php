<?php
/* @var $this DoctorController */
/* @var $data Doctor */
?>

<div class="view">

    <div class="dr-avatar"><?php echo CHtml::Image($data->getAbsUrlAvatar(), $data->fullname, array('title' => $data->fullname)); ?></div>

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::encode($data->id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->getMedicalTitle() . '  ' . $data->getAcademicTitle()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('hospital_id')); ?>:</b>
    <?php echo CHtml::encode($data->getHospitalName()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('faculty')); ?>:</b>
    <?php echo CHtml::encode($data->faculty); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
    <?php echo CHtml::encode($data->mobile); ?>
    <br />

    <b>相关联的科室：</b>
    <?php echo arrayToCSV(CHtml::listData($data->doctorFaculties(), 'id', 'name')); ?>
    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('expertise')); ?>:</b>
      <?php echo CHtml::encode($data->expertise); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
      <?php echo CHtml::encode($data->email); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
      <?php echo CHtml::encode($data->password); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('salt')); ?>:</b>
      <?php echo CHtml::encode($data->salt); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('password_raw')); ?>:</b>
      <?php echo CHtml::encode($data->password_raw); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('wechat')); ?>:</b>
      <?php echo CHtml::encode($data->wechat); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('tel')); ?>:</b>
      <?php echo CHtml::encode($data->tel); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('display_order')); ?>:</b>
      <?php echo CHtml::encode($data->display_order); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_activated')); ?>:</b>
      <?php echo CHtml::encode($data->date_activated); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_verified')); ?>:</b>
      <?php echo CHtml::encode($data->date_verified); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:</b>
      <?php echo CHtml::encode($data->last_login_time); ?>
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