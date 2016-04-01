<?php

/**
 * Description of DoctorFormAdmin
 * @author shuming
 */
class AdminUserRegionJoinForm extends EFormModel {

    public $admin_user_id;
    public $admin_user_role;
    public $booking_type;
    public $state_id;
    public $city_id;
    public $default;
    public $did_list_db;        //did in db
    public $did_list_input;
    public $did_list_delete;    // sql delete
    public $did_list_insert;    // sql insert

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('date_created', 'required'),
            array('admin_user_role, booking_type, admin_user_id, state_id, city_id, default', 'numerical', 'integerOnly' => true),
            array('date_updated, date_deleted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, admin_user_role, booking_type, admin_user_id, state_id, city_id, default, date_created, date_updated, date_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'admin_user_role' => 'Admin User Role',
            'booking_type' => 'booking=1,patientbooking=2',
            'admin_user_id' => 'Admin User',
            'state_id' => 'State',
            'city_id' => 'City',
            'default' => '1=yes 0=no',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_deleted' => 'Date Deleted',
        );
    }

    public function initModel($id, $type, $statesData) {
        $this->admin_user_id = $id;
        $this->booking_type = $type;
        $this->did_list_db = $statesData;
    }

    public function setStateListInput(array $stateIds, $process = true) {
        $this->did_list_input = $stateIds;
        if ($process) {
            $this->createStateListInsert();
            $this->createStateListDelete();
        }
    }

    public function createStateListDelete() {
        $this->did_list_delete = array_diff($this->did_list_db, $this->did_list_input);
    }

    public function createStateListInsert() {
        $this->did_list_insert = array_diff($this->did_list_input, $this->did_list_db);
    }

    public function getAdminUserId() {
        return $this->admin_user_id;
    }

    public function getStateListDelete() {
        return $this->did_list_delete;
    }

    public function getStateListInsert() {
        return $this->did_list_insert;
    }

}
