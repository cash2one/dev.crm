<?php

/**
 * This is the model class for table "admin_booking".
 *
 * The followings are the available columns in table 'admin_booking':
 * @property integer $id
 * @property integer $booking_id
 * @property integer $booking_type
 * @property string $ref_no
 * @property integer $patient_id
 * @property string $patient_name
 * @property string $patient_mobile
 * @property integer $patient_age
 * @property string $patient_identity
 * @property string $patient_state
 * @property string $patient_city
 * @property string $patient_address
 * @property string $disease_name
 * @property string $disease_detail
 * @property string $expected_time_start
 * @property string $expected_time_end
 * @property integer $expected_hospital_id
 * @property string $expected_hospital_name
 * @property integer $expected_hp_dept_id
 * @property string $expected_hp_dept_name
 * @property integer $experted_doctor_id
 * @property string $experted_doctor_name
 * @property integer $final_doctor_id
 * @property string $final_doctor_name
 * @property string $final_time
 * @property integer $disease_confirm
 * @property integer $customer_request
 * @property integer $customer_intention
 * @property integer $customer_type
 * @property integer $customer_diversion
 * @property integer $customer_agent
 * @property integer $booking_status
 * @property integer $order_status
 * @property string $order_amount
 * @property integer $admin_user_id
 * @property string $admin_user_name
 * @property string $remark
 * @property integer $display_order
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class AdminBooking extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'admin_booking';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date_created', 'required'),
            array('booking_id, booking_type, patient_id, patient_age, expected_hospital_id, expected_hp_dept_id, experted_doctor_id, final_doctor_id, disease_confirm, customer_request, customer_intention, customer_type, customer_diversion, customer_agent, booking_status, order_status, admin_user_id, display_order', 'numerical', 'integerOnly' => true),
            array('ref_no, patient_name, expected_hospital_name, expected_hp_dept_name, experted_doctor_name, final_doctor_name, order_amount', 'length', 'max' => 20),
            array('patient_mobile', 'length', 'max' => 11),
            array('patient_identity', 'length', 'max' => 18),
            array('patient_state, patient_city', 'length', 'max' => 10),
            array('patient_address, disease_detail', 'length', 'max' => 200),
            array('disease_name', 'length', 'max' => 100),
            array('admin_user_name', 'length', 'max' => 50),
            array('remark', 'length', 'max' => 2000),
            array('expected_time_start, expected_time_end, final_time, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, booking_id, booking_type, ref_no, patient_id, patient_name, patient_mobile, patient_age, patient_identity, patient_state, patient_city, patient_address, disease_name, disease_detail, expected_time_start, expected_time_end, expected_hospital_id, expected_hospital_name, expected_hp_dept_id, expected_hp_dept_name, experted_doctor_id, experted_doctor_name, final_doctor_id, final_doctor_name, final_time, disease_confirm, customer_request, customer_intention, customer_type, customer_diversion, customer_agent, booking_status, order_status, order_amount, admin_user_id, admin_user_name, remark, display_order, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
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

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('booking_id', $this->booking_id);
        $criteria->compare('booking_type', $this->booking_type);
        $criteria->compare('ref_no', $this->ref_no, true);
        $criteria->compare('patient_id', $this->patient_id);
        $criteria->compare('patient_name', $this->patient_name, true);
        $criteria->compare('patient_mobile', $this->patient_mobile, true);
        $criteria->compare('patient_age', $this->patient_age);
        $criteria->compare('patient_identity', $this->patient_identity, true);
        $criteria->compare('patient_state', $this->patient_state, true);
        $criteria->compare('patient_city', $this->patient_city, true);
        $criteria->compare('patient_address', $this->patient_address, true);
        $criteria->compare('disease_name', $this->disease_name, true);
        $criteria->compare('disease_detail', $this->disease_detail, true);
        $criteria->compare('expected_time_start', $this->expected_time_start, true);
        $criteria->compare('expected_time_end', $this->expected_time_end, true);
        $criteria->compare('expected_hospital_id', $this->expected_hospital_id);
        $criteria->compare('expected_hospital_name', $this->expected_hospital_name, true);
        $criteria->compare('expected_hp_dept_id', $this->expected_hp_dept_id);
        $criteria->compare('expected_hp_dept_name', $this->expected_hp_dept_name, true);
        $criteria->compare('experted_doctor_id', $this->experted_doctor_id);
        $criteria->compare('experted_doctor_name', $this->experted_doctor_name, true);
        $criteria->compare('final_doctor_id', $this->final_doctor_id);
        $criteria->compare('final_doctor_name', $this->final_doctor_name, true);
        $criteria->compare('final_time', $this->final_time, true);
        $criteria->compare('disease_confirm', $this->disease_confirm);
        $criteria->compare('customer_request', $this->customer_request);
        $criteria->compare('customer_intention', $this->customer_intention);
        $criteria->compare('customer_type', $this->customer_type);
        $criteria->compare('customer_diversion', $this->customer_diversion);
        $criteria->compare('customer_agent', $this->customer_agent);
        $criteria->compare('booking_status', $this->booking_status);
        $criteria->compare('order_status', $this->order_status);
        $criteria->compare('order_amount', $this->order_amount, true);
        $criteria->compare('admin_user_id', $this->admin_user_id);
        $criteria->compare('admin_user_name', $this->admin_user_name, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('display_order', $this->display_order);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('date_deleted', $this->date_deleted, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdminBooking the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
