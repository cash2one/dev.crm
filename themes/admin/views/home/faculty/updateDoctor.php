<?php
/* @var $this FacultyController */
/* @var $model FacultyDoctorJoin */
$faculty = $model->getFaculty();
$doctor = $model->getDoctor();

$this->breadcrumbs = array(
    '科室' => array('index'),
    $faculty->name => array('view', 'id' => $faculty->id)
);

$this->menu = array(
    array('label' => 'View Faculty', 'url' => array('view', 'id' => $faculty->id)),
    array('label' => 'List Faculty', 'url' => array('index')),
);
?>

<h3><?php echo $doctor->name; ?> - 添加医生</h3>

<?php $this->renderPartial('_formDoctor', array('model' => $model)); ?>