jQuery(function () {
    var $ = jQuery,
            domForm = $("#task-form"), // form - html dom object.;
            btnSubmit = $("#taskSubmit");

    //登陆页面表单验证模块
    var validator = domForm.validate({
        //focusInvalid: true,
        rules: {
            'task[date_plan]': {
                required: true
            },
            'task[admin_user_id]': {
                required: true
            },
            'task[work_type]': {
                required: true
            },
            'task[content]': {
                required: true
            }
        },
        messages: {
            'task[date_plan]': {
                required: "请填写计划跟单时间"
            },
            'task[admin_user_id]': {
                required: "请选择跟单人员"
            },
            'task[work_type]': {
                required: "请选择跟单方式"
            },
            'task[content]': {
                required: "请填写跟单内容"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parent().find("div.error").remove();
            error.appendTo(element.parent());     //这里的element是录入数据的对象  
        }
    });
    btnSubmit.click(function () {
        var bool = validator.form();
        if (bool) {
            formAjaxSubmit();
        }
    });
    function formAjaxSubmit() {
        //form插件的异步无刷新提交
        var formdata = domForm.serialize();
        var requestUrl = domForm.attr('data-action');
        $.ajax({
            type: 'post',
            url: requestUrl,
            data: formdata,
            success: function (data) {
                //success.
                if (data.status == 'ok') {
                    location.reload();
                } else {
                    domForm.find("div.error").remove();
                    for (error in data.errors) {
                        errerMsg = data.errors[error];
                        inputKey = '#task_' + error;
                        $(inputKey).focus();
                        $(inputKey).parent().parent().append("<div class='error'>" + errerMsg + "</div> ");
                    }
                    //error.
                }
                enableBtn(btnSubmit);
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                enableBtn(btnSubmit);
                console.log(XmlHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            complete: function () {
                //enableBtn(btnSubmit);
                //btnSubmit.show();
            }
        });
    }
});

