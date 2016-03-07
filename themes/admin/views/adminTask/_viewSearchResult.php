<?php $task = $data->adminTask ?>
<tr>
    <td><?php echo $task->subject; ?></td>
    <td><?php echo $task->content; ?></td>
    <td><?php echo $data->getType(); ?></td>
    <td><?php echo $data->getWorkType(); ?></td>
    <td><?php echo $data->getRead(); ?></td>
    <td><?php echo $data->getStatus(); ?></td>
    <td><?php echo $data->getDatePlan(); ?></td>
    <td><?php echo $data->getDateDone(); ?></td>
    <td><a target="_blank" href="<?php echo $task->url ?>" ><img src="<?php echo Yii::app()->baseUrl; ?>/assets/9f55b493/gridview/view.png" alt="查看"></a></td>
</tr>


