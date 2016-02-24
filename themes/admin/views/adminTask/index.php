<?php
/* @var $this AdminTaskController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Tasks',
);

$this->menu=array(
	array('label'=>'Create AdminTask', 'url'=>array('create')),
	array('label'=>'Manage AdminTask', 'url'=>array('admin')),
);
?>

<h1>Admin Tasks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
