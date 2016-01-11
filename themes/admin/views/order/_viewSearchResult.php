<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id), array('target' => '_blank')); ?></td>
    <td><?php echo $data->getRefNo(); ?></td>
    <td><?php echo $data->getPingId(); ?></td>
    <td><?php echo $data->getDateClosed(); ?></td>
    <td><?php echo $data->getSubject(); ?></td>
    <td><?php echo $data->getBdCode(); ?></td>
    <td><?php echo $data->getFinalAmount(); ?></td>
    <td><?php echo $data->getIsPaid(); ?></td>
    <td><?php echo $data->getBkType() == 1 ? '患者' : '手术直通车'; ?></td>
    <td>
        <?php
        if ($data->bk_type == 1) {
            echo CHtml::link(CHtml::encode('查看预约'), array('booking/view', 'id' => $data->bk_id), array('target' => '_blank'));
        } else {
              echo CHtml::link(CHtml::encode('查看预约'), array('patientBooking/view', 'id' => $data->bk_id), array('target' => '_blank'));
        }
        ?>
    </td>
</tr>