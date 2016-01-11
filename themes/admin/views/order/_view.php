<?php
/* @var $this SalesOrderController */
/* @var $data SalesOrder */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_no')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id'=>$data->id)); ?>
	<br />
	
        <?php /*
        <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bk_id')); ?>:</b>
	<?php echo CHtml::encode($data->bk_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bk_type')); ?>:</b>
	<?php echo CHtml::encode($data->bk_type); ?>
	<br />
        */ ?>
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('bk_ref_no')); ?>:</b>
	<?php echo CHtml::encode($data->bk_ref_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('is_paid')); ?>:</b>
	<?php echo $data->is_paid==1?'已支付':'未支付'; ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_paid')); ?>:</b>
	<?php echo CHtml::encode($data->is_paid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_open')); ?>:</b>
	<?php echo CHtml::encode($data->date_open); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_closed')); ?>:</b>
	<?php echo CHtml::encode($data->date_closed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_amount')); ?>:</b>
	<?php echo CHtml::encode($data->total_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_percent')); ?>:</b>
	<?php echo CHtml::encode($data->discount_percent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_amount')); ?>:</b>
	<?php echo CHtml::encode($data->discount_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_amount')); ?>:</b>
	<?php echo CHtml::encode($data->final_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_updated')); ?>:</b>
	<?php echo CHtml::encode($data->date_updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->date_deleted); ?>
	<br />

	*/ ?>

</div>