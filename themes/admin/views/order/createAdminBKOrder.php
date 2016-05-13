<?php
/* @var $this SalesTransactionController */
/* @var $model SalesTransaction */

$this->breadcrumbs=array(
	'订单'=>array('index'),
	'创建订单',
);

//$this->menu=array(
//	array('label'=>'List SalesOrder', 'url'=>array('index')),
//	array('label'=>'Manage SalesOrder', 'url'=>array('admin')),
//);
?>

<h1>创建订单</h1>

<?php $this->renderPartial('_formAdminOrder', array('model'=>$model)); ?>