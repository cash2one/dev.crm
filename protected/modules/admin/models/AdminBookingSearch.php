<?php

class AdminBookingSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {
        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new AdminBooking();
    }

    public function getQueryFields() {
        return array('bookingType', 'refNo', 'patientName', 'patientMobile', 'patientGender', 'bookingStatus', 'workSchedule', 'stateId', 'cityId', 'adminUserId', 'bdUserId', 'customerAgent', 'diseaseConfirm', 'customerIntention', 'customerType', 'isCommonweal', 'isDeal', 'businessPartner', 'isBuyInsurance', 'customerRequest', 'travelType', 'diseaseName', 'expectHp', 'expectDept', 'expectDoctor', 'dateCreatedStart', 'dateCreatedEnd', 'creatorDoctorName', 'orderRefNo', 'orderType', 'finalAmount', 'dateOpen', 'dateClosed', 'creatorDoctorTel', 'creatorDoctorcTitle', 'creatorDoctorStateId', 'creatorDoctorCityId', 'creatorDoctorHp', 'creatorDoctorHpDept');
    }

    public function addQueryConditions() {
        $udpAlias = 's';
        $udpAlias2 = 'u';
//        $this->criteria->join .= 'LEFT JOIN sales_order s ON (t.`ref_no` = s.`bk_ref_no`)'; //(t.`id` = s.`bk_id` AND s.`bk_type` = 0)'
//        $this->criteria->join .= 'LEFT JOIN user_doctor_profile u ON (t.`creator_doctor_id` = u.`user_id`)';
        $this->criteria->addCondition('t.date_deleted is NULL');
        //如果客服level是普通客服，则只能查到与自己有关的信息
//        $userId = Yii::app()->user->id;
//        $user = AdminUser::model()->getById($userId);
//        if ($user->level == AdminUser::LEVEL_USER_NORMAL) {
//            $this->criteria->compare('t.admin_user_id', $userId);
//        }
        $this->criteria->with = array('bkOwner', 'orderAdminbooking');
        $this->criteria->distinct = true;
        if ($this->hasQueryParams()) {
            if (isset($this->queryParams['orderRefNo']) || isset($this->queryParams['orderType']) || isset($this->queryParams['finalAmount']) || isset($this->queryParams['dateOpen']) || isset($this->queryParams['dateClosed'])) {
                $this->criteria->join .= 'LEFT JOIN sales_order s ON (t.`ref_no` = s.`bk_ref_no`)';
            }
            if (isset($this->queryParams['creatorDoctorTel']) || isset($this->queryParams['creatorDoctorcTitle']) || isset($this->queryParams['creatorDoctorStateId']) || isset($this->queryParams['creatorDoctorCityId']) || isset($this->queryParams['creatorDoctorHp']) || isset($this->queryParams['creatorDoctorHpDept'])) {
                $this->criteria->join .= 'LEFT JOIN user_doctor_profile u ON (t.`creator_doctor_id` = u.`user_id`)';
            }

            if (isset($this->queryParams['bookingType'])) {
                $bookingType = $this->queryParams['bookingType'];
                $this->criteria->compare('t.booking_type', $bookingType);
            }

            if (isset($this->queryParams['refNo'])) {
                $refNo = $this->queryParams['refNo'];
                $this->criteria->addSearchCondition('t.ref_no', $refNo);
            }

            if (isset($this->queryParams['patientName'])) {
                $patientName = $this->queryParams['patientName'];
                $this->criteria->addSearchCondition('t.patient_name', $patientName);
            }

            if (isset($this->queryParams['patientMobile'])) {
                $patientMobile = $this->queryParams['patientMobile'];
                $this->criteria->addSearchCondition("t.patient_mobile", $patientMobile);
            }

            if (isset($this->queryParams['patientGender'])) {
                $patientGender = $this->queryParams['patientGender'];
                $this->criteria->addSearchCondition("t.patient_gender", $patientGender);
            }

            if (isset($this->queryParams['bookingStatus'])) {
                $bookingStatus = $this->queryParams['bookingStatus'];
                $this->criteria->compare("t.booking_status", $bookingStatus);
            }

            if (isset($this->queryParams['workSchedule'])) {
                $workSchedule = $this->queryParams['workSchedule'];
                $this->criteria->compare("t.work_schedule", $workSchedule);
            }

            if (isset($this->queryParams['stateId'])) {
                $stateId = $this->queryParams['stateId'];
                $this->criteria->compare("t.state_id", $stateId);
            }
            if (isset($this->queryParams['cityId'])) {
                $cityId = $this->queryParams['cityId'];
                $this->criteria->compare("t.city_id", $cityId);
            }
            if (isset($this->queryParams['bdUserId'])) {
                $bd_user = $this->queryParams['bdUserId'];
                $this->criteria->compare('t.bd_user_id', $bd_user);
            }
            if (isset($this->queryParams['adminUserId'])) {
                $adminUserId = $this->queryParams['adminUserId'];
                $this->criteria->compare('t.admin_user_id', $adminUserId);
            }
            if (isset($this->queryParams['customerAgent'])) {
                $customerAgent = $this->queryParams['customerAgent'];
                $this->criteria->addSearchCondition("t.customer_agent", $customerAgent);
            }
            if (isset($this->queryParams['diseaseConfirm'])) {
                $diseaseConfirm = $this->queryParams['diseaseConfirm'];
                $this->criteria->addSearchCondition("t.disease_confirm", $diseaseConfirm);
            }
            if (isset($this->queryParams['customerIntention'])) {
                $customerIntention = $this->queryParams['customerIntention'];
                $this->criteria->addSearchCondition("t.customer_intention", $customerIntention);
            }
            if (isset($this->queryParams['customerType'])) {
                $customerType = $this->queryParams['customerType'];
                $this->criteria->addSearchCondition("t.customer_type", $customerType);
            }
            if (isset($this->queryParams['isCommonweal'])) {
                $isCommonweal = $this->queryParams['isCommonweal'];
                $this->criteria->addSearchCondition("t.is_commonweal", $isCommonweal);
            }
            if (isset($this->queryParams['isDeal'])) {
                $isDeal = $this->queryParams['isDeal'];
                $this->criteria->addSearchCondition("t.is_deal", $isDeal);
            }
            if (isset($this->queryParams['businessPartner'])) {
                $businessPartner = $this->queryParams['businessPartner'];
                $this->criteria->addSearchCondition("t.business_partner", $businessPartner);
            }
            if (isset($this->queryParams['isBuyInsurance'])) {
                $isBuyInsurance = $this->queryParams['isBuyInsurance'];
                $this->criteria->addSearchCondition("t.is_buy_insurance", $isBuyInsurance);
            }
            if (isset($this->queryParams['customerRequest'])) {
                $customerRequest = $this->queryParams['customerRequest'];
                $this->criteria->addSearchCondition("t.customer_request", $customerRequest);
            }
            if (isset($this->queryParams['travelType'])) {
                $travelType = $this->queryParams['travelType'];
                $this->criteria->addSearchCondition("t.travel_type", $travelType);
            }
            if (isset($this->queryParams['diseaseName'])) {
                $diseaseName = $this->queryParams['diseaseName'];
                $this->criteria->addSearchCondition("t.disease_name", $diseaseName);
            }
            if (isset($this->queryParams['expectHp'])) {
                $expectHp = $this->queryParams['expectHp'];
                $this->criteria->addSearchCondition("t.expected_hospital_name", $expectHp, true);
            }
            if (isset($this->queryParams['expectDept'])) {
                $expectDept = $this->queryParams['expectDept'];
                $this->criteria->addSearchCondition("t.expected_hp_dept_name", $expectDept, true);
            }
            if (isset($this->queryParams['expectDoctor'])) {
                $expectDoctor = $this->queryParams['expectDoctor'];
                $this->criteria->addSearchCondition("t.expected_doctor_name", $expectDoctor, true);
            }
            //时间区间
            if (isset($this->queryParams['dateCreatedStart']) & isset($this->queryParams['dateCreatedEnd'])) {
                $dateCreatedStart = $this->queryParams['dateCreatedStart'];
                $dateCreatedEnd = $this->queryParams['dateCreatedEnd'];
                $this->criteria->addBetweenCondition("t.date_created", $dateCreatedStart, $dateCreatedEnd);
            } else {
                if (isset($this->queryParams['dateCreatedStart'])) {
                    $dateCreatedStart = $this->queryParams['dateCreatedStart'];
                    $this->criteria->addBetweenCondition("t.date_created", $dateCreatedStart, date('Y-m-d'));
                }
                if (isset($this->queryParams['dateCreatedEnd'])) {
                    $dateCreatedEnd = $this->queryParams['dateCreatedEnd'];
                    $this->criteria->addBetweenCondition("t.date_created", date('2000-01-01'), $dateCreatedEnd);
                }
            }
            if (isset($this->queryParams['creatorDoctorName'])) {
                $creatorDoctorName = $this->queryParams['creatorDoctorName'];
                $this->criteria->addSearchCondition("t.creator_doctor_name", $creatorDoctorName, true);
            }
            if (isset($this->queryParams['orderRefNo'])) {
                $orderRefNo = $this->queryParams['orderRefNo'];
                $this->criteria->compare($udpAlias . ".ref_no", $orderRefNo, true);
            }
            if (isset($this->queryParams['orderType'])) {
                $orderType = $this->queryParams['orderType'];
                $this->criteria->compare($udpAlias . ".order_type", $orderType);
            }
            if (isset($this->queryParams['finalAmount'])) {
                $finalAmount = $this->queryParams['finalAmount'];
                $this->criteria->compare($udpAlias . ".final_amount", $finalAmount);
            }
            if (isset($this->queryParams['dateOpen'])) {
                $dateOpen = $this->queryParams['dateOpen'];
                $this->criteria->compare($udpAlias . ".date_open", $dateOpen, true); // sql like condition
            }
            if (isset($this->queryParams['dateClosed'])) {
                $dateClosed = $this->queryParams['dateClosed'];
                $this->criteria->compare($udpAlias . ".date_closed", $dateClosed, true); // sql like condition
            }
            if (isset($this->queryParams['creatorDoctorTel'])) {
                $creatorDoctorTel = $this->queryParams['creatorDoctorTel'];
                $this->criteria->compare($udpAlias2 . ".mobile", $creatorDoctorTel);
            }
            if (isset($this->queryParams['creatorDoctorcTitle'])) {
                $creatorDoctorcTitle = $this->queryParams['creatorDoctorcTitle'];
                $this->criteria->compare($udpAlias2 . ".clinical_title", $creatorDoctorcTitle);
            }
            if (isset($this->queryParams['creatorDoctorStateId'])) {
                $creatorDoctorStateId = $this->queryParams['creatorDoctorStateId'];
                $this->criteria->compare($udpAlias2 . ".state_id", $creatorDoctorStateId);
            }
            if (isset($this->queryParams['creatorDoctorCityId'])) {
                $creatorDoctorCityId = $this->queryParams['creatorDoctorCityId'];
                $this->criteria->compare($udpAlias2 . ".city_id", $creatorDoctorCityId);
            }
            if (isset($this->queryParams['creatorDoctorHp'])) {
                $creatorDoctorHp = $this->queryParams['creatorDoctorHp'];
                $this->criteria->compare($udpAlias2 . ".hospital_name", $creatorDoctorHp, true);
            }
            if (isset($this->queryParams['creatorDoctorHpDept'])) {
                $creatorDoctorHpDept = $this->queryParams['creatorDoctorHpDept'];
                $this->criteria->compare($udpAlias2 . ".hp_dept_name", $creatorDoctorHpDept, true);
            }
        }
    }

}
