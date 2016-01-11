<?php

class MedicalrecordController extends AdminController {

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
                'actions' => array(''),
                'users' => array('*'),
            ),
            /*
              array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions' => array('create', 'update'),
              'users' => array('@'),
              ),
             */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view', 'update', 'admin', 'ajaxLoadFiles'),
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
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new MedicalRecord;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['MedicalRecord'])) {
            $model->attributes = $_POST['MedicalRecord'];
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

        if (isset($_POST['MedicalRecord'])) {
            $model->attributes = $_POST['MedicalRecord'];
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
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('MedicalRecord');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new MedicalRecord('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['MedicalRecord']))
            $model->attributes = $_GET['MedicalRecord'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     *
     * @param type $id MedicalRecord.id
     * @param type $doctype MedicalRecord.doc_type
     */
    public function actionAjaxLoadFiles($id, $rt) {

        $model = $this->loadModel($id);


        $files = $model->getAllFilesByReportType($rt);

        $output = array();
        $data = array();
        if (emptyArray($files) === false) {
            foreach ($files as $file) {
                //$data[] = $this->createTripImageOutput($file, $record->getTitle());
                $data[] = $this->createMRFileOutput($file);
            }
        }
        if (isset($_GET['tmpl']) && $_GET['tmpl'] == 1) {
            //using tmpl template, so add 'files'.
            $output['files'] = $data;
        } else {
            $output = $data;
        }

        $this->renderJsonOutput($output);
        Yii::app()->end();
    }

    /**
     * returns an output array for json encoding.
     * @param MedicalRecordFile $recordFile
     * @return type array
     * id => MedicalRecordFile.id
     * mrId => MedicalRecord.id
     * fileUrl => abs url of file.
     * thumbnailUrl => abs url of thumbnail of file.
     * fileDate => MedicalRecordFile.date_taken.
     * fileDesc => MedicalRecordFile.description.
     * deleteUrl => abs url to delete file.
     * deleteType => post.
     */
    public function createMRFileOutput(MedicalRecordFile $model) {
        $output = array(
            'id' => $model->getId(),
            'mrId' => $model->getMrId(),
           // 'fileUrl' => $model->getAbsFileUrl(),
           // 'thumbnailUrl' => $model->getAbsThumbnailUrl(),
            'fileUrl'=>'http://mingyihz.com/'.$model->getFileUrl(),
            'thumbnailUrl' => 'http://mingyihz.com/'.$model->getThumbnailUrl(),
            'deleteUrl'=>'',
            'deleteType' => 'post',
            'fileDate' => $model->getDateTaken(),
            'fileDesc' => $model->getDescription()
        );
        return $output;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return MedicalRecord the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = MedicalRecord::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param MedicalRecord $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'medical-record-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
