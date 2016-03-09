<?php

class SalesOrderSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {
        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new SalesOrder();
    }

//refNo orderType crmNo bkType finalAmount isPaid
    public function getQueryFields() {
        return array('refNo', 'bkType', 'orderType', 'pingId', 'finalAmount', 'isPaid', 'dateOpenStart', 'dateOpenEnd', 'dateClosedStart', 'dateClosedEnd', 'bdCode');
    }

    public function addQueryConditions() {
        $this->criteria->join = 'left join sales_payment s on (t.`id`=s.`order_id` and s.payment_status = ' . StatCode::PAY_SUCCESS . ')';
        //外键关联 不是支付成功的不
        if ($this->hasQueryParams()) {
            if (isset($this->queryParams['refNo'])) {
                $refNo = $this->queryParams['refNo'];
                $this->criteria->compare('t.ref_no', $refNo, true);
            }
            if (isset($this->queryParams['bkType'])) {
                $bkType = $this->queryParams['bkType'];
                $this->criteria->compare("t.bk_type", $bkType);
            }
            if (isset($this->queryParams['orderType'])) {
                $orderType = $this->queryParams['orderType'];
                $this->criteria->compare("t.order_type", $orderType);
            }
            if (isset($this->queryParams['pingId'])) {
                $pingId = $this->queryParams['pingId'];
                $this->criteria->compare("t.ping_id", $pingId, true);
            }
            if (isset($this->queryParams['finalAmount'])) {
                $finalAmount = $this->queryParams['finalAmount'];
                $this->criteria->compare("t.final_amount", $finalAmount);
            }
//            if (isset($this->queryParams['isPaid'])) {
//                $isPaid = $this->queryParams['isPaid'];
//                $this->criteria->compare("t.is_paid", $isPaid);
//            }
            if (isset($this->queryParams['isPaid'])) {
                $isPaid = $this->queryParams['isPaid'];
                if ($isPaid == 9) {
                    $this->criteria->compare("t.is_paid", 0);
                } else {
                    $this->criteria->compare("t.is_paid", $isPaid);
                }
            }
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

        //去掉测试的支付
        $this->criteria->addCondition("t.final_amount > 1");
    }

}
