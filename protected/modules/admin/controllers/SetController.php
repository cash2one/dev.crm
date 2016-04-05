<?php

class SetController extends AdminController {
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
                'actions' => array('index', 'updateAdminUserRegion', 'ajaxUpdateAdminUserRegion', 'ajaxLoadStateIds', 'ajaxLoadAllStateIds', 'updateRegionDefault', 'ajaxLoadDefaultAdminUser'),
//                'users' => array('test'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $apisvc = new ApiViewAdminUserRegion(AdminUser::ROLE_CS);
        $output = $apisvc->loadApiViewData();
        $this->render('index', array(
            'data' => $output
        ));
    }

    public function actionUpdateAdminUserRegion() {
        if (isset($_POST['AdminUserRegionJoinForm'])) {
            $value = $_POST['AdminUserRegionJoinForm'];
            $adminUserId = $value['admin_user_id'];
            $bookingType = $value['booking_type'];
            $form = new AdminUserRegionJoinForm;
            $states = array();
            if (isset($value['state'])) {
                $states = $value['state'];
            }
            //获取数据库保存的adminUser关联的区域信息
            $setMgr = new SetManager();
            $statesData = $setMgr->loadAllStateByAdminUserIdAndType($adminUserId, $bookingType);
            $form->initModel($adminUserId, $value['booking_type'], $statesData->stateIds);
            $form->setStateListInput($states);
            $setMgr->updateAdminUserRegion($form);
            if ($form->hasErrors() === false) {
                //成功页面跳转
                $this->redirect(array('updateAdminUserRegion', 'booking_type' => $bookingType));
            }
        }
        $this->render('updateAdminUserRegion');
    }

    public function actionUpdateRegionDefault() {
        if (isset($_POST['AdminUserRegionJoinForm'])) {
            $value = $_POST['AdminUserRegionJoinForm'];
            $form = new AdminUserRegionJoinForm;
            $form->attributes = $value;
            $bookingType = $form->booking_type;
            $model = AdminUserRegionJoin::model()->getDefaultAdminUserByBookingTypeAndAdminUserRole($form->booking_type, AdminUser::ROLE_CS);
            $model->admin_user_id = $form->admin_user_id;
            $adminUser = AdminUser::model()->getById($form->admin_user_id);
            $model->admin_user_name = $adminUser->fullname;
            if ($model->save()) {
                //成功页面跳转
                $this->redirect(array('updateRegionDefault', 'booking_type' => $bookingType));
            }
        }
        $this->render('updateRegionDefault');
    }

    public function actionAjaxLoadStateIds($type, $adminUserId) {
        $setMgr = new SetManager();
        $output = $setMgr->getStateIdsByAdminUserIdAndBookingType($adminUserId, $type);
        $this->renderJsonOutput($output);
    }

    public function actionAjaxLoadAllStateIds($type, $admin_user_role) {
        $setMgr = new SetManager();
        $output = $setMgr->getAllStateIdsByBookingTypeAndRole($type, $admin_user_role);
        $this->renderJsonOutput($output);
    }

    public function actionAjaxLoadDefaultAdminUser($type) {
        $setMgr = new SetManager();
        $output = $setMgr->getDefaultAdminUserByBookingTypeAndAdminUserRole($type, AdminUser::ROLE_CS);
        $this->renderJsonOutput($output);
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
