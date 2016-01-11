<?php
/* @var $this UserDoctorProfileController */
/* @var $model UserDoctorProfile */

$this->breadcrumbs=array(
	'User Doctor Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserDoctorProfile', 'url'=>array('index')),
	array('label'=>'Manage UserDoctorProfile', 'url'=>array('admin')),
);
?>

<h1>Create UserDoctorProfile</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>