<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datetimepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datetimepicker.zh-CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/createOfflinOrder.js', CClientScript::POS_END);
/* @var $this SalesTransactionController */
/* @var $model SalesTransaction */

$this->breadcrumbs = array(
    '订单' => array('index'),
    '创建订单',
);

//$this->menu=array(
//	array('label'=>'List SalesOrder', 'url'=>array('index')),
//	array('label'=>'Manage SalesOrder', 'url'=>array('admin')),
//);
?>

<h1>创建线下支付订单记录</h1>

<?php $this->renderPartial('_formOfflineOrder', array('model' => $model)); ?>