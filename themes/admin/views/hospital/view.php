<?php
/* @var $this HospitalController */
/* @var $model Hospital */

$this->breadcrumbs = array(
    'Hospitals' => array('admin'),
    $model->name,
);

$this->menu = array(
    array('label' => '添加科室', 'url' => array('addDepartment', 'id' => $model->id)),
    array('label' => 'List Hospital', 'url' => array('index')),
    array('label' => 'Create Hospital', 'url' => array('create')),
    array('label' => 'Update Hospital', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Hospital', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Hospital', 'url' => array('admin')),
);
?>
<style>
    .table .tab-title{width: 10%;}
</style>
<a href="<?php echo $this->createUrl('addDepartment', array('id' => $model->id)) ?>" class="btn btn-primary">添加科室</a>

<h1><?php echo $model->name; ?></h1>
<div class="row">
    <div class="col-lg-4 col-md-8 col-sm-12"><?php echo CHtml::Image($model->getAbsUrlAvatar(false), $model->name, array('title' => $model->name)); ?></div>
</div>
<br />
<table class="table mt10" id="yw0">
    <tbody>
        <tr class="odd"><th class="tab-title">ID</th><td><?php echo $model->id; ?></td></tr>
        <tr class="even"><th class="tab-title">医院全称</th><td><?php echo $model->name; ?></td></tr>
        <tr class="odd"><th class="tab-title">医院简称</th><td><?php echo $model->short_name; ?></td></tr>
        <tr class="even"><th class="tab-title">医院等级</th><td><?php echo $model->getClass(); ?></td></tr>
        <tr class="odd"><th class="tab-title">医院类型</th><td><?php echo $model->getType(); ?></td></tr>
        <tr class="even"><th class="tab-title">医院描述</th><td><?php echo $model->description; ?></td></tr>
        <tr class="odd"><th class="tab-title">医院城市</th><td><?php echo $model->getCityName(); ?></td></tr>
        <tr class="even"><th class="tab-title">医院电话</th><td><?php echo $model->phone; ?></td></tr>
        <tr class="odd"><th class="tab-title">医院地址</th><td><?php echo $model->address; ?></td></tr>
        <tr class="even"><th class="tab-title">医院网址</th><td><?php echo $model->website; ?></td></tr>
    </tbody>
</table>

<br />

<?php
$this->renderPartial('_viewHospitalDepartment', array('model' => $model, 'listModel' => $model->getDepartments(), 'showControl' => true));
?>
