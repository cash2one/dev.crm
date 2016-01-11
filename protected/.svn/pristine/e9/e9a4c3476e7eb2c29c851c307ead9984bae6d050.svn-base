<?php
/* @var $this MedicalRecordController */
/* @var $model MedicalRecord */

$this->breadcrumbs = array(
    '病历列表' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => '病历列表', 'url' => array('index')),
    //array('label'=>'Create MedicalRecord', 'url'=>array('create')),
    array('label' => '修改病历', 'url' => array('update', 'id' => $model->id)),
    //array('label'=>'删除病历', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label' => '管理病历', 'url' => array('admin')),
);
?>

<h1>查看病历 #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array('name' => 'user_id', 'value' => CHtml::link($model->getOwnerUsername(), array('user/view', 'id' => $model->user_id), array('target' => '_blank')), 'type' => 'raw'),
        'name',
        'nric',
        array('name' => 'gender', 'value' => $model->getGender()),
        'dob',
        array('name' => 'state', 'value' => $model->getStateName()),
        array('name' => 'city', 'value' => $model->getCityName()),
        array('name' => 'occupation', 'value' => $model->getOccupation()),
        array('name' => 'patient_condition', 'value' => $model->getPatientCondition(), 'type' => 'raw'),
        array('name' => 'surgery_history', 'value' => $model->getSurgeryHistory(), 'type' => 'raw'),
        array('name' => 'drug_history', 'value' => $model->getDrugHistory(), 'type' => 'raw'),
        array('name' => 'disease_history', 'value' => $model->getDiseaseHistory(), 'type' => 'raw'),
        array('name' => 'remark', 'value' => $model->getRemark()),
        'date_created',
        'date_updated',
        'date_deleted',
    ),
));
?>

<!-- 病理报告 -->
<div class="tab-pane" id="medicalRecord">                            
    <?php $this->renderPartial('_formFile', array('model' => $model)); ?>
</div>