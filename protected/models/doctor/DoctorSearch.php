<?php

class DoctorSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {
        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new Doctor();
    }

    public function getQueryFields() {
        return array('city', 'state', 'disease', 'hospital', 'hpdept', 'mTitle', 'aTitle', 'name', 'hpName', 'hpDeptName', 'role', 'isContracted');
    }

    public function addQueryConditions() {
        $this->criteria->addCondition('t.date_deleted is NULL');

        if ($this->hasQueryParams()) {
            // Doctor.name
            if (isset($this->queryParams['name'])) {
                $name = $this->queryParams['name'];
                $this->criteria->addSearchCondition('t.name', $name);
            }
            // Doctor.hospitalname
            if (isset($this->queryParams['hpName'])) {
                $hpName = $this->queryParams['hpName'];
                $this->criteria->addSearchCondition('t.hospital_name', $hpName);
            }
            // Doctor.hpDeptName
            if (isset($this->queryParams['hpDeptName'])) {
                $hpDeptName = $this->queryParams['hpDeptName'];
                $this->criteria->addSearchCondition('t.hp_dept_name', $hpDeptName);
            }
            // Doctor.medical_title
            if (isset($this->queryParams['mTitle'])) {
                $mtitle = $this->queryParams['mTitle'];
                $this->criteria->compare('t.medical_title', $mtitle);
            }
            // Doctor.medical_title
            if (isset($this->queryParams['aTitle'])) {
                $aTitle = $this->queryParams['aTitle'];
                $this->criteria->compare('t.academic_title', $aTitle);
            }
            // City.
            if (isset($this->queryParams['city'])) {
                $cityId = $this->queryParams['city'];
                $this->criteria->compare('t.city_id', $cityId);
            }
            // State.
            if (isset($this->queryParams['state'])) {
                $stateId = $this->queryParams['state'];
                $this->criteria->compare('t.state_id', $stateId);
            }
            // role.
            if (isset($this->queryParams['role'])) {
                $role = $this->queryParams['role'];
                $this->criteria->compare('t.role', $role);
            }
            // isContracted.
            if (isset($this->queryParams['isContracted'])) {
                $isContracted = $this->queryParams['isContracted'];
                $this->criteria->compare('t.is_contracted', $isContracted);
            }
            // Disease.
            if (isset($this->queryParams['disease'])) {
                $diseaseId = $this->queryParams['disease'];
                $this->criteria->join .= 'left join disease_doctor_join ddj on (t.`id`=ddj.`doctor_id`)';
                $this->criteria->compare("ddj.disease_id", $diseaseId);
                $this->criteria->distinct = true;
            }
            if (isset($this->queryParams['hospital'])) {
                $hospitalId = $this->queryParams['hospital'];
                $this->criteria->compare("t.hospital_id", $hospitalId);
            }
            if (isset($this->queryParams['hpdept'])) {
                $hpdeptId = $this->queryParams['hpdept'];
                $this->criteria->join .= 'left join hospital_dept_doctor_join hddj on (t.`id`=hddj.`doctor_id`)';
                $this->criteria->compare("hddj.hp_dept_id", $hpdeptId);
                $this->criteria->distinct = true;
            }
        }
    }

}
