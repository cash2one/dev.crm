<?php

class ApiViewAdminBooking extends EApiViewService {

    private $id;
    private $bookingRefNo;
    private $creatorDoctorId;
    private $smsMrg;
    private $adminBooking;
    private $orderList;
    private $adminTasks;
    private $creator;
    private $smsList;

    public function __construct($id) {
        $this->id = $id;
        $this->smsMrg = new SmsManager();
    }

    protected function loadData() {
        $this->loadAdminBooking();
        if (is_null($this->bookingRefNo) == false) {
            $this->loadOrderList();
        }
        $this->loadAdminTasks();
        $this->loadCreator();
        $this->loadSmsList();
    }

    //返回的参数
    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'errorCode' => 0,
                'errorMsg' => 'success',
                'results' => $this->results,
            );
        }
    }

    private function loadAdminBooking() {
        if (is_null($this->adminBooking)) {
            $model = AdminBooking::model()->getById($this->id);
            if (isset($model)) {
                $this->setAdminBooking($model);
                $this->initAdminBookingForm($model);
            }
        }
    }

    private function setAdminBooking($model) {
        $this->adminBooking = $model;
        $this->bookingRefNo = $model->ref_no;
        $this->creatorDoctorId = $model->creator_doctor_id;
        $this->results['adminBooking'] = $this->adminBooking;
    }

    private function initAdminBookingForm($model) {
        $form = new AdminBookingForm;
        $form->initModel($model);
        $this->results['model'] = $form;
    }

    private function loadOrderList() {
        if (is_null($this->orderList)) {
            $models = SalesOrder::model()->getAllByAttributes(array('bk_ref_no' => $this->bookingRefNo));
            if (isset($models)) {
                $this->setOrderList($models);
            }
        }
    }

    private function setOrderList($models) {
        foreach ($models as $value) {
            $data = new stdClass();
            $data->id = $value->getId();
            $data->refNo = $value->getRefNo();
            $data->pingId = $value->getPingId();
            $data->orderType = $value->getOrderType();
            $data->orderTypeCode = $value->getOrderType(false);
            $data->subject = $value->getSubject();
            $data->description = $value->getDescription();
            $data->finalAmount = $value->getFinalAmount();
            $data->isPaid = $value->getIsPaid();
            $data->isPaidCode = $value->getIsPaid(false);
            $data->dateClosed = $value->date_closed;
            $this->orderList[] = $data;
        }
        $this->results['orderList'] = $this->orderList;
    }

    private function loadAdminTasks() {
        if (is_null($this->adminTasks)) {
            $models = AdminTaskBkJoin::model()->getAllByAttributes(array('admin_booking_id' => $this->id), array('adminTaskJoin'), array('order' => 't.date_created DESC'));
            if (isset($models)) {
                $this->setAdminTasks($models);
            }
        }
    }

    private function setAdminTasks($models) {
        $this->adminTasks['adminTasksDone'] = array();
        $this->adminTasks['adminTasksNotDone'] = array();
        foreach ($models as $taskBkJoin) {
            $data = new stdClass();
            $taskJoin = $taskBkJoin->getAdminTaskJoin();
            $task = $taskJoin->getAdminTask();
            $data->id = $taskBkJoin->id;
            $data->taskJoinId = $taskJoin->id;
            $data->date_plan = $taskJoin->date_plan;
            $data->admin_user = AdminUser::model()->getById($taskJoin->admin_user_id)->fullname;
            $data->type = $taskJoin->getType(false);
            $data->work_type = $taskJoin->getWorkType();
            $data->content = $task->content;
            $data->date_done = $taskJoin->date_done;
            if ($taskJoin->status == AdminTaskJoin::STATUS_OK && is_null($taskJoin->date_done) == false) {
                $this->adminTasks['adminTasksDone'][] = $data;
            } else {
                $this->adminTasks['adminTasksNotDone'][] = $data;
            }
        }
        $this->results['adminTasks'] = $this->adminTasks;
    }

    private function loadCreator() {
        if (is_null($this->creator) && strIsEmpty($this->creatorDoctorId) == false) {
            $model = UserDoctorProfile::model()->getByUserId($this->creatorDoctorId);
            if (isset($model)) {
                $this->setCreator($model);
            }
        } else {
            $this->results['creator'] = null;
        }
    }

    private function setCreator($model) {
        $data = new stdClass();
        $data->userId = $model->user_id;
        $data->name = $model->name;
        $data->mobile = $model->mobile;
        $data->cTitle = $model->clinical_title == null ? '无' : $model->getClinicalTitle(true);
        $data->stateName = $model->state_name == null ? '无' : $model->state_name;
        $data->cityName = $model->city_name == null ? '无' : $model->city_name;
        $data->hpName = $model->hospital_name == null ? '无' : $model->hospital_name;
        $data->hpDeptName = $model->hp_dept_name == null ? '无' : $model->hp_dept_name;
        $this->creator = $data;
        $this->results['creator'] = $this->creator;
    }

    private function loadSmsList() {
        if (is_null($this->smsList)) {
            $models = $this->smsMrg->loadSmsLogByAdminBookingId($this->id);
            if (isset($models)) {
                $this->setSmsList($models);
            }
        }
    }

    private function setSmsList($models) {
        foreach ($models as $sms) {
            $data = new stdClass();
            $smsLog = $sms->getMsgSmsLog();
            $data->adminUserName = $sms->admin_user_name;
            $data->mobile = $smsLog->mobile;
            $data->content = $smsLog->content;
            $data->isSuccess = $smsLog->is_success;
            $data->dateCreated = $smsLog->date_created;
            $this->smsList[] = $data;
        }
        $this->results['smsList'] = $this->smsList;
    }

}
