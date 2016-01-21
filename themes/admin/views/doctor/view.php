<?php
/* @var $this DoctorController */
/* @var $model Doctor */

$this->breadcrumbs = array(
    'Doctors' => array('admin'),
    $model->getName(),
);

$this->menu = array(
    //  array('label' => '添加关联科室', 'url' => array('createDF', 'id' => $model->id)),
    //array('label' => '添加科室', 'url' => array('addFaculty', 'id' => $model->id)),
    array('label' => '关联疾病', 'url' => array('addDisease', 'id' => $model->id)),
    array('label' => '设置头像', 'url' => array('addAvatar', 'id' => $model->id)),
    //array('label' => 'Update Doctor', 'url' => array('update', 'id' => $model->id)),
    array('label' => '医生列表', 'url' => array('index')),
    //array('label' => 'Create Doctor', 'url' => array('create')),
    //array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => '医生管理', 'url' => array('admin')),
    array('label' => '生成团队', 'url' => array('createExpertTeam', 'id' => $model->id)),
);
?>
<?php
//$urlAvatar = $model->getAbsUrlAvatar(true);
$urlAvatar = $model->base_url . $model->avatar_url;
?>
<a href="<?php echo $this->createUrl('addDisease', array('id' =>  $model->id))?>" class="btn btn-primary">关联疾病</a>
<a href="<?php echo $this->createUrl('addAvatar', array('id' =>  $model->id))?>" class="btn btn-primary">设置头像</a>
<a href="<?php echo $this->createUrl('createExpertTeam', array('id' =>  $model->id))?>" class="btn btn-primary">生成团队</a>
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
        //'fullname',
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
        array(
            'name' => 'hp_dept_id',
            'value' => CHtml::encode($model->getHpDeptName())
        ),
    /*
      'faculty',
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
     * 
     */
    ),
));
?>




<?php
//$model Hospital model.
//$listModel array of Faculty model.
//$showControl boolean.
$team = $model->getDoctorExpertTeam();
if (is_null($team) === false) {
    echo '<h3>相关团队</h3>';
    echo '<div class="view department">';
    echo '关联团队: ' . $team->getName();
    echo '</div>';
}
?>
<br />
<?php
$this->renderPartial('_viewDoctorDepartment', array('model' => $model, 'listModel' => $model->getDoctorDiseases(), 'showControl' => true));
?>

