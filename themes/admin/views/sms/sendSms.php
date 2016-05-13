<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/sendSms.js', CClientScript::POS_END);

$urlSendSms = $this->createUrl('sms/ajaxSendSms');
?>
<form id="sendSmd-form" class="" method="post" action="<?php echo $urlSendSms; ?>">
    <div class="form-group">
        <label class="control-label">手机号码<span class="color-red">（多个号码以英文分号 ";" 隔开）</span></label>
        <input class="form-control" name="sms[mobile]"/>
    </div>
    <div class="form-group">
        <label class="control-label">短信内容</label>
        <textarea id='task_content' name='sms[content]' class="form-control" rows="3"></textarea>
    </div>
    <div class="mt20 text-left">
        <a href="http://www.shjianzhou.com/key/index.html" target="_blank">敏感词查询</a>
    </div>
    <div class="mt20 text-left">
        <button type="submit" class="btn btn-primary">发送</button>
    </div>
</form>