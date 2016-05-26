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
            'http://mingyizhudao.com',
            'http://m.mingyizhudao.com',
            'http://api.mingyizhudao.com',
            'http://pc.dev.mingyizd.com',
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
                    $output['errorMsg'] = 'data error...';
                }
                break;
            case 'taskuserdoctor':
                $output = array("status" => 'no');
                $values = $_GET;
                $user = UserDoctorProfile::model()->getByUserId($values['userid']);
                $type = $values['type'];
                $taskMgr = new TaskManager();
                $output['status'] = $taskMgr->createTaskDoctorCert($user, $type);

                break;
            case 'taskpatientmr':
                $output = array("status" => 'no');
                $values = $_GET;
                $booking = PatientBooking::model()->getById($values['id'], array('pbUserDoctorProfile'));
                $taskMgr = new TaskManager();
                $output['status'] = $taskMgr->createTaskPatientFile($booking);
                break;
            case 'taskpatientda':
                $output = array("status" => 'no');
                $values = $_GET;
                $adminbooking = AdminBooking::model()->getByAttributes(array('booking_id' => $values['id'], 'booking_type' => AdminBooking::BK_TYPE_PB));
                $taskMgr = new TaskManager();
                if (isset($adminbooking)) {
                    $output['status'] = $taskMgr->createPatientBookingDaFileTaskPlan($adminbooking);
                }
                break;
            case 'changepwd':
                $output = array();
                $list = AdminUser::model()->getAll();
                foreach ($list as $v) {
                    $password = substr(md5(rand()), 0, 6) . strtoupper(substr(md5(rand()), 11, 6));
                    $mdpassword = hash('sha256', $password);
                    $v->password = $mdpassword;
                    $v->password_raw = $password;
                    if ($v->update(array('password', 'password_raw'))) {
                        $output[$v->fullname] = $v->password_raw;
                    }
                }
                break;
            case 'doctoraccept':
                $output = 'no';
                $values = $_GET;
                $booking = AdminBooking::model()->getByAttributes(array('booking_id' => $values['id'], 'booking_type' => $values['type']));
                if (isset($booking)) {
                    $booking->doctor_accept = $values['accept'];
                    $booking->doctor_opinion = $values['opinion'];
                    if ($booking->update(array('doctor_accept', 'doctor_opinion'))) {
                        $output = 'ok';
                    }
                }
                break;
            case 'tasksalseorder':
                $output = array("status" => 'no');
                $values = $_GET;
                $order = SalesOrder::model()->getByRefNo($values['refno']);
                $taskMgr = new TaskManager();
                if (isset($order)) {
                    $output['status'] = $taskMgr->createTaskOrder($order);
                }
                break;
        }
        $this->renderJsonOutput($output);
    }

}
