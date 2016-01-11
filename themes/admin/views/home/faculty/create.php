<?php
/* @var $this FacultyController */
/* @var $model Faculty */

$this->breadcrumbs=array(
	'科室'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Faculty', 'url'=>array('index')),
	array('label'=>'Manage Faculty', 'url'=>array('admin')),
);
?>

<h1>Create Faculty</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>