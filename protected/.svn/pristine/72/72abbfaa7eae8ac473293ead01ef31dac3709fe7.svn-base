<?php
/* @var $this FacultyController */
/* @var $model Faculty */
/* @var $fhJoin FacultyHospitalJoin */

$this->breadcrumbs = array(
    '科室' => array('index'),
    $model->name => array('view', 'id' => $model->id)
);

$this->menu = array(
    array('label' => 'View Faculty', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'List Faculty', 'url' => array('index')),
);
?>

<h3><?php echo $model->name; ?> - 添加医院</h3>

<?php $this->renderPartial('_formHospital', array('model' => $fhJoin)); ?>