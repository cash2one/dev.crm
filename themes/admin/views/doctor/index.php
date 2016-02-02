<style type="text/css">
    .view .dr-avatar{margin-left:1em;margin-bottom:1em;width:100px;float:right;clear:both;}
    .view .dr-avatar>img{width:100%;}
</style>

<?php
/* @var $this DoctorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Doctors',
);

$this->menu = array(
    array('label' => 'Create Doctor', 'url' => array('createDoctor')),
    array('label' => 'Manage Doctor', 'url' => array('admin')),
);
?>

<h1>Doctors</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
<style>.list-view{position:relative;}</style>
