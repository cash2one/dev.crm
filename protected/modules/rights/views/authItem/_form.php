<div class="form span-12 first">

    <?php if ($model->scenario === 'update'): ?>

        <h3><?php echo Rights::getAuthItemTypeName($model->type); ?></h3>

    <?php endif; ?>

    <?php $form = $this->beginWidget('CActiveForm'); ?>
    <div class="form-horizontal">
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'name'); ?></label>
            <div>
                <?php echo $form->textField($model, 'name', array('maxlength' => 255, 'class' => 'text-field form-control')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'name'); ?></div>
                <p class="hint"><?php echo Rights::t('core', 'Do not change the name unless you know what you are doing.'); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-7">
            <label ><?php echo $form->labelEx($model, 'description'); ?></label>
            <div>
                <?php echo $form->textField($model, 'description', array('maxlength' => 255, 'class' => 'text-field form-control')); ?>               
                <div class="text-danger"><?php echo $form->error($model, 'description'); ?></div>
                <p class="hint"><?php echo Rights::t('core', 'A descriptive name for this item.'); ?></p>
            </div>
        </div>        
        <?php if (Rights::module()->enableBizRule === true): ?>
            <div class="form-group col-sm-7">
                <label ><?php echo $form->labelEx($model, 'bizRule'); ?></label>
                <div>
                    <?php echo $form->textField($model, 'bizRule', array('maxlength' => 255, 'class' => 'text-field form-control')); ?>               
                    <div class="text-danger"><?php echo $form->error($model, 'bizRule'); ?></div>
                    <p class="hint"><?php echo Rights::t('core', 'Code that will be executed when performing access checking.'); ?></p>
                </div>
            </div>            
        <?php endif; ?>
        <?php if (Rights::module()->enableBizRule === true && Rights::module()->enableBizRuleData): ?>
            <div class="form-group col-sm-7">
                <label ><?php echo $form->labelEx($model, 'data'); ?></label>
                <div>
                    <?php echo $form->textField($model, 'data', array('maxlength' => 255, 'class' => 'text-field form-control')); ?>               
                    <div class="text-danger"><?php echo $form->error($model, 'bizRule'); ?></div>
                    <p class="hint"><?php echo Rights::t('core', 'Additional data available when executing the business rule.'); ?></p>
                </div>
            </div>            
        <?php endif; ?>
        <div class="form-group col-sm-7 right-cancel">
            <?php echo CHtml::submitButton(Rights::t('core', 'Save'), array('class' => 'btn btn-primary')); ?> | <?php echo CHtml::link(Rights::t('core', 'Cancel'), Yii::app()->user->rightsReturnUrl); ?>
        </div>   
    </div>
    <div class="clearfix"></div>
    <?php $this->endWidget(); ?>
</div>