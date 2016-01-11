<style type="text/css">
    .view .h-avatar{margin-left:1em;margin-bottom:1em;width:200px;float:right;clear:both;}
    .view .h-avatar>img{width:100%;}
</style>

<?php
/* @var $this HospitalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Hospitals',
);

$this->menu = array(
    array('label' => 'Create Hospital', 'url' => array('create')),
    array('label' => 'Manage Hospital', 'url' => array('admin')),
);
?>

<h1>Hospitals</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
