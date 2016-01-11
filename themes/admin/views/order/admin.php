<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */

$this->breadcrumbs=array(
	'Sales Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SalesOrder', 'url'=>array('index')),
	array('label'=>'Create SalesOrder', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sales-order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sales Orders</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'ref_no',
		'bk_ref_no',
		'crm_no',
		'subject',
                'is_paid',
                'date_created',
		/*
		'description',
		'is_paid',
		'date_open',
		'date_closed',
		'created_by',
		'total_amount',
		'discount_percent',
		'discount_amount',
		'final_amount',
		'currency',
		'date_created',
		'date_updated',
		'date_deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
