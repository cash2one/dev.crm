<?php
/* @var $this BookingController */
/* @var $data Booking */
$creator = $data->getCreator();
if (is_null($creator) == false) {
    $creatorName = $creator->getUserDoctorProfile() !== null ? $creator->getUserDoctorProfile()->getName() : '无';
    $creatorMobile = $creator->getMobile();
} else {
    $creatorName = '无';
    $creatorMobile = '无';
}
$patientAge = '';
if (strIsEmpty($data->patient_age) == false) {
    $ageArray = explode(',', $data->patient_age);
    foreach ($ageArray as $key => $value) {
        if ($key == 0) {
            $patientAge .= $value . '岁';
        } else if ($key == 1) {
            $patientAge .= $value . '月';
        }
    }
}
?>
<tr class="view">

    <td>
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>

    <td>  
        <?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->patient_name); ?>
    </td>

    <td>
        <?php echo CHtml::link(CHtml::encode($data->patient_mobile), array('patient/view', 'mobile' => $data->patient_mobile), array('target' => '_blank')); ?>
    </td>

    <td>
        <?php echo $data->getWorkSchedule(); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->patient_state); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->patient_city); ?>
    </td>

    <td>
        <?php echo CHtml::encode($patientAge); ?>
    </td>

    <td>
        <?php echo CHtml::encode($creatorName); ?>
    </td>

    <td>
        <?php echo CHtml::encode($creatorMobile); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->getCustomerAgent() == '' ? '未填写' : $data->getCustomerAgent()); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->admin_user_name); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->date_created); ?>
    </td>


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

</tr>