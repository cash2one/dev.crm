jQuery(function () {
    var $ = jQuery, // just in case. Make sure it's not an other libaray.
            domForm = $("#sendSmd-form"),
            btnSubmit = $("#btnSubmit");
//提交按钮点击事件
    btnSubmit.click(function () {
        //触发表单提交事件
        domForm.submit();
    });
//表单验证板块
    var validator = domForm.validate({
        rules: {
            'sms[mobile]': {
                required: true
            },
            'sms[content]': {
                required: true
            }
        },
        messages: {
            'sms[mobile]': {
                required: '请填写手机号码'
            },
            'sms[content]': {
                required: '请填写短信内容'
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#sms-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            error.appendTo(element.parents(".form-group"));     //这里的element是录入数据的对象  
            //error.appendTo(element); 
        },
        submitHandler: function () {
            //form插件的异步无刷新提交
            actionUrl = domForm.attr('action');
            disabledBtn(btnSubmit);
            //alert("asdf");
            //    btnSubmit.button("disable");
            domForm.ajaxSubmit({
                type: 'post',
                url: actionUrl,
                success: function (data) {
                    if (data.status == 'ok') {
                        alert('发送成功!');
                        location.reload();
                    } else {
                        alert('发送失败!');
                    }
                    enableBtn(btnSubmit);
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    alert('发送失败!');
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
jQuery(function () {
    var $ = jQuery, // just in case. Make sure it's not an other libaray.
            domForm = $("#sendTemplateSms-form"),
            btnSubmit = $("#submitTemplateSms");
//提交按钮点击事件
    btnSubmit.click(function () {
        //触发表单提交事件
        domForm.submit();
    });
//表单验证板块
    var validator = domForm.validate({
        rules: {
            'sms[text]': {
                required: true
            },
            'sms[disease]': {
                required: true
            },
            'sms[hospital]': {
                required: true
            },
            'sms[expert]': {
                required: true
            }
        },
        messages: {
            'sms[text]': {
                required: '请填写补充内容'
            },
            'sms[disease]': {
                required: '请填写疾病'
            },
            'sms[hospital]': {
                required: '请填写医院'
            },
            'sms[expert]': {
                required: '请填写医生名'
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#sms-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            error.appendTo(element.parent());     //这里的element是录入数据的对象  
            //error.appendTo(element); 
        },
        submitHandler: function () {
            //form插件的异步无刷新提交
            actionUrl = domForm.attr('action');
            disabledBtn(btnSubmit);
            //alert("asdf");
            //    btnSubmit.button("disable");
            domForm.ajaxSubmit({
                type: 'post',
                url: actionUrl,
                success: function (data) {
                    if (data.status == 'ok') {
                        alert('发送成功!');
                        location.reload();
                    } else {
                        alert('发送失败!');
                    }
                    enableBtn(btnSubmit);
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    alert('发送失败!');
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