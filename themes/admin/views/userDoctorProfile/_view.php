<?php
/* @var $this UserDoctorProfileController */
/* @var $data UserDoctorProfile */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hospital_id')); ?>:</b>
	<?php echo CHtml::encode($data->hospital_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hospital_name')); ?>:</b>
	<?php echo CHtml::encode($data->hospital_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('hp_dept_id')); ?>:</b>
	<?php echo CHtml::encode($data->hp_dept_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hp_dept_name')); ?>:</b>
	<?php echo CHtml::encode($data->hp_dept_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clinical_title')); ?>:</b>
	<?php echo CHtml::encode($data->clinical_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('academic_title')); ?>:</b>
	<?php echo CHtml::encode($data->academic_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::encode($data->country_id); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_verified')); ?>:</b>
	<?php echo CHtml::encode($data->date_verified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('verified_by')); ?>:</b>
	<?php echo CHtml::encode($data->verified_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_contracted')); ?>:</b>
	<?php echo CHtml::encode($data->date_contracted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->date_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_updated')); ?>:</b>
	<?php echo CHtml::encode($data->date_updated); ?>
	<br />

	*/ ?>

</div>