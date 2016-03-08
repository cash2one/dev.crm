<?php
$bookingId = Yii::app()->request->getQuery('id', '');
$bktype = Yii::app()->request->getQuery('bktype', '');
if ($bktype == AdminBooking::BK_TYPE_CRM) {
    $urlUploadFile = $this->createUrl("adminbooking/ajaxUploadFile");
} else if ($bktype == AdminBooking::BK_TYPE_PB) {
    $urlUploadFile = $this->createUrl("patientbooking/ajaxUploadMRFile");
} else {
    $urlUploadFile = $this->createUrl("booking/ajaxUploadFile");
}
$urlReturn = $this->createUrl('adminbooking/view', array('id' => $bookingId));
?>
<h1>上传出院小结</h1>
<div class="form-wrapper mt20">
    <form id="booking-form" data-bkType="<?php echo $bktype; ?>" data-url-uploadfile="<?php echo $urlUploadFile; ?>" data-url-return="<?php echo $urlReturn; ?>">
        <input id="bookingId" type="hidden" name="AdminBooking[id]" value="<?php echo $bookingId; ?>" />             
        <input id="reportType" type="hidden" name="AdminBooking[report_type]" value="dc" />
    </form>
    <div class="mb20 row">
        <div class="col-sm-6">
            <?php $this->renderPartial('_uploadFile'); ?>
        </div>
    </div>
</div>