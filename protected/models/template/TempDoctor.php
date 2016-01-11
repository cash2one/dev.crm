<?php

/**
 * This is the model class for table "zz_temp_doctor".
 *
 * The followings are the available columns in table 'zz_temp_doctor':
 * @property integer $id
 * @property string $name
 * @property string $hp_name
 * @property string $m_title
 * @property string $a_title
 * @property string $dis_tags
 * @property string $desc
 * @property string $gender
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class TempDoctor extends EActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'zz_temp_doctor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, hp_name, m_title, a_title, dis_tags, desc, gender', 'length', 'max' => 255),
            array('date_created, date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, hp_name, m_title, a_title, dis_tags, desc, gender, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
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
            'name' => 'Name',
            'hp_name' => 'Hp Name',
            'm_title' => 'M Title',
            'a_title' => 'A Title',
            'dis_tags' => 'Dis Tags',
            'desc' => 'Desc',
            'gender' => 'Gender',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('hp_name', $this->hp_name, true);
        $criteria->compare('m_title', $this->m_title, true);
        $criteria->compare('a_title', $this->a_title, true);
        $criteria->compare('dis_tags', $this->dis_tags, true);
        $criteria->compare('desc', $this->desc, true);
        $criteria->compare('gender', $this->gender, true);
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
     * @return TempDoctor the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
