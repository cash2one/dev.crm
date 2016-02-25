<?php
/* @var $this AdminTaskController */
/* @var $data AdminTask */
?>
<tr class="view">
    <td>
         <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>
    <td>
         <?php echo CHtml::encode($data->subject); ?>
    </td>
     <td>
         <?php echo CHtml::encode($data->content); ?>
    </td>
    <td>
         <?php echo CHtml::encode($data->url); ?>
    </td>
    <td>
         <?php echo CHtml::encode($data->date_created); ?>
    </td>
    <td>
         <?php echo CHtml::encode($data->date_updated); ?>
    </td>
    <td>
         <?php echo CHtml::encode($data->date_deleted); ?>
    </td>
</tr>