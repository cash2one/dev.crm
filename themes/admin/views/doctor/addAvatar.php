<?php
/* @var $this DoctorController */
/* @var $doctor Doctor */
/* @var $model DoctorAvatar */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Doctors' => array('index'),
    $doctor->getName() => array('view', 'id' => $doctor->getId()),
);

$this->menu = array(
//    array('label' => '查看', 'url' => array('view', 'id' => $doctor->id)),
//    array('label' => 'List Doctor', 'url' => array('index')),
//    array('label' => 'Create Doctor', 'url' => array('create')),
//    array('label' => 'Update Doctor', 'url' => array('update', 'id' => $doctor->id)),
//    array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $doctor->id), 'confirm' => 'Are you sure you want to delete this item?')),
//    array('label' => 'Manage Doctor', 'url' => array('admin')),
);
?>
<h2>设置头像</h2>
<h3><?php echo $doctor->getName(); ?></h3>
<div>
    <?php
    if (strIsEmpty($doctor->avatar_url) == false) {
        echo CHtml::Image($doctor->getAbsUrlAvatar(false), $doctor->getName(), array('title' => $doctor->getName()));
    }
    ?>
</div>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'doctor-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => false,
        ),
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <input type="hidden" name="DoctorAvatar['id']" value = "<?php echo $doctor->getId(); ?>">;

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <input type="file" name="file"/>

    <?php echo $form->errorSummary($doctor); ?>
    <br/>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->