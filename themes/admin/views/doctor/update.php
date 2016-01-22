<?php
/*
 * $model DoctorForm.
 */

$this->breadcrumbs = array(
    'Doctors' => array('index'),
    $model->name => array('view', 'id' => $model->id),
);

//$this->menu = array(
//    array('label' => 'View Doctor', 'url' => array('view', 'id' => $model->id)),
//    array('label' => 'List Doctor', 'url' => array('index')),
//    array('label' => 'Create Doctor', 'url' => array('create')),
//    array('label' => 'Update Doctor', 'url' => array('update', 'id' => $model->id)),
//    array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
//    array('label' => 'Manage Doctor', 'url' => array('admin')),
//);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="border-bottom">
                <h3>修改医生信息</h3>
            </div>
        </div>
        <div class="row mt20">
            <?php $this->renderPartial('_formUpdate', array('model' => $model)); ?>
        </div>
        <div class="mt30"></div>
    </div>  	
</div>