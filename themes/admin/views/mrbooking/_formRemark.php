<?php
/**
 * $model MrBookingRemark.
 */
?>
<div class="form">
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mr-booking-form',
    //'action' => $this->createUrl('mrbooking/create'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'htmlOptions' => array('class' => "form-horizontal", 'role' => 'form', 'autocomplete' => 'off'),
    'enableAjaxValidation' => false,
        ));
echo $form->hiddenField($model, 'booking_id');

$remarks = $model->getRemarks();
foreach ($remarks as $attr => $remark) {
    ?>
    <div class="form-group">        
        <div class="">            
            <?php echo $form->textarea($model, $attr, array('class' => 'form-control', 'rows' => 3, 'maxlength' => 200, 'placeholder' => '上限200个字')); ?>
            <?php echo $form->error($model, $attr); ?>
        </div>
        <div class="clearfix"></div>
    </div>
<?php } ?>


<div class="form-group mt30">
    <div class="col-sm-3 pull-right">
        <button type="submit" class="btn btn-success btn-block" name="yt1"><i class="fa fa-save"></i>&nbsp;提交备注</button>            
    </div>
</div>

<?php $this->endWidget(); ?>
</div>