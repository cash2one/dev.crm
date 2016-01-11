<?php
/* @var $this MedicalRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'病历列表',
);

$this->menu=array(	
	array('label'=>'管理病历', 'url'=>array('admin')),
);
?>

<h1>病历列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
