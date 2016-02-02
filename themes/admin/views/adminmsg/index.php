<?php
/* @var $this AdminMsgController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Msgs',
);

//$this->menu=array(
//	array('label'=>'Create AdminMsg', 'url'=>array('create')),
//	array('label'=>'Manage AdminMsg', 'url'=>array('admin')),
//);
?>

<h1>Admin Msgs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<style>.list-view{position:relative;}</style>