<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/highlight.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/main.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/plupload.full.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/zh_CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/ui.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/qiniu.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/highlight.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/uploadsummary.js?v=' . time(), CClientScript::POS_END);


$type = Yii::app()->request->getQuery('type', 'mr');
if ($data->booking_type == AdminBooking::BK_TYPE_CRM) {
    $bookingId = $data->id;
} else {
    $bookingId = $data->booking_id;
}
$urlUploadFile = $this->createUrl("adminbooking/ajaxSaveAdminFile");
$user = $this->getCurrentUser();
if ($user->role == AdminUser::ROLE_BD) {
    $urlReturn = $this->createUrl('adminbooking/bdBkView', array('id' => $data->id));
} else {
    $urlReturn = $this->createUrl('adminbooking/view', array('id' => $data->id));
}
?>
<?php
if ($type == 'dc') {
    echo '<h1>上传出院小结</h1>';
} else {
    echo '<h1>上传病历图片</h1>';
}
?>

<div class="form-wrapper mt20">
    <form id="booking-form" data-url-uploadfile="<?php echo $urlUploadFile; ?>" data-url-return="<?php echo $urlReturn; ?>">
        <input id="bookingId" type="hidden" name="AdminBooking[id]" value="<?php echo $bookingId; ?>" />
        <input id="patientId" type="hidden" name="AdminBooking[patient_id]" value="<?php echo $data->patient_id; ?>" />
        <input id="creatorId" type="hidden" name="AdminBooking[creator_id]" value="<?php echo $data->creator_doctor_id; ?>" />
        <input id="reportType" type="hidden" name="AdminBooking[report_type]" value="<?php echo $type; ?>" />
        <input id="bookingType" type="hidden" name="booking_type" value="<?php echo $data->booking_type; ?>" />
        <input type="hidden" id="domain" value="http://7xq93p.com2.z0.glb.qiniucdn.com"> 
        <input type="hidden" id="uptoken_url" value="<?php echo $this->createUrl('adminbooking/ajaxUpload'); ?>">
    </form>
    <div class="mb20 row">
        <div class="col-sm-12">
            <div class="body">
                <div class="col-md-12">
                    <div id="container">
                        <a class="btn btn-default btn-lg " id="pickfiles" href="#" >
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>选择文件</span>
                        </a>
                    </div>
                </div>

                <div style="display:none" id="success" class="col-md-12">
                    <div class="alert-success">
                        队列全部文件处理完毕
                    </div>
                </div>
                <div class="col-md-12 ">
                    <table class="table table-striped table-hover text-left"   style="margin-top:40px;display:none">
                        <thead>
                            <tr>
                                <th class="col-md-4">Filename</th>
                                <th class="col-md-2">Size</th>
                                <th class="col-md-6">Detail</th>
                            </tr>
                        </thead>
                        <tbody id="fsUploadProgress">
                        </tbody>
                    </table>
                </div>
                <div>
                    <button id="btnSubmit" class="btn btn-primary">上传</button>
                </div>
            </div>
        </div>
    </div>
</div>