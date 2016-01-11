<?php
/* @var $this UserDoctorProfileController */
/* @var $model UserDoctorProfile */

$this->breadcrumbs=array(
	'User Doctor Profiles'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List UserDoctorProfile', 'url'=>array('index')),
	array('label'=>'Create UserDoctorProfile', 'url'=>array('create')),
	array('label'=>'Update UserDoctorProfile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserDoctorProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserDoctorProfile', 'url'=>array('admin')),
);
?>

<h1>View UserDoctorProfile #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'name',
		'mobile',
		'gender',
		'hospital_id',
		'hospital_name',
		'hp_dept_id',
		'hp_dept_name',
		'clinical_title',
		'academic_title',
		'country_id',
		'state_id',
		'state_name',
		'city_id',
		'city_name',
		'date_verified',
		'verified_by',
		'date_contracted',
		'date_deleted',
		'date_created',
		'date_updated',
	),
)); ?>
