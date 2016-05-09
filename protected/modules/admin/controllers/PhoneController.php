<?php

class PhoneController extends AdminController {

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('view', 'callOut', 'createPhoneRecord', 'createPhoneRecordRemark', 'phoneRecordList'),
                'users' => array('@'),
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
    public function actionView() {
        $this->render('view');
    }

    public function actionCallOut($phone, $cno) {
        $this->headerUTF8();
        $model = new PhoneManager();
        $output = $model->sendPreviewOutcall($phone, $cno);
        $this->renderJsonOutput($output);
    }

    public function actionCreatePhoneRecord() {
        $output = array('status' => 'no');
        if (isset($_POST['call'])) {
            $value = $_POST['call'];
            $user = $this->getCurrentUser();
            $phoneRecord = new PhoneRecord();
            $phoneRecord->main_unique_id = $value['uniqueId'];
            $phoneRecord->callee_number = $value['mobile'];
            $phoneRecord->admin_user_id = $user->id;
            $phoneRecord->admin_user_name = $user->fullname;
            $phoneRecord->cno = $user->cno;
            if ($phoneRecord->save()) {
                $output['status'] = 'ok';
                $output['phoneRecordId'] = $phoneRecord->id;
            }
        }
        $this->renderJsonOutput($output);
    }

    public function actionCreatePhoneRecordRemark() {
        $output = array('status' => 'no');
        if (isset($_POST['call'])) {
            $value = $_POST['call'];
            $phoneRemark = new PhoneRecordRemark();
            $phoneRemark->phone_record_id = $value['phoneRecordId'];
            $phoneRemark->remark = $value['remark'];
            if ($phoneRemark->save()) {
                $output['status'] = 'ok';
            }
        }
        $this->renderJsonOutput($output);
    }

    public function actionPhoneRecordList($mobile) {
        $apisvc = new ApiViewPhoneRecordList($mobile);
        $output = $apisvc->loadApiViewData();
        $this->renderJsonOutput($output);
    }

    public function actionTest() {
        $this->headerUTF8();
        $model = new PhoneManager();
        $output = $model->sendPreviewOutcall();
//        $result = $model->sendQueueList();
//        echo $result;
        $this->renderJsonOutput($output);
    }

}
