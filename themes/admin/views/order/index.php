<?php
/* @var $this SalesOrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sales Orders',
);

$this->menu=array(
	array('label'=>'创建订单', 'url'=>array('create')),
	array('label'=>'订单管理', 'url'=>array('admin')),
);
?>

<h1>Sales Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
