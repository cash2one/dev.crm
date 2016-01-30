<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    '医生用户列表',
);

$this->menu = array(
    array('label' => '管理医生用户', 'url' => array('admin')),
);
?>

<h1>医生用户列表</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_viewListDoctors',
));
?>
<style>.list-view{position:relative;}</style>
