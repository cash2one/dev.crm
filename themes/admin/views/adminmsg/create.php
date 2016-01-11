<?php
/* @var $this AdminMsgController */
/* @var $model AdminMsg */

$this->breadcrumbs=array(
	'Admin Msgs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdminMsg', 'url'=>array('index')),
	array('label'=>'Manage AdminMsg', 'url'=>array('admin')),
);
?>

<h1>Create AdminMsg</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>