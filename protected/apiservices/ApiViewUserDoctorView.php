<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of apiViewDoctorHz
 *
 * @author shuming
 */
class ApiViewUserDoctorView extends EApiViewService {

    private $userId;
    private $doctorInfo;
    private $userDoctorHz;
    private $userDoctorZz;
    private $doctorMgr;

    public function __construct($userId) {
        parent::__construct();
        $this->userId = $userId;
        $this->doctorMgr = new DoctorManager();
        $this->doctorInfo = null;
        $this->userDoctorHz = null;
        $this->userDoctorZz = null;
    }

    protected function createOutput() {
        $this->output = array(
            'status' => self::RESPONSE_OK,
            'errorCode' => 0,
            'errorMsg' => 'success',
            'results' => $this->results,
        );
    }

    protected function loadData() {
        $this->loadUserDoctor();
        $this->loadDoctorHz();
        $this->loadDoctorZz();
    }

    private function loadUserDoctor() {
        $with = array('userDoctorProfile', 'userDoctorCerts' => array('on' => 'userDoctorCerts.date_deleted is NULL'));
        $model = User::model()->getById($this->userId, $with);
        if (isset($model)) {
            $this->setUserDoctor($model);
        }
        $this->results->doctorInfo = $this->doctorInfo;
    }

    private function setUserDoctor($model) {
        $profile = $model->getUserDoctorProfile();
        $data = new stdClass();
        $data->id = $model->getId();
        $data->username = $model->username;
        $data->files = $model->getUserDoctorCerts();
        $data->dataCreated = $model->getDateCreated();
        if (is_null($profile)) {
            $data->name = null;
            $data->hospitalName = null;
            $data->hpDeptName = null;
            $data->clinicalTitle = null;
            $data->academicTitle = null;
            $data->stateName = null;
            $data->cityName = null;
            $data->verified = null;
            $data->dateVerified = null;
            $data->verifiedBy = null;
            $data->isContractDoctor = null;
            $data->preferredPatient = null;
        } else {
            $data->name = $profile->getName();
            $data->hospitalName = $profile->getHospitalName();
            $data->hpDeptName = $profile->getHpDeptName();
            $data->clinicalTitle = $profile->getClinicalTitle();
            $data->academicTitle = $profile->getAcademicTitle();
            $data->stateName = $profile->getStateName();
            $data->cityName = $profile->getCityName();
            $data->verified = $profile->isVerified();
            $data->dateVerified = $profile->getDateVerified();
            $data->verifiedBy = $profile->getVerifiedBy();
            $data->isContractDoctor = $profile->isContractDoctor() == true ? '是' : '否';
            $data->preferredPatient = $profile->getPreferredPatient();
        }
        $this->doctorInfo = $data;
    }

    private function loadDoctorHz() {
        $model = $this->doctorMgr->loadUserDoctorHuizhenByUserId($this->userId);
        if (isset($model)) {
            $this->setUserDoctorHz($model);
        }
        $this->results->userDoctorHz = $this->userDoctorHz;
    }

    private function setUserDoctorHz(UserDoctorHuizhen $model) {
        $data = new stdClass();
        $data->id = $model->id;
        $data->userId = $model->user_id;
        $data->isJoin = $model->getIsJoin(false);
        $data->minNoSurgery = $model->min_no_surgery;
        $travelDuration = $model->getTravelDuration();
        $data->travelDuration = $this->travelDurationToString($travelDuration);
        $data->feeMin = $model->fee_min;
        $data->feeMax = $model->fee_max;
        $weekDays = $model->getWeekDays();
        $data->weekDays = $this->weekDaysToString($weekDays);
        $data->patientsPrefer = $model->patients_prefer;
        $data->freqDestination = $model->freq_destination;
        $data->destinationReq = $model->destination_req;
        $this->userDoctorHz = $data;
    }

    private function travelDurationToString(array $travelDuration) {
        if (arrayNotEmpty($travelDuration)) {
            $travelStr = '';
            foreach ($travelDuration as $value) {
                switch ($value) {
                    case 'train3h':
                        $travelStr.='高铁3小时内、';
                        break;
                    case 'plane2h':
                        $travelStr.='飞机2小时内、';
                        break;
                    case 'train5h':
                        $travelStr.='高铁5小时内、';
                        break;
                    case 'plane3h':
                        $travelStr.='飞机3小时内、';
                        break;
                    case 'none':
                        $travelStr.='无特殊要求、';
                        break;
                }
            }
            return substr($travelStr, 0, strlen($travelStr) - 3);
        } else {
            return null;
        }
    }

    private function weekDaysToString(array $weekDays) {
        if (arrayNotEmpty($weekDays)) {
            $weekStr = '';
            foreach ($weekDays as $value) {
                switch ($value) {
                    case 1:
                        $weekStr .= '周一、';
                        break;
                    case 2:
                        $weekStr .= '周二、';
                        break;
                    case 3:
                        $weekStr .= '周三、';
                        break;
                    case 4:
                        $weekStr .= '周四、';
                        break;
                    case 5:
                        $weekStr .= '周五、';
                        break;
                    case 6:
                        $weekStr .= '周六、';
                        break;
                    case 7:
                        $weekStr .= '周日、';
                        break;
                }
            }
            return substr($weekStr, 0, strlen($weekStr) - 3);
        } else {
            return null;
        }
    }

    private function loadDoctorZz() {
        $model = $this->doctorMgr->loadUserDoctorZhuanzhenByUserId($this->userId);
        if (isset($model)) {
            $this->setUserDoctorZz($model);
        }
        $this->results->userDoctorZz = $this->userDoctorZz;
    }

    private function setUserDoctorZz(UserDoctorZhuanzhen $model) {
        $data = new stdClass();
        $data->id = $model->getId();
        $data->userId = $model->user_id;
        $data->isJoin = $model->getIsJoin(false);
        if (is_null($model->fee)) {
            $data->fee = '暂无信息';
        } else if ($model->fee == 0) {
            $data->fee = '不需要';
        } else {
            $data->fee = $model->fee;
        }
        $data->preferredPatient = $model->preferred_patient;
        $data->prepDays = $model->getPrepDays();
        $this->userDoctorZz = $data;
    }

}
