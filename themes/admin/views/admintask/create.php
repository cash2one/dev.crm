<?php
/* @var $this AdminTaskController */
/* @var $model AdminTask */

$this->breadcrumbs=array(
	'Admin Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdminTask', 'url'=>array('index')),
	array('label'=>'Manage AdminTask', 'url'=>array('admin')),
);
?>

<h1>Create AdminTask</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>