<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for the module should extend from this base class.
 */
class AdminController extends RController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/layoutAdmin';
    public $viewPath;

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     * Value is set in AdminModule::init().
     */
    public $sitetheme;
    public $sitelayout;
    //public $moduleViewPath;

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $current_user = null;

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
            array('allow',
                'actions' => array('login', 'captcha'),
                'users' => array('*')
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(),
                'users' => array('superbeta')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function init() {
        parent::init();
    }

    /**
     * Protected method to load the associated User model class from login session.
     * @return object the User data model based on the primary key stored in session.
     */
    public function loadUser($with = null) {
        if (is_null($this->current_user)) {
            //var_dump(Yii::app()->user->id);exit;
            if (isset(Yii::app()->user->id)) {
                $this->current_user = AdminUser::model()->getById(Yii::app()->user->id, $with);
                if (is_null($this->current_user)) {
                    // 有session但存的user.id不存在，所以logout user.
                    Yii::app()->user->logout();
                    // 跳转到登录页面.
                    $this->redirect(Yii::app()->user->loginUrl);
                    //throw new CHttpException(404, 'The requested page does not exist.');
                }
            }
        }
        return $this->current_user;
    }

    public function getCurrentUser() {
        try {
            return $this->loadUser();
        } catch (CException $cex) {
            return null;
        }
    }
    
    public function getCurrentUserId() {
        return Yii::app()->user->id;
    }

    public function renderJsonOutput($data, $exit = true, $httpStatus = 200) {
        header('Content-Type: application/json; charset=utf-8');
        echo CJSON::encode($data);
        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute || $route instanceof XWebDebugRouter) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        if ($exit) {
            Yii::app()->end($httpStatus, true);
        }
    }

    public function headerUTF8() {
        header('Content-Type: text/html; charset=utf-8');
    }

    /**
     * 模拟get进行url请求
     * @param string $url
     */
    function send_get($url) {
        $result = file_get_contents($url, false);
        return json_decode($result, true);
    }
}
