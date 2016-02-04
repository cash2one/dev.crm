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

<tr class="view">

    <td>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>
    
    <td>
    <?php echo CHtml::encode($patientName); ?>
    </td>
    <td>
    <?php echo CHtml::encode($patientMobile); ?>
    </td>

    <td>
    <?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>

    <td>
    <?php echo CHtml::encode($data->getStatus()); ?>
    </td>

    <td>
    <?php echo CHtml::encode($creatorName); ?>
    </td>
    <td>
    <?php echo $creatorMobile; ?>
    </td>

    <td>
    <?php echo CHtml::encode($diseaseName); ?>
    </td>
    
    <td>
    <?php echo CHtml::encode($diseaseDetail); ?>
    </td>

    <td>
    <?php echo CHtml::encode($data->getDateCreated()); ?>
    </td>

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

</tr>