<?php
/* @var $this DoctorController */
/* @var $data Doctor */
?>

<tr class="view">
    <td>
        <?php echo CHtml::encode($data->id); ?>
    </td>

    <td>
        <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->getMedicalTitle() . '  ' . $data->getAcademicTitle()); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->getHospitalName()); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->faculty); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->mobile); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->is_contracted == 1 ? '是' : '否'); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->role == 1 ? '是' : '否'); ?>
    </td>

    <td>
        <?php echo CHtml::encode($data->date_created); ?>
    </td>

</tr>