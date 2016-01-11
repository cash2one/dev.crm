<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id), array('target'=>'_blank')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->getUsername()), array('view', 'id'=>$data->id), array('target'=>'_blank')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_time); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />
        
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('login_attempts')); ?>:</b>
	<?php echo CHtml::encode($data->login_attempts); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('terms')); ?>:</b>
	<?php echo CHtml::encode($data->terms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_activated')); ?>:</b>
	<?php echo CHtml::encode($data->date_activated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_time); ?>
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