<?php

class AdminBookingSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {
        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new AdminBooking();
    }

    public function getQueryFields() {
        return array('booking_id', 'booking_type', 'ref_no', 'patient_name', 'patient_mobile', 'patient_state', 'patient_city', 'booking_status', 'customer_request', 'orderRefNo', 'orderType', 'finalAmount', 'dateOpen', 'dateClosed','isDepositPaid');
    }

    public function addQueryConditions() {
        $udpAlias = 's';
        $this->criteria->join = 'LEFT JOIN sales_order s ON (t.`id` = s.`bk_id` AND s.`bk_type` =1)';
        $this->criteria->distinct = true;
        $this->criteria->addCondition('t.date_deleted is NULL');
        if ($this->hasQueryParams()) {
            if (isset($this->queryParams['booking_id'])) {
                $booking_id = $this->queryParams['booking_id'];
                $this->criteria->compare('t.booking_id', $booking_id);
            }

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
            if (isset($this->queryParams['booking_status'])) {
                $booking_status = $this->queryParams['booking_status'];
                $this->criteria->addSearchCondition("booking_status", $booking_status);
            }
            if (isset($this->queryParams['customer_request'])) {
                $customer_request = $this->queryParams['customer_request'];
                $this->criteria->addSearchCondition("customer_request", $customer_request);
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
                $this->criteria->compare($udpAlias . ".final_amount", $finalAmount); // sql like condition
            }
            if (isset($this->queryParams['dateOpen'])) {
                $dateOpen = $this->queryParams['dateOpen'];
                $this->criteria->compare($udpAlias . ".date_open", $dateOpen, true); // sql like condition
            }
            if (isset($this->queryParams['dateClosed'])) {
                $dateClosed = $this->queryParams['dateClosed'];
                $this->criteria->compare($udpAlias . ".date_closed", $dateClosed, true); // sql like condition
            }
        }
    }

}
