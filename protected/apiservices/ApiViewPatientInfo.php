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
class ApiViewPatientInfo extends EApiViewService {

    private $mobile;       //患者手机
    private $patients = array();
    private $bookings = array();  // array
    private $bkMgr;
    private $pbMgr;

    //初始化类的时候将参数注入

    public function __construct($mobile) {
        parent::__construct();
        $this->mobile = $mobile;
        $this->bkMgr = new BookingManager();
        $this->pbMgr = new PatientManager();
    }

    protected function loadData() {
        $this->loadPatient();
        $this->loadBooking();
    }

    //返回的参数
    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'errorCode' => 0,
                'errorMsg' => 'success',
                'results' => array('patients' => $this->patients, 'bookings' => $this->bookings),
            );
        }
    }

    public function loadBooking() {
        if (is_null($this->mobile) == false) {
            $models = $this->bkMgr->loadAllBookingByMobile($this->mobile);
            if (isset($models)) {
                $this->setBooking($models);
            }
        }
    }

    public function loadPatient() {
        if (is_null($this->mobile) == false) {
            $models = $this->pbMgr->loadAllPatientByPatientMobile($this->mobile);
            if (isset($models)) {
                $this->patients = $models;
                //$this->setPatient($models);
            }
        }
    }

    public function setBooking($models) {
        foreach ($models as $model) {
            $data = new stdClass();
            $data->bookingId = $model->id;
            $data->refNo = $model->ref_no;
            $data->dateCreated = $model->date_created;
            $data->detail = $model->disease_detail;
            $data->creatorId = null;
            $data->creatorName = null;
            $data->creatorHp = null;
            $data->creatorMobile = null;
            $data->bookingType = AdminBooking::BK_TYPE_BK;
            $data->bookingTypeText = '患者端';
            $data->patientName = $model->contact_name;
            $data->state = null;
            $data->city = null;
            if (is_null($model->city_id) == false) {
                $data->city = RegionCity::model()->getById($model->city_id)->getName();
            }
            $data->age = null;
            $data->gender = null;
            $this->bookings[] = $data;
        }
    }

    public function setPatient($models) {
        foreach ($models as $model) {
//            $patient = new stdClass();
//            $patient->id = $model->id;
//            $patient->patientName = $model->name;
//            $patient->state = $model->getStateName();
//            $patient->city = $model->getCityName();
//            $patient->age = $model->getAge();
//            $patient->gender = $model->getGender();
//            $patient->mobile = $model->mobile;
//            $this->patients[] = $patient;
//            if (arrayNotEmpty($model->patientBookings)) {
//                $this->setPatientBooking($model);
//            }
        }
    }

    public function setPatientBooking($model) {
        $creator = UserDoctorProfile::model()->getByUserId($model->creator_id);
        foreach ($model->patientBookings as $patientBooking) {
            $data = new stdClass();
            if (isset($creator)) {
                $data->creatorId = $creator->getUserId();
                $data->creatorName = $creator->getName();
                $data->creatorHp = $creator->getHospitalName();
                $data->creatorMobile = $creator->getMobile();
            } else {
                $data->creatorId = $model->patientCreator->id;
                $data->creatorName = $model->patientCreator->username;
                $data->creatorHp = null;
                $data->creatorMobile = null;
            }
            $data->bookingType = AdminBooking::BK_TYPE_PB;
            $data->bookingTypeText = '医生端';
            $data->patientName = $model->name;
            $data->state = $model->getStateName();
            $data->city = $model->getCityName();
            $data->age = $model->getAge();
            $data->gender = $model->getGender();
            $data->bookingId = $patientBooking->id;
            $data->refNo = $patientBooking->ref_no;
            $data->dateCreated = $patientBooking->date_created;
            $data->detail = $patientBooking->detail;
            $this->bookings[] = $data;
        }
    }

}
