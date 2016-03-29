<?php
/* @var $this DoctorController */
/* @var $model Doctor */

$this->breadcrumbs = array(
    'Doctors' => array('admin'),
    $model->getName(),
);

$this->menu = array(
    //  array('label' => '添加关联科室', 'url' => array('createDF', 'id' => $model->id)),
    //array('label' => '添加科室', 'url' => array('addFaculty', 'id' => $model->id)),
    array('label' => '关联疾病', 'url' => array('addDisease', 'id' => $model->id)),
    array('label' => '设置头像', 'url' => array('addAvatar', 'id' => $model->id)),
    //array('label' => 'Update Doctor', 'url' => array('update', 'id' => $model->id)),
    array('label' => '医生列表', 'url' => array('index')),
    //array('label' => 'Create Doctor', 'url' => array('create')),
    //array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => '医生管理', 'url' => array('admin')),
    array('label' => '生成团队', 'url' => array('createExpertTeam', 'id' => $model->id)),
);
?>
<?php
//$urlAvatar = $model->getAbsUrlAvatar(true);
$urlAvatar = $model->base_url . $model->avatar_url;
?>
<a href="<?php echo $this->createUrl('update', array('id' => $model->id)) ?>" class="btn btn-primary">修改信息</a>
<a href="<?php echo $this->createUrl('addDisease', array('id' => $model->id)) ?>" class="btn btn-primary">关联疾病</a>
<a href="<?php echo $this->createUrl('addAvatar', array('id' => $model->id)) ?>" class="btn btn-primary">设置头像</a>
<h1><?php echo $model->getName(); ?></h1>
<div>
    <img src="<?php echo $urlAvatar; ?>"/>
</div>
<table class="table mt10" id="yw0">
    <tbody>
        <tr class="odd"><th class="tab-title">ID</th><td><?php echo $model->id; ?></td></tr>
        <tr class="even"><th class="tab-title">姓名（展示）</th><td><?php echo $model->name; ?></td></tr>
        <tr class="odd"><th class="tab-title">临床职称</th><td><?php echo $model->getMedicalTitle(); ?></td></tr>
        <tr class="even"><th class="tab-title">学术职称</th><td><?php echo $model->getAcademicTitle(); ?></td></tr>
        <tr class="odd"><th class="tab-title">所属医院</th><td><?php echo $model->getHospitalName(); ?></td></tr>
        <tr class="even"><th class="tab-title">所属科室</th><td><?php echo $model->getHpDeptName(); ?></td></tr>
        <tr class="odd"><th class="tab-title">擅长</th><td><?php echo !is_null($model->description) ? $model->description : '未填写'; ?></td></tr>
        <tr class="even"><th class="tab-title">执业经历</th><td><?php echo !is_null($model->career_exp) ? $model->career_exp : '未填写'; ?></td></tr>
        <tr class="odd"><th class="tab-title">荣誉</th><td><?php echo !is_null($model->getHonourList()) ? $model->getHonourList() : '未填写'; ?></td></tr>
        <tr class="even"><th class="tab-title">推荐理由1</th><td><?php echo !is_null($model->reason_one) ? $model->reason_one : '未填写'; ?></td></tr>
        <tr class="even"><th class="tab-title">推荐理由2</th><td><?php echo !is_null($model->reason_two) ? $model->reason_two : '未填写'; ?></td></tr>
        <tr class="even"><th class="tab-title">推荐理由3</th><td><?php echo !is_null($model->reason_three) ? $model->reason_three : '未填写'; ?></td></tr>
        <tr class="even"><th class="tab-title">推荐理由4</th><td><?php echo !is_null($model->reason_four) ? $model->reason_four : '未填写'; ?></td></tr>
    </tbody>
</table>
<?php
$this->renderPartial('_viewDoctorDepartment', array('model' => $model, 'listModel' => $model->getDoctorDiseases(), 'showControl' => true));
?>
<script>
    $(document).ready(function () {
        $('.updateContracted').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                success: function (data) {
                    if (data.status == 'ok') {
                        alert('修改成功');
                        var is_contracted = data.is_contracted == 1 ? '改为未签约' : '改为已签约';
                        $('.updateContracted').text(is_contracted);
                    }
                }
            });
        });
    });
</script>
