<?php
/* @var $this HospitalController */
/* @var $model Hospital */
/* @var $fhJoin FacultyHospitalJoin */

$this->breadcrumbs = array(
    'Hospitals' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'View Hospital', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'List Hospital', 'url' => array('index')),
);
?>

<h4>添加科室</h4>
<h3><?php echo $model->name; ?></h3>

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
<?php $this->renderPartial('_formAddFaculty', array('model' => $fhJoin)); ?>