<?php
/* @var $this UserDoctorProfileController */
/* @var $model UserDoctorProfile */

$this->breadcrumbs=array(
	'User Doctor Profiles'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserDoctorProfile', 'url'=>array('index')),
	array('label'=>'Create UserDoctorProfile', 'url'=>array('create')),
	array('label'=>'View UserDoctorProfile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserDoctorProfile', 'url'=>array('admin')),
);
?>

<h1>Update UserDoctorProfile <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>