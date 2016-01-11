<?php
/* @var $this FacultyController */
/* @var $model Faculty */

$this->breadcrumbs=array(
	'科室'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Faculty', 'url'=>array('index')),
	array('label'=>'Create Faculty', 'url'=>array('create')),
	array('label'=>'View Faculty', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Faculty', 'url'=>array('admin')),
);
?>

<h1>科室 - <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>