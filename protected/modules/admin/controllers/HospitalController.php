<?php

class HospitalController extends AdminController {

    public $model;
    public $model_hf_join;

    /**
     * @param int $id Hospital.id from either GET or POST.     
     */
    public function filterHospitalContext($filterChain) {
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
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->loadFacultyHospitalJoin($id);

        $filterChain->run();
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'hospitalContext + update delete addFaculty',
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
            /*
              array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions' => array('view', 'create', 'update', 'admin', 'delete', 'createHF', 'deleteHF'),
              'users' => array('@'),
              ),
             */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'addFaculty', 'addDepartment','list','deleteDepartment','searchResult'),
//                'users' => array('superbeta'),
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
        //$model = $this->loadModel($id, array('hospitalFacultyJoin'));
        $model = $this->loadModel($id, array('hospitalDepartments'));
        $this->render('view', array(
            'model' => $model
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        // $model = new Hospital;
        $form = new HospitalForm();
        $form->initModel();

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($form);

        if (isset($_POST['HospitalForm'])) {
            $form->attributes = $_POST['HospitalForm'];
            $hospitalMgr = new HospitalManager();
            $hospitalMgr->createHospital($form);
            if ($form->hasErrors() === false) {
                $this->redirect(array('view', 'id' => $form->id));
            }
        }

        $this->render('create', array(
            'model' => $form
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $form = new HospitalForm();
        $form->initModel($model);
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($form);

        if (isset($_POST['HospitalForm'])) {
            $form->attributes = $_POST['HospitalForm'];
            $hospitalMgr = new HospitalManager();
            $hospitalMgr->updateHospital($form);

            if ($form->hasErrors() === false) {
                $this->redirect(array('view', 'id' => $form->id));
            }
        }

        $this->render('update', array(
            'model' => $form,
        ));
    }

    public function actionList() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->order = "t.id DESC";
        $dataProvider = new CActiveDataProvider('Hospital', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('list', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddFaculty($id) {
        $model = $this->loadModel($id, array('hospitalFaculties'));
        $fhJoin = new FacultyHospitalJoin();
        $fhJoin->hospital_id = $model->id;
        $fhJoin->setExistingFacultyList($model->getFaculties());
        $fhJoin->loadOptionsFaculty();

        $this->performAjaxValidation($fhJoin);

        if (isset($_POST['FacultyHospitalJoin'])) {
            $values = $_POST['FacultyHospitalJoin'];
            $fhJoin->attributes = $values;

            if ($fhJoin->save()) {
                //go to hospital/view.
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('addFaculty', array(
            'model' => $model,
            'fhJoin' => $fhJoin
        ));
    }

    /*
      public function actionDeleteHF($id) {
      $hfJoin = $this->loadFacultyHospitalJoin($id);
      $hospitalId = $hfJoin->hospital_id;
      $hfJoin->delete();
      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (!isset($_GET['ajax'])) {
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $hospitalId));
      }
      }
     */

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $hospitalMgr = new HospitalManager();
        $hospitalMgr->deleteHospital($model);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        // echo $this->layout;
        $dataProvider = new CActiveDataProvider('Hospital', array(
            'criteria' => array(
                'with' => array('hospitalFaculties')
            ),
            'pagination' => array(
                'pageSize' => 20,
            //  'pageVar' => 'page'
            ),
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Hospital('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Hospital']))
            $model->attributes = $_GET['Hospital'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * ajax验证科室名是否已存在
     * @param type $name
     */
    public function actionAjaxCheckDepartment($name) {
        $hospitalMgr = new HospitalManager();
        $output['name'] = $hospitalMgr->checkDepartment($name);
        $this->renderJsonOutput($output);
    }

    /**
     * 添加医院科室
     */
    public function actionAddDepartment($id) {
        $form = new DepartmentForm();
        $model = $this->loadModel($id, array('hospitalDepartments'));
        $form->hospital_id = $model->id;
        $form->setOptionsHospitalDepartment($model->getDepartments());
        $this->performAjaxValidation($form);
        //保存操作
        if (isset($_POST['DepartmentForm'])) {
            $form->attributes = $_POST['DepartmentForm'];
            $hospitalMgr = new HospitalManager();
            $hospitalMgr->addDepartment($form);
            if ($form->hasErrors() === false) {
                //添加成功 返回页面
                $this->redirect(array('view', 'id' => $form->hospital_id));
            }
        }
        $this->render('addDepartment', array(
            'model' => $form,
        ));
    }

    /**
     * 删除科室
     */
    public function actionDeleteDepartment($id) {
        $output['status'] = false;
        $hospitalDepartment = HospitalDepartment::model()->getById($id);
        $doctors = Doctor::model()->getAllByAttributes(array('hp_dept_id'=>$hospitalDepartment->id));
        if(arrayNotEmpty($doctors)){
            $output['error'] = '该科室有关联医生';
        }else{
            $hospitalDepartment->delete();
            $output['status'] = true;
        }
        $this->renderJsonOutput($output);
    }
    
    public function actionSearchResult() {
        $hpSeach = new HospitalSearch($_GET);
        $criteria = $hpSeach->criteria;
        $criteria->limit = 50;
        $hospitals = Hospital::model()->findAll($criteria);
        $this->renderJsonOutput($hospitals);
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Hospital the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $with = null) {
        if ($this->model === null) {
            $this->model = Hospital::model()->getById($id, $with);
            if ($this->model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->model;
    }

    public function loadFacultyHospitalJoin($id) {
        if ($this->model_hf_join === null) {
            $this->model_hf_join = HospitalFacultyJoin::model()->getById($id);
            if ($this->model_hf_join === null) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
        return $this->model_hf_join;
    }

    /**
     * Performs the AJAX validation.
     * @param Doctor $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'hospital-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
