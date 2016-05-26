jQuery(function () {
    var $ = jQuery, // just in case. Make sure it's not an other libaray.
            domForm = $("#smsVerifyCode-form"),
            btnSubmit = $("#submitBtn"),
            domResult = $('#verifyCodeResult');

    // 手机号码验证
    $.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
        return this.optional(element) || (length == 11 && mobile.test(value));
    }, "请填写正确的手机号码");
//提交按钮点击事件
    btnSubmit.click(function () {
        //触发表单提交事件
        domForm.submit();
    });
//表单验证板块
    var validator = domForm.validate({
        rules: {
            'AuthSmsVerify[mobile]': {
                required: true,
                isMobile: true
            },
            'AuthSmsVerify[actionType]': {
                required: true
            }
        },
        messages: {
            'AuthSmsVerify[mobile]': {
                required: '请填写手机号码',
                isMobile: '请输入正确的中国手机号码'
            },
            'AuthSmsVerify[actionType]': {
                required: '请选择短信类型'
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#AuthSmsVerify-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            error.appendTo(element.parents(".form-group"));     //这里的element是录入数据的对象  
            //error.appendTo(element); 
        },
        submitHandler: function () {
            //form插件的异步无刷新提交
            var actionUrl = domForm.attr('action');
            disabledBtn(btnSubmit);
            //alert("asdf");
            //    btnSubmit.button("disable");
            domForm.ajaxSubmit({
                type: 'post',
                url: actionUrl,
                success: function (data) {
                    if (data.status == 'ok') {
                        alert('创建成功!');
                        var innerHtml = '<p>电话：' + data.mobile;
                        innerHtml += ' <a id="sendSmsVerifyCode" data-mobile="' + data.mobile + '" data-code="' + data.smsVerify + '">发送验证码</a>';
                        innerHtml += ' <a data-mobile="' + data.mobile + '" data-toggle="modal" data-target="#outingCallsModal">打电话</a>';
                        innerHtml += '</p>';
                        innerHtml += '<p>验证码：' + data.smsVerify + '</p><p>类型：' + data.actionType + '</p>';
                        domResult.html(innerHtml);
                        initClickEvent();
                    } else {
                        alert('创建失败!');
                        var innerHtml = '<p>错误：' + data.errors + '</p>';
                        domResult.html(innerHtml);
                    }
                    enableBtn(btnSubmit);
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    alert('创建失败!');
                    enableBtn(btnSubmit);
                    console.log(XmlHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                complete: function () {
                    $("#btnSubmit").attr("disabled", false);
                    //    btnSubmit.button("enable");
                }
            });
        }
    });
});
function initClickEvent() {
    $('#sendSmsVerifyCode').click(function () {
        var mobile = $(this).attr('data-mobile');
        var code = $(this).attr('data-code');
        sendRegSmsVerifyCode(mobile, code);
    });
}
function sendRegSmsVerifyCode(mobile, code) {
    var smsVerifyCodeForm = $("#smsVerifyCode-form");
    var sendVerifyUrl = smsVerifyCodeForm.find("#smsverify_actionUrl").val();
    var formData = new FormData();
    formData.append("AuthSmsVerify[mobile]", mobile);
    formData.append("AuthSmsVerify[code]", code);
    $.ajax({
        type: 'post',
        url: sendVerifyUrl,
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        'success': function (data) {
            if (data.status === 'ok') {
                alert('发送成功!');
            }
            else {
                console.log(data);
            }
        },
        'error': function (data) {
            console.log(data);
        },
        'complete': function () {
        }
    });
}