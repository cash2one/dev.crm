<?php 
$task = $data->adminTask;
if($data->getRead(false) == AdminTaskJoin::NOT_READ && $data->getStatus(false) == AdminTaskJoin::STATUS_NO){
    $class='strong';
}else if($data->getRead(false) == AdminTaskJoin::IS_READ & $data->getStatus(false) == AdminTaskJoin::STATUS_NO){
    $class='color-red';
}else{
    $class='';
}
?>
<tr class="<?php echo $class; ?>">
    <td><?php echo $task->subject; ?></td>
    <td><?php echo $task->content; ?></td>
    <td><?php echo $data->getType(); ?></td>
    <td><?php echo $data->getWorkType(); ?></td>
    <td><?php echo $data->getRead(); ?></td>
    <td><?php echo $data->getStatus(); ?></td>
    <td><?php echo $data->getDatePlan(); ?></td>
    <td><?php echo $data->getDateDone(); ?></td>
    <td><a target="_blank" href="<?php echo $this->createUrl('admintask/view', array('id' => $task->id)); ?>" >查看</a></td>
</tr>


