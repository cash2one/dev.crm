<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sales-order-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="text-danger"><?php echo $form->errorSummary($model); ?></div>
    <div class="form-horizontal">
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'bk_ref_no'); ?></label>
            <div>
                <?php echo $form->textField($model, 'bk_ref_no', array('size' => 16, 'maxlength' => 20, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'bk_ref_no'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'crm_no'); ?></label>
            <div>
                <?php echo $form->textField($model, 'crm_no', array('size' => 16, 'maxlength' => 50, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'crm_no'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'subject'); ?></label>
            <div>
                <?php echo $form->textField($model, 'subject', array('size' => 50, 'maxlength' => 100, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'subject'); ?></div>
            </div>
        </div>

        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'description'); ?></label>
            <div>
                <?php echo $form->textarea($model, 'description', array('rows' => 15, 'maxlength' => 1000, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'description'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'final_amount'); ?></label>
            <div>
                <?php echo $form->textField($model, 'final_amount', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'final_amount'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'bd_code'); ?></label>
            <div>
                <?php echo $form->textField($model, 'bd_code', array('size' => 10, 'maxlength' => 20, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'bd_code'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label > <?php echo $form->labelEx($model, 'cash_back'); ?></label>
            <div>
                <?php echo $form->textField($model, 'cash_back', array('size' => 10, 'maxlength' => 20, 'class' => 'form-control')); ?>                
                <div class="text-danger"><?php echo $form->error($model, 'cash_back'); ?></div>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <input type="submit" class="btn btn-primary" value="<?php echo $model->isNewRecord ? '创建订单' : 'Save' ?>" />
        </div>


        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->