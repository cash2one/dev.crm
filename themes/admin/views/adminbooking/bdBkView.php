<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/adminbooking.css");

if ($data->booking_type != AdminBooking::BK_TYPE_PB) {
    echo '没有权限';
} else {
//设置订单creater信息
    $bookingCreator = new stdClass();
    if (is_null($creator) == false) {
        $bookingCreator->name = $creator->name;
        $bookingCreator->mobile = $creator->mobile == null ? '无' : '<a target="_blank" href="' . $this->createUrl('user/view', array('id' => $creator->user_id)) . '">' . $creator->mobile . '</a>';
        $bookingCreator->cTitle = $creator->clinical_title == null ? '无' : $creator->getClinicalTitle(true);
        $bookingCreator->stateName = $creator->state_name == null ? '无' : $creator->state_name;
        $bookingCreator->cityName = $creator->city_name == null ? '无' : $creator->city_name;
        $bookingCreator->hpName = $creator->hospital_name == null ? '无' : $creator->hospital_name;
        $bookingCreator->hpDeptName = $creator->hp_dept_name == null ? '无' : $creator->hp_dept_name;
    } else {
        $bookingCreator->name = '无';
        $bookingCreator->mobile = '无';
        $bookingCreator->cTitle = '无';
        $bookingCreator->stateName = '无';
        $bookingCreator->cityName = '无';
        $bookingCreator->hpName = '无';
        $bookingCreator->hpDeptName = '无';
    }

    if ($data->booking_type == AdminBooking::BK_TYPE_BK) {
        $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $data->patient_id . '&bookingId=' . $data->booking_id;
        //$urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadbookingmr?userId=' . $data->patient_id . '&bookingId=' . $data->booking_id. '&reportType=dc';
        $urlLoadDCFiles = '';
        $urlDeleteFile = $this->createUrl('booking/deleteBookingFile', array('id' => ''));
    } else if ($data->booking_type == AdminBooking::BK_TYPE_PB) {
        $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadpatientmr?userId=' . $data->creator_doctor_id . '&patientId=' . $data->patient_id . '&reportType=' . StatCode::MR_REPORTTYPE_MR;
        $urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadpatientmr?userId=' . $data->creator_doctor_id . '&patientId=' . $data->patient_id . '&reportType=' . StatCode::MR_REPORTTYPE_DA;
        $urlDeleteFile = $this->createUrl('patient/deletepatientmr', array('id' => '')); //add file_id;
    } else {
        $urlLoadFiles = 'http://file.mingyizhudao.com/api/loadadminmr?abId=' . $data->id . '&reportType=' . StatCode::MR_REPORTTYPE_MR;
        $urlLoadDCFiles = 'http://file.mingyizhudao.com/api/loadadminmr?abId=' . $data->id . '&reportType=' . StatCode::MR_REPORTTYPE_DA;
        $urlDeleteFile = $this->createUrl('adminbooking/ajaxDeleteAdminFile', array('id' => '')); //add file_id;
    }

    $urlUploadSummary = $this->createUrl('adminbooking/uploadsummary', array('id' => $data->id, 'type' => StatCode::MR_REPORTTYPE_DA));
    $urlOrderView = $this->createAbsoluteUrl('order/view', array('id' => ''));
    $orderList = isset($orderList) ? $orderList : null;
    ?>
    <style>
        .header-menu>a.btn{margin-bottom: 10px;}
    </style>
    <h1 class="">预约</h1>
    <div class="mt30 header-menu">
        <a href="<?php echo $urlUploadSummary; ?>" class="btn btn-primary" <?php echo $data->work_schedule == StatCode::BK_STATUS_NULLIFY ? 'disabled' : ''; ?>>上传出院小结</a>
    </div>
    <style>
        .border-bottom{border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;}
        .tab-header{display: inline-block;min-width: 6em;}
        .with20{width: 20%;float: left;}
        .form-group{width: auto;}
    </style>
    <div class="mt30">
        <div class="row">
            <div class="col-md-4 col-lg-4 border-bottom">
                <span class="tab-header">工作进度：</span><?php
                echo $data->getWorkSchedule() == null ? '<span class="color-blue">未填写</span>' : $data->getWorkSchedule();
                ?>
            </div>
            <div class="col-md-4 col-lg-4 border-bottom">
                <span>对接人：</span><?php echo $data->contact_name == null ? '<span class="color-blue">未填写</span>' : $data->contact_name; ?>
            </div>
            <div class="col-md-4 col-lg-4 border-bottom">
                <span>业务员：</span><?php echo $data->admin_user_name == null ? '<span class="color-blue">未填写</span>' : $data->admin_user_name; ?>
            </div>
        </div>
    </div>
    <div class="mt30">
        <div class="row">
            <div class="col-md-4 border-bottom">
                <span class="tab-header">客户编号：</span><?php echo $data->ref_no == null ? '<span class="color-blue">未填写</span>' : $data->ref_no; ?>
            </div>
            <div class="col-md-4 border-bottom">
                <span class="tab-header">患者姓名：</span><?php echo $data->patient_name == null ? '<span class="color-blue">未填写</span>' : $data->patient_name; ?>
            </div>
            <div class="col-md-4 border-bottom">
                <span class="tab-header">年龄：</span><?php echo $data->patient_age == null ? '<span class="color-blue">未填写</span>' : $data->patient_age; ?>
            </div>
            <div class="col-md-4 border-bottom">
                <span class="tab-header">性别：</span><?php echo $data->getPatientGender() == null ? '<span class="color-blue">未填写</span>' : $data->getPatientGender(); ?>
            </div>
            <div class="col-md-8 border-bottom">
                <span class="tab-header">疾病名称：</span><?php echo $data->disease_name == null ? '<span class="color-blue">未填写</span>' : $data->disease_name; ?>
            </div>
            <div class="col-md-12 border-bottom">
                <span class="tab-header">病情描述：</span><?php echo $data->disease_detail == null ? '<span class="color-blue">未填写</span>' : $data->disease_detail; ?>
            </div>
        </div>
    </div>

    <div class="mt30">
        <div class="row">
            <div class="col-md-4 border-bottom">
                <span class="tab-header">推送医生姓名：</span><?php echo $bookingCreator->name; ?>
            </div>
            <div class="col-md-4 border-bottom">
                <span class="tab-header">推送医生所在科室：</span><?php echo $bookingCreator->hpDeptName; ?>
            </div>
            <div class="col-md-4 border-bottom">
                <span class="tab-header">就诊方式：</span><?php echo $data->getTravelType(true) == null ? '无' : $data->getTravelType(true); ?>
            </div>
            <div class="col-md-6 col-lg-4 border-bottom">
                <span class="tab-header">理想医院：</span><?php echo $data->expected_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hospital_name; ?>
            </div>
            <div class="col-md-6 col-lg-4 border-bottom">
                <span class="tab-header">理想科室：</span><?php echo $data->expected_hp_dept_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_hp_dept_name; ?>
            </div>
            <div class="col-md-6 col-lg-4 border-bottom">
                <span class="tab-header">理想专家：</span><?php echo $data->expected_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->expected_doctor_name; ?>
            </div>
            <div class="col-md-6 col-lg-4 border-bottom">
                <span class="tab-header">最终手术的医院：</span><?php echo $data->final_hospital_name == null ? '<span class="color-blue">未填写</span>' : $data->final_hospital_name; ?>
            </div>
            <div class="col-md-6 col-lg-4 border-bottom">
                <span class="tab-header">最终手术的专家：</span><?php echo $data->final_doctor_name == null ? '<span class="color-blue">未填写</span>' : $data->final_doctor_name; ?>
            </div>
            <div class="col-md-6 col-lg-4 border-bottom">
                <span class="tab-header">最终手术时间：</span><?php echo $data->final_time == null ? '<span class="color-blue">未填写</span>' : $data->final_time; ?>
            </div>
        </div>
    </div>
    <div class="mt30">
        <div class="row">
            <div class="col-sm-12 border-bottom">
                <span>补充说明：</span><?php echo $data->cs_explain == null ? '<span class="color-blue">未填写</span>' : $data->cs_explain; ?>
            </div>
        </div>
    </div>

    <div style="mt30">
        <h3>订单</h3>
        <?php
        if (arrayNotEmpty($orderList)) {
            ?>
            <table class="table" id="yw0">
                <tbody>
                    <tr class="odd">
                        <th>订单号</th>
                        <th>订单类型</th>
                        <th>金额</th>
                        <th>支付情况</th>
                        <th>支付时间</th>
                    </tr>
                    <?php foreach ($orderList as $order): ?>
                        <?php
                        if (isset($order)):
                            ?>
                            <tr class="odd">
                                <td><?php echo $order->getRefNo(); ?></td>
                                <td><?php echo $order->getOrderType(); ?></td>
                                <td><?php echo $order->getFinalAmount(); ?></td>
                                <td><?php echo $order->getIsPaid(); ?></td>
                                <td><?php echo $order->date_closed == null ? '未支付' : $order->date_closed; ?></td>
                            <?php endif; ?>
                            <?php
                        endforeach;
                        ?>
                </tbody>
            </table>
            <?php
        }
        if (!arrayNotEmpty($orderList)) {
            echo '<p>未生成订单</p>';
        }
        ?>
    </div>
    <div class="summary mt30">
        <h3>出院小结&nbsp;&nbsp;&nbsp;</h3>
        <div class="row bookingDcImgList">

        </div>
    </div>

    <script>
        $(document).ready(function () {
            var urlLoadFiles = '<?php echo $urlLoadFiles; ?>';
            var urlLoadDcFiles = '<?php echo $urlLoadDCFiles; ?>';
            //ajaxLoadFiles(urlLoadFiles, $('.bookingImgList'));
            ajaxLoadFiles(urlLoadDcFiles, $('.bookingDcImgList'));
        });
        //加载图片
        function ajaxLoadFiles(urlLoadFiles, fileDom) {
            $.ajax({
                url: urlLoadFiles,
                success: function (data) {
                    if (data.status == 'ok') {
                        setFileHtml(data.results.files, fileDom);
                    }
                }
            });
        }
        function setFileHtml(files, fileDom) {
            var innerHtml = '';
            if (files && files.length > 0) {
                innerHtml = '';
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    innerHtml += '<div class="col-md-4 col-lg-2 mt10 docImg"><a data-toggle="modal" data-target="#showImgModal" data-src="' + file.absFileUrl + '"><img src="' + file.absFileUrl + '"/></a><div><a class="deleteFile" href="<?php echo $urlDeleteFile; ?>/' + file.id + '">删除图片</a></div><div class="fileDate mt5">' + file.dateCreated + '</div></div>';
                }
            } else {
                innerHtml = '<div class="col-sm-12 mt10">未上传图片</div>';
            }
            fileDom.html(innerHtml);
            $('.deleteFile').click(function (e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('href');
                if (confirm('确定删除这张图片?')) {
                    ajaxDeleteFile(deleteUrl);
                }
            });
        }
        function ajaxDeleteFile(deleteUrl) {
            $.ajax({
                url: deleteUrl,
                success: function (data) {
                    if (data.status == 'ok') {
                        location.reload();
                    } else {
                        alert('删除失败!');
                    }
                }
            });
        }
    </script>
<?php }
?>