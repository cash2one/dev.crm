<?php
/* @var $this AdminUserController */
/* @var $data AdminUser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php //echo CHtml::encode($data->password); ?>
	<br />

	<b><?php// echo CHtml::encode($data->getAttributeLabel('password_raw')); ?>:</b>
	<?php //echo CHtml::encode($data->password_raw); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('password_salt')); ?>:</b>
	<?php //echo CHtml::encode($data->password_salt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role')); ?>:</b>
	<?php echo CHtml::encode($data->role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fullname')); ?>:</b>
	<?php echo CHtml::encode($data->fullname); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wechat')); ?>:</b>
	<?php echo CHtml::encode($data->wechat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qq')); ?>:</b>
	<?php echo CHtml::encode($data->qq); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_id')); ?>:</b>
	<?php echo CHtml::encode($data->state_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_name')); ?>:</b>
	<?php echo CHtml::encode($data->state_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_name')); ?>:</b>
	<?php echo CHtml::encode($data->city_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
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