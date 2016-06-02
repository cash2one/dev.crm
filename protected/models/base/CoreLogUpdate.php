<?php

/**
 * This is the model class for table "admin_update_log".
 *
 * The followings are the available columns in table 'admin_update_log':
 * @property integer $id
 * @property integer $admin_user_id
 * @property string $admin_user_name
 * @property string $data_class
 * @property string $data_before
 * @property string $data_updated
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class CoreLogUpdate extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'core_log_update';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('admin_user_id', 'numerical', 'integerOnly' => true),
            array('admin_user_name', 'length', 'max' => 20),
            array('data_class', 'length', 'max' => 50),
            array('data_before, data_updated', 'length', 'max' => 2000),
            array('date_created, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, admin_user_id, admin_user_name, data_class, data_before, data_updated, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
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
            'admin_user_id' => '管理员ID',
            'admin_user_name' => '管理员姓名',
            'data_class' => '更新数据的类',
            'data_before' => '更新之前的数据',
            'data_updated' => '更新之后的数据',
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
        $criteria->compare('admin_user_name', $this->admin_user_name, true);
        $criteria->compare('data_class', $this->data_class, true);
        $criteria->compare('data_before', $this->data_before, true);
        $criteria->compare('data_updated', $this->data_updated, true);
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
     * @return CoreLogUpdate the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
