<?php

/**
 * This is the model class for table "admin_user_sms_join".
 *
 * The followings are the available columns in table 'admin_user_sms_join':
 * @property integer $id
 * @property integer $admin_user_id
 * @property string $admin_user_name
 * @property string $admin_user_title
 * @property integer $msg_sms_id
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class AdminUserSmsJoin extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'admin_user_sms_join';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, admin_user_id, admin_booking_id, msg_sms_id', 'numerical', 'integerOnly' => true),
            array('admin_user_name, admin_user_title', 'length', 'max' => 20),
            array('date_created, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, admin_user_id, admin_user_name, admin_user_title, msg_sms_id, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'msgSmsLog' => array(self::BELONGS_TO, 'MsgSmsLog', '','on'=>'t.msg_sms_id = msgSmsLog.id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'admin_user_id' => '发送的客服ID',
            'admin_user_name' => '客服姓名',
            'admin_user_title' => '角色抬头',
            'msg_sms_id' => '短信信息ID',
            'date_created' => '创建时间',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
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
        $criteria->compare('admin_user_id', $this->admin_user_id);
        $criteria->compare('admin_user_name', $this->admin_user_name, true);
        $criteria->compare('admin_user_title', $this->admin_user_title, true);
        $criteria->compare('msg_sms_id', $this->msg_sms_id);
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
     * @return AdminUserSmsJoin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
