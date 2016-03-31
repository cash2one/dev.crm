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
<div class="data-list mt10">
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>预约号</td>
                <td>患者姓名</td>
                <td>患者手机</td>
                <td>跟进状态</td>
                <td>患者所在省</td>
                <td>患者所在市</td>
                <td>患者年龄</td>
                <td>创建医生</td>
                <td>创建医生手机</td>
                <td>预约来源</td>
                <td>业务员</td>
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
