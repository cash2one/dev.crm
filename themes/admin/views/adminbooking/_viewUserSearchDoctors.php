<?php
$bid = Yii::app()->request->getQuery('bid', 0);
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
} else {
    $profileData->name = $profile->getName();
    $profileData->mobile = $profile->getMobile();
    $profileData->hospital_name = $profile->getHospitalName();
    $profileData->hp_dept_name = $profile->getHpDeptName();
    $profileData->clinical_title = $profile->getClinicalTitle();
    $profileData->academic_title = $profile->getAcademicTitle();
    $profileData->state_name = $profile->getStateName();
    $profileData->city_name = $profile->getCityName();
}
?>

<tr>
    <td><a target="_blank" href="<?php echo $this->createUrl('user/view', array('id' => $data->id)) ?>"><?php echo $data->id; ?></a></td>
    <td><a target="_blank" href="<?php echo $this->createUrl('user/view', array('id' => $data->id)) ?>"><?php echo $profileData->name; ?></a></td>
    <td><?php echo $profileData->mobile; ?></td>
    <td><?php echo $profileData->hospital_name; ?></td>
    <td><?php echo $profileData->hp_dept_name; ?></td>
    <td><?php echo $profileData->clinical_title; ?></td>
    <td><?php echo $profileData->academic_title; ?></td>
    <td><a class="relateDoctor" href="<?php echo $this->createUrl('adminbooking/relate', array('bid' => $bid, 'userid' => $data->id, 'name' => $profileData->name)) ?>">选择</a></td>
</tr>

