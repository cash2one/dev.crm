<?php

/**
 * This is the model class for table "phone_record".
 *
 * The followings are the available columns in table 'phone_record':
 * @property integer $id
 * @property string $main_unique_id
 * @property integer $admin_user_id
 * @property string $admin_user_name
 * @property integer $cno
 * @property string $client_number
 * @property string $callee_number
 * @property string $customer_area_code
 * @property string $number_trunk
 * @property integer $customer_number_type
 * @property string $start_time
 * @property string $answer_time
 * @property string $end_time
 * @property string $bill_duration
 * @property string $cost
 * @property string $call_type
 * @property string $status
 * @property string $sip_cause
 * @property string $record_file
 * @property string $record_file_url
 * @property string $user_defined
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class PhoneRecord extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'phone_record';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('admin_user_id, cno, customer_number_type', 'numerical', 'integerOnly' => true),
            array('main_unique_id, admin_user_name, callee_number, bill_duration, call_type, status, sip_cause', 'length', 'max' => 50),
            array('client_number', 'length', 'max' => 15),
            array('customer_area_code', 'length', 'max' => 5),
            array('number_trunk', 'length', 'max' => 10),
            array('cost, record_file, user_defined', 'length', 'max' => 20),
            array('record_file_url', 'length', 'max' => 200),
            array('start_time, answer_time, end_time, date_created, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, main_unique_id, admin_user_id, admin_user_name, cno, client_number, callee_number, customer_area_code, number_trunk, customer_number_type, start_time, answer_time, end_time, bill_duration, cost, call_type, status, sip_cause, record_file, record_file_url, user_defined, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'phoneRecordRemark' => array(self::BELONGS_TO, 'PhoneRecordRemark', '', 'on' => 't.id = phoneRecordRemark.phone_record_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'main_unique_id' => '呼叫序列号',
            'admin_user_id' => '客服ID',
            'admin_user_name' => '客服姓名',
            'cno' => '坐席号',
            'client_number' => '转接的电话号码 如座席号码、分机号真实号码等',
            'callee_number' => '外呼号码',
            'customer_area_code' => '客户区号',
            'number_trunk' => '没有区号的8位号码',
            'customer_number_type' => '客户号码类型，其值为1或2；1--固话，2--手机',
            'start_time' => '通话发起时间',
            'answer_time' => '通话接通时间',
            'end_time' => '通话结束时间',
            'bill_duration' => '通话时长',
            'cost' => '费用',
            'call_type' => '呼叫类型',
            'status' => '接听状态',
            'sip_cause' => '呼叫结果',
            'record_file' => '通话录音',
            'record_file_url' => '通话录音url路径',
            'user_defined' => '自定义参数userField',
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
        $criteria->compare('main_unique_id', $this->main_unique_id, true);
        $criteria->compare('admin_user_id', $this->admin_user_id);
        $criteria->compare('admin_user_name', $this->admin_user_name, true);
        $criteria->compare('cno', $this->cno);
        $criteria->compare('client_number', $this->client_number, true);
        $criteria->compare('callee_number', $this->callee_number, true);
        $criteria->compare('customer_area_code', $this->customer_area_code, true);
        $criteria->compare('number_trunk', $this->number_trunk, true);
        $criteria->compare('customer_number_type', $this->customer_number_type);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('answer_time', $this->answer_time, true);
        $criteria->compare('end_time', $this->end_time, true);
        $criteria->compare('bill_duration', $this->bill_duration, true);
        $criteria->compare('cost', $this->cost, true);
        $criteria->compare('call_type', $this->call_type, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('sip_cause', $this->sip_cause, true);
        $criteria->compare('record_file', $this->record_file, true);
        $criteria->compare('record_file_url', $this->record_file_url, true);
        $criteria->compare('user_defined', $this->user_defined, true);
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
     * @return PhoneRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
