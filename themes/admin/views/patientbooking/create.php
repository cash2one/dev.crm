<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */

$this->breadcrumbs=array(
	'Patient Bookings'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PatientBooking', 'url'=>array('list')),
	array('label'=>'Manage PatientBooking', 'url'=>array('admin')),
);
?>

<h1>Create PatientBooking</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>