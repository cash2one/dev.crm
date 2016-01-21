<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs = array(
    '预约列表' => array('admin'),
    $model->id => array('view', 'id' => $model->id),
    '修改预约',
);

$this->menu = array(
    array('label' => '返回', 'url' => array('view', 'id' => $model->id)),
    array('label' => '搜索预约', 'url' => array('search')),
);
?>

<h1>修改预约 #<?php echo $model->ref_no; ?></h1>

<?php $this->renderPartial('//admin/booking/_form', array('model' => $model)); ?>