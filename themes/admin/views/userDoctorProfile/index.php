<?php
/* @var $this UserDoctorProfileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Doctor Profiles',
);

$this->menu=array(
	array('label'=>'Create UserDoctorProfile', 'url'=>array('create')),
	array('label'=>'Manage UserDoctorProfile', 'url'=>array('admin')),
);
?>

<h1>User Doctor Profiles</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
