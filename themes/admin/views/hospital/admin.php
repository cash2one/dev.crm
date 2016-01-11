<?php
/* @var $this HospitalController */
/* @var $model Hospital */

$this->breadcrumbs = array(
    'Hospitals' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Hospital', 'url' => array('index')),
    array('label' => 'Create Hospital', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#hospital-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Hospitals</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'hospital-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'search_keywords',
        'city_id',
        /*

          'address',
          'phone',
          'description',
          'website',
          'date_created',
          'date_updated',
          'date_deleted',
         */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
