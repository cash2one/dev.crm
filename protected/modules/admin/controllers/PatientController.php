<?php

class PatientController extends AdminController {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';

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
                'actions' => array('view','deletepatientmr'),
//                'users' => array('test'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($mobile) {
        $apisvc = new ApiViewPatientInfo($mobile);
        $output = $apisvc->loadApiViewData();
        $this->render('view',array(
            'data'=>$output
        ));
    }
    
    public function actionDeletepatientmr($id) {
        $patientMgr =  new PatientManager();
        $output = $patientMgr->delectPatientMRFileById($id);
        $this->renderJsonOutput($output);
    }
}
