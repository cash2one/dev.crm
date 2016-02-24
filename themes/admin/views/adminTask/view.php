<?php
/* @var $this AdminTaskController */
/* @var $model AdminTask */

$this->breadcrumbs=array(
	'Admin Tasks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AdminTask', 'url'=>array('index')),
	array('label'=>'Create AdminTask', 'url'=>array('create')),
	array('label'=>'Update AdminTask', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdminTask', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdminTask', 'url'=>array('admin')),
);
?>

<h1>View AdminTask #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'subject',
		'content',
		'url',
		'date_created',
		'date_updated',
		'date_deleted',
	),
)); ?>
