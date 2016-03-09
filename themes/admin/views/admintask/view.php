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
$adminTasksJoin = $model->adminTaskJoins[0];
?>

<h1>任务 #<?php echo $model->id; ?></h1>
<table class="table table-info mt10" id="yw0">    
    <tbody>
        <tr><th>标题</th><td><?php echo $model->subject; ?></td><th>创建时间</th><td><?php echo $model->date_created; ?></td></tr>
        <tr><th>客服</th><td><?php echo $adminUser->username; ?></td><th>任务类型</th><td><?php echo $adminTasksJoin->getType() == null ? '未设置' : $adminTasksJoin->getType(); ?></tr>
        <tr><th>跟单方式</th><td><?php echo $adminTasksJoin->getWorkType() == null ? '未设置' : $adminTasksJoin->getWorkType(); ?></td><th>计划跟单时间</th><td><?php echo $adminTasksJoin->date_plan == null ? '未设置' : $adminTasksJoin->date_plan; ?></tr>
        <tr><th>完成情况</th><td><?php echo $adminTasksJoin->getStatus(); ?></td><th></th><td></td></tr>
        <tr><th>内容</th><td><?php echo $model->content; ?></td><th></th><td></td></tr>
        <tr><th>操作链接</th><td><a href="<?php echo $model->url; ?>">去操作</a></td><th></th><td></td></tr>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo $this->createUrl('admintask/ajaxReadTask', array('id' => $adminTasksJoin->id)); ?>'
        });
    });
</script>

