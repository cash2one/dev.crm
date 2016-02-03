<?php
$urlUploadFile = $this->createUrl("adminbooking/ajaxUploadFile");
$bookingId = Yii::app()->request->getQuery('id', '');
$urlReturn = $this->createUrl('adminbooking/view', array('id' => $bookingId));
?>
<h1>上传出院小结</h1>
<div class="form-wrapper mt20">
    <form id="booking-form" data-url-uploadfile="<?php echo $urlUploadFile; ?>" data-url-return="<?php echo $urlReturn; ?>">
        <input id="bookingId" type="hidden" name="AdminBookingForm[id]" value="<?php echo $bookingId; ?>" />                
    </form>
    <div class="mb20 row">
        <div class="col-sm-6">
            <?php $this->renderPartial('_uploadFile'); ?>
        </div>
    </div>
</div>