<?php

class AdminBookingForm extends EFormModel {

    const ADMIN_USER_ROLE_CS = '1'; //客服
    const ADMIN_USER_ROLE_BD = '2'; //地推/KA
    const ADMIN_USER_ROLE_BD_ACCOUNTING = '3'; //财务

    public $id;
    public $booking_id;
    public $booking_type;
    public $ref_no;
    public $patient_id;
    public $patient_name;
    public $patient_mobile;
    public $patient_age;
    public $patient_identity;
    public $patient_gender;
    public $state_id;
    public $city_id;
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
    public $expected_doctor_id;
    public $expected_doctor_name;
    public $expected_doctor_mobile;
    public $final_doctor_id;
    public $final_doctor_name;
    public $final_doctor_mobile;
    public $final_hospital_id;
    public $final_hospital_name;
    public $final_time;
    public $disease_confirm;
    public $customer_request;
    public $customer_intention;
    public $customer_type;
    public $customer_diversion;
    public $customer_agent;
    public $business_partner;
    public $is_commonweal;
    public $is_buy_insurance;
    public $booking_status;
    public $work_schedule;
    public $order_status;
    public $order_amount;
    public $admin_user_id;
    public $admin_user_name;
    public $bd_user_id;
    public $bd_user_name;
    public $remark;
    public $display_order;
    public $travel_type;
    public $option_disease_confirm;
    public $option_customer_request;
    public $option_patient_state;
    public $option_patient_city;
    public $option_expected_hospital_id;
    public $option_final_doctor_id;
    public $option_customer_intention;
    public $option_customer_type;
    public $option_customer_diversion;
    public $option_customer_agent;
    public $option_booking_status;
    public $option_admin_user_id;
    public $option_bd_user_id;
    public $option_expected_dept_id;
    public $option_business_partner;
    public $option_is_commonweal;
    public $option_is_buy_insurance;
    public $options_patient_gender;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('booking_id, booking_type, patient_id, patient_age, expected_hospital_id, expected_hp_dept_id, expected_doctor_id, final_doctor_id, disease_confirm, customer_intention, customer_type, booking_status, work_schedule, order_status, admin_user_id, display_order', 'numerical', 'integerOnly' => true),
            array('ref_no, patient_name, expected_hospital_name, expected_hp_dept_name, expected_doctor_name, final_doctor_name, order_amount', 'length', 'max' => 20),
            array('patient_mobile, expected_doctor_mobile, final_doctor_mobile', 'length', 'max' => 11, 'message' => '请填写正确的11位中国手机号码'),
            array('patient_mobile, expected_doctor_mobile, final_doctor_mobile', 'numerical', 'integerOnly' => true, 'message' => '请填写正确的11位中国手机号码'),
            array('patient_identity', 'length', 'max' => 18),
            array('expected_time_start, expected_time_end, final_time', 'type', 'dateFormat' => 'yyyy-mm-dd', 'type' => 'date'),
            array('patient_state, patient_city', 'length', 'max' => 10),
            array('patient_address, disease_detail', 'length', 'max' => 200),
            array('disease_name', 'length', 'max' => 100),
            array('admin_user_name', 'length', 'max' => 50),
            array('remark', 'length', 'max' => 2000),
            array('business_partner, is_commonweal, is_buy_insurance, patient_gender, id, travel_type, state_id, city_id, expected_time_start, expected_time_end, final_time, final_hospital_id, final_hospital_name, patient_state,patient_city, customer_request, customer_diversion, customer_agent, bd_user_id, bd_user_name, expected_hp_dept_name, expected_doctor_name, final_doctor_name, expected_doctor_mobile, final_doctor_mobile', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, booking_id, booking_type, ref_no, patient_id, patient_name, patient_mobile, patient_age, patient_identity, patient_state, patient_city, patient_address, disease_name, disease_detail, expected_time_start, expected_time_end, expected_hospital_id, expected_hospital_name, expected_hp_dept_id, expected_hp_dept_name, expected_doctor_id, expected_doctor_name, final_doctor_id, final_doctor_name, expected_doctor_mobile, final_doctor_mobile, final_time, disease_confirm, customer_request, customer_intention, customer_type, customer_diversion, customer_agent, booking_status, work_schedule, order_status, order_amount, admin_user_id, admin_user_name, bd_user_id, bd_user_name, remark, display_order, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
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
            'patient_gender' => '患者性别',
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
            'expected_doctor_id' => '理想专家ID',
            'expected_doctor_name' => '理想专家',
            'expected_doctor_mobile' => '理想专家电话',
            'final_doctor_id' => '手术医生ID',
            'final_doctor_name' => '手术医生',
            'final_doctor_mobile' => '手术医生电话',
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

    public function loadOptionsGender() {
        if (is_null($this->patient_gender)) {
            $this->patient_gender = StatCode::getOptionsGender();
        }
        return $this->patient_gender;
    }

    public function loadOptionsState() {
        if (is_null($this->option_patient_state)) {
            $this->option_patient_state = CHtml::listData(RegionState::model()->getAllByCountryId(1), 'id', 'name');
        }
        return $this->option_patient_state;
    }

    public function loadOptionsCity() {
        if (is_null($this->option_patient_city)) {
            $this->option_patient_city = array();
        } else {
            $this->option_patient_city = CHtml::listData(RegionCity::model()->getAllByStateId($this->state_id), 'id', 'name');
        }
        return $this->option_patient_city;
    }

    public function loadOptionsHospital() {
        if (is_null($this->option_expected_hospital_id)) {
            $this->option_expected_hospital_id = CHtml::listData(Hospital::model()->getAll(null, array('order' => 't.name ASC')), 'id', 'name');
        }
        return $this->option_expected_hospital_id;
    }

    public function loadOptionsDepartment() {
        if (is_null($this->option_expected_dept_id)) {
            $this->option_expected_dept_id = CHtml::listData(HospitalDepartment::model()->getAllByHospitalId($this->expected_hospital_id), 'id', 'name');
        }
        return $this->option_expected_dept_id;
    }

    public function loadOptionsDoctorProfile() {
        if (is_null($this->option_final_doctor_id)) {
            $this->option_final_doctor_id = CHtml::listData(UserDoctorProfile::model()->getAll(), 'user_id', 'name');
        }
        return $this->option_final_doctor_id;
    }

    public function loadOptionsDiseaseConfirm() {
        if (is_null($this->option_disease_confirm)) {
            $this->option_disease_confirm = AdminBooking::model()->getOptionsDiseaseConfirm();
        }
        return $this->option_disease_confirm;
    }

    public function loadOptionsCustomerRequest() {
        if (is_null($this->option_customer_request)) {
            $this->option_customer_request = AdminBooking::model()->getOptionsCustomerRequest();
        }
        return $this->option_customer_request;
    }

    public function loadOptionsCustomerIntention() {
        if (is_null($this->option_customer_intention)) {
            $this->option_customer_intention = AdminBooking::model()->getOptionsCustomerIntention();
        }
        return $this->option_customer_intention;
    }

    public function loadOptionsCustomerType() {
        if (is_null($this->option_customer_type)) {
            $this->option_customer_type = AdminBooking::model()->getOptionsCustomerType();
        }
        return $this->option_customer_type;
    }

    public function loadOptionsCustomerDiversion() {
        if (is_null($this->option_customer_diversion)) {
            $this->option_customer_diversion = AdminBooking::model()->getOptionsCustomerDiversion();
        }
        return $this->option_customer_diversion;
    }

    public function loadOptionsCustomerAgent() {
        if (is_null($this->option_customer_agent)) {
            $this->option_customer_agent = AdminBooking::model()->getOptionsCustomerAgent();
        }
        return $this->option_customer_agent;
    }

    public function loadOptionsBookingStatus() {
        if (is_null($this->option_booking_status)) {
            $this->option_booking_status = AdminBooking::getOptionsBookingStatus();
        }
        return $this->option_booking_status;
    }

    public function loadOptionsAdminUser() {
        if (is_null($this->option_admin_user_id)) {
            $adminUsers = AdminUser::model()->getAllByAttributes(array('role' => AdminBookingForm::ADMIN_USER_ROLE_CS));
            $adminUserOptions = array();
            foreach ($adminUsers as $value) {
                $std = new stdClass();
                $std->id = $value->id;
                $std->fullname = strIsEmpty($value->title) ? $value->fullname : $value->title . ' ' . $value->fullname;
                $adminUserOptions[] = $std;
            }
            $this->option_admin_user_id = CHtml::listData($adminUserOptions, 'id', 'fullname');
        }
        return $this->option_admin_user_id;
    }

    public function loadOptionsBdUser() {
        if (is_null($this->option_bd_user_id)) {
            $adminUsers = AdminUser::model()->getAllByAttributes(array('role' => AdminBookingForm::ADMIN_USER_ROLE_BD));
            $adminUserOptions = array();
            foreach ($adminUsers as $value) {
                $std = new stdClass();
                $std->id = $value->id;
                $std->fullname = strIsEmpty($value->title) ? $value->fullname : $value->title . ' ' . $value->fullname;
                $adminUserOptions[] = $std;
            }
            $this->option_bd_user_id = CHtml::listData($adminUserOptions, 'id', 'fullname');
        }
        return $this->option_bd_user_id;
    }

    public function loadOptionBusinessPartner() {
        if (is_null($this->option_business_partner)) {
            $this->option_business_partner = AdminBooking::model()->getOptionBusinessPartner();
        }
        return $this->option_business_partner;
    }

    public function loadOptionIsCommonweal() {
        if (is_null($this->option_is_commonweal)) {
            $this->option_is_commonweal = AdminBooking::model()->getOptionsIsCommonweal();
        }
        return $this->option_is_commonweal;
    }

    public function loadOptionIsBuyInsurance() {
        if (is_null($this->option_is_buy_insurance)) {
            $this->option_is_buy_insurance = AdminBooking::model()->getOptionsIsBuyInsurance();
        }
        return $this->option_is_buy_insurance;
    }

}
