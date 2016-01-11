<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('yiiactiveform');
?>
<?php
/* @var $this FacultyController */
/* @var $model Faculty */

$this->breadcrumbs = array(
    '科室' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => '添加医院', 'url' => array('addHospital', 'id' => $model->id)),
    array('label' => '添加医生', 'url' => array('addDoctor', 'id' => $model->id)),
    array('label' => 'List Faculty', 'url' => array('index')),
    array('label' => 'Create Faculty', 'url' => array('create')),
    array('label' => 'Update Faculty', 'url' => array('update', 'id' => $model->id)),
    // array('label' => 'Delete Faculty', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Faculty', 'url' => array('admin')),
);
?>

<h1>科室 - <?php echo $model->name; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'code',
        'name',
        'disease_list',
        array(
            'name' => 'description',
            'type' => 'ntext',
            'value' => CHtml::encode($model->description)
        ),
        array('name' => 'is_active', 'value' => $model->isActive()),
        'display_order',
    ),
));
?>
<br />
<div class="light">医院跟医生展示在网站上的顺序是由上至下。展示数量由网站控制。</div>
<br />
<h4>已添加的医院（共<?php echo count($model->getHospitals()); ?>个）：</h4>
<div class="doctor-list">
    <?php
    $this->renderPartial('_viewFacultyHospital', array('model' => $model, 'listHospital' => $model->getHospitals(), 'showControl' => true));
    ?>
</div>

<br />

<h4>已添加的医生（共<?php echo count($model->getDoctors()); ?>个）：</h4>
<div class="doctor-list">
    <?php
    $this->renderPartial('_viewFacultyDoctor', array('model' => $model, 'listDoctor' => $model->getDoctors(), 'showControl' => true));
    ?>
</div>

