<?php
/* @var $this AdminTaskController */
/* @var $model AdminTask */

$this->breadcrumbs=array(
	'Admin Tasks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AdminTask', 'url'=>array('index')),
	array('label'=>'Create AdminTask', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#admin-task-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Admin Tasks</h1>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-task-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'subject',
		'content',
		'url',
		'date_created',
		'date_updated',
		/*
		'date_deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
