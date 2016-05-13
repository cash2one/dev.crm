<?php
/* @var $this DoctorController */
/* @var $model Doctor */

$this->breadcrumbs=array(
	'医生'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'List Doctor', 'url'=>array('index')),
	array('label'=>'Manage Doctor', 'url'=>array('admin')),
);
?>

<h1>创建医生</h1>

<?php $this->renderPartial('_formNew', array('model'=>$model)); ?>