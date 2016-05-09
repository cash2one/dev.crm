<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OpenController
 *
 * @author shuming
 */
class OpenController extends Controller {

    private $format = 'json';
    /**
     * @return array action filters
     */
    public function filters() {
        return array();
    }

    public function init() {
        header('Access-Control-Allow-Credentials:true');      // 允许携带 用户认证凭据（也就是允许客户端发送的请求携带Cookie）
        return parent::init();
    }

    public function actionList($model) {
        switch ($model) {
            case 'test':
                $output['status'] = 'yes';
                break;
        }
        $this->renderJsonOutput($output);
    }

    public function actionCreate($model){
        $get = $_GET;

        if(empty($_POST)){
            // application/json
            $post = CJSON::decode($this->getPostData());
        }else{
            // application/x-www-form-urlencoded
            $post = $_POST;
        }

        switch ($get['model']) {
            // Get an instance of the respective model
            case 'onhookpush':    // 天润挂机推送
                Yii::log('tinet'  . ':' . var_export($post, true), CLogger::LEVEL_ERROR, __METHOD__);
                $output = array('result'=>'success');
                break;
            default:
                $this->_sendResponse(501, sprintf('Error: Invalid request', $model));
                Yii::app()->end();
        }
        $this->renderJsonOutput($output);
    }

}
