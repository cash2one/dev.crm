<?php
/* @var $this DoctorController */
/* @var $model Doctor */

$this->breadcrumbs = array(
    'Doctors' => array('index'),
    $model->getName(),
);

$this->menu = array(
    //  array('label' => '添加关联科室', 'url' => array('createDF', 'id' => $model->id)),
    array('label' => '添加头像', 'url' => array('addAvatar', 'id' => $model->id)),
    array('label' => '添加科室', 'url' => array('addFaculty', 'id' => $model->id)),
    array('label' => 'Update Doctor', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'List Doctor', 'url' => array('index')),
    array('label' => 'Create Doctor', 'url' => array('create')),
    array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Doctor', 'url' => array('admin')),
);
?>
<?php
$urlAvatar = $model->getAbsUrlAvatar(true);
?>
<h1><?php echo $model->getName(); ?></h1>
<div>
    <img src="<?php echo $urlAvatar; ?>"/>
</div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'fullname',
        array(
            'name' => 'medical_title',
            'value' => CHtml::encode($model->getMedicalTitle())
        ),
        array(
            'name' => 'academic_title',
            'value' => CHtml::encode($model->getAcademicTitle())
        ),
        array(
            'name' => 'hospital_id',
            'value' => CHtml::encode($model->getHospitalName())
        ),
        'faculty',
        /*
        array(
            'name' => 'disease_specialty',
            'type' => 'ntext',
            'value' => CHtml::encode($model->disease_specialty)
        ),
        array(
            'name' => 'surgery_specialty',
            'type' => 'ntext',
            'value' => CHtml::encode($model->surgery_specialty)
        ),
        */
        array(
            'name' => 'description',
            'type' => 'ntext',
            'value' => CHtml::encode($model->description)
        ),
        array(
            'name' => 'search_keywords',
            'type' => 'ntext',
            'value' => CHtml::encode($model->search_keywords)
        ),
        'mobile',
        'tel',
        'wechat',
        'email',
        array(
            'name' => 'Image Url',
            'value' => $model->getAbsUrlAvatar(false)
        ),
        array(
            'name' => 'Thumbnail Url',
            'value' => $model->getAbsUrlAvatar()
        )
    ),
));
?>
<br />

<?php
$this->renderPartial('_viewDoctorFaculty', array('model' => $model, 'listModel' => $model->getFaculties(), 'showControl' => true));
?>
