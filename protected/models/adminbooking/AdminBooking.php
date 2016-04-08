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
 * @property integer $state_id
 * @property integer $city_id
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
 * @property integer $expected_doctor_id
 * @property string $expected_doctor_name
 * @property integer $creator_doctor_id
 * @property string $creator_doctor_name
 * @property string $creator_hospital_name
 * @property string $creator_dept_name
 * @property integer $final_doctor_id
 * @property string $final_doctor_name
 * @property integer $final_hospital_id
 * @property string $final_hospital_name
 * @property string $final_time
 * @property integer $disease_confirm
 * @property string $customer_request
 * @property integer $customer_intention
 * @property integer $customer_type
 * @property string $customer_diversion
 * @property string $customer_agent
 * @property integer $booking_status
 * @property integer $order_status
 * @property string $order_amount
 * @property integer $admin_user_id
 * @property string $admin_user_name
 * @property integer $bd_user_id
 * @property string $bd_user_name
 * @property string $remark
 * @property integer $display_order
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 *
 * The followings are the available model relations:
 * @property AdminBookingFile[] $adminBookingFiles
 * @property AdminTaskBkJoin[] $adminTaskBkJoins
 */
class AdminBooking extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'admin_booking';
    }

    const BK_TYPE_CRM = 0;
    const BK_TYPE_BK = 1;
    const BK_TYPE_PB = 2;
    const CUS_REQUEST_SHOUSHU = 'shoushu';
    const CUS_REQUEST_ZHUANZHEN = 'zhuanzhen';
    const CUS_REQUEST_WENZHEN = 'wenzhen';
    const CUS_REQUEST_MENZHEN = 'menzhen';
    const CUS_REQUEST_HUIZHEN = 'huizhen';
    const CUS_INTENTION_NOTIDEAL = 4;
    const CUS_INTENTION_NORMAL = 1;
    const CUS_INTENTION_GOOD = 2;
    const CUS_INTENTION_GREAT = 3;
//    const CUS_TYPE_UNSURE = 1;
//    const CUS_TYPE_VALIDITY = 2;
//    const CUS_TYPE_INVALID = 3;
    const CUS_TYPE_DHWRJT = 1;
    const CUS_TYPE_HZMZLX = 2;
    const CUS_TYPE_HZYZXJY = 3;
    const CUS_TYPE_JCZJMZ = 4;
    const CUS_TYPE_JSFWBJSFWF = 5;
    const CUS_TYPE_PYXWWJDQ = 6;
    const CUS_TYPE_SBWWWYX = 7;
    const CUS_TYPE_WTYJJJBXY = 8;
    const CUS_TYPE_WSSZZWXQ = 9;
    const CUS_TYPE_YSSZZ = 10;
    const CUS_TYPE_YYX = 11;
    const CUS_TYPE_ZYPTBXZ = 12;
    const CUS_DIVERSION_BAIDU = 'baidu';
    const CUS_DIVERSION_FRIEND = 'friend';
    const CUS_DIVERSION_DOCTOR = 'doctor';
    const CUS_DIVERSION_WELFARE = 'welfare';
    const CUS_AGENT_400 = 'phone400';
    const CUS_AGENT_BAIDU = 'baidu';
    const CUS_AGENT_WEBSITE = 'website';
    const CUS_AGENT_WAP = 'wap';
    const CUS_AGENT_WEIXIN = 'weixin';
    const CUS_AGENT_APP_IOS = 'ios';
    const CUS_AGENT_APP_ANDROID = 'android';
    const CUS_AGENT_BD = 'bd';
    const CUS_AGENT_DITUI = 'ditui';
    const CUS_AGENT_WEIBO = 'weibo';
    const CUS_AGENT_FRIEND = 'friend';
    const CUS_AGENT_DOCTOR = 'doctor';
    const CUS_AGENT_BJ_OFFICE = 'bj_office';
    const CUS_AGENT_TUOSHI = 'tuoshi';
    const CUS_AGENT_XIAONENG_MSG = 'xiaoneng_msg';
    const CUS_AGENT_XIAONENG_OL = 'xiaoneng_ol';
    const DISEASE_CONFIRM_NO = 0;
    const DISEASE_CONFIRM_YES = 1;
    const ORDER_STATUS_NO = 0;
    const ORDER_STATUS_YES = 1;
    const IS_COMMONWEAL_NO = 0;
    const IS_COMMONWEAL_YES = 1;
    const BUSINESS_PARTNER_160 = '160';
    const BUSINESS_PARTNER_TUISHI = 'tuoshi';
    const BUSINESS_PARTNER_ALI = 'ali';
    const BUSINESS_PARTNER_DIDI = 'didi';
    const BUSINESS_PARTNER_TMALL = 'tmall';
    const BUSINESS_PARTNER_OTHER = 'other';

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('booking_id, booking_type, patient_id, state_id, city_id, expected_hospital_id, expected_hp_dept_id, expected_doctor_id, creator_doctor_id, final_doctor_id, final_hospital_id, disease_confirm, customer_intention, customer_type, booking_status, order_status, admin_user_id, bd_user_id, display_order', 'numerical', 'integerOnly' => true),
            array('ref_no, patient_name, order_amount, patient_age, bd_user_name', 'length', 'max' => 20),
            array('patient_mobile', 'length', 'max' => 11),
            array('patient_identity', 'length', 'max' => 18),
            array('patient_state, patient_city', 'length', 'max' => 10),
            array('patient_address, disease_detail', 'length', 'max' => 200),
            array('disease_name, final_hospital_name', 'length', 'max' => 100),
            array('expected_hospital_name, expected_hp_dept_name, expected_doctor_name, creator_doctor_name, creator_hospital_name, creator_dept_name, final_doctor_name, admin_user_name, customer_request, customer_diversion, customer_agent', 'length', 'max' => 50),
            array('remark', 'length', 'max' => 2000),
            array('deposit_total, deposit_paid, service_total, service_paid, business_partner, is_commonweal, contact_name, contact_name, patient_gender, expected_time_start, expected_time_end, final_time, date_updated, date_deleted, expected_hp_dept_name, expected_doctor_name, final_doctor_name, expected_doctor_mobile, final_doctor_mobile', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, booking_id, booking_type, ref_no, patient_id, patient_name, patient_mobile, patient_age, patient_gender, patient_identity, state_id, city_id, patient_state, patient_city, patient_address, disease_name, disease_detail, expected_time_start, expected_time_end, expected_hospital_id, expected_hospital_name, expected_hp_dept_id, expected_hp_dept_name, expected_doctor_id, expected_doctor_name, creator_doctor_id, creator_doctor_name, creator_hospital_name, creator_dept_name, final_doctor_id, final_doctor_name, final_hospital_id, final_hospital_name, final_time, disease_confirm, customer_request, customer_intention, customer_type, customer_diversion, customer_agent, booking_status, order_status, order_amount, admin_user_id, admin_user_name, bd_user_id, bd_user_name, remark, display_order, deposit_total, deposit_paid, service_total, service_paid, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'adminBookingFiles' => array(self::HAS_MANY, 'AdminBookingFile', 'admin_booking_id'),
            'adminTaskBkJoins' => array(self::HAS_MANY, 'AdminTaskBkJoin', 'admin_booking_id'),
            'orderAdminbooking' => array(self::HAS_MANY, 'SalesOrder', 'admin_booking_id'),
            'bkOwner' => array(self::BELONGS_TO, 'User', 'creator_doctor_id'),
            'pbUserDoctorProfile' => array(self::BELONGS_TO, 'UserDoctorProfile', 'creator_doctor_id'),
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
            'state_id' => '患者所在省ID',
            'city_id' => '患者所在市ID',
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
            'creator_doctor_id' => '推送医生ID',
            'creator_doctor_name' => '推送医生姓名',
            'creator_hospital_name' => '推送医生医院',
            'creator_dept_name' => '推送医生科室',
            'final_doctor_id' => '手术医生ID',
            'final_doctor_name' => '手术医生',
            'final_hospital_id' => '手术医院ID',
            'final_hospital_name' => '手术医院ID',
            'final_time' => '最终手术时间',
            'disease_confirm' => '是否确诊',
            'customer_request' => '客户需求',
            'customer_intention' => '客户满意度',
            'customer_type' => '客户类型',
            'customer_diversion' => '客户导流',
            'customer_agent' => '平台渠道来源',
            'booking_status' => '预约状态',
            'order_status' => '付费状态',
            'order_amount' => '付费金额',
            'admin_user_id' => '业务员ID',
            'admin_user_name' => '业务员',
            'bd_user_id' => '地推人员ID',
            'bd_user_name' => '地推人员',
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
        $criteria->compare('state_id', $this->state_id);
        $criteria->compare('city_id', $this->city_id);
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
        $criteria->compare('expected_doctor_id', $this->expected_doctor_id);
        $criteria->compare('expected_doctor_name', $this->expected_doctor_name, true);
        $criteria->compare('creator_doctor_id', $this->creator_doctor_id);
        $criteria->compare('creator_doctor_name', $this->creator_doctor_name, true);
        $criteria->compare('creator_hospital_name', $this->creator_hospital_name, true);
        $criteria->compare('creator_dept_name', $this->creator_dept_name, true);
        $criteria->compare('final_doctor_id', $this->final_doctor_id);
        $criteria->compare('final_doctor_name', $this->final_doctor_name, true);
        $criteria->compare('final_hospital_id', $this->final_hospital_id);
        $criteria->compare('final_hospital_name', $this->final_hospital_name, true);
        $criteria->compare('final_time', $this->final_time, true);
        $criteria->compare('disease_confirm', $this->disease_confirm);
        $criteria->compare('customer_request', $this->customer_request, true);
        $criteria->compare('customer_intention', $this->customer_intention);
        $criteria->compare('customer_type', $this->customer_type);
        $criteria->compare('customer_diversion', $this->customer_diversion, true);
        $criteria->compare('customer_agent', $this->customer_agent, true);
        $criteria->compare('booking_status', $this->booking_status);
        $criteria->compare('order_status', $this->order_status);
        $criteria->compare('order_amount', $this->order_amount, true);
        $criteria->compare('admin_user_id', $this->admin_user_id);
        $criteria->compare('admin_user_name', $this->admin_user_name, true);
        $criteria->compare('bd_user_id', $this->bd_user_id);
        $criteria->compare('bd_user_name', $this->bd_user_name, true);
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

    //去掉不为空字段的空格
    protected function trimAttributes() {
        return array('expected_time_start', 'expected_time_end');
    }

    public function beforeSave() {
        if (strIsEmpty($this->expected_time_start)) {
            $this->expected_time_start = null;
        }
        if (strIsEmpty($this->expected_time_end)) {
            $this->expected_time_end = null;
        }
        if (is_null($this->deposit_total)) {
            $this->deposit_total = 0;
        }
        if (is_null($this->deposit_paid)) {
            $this->deposit_paid = 0;
        }
        if (is_null($this->service_total)) {
            $this->service_total = 0;
        }
        if (is_null($this->service_paid)) {
            $this->service_paid = 0;
        }
        return parent::beforeSave();
    }

    public function beforeValidate() {
        $this->createRefNumber();
        return parent::beforeValidate();
    }

    private function createRefNumber() {
        if (strIsEmpty($this->ref_no)) {
            $flag = true;
            while ($flag) {
                $refNumber = $this->getRefNumberPrefix() . date("ymd") . str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_LEFT);
                if ($this->exists('t.ref_no =:refno', array(':refno' => $refNumber)) == false) {
                    $this->ref_no = $refNumber;
                    $flag = false;
                }
            }
        }
    }

    public function getCreator() {
        return $this->bkOwner;
    }

    /**
     * Return ref_no prefix charactor based on bk_type
     * default 'AA' is an eception charactor
     * @return string
     */
    private function getRefNumberPrefix() {
        switch ($this->booking_type) {
            case StatCode::BK_TYPE_DOCTOR :
                return "DR";
            case StatCode::BK_TYPE_EXPERTTEAM :
                return "ET";
            case StatCode::BK_TYPE_QUICKBOOK :
                return "QB";
            case StatCode::BK_TYPE_DEPT :
                return "HP";
            case self::BK_TYPE_CRM :
                return "BK";
            default:
                return "AA";
        }
    }

    /**
     *  options getters 
     */
    public function getOptionsBookingType() {
        return array(
            self::BK_TYPE_BK => '患者端预约',
            self::BK_TYPE_PB => '医生端预约',
            self::BK_TYPE_CRM => '系统端预约',
        );
    }

    public function getOptionsCustomerRequest() {
        return array(
            self::CUS_REQUEST_SHOUSHU => '手术',
            self::CUS_REQUEST_ZHUANZHEN => '转诊',
            self::CUS_REQUEST_WENZHEN => '问诊',
            self::CUS_REQUEST_MENZHEN => '门诊',
            self::CUS_REQUEST_HUIZHEN => '会诊',
        );
    }

    public function getOptionsCustomerIntention() {
        return array(
            self::CUS_INTENTION_GREAT => '优质',
            self::CUS_INTENTION_GOOD => '良好',
            self::CUS_INTENTION_NORMAL => '一般',
            self::CUS_INTENTION_NOTIDEAL => '不理想',
        );
    }

    public function getOptionsCustomerType() {
        return array(
            self::CUS_TYPE_DHWRJT => '电话无人接听',
            self::CUS_TYPE_HZMZLX => '患者忙再联系',
            self::CUS_TYPE_HZYZXJY => '患者已自行就医',
            self::CUS_TYPE_JCZJMZ => '坚持自己面诊',
            self::CUS_TYPE_JSFWBJSFWF => '接受服务不接受费用',
            self::CUS_TYPE_PYXWWJDQ => '朋友询问无决定权',
            self::CUS_TYPE_SBWWWYX => '随便问问无意向',
            self::CUS_TYPE_WTYJJJBXY => '问题已经解决不需要',
            self::CUS_TYPE_WSSZZWXQ => '无手术指征无需求',
            self::CUS_TYPE_YSSZZ => '有手术指征',
            self::CUS_TYPE_YYX => '有意向',
            self::CUS_TYPE_ZYPTBXZ => '质疑平台不信任',
        );
    }

    public function getOptionsCustomerDiversion() {
        return array(
            self:: CUS_DIVERSION_BAIDU => '百度搜索',
            self:: CUS_DIVERSION_FRIEND => '朋友推荐',
            self:: CUS_DIVERSION_DOCTOR => '医生推荐',
                //self:: CUS_DIVERSION_WELFARE => '公益项目',
        );
    }

    public function getOptionsCustomerAgent() {
        return array(
            self:: CUS_AGENT_400 => '400热线',
            self:: CUS_AGENT_BAIDU => '百度商桥',
            self:: CUS_AGENT_WEBSITE => '网站',
            self:: CUS_AGENT_WAP => '手机网站',
            self:: CUS_AGENT_WEIXIN => '微信',
            self:: CUS_AGENT_APP_IOS => '苹果APP',
            self:: CUS_AGENT_APP_ANDROID => '安卓APP',
            self:: CUS_AGENT_BD => 'BD',
            self:: CUS_AGENT_DITUI => '地推',
            self:: CUS_AGENT_WEIBO => '微博',
            self:: CUS_AGENT_FRIEND => '熟人',
            self:: CUS_AGENT_DOCTOR => '下级医生',
            self:: CUS_AGENT_BJ_OFFICE => '北京办介绍',
            self:: CUS_AGENT_TUOSHI => '拓实企业用户',
            self:: CUS_AGENT_XIAONENG_MSG => '在线小能留言',
            self:: CUS_AGENT_XIAONENG_OL => '在线小能在线',
        );
    }

    public function getOptionBusinessPartner() {
        return array(
            self:: BUSINESS_PARTNER_160 => '就医160',
            self:: BUSINESS_PARTNER_TUISHI => '拓实医疗',
            self:: BUSINESS_PARTNER_ALI => '阿里健康',
            self:: BUSINESS_PARTNER_DIDI => '滴滴出行',
            self:: BUSINESS_PARTNER_TMALL => '天猫医药馆',
            self:: BUSINESS_PARTNER_OTHER => '其它B端合作',
        );
    }

    public function getPatientGender($text = true) {
        if ($text) {
            $options = StatCode::getOptionsGender();
            if (isset($options[$this->patient_gender])) {
                return $options[$this->patient_gender];
            } else {
                return null;
            }
        } else {
            return $this->patient_gender;
        }
    }

    public function getBusinessPartner() {
        $options = self::getOptionBusinessPartner();
        if (isset($options[$this->business_partner])) {
            return $options[$this->business_partner];
        } else {
            return null;
        }
    }

    public function getBookingType() {
        $options = self::getOptionsBookingType();
        if (isset($options[$this->booking_type])) {
            return $options[$this->booking_type];
        } else {
            return null;
        }
    }

    public function getCustomerRequest() {
        $options = self::getOptionsCustomerRequest();
        if (isset($options[$this->customer_request])) {
            return $options[$this->customer_request];
        } else {
            return null;
        }
    }

    public function getCustomerIntention() {
        $options = self::getOptionsCustomerIntention();
        if (isset($options[$this->customer_intention])) {
            return $options[$this->customer_intention];
        } else {
            return null;
        }
    }

    public function getCustomerType() {
        $options = self::getOptionsCustomerType();
        if (isset($options[$this->customer_type])) {
            return $options[$this->customer_type];
        } else {
            return null;
        }
    }

    public function getCustomerDiversion() {
        $options = self::getOptionsCustomerDiversion();
        if (isset($options[$this->customer_diversion])) {
            return $options[$this->customer_diversion];
        } else {
            return null;
        }
    }

    public function getCustomerAgent() {
        $options = self::getOptionsCustomerAgent();
        if (isset($options[$this->customer_agent])) {
            return $options[$this->customer_agent];
        } else {
            return null;
        }
    }

    public static function getOptionsBookingStatus() {
        return array(
            StatCode::BK_STATUS_NEW => '待处理',
            StatCode::BK_STATUS_PROCESSING => '安排中',
//            StatCode::BK_STATUS_CONFIRMED_DOCTOR => '专家已确认',
//            StatCode::BK_STATUS_PATIENT_ACCEPTED => '患者已接受',
            StatCode::BK_STATUS_SERVICE_UNPAID => '待支付服务费',
            StatCode::BK_STATUS_SERVICE_PAIDED => '已完成（支付完服务费）',
            StatCode::BK_STATUS_PROCESS_DONE => '跟进结束',
            //StatCode::BK_STATUS_DONE => '已完成',
            StatCode::BK_STATUS_CHECKOUT => '已结账',
            StatCode::BK_STATUS_INVALID => '跟进无效',
            StatCode::BK_STATUS_NULLIFY => '作废',
            //StatCode::BK_STATUS_CANCELLED => '已取消'
            StatCode::BK_STATUS_REFUNDING => '申请退款',
            StatCode::BK_STATUS_REFUNDED => '已退款',
        );
    }

    public function getBookingStatus() {
        $options = StatCode::getOptionsBookingStatus();
        if (isset($options[$this->booking_status])) {
            return $options[$this->booking_status];
        } else {
            return null;
        }
    }

    public function getWorkSchedule() {
        $options = StatCode::getOptionsBookingStatus();
        if (isset($options[$this->work_schedule])) {
            return $options[$this->work_schedule];
        } else {
            return null;
        }
    }

    public function getTravelType($text = true) {
        if ($text) {
            return StatCode::getBookingTravelType($this->travel_type);
        } else {
            return $this->travel_type;
        }
    }

    public static function getOptionsDiseaseConfirm() {
        return array(
            self::DISEASE_CONFIRM_YES => '是',
            self::DISEASE_CONFIRM_NO => '否',
        );
    }

    public function getDiseaseConfirm($v = true) {
        if ($v) {
            $options = self::getOptionsDiseaseConfirm();
            if (isset($options[$this->disease_confirm])) {
                return $options[$this->disease_confirm];
            } else {
                return null;
            }
        } else {
            $this->disease_confirm;
        }
    }

    public static function getOptionsOrderStatus() {
        return array(
            self::ORDER_STATUS_NO => '未付费',
            self::ORDER_STATUS_YES => '已付费',
        );
    }

    public function getOrderStatus($v = true) {
        if ($v) {
            $options = self::getOptionsOrderStatus();
            if (isset($options[$this->order_status])) {
                return $options[$this->order_status];
            } else {
                return null;
            }
        } else {
            $this->order_status;
        }
    }

    public static function getOptionsIsCommonweal() {
        return array(
            self::IS_COMMONWEAL_NO => '否',
            self::IS_COMMONWEAL_YES => '是',
        );
    }

    public function getIsCommonweal($v = true) {
        if ($v) {
            $options = self::getOptionsIsCommonweal();
            if (isset($options[$this->is_commonweal])) {
                return $options[$this->is_commonweal];
            } else {
                return null;
            }
        } else {
            $this->is_commonweal;
        }
    }

    public function getAdminUserList() {
        $adminUsers = AdminUser::model()->getAllByAttributes(array('role' => AdminBookingForm::ADMIN_USER_ROLE_CS));
        $adminUserOptions = array();
        foreach ($adminUsers as $value) {
            $std = new stdClass();
            $std->id = $value->id;
            $std->fullname = strIsEmpty($value->title) ? $value->fullname : $value->title . ' ' . $value->fullname;
            $adminUserOptions[] = $std;
        }
        return CHtml::listData($adminUserOptions, 'id', 'fullname');
    }

    public function getBdUserList() {
        $adminUsers = AdminUser::model()->getAllByAttributes(array('role' => AdminBookingForm::ADMIN_USER_ROLE_BD));
        $adminUserOptions = array();
        foreach ($adminUsers as $value) {
            $std = new stdClass();
            $std->id = $value->id;
            $std->fullname = strIsEmpty($value->title) ? $value->fullname : $value->title . ' ' . $value->fullname;
            $adminUserOptions[] = $std;
        }
        return CHtml::listData($adminUserOptions, 'id', 'fullname');
        //return CHtml::listData(AdminUser::model()->getAllByAttributes(array('role' => AdminBookingForm::ADMIN_USER_ROLE_BD)), 'id', 'fullname');
    }

    public function setFinalDoctorId($id) {
        $this->final_doctor_id = $id;
    }

    public function setFinalDoctorName($id) {
        $this->final_doctor_name = $id;
    }

    public function addDepositTotal($v) {
        $this->deposit_total += $v;
    }

    public function addServiceTotal($v) {
        $this->service_total += $v;
    }

}
