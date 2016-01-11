<?php

class DoctorSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {
        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new Doctor();
    }

    public function getQueryFields() {
        return array('city', 'disease', 'hospital', 'hpdept', 'mtitle');
    }

    public function addQueryConditions() {
        $this->criteria->addCondition('t.date_deleted is NULL');

        if ($this->hasQueryParams()) {
            // Doctor.medical_title
            if (isset($this->queryParams['mtitle'])) {
                $mtitle = $this->queryParams['mtitle'];
                $this->criteria->compare('t.medical_title', $mtitle);
            }
            // City.
            if (isset($this->queryParams['city'])) {
                $cityId = $this->queryParams['city'];
                $this->criteria->compare('t.city_id', $cityId);
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
