<?php

class AdminBookingForm extends EFormModel {

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
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('booking_id, booking_type, patient_id, patient_age, expected_hospital_id, expected_hp_dept_id, experted_doctor_id, final_doctor_id, disease_confirm, customer_request, customer_intention, customer_type, customer_diversion, customer_agent, booking_status, order_status, admin_user_id, display_order', 'numerical', 'integerOnly' => true),
            array('ref_no, patient_name, expected_hospital_name, expected_hp_dept_name, experted_doctor_name, final_doctor_name, order_amount', 'length', 'max' => 20),
            array('patient_mobile', 'length', 'max' => 11, 'message' => '请填写正确的11位中国手机号码'),
            array('patient_mobile', 'numerical', 'integerOnly' => true, 'message' => '请填写正确的11位中国手机号码'),
            array('patient_identity', 'length', 'max' => 18),
            array('expected_time_start, expected_time_end, final_time', 'type', 'dateFormat' => 'yyyy-mm-dd', 'type' => 'date'),
            array('patient_state, patient_city', 'length', 'max' => 10),
            array('patient_address, disease_detail', 'length', 'max' => 200),
            array('disease_name', 'length', 'max' => 100),
            array('admin_user_name', 'length', 'max' => 50),
            array('remark', 'length', 'max' => 2000),
            array('id, expected_time_start, expected_time_end, final_time, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, booking_id, booking_type, ref_no, patient_id, patient_name, patient_mobile, patient_age, patient_identity, patient_state, patient_city, patient_address, disease_name, disease_detail, expected_time_start, expected_time_end, expected_hospital_id, expected_hospital_name, expected_hp_dept_id, expected_hp_dept_name, experted_doctor_id, experted_doctor_name, final_doctor_id, final_doctor_name, final_time, disease_confirm, customer_request, customer_intention, customer_type, customer_diversion, customer_agent, booking_status, order_status, order_amount, admin_user_id, admin_user_name, remark, display_order, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'booking_id' => '预约ID',
            'booking_type' => '预约类型',
            'ref_no' => '预约号',
            'patient_id' => '患者ID',
            'patient_name' => '患者姓名',
            'patient_mobile' => '患者手机',
            'patient_age' => '患者年龄',
            'patient_identity' => '患者身份证',
            'patient_state' => '患者所在省',
            'patient_city' => '患者所在市',
            'patient_address' => '患者地址',
            'disease_name' => '病情诊断',
            'disease_detail' => '病情描述',
            'expected_time_start' => '期望手术时间开始',
            'expected_time_end' => '期望手术时间结束',
            'expected_hospital_id' => '理想医院ID',
            'expected_hospital_name' => '理想医院',
            'expected_hp_dept_id' => '理想科室ID',
            'expected_hp_dept_name' => '理想科室',
            'experted_doctor_id' => '理想专家ID',
            'experted_doctor_name' => '理想专家',
            'final_doctor_id' => '手术医生ID',
            'final_doctor_name' => '手术医生',
            'final_time' => '最终手术时间',
            'disease_confirm' => '是否确诊',
            'customer_request' => '客户需求',
            'customer_intention' => '客户意向',
            'customer_type' => '客户类型',
            'customer_diversion' => '客户导流',
            'customer_agent' => '客户来源',
            'booking_status' => '预约状态',
            'order_status' => '付费状态',
            'order_amount' => '付费金额',
            'admin_user_id' => '业务员ID',
            'admin_user_name' => '业务员',
            'remark' => '备注',
            'display_order' => '排序序号',
            'date_created' => '创建日期',
            'date_updated' => '更新日期',
            'date_deleted' => '删除日期',
        );
    }

    /*     * ****** Accessors ******* */

    public function initModel(AdminBooking $adminbooking = null) {
        if (isset($adminbooking)) {
            $attributes = $adminbooking->attributes;

            unset($attributes['date_created']);
            unset($attributes['date_updated']);
            unset($attributes['date_deleted']);

            //$this->attributes = $attributes;
            $this->setAttributes($attributes);
        } else {
            // $this->model = new Doctor();
        }
        $this->loadOptions();
    }

    public function loadOptions() {
        $this->loadOptionsState();
        $this->loadOptionsCity();
        $this->loadOptionsDoctorProfile();
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
