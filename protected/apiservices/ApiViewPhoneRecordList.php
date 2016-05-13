<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiFilesOfPatient
 *
 * @author Administrator
 */
class ApiViewPhoneRecordList extends EApiViewService {

    private $mobile;
    private $phoneRecords;
    private $phoneMgr;

    //初始化类的时候将参数注入

    public function __construct($mobile) {
        parent::__construct();
        $this->mobile = $mobile;
        $this->phoneMgr = new PhoneManager();
    }

    protected function loadData() {
        $this->loadPhoneRecord();
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

    public function loadPhoneRecord() {
        if (is_null($this->mobile) == false) {
            $models = $this->phoneMgr->loadAllPhoneRecordByMobile($this->mobile);
            if (isset($models)) {
                $this->setPhoneRecord($models);
            }
        }
    }

    public function setPhoneRecord($models) {
        foreach ($models as $model) {
            $data = new stdClass();
            $data->uniqueId = $model->main_unique_id;
            $data->startTime = $model->start_time == null ? '无' : $model->start_time;
            $data->endTime = $model->end_time == null ? '无' : $model->end_time;
            $data->adminUserName = $model->admin_user_name;
            $data->customerNumberType = $model->customer_number_type == null ? '无' : $model->customer_number_type;
            $data->status = $model->getStatus() == null ? '无' : $model->getStatus();
            $data->mobile = $model->customer_number;
            $data->remark = '无';
            if (isset($model->phoneRecordRemark)) {
                $data->remark = $model->phoneRecordRemark->remark;
            }
            $data->recordFile = $model->record_file == null ? '无' : $model->record_file;
            $this->phoneRecords[] = $data;
        }
        $this->results->phoneRecords = $this->phoneRecords;
    }

}
