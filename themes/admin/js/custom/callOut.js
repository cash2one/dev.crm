jQuery(function () {
    var $ = jQuery, // just in case. Make sure it's not an other libaray.
            outingCallsForm = $("#outingCalls-form"),
            submitCallOutBtn = $("#submitCallOutBtn");
//提交按钮点击事件
    submitCallOutBtn.click(function () {
        //触发表单提交事件
        //outingCallsForm.submit();
    });
//表单验证板块
    var validator = outingCallsForm.validate({
        rules: {
            'call[remark]': {
                required: true
            },
            'call[phoneRecordId]': {
                required: true
            }
        },
        messages: {
            'call[remark]': {
                required: '请填写备注内容'
            },
            'call[phoneRecordId]': {
                required: '请先拨打电话'
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
            actionUrl = outingCallsForm.attr('data-action');
            disabledBtn(submitCallOutBtn);
            var phoneRecordId = outingCallsForm.find('#call_phoneRecordId').val();
            var mobile = outingCallsForm.find('#call_mobile').val();
            var phoneRecordListUrl = outingCallsForm.attr('data-phoneRecordListUrl');
            if (!phoneRecordId) {
                alert('请先拨打电话!');
                enableBtn(submitCallOutBtn);
                return;
            }
            outingCallsForm.ajaxSubmit({
                type: 'post',
                url: actionUrl,
                success: function (data) {
                    if (data.status == 'ok') {
                        alert('保存成功!');
                        $('#formReset').trigger("click");
                        ajaxLoadPhoneRecordByMobile(mobile, phoneRecordListUrl);
                    } else {
                        alert('保存失败!');
                    }
                    enableBtn(submitCallOutBtn);
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    alert('保存失败!');
                    enableBtn(submitCallOutBtn);
                    console.log(XmlHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                complete: function () {
                    enableBtn(submitCallOutBtn);
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
function ajaxLoadPhoneRecordByMobile(mobile, phoneRecordListUrl, recordFileUrl) {
    $.ajax({
        url: phoneRecordListUrl,
        data: {'mobile': mobile},
        success: function (data) {
            setPhoneRecordListHtml(data.results, recordFileUrl);
        },
        error: function () {

        }
    });
}
function setPhoneRecordListHtml(results, recordFileUrl) {
    var innerHtml = '';
    if (results.phoneRecords) {
        var phoneRecords = results.phoneRecords;
        for (var i = 0; i < phoneRecords.length; i++) {
            var phoneRecord = phoneRecords[i];
            var remarks = phoneRecord.remark;
            var remarkLength = remarks.length;
            var recordFile = phoneRecord.recordFile == null || phoneRecord.recordFile == '' ? '无' : '<a target="_blank" href="' + recordFileUrl + '/' + phoneRecord.uniqueId + '">播放</a>';
            if (remarkLength > 1) {
                for (var j = 0; j < remarkLength; j++) {
                    var remark = remarks[j];
                    innerHtml += '<tr>';
                    if (j == 0) {
                        innerHtml += '<td rowspan="' + remarkLength + '">' + phoneRecord.startTime + '</td>' +
                                '<td rowspan="' + remarkLength + '">' + phoneRecord.endTime + '</td>' +
                                '<td rowspan="' + remarkLength + '">' + phoneRecord.adminUserName + '</td>' +
                                '<td rowspan="' + remarkLength + '">' + phoneRecord.status + '</td>'
                    }
                    innerHtml += '<td>' + remark + '</td>';
                    if (j == 0) {
                        innerHtml += '<td rowspan="' + remarkLength + '">' + recordFile + '</td>';
                    }
                    innerHtml += '</tr>';
                }
            } else {
                innerHtml += '<tr>' +
                        '<td>' + phoneRecord.startTime + '</td>' +
                        '<td>' + phoneRecord.endTime + '</td>' +
                        '<td>' + phoneRecord.adminUserName + '</td>' +
                        '<td>' + phoneRecord.status + '</td>' +
                        '<td>' + phoneRecord.remark + '</td>' +
                        '<td>' + recordFile + '</td>' +
                        '</tr>';
            }
        }
    } else {
        innerHtml = '<tr><td colspan="9">无记录</td></tr>';
    }
    $('.recordList .table>tbody').html(innerHtml);
}