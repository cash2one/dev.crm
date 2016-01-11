<?php
/* @var $this DoctorController */
/* @var $model Doctor */


$this->breadcrumbs = array(
    'Doctors' => array('index'),
    $model->getName(),
);

$this->menu = array(
    //  array('label' => '添加关联科室', 'url' => array('createDF', 'id' => $model->id)),
    //array('label' => '添加科室', 'url' => array('addFaculty', 'id' => $model->id)),
    array('label' => '关联疾病', 'url' => array('addDisease', 'id' => $model->id)),
    array('label' => '添加头像', 'url' => array('addAvatar', 'id' => $model->id)),
    //array('label' => 'Update Doctor', 'url' => array('update', 'id' => $model->id)),
    array('label' => '医生列表', 'url' => array('index')),
    //array('label' => 'Create Doctor', 'url' => array('create')),
    //array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => '医生管理', 'url' => array('admin')),
    array('label' => '生成团队', 'url' => array('createExpertTeam', 'id' => $model->id)),
);
?>

<h1>Create ExpertTeam</h1>

<?php $this->renderPartial('_formTeam', array('model' => $model, 'teamForm' => $teamForm)); ?>