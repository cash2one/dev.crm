<?php

class AdminBookingController extends AdminController {

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
                'actions' => array('create', 'update', 'ajaxCreate', 'ajaxUploadFile', 'bookingFile', 'ajaxUpdate','list','uploadsummary'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
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
            if (!is_null($form->expected_hospital_id)) {
                $hospital = Hospital::model()->getById($form->expected_hospital_id);
                $form->expected_hospital_name = $hospital->getName();
            }
            if (!is_null($form->expected_hp_dept_id)) {
                $dept = HospitalDepartment::model()->getById($form->expected_hp_dept_id);
                $form->expected_hp_dept_name = $dept->getName();
            }
            //给省市赋值
            if (!is_null($form->patient_state)) {
                $state = RegionState::model()->getById($form->patient_state);
                $form->patient_state = $state->getName();
            }
            if (!is_null($form->patient_city)) {
                $city = RegionCity::model()->getById($form->patient_city);
                $form->patient_city = $city->getName();
            }
            //给最终手术专家赋值
            $userDoctorProfile = UserDoctorProfile::model()->getByUserId($form->final_doctor_id);
            $form->final_doctor_name = $userDoctorProfile->getName();
            //业务员信息
            $adminUser = AdminUser::model()->getById($form->admin_user_id);
            $form->admin_user_name = $adminUser->username;

            $model = new AdminBooking();
            $model->setAttributes($form->attributes);
            if ($model->save()) {
                $output['status'] = 'ok';
                $output['booking']['id'] = $model->id;
            } else {
                $output['errors'] = $model->getErrors();
                var_dump($output['errors']);
                exit;
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $this->render('update', array(
            'model' => $form,
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
            if ($form->expected_hospital_id != $model->expected_hospital_id) {
                $hospital = Hospital::model()->getById($form->expected_hospital_id);
                $form->expected_hospital_name = $hospital->getName();
            }
            if ($form->expected_hp_dept_id != $model->expected_hp_dept_id) {
                $dept = HospitalDepartment::model()->getById($form->expected_hp_dept_id);
                $form->expected_hp_dept_name = $dept->getName();
            }
            //给省市赋值
            if ($form->patient_state != $model->patient_state) {
                $state = RegionState::model()->getById($form->patient_state);
                $form->patient_state = $state->getName();
            }
            if ($form->patient_city != $model->patient_city) {
                $city = RegionCity::model()->getById($form->patient_city);
                $form->patient_city = $city->getName();
            }
            //给最终手术专家赋值
            if ($form->final_doctor_id != $model->final_doctor_id) {
                $userDoctorProfile = UserDoctorProfile::model()->getByUserId($form->final_doctor_id);
                $form->final_doctor_name = $userDoctorProfile->getName();
            }

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
    public function actionAdmin() {
        $model = new AdminBooking('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AdminBooking']))
            $model->attributes = $_GET['AdminBooking'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

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
            $booking = $bookingMgr->loadBookingMobileById($bookingId);
            //$patientMR = $patientMgr->loadPatientMRById($mrid);
            if (isset($booking) === false) {
                // PatientInfo record is not found in db.
                $output['status'] = 'no';
                $output['errors'] = 'invalid id';
                $this->renderJsonOutput($output);
            } else {
                $output['bookingId'] = $booking->getId();
                $ret = $bookingMgr->createBookingFile($booking);
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
     * 异步加载图片
     * @param type $id
     */
    public function actionBookingFile($id) {
        $apisvc = new ApiViewBookingFile($id);
        $output = $apisvc->loadApiViewData();
        $this->renderJsonOutput($output);
    }

    public function actionList() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
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

    public function actionUploadsummary(){
        $this->render('uploadSummary');
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

}
