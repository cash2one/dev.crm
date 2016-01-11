
<?php
$profile = $data->getUserDoctorProfile();
$profileData = new stdClass();
if (!isset($profile)) {
    $profileData->name = '';
    $profileData->mobile = '';
    $profileData->hospital_name = '';
    $profileData->hp_dept_name = '';
    $profileData->clinical_title = '';
    $profileData->academic_title = '';
    $profileData->state_name = '';
    $profileData->city_name = '';
    $profileData->verified = '未认证';
    $profileData->contract = '未签约';
    $profileData->date_verified = '';
    $profileData->verified_by = '';
} else {
    $profileData->name = $profile->getName();
    $profileData->mobile = $profile->getMobile();
    $profileData->hospital_name = $profile->getHospitalName();
    $profileData->hp_dept_name = $profile->getHpDeptName();
    $profileData->clinical_title = $profile->getClinicalTitle();
    $profileData->academic_title = $profile->getAcademicTitle();
    $profileData->state_name = $profile->getStateName();
    $profileData->city_name = $profile->getCityName();
    $profileData->verified = $profile->isVerified() ? '已认证' : '未认证';
    $profileData->contract = $profile->isContractDoctor() ? '已签约' : '未签约';
    $profileData->date_verified = $profile->getDateVerified();
    $profileData->verified_by = $profile->getVerifiedBy();
}
?>

<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?></td>
    <td><?php echo $profileData->name; ?></td>
    <td><?php echo $profileData->mobile; ?></td>
    <td><?php echo $profileData->hospital_name; ?></td>
    <td><?php echo $profileData->hp_dept_name; ?></td>
    <td><?php echo $profileData->clinical_title; ?></td>
    <td><?php echo $profileData->academic_title; ?></td>
    <td><?php echo $profileData->verified; ?></td>
    <td><?php echo $profileData->contract; ?></td>
</tr>

