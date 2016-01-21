<?php
/* @var $this DoctorController */
/* @var $model Doctor */

$this->breadcrumbs=array(
	'Doctors'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Doctor', 'url'=>array('index')),
	array('label'=>'Manage Doctor', 'url'=>array('admin')),
);
?>

<h1>Create Doctor</h1>

<?php $this->renderPartial('_formNew', array('model'=>$model)); ?>