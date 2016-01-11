<?php
/* @var $this MrbookingController */
/* @var $model MedicalRecordBooking */

$this->breadcrumbs=array(
	'Medical Record Bookings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'预约列表', 'url'=>array('index')),	
	array('label'=>'查看预约', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理预约', 'url'=>array('admin')),
);
?>

<h1>Update MedicalRecordBooking <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>