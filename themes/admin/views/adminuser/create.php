<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	'管理员'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'List AdminUser', 'url'=>array('index')),
	array('label'=>'Manage AdminUser', 'url'=>array('admin')),
);
?>

<h1>创建管理员</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>