<?php
/* @var $this DoctorController */
/* @var $model Doctor */

$this->breadcrumbs = array(
    'Doctors' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Doctor', 'url' => array('index')),
    array('label' => 'Create Doctor', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#doctor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Doctors</h1>

<?php //echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'doctor-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'fullname',
        'hospital_name',
        'hp_dept_name',
        'medical_title',
        /*'search_keywords',
          'gender',
          'expertise',
          'email',
          'password',
          'salt',
          'password_raw',
          'wechat',
          'tel',
          'display_order',
          'date_activated',
          'date_verified',
          'last_login_time',
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
