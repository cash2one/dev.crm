<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */

$this->breadcrumbs = array(
    '短信' => array('admin'),
    $model->id,
);

$this->menu = array(
);
$adminUserSmsJoin = $model->adminUserSmsJoin;
?>

<h1>短信详情 #<?php echo $model->id; ?></h1>
<table class="table table-info mt10" id="yw0">    
    <tbody>
        <tr><th>ID</th><td><?php echo $model->id; ?></td><th>手机号</th><td><?php echo $model->mobile; ?></td></tr>
        <tr><th>短信内容</th><td><?php echo $model->content; ?></td><th>是否成功</th><td><?php echo $model->is_success == 1 ? '是' : '否'; ?></a></td></tr>
        <tr><th>发送客服</th><td><?php echo $adminUserSmsJoin->admin_user_name; ?></td><th></th><td></td></tr>
        <tr><th>发送时间</th><td><?php echo $model->date_created; ?></td><th></th><td></td></tr>
    </tbody>
</table>

<br/>

