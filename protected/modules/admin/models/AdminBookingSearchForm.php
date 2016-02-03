<?php

class AdminBookingSearchForm extends EFormModel {

    public $id;
    public $booking_id;
    public $booking_type;
    public $ref_no;
    public $patient_id;
    public $patient_name;
    public $patient_mobile;
    public $patient_age;
    public $patient_identity;
    public $patient_state;
    public $patient_city;
    public $patient_address;
    public $disease_name;
    public $disease_detail;
    public $expected_time_start;
    public $expected_time_end;
    public $expected_hospital_id;
    public $expected_hospital_name;
    public $expected_hp_dept_id;
    public $expected_hp_dept_name;
    public $experted_doctor_id;
    public $experted_doctor_name;
    public $final_doctor_id;
    public $final_doctor_name;
    public $final_time;
    public $disease_confirm;
    public $customer_request;
    public $customer_intention;
    public $customer_type;
    public $customer_diversion;
    public $customer_agent;
    public $booking_status;
    public $order_status;
    public $order_amount;
    public $admin_user_id;
    public $admin_user_name;
    public $remark;
    public $display_order;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array_merge(AdminBooking::model()->attributeLabels(), array(
        ));
    }

    /*
      public function beforeValidate() {
      return parent::beforeValidate();
      }
     * 
     */

    public function initModel($model = null) {
        if (isset($model)) {
            $this->setAttributes($model->getSafeAttributes());
        }

        $this->loadOptions();
    }

    public function loadOptions() {
        $this->loadOptionsState();
        $this->loadOptionsCity();
        $this->loadOptionsHospital();
        $this->loadOptionsDoctorProfile();
        $this->loadOptionsCustomerRequest();
        $this->loadOptionsCustomerIntention();
        $this->loadOptionsCustomerType();
        $this->loadOptionsCustomerDiversion();
        $this->loadOptionsCustomerAgent();
        $this->loadOptionsBookingStatus();
        $this->loadOptionsAdminUser();
    }

    public function loadOptionsState() {
        if (is_null($this->patient_state)) {
            $this->patient_state = CHtml::listData(RegionState::model()->getAllByCountryId(1), 'id', 'name');
        }
        return $this->patient_state;
    }

    public function loadOptionsCity() {
        if (is_null($this->patient_city)) {
            $this->patient_city = array();
        } else {
            $this->patient_city = CHtml::listData(RegionCity::model()->getAllByStateId($this->patient_state), 'id', 'name');
        }
        return $this->patient_city;
    }

    public function loadOptionsHospital() {
        if (is_null($this->expected_hospital_id)) {
            $this->expected_hospital_id = CHtml::listData(Hospital::model()->getAll(null, array('order' => 't.name ASC')), 'id', 'name');
        }
        return $this->expected_hospital_id;
    }

    public function loadOptionsDoctorProfile() {
        if (is_null($this->final_doctor_id)) {
            $this->final_doctor_id = CHtml::listData(UserDoctorProfile::model()->getAll(null, null), 'user_id', 'name');
        }
        return $this->final_doctor_id;
    }

    public function loadOptionsCustomerRequest() {
        if (is_null($this->customer_request)) {
            $this->customer_request = AdminBooking::model()->getOptionsCustomerRequest();
        }
        return $this->customer_request;
    }

    public function loadOptionsCustomerIntention() {
        if (is_null($this->customer_intention)) {
            $this->customer_intention = AdminBooking::model()->getOptionsCustomerIntention();
        }
        return $this->customer_intention;
    }

    public function loadOptionsCustomerType() {
        if (is_null($this->customer_type)) {
            $this->customer_type = AdminBooking::model()->getOptionsCustomerType();
        }
        return $this->customer_type;
    }

    public function loadOptionsCustomerDiversion() {
        if (is_null($this->customer_diversion)) {
            $this->customer_diversion = AdminBooking::model()->getOptionsCustomerDiversion();
        }
        return $this->customer_diversion;
    }

    public function loadOptionsCustomerAgent() {
        if (is_null($this->customer_agent)) {
            $this->customer_agent = AdminBooking::model()->getOptionsCustomerAgent();
        }
        return $this->customer_agent;
    }

    public function loadOptionsBookingStatus() {
        if (is_null($this->booking_status)) {
            $this->booking_status = StatCode::getOptionsBookingStatus();
        }
        return $this->booking_status;
    }

    public function loadOptionsAdminUser() {
        if (is_null($this->admin_user_id)) {
            $this->admin_user_id = CHtml::listData(AdminUser::model()->getAll(null, null), 'id', 'username');
        }
        return $this->admin_user_id;
    }

}
