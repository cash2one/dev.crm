<?php
/* @var $this SalesOrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Sales Orders',
);

$this->menu = array(
    array('label' => '创建订单', 'url' => array('create')),
    array('label' => '订单管理', 'url' => array('admin')),
);
?>

<h1>Sales Orders</h1>
<div class="data-list mt10">
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>预约号</td>
                <td>预约号</td>
                <td>订单标题</td>
                <td>订单详情</td>
                <td>支付情况</td>
                <td>uid</td>
                <td>pingID</td>
                <td>支付来源</td>
                <td>支付金额</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
            ));
            ?>
        </tbody>
    </table>
</div>
<style>.data-list,.list-view{position:relative;}.pager{margin: 0;}</style>
