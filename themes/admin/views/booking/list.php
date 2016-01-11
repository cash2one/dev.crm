<?php
/* @var $this BookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    '预约列表',
);

$this->menu = array(
    //array('label' => '创建预约', 'url' => array('create')),
    array('label' => '搜索预约', 'url' => array('search')),
);
?>

<h1>预约列表</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_viewList',
));
?>
