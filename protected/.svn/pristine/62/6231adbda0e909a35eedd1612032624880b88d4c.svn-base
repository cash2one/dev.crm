<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户列表'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),			
	array('label'=>'管理用户', 'url'=>array('admin')),
);
?>

<h1>查看 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'name',
		'email',
		'qq',
		'wechat',
		'login_attempts',
		'date_activated',
		'last_login_time',
		'date_created',
		'date_updated',
		'date_deleted',
	),
)); ?>
