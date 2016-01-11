<?php
/* @var $this FacultyController */
/* @var $model FacultyHospitalJoin */
$faculty = $model->getFaculty();

$this->breadcrumbs = array(
    '科室' => array('index'),
    $faculty->name => array('view', 'id' => $faculty->id)
);

$this->menu = array(
    array('label' => 'View Faculty', 'url' => array('view', 'id' => $faculty->id)),
    array('label' => 'List Faculty', 'url' => array('index')),
);
?>

<h3><?php echo $faculty->getName(); ?> - 修改医院信息</h3>

<?php $this->renderPartial('_formHospital', array('model' => $model)); ?>