<?php
/* @var $this HospitalController */
/* @var $model HospitalForm */

$this->breadcrumbs=array(
	'Hospitals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hospital', 'url'=>array('index')),
	array('label'=>'Manage Hospital', 'url'=>array('admin')),
);

?>

<h1>Create Hospital</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>