<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	'Admin Users'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AdminUser', 'url'=>array('index')),
	array('label'=>'Create AdminUser', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#admin-user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Admin Users</h1>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
//		'password',
//		'password_raw',
//		'password_salt',
		'role',	
		'fullname',
		'mobile',
		'email',
            /*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
