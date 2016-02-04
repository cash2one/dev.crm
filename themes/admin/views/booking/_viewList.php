<?php
/* @var $this BookingController */
/* @var $data Booking */
?>

<tr class="view">
    <td>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>
    <td>    
    <?php echo CHtml::link(CHtml::encode($data->ref_no), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>
    <td>
    <?php echo CHtml::encode($data->getExpertNameBooked()); ?>
    </td>
    <td>
    <?php echo CHtml::encode($data->mobile); ?>
    </td>
    <td>
    <?php echo CHtml::encode($data->contact_name); ?>
    </td>   
    <td>
    <?php echo CHtml::encode($data->getBkStatus()); ?>
    </td>
    <td>
    <?php echo CHtml::encode($data->date_created); ?>
    </td>
    <td>
    <?php echo CHtml::encode($data->countFiles); ?>
    </td
</tr>