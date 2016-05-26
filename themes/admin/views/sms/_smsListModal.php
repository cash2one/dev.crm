
<div class="modal fade mt100" id="smsListModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">短信记录</h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="mt10 smsList">
                        <h4 class="">短信记录</h4>
                        <table class="table">
                            <tbody>
                                <tr class="odd">
                                    <td>发送人</td>
                                    <td>手机号码</td>
                                    <td style="width:50%;">内容</td>
                                    <td>是否成功</td>
                                    <td>发送时间</td>
                                </tr>
                                <?php
                                if (isset($smsList) && arrayNotEmpty($smsList)) {
                                    foreach ($smsList as $sms) {
                                        ?>
                                        <tr class="odd">
                                            <td><?php echo $sms->adminUserName; ?></td>
                                            <td><?php echo substr_replace($sms->mobile, '****', 3, 4); ?></td>
                                            <td><?php echo $sms->content; ?></td>
                                            <td><?php echo $sms->isSuccess == 1 ? '是' : '否'; ?></td>
                                            <td><?php echo $sms->dateCreated; ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="5">无短信记录</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->