<?php
/* @var $this BookingController */
/* @var $data Booking */
?>
<tr class="view">

    <td>
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>

    <td>  
        <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->getClass()); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->getType()); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->getCityName()); ?>
    </td>
    
    <td>
        <?php echo CHtml::encode($data->date_created); ?>
    </td>

</tr>