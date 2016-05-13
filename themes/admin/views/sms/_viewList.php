<?php
$msgSms = $data->msgSmsLog;
?>
<tr class="">
    <td><?php echo $data->admin_user_title . '    ' . $data->admin_user_name; ?></td>
    <td><?php echo $msgSms->mobile; ?></td>
    <td><?php echo $msgSms->content; ?></td>
    <td><?php echo $msgSms->is_success == 1 ? '是' : '否'; ?></td>
    <td><?php echo $data->getDateCreated(); ?></td>
    <td><a target="_blank" href="<?php echo $this->createUrl('sms/view', array('id' => $msgSms->id)); ?>" >查看</a></td>
</tr>