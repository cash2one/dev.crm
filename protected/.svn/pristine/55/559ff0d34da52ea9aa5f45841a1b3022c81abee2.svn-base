<?php
/* @var $this MrbookingController */
/* @var $model MedicalRecordBooking */

$this->breadcrumbs=array(
	'Medical Record Bookings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MedicalRecordBooking', 'url'=>array('index')),
	array('label'=>'Create MedicalRecordBooking', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#medical-record-booking-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Medical Record Bookings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'medical-record-booking-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'ref_no',
		'user_id',
		'mr_id',
		'faculty_id',
		'mobile',
		/*
		'status',
		'appt_date',
		'buffer_days',
		'patient_intention',
		'email',
		'wechat',
		'date_created',
		'date_updated',
		'date_deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
