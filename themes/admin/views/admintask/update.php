<?php
/* @var $this AdminTaskController */
/* @var $model AdminTask */

$this->breadcrumbs=array(
	'Admin Tasks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdminTask', 'url'=>array('index')),
	array('label'=>'Create AdminTask', 'url'=>array('create')),
	array('label'=>'View AdminTask', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdminTask', 'url'=>array('admin')),
);
?>

<h1>Update AdminTask <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>