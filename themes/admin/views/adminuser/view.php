<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	'管理员'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AdminUser', 'url'=>array('index')),
	array('label'=>'Create AdminUser', 'url'=>array('create')),
	array('label'=>'Update AdminUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdminUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdminUser', 'url'=>array('admin')),
);
?>

<h1>管理员信息 #<?php echo $model->id; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
//		'password',
//		'password_raw',
//		'password_salt',
		'role',
		'fullname',
		'mobile',
		'email',
		'wechat',
		'qq',
		'state_id',
		'state_name',
		'city_id',
		'city_name',
		'is_active',
		'date_created',
		'date_updated',
		'date_deleted',
	),
)); ?>
