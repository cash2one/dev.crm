<?php
/* @var $this PatientbookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'预约列表-医生端',
);

$this->menu=array(
//	array('label'=>'Create PatientBooking', 'url'=>array('create')),
	array('label'=>'搜索预约', 'url'=>array('search')),
);
?>

<h1>预约列表 - 医生端</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewList',
)); ?>
