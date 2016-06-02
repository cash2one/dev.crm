<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/sendSms.js', CClientScript::POS_END);

$urlSendSms = $this->createUrl('sms/ajaxSendSms');
$urlLoadSmsTemplate = $this->createUrl('sms/ajaxLoadSmsTemplate');
$urlSendTemplateSms = $this->createUrl('sms/sendTemplateSms');
?>
<div class="modal fade" id="sendSmdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog mt100">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">发送短信</h4>
            </div>
            <div class="modal-body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#template" aria-controls="template" role="tab" data-toggle="tab">模板发送</a></li>
                        <li role="presentation"><a href="#freeEditing" aria-controls="freeEditing" role="tab" data-toggle="tab">自由编辑</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="template">
                            <form id="sendTemplateSms-form" class="" method="post" action="<?php echo $urlSendTemplateSms; ?>">
                                <input name="sms[adminBookingId]" id="sms_adminBookingId" type="hidden"/>
                                <input name="sms[code]" id="sms_code"type="hidden"/>
                                <input name="sms[money]" id="sms_money" type="hidden"/>
                                <div class="mt10">
                                    <label class="control-label">手机号码<span class="color-red"></span></label>
                                    <label class="control-label" id="smsMobileText"></label>
                                    <input type="hidden" id="sms_mobile" class="form-control" name="sms[mobile]"/>
                                </div>
                                <div class="mt10 text-left">
                                    <div id="templateList">
                                        加载中...
                                    </div>
                                    <div id="amountInput" class="mt10" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label class="mt10">自定义内容：</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="sms_text" class="form-control" name="sms[text]"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="phoneNotInput" class="mt10" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="mt10">疾病：</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" id="sms_disease" class="form-control phoneNotInput" name="sms[disease]"/>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="mt10">医院：</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" id="sms_hospital" class="form-control phoneNotInput" name="sms[hospital]"/>
                                            </div>
                                            <div class="clearfix mt10"></div>
                                            <div class="col-md-2 text-right mt10">
                                                <label class="mt10">医生：</label>
                                            </div>
                                            <div class="col-sm-4 mt10">
                                                <input type="text" id="sms_expert" class="form-control phoneNotInput" name="sms[expert]"/>
                                            </div>
                                            <div class="clearfix mt10"></div>
                                        </div>
                                    </div>
                                    <div id="templateShow" class="mt10" style="display: none;">
                                        <p>内容:</p>
                                        <div class="templateContent"></div>
                                        <div class="mt20 text-right">
                                            <button id="submitTemplateSms" type="submit" class="btn btn-primary">发送</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="freeEditing">
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
                        </div>
                    </div>
                </div>
                <br/><br/><br/>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    var contentAmount = '';
    var finalAmount = 0.00;
    var weixin = '无';
    var patientDisease = '';
    $(document).ready(function () {
        $('#sendSmdModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var mobile = button.data('mobile');
            var adminBookingId = button.data('bookingid');
            var disease = button.data('disease');
            patientDisease = disease;
            var modal = $(this);
            modal.find('.modal-body input#sms_mobile').val(mobile);
            var mobileText = new String(mobile);
            modal.find('.modal-body #smsMobileText').html(mobileText.substr(0, 3) + '****' + mobileText.substr(7));
            modal.find('.modal-body input#sms_adminBookingId').val(adminBookingId);
            //modal.find('.modal-body input#sms_disease').val(disease);

            var urlLoadSmsTemplate = '<?php echo $urlLoadSmsTemplate ?>';
            ajaxLoadSmsTemplate(urlLoadSmsTemplate);
        });
    });
    function ajaxLoadSmsTemplate(urlLoadSmsTemplate) {
        $.ajax({
            url: urlLoadSmsTemplate,
            success: function (data) {
                setTemplateHtml(data);
            }
        });
    }
    function setTemplateHtml(data) {
        var innerHtml = '';
        if (data.template) {
            var template = data.template;
            for (var i = 0; i < template.length; i++) {
                var smsTemp = template[i];
                if (smsTemp.code == 'wx.add') {
                    innerHtml += '<a class="smsWxTemplate" data-code="' + smsTemp.code + '" data-content="' + smsTemp.content + '">' + smsTemp.remark + '</a>';
                } else if (smsTemp.code == 'service.phone.not') {
                    innerHtml += '<a class="smsPhoneNotTemplate" data-code="' + smsTemp.code + '" data-content="' + smsTemp.content + '">' + smsTemp.remark + '</a>';
                } else if (smsTemp.type == 2) {
                    innerHtml += '<a class="smsTemplate" data-code="' + smsTemp.code + '" data-content="' + smsTemp.content + '">' + smsTemp.remark + '</a>';
                } else {
                    innerHtml += '<a class="smsAmountTemplate" data-code="' + smsTemp.code + '" data-content="' + smsTemp.content + '">' + smsTemp.remark + '</a>';
                }
            }
            $('#templateList').html(innerHtml);
            initHtmlFunction();
        }
    }
    function initHtmlFunction() {
        $('#template a.smsTemplate').click(function () {
            var smsContent = $(this).attr('data-content');
            var code = $(this).attr('data-code');
            if (smsContent.indexOf('{disease}') > 0) {
                smsContent = smsContent.replace('{disease}', patientDisease);
            }
            $('#templateShow .templateContent').html(smsContent);
            $('#templateShow').show();
            $('#amountInput').hide();
            $('#sendTemplateSms-form #sms_code').val(code);
        });
        $('#template a.smsAmountTemplate').click(function () {
            contentAmount = $(this).attr('data-content');
            var code = $(this).attr('data-code');
            finalAmount = parseFloat(finalAmount);
            finalAmount = finalAmount.toFixed(2);
            var smsContent = contentAmount.replace('{money}', finalAmount);
            $('#templateShow .templateContent').html(smsContent);
            $('#templateShow').show();
            $('#amountInput').show();
            $('#sendTemplateSms-form #sms_code').val(code);
        });
        $('#template a.smsWxTemplate').click(function () {
            contentAmount = $(this).attr('data-content');
            var code = $(this).attr('data-code');
            var smsContent = contentAmount.replace('{weixin}', weixin);
            $('#templateShow .templateContent').html(smsContent);
            $('#templateShow').show();
            $('#amountInput').show();
            $('#sendTemplateSms-form #sms_code').val(code);
        });
        $('#template a.smsPhoneNotTemplate').click(function () {
            contentAmount = $(this).attr('data-content');
            var code = $(this).attr('data-code');
            $('#templateShow .templateContent').html(contentAmount);
            $('#templateShow').show();
            $('#phoneNotInput').show();
            $('#sendTemplateSms-form #sms_code').val(code);
        });
        $('#amountInput #sms_text').keyup(function () {
            if (contentAmount.indexOf('{money}') > 0) {
                var amoutInput = parseFloat($(this).val());
                finalAmount = amoutInput > 0 ? amoutInput : 0;
                finalAmount = finalAmount.toFixed(2);
                var smsContent = contentAmount.replace('{money}', finalAmount);
                $('#templateShow .templateContent').html(smsContent);
            } else if (contentAmount.indexOf('{weixin}') > 0) {
                var amoutInput = $(this).val();
                var smsContent = contentAmount.replace('{weixin}', amoutInput);
                $('#templateShow .templateContent').html(smsContent);
            }
        });
        $('#phoneNotInput .phoneNotInput').keyup(function () {
            if (contentAmount.indexOf('{disease}') > 0 && contentAmount.indexOf('{hospital}') > 0 && contentAmount.indexOf('{expert}') > 0) {
                var smsContent = contentAmount;
                var disease = $('#sms_disease').val();
                if (disease.length > 0) {
                    smsContent = contentAmount.replace('{disease}', disease);
                }
                var hospital = $('#sms_hospital').val();
                if (hospital.length > 0) {
                    smsContent = smsContent.replace('{hospital}', hospital);
                }
                var expert = $('#sms_expert').val();
                if (expert.length > 0) {
                    smsContent = smsContent.replace('{expert}', expert);
                }
                $('#templateShow .templateContent').html(smsContent);
            }
        });
    }
</script>