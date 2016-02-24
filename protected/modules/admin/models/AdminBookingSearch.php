<?php

class AdminBookingSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {
        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new AdminBooking();
    }

    public function getQueryFields() {
        return array('booking_type', 'ref_no', 'patient_name', 'patient_mobile', 'patient_state', 'patient_city');
    }

    public function addQueryConditions() {
        $this->criteria->addCondition('t.date_deleted is NULL');
        if ($this->hasQueryParams()) {

            if (isset($this->queryParams['booking_type'])) {
                $booking_type = $this->queryParams['booking_type'];
                $this->criteria->compare('t.booking_type', $booking_type);
            }

            if (isset($this->queryParams['ref_no'])) {
                $ref_no = $this->queryParams['ref_no'];
                $this->criteria->addSearchCondition('t.ref_no', $ref_no);
            }

            if (isset($this->queryParams['patient_name'])) {
                $patient_name = $this->queryParams['patient_name'];
                $this->criteria->addSearchCondition('t.patient_name', $patient_name);
            }

            if (isset($this->queryParams['patient_mobile'])) {
                $patient_mobile = $this->queryParams['patient_mobile'];
                $this->criteria->addSearchCondition("patient_mobile", $patient_mobile);
            }
            if (isset($this->queryParams['patient_state'])) {
                $patient_state = $this->queryParams['patient_state'];
                $this->criteria->addSearchCondition("patient_state", $patient_state);
            }
            if (isset($this->queryParams['patient_city'])) {
                $patient_city = $this->queryParams['patient_city'];
                $this->criteria->addSearchCondition("patient_city", $patient_city);
            }
        }
    }

}
