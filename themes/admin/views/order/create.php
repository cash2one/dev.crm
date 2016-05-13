<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */

$this->breadcrumbs=array(
	'订单'=>array('index'),
	'手动创建订单',
);

$this->menu=array(
	array('label'=>'订单列表', 'url'=>array('index')),
	array('label'=>'订单管理', 'url'=>array('admin')),
);
?>

<h1>手动创建订单</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>