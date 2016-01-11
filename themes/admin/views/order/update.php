<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */

$this->breadcrumbs=array(
	'Sales Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SalesOrder', 'url'=>array('index')),
	array('label'=>'Create SalesOrder', 'url'=>array('create')),
	array('label'=>'View SalesOrder', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SalesOrder', 'url'=>array('admin')),
);
?>

<h1>Update SalesOrder <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>