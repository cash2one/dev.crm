<?php

/**
 * This is the model class for table "admin_user_login_log".
 *
 * The followings are the available columns in table 'admin_user_login_log':
 * @property integer $id
 * @property integer $admin_user_id
 * @property string $login_ip
 * @property integer $is_success
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class AdminUserLoginLog extends EActiveRecord {

    const LOGIN_SUCCESS = 1;
    const LOGIN_FAILED = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'admin_user_login_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('admin_user_id, is_success', 'numerical', 'integerOnly' => true),
            array('login_ip', 'length', 'max' => 20),
            array('date_created, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, admin_user_id, login_ip, is_success, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
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
            'admin_user_id' => 'Admin User',
            'login_ip' => '登录IP地址',
            'is_success' => '是否成功登录',
            'date_created' => 'Date Created',
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
        $criteria->compare('login_ip', $this->login_ip, true);
        $criteria->compare('is_success', $this->is_success);
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
     * @return AdminUserLoginLog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
