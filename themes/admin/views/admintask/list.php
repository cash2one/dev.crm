<?php
/* @var $this BookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    '任务列表',
);

$this->menu = array(
    //array('label' => '创建预约', 'url' => array('create')),
    array('label' => '搜索预约', 'url' => array('search')),
);
?>

<h1>任务列表</h1>
<div class="data-list mt10">
    <table class="table">
        <thead>
            <tr>
                <th>标题</th>
                <th>内容</th>
                <th>任务类型</th>
                <th>跟单方式</th>
                <th>阅读情况</th>
                <th>完成情况</th>
                <th>计划跟单时间</th>
                <th>跟单完成时间</th>
                <th>操作</th>
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
