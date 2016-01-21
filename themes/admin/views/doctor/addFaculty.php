<?php
/* @var $this DoctorController */
/* @var $model Doctor */
/* @var $fdJoin FacultyDoctorJoin */

$this->breadcrumbs = array(
    'Doctors' => array('admin'),
    $model->getName(),
);

$this->menu = array(
    array('label' => 'View Doctor', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'List Doctor', 'url' => array('index')),
);
?>

<h4>添加科室</h4>
<h3><?php echo $model->getName(); ?></h3>

<br />

<h4>已添加的科室：</h4>
<div class="faculty-list">
    <?php
    $facultyList = $model->getFaculties();
    if (emptyArray($facultyList) === false) {
        foreach ($facultyList as $faculty) {
            echo '<div>' . $faculty->name . '</div>';
        }
    }
    ?>
</div>

<br />
<?php $this->renderPartial('_formAddFaculty', array('model' => $fdJoin)); ?>