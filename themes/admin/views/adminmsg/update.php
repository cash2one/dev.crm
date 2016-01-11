<?php
/* @var $this AdminMsgController */
/* @var $model AdminMsg */

$this->breadcrumbs=array(
	'Admin Msgs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdminMsg', 'url'=>array('index')),
	array('label'=>'Create AdminMsg', 'url'=>array('create')),
	array('label'=>'View AdminMsg', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdminMsg', 'url'=>array('admin')),
);
?>

<h1>Update AdminMsg <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>