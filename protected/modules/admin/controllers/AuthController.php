<?php

class AuthController extends AdminController {

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('sendSmsVerifyCode', 'createVerifyCode', 'adminCreateSmsVerifyCode', 'adminSendSmsVerfyCode'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * @param string $_POST['AuthSmsVerify']['mobile']  mobile number.
     * @param string $_POST['AuthSmsVerify']['actionType']   AuthSmsVerify.action_type.
     * @throws CException
     */
    public function actionSendSmsVerifyCode() {

        $errors = array();
        try {
            if (isset($_POST['AuthSmsVerify'])) {

                $values = $_POST['AuthSmsVerify'];

                $errors = $this->validateInputs($values);

                $userIp = Yii::app()->request->getUserHostAddress();
                $mobile = $values['mobile'];
                $actionType = $values['actionType'];

                $authMgr = new AuthManager();
                $errors = $authMgr->sendAuthSmsVerifyCode($mobile, $actionType, $userIp);

                if (empty($errors)) {
                    // success.
                } else {
                    throw new CException("Error.");
                }

                $this->renderJsonOutput(array('status' => true));
            } else {
                $errors[] = "Invalid request.";
                throw new CException("Invalid request.");
            }
        } catch (CException $ex) {
            $output['status'] = false;
            $output['errors'] = $errors;
            $this->renderJsonOutput($output);
        }
    }

    public function actionCreateVerifyCode() {
        $this->render('createVerifyCode');
    }

    public function actionAdminCreateSmsVerifyCode() {
        $errors = array();
        try {
            if (isset($_POST['AuthSmsVerify'])) {
                $values = $_POST['AuthSmsVerify'];
                $userIp = Yii::app()->request->getUserHostAddress();
                $mobile = $values['mobile'];
                $actionType = $values['actionType'];
                $authMgr = new AuthManager();
                $output = $authMgr->adminSendAuthSmsVerifyCode($mobile, $actionType, $userIp);
                $this->renderJsonOutput($output);
            } else {
                $errors[] = "Invalid request.";
                throw new CException("Invalid request.");
            }
        } catch (CException $ex) {
            $errors['status'] = false;
            $this->renderJsonOutput($errors);
        }
    }

    public function actionAdminSendSmsVerfyCode() {
        $output = array('status' => 'no');
        if (isset($_POST['AuthSmsVerify'])) {
            $values = $_POST['AuthSmsVerify'];
            $mobile = $values['mobile'];
            $code = $values['code'];
            $smsMgr = new SmsManager();
            $result = $smsMgr->sendSmsVerifyCode($mobile, $code, AuthSmsVerify::model()->getExpiryDuration());
            $smsIds = $result['smsId'];
            $user = $this->getCurrentUser();
            foreach ($smsIds as $smsId) {
                $userSmsJoin = new AdminUserSmsJoin();
                $userSmsJoin->admin_user_id = $user->getId();
                $userSmsJoin->admin_user_name = $user->fullname;
                $userSmsJoin->admin_user_title = $user->title;
                $userSmsJoin->admin_booking_id = null;
                $userSmsJoin->msg_sms_id = $smsId;
                $userSmsJoin->save();
            }
            $output['status'] = 'ok';
        }
        $this->renderJsonOutput($output);
    }

    protected function validateInputs($values) {
        $errors = array();
        if (isset($values['mobile']) === false) {
            $errors[] = "Missing mobile number.";
        }
        if (isset($values['actionType']) === false) {
            $errors[] = "Missing action type.";
        }

        return $errors;
    }

}
