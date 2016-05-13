<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/sendSms.js', CClientScript::POS_END);

$urlSendSms = $this->createUrl('sms/ajaxSendSms');
?>
<div class="modal fade" id="sendSmdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog mt100">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">发送短信</h4>
            </div>
            <div class="modal-body">
                <form id="sendSmd-form" class="" method="post" action="<?php echo $urlSendSms; ?>">
                    <input name="sms[adminBookingId]" id="sms_adminBookingId" type="hidden"/>
                    <div class="form-group">
                        <label class="control-label">手机号码<span class="color-red"></span></label>
                        <label class="control-label" id="smsMobileText"></label>
                        <input type="hidden" id="sms_mobile" class="form-control" name="sms[mobile]"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">短信内容</label>
                        <textarea id='task_content' name='sms[content]' class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mt20 text-left">
                        <a href="http://www.shjianzhou.com/key/index.html" target="_blank">敏感词查询</a>
                    </div>
                    <div class="mt20 text-right">
                        <button type="submit" class="btn btn-primary">发送</button>
                    </div>
                </form>
                <br/><br/><br/>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {
        $('#sendSmdModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var mobile = button.data('mobile');
            var adminBookingId = button.data('bookingid');
            var modal = $(this);
            modal.find('.modal-body input#sms_mobile').val(mobile);
            var mobileText = new String(mobile);
            modal.find('.modal-body #smsMobileText').html(mobileText.substr(0, 3) + '****' + mobileText.substr(7));
            modal.find('.modal-body input#sms_adminBookingId').val(adminBookingId);
        });
    });
</script>