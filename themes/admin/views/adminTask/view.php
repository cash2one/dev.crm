<?php
/* @var $this AdminTaskController */
/* @var $model AdminTask */

$this->breadcrumbs = array(
    'Admin Tasks' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List AdminTask', 'url' => array('index')),
    array('label' => 'Create AdminTask', 'url' => array('create')),
    array('label' => 'Update AdminTask', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete AdminTask', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage AdminTask', 'url' => array('admin')),
);
?>

<h1>View AdminTask #<?php echo $model->id; ?></h1>
<table class="table table-info mt10" id="yw0">    
    <tbody>
        <tr><th>ID</th><td><?php echo $model->id; ?></td><th>标题</th><td><?php echo $model->subject; ?></td></tr>
        <tr><th>内容</th><td><?php echo $model->content; ?></td><th>操作链接</th><td><?php echo $model->url; ?></td></tr>
        <tr><th>创建时间</th><td><?php echo $model->date_created; ?></td><th>修改时间</th><td><?php echo $model->date_updated; ?></td></tr>
        <tr><th>删除时间</th><td><?php echo $model->date_deleted; ?></td><th></th><td></td></tr>
    </tbody>
</table>

