<?php

class AdminBookingController extends AdminController {

    public $bid;

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'ajaxCreate', 'ajaxUploadFile', 'bookingFile', 'ajaxUpdate', 'list', 'uploadsummary', 'uploadPatientCaseFile', 'admin', 'searchResult', 'adminBookingFile', 'addAdminUser', 'addBdUser', 'relateDoctor', 'relate', 'updateBookingStatus', 'ajaxUpload'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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
        $form = new AdminBookingForm;
        $data = $this->loadModel($id);
        $form->initModel($data);

        //salesorder for adminBooking
        $orderList = SalesOrder::model()->getAllByAttributes(array('bk_id' => $id, 'bk_type' => $data->booking_type));
        //跟单任务
        $taskMr = new TaskManager;
        $adminTasks['adminTasksNotDone'] = $taskMr->loadAdminTaskByAdminBookingId($id, '0');
        $adminTasks['adminTasksDone'] = $taskMr->loadAdminTaskByAdminBookingId($id, '1');
        //创建医生信息
        $creator = null;
        if (strIsEmpty($data->creator_doctor_id) == false) {
            $creator = UserDoctorProfile::model()->getByUserId($data->creator_doctor_id);
        }
        $this->render('view', array(
            'data' => $data,
            'model' => $form,
            'orderList' => $orderList,
            'adminTasks' => $adminTasks,
            'creator' => $creator
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $form = new AdminBookingForm;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $this->render('create', array(
            'model' => $form,
        ));
    }

    public function actionAjaxCreate() {
        $output = array('status' => 'no');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['AdminBookingForm'])) {
            $form = new AdminBookingForm;
            $form->attributes = $_POST['AdminBookingForm'];
            //给 医院 科室名称赋值
            if (!strIsEmpty($form->expected_hospital_id)) {
                $hospital = Hospital::model()->getById($form->expected_hospital_id);
                $form->expected_hospital_name = $hospital->getName();
            }
            if (!strIsEmpty($form->expected_hp_dept_id)) {
                $dept = HospitalDepartment::model()->getById($form->expected_hp_dept_id);
                $form->expected_hp_dept_name = $dept->getName();
            }
            if (!strIsEmpty($form->final_hospital_id)) {
                $hospital = Hospital::model()->getById($form->final_hospital_id);
                $form->final_hospital_name = $hospital->getName();
            }
            //给省市赋值
            if (!is_null($form->state_id)) {
                $state = RegionState::model()->getById($form->state_id);
                $form->patient_state = $state->getName();
            }
            if (!is_null($form->city_id)) {
                $city = RegionCity::model()->getById($form->city_id);
                $form->patient_city = $city->getName();
            }
            //给最终手术专家赋值
            if (!strIsEmpty($form->final_doctor_id)) {
                $userDoctorProfile = UserDoctorProfile::model()->getByUserId($form->final_doctor_id);
                $form->final_doctor_name = $userDoctorProfile->getName();
            }
            //最终手术时间如无则设为NULL
            if (strIsEmpty($form->final_time)) {
                $form->final_time = NULL;
            }
            //业务员信息
            $adminUser = AdminUser::model()->getById($form->admin_user_id);
            $form->admin_user_name = $adminUser->fullname;
            //设置booking type 为 bk_type_crm
            $form->booking_type = AdminBooking::BK_TYPE_CRM;
            $form->booking_status = StatCode::BK_STATUS_NEW;
            $model = new AdminBooking();
            $model->setAttributes($form->attributes);
            if ($model->save()) {
                $output['status'] = 'ok';
                $output['booking']['id'] = $model->id;
            } else {
                $output['errors'] = $model->getErrors();
                throw new CException('error saving data.');
            }
        }
        $this->renderJsonOutput($output);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $form = new AdminBookingForm();
        $model = $this->loadModel($id);
        $form->initModel($model);
        //创建医生信息
        $creator = null;
        if (strIsEmpty($model->creator_doctor_id) == false) {
            $creator = UserDoctorProfile::model()->getByUserId($model->creator_doctor_id);
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $this->render('update', array(
            'model' => $form,
            'data' => $model,
            'creator' => $creator
        ));
    }

    public function actionAjaxUpdate() {
        $output = array('status' => 'no');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['AdminBookingForm'])) {
            $value = $_POST['AdminBookingForm'];
            $form = new AdminBookingForm();
            $model = $this->loadModel($value['id']);
            $form->attributes = $_POST['AdminBookingForm'];
            //给 医院 科室名称赋值
            if (!strIsEmpty($form->expected_hospital_id)) {
                $hospital = Hospital::model()->getById($form->expected_hospital_id);
                $form->expected_hospital_name = $hospital->getName();
            }
            if (!strIsEmpty($form->expected_hp_dept_id)) {
                $dept = HospitalDepartment::model()->getById($form->expected_hp_dept_id);
                $form->expected_hp_dept_name = $dept->getName();
            }

            //给省市赋值
            $state = RegionState::model()->getById($form->state_id);
            $form->patient_state = $state->getName();
            $city = RegionCity::model()->getById($form->city_id);
            $form->patient_city = $city->getName();
            //给最终手术专家赋值
            if (!is_null($form->final_doctor_id) && !strIsEmpty($form->final_doctor_id)) {
                $userDoctorProfile = UserDoctorProfile::model()->getByUserId($form->final_doctor_id);
                $form->final_doctor_name = $userDoctorProfile->getName();
            }
            //业务员信息
            if (!strIsEmpty($form->admin_user_id)) {
                $adminUser = AdminUser::model()->getById($form->admin_user_id);
                $form->admin_user_name = $adminUser->fullname;
            }

            //最终手术时间如无则设为NULL
            if (strIsEmpty($form->final_time)) {
                $form->final_time = NULL;
            }
            $model->setAttributes($form->attributes);
            if ($model->save()) {
                $output['status'] = 'ok';
                $output['booking']['id'] = $model->id;
            } else {
                $output['errors'] = $model->getErrors();
                //throw new CException('error saving data.');
            }
        }
        $this->renderJsonOutput($output);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AdminBooking');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new AdminBooking('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['AdminBooking']))
//            $model->attributes = $_GET['AdminBooking'];
//
//        $this->render('admin', array(
//            'model' => $model,
//        ));
//    }

    public function actionAjaxUploadFile() {
        $output = array('status' => 'no');
        if (isset($_POST['AdminBookingForm'])) {
            $values = $_POST['AdminBookingForm'];
            $bookingMgr = new BookingManager();
            if (isset($values['id']) === false) {
                // ['patient']['mrid'] is missing.
                $output['status'] = 'no';
                $output['error'] = 'invalid parameters';
                $this->renderJsonOutput($output);
            }
            $bookingId = $values['id'];
            //    $userId = $this->getCurrentUserId();
            $booking = $bookingMgr->getAdminBookingById($bookingId);
            //$patientMR = $patientMgr->loadPatientMRById($mrid);
            if (isset($booking) === false) {
                // PatientInfo record is not found in db.
                $output['status'] = 'no';
                $output['errors'] = 'invalid id';
                $this->renderJsonOutput($output);
            } else {
                $output['bookingId'] = $booking->getId();
                $reportType = isset($values['report_type']) ? $values['report_type'] : StatCode::MR_REPORTTYPE_MR;
                $ret = $bookingMgr->createAdminBookingFile($booking, $reportType);
                if (isset($ret['error'])) {
                    $output['status'] = 'no';
                    $output['error'] = $ret['error'];
                    $output['file'] = '';
                } else {
                    // create file output.
                    $fileModel = $ret['filemodel'];
                    $data = new stdClass();
                    $data->id = $fileModel->getId();
                    $data->bookingId = $fileModel->getBookingId();
                    $data->fileUrl = $fileModel->getAbsFileUrl();
                    $data->tnUrl = $fileModel->getAbsThumbnailUrl();
                    //    $data->deleteUrl = $this->createUrl('patient/deleteMRFile', array('id' => $fileModel->getId()));
                    $output['status'] = 'ok';
                    $output['file'] = $data;
                    //$output['redirectUrl'] = $this->createUrl("home/index");
                }
            }
        } else {
            $output['error'] = 'missing parameters';
        }
        $this->renderJsonOutput($output);
    }

    /**
     * 异步adminbooking加载图片
     * @param type $id
     */
    public function actionAdminBookingFile($id, $type = null) {
        $values = array('report_type' => $type);
        $apisvc = new ApiViewAdminBookingFile($id, $values);
        $output = $apisvc->loadApiViewData();
        $this->renderJsonOutput($output);
    }

    public function actionList() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->addCondition("t.booking_status !=" . StatCode::BK_STATUS_INVALID);
        $criteria->order = "t.id DESC";
        $dataProvider = new CActiveDataProvider('AdminBooking', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('list', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionUploadsummary() {
        $this->render('uploadSummary');
    }

    public function actionUploadPatientCaseFile() {
        $this->render('uploadPatientCaseFile');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new AdminBooking('search');
        $model->unsetAttributes();  // clear any default values
        $form = new AdminBookingSearchForm();
        $values = array();
        if (isset($_GET['AdminBookingSearchForm'])) {
            $values = $_GET['AdminBookingSearchForm'];
        } else if (isset($_GET['AdminBooking'])) {

            $values = $_GET['AdminBooking'];
        }

        $this->render('search', array(
            'model' => $model,
            'form' => $form,
        ));
    }

    public function actionSearchResult() {
        $pbSeach = new AdminBookingSearch($_GET);
        $criteria = $pbSeach->criteria;
        $dataProvider = new CActiveDataProvider('AdminBooking', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->renderPartial('searchResult', array(
            'dataProvider' => $dataProvider,
        ));
    }

    //分配业务员
    public function actionAddAdminUser() {
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['AdminBookingForm'])) {
            $value = $_POST['AdminBookingForm'];
            $form = new AdminBookingForm();
            $adminbookingId = $value['id'];
            $model = $this->loadModel($adminbookingId);
            $form->attributes = $_POST['AdminBookingForm'];
            //业务员信息
            if (!strIsEmpty($form->admin_user_id)) {
                $model->admin_user_id = $form->admin_user_id;
                $adminUser = AdminUser::model()->getById($form->admin_user_id);
                $model->admin_user_name = $adminUser->fullname;
            }
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $adminbookingId));
            }
        }
        //$this->renderJsonOutput($output);
    }

    //授权地推/KA
    public function actionAddBdUser() {
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['AdminBookingForm'])) {
            $value = $_POST['AdminBookingForm'];
            $form = new AdminBookingForm();
            $adminbookingId = $value['id'];
            $model = $this->loadModel($adminbookingId);
            $form->attributes = $_POST['AdminBookingForm'];
            //业务员信息
            if (!strIsEmpty($form->bd_user_id)) {
                $model->bd_user_id = $form->bd_user_id;
                $adminUser = AdminUser::model()->getById($form->bd_user_id);
                $model->bd_user_name = $adminUser->fullname;
            }
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $adminbookingId));
            }
        }
        //$this->renderJsonOutput($output);
    }

    //修改booking status
    public function actionUpdateBookingStatus() {
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['AdminBookingForm'])) {
            $value = $_POST['AdminBookingForm'];
            $form = new AdminBookingForm();
            $adminbookingId = $value['id'];
            $model = $this->loadModel($adminbookingId);

            $form->attributes = $_POST['AdminBookingForm'];
            //booking status信息
            if (!strIsEmpty($form->booking_status)) {
                $model->booking_status = $form->booking_status;
                //如果设为无效的，则删除所有任务
                if ($form->booking_status == StatCode::BK_STATUS_INVALID) {
                    $taskMgr = new TaskManager();
                    $taskMgr->deleteAdminTaskJoinByAdminBookingId($adminbookingId);
                }
                //修改原始的booking中的状态
                if ($model->booking_type == AdminBooking::BK_TYPE_BK) {
                    $booking = Booking::model()->getById($model->booking_id);
                    $booking->bk_status = $form->booking_status;
                } else if ($model->booking_type == AdminBooking::BK_TYPE_PB) {
                    $booking = PatientBooking::model()->getById($model->booking_id);
                    $booking->status = $form->booking_status;
                }
                if (isset($booking)) {
                    $booking->save();
                }
            }
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $adminbookingId));
            }
        }
        //$this->renderJsonOutput($output);
    }

    /*
     * 预约关联医生doctorProfile.user_id
     */

    public function actionRelateDoctor($bid) {
//        $model = $this->loadModel($bid);
        $this->bid = $bid;
        $model = new UserDoctorProfile('search');
        $model->unsetAttributes();
        if (isset($_GET['UserDoctorProfile']))
            $model->attributes = $_GET['UserDoctorProfile'];

        $this->render('relateDoctor', array(
            'model' => $model,
            'bid' => $bid,
        ));
    }

    public function actionRelate($bid, $userid, $name) {
        $this->headerUTF8();
        if (isset($bid) && isset($userid) && isset($name)) {
            $model = $this->loadModel($bid);
            $model->setFinalDoctorId($userid);
            $model->setFinalDoctorName($name);
            if ($model->save()) {
                $user = User::model()->getById($userid);
                $sendMgs = new SmsManager();
                $data = new stdClass();
                $data->refno = $model->ref_no;
                $data->id = $model->getId();
                $sendMgs->sendSmsBookingAssignDoctor($user->username, $data);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        throw new CHttpException(404, 'The requested page does not exist.');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AdminBooking the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = AdminBooking::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param AdminBooking $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-booking-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxUpload() {
        $url = 'http://192.168.31.119/file.myzd.com/api/tokentest';
        $data = $this->send_get($url);
        $output = array('uptoken' => $data->uploadToken);
        $this->renderJsonOutput($output);
    }

}
