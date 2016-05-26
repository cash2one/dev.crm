<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/createVerifyCode.js', CClientScript::POS_END);

$this->breadcrumbs = array(
    '短信',
    '创建短信验证码',
);
$urlSubmit = $this->createUrl('auth/adminCreateSmsVerifyCode');
$urlSendSmsVerifyCode = $this->createAbsoluteUrl('auth/adminSendSmsVerfyCode');
?>

<h1>创建短信验证码</h1>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'smsVerifyCode-form',
        'action' => $urlSubmit,
        'htmlOptions' => array('class' => "", 'role' => 'form', 'autocomplete' => 'off'),
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnType' => true,
            'validateOnDelay' => 500,
            'errorCssClass' => 'errorMessage',
        ),
        'enableAjaxValidation' => false,
    ));
    echo CHtml::hiddenField("smsverify[actionUrl]]", $urlSendSmsVerifyCode);
    ?>
    <div class="form-horizontal">
        <div class="form-group col-sm-7 col-md-4">
            <label > <?php echo '手机号码<br>'; ?></label>
            <div>
                <input class="form-control" name="AuthSmsVerify[mobile]" id="AuthSmsVerify_mobile"/>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-7 col-md-4">
            <label >  <?php echo '短信类型<br>'; ?></label>
            <div>
                <select class="form-control" name="AuthSmsVerify[actionType]" id="AuthSmsVerify_actionType">
                    <option value="">选择</option>
                    <?php
                    $actionType = AuthSmsVerify::model()->getActionTypeOption();
                    foreach ($actionType as $key => $value) {
                        echo "<option value='{$key}'>{$value}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="clearfix"></div>
        <br/>
        <div class="form-group col-sm-7 col-md-4">
            <input id="submitBtn" type="button" class="btn btn-primary" name="yt0" value="创建">
        </div>
        <br/><br/><br/>
        <div class="clearfix"></div>
        <div id="verifyCodeResult"></div>
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
<?php
$this->renderPartial('//adminbooking/outingCallsModal');
?>
