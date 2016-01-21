<?php
/* @var $this AdminMsgController */
/* @var $model AdminMsg */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);?>
<div class="form row">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>
    <div class="form-group col-sm-3">
        <label ><?php echo $form->label($model, 'id'); ?></label>
        <div>
<?php echo $form->textField($model, 'id', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label ><?php echo $form->label($model, 'subject'); ?></label>
        <div>
<?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label ><?php echo $form->label($model, 'content'); ?></label>
        <div>
<?php echo $form->textField($model, 'content', array('size' => 60, 'maxlength' => 500, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label ><?php echo $form->label($model, 'date_created'); ?></label>
        <div>
<?php echo $form->textField($model, 'date_created', array('class' => 'form-control date_created')); ?>
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label ><?php echo $form->label($model, 'date_updated'); ?></label>
        <div>
<?php echo $form->textField($model, 'date_updated', array('class' => 'form-control date_updated')); ?>
        </div>
    </div>
    <div class="form-group col-sm-3">
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
 