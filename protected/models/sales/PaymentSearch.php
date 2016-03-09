<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaymentSearch
 *
 * @author shuming
 */
class PaymentSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {

        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new SalesOrder();
    }

    public function getQueryFields() {
        return array('dateOpenStart', 'dateOpenEnd', 'dateClosedStart', 'dateClosedEnd', 'bdCode');
    }

    public function addQueryConditions() {
        $this->criteria->select = 'sum(t.final_amount) as final_amount';
        //只查已支付的
        $this->criteria->compare("t.is_paid", StatCode::PAY_SUCCESS);
        //去掉测试的支付
        $this->criteria->addCondition("t.final_amount > 1");
        if ($this->hasQueryParams()) {
            if (isset($this->queryParams['dateOpenStart'])) {
                $dateOpenStart = $this->queryParams['dateOpenStart'];
                $this->criteria->addCondition("t.date_open >= '" . $dateOpenStart . "'");
            }
            if (isset($this->queryParams['dateOpenEnd'])) {
                $dateOpenEnd = $this->queryParams['dateOpenEnd'];
                $this->criteria->addCondition("t.date_open <= '" . $dateOpenEnd . "'");
            }
            if (isset($this->queryParams['dateClosedStart'])) {
                $dateClosedStart = $this->queryParams['dateClosedStart'];
                $this->criteria->addCondition("t.date_closed <= '" . $dateClosedStart . "'");
            }
            if (isset($this->queryParams['dateClosedEnd'])) {
                $dateClosedEnd = $this->queryParams['dateClosedEnd'];
                $this->criteria->addCondition("t.date_closed <= '" . $dateClosedEnd . "'");
            }
            if (isset($this->queryParams['bdCode'])) {
                $bdCode = $this->queryParams['bdCode'];
                $this->criteria->compare("t.bd_code", $bdCode, true);
            }
        }
    }

}
