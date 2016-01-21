<?php
/* @var $this AdminMsgController */
/* @var $model AdminMsg */

$this->breadcrumbs=array(
	'Admin Msgs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AdminMsg', 'url'=>array('index')),
	array('label'=>'Create AdminMsg', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#admin-msg-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Admin Msgs</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-msg-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'subject',
		'content',
		'date_created',
		'date_updated',
		'date_deleted',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
