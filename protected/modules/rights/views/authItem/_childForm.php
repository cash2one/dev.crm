<div class="form">
    <?php $form = $this->beginWidget('CActiveForm'); ?>
    <div class="row">
        <div class="form-group col-sm-3">
            <?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions, array('class' => 'form-control')); ?>            
            <div class="text-danger"> <?php echo $form->error($model, 'itemname'); ?></div>
        </div>		
    </div>
    <div class="buttons">
        <?php echo CHtml::submitButton(Rights::t('core', 'Add'), array('class' => 'btn btn-primary')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>