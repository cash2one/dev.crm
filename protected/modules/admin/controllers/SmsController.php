<?php

class SmsController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'rights',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view', 'search', 'searchResult', 'sendSms', 'ajaxSendSms', 'ajaxLoadSmsTemplate', 'sendTemplateSms'),
//                'users' => array('test'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $data = MsgSmsLog::model()->getByAttributes(array('id' => $id), array('adminUserSmsJoin'));
        $this->render('view', array(
            'model' => $data,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AdminUser the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = MsgSmsLog::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param AdminUser $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSendSms() {
        $this->render('sendSms');
    }

    public function actionAjaxSendSms() {
        $output = array('status' => 'no');
        if (isset($_POST['sms'])) {
            $values = $_POST['sms'];
            $mobile = $values['mobile'];
            $content = $values['content'];
            $adminBookingId = null;
            if (isset($values['adminBookingId'])) {
                $adminBookingId = $values['adminBookingId'];
            }
            $smsMgr = new SmsManager();
            $result = $smsMgr->sendSmsCustomize($mobile, $content);
            $smsIds = $result['smsId'];
            $user = $this->getCurrentUser();
            foreach ($smsIds as $smsId) {
                $userSmsJoin = new AdminUserSmsJoin();
                $userSmsJoin->admin_user_id = $user->getId();
                $userSmsJoin->admin_user_name = $user->fullname;
                $userSmsJoin->admin_user_title = $user->title;
                $userSmsJoin->admin_booking_id = $adminBookingId;
                $userSmsJoin->msg_sms_id = $smsId;
                $userSmsJoin->save();
            }
            $output['status'] = 'ok';
        }
        $this->renderJsonOutput($output);
    }

    public function actionAjaxLoadSmsTemplate() {
        $output = array('status' => 'no');
        $smsMgr = new SmsManager();
        $smsTemplate = $smsMgr->loadMsgSmsTemplateByIsNotAuto();
        $output['status'] = 'ok';
        $output['template'] = $smsTemplate;
        $this->renderJsonOutput($output);
    }

    public function actionSendTemplateSms() {
        $output['status'] = 'no';
        if (isset($_POST['sms'])) {
            $value = $_POST['sms'];
            $code = $value['code'];
            $smsMgr = new SmsManager();
            $adminBookingId = $value['adminBookingId'];
            $to = $value['mobile'];
            $data = new stdClass();
            switch ($code) {
                case 'service.phone.not':
                    //电话无人接听或者挂断
                    $data->disease = $value['disease'];
                    $data->hospital = $value['hospital'];
                    $data->expert = $value['expert'];
                    $result = $smsMgr->sendSmsServicePhoneNot($to, $data);
                    break;
                case 'service.distrust':
                    //对平台不信任
                    $result = $smsMgr->sendSmsServiceDistrust($to);
                    break;
                case 'service.reject':
                    //不接受平台服务
                    $result = $smsMgr->sendSmsServiceReject($to);
                    break;
                case 'wx.add':
                    //添加微信
                    $data->weixin = $value['text'];
                    $result = $smsMgr->sendSmsWeixinAdd($to, $data);
                    break;
                case 'pay.alipay':
                    //汇款方式支付宝
                    $data->money = $value['text'];
                    $result = $smsMgr->sendSmsPayAlipay($to, $data);
                    break;
                case 'pay.alipay':
                    //汇款方式银行汇款
                    $data->money = $value['text'];
                    $result = $smsMgr->sendSmsPayBank($to, $data);
                    break;
            }
            $smsIds = $result['smsId'];
            $user = $this->getCurrentUser();
            foreach ($smsIds as $smsId) {
                $userSmsJoin = new AdminUserSmsJoin();
                $userSmsJoin->admin_user_id = $user->getId();
                $userSmsJoin->admin_user_name = $user->fullname;
                $userSmsJoin->admin_user_title = $user->title;
                $userSmsJoin->admin_booking_id = $adminBookingId;
                $userSmsJoin->msg_sms_id = $smsId;
                $userSmsJoin->save();
            }
            
            $output['status'] = 'ok';
            $this->renderJsonOutput($output);
        }
    }

}
