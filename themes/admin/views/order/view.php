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

<h1>View SalesOrder #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'ref_no',
//        'user_id',
//        'bk_id',
//        'bk_type',
        'subject',
        'description',
        'is_paid',
        'date_open',
        'date_closed',
        'ping_id',
//        'created_by',
//        'total_amount',
//        'discount_percent',
//        'discount_amount',
        'final_amount',
        'currency',
        'bd_code',
//        'date_created',
//        'date_updated',
//        'date_deleted',
    ),
));
?>
<br />
<?php
//$url = $this->createAbsoluteUrl('/order/view', array('refno' => $model->ref_no));
$url = 'http://mingyizhudao.com/order/view?refno='.$model->ref_no;
//var_dump($url);
echo '<h5>支付链接: </h5> ' . '<a class="color-blue" href="' . $url . '" target="_blank">' . $url . '</a>';
?>

