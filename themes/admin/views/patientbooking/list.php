<?php
/* @var $this PatientbookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'预约列表-医生端',
);

$this->menu=array(
//	array('label'=>'Create PatientBooking', 'url'=>array('create')),
	array('label'=>'搜索预约', 'url'=>array('search')),
);
?>

<h1>预约列表 - 医生端</h1>
<div class="data-list mt10">
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>患者姓名</td>
                <td>患者手机</td>
                <td>预约号</td>
                <td>状态</td>
                <td>医生姓名</td>
                <td>医生手机</td>
                <td>疾病诊断</td>
                <td style="width:30%;">疾病描述</td>
                <td>创建日期</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_viewList',
            ));
            ?>
        </tbody>
    </table>
</div>
<style>.data-list,.list-view{position:relative;}.pager{margin: 0;}</style>
