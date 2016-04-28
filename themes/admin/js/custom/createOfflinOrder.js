jQuery(function () {
    //图片上传板块
    var $ = jQuery, // just in case. Make sure it's not an other libaray.
            domForm = $("#sales-order-form"),
            returnUrl = domForm.attr('data-returnUrl'),
            btnSubmit = $("#btnSubmit");
//提交按钮点击时间
    btnSubmit.click(function () {
        //触发表单提交事件
        domForm.submit();
    });
//表单验证板块
    var validator = domForm.validate({
        rules: {
            'order[final_amount]': {
                required: true
            },
            'order[subject]': {
                required: true
            },
            'order[description]': {
                required: true
            },
            'order[order_type]': {
                required: true
            },
            'order[pay_channel]': {
                required: true
            },
            'order[channel_trade_no]': {
                required: true
            },
            'order[date_closed]': {
                required: true
            }
        },
        messages: {
            'order[final_amount]': {
                required: '请填写订单金额'
            },
            'order[subject]': {
                required: '请填写订单标题'
            },
            'order[description]': {
                required: '请填写订单描述'
            },
            'order[order_type]': {
                required: '请选择订单类型'
            },
            'order[pay_channel]': {
                required: '请选择支付渠道'
            },
            'order[channel_trade_no]': {
                required: '请填写支付交易号'
            },
            'order[date_closed]': {
                required: '请填写支付日期'
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#order-form div .error"),
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
                before: function () {
                    $("#btnSubmit").attr("disabled", true);
                },
                success: function (data) {
                    if (data.status == 'ok') {
                        //弹框提示
                        location.href = returnUrl + '/' + data.orderId;
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
                    $("#btnSubmit").attr("disabled", false);
                    //    btnSubmit.button("enable");
                }
            });
        }
    });
});