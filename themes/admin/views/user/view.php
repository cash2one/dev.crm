<?php
/* @var $this UserController */
/* @var $model User */
$urlUploadFile = $this->createUrl("user/ajaxUploadCert");
$urlAjaxDoctorCert = $this->createUrl('user/ajaxDoctorCert');
$urlAjaxLoadFiles = 'http://file.mingyizhudao.com/api/loaddrcert?userId=' . $model->getId();

$this->breadcrumbs = array(
    '用户列表' => array('admin'),
    $model->username,
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
    $verifiyUrl = '<span class="color-red">该医生未提交医生信息</span>';
} else {
    $profileData->name = $profile->getName();
    $profileData->hospital_name = $profile->getHospitalName();
    $profileData->hp_dept_name = $profile->getHpDeptName();
    $profileData->clinical_title = $profile->getClinicalTitle();
    $profileData->academic_title = $profile->getAcademicTitle();
    $profileData->state_name = $profile->getStateName();
    $profileData->city_name = $profile->getCityName();
    $abtn = $profile->isVerified() ? '取消认证' : '认证';
    $verifiyUrl = '<a class="btn btn-primary" href="' . $urlVerifyUser . '" >' . $abtn . '</a>';
    $profileData->verified = $profile->isVerified() ? '已认证' : '未认证';
    $profileData->date_verified = $profile->getDateVerified();
    $profileData->verified_by = $profile->getVerifiedBy();
    $profileData->isContractDoctor = $profile->isContractDoctor() == true ? '是' : '否';
    $profileData->preferred_patient = $profile->getPreferredPatient();
}
$files = $model->getUserDoctorCerts();
?>
<style>
    .table-info tbody th{width: 15%;}
    .table-info tbody td{width: 35%;}
    .imglist img{height: 160px;width: 100%;}
    .delete .file-panel{padding: 5px;text-align: center;background-color: #f00;color: #fff;}
</style>
<h1>查看 #<?php echo $model->id; ?></h1>

<table class="table table-info mt20" id="yw0">
    <tbody>
        <tr class="odd">
            <th>医生姓名</th><td><?php echo $profileData->name; ?></td>
            <th>手机</th><td><?php echo $model->username; ?></td>
        </tr> 
        <tr class="even">
            <th>所属医院</th><td><?php echo $profileData->hospital_name; ?></td>
            <th>所属科室</th><td><?php echo $profileData->hp_dept_name; ?></td>
        </tr> 
        <tr class="even">
            <th>临床职称</th><td><?php echo $profileData->clinical_title; ?></td>
            <th>学术职称</th><td><?php echo $profileData->academic_title; ?></td>
        </tr>
        <tr class="even">
            <th>省份</th><td><?php echo $profileData->state_name; ?></td>
            <th>城市</th><td><?php echo $profileData->city_name; ?></td>
        </tr>
        <tr class="even">
            <th>认证状态</th><td><?php echo $profileData->verified . '     ' . $verifiyUrl; ?></td>
            <th>注册日期</th><td><?php echo $model->getDateCreated(); ?></td>
        </tr>
        <tr class="even">
            <th>是否电子签约</th><td><?php echo $profileData->isContractDoctor; ?></td>
            <th>期望患者类型</th><td><?php echo $profileData->preferred_patient; ?></td>
        </tr>
    </tbody>
</table>
<div>
    <h3>证件：共 <?php echo count($files) ?>（份）</h3>
    <div class="form-wrapper">
        <form id="doctor-form" data-url-uploadfile="<?php echo $urlAjaxDoctorCert; ?>" data-url-return="<?php echo $urlReturn; ?>" method="post">
            <input id="doctorId" type="hidden" name="doctor[id]" value="<?php echo $model->id; ?>" />    
            <input type="hidden" id="domain" value="http://7xq939.com2.z0.glb.qiniucdn.com"> 
            <input type="hidden" id="uptoken_url" value="<?php echo $this->createUrl('user/ajaxToken'); ?>">
        </form>
        <div class="mb20 row">
            <div class="col-sm-12">
                <?php $this->renderPartial('_uploadFile'); ?>
            </div>
        </div>
    </div>

    <div class="row imglist">

    </div>
</div>
<script>
    $(document).ready(function () {
        $('a.delete').click(function (e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            var docImg = $(this).parents('.docImg');
            if (confirm('确定删除这种图片?')) {
                $.ajax({
                    url: deleteUrl,
                    success: function (data) {
                        if (data.status == 'ok') {
                            docImg.remove();
                            alert('删除成功!');
                        }
                    },
                    error: function () {
                        alert('删除失败!');
                    }
                });
            }
        });
        $.ajax({
            url: '<?php echo $urlAjaxLoadFiles; ?>',
            success: function (data) {
                setImgHtml(data.results);
            }
        });
    });
    function setImgHtml(results) {
        var innerHtml = '';
        var files = results.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            innerHtml += '<div class="col-sm-2 mt10 docImg"><img src="' + file.absFileUrl + '"/><div>' + file.dateCreated + '</div>' +
                    //'<a class="delete" href="<?php echo $this->createUrl('user/delectDoctorCert'); ?>?id='+file.id+'&userId=<?php echo $model->id; ?>"><div class="file-panel">删除</div></a>'+
                    '</div>';
        }
        $('.imglist').html(innerHtml);
    }
</script>