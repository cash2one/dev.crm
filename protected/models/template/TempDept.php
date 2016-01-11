<?php

/**
 * This is the model class for table "zz_temp_dept".
 *
 * The followings are the available columns in table 'zz_temp_dept':
 * @property integer $id
 * @property integer $hp_id
 * @property string $full_name
 * @property string $group
 * @property string $dept_name
 * @property string $doc_a
 * @property integer $doc_aid
 * @property string $doc_b
 * @property integer $doc_bid
 * @property string $doc_c
 * @property integer $doc_cid
 * @property string $doc_d
 * @property integer $doc_did
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_deleted
 */
class TempDept extends EActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zz_temp_dept';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hp_id, doc_aid, doc_bid, doc_cid, doc_did', 'numerical', 'integerOnly'=>true),
			array('full_name, group, dept_name, doc_a, doc_b, doc_c, doc_d', 'length', 'max'=>255),
			array('date_created, date_updated, date_deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hp_id, full_name, group, dept_name, doc_a, doc_aid, doc_b, doc_bid, doc_c, doc_cid, doc_d, doc_did, date_created, date_updated, date_deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hp_id' => 'Hp',
			'full_name' => 'Full Name',
			'group' => 'Group',
			'dept_name' => 'Dept Name',
			'doc_a' => 'Doc A',
			'doc_aid' => 'Doc Aid',
			'doc_b' => 'Doc B',
			'doc_bid' => 'Doc Bid',
			'doc_c' => 'Doc C',
			'doc_cid' => 'Doc Cid',
			'doc_d' => 'Doc D',
			'doc_did' => 'Doc Did',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('hp_id',$this->hp_id);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('group',$this->group,true);
		$criteria->compare('dept_name',$this->dept_name,true);
		$criteria->compare('doc_a',$this->doc_a,true);
		$criteria->compare('doc_aid',$this->doc_aid);
		$criteria->compare('doc_b',$this->doc_b,true);
		$criteria->compare('doc_bid',$this->doc_bid);
		$criteria->compare('doc_c',$this->doc_c,true);
		$criteria->compare('doc_cid',$this->doc_cid);
		$criteria->compare('doc_d',$this->doc_d,true);
		$criteria->compare('doc_did',$this->doc_did);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('date_deleted',$this->date_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TempDept the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
