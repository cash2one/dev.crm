<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);?>
<div class="form row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
 <div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'id'); ?></label>
        <div>
<?php echo $form->textField($model, 'id', array('class' => 'form-control')); ?>
        </div>
    </div>
 <div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'username'); ?></label>
        <div>
<?php echo $form->textField($model, 'username', array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
        </div>
    </div>
 <div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'role'); ?></label>
        <div>
<?php echo $form->textField($model, 'role', array('class' => 'form-control','size'=>20,'maxlength'=>20)); ?>
        </div>
    </div>
 <div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'fullname'); ?></label>
        <div>
<?php echo $form->textField($model, 'fullname', array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
        </div>
    </div>
 <div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'mobile'); ?></label>
        <div>
<?php echo $form->textField($model, 'mobile', array('class' => 'form-control','size'=>11,'maxlength'=>11)); ?>
        </div>
    </div>
 <div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'email'); ?></label>
        <div>
<?php echo $form->textField($model, 'email', array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'wechat'); ?></label>
        <div>
<?php echo $form->textField($model, 'wechat', array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
        </div>
    </div>	
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'qq'); ?></label>
        <div>
<?php echo $form->textField($model, 'qq', array('class' => 'form-control','size'=>50,'maxlength'=>50)); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'state_id'); ?></label>
        <div>
<?php echo $form->textField($model, 'state_id', array('class' => 'form-control')); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'state_name'); ?></label>
        <div>
<?php echo $form->textField($model, 'state_name', array('class' => 'form-control','size'=>10,'maxlength'=>10)); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'city_id'); ?></label>
        <div>
<?php echo $form->textField($model, 'city_id', array('class' => 'form-control')); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'city_name'); ?></label>
        <div>
<?php echo $form->textField($model, 'city_name', array('class' => 'form-control','size'=>10,'maxlength'=>10)); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'is_active'); ?></label>
        <div>
<?php echo $form->textField($model, 'is_active', array('class' => 'form-control')); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'date_created'); ?></label>
        <div>
<?php echo $form->textField($model, 'date_created', array('class' => 'form-control date_created')); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'date_updated'); ?></label>
        <div>
<?php echo $form->textField($model, 'date_updated', array('class' => 'form-control date_updated')); ?>
        </div>
    </div>
<div class="form-group col-sm-2">
        <label ><?php echo $form->label($model, 'date_deleted'); ?></label>
        <div>
<?php echo $form->textField($model, 'date_deleted', array('class' => 'form-control date_deleted')); ?>
        </div>
    </div>

    <div class="form-group col-sm-3" style="margin-top:28px;">
        <button id = 'btnSearch' type="submit" class="btn btn-primary">搜索</button>
    </div> 
<?php $this->endWidget(); ?>

</div><!-- search-form -->
<script>
 $(document).ready(function () {
        //开始日期
        $(".date_created").datepicker({            
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
         $(".date_updated").datepicker({            
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
         $(".date_deleted").datepicker({            
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
  });
</script>