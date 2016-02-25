<?php
/* @var $this AdminTaskController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Tasks',
);

$this->menu=array(
	array('label'=>'Create AdminTask', 'url'=>array('create')),
	array('label'=>'Manage AdminTask', 'url'=>array('admin')),
);
?>

<h1>Admin Tasks</h1>
<style>
    .data-list, .list-view {position: relative;}
    .pager {margin: 0;}
</style>
<div class="data-list mt10">
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>标题</td>
                <td>内容</td>
                <td>操作链接</td>
                <td>创建时间</td>
                <td>修改时间</td>
                <td>删除时间</td>
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
<style>.list-view{position:relative;}</style>
