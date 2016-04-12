<?php

class AdmintaskController extends AdminController {

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
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'search', 'searchResult', 'delete', 'index', 'view', 'create', 'ajaxCreate', 'update', 'ajaxAlert', 'ajaxPlan', 'ajaxTaskPlan', 'ajaxCompletedTask', 'ajaxDeleteTask', 'ajaxReadTask', 'list'),
//				'users'=>array('admin'),
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
        $model = AdminTask::model()->getById($id, array('adminTaskJoins'));
        $adminUser = AdminUser::model()->getById($model->adminTaskJoins[0]->admin_user_id);
        $this->render('view', array(
            'model' => $model,
            'adminUser' => $adminUser
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new AdminTask;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AdminTask'])) {
            $model->attributes = $_POST['AdminTask'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAjaxCreate() {
        $taskMrg = new TaskManager();
//        $_POST['task']['content'] = 'content';
//        $_POST['task']['date_plan'] = '2016-03-04 18:40:00';
//        $_POST['task']['admin_user_id'] = 1;
//        $_POST['task']['work_type'] = 1;



        $output = array('status' => 'no');
        if (isset($_POST['task'])) {
            $values = $_POST['task'];
            $adminBookingModel = AdminBooking::model()->getById($values['booking_id']);
            $taskMrg->createTaskPlan($adminBookingModel, $values);
            $output['status'] = 'ok';
            $output['errorCode'] = 0;
            $output['errorMsg'] = 'success';
//            $form = new AdminTaskForm();
//            $form->setAttributes($values, true);
//
//            if ($form->hasErrors() === false) {
//                $output['status'] = 'ok';
//                $output['errorCode'] = 0;
//                $output['errorMsg'] = 'success';
//
//            } else {
//                $output['errors'] = $form->getErrors();
//                throw new CException('error saving data.');
//            }
        } else {
            $output['errorCode'] = 400;
            $output['errorMsg'] = 'missing parameters';
        }
        $this->renderJsonOutput($output);
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

        if (isset($_POST['AdminTask'])) {
            $model->attributes = $_POST['AdminTask'];
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
        $dataProvider = new CActiveDataProvider('AdminTask');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionList() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->order = "t.is_read ASC,t.status ASC,t.date_created DESC";
        $criteria->with = array('adminTask');
        $criteria->compare('t.admin_user_id', Yii::app()->user->id);
        $dataProvider = new CActiveDataProvider('AdminTaskJoin', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('list', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new AdminTask('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['AdminTask']))
//            $model->attributes = $_GET['AdminTask'];
//        $this->render('admin', array(
//            'model' => $model,
//        ));
//    }

    public function actionAdmin() {
        $this->render('admin');
    }

    public function actionSearch() {
        $this->render('search');
    }

    public function actionSearchResult() {
        $searcgInputs = $_GET;
        $search = new AdminTaskSearch($searcgInputs, array('adminTask'));
        $criteria = $search->criteria;
        //只能搜索到自己的任务信息 
        $criteria->compare('t.admin_user_id', Yii::app()->user->id, false);
        $criteria->order = "t.is_read ASC,t.status ASC,t.date_created DESC";
        $criteria->addCondition("t.date_deleted is NULL");
        $dataProvider = new CActiveDataProvider('AdminTaskJoin', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->renderPartial('searchResult', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AdminTask the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = AdminTask::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param AdminTask $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-task-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * ajax 获取提醒任务
     */
    public function actionAjaxAlert($newNum=0, $undoneNum=0) {
        $new = AdminTaskJoin::model()->getNewTask(Yii::app()->user->id, $newNum);
        $undone = AdminTaskJoin::model()->getUndoneTask(Yii::app()->user->id, $undoneNum);
        $output = array(
            'status' => 'ok',
            'errorCode' => 0,
            'errorMsg' => 'success',
            'results' => array(
                'new' => count($new),
                'undone' => count($undone),
            ),
        );
        $this->renderJsonOutput($output);
    }


    /**
     * ajax 获取计划跟单
     */
    public function actionAjaxPlan() {
        $adminTaskJoin = AdminTaskJoin::model()->getPlanTask(Yii::app()->user->id);
        $data = array();
        foreach ($adminTaskJoin as $v) {
            $data[] = AdminTask::model()->getById($v->admin_task_id);
        }
        $output = array(
            'status' => 'ok',
            'errorCode' => 0,
            'errorMsg' => 'success',
            'results' => $data,
        );
        $this->renderJsonOutput($output);
    }

    /**
     * ajax 获取计划跟单
     */
    public function actionAjaxTaskPlan($bookingId, $isDone) {
        $taskMr = new TaskManager;
        $output = $taskMr->loadAdminTaskByAdminBookingId($bookingId, $isDone);
        $this->renderJsonOutput($output);
    }

    //完成计划跟单
    public function actionAjaxCompletedTask($id) {
        $output = array('status' => 'no');
        $model = AdminTaskJoin::model()->getById($id);
        date_default_timezone_set("Asia/Shanghai");
        $model->date_done = date('Y-m-d H:i:s');
        $model->status = AdminTaskJoin::STATUS_OK;
        //如果任务未读;则完成时设置为已读
        if ($model->is_read == AdminTaskJoin::NOT_READ) {
            $model->is_read = AdminTaskJoin::IS_READ;
            $model->date_read = date('Y-m-d H:i:s');
        }
        if ($model->save()) {
            $output['status'] = 'ok';
            $output['taskJoin']['id'] = $model->id;
        }
        $this->renderJsonOutput($output);
    }

    //删除计划跟单
    public function actionAjaxDeleteTask($id) {
        $output = array('status' => 'no');
        $bkJoinModel = AdminTaskBkJoin::model()->getById($id);
        $taskJoinModel = AdminTaskJoin::model()->getByAttributes(array('id' => $bkJoinModel->admin_task_join_id));
        $taskModel = $this->loadModel($taskJoinModel->admin_task_id);
        if ($bkJoinModel->delete(true) & $taskJoinModel->delete(true) & $taskModel->delete(true)) {

            $output['status'] = 'ok';
            $output['taskJoin']['id'] = $bkJoinModel->id;
        }
        $this->renderJsonOutput($output);
    }

    //将信息标志为已读
    public function actionAjaxReadTask($id) {
        $output = array('status' => 'no');
        $taskMr = new TaskManager();
        $model = $taskMr->loadAdminTaskByIdAndUserId($id, Yii::app()->user->id);
        if (isset($model)) {
            $model->is_read = AdminTaskJoin::IS_READ;
            date_default_timezone_set("Asia/Shanghai");
            $model->date_read = date('Y-m-d H:i:s');
            if ($model->save()) {
                $output['status'] = 'ok';
                $output['taskJoin']['id'] = $model->id;
            }
            $this->renderJsonOutput($output);
        }
    }

}
