<?php
/* @var $this PatientbookingController */
/* @var $data PatientBooking */
$creator = $data->getCreator();
$creatorName = $creator->getUserDoctorProfile() !== null ? $creator->getUserDoctorProfile()->getName() : '无';

$creatorMobile = $creator->getMobile();
$patient = $data->getPatient();
$patientName = $patient->getName();
$patientMobile = $patient->getMobile();
//$patientMR = $patient->getPatientMR();
$diseaseName = $patient->getDiseaseName()!=null ? $patient->getDiseaseName() : '';
$diseaseDetail = $patient->getDiseaseDetail()!=null ? $patient->getDiseaseDetail() : '';

?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />
    
    <b>患者姓名:</b>
    <?php echo CHtml::encode($patientName); ?>
    <br />
    <b>患者手机:</b>
    <?php echo CHtml::encode($patientMobile); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ref_no')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->getStatus()); ?>
    <br />

    <b>医生姓名:</b>
    <?php echo CHtml::encode($creatorName); ?>
    <br />
    <b>医生手机:</b>
    <?php echo $creatorMobile; ?>
    <br />

    <b>疾病诊断:</b>
    <?php echo CHtml::encode($diseaseName); ?>
    <br />
    
    <b>疾病描述:</b>
    <?php echo CHtml::encode($diseaseDetail); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
    <?php echo CHtml::encode($data->getDateCreated()); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('date_end')); ?>:</b>
      <?php echo CHtml::encode($data->date_end); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('detail')); ?>:</b>
      <?php echo CHtml::encode($data->detail); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('appt_date')); ?>:</b>
      <?php echo CHtml::encode($data->appt_date); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_confirm')); ?>:</b>
      <?php echo CHtml::encode($data->date_confirm); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
      <?php echo CHtml::encode($data->remark); ?>
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