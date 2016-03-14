<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiController
 *
 * @author shuming
 */
class ApiController extends Controller {

    private $format = 'json';

    /**
     * @return array action filters
     */
    public function filters() {
        return array();
    }

    public function domainWhiteList() {
        return array(
            'http://md.mingyizhudao.com',
            'http://m.mingyizd.com',
            'http://192.168.31.169',
            'http://192.168.31.118',
        );
    }

    public function init() {
        $domainWhiteList = $this->domainWhiteList();
        $this->setHeaderSafeDomain($domainWhiteList, null);
        header('Access-Control-Allow-Credentials:true');      // 允许携带 用户认证凭据（也就是允许客户端发送的请求携带Cookie）
        return parent::init();
    }

    public function actionList($model) {
        switch ($model) {
            case 'adminbooking':
                $output = array("status" => 'no');
                $values = $_GET;
                if ($values['type'] == StatCode::TRANS_TYPE_BK) {
                    $model = Booking::model()->getById($values['id']);
                } else {
                    $model = PatientBooking::model()->getById($values['id']);
                }
                try {
                    $bookMgr = new BookingManager();
                    $admin = $bookMgr->createAdminBooking($model);
                    if ($admin->hasErrors()) {
                        $output['errors'] = $admin->getErrors();
                        throw new CException('error saving data.');
                    }
                    $taskMgr = new TaskManager();
                    $task = $taskMgr->createTaskBooking($admin);
                    if ($task == false) {
                        $output['errors'] = array('data', 'task data errors');
                        throw new CException('error saving data.');
                    }
                    $orderMgr = new OrderManager();
                    $salesOrder = $orderMgr->createSalesOrder($admin);
                    if ($salesOrder->hasErrors()) {
                        $output['errors'] = $salesOrder->getErrors();
                        throw new CException('error saving data.');
                    }
                    $output['salesOrderRefNo'] = $salesOrder->getRefNo();
                    $output['status'] = 'ok';
                } catch (Exception $ex) {
                    $output['status'] = 'no';
                }
                break;
            case 'test':
                $output['status'] = 'yes';
                break;
        }
        $this->renderJsonOutput($output);
    }

}
