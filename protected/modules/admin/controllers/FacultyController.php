<?php

class FacultyController extends AdminController {
 
    public $model;
    public $model_fh_join;
    public $model_fd_join;

    public function filterFacultyContext($filterChain) {
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->loadModel($id);

        $filterChain->run();
    }

    public function filterFacultyHospitalJoinContext($filterChain) {
        $fid = null;
        $hid = null;
        if (isset($_GET['fid']) && isset($_GET['hid'])) {
            $fid = $_GET['fid'];
            $hid = $_GET['hid'];
        } else if (isset($_POST['fid']) && isset($_POST['hid'])) {
            $fid = $_POST['fid'];
            $hid = $_POST['hid'];
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        $this->loadFacultyHospitalJoin($fid, $hid);

        $filterChain->run();
    }

    public function filterFacultyDoctorJoinContext($filterChain) {
        $fid = null;
        $did = null;
        if (isset($_GET['fid']) && isset($_GET['did'])) {
            $fid = $_GET['fid'];
            $did = $_GET['did'];
        } else if (isset($_POST['fid']) && isset($_POST['did'])) {
            $fid = $_POST['fid'];
            $did = $_POST['did'];
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        $this->loadFacultyDoctorJoin($fid, $did);

        $filterChain->run();
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'facultyContext + update delete addHospital addDoctor',
            'FacultyHospitalJoinContext + updateHospital deleteHospital',
            'FacultyDoctorJoinContext + updateDoctor deleteDoctor'
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
            /*
              array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions' => array('create', 'update'),
              'users' => array('@'),
              ),
             * 
             */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'addDoctor', 'updateDoctor', 'deleteDoctor', 'addHospital', 'updateHospital', 'deleteHospital'),
                'users' => array('superbeta'),
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
        //$model = $this->loadModel($id, array('facultyHospitals', 'facultyDoctors'));
        $model = $this->loadModel($id);
        $model->getHospitals();
        $model->getDoctors();
        $this->render('view', array(
            'model' => $model
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Faculty;
        $model->display_order = 999;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Faculty'])) {
            $model->attributes = $_POST['Faculty'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Faculty'])) {
            $model->attributes = $_POST['Faculty'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
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
     *  Adds a FacultyHospitalJoin relation to this faculty.
     * @param type $id Faculty.id
     */
    public function actionAddHospital($id) {
        $model = $this->loadModel($id, array('facultyHospitals' => array('order' => 'name ASC')));
        $fhJoin = new FacultyHospitalJoin();
        $fhJoin->faculty_id = $model->id;
        $fhJoin->display_order = 9999;
        $fhJoin->visible = 1;

        // Get existing doctor list for current faculty.
        $fhJoin->setExistingHospitalList($model->facultyHospitals);
        // Get hospitals that are not in current faculty, from list of all hospitals.
        $fhJoin->loadOptionsHospital();

        $this->performAjaxValidation($fhJoin);

        if (isset($_POST['FacultyHospitalJoin'])) {
            $values = $_POST['FacultyHospitalJoin'];
            $fhJoin->attributes = $values;

            if ($fhJoin->save()) {
                //go to faculty/view.
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('addHospital', array(
            'model' => $model,
            'fhJoin' => $fhJoin
        ));
    }

    public function actionUpdateHospital($fid, $hid) {
        $fhJoin = $this->loadFacultyHospitalJoin($fid, $hid, array('fhjFaculty', 'fhjHospital'));
        if (isset($_POST['FacultyHospitalJoin'])) {
            $values = $_POST['FacultyHospitalJoin'];
            $fhJoin->attributes = $values;
            if ($fhJoin->save()) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $fhJoin->getFacultyId()));
            }
        }
        $this->render('updateHospital', array(
            'model' => $fhJoin
        ));
    }

    /**
     *
     * @param type $id FacultyHospitalJoin.id
     */
    public function actionDeleteHospital($fid, $hid) {

        $fhJoin = $this->loadFacultyHospitalJoin($fid, $hid);
        $facultyId = $fhJoin->faculty_id;
        $fhJoin->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $facultyId));
        }
    }

    /**
     * Adds a FacultyDoctorJoin relation to this faculty.
     * @param type $id Faculty.id
     */
    public function actionAddDoctor($id) {
        $model = $this->loadModel($id, array('facultyDoctors' => array('order' => 'fullname ASC')));
        $fdJoin = new FacultyDoctorJoin();
        $fdJoin->faculty_id = $model->id;
        $fdJoin->display_order = 99999;
        $fdJoin->visible = 0;

        // Get existing doctor list for current faculty.
        $fdJoin->setExistingDoctorList($model->facultyDoctors);
        // Get doctors that are not in current faculty, from list of all doctors.
        $fdJoin->loadOptionsDoctor();

        $this->performAjaxValidation($fdJoin);

        if (isset($_POST['FacultyDoctorJoin'])) {
            $values = $_POST['FacultyDoctorJoin'];
            $fdJoin->attributes = $values;

            if ($fdJoin->save()) {
                //go to faculty/view.
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('addDoctor', array(
            'model' => $model,
            'fdJoin' => $fdJoin
        ));
    }

    public function actionUpdateDoctor($fid, $did) {
        $fdJoin = $this->loadFacultyDoctorJoin($fid, $did, array('fdjFaculty', 'fdjDoctor'));
        if (isset($_POST['FacultyDoctorJoin'])) {
            $values = $_POST['FacultyDoctorJoin'];
            $fdJoin->attributes = $values;
            if ($fdJoin->save()) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $fdJoin->getFacultyId()));
            }
        }
        $this->render('updateDoctor', array(
            'model' => $fdJoin
        ));
    }

    /**
     *
     * @param type $id FacultyDoctorJoin.id
     */
    public function actionDeleteDoctor($fid, $did) {

        $dfJoin = $this->loadFacultyDoctorJoin($fid, $did);
        $facultyId = $dfJoin->faculty_id;
        $dfJoin->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $facultyId));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Faculty', array(
            'criteria' => array('order' => 'display_order ASC'),
            'pagination' => array(
                'pageSize' => 20,
            //  'pageVar' => 'page'
            ),
                )
        );
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Faculty('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Faculty']))
            $model->attributes = $_GET['Faculty'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Faculty the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $with = array()) {
        if ($this->model === null) {
            $this->model = Faculty::model()->getById($id, $with);
            if ($this->model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $this->model;
    }

    public function loadFacultyHospitalJoin($fid, $hid, $with = null) {
        if ($this->model_fh_join === null) {
            $this->model_fh_join = FacultyHospitalJoin::model()->getByFacultyIdAndHospitalId($fid, $hid, $with);
            if ($this->model_fh_join === null) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
        return $this->model_fh_join;
    }

    public function loadFacultyDoctorJoin($fid, $did) {
        if ($this->model_fd_join === null) {
            $this->model_fd_join = FacultyDoctorJoin::model()->getByFacultyIdAndDoctorId($fid, $did);
            if ($this->model_fd_join === null) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
        return $this->model_fd_join;
    }

    /**
     * Performs the AJAX validation.
     * @param Faculty $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'faculty-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
