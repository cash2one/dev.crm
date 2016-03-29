/*global Qiniu */
/*global plupload */
/*global FileProgress */
/*global hljs */


$(function () {
    var num = 0;
    var domForm = $('#booking-form'),
            btnSubmit = $('#btnSubmitForm'),
            returnUrl = domForm.attr('data-url-return'),
            fileParam = {"id": "", "name": ""};
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfiles',
        container: 'container',
        drop_element: 'container',
        max_file_size: '10mb',
        flash_swf_url: 'bower_components/plupload/js/Moxie.swf',
        dragdrop: true,
        chunk_size: '4mb',
        uptoken_url: $('#uptoken_url').val(),
        domain: $('#domain').val(),
        get_new_uptoken: false,
        // downtoken_url: '/downtoken',
        //unique_names: true,
        // save_key: true,
        // x_vars: {
        //     'id': '1234',
        //     'time': function(up, file) {
        //         var time = (new Date()).getTime();
        //         // do something with 'time'
        //         return time;
        //     },
        // },
        auto_start: false,
        log_level: 5,
        init: {
            'FilesAdded': function (up, files) {
                $('table').show();
                $('#success').hide();
                plupload.each(files, function (file) {
                    var progress = new FileProgress(file, 'fsUploadProgress');
                    progress.setStatus("等待...");
                    progress.bindUploadCancel(up);
                });
            },
            'BeforeUpload': function (up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
                if (up.runtime === 'html5' && chunk_size) {
                    progress.setChunkProgess(chunk_size);
                }
            },
            'UploadProgress': function (up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
                progress.setProgress(file.percent + "%", file.speed, chunk_size);
            },
            'UploadComplete': function () {
                $('#success').show();
                btnSubmit.attr('disabled', false);
                location.href = returnUrl;
            },
            'FileUploaded': function (up, file, info) {
                //单个文件上传成功所做的事情 
                // 其中 info 是文件上传成功后，服务端返回的json，形式如
                // {
                //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                //    "key": "gogopher.jpg"
                //  }
                // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
                // var domain = up.getOption('domain');
                // var res = parseJSON(info);
                // var sourceLink = domain + res.key; 获取上传成功后的文件的Url
                var progress = new FileProgress(file, 'fsUploadProgress');
                progress.setComplete(up, info);
                var formdata = new FormData();
                var fileExtension = file.name.substring(file.name.lastIndexOf('.') + 1);
                formdata.append('admin[admin_booking_id]', fileParam.id);
                formdata.append('admin[file_size]', file.size);
                formdata.append('admin[report_type]', domForm.find('#reportType').val());
                formdata.append('admin[mime_type]', file.type);
                formdata.append('admin[file_name]', file.name);
                formdata.append('admin[file_url]', file.name);
                formdata.append('admin[file_ext]', fileExtension);
                formdata.append('admin[remote_domain]', domForm.find('#domain').val());
                formdata.append('admin[remote_file_key]', file.name);
                $.ajax({
                    url: domForm.attr('data-url-uploadfile'),
                    data: formdata,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'no') {
                            alert('上传失败!');
                        }
                    },
                    error: function (data) {
                        alert('上传失败!');
                    }
                });
            },
            'Error': function (up, err, errTip) {
                $('table').show();
                var progress = new FileProgress(err.file, 'fsUploadProgress');
                progress.setError();
                progress.setStatus(errTip);
                alert('上传失败!');
            }
            // ,
            // 'Key': function(up, file) {
            //     var key = "";
            //     // do something with key
            //     return key
            // }
        }
    });
    uploader.bind('FileUploaded', function () {
        console.log('hello man,a file is uploaded');
    });

    btnSubmit.click(function () {
        domForm.submit();
    });

    $('#container').on(
            'dragenter',
            function (e) {
                e.preventDefault();
                $('#container').addClass('draging');
                e.stopPropagation();
            }
    ).on('drop', function (e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragleave', function (e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragover', function (e) {
        e.preventDefault();
        $('#container').addClass('draging');
        e.stopPropagation();
    });



    $('#show_code').on('click', function () {
        $('#myModal-code').modal();
        $('pre code').each(function (i, e) {
            hljs.highlightBlock(e);
        });
    });


    $('body').on('click', 'table button.btn', function () {
        $(this).parents('tr').next().toggle();
    });


    var getRotate = function (url) {
        if (!url) {
            return 0;
        }
        var arr = url.split('/');
        for (var i = 0, len = arr.length; i < len; i++) {
            if (arr[i] === 'rotate') {
                return parseInt(arr[i + 1], 10);
            }
        }
        return 0;
    };

    $('#myModal-img .modal-body-footer').find('a').on('click', function () {
        var img = $('#myModal-img').find('.modal-body img');
        var key = img.data('key');
        var oldUrl = img.attr('src');
        var originHeight = parseInt(img.data('h'), 10);
        var fopArr = [];
        var rotate = getRotate(oldUrl);
        if (!$(this).hasClass('no-disable-click')) {
            $(this).addClass('disabled').siblings().removeClass('disabled');
            if ($(this).data('imagemogr') !== 'no-rotate') {
                fopArr.push({
                    'fop': 'imageMogr2',
                    'auto-orient': true,
                    'strip': true,
                    'rotate': rotate,
                    'format': 'png'
                });
            }
        } else {
            $(this).siblings().removeClass('disabled');
            var imageMogr = $(this).data('imagemogr');
            if (imageMogr === 'left') {
                rotate = rotate - 90 < 0 ? rotate + 270 : rotate - 90;
            } else if (imageMogr === 'right') {
                rotate = rotate + 90 > 360 ? rotate - 270 : rotate + 90;
            }
            fopArr.push({
                'fop': 'imageMogr2',
                'auto-orient': true,
                'strip': true,
                'rotate': rotate,
                'format': 'png'
            });
        }

        $('#myModal-img .modal-body-footer').find('a.disabled').each(function () {

            var watermark = $(this).data('watermark');
            var imageView = $(this).data('imageview');
            var imageMogr = $(this).data('imagemogr');

            if (watermark) {
                fopArr.push({
                    fop: 'watermark',
                    mode: 1,
                    image: 'http://www.b1.qiniudn.com/images/logo-2.png',
                    dissolve: 100,
                    gravity: watermark,
                    dx: 100,
                    dy: 100
                });
            }

            if (imageView) {
                var height;
                switch (imageView) {
                    case 'large':
                        height = originHeight;
                        break;
                    case 'middle':
                        height = originHeight * 0.5;
                        break;
                    case 'small':
                        height = originHeight * 0.1;
                        break;
                    default:
                        height = originHeight;
                        break;
                }
                fopArr.push({
                    fop: 'imageView2',
                    mode: 3,
                    h: parseInt(height, 10),
                    q: 100,
                    format: 'png'
                });
            }

            if (imageMogr === 'no-rotate') {
                fopArr.push({
                    'fop': 'imageMogr2',
                    'auto-orient': true,
                    'strip': true,
                    'rotate': 0,
                    'format': 'png'
                });
            }
        });

        var newUrl = Qiniu.pipeline(fopArr, key);

        var newImg = new Image();
        img.attr('src', 'images/loading.gif');
        newImg.onload = function () {
            img.attr('src', newUrl);
            img.parent('a').attr('href', newUrl);
        };
        newImg.src = newUrl;
        return false;
    });
//表单验证板块
    var validator = domForm.validate({
        rules: {
            'AdminBookingForm[booking_id]': {
                required: true
            },
            'AdminBookingForm[patient_name]': {
                required: true
            },
            'AdminBookingForm[patient_mobile]': {
                required: true
            },
            'AdminBookingForm[patient_age]': {
                required: true,
                //max: 150
            },
            'AdminBookingForm[state_id]': {
                required: true
            },
            'AdminBookingForm[city_id]': {
                required: true
            },
            'AdminBookingForm[disease_name]': {
                required: true,
                maxlength: 50
            },
            'AdminBookingForm[disease_detail]': {
                required: true,
                maxlength: 1000
            },
            'AdminBookingForm[expected_time_start]': {
                required: true
            },
            'AdminBookingForm[expected_time_end]': {
                required: true
            },
            'AdminBookingForm[expected_hospital_id]': {
                required: true
            },
            'AdminBookingForm[expected_hp_dept_id]': {
                required: true
            },
//            'AdminBookingForm[experted_doctor_name]': {
//                required: true
//            },
//            'AdminBookingForm[disease_confirm]': {
//                required: true
//            },
//            'AdminBookingForm[customer_request]': {
//                required: true
//            },
//            'AdminBookingForm[customer_diversion]': {
//                required: true
//            },
//            'AdminBookingForm[customer_agent]': {
//                required: true
//            },
            'AdminBookingForm[admin_user_id]': {
                required: true
            },
        },
        messages: {
            'AdminBookingForm[booking_id]': {
                required: '请填写预约ID'
            },
            'AdminBookingForm[patient_name]': {
                required: '请填写患者姓名'
            },
            'AdminBookingForm[patient_mobile]': {
                required: '请填写患者手机'
            },
            'AdminBookingForm[patient_age]': {
                required: '请填写患者年龄',
                //max: '患者最大年龄为150岁'
            },
            'AdminBookingForm[state_id]': {
                required: '请选择患者所在省'
            },
            'AdminBookingForm[city_id]': {
                required: '请选择患者所在市'
            },
            'AdminBookingForm[disease_name]': {
                required: '请填写病情诊断',
                maxlength: '病情诊断最多50字'
            },
            'AdminBookingForm[disease_detail]': {
                required: '请填写病情描述',
                maxlength: '病情描述最多1000字'
            },
            'AdminBookingForm[expected_time_start]': {
                required: '请选择期望手术时间开始'
            },
            'AdminBookingForm[expected_time_end]': {
                required: '请选择期望手术时间结束'
            },
            'AdminBookingForm[expected_hospital_id]': {
                required: '请选择理想医院'
            },
            'AdminBookingForm[expected_hp_dept_id]': {
                required: '请选择理想科室'
            },
//            'AdminBookingForm[experted_doctor_name]': {
//                required: '请填写理想专家'
//            },
//            'AdminBookingForm[disease_confirm]': {
//                required: '请选择是否确诊'
//            },
//            'AdminBookingForm[customer_request]': {
//                required: '请选择患者目的'
//            },
//            'AdminBookingForm[customer_diversion]': {
//                required: '请选择导流来源'
//            },
//            'AdminBookingForm[customer_agent]': {
//                required: '请选择客户来源'
//            },
            'AdminBookingForm[admin_user_id]': {
                required: '请选择业务员'
            },
        },
//        errorContainer: "div.error",
//        errorLabelContainer: $("#booking-form div .error"),
//        wrapper: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {                             //错误信息位置设置方法  
            element.parent().find("div.error").remove();
            error.appendTo(element.parent());     //这里的element是录入数据的对象  
        },
        submitHandler: function () {
            disabledBtn(btnSubmit);
            //form插件的异步无刷新提交
            actionUrl = domForm.attr('data-url-action');
            //returnUrl = domForm.attr("data-url-return");
            //alert("asdf");
            //btnSubmit.button("disable");
            //var formdata = domForm.serializeArray();
            domForm.ajaxSubmit({
                type: 'post',
                url: actionUrl,
                success: function (data) {
                    //图片上传
                    if (data.status == 'ok') {
                        fileParam.id = data.booking.id;
                        //基本数据插入成功  上传图片
                        returnUrl = returnUrl + '/' + data.booking.id;
                        uploader.start();
                        enableBtn(btnSubmit);
                    } else {
                        domForm.find("div.error").remove();
                        //append errorMsg
                        isfocus = true;
                        for (error in data.errors) {
                            errerMsg = data.errors[error];
                            inputKey = '#booking_' + error;
                            $(inputKey).focus();
                            $(inputKey).parent().after("<div class='error'>" + errerMsg + "</div> ");
                        }
                        enableBtn(btnSubmit);
                    }
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    enableBtn(btnSubmit);
                    console.log(XmlHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                complete: function () {

                }
            });
        }
    });
});
