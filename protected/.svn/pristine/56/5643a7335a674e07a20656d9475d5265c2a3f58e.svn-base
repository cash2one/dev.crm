<?php
/* @var $this HospitalController */
/* @var $data Hospital */
?>
<div class="view" style="border: 2px solid #CCC;">


    <div class="h-avatar"><?php echo CHtml::Image($data->getAbsUrlAvatar(), $data->name, array('title' => $data->name)); ?></div>

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::encode($data->id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id' => $data->id), array('target' => '_blank')); ?>
    <br />

    <b><?php echo CHtml::encode('科室'); ?>:</b>
    <?php
    $facultyStr = '无';
    $listFaculty = $data->hospitalFaculties;
    if (is_array($listFaculty) && count($listFaculty) > 0) {
        $list = CHtml::listData($listFaculty, 'id', 'name');
        $facultyStr = implode(',', $list);
    }
    echo $facultyStr;
    ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
    <?php echo CHtml::encode($data->getCityName()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b><br />
    <?php //echo CHtml::encode(Yii::app()->format->formatNText($data->description)); 
    echo CHtml::encode($data->description); ?>
</div>