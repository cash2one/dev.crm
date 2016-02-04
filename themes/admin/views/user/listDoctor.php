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
<div class="data-list mt10">
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>手机号码</td>
                <td>医生姓名</td>
                <td>认证状态</td>
                <td>注册日期</td>        
            </tr>
        </thead>
        <tbody>
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_viewListDoctors',
            ));
            ?>
        </tbody>
    </table>
</div>
<style>.data-list,.list-view{position:relative;}.pager{margin: 0;}</style>
