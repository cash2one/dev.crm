<?php
/* @var $this SalesTransactionController */
/* @var $model SalesTransaction */
/* @var $form CActiveForm */
$returnUrl = $this->createUrl('order/view', array('id' => ''));
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sales-order-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'htmlOptions' => array('class' => "", 'role' => 'form', 'data-returnUrl' => $returnUrl, 'autocomplete' => 'off'),
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnType' => true,
            'validateOnDelay' => 500,
            'errorCssClass' => 'errorMessage',
        ),
        'enableAjaxValidation' => false,
            // 'focus' => array($model, 'password'),
    ));

    echo $form->hiddenField($model, 'bk_ref_no', array('name' => 'order[bk_ref_no]'));
    ?>


    <div class="text-danger"><?php echo $form->errorSummary($model); ?></div>
    <div class="form-horizontal">
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label ><?php echo '预约单号：'; ?></label>
            <?php echo '<span>' . $model->bk_ref_no . '</span>'; ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label > <?php echo '订单金额：'; ?></label>
            <?php echo '<span>' . $model->final_amount . '</span>'; ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label > <?php echo '订单标题：'; ?></label>
            <?php echo '<span>' . $model->subject . '</span>'; ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label >  <?php echo '订单描述：'; ?></label><?php echo '<span>' . $model->description . '</span>'; ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label >  <?php echo '订单类型：'; ?></label>
            <?php echo '<span>' . $model->getOrderType() . '</span>'; ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label >地推：</label>
            <?php echo $model->bd_code == null ? '无' : $model->bd_code; ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label >返款人：</label>
            <?php echo $model->cash_back == null ? '无' : $model->cash_back; ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label >支付渠道</label>
            <div>
                <select id="order_pay_channel" name="order[pay_channel]" class="form-control">
                    <option value="">选择</option>
                    <?php
                    $payMethod = SalesOrder::model()->getOptionsPayChannel();
                    foreach ($payMethod as $key => $value) {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                    ?>
                </select>
                <div class="text-danger"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <label >支付交易号</label>
            <div>
                <input name="order[channel_trade_no]" id="order_channel_trade_no" class="form-control"/>
                <div class="text-danger"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-2">
            <label > <?php echo $form->labelEx($model, 'date_closed'); ?></label>
            <div>
                <?php echo $form->textField($model, 'date_closed', array('name' => 'order[date_closed]', 'class' => 'form-control')); ?>
                <div class="text-danger"><?php echo $form->error($model, 'date_closed'); ?></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br/><br/>
        <div class="form-group col-lg-4 col-md-7 col-sm-12">
            <input type="button" id="btnSubmit" class="btn btn-primary" value="<?php echo $model->isNewRecord ? 'Create' : 'Save'; ?>">
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
<script>
    $(document).ready(function () {
        //日期选择
        $("#order_date_closed").datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left",
            language: "zh-CN"
        });
    });
</script>