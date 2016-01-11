<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    '用户列表' => array('listdoctors'),
    $model->name,
);

$this->menu = array(
    array('label' => '用户列表', 'url' => array('listdoctors')),
    array('label' => '管理用户', 'url' => array('admin')),
);
$urlVerifyUser = $this->createUrl("user/verify", array('id' => $model->getId()));
$urlReturn = $this->createUrl('user/view', array('id' => $model->getId()));
//$urlVerifyUser .='?returnUrl=' . $urlReturn;
$profile = $model->getUserDoctorProfile();
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
    $profileData->isContractDoctor = '';
    $profileData->preferred_patient = '';
    $verifiyUrl = '';
} else {
    $profileData->name = $profile->getName();
    $profileData->hospital_name = $profile->getHospitalName();
    $profileData->hp_dept_name = $profile->getHpDeptName();
    $profileData->clinical_title = $profile->getClinicalTitle();
    $profileData->academic_title = $profile->getAcademicTitle();
    $profileData->state_name = $profile->getStateName();
    $profileData->city_name = $profile->getCityName();
    $abtn = $profile->isVerified() ? '取消认证' : '认证';
    $verifiyUrl = '<a href="' . $urlVerifyUser . '" >' . $abtn . '</a>';
    $profileData->verified = $profile->isVerified() ? '已认证' : '未认证';
    $profileData->date_verified = $profile->getDateVerified();
    $profileData->verified_by = $profile->getVerifiedBy();
    $profileData->isContractDoctor = $profile->isContractDoctor() == true ? '是' : '否';
    $profileData->preferred_patient = $profile->getPreferredPatient();
}
$files = $model->getUserDoctorCerts();
?>

<h1>查看 #<?php echo $model->username; ?></h1>

<table class="detail-view" id="yw0">
    <tbody>
        <tr class="even"><th>ID</th><td><?php echo $model->id; ?></td></tr>
        <tr class="odd"><th>手机</th><td><?php echo $model->username; ?></td></tr>
        <tr class="even"><th>医生姓名</th><td><?php echo $profileData->name; ?></td></tr>        
        <tr class="even"><th>所属医院</th><td><?php echo $profileData->hospital_name; ?></td></tr>
        <tr class="even"><th>所属科室</th><td><?php echo $profileData->hp_dept_name; ?></td></tr>        
        <tr class="even"><th>临床职称</th><td><?php echo $profileData->clinical_title; ?></td></tr>
        <tr class="even"><th>学术职称</th><td><?php echo $profileData->academic_title; ?></td></tr>
        <tr class="even"><th>省份</th><td><?php echo $profileData->state_name; ?></td></tr>
        <tr class="even"><th>城市</th><td><?php echo $profileData->city_name; ?></td></tr>
        <tr class="even"><th>认证状态</th><td><?php echo $profileData->verified . '     ' . $verifiyUrl; ?></td></tr>
        <tr class="even"><th>注册日期</th><td><?php echo $model->getDateCreated(); ?></td></tr>
        <tr class="even"><th>是否电子签约</th><td><?php echo $profileData->isContractDoctor; ?></td></tr>
        <tr class="even"><th>期望患者类型</th><td><?php echo $profileData->preferred_patient; ?></td></tr>
    </tbody>
</table>
<div>
    <h3>证件：共 <?php echo count($files) ?>（份）</h3>      
    <?php
    if (arrayNotEmpty($files)):
        foreach ($files as $file):
            ?>
            <div>
                <?php echo CHtml::image($file->getAbsFileUrl(), '', array('class' => "img-responsive")); ?>
            </div>
            <?php
        endforeach;
    endif;
    ?>
</div>