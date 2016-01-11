<?php
/* @var $this MrbookingController */
/* @var $model MedicalRecordBooking */
/* @var $mrbRemark MrBookingRemark */

$this->breadcrumbs = array(
    '预约列表' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => '预约列表', 'url' => array('index')),
    array('label' => '修改预约', 'url' => array('update', 'id' => $model->id)),
    array('label' => '管理预约', 'url' => array('admin')),
);
?>

<h1>查看预约 #<?php echo $model->ref_no; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'ref_no',
        array('name' => 'appt_date', 'value' => $model->getApptDate() . '    （' . $model->getBufferDays() . '）'),
        array('name' => 'faculty_id', 'value' => $model->getFacultyName()),
        array('name' => 'patient_intention', 'value' => $model->getPatientIntention(), 'type' => 'raw'),
        'status',
        array('name' => 'user_id', 'value' => CHtml::link($model->getOwnerUsername(), array('user/view', 'id' => $model->user_id), array('target' => '_blank')), 'type' => 'raw'),
        array('name' => 'mr_id', 'value' => CHtml::link('查看病历', array('medicalrecord/view', 'id' => $model->mr_id), array('target' => '_blank')), 'type' => 'raw'),
        'mobile',
        'email',
        'wechat',
        'date_created',
        'date_updated',
        'date_deleted',
    ),
));
?>
<h2>备注：</h2>
<?php $this->renderPartial('_formRemark', array('model'=>$mrbRemark));?>