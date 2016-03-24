<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */

$this->breadcrumbs = array(
    'Sales Orders' => array('admin'),
    $model->id,
);

$this->menu = array(
//	array('label'=>'List SalesOrder', 'url'=>array('index')),
//	array('label'=>'Create SalesOrder', 'url'=>array('create')),
//	array('label'=>'Update SalesOrder', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete SalesOrder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage SalesOrder', 'url'=>array('admin')),
);
?>

<h1>订单详情 #<?php echo $model->id; ?></h1>
<table class="table table-info mt10" id="yw0">    
    <tbody>
        <tr><th>ID</th><td><?php echo $model->id; ?></td><th>订单号</th><td><?php echo $model->ref_no; ?></td></tr>
        <tr><th>订单标题</th><td><?php echo $model->subject; ?></td><th>订单详情</th><td><?php echo $model->description; ?></a></td></tr>
        <tr><th>支付情况</th><td><?php echo $model->is_paid; ?></td><th>订单创建时间</th><td><?php echo $model->date_open; ?></td></tr>
        <tr><th>订单关闭时间</th><td><?php echo $model->date_closed == null ? '未设置' : $model->date_closed; ?></td><th>ping++付款ID</th><td><?php echo $model->ping_id == null ? '未设置' : $model->ping_id; ?></td></tr>
        <tr><th>金额</th><td><?php echo $model->final_amount; ?></td><th>货币</th><td><?php echo $model->currency; ?></td></tr>
        <tr><th>地推</th><td><?php echo $model->bd_code == null ? '未设置' : $model->bd_code; ?></td><th>返款人</th><td><?php echo $model->cash_back == null ? '未设置' : $model->cash_back; ?></td></tr>
    </tbody>
</table>

<br />
<?php
//$url = $this->createAbsoluteUrl('/order/view', array('refno' => $model->ref_no));
$url = 'http://mingyizhudao.com/order/view?refno=' . $model->ref_no;
//var_dump($url);
echo '<h5>支付链接: </h5> ' . '<a class="color-blue" href="' . $url . '" target="_blank">' . $url . '</a>';
?>

