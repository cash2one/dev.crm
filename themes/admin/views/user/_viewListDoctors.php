<?php
/* @var $this UserController */
/* @var $data User */
?>
<?php
$profile = $data->getUserDoctorProfile();
$profileData = new stdClass();
if (is_null($profile)) {
    $profileData->name = '';
    $profileData->hospital_name = '';
    $profileData->hp_dept_name = '';
    $profileData->clinical_title = '';
    $profileData->academic_title = '';
    $profileData->state_name = '';
    $profileData->city_name = '';
    $profileData->verified = '未认证';
    $profileData->date_verified = '';
    $profileData->verified_by = '';
} else {
    $profileData->name = $profile->getName();
    $profileData->hospital_name = $profile->getHospitalName();
    $profileData->hp_dept_name = $profile->getHpDeptName();
    $profileData->clinical_title = $profile->getClinicalTitle();
    $profileData->academic_title = $profile->getAcademicTitle();
    $profileData->state_name = $profile->getStateName();
    $profileData->city_name = $profile->getCityName();
    $profileData->verified = $profile->isVerified() ? '已认证' : '未认证';
    $profileData->date_verified = $profile->getDateVerified();
    $profileData->verified_by = $profile->getVerifiedBy();
}
$verified = false;
if (isset($profile)) {
    $verified = $profile->isVerified();
}
?>
<tr class="view">

    <td>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>

    <td>
    <?php echo CHtml::link(CHtml::encode($data->getUsername()), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <?php //echo CHtml::link(CHtml::encode($data->getUsername()), array('view', 'id'=>$data->id), array('target'=>'_blank')); ?>
    </td>

    <td>
    <?php echo CHtml::encode($profileData->name); ?>
    </td>
    <td>
    <?php echo ($verified ? '已认证' : '未认证');  ?>
    </td>

    <td>
    <?php echo CHtml::encode($data->date_created); ?>
    </td>

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('login_attempts')); ?>:</b>
      <?php echo CHtml::encode($data->login_attempts); ?>
      <br />


      <b><?php echo CHtml::encode($data->getAttributeLabel('terms')); ?>:</b>
      <?php echo CHtml::encode($data->terms); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('date_activated')); ?>:</b>
      <?php echo CHtml::encode($data->date_activated); ?>
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

</tr>