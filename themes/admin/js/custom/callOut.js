jQuery(function () {
    var $ = jQuery, // just in case. Make sure it's not an other libaray.
            domForm = $("#outingCalls-form"),
            btnSubmit = $("#submitCallOutBtn");
//提交按钮点击事件
    btnSubmit.click(function () {
        //触发表单提交事件
        domForm.submit();
    });
//表单验证板块
    var validator = domForm.validate({
        rules: {
            'call[remark]': {
                required: true
            }
        },
        messages: {
            'call[remark]': {
                required: '请填写备注内容'
            }
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#call-form div .error"),
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
                        alert('保存成功!');
                        location.reload();
                    } else {
                        alert('保存失败!');
                    }
                    enableBtn(btnSubmit);
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    alert('保存失败!');
                    enableBtn(btnSubmit);
                    console.log(XmlHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                complete: function () {
                    enableBtn(btnSubmit);
                }
            });
        }
    });
});
function callOut(callOutUrl, savePhoneRecordUrl, mobile, cno) {
    $.ajax({
        url: callOutUrl,
        data: {'phone': mobile, 'cno': cno},
        async: false,
        success: function (data) {
            var dataJson = eval('(' + data + ')');
            if (dataJson.uniqueId) {
                savePhoneRecord(mobile, dataJson.uniqueId, savePhoneRecordUrl);
            } else {
                alert('呼叫失败!');
            }
        },
        error: function () {
            alert('呼叫失败!');
        }
    });
}
function savePhoneRecord(mobile, uniqueId, savePhoneRecordUrl) {
    $.ajax({
        url: savePhoneRecordUrl,
        type: 'post',
        data: {'call[uniqueId]': uniqueId, 'call[mobile]': mobile},
        success: function (data) {
            if (data.status == 'ok') {
                $('#call_phoneRecordId').val(data.phoneRecordId);
            } else {
                alert('保存失败,请联系管理员');
            }
        },
        error: function () {
            alert('保存失败,请联系管理员');
        }
    });
}
function ajaxLoadPhoneRecordByMobile(mobile, phoneRecordListUrl) {
    $.ajax({
        url: phoneRecordListUrl,
        data: {'mobile': mobile},
        success: function (data) {
            setPhoneRecordListHtml(data.results);
        },
        error: function () {

        }
    });
}
function setPhoneRecordListHtml(results) {
    var innerHtml = '';
    if (results.phoneRecords) {
        var phoneRecords = results.phoneRecords;
        for (var i = 0; i < phoneRecords.length; i++) {
            var phoneRecord = phoneRecords[i];
            innerHtml += '<tr>' +
                    '<td>' + phoneRecord.uniqueId + '</td>' +
                    '<td>' + phoneRecord.startTime + '</td>' +
                    '<td>' + phoneRecord.endTime + '</td>' +
                    '<td>' + phoneRecord.adminUserName + '</td>' +
                    '<td>' + phoneRecord.customerNumberType + '</td>' +
                    '<td>' + phoneRecord.callType + '</td>' +
                    '<td>' + phoneRecord.mobile + '</td>' +
                    '<td>' + phoneRecord.remark + '</td>' +
                    '<td>' + phoneRecord.recordFile + '</td>' +
                    '</tr>';
        }
    } else {
        innerHtml = '<tr><td colspan="9">无记录</td></tr>';
    }
    $('.recordList .table>tbody').html(innerHtml);
}