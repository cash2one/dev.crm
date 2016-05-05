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
        <div class="form-group col-sm-7">
            <label ><?php echo '预约单号<br>'; ?></label>
            <div>
                <?php echo '<div>' . $model->bk_ref_no . '</div>'; ?>             
                <div class="text-danger"><?php echo $form->error($model, 'ref_no'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7 hide">
            <label ><?php echo $form->labelEx($model, 'user_id'); ?></label>
            <div>
                <?php echo '<div>' . $model->user_id . '</div>'; ?>          
                <div class="text-danger"><?php echo $form->error($model, 'user_id'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7 hide">
            <label ><?php echo $form->labelEx($model, 'bk_id'); ?></label>
            <div>
                <?php echo '<div>' . $model->bk_id . '</div>'; ?>          
                <div class="text-danger"><?php echo $form->error($model, 'bk_id'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7 hide">
            <label ><?php echo $form->labelEx($model, 'bk_type'); ?></label>
            <div>
                <?php echo '<div>' . $model->bk_type . '</div>'; ?>          
                <div class="text-danger"><?php echo $form->error($model, 'bk_type'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo '订单金额<br>'; ?></label>
            <div>
                <?php echo $form->textField($model, 'final_amount', array('class' => 'form-control', 'name' => 'order[final_amount]', 'size' => 12, 'maxlength' => 12)); ?>元（RMB）       
                <div class="text-danger"><?php echo $form->error($model, 'final_amount'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo '订单标题<br>'; ?></label>
            <div>
                <?php echo $form->textField($model, 'subject', array('class' => 'form-control', 'name' => 'order[subject]', 'size' => 50, 'maxlength' => 100)); ?>      
                <div class="text-danger"><?php echo $form->error($model, 'subject'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label >  <?php echo '订单描述<br>'; ?></label>
            <div>
                <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'name' => 'order[description]', 'rows' => 3, 'cols' => 50, 'maxlength' => 1000)); ?>     
                <div class="text-danger"><?php echo $form->error($model, 'description'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label >  <?php echo '订单类型<br>'; ?></label>
            <div>
                <?php
                echo $form->dropDownList($model, 'order_type', $model->getOptionsOrderType(), array(
                    'name' => 'order[order_type]',
                    'class' => 'form-control w50',
                ));
                ?>
                <div class="text-danger"><?php echo $form->error($model, 'order_type'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'bd_code'); ?></label>
            <div>
                <?php echo $form->textField($model, 'bd_code', array('size' => 10, 'name' => 'order[bd_code]', 'maxlength' => 20, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'bd_code'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'cash_back'); ?></label>
            <div>
                <?php echo $form->textField($model, 'cash_back', array('size' => 10, 'name' => 'order[cash_back]', 'maxlength' => 20, 'class' => 'form-control')); ?>
                <div class="text-danger"><?php echo $form->error($model, 'cash_back'); ?></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br/><br/>
        <div class="form-group col-sm-7">
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