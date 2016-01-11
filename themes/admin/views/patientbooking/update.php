<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */

$this->breadcrumbs=array(
	'Patient Bookings'=>array('list'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PatientBooking', 'url'=>array('list')),
	array('label'=>'Create PatientBooking', 'url'=>array('create')),
	array('label'=>'View PatientBooking', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PatientBooking', 'url'=>array('admin')),
);
?>

<h1>Update PatientBooking <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>