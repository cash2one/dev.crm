<?php
/* @var $this HospitalController */
/* @var $model Hospital */

$this->breadcrumbs = array(
    'Hospitals' => array('admin'),
    $model->name,
);

$this->menu = array(
    array('label' => '添加科室', 'url' => array('addDepartment', 'id' => $model->id)),
    array('label' => 'List Hospital', 'url' => array('index')),
    array('label' => 'Create Hospital', 'url' => array('create')),
    array('label' => 'Update Hospital', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Hospital', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Hospital', 'url' => array('admin')),
);
?>
<a href="<?php echo $this->createUrl('addDepartment', array('id' =>  $model->id))?>" class="btn btn-primary">添加科室</a>

<h1><?php echo $model->name; ?></h1>
<div><?php echo CHtml::Image($model->getAbsUrlAvatar(false), $model->name, array('title' => $model->name)); ?></div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'short_name',
        array(
            'name' => '医院等级',
            'value' => CHtml::encode($model->getClass())
        ),
        array(
            'name' => '医院类型',
            'value' => CHtml::encode($model->getType())
        ),
        array(
            'name' => 'description',
            'type' => 'ntext',
            'value' => CHtml::encode($model->description)
        ),
        array(
            'name' => 'city_id',
            'value' => CHtml::encode($model->getCityName())
        ),
        'search_keywords',
        'phone',
        array(
            'name' => 'address',
            'type' => 'ntext',
            'value' => CHtml::encode($model->address)
        ),
        'website',
        'thumbnail_url',
        'image_url',
    ),
));
?>
<br />

<?php
$this->renderPartial('_viewHospitalDepartment', array('model' => $model, 'listModel' => $model->getDepartments(), 'showControl' => true));
?>
