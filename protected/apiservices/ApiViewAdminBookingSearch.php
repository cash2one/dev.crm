<?php

class ApiViewAdminBookingSearch extends EApiViewService {

    private $searchInputs;      // Search inputs passed from request url.
    private $getCount = false;  // whether to count no. of Adminbookings satisfying the search conditions.
    private $pageSize = 20;
    private $pageItem = 1;
    private $adminbookingSearch;  // AdminbookingSearch model.
    private $adminbookings;
    private $adminbookingCount;     // count no. of Adminbookings.
    private $mobileList = array();

    public function __construct($searchInputs) {
        parent::__construct();
        $this->searchInputs = $searchInputs;
        $this->getCount = isset($searchInputs['getcount']) && $searchInputs['getcount'] == 1 ? true : false;
        $this->pageItem = isset($searchInputs['page']) && $searchInputs['page'] > 0 ? $searchInputs['page'] : $this->pageItem;
        $this->searchInputs['pagesize'] = isset($searchInputs['pagesize']) && $searchInputs['pagesize'] > 0 ? $searchInputs['pagesize'] : $this->pageSize;
        $this->adminbookingSearch = new AdminbookingSearch($this->searchInputs);
        $this->adminbookingSearch->addSearchCondition("t.date_deleted is NULL");
    }

    protected function loadData() {
        // load Adminbookings.
        $this->loadAdminbookings();
        if ($this->getCount) {
            $this->loadAdminbookingCount();
        }
        if (arrayNotEmpty($this->mobileList)) {
            $this->loadRelationBookingByMobiles();
        }
    }

    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'errorCode' => 0,
                'errorMsg' => 'success',
                'pageItem' => $this->pageItem,
                'dataNum' => $this->adminbookingCount,
                'results' => $this->adminbookings,
            );
        }
    }

    private function loadAdminbookings() {
        if (is_null($this->adminbookings)) {
            $models = $this->adminbookingSearch->search();
            if (arrayNotEmpty($models)) {
                $this->setAdminbookings($models);
            }
        }
    }

    private function setAdminbookings(array $models) {
        foreach ($models as $model) {
            $data = new stdClass();
            $data->id = $model->id;
            $data->refNo = $model->ref_no;
            $data->patientName = $model->patient_name;
            $data->patientMobile = $model->patient_mobile;
            $this->mobileList[] = $model->patient_mobile;
            $data->diseaseName = $model->disease_name;
            $data->dateCreated = $model->date_created;
            $data->workSchedule = $model->getWorkSchedule();
            $data->adminUserName = $model->admin_user_name;
            $doctorName = isset($model->bkOwner->userDoctorProfile) ? $model->bkOwner->userDoctorProfile->name : $model->creator_doctor_name;
            $data->doctorName = $doctorName;
            $data->customerAgent = $model->getCustomerAgent();
            $data->bdUserName = $model->bd_user_name;
            $data->customerRequest = $model->getCustomerRequest();
            $data->customerIntention = $model->getCustomerIntention();
            $data->expectedDoctorName = $model->expected_doctor_name;
            $data->expectedDoctorMobile = $model->expected_doctor_mobile;
            $data->expectedHospitalName = $model->expected_hospital_name;
            $doctorMobile = isset($model->bkOwner) ? $model->bkOwner->username : null;
            $data->doctorMobile = $doctorMobile;
            $data->customerDiversion = $model->getCustomerDiversion();
            $data->finalTime = $model->final_time;
            $data->bookingType = $model->getBookingType();
            $orderAdminbooking = null;
            $orders = isset($model->orderAdminbooking) ? $model->orderAdminbooking : null;
            foreach ($orders as $order) {
                $orderAdminbooking[] = $order;
            }
            $data->userDoctorMobile = isset($model->userDoctorMobile) ? $model->userDoctorMobile : null;
            $data->orderAdminbooking = $orderAdminbooking;
            
            $this->adminbookings[] = $data;
        }
    }

    private function loadAdminbookingCount() {
        if (is_null($this->adminbookingCount)) {
            $count = $this->adminbookingSearch->count();
            $this->setCount($count);
        }
    }

    private function setCount($count) {
        $this->adminbookingCount = $count;
    }

    private function loadRelationBookingByMobiles() {
        $relationBooking = array();
        $bookings = Booking::model()->getAllByInCondition('mobile', $this->mobileList);
        $patients = PatientInfo::model()->getAllByInCondition('mobile', $this->mobileList);
        foreach ($bookings as $booking) {
            if (array_key_exists($booking->mobile, $relationBooking)) {
                $relationBooking[$booking->mobile] ++;
            } else {
                $relationBooking[$booking->mobile] = 1;
            }
        }
        foreach ($patients as $patient) {
            if (array_key_exists($patient->mobile, $relationBooking)) {
                $relationBooking[$patient->mobile] ++;
            } else {
                $relationBooking[$patient->mobile] = 1;
            }
        }
        foreach ($this->adminbookings as $v) {
            if (isset($relationBooking[$v->patientMobile])) {
                $v->relateionBooking = $relationBooking[$v->patientMobile];
            } else {
                $v->relateionBooking = 0;
            }
        }
    }

}
