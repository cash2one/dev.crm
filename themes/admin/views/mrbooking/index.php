<?php
/* @var $this MrbookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'预约列表',
);

$this->menu=array(	
	array('label'=>'管理预约', 'url'=>array('admin')),
);
?>

<h1>预约列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
