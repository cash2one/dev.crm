<?php
/* @var $this AdminMsgController */
/* @var $model AdminMsg */

$this->breadcrumbs=array(
	'Admin Msgs'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AdminMsg', 'url'=>array('index')),
	array('label'=>'Create AdminMsg', 'url'=>array('create')),
	array('label'=>'Update AdminMsg', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdminMsg', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdminMsg', 'url'=>array('admin')),
);
?>

<h1>View AdminMsg #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'subject',
		'content',
		'date_created',
		'date_updated',
		'date_deleted',
	),
)); ?>
