<?php
/* @var $this PatientbookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Patient Bookings',
);

$this->menu=array(
	array('label'=>'Create PatientBooking', 'url'=>array('create')),
	array('label'=>'Manage PatientBooking', 'url'=>array('admin')),
);
?>

<h1>Patient Bookings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
