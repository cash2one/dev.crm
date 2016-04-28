<?php

class OrderController extends AdminController {

    private $model;
    private $booking;
    private $patientBooking;

    public function filterSalesOrderContext($filterChain) {
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else if (isset($_POST['order']['id'])) {
            $id = $_POST['order']['id'];
        }

        $this->loadModelById($id);

        //complete the running of other filters and execute the requested action.
        $filterChain->run();
    }

    public function filterBkContext($filterChain) {
        $bookingId = null;
        if (isset($_GET['bid'])) {
            $bookingId = $_GET['bid'];
        } else if (isset($_POST['order']['bk_id'])) {
            $bookingId = $_POST['order']['bk_id'];
        }
        $this->loadBookingById($bookingId);

        //complete the running of other filters and execute the requested action.
        $filterChain->run();
    }

    public function filterAdminBkContext($filterChain) {
        $bookingId = null;
        if (isset($_GET['bid'])) {
            $bookingId = $_GET['bid'];
        } else if (isset($_POST['order']['bk_id'])) {
            $bookingId = $_POST['order']['bk_id'];
        }
        $this->loadAdminBookingById($bookingId);

        //complete the running of other filters and execute the requested action.
        $filterChain->run();
    }

    public function filterPbContext($filterChain) {
        $bookingId = null;
        if (isset($_GET['bid'])) {
            $bookingId = $_GET['bid'];
        } else if (isset($_POST['order']['bk_id'])) {
            $bookingId = $_POST['order']['bk_id'];
        }
        $this->loadPatientBookingById($bookingId);

        //complete the running of other filters and execute the requested action.
        $filterChain->run();
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'salesOrderContext + view',
            'bkContext + createBKOrder',
            'pbContext + createPBOrder',
            'adminBKContext + createAdminBKOrder',
            'adminBKContext + createOfflineOrder',
            'rights',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            /*
              array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions' => array('create', 'update'),
              'users' => array('@'),
              ),
             */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'create', 'createBKOrder', 'createPBOrder', 'view', 'search', 'searchResult', 'createAdminBKOrder', 'countAmount', 'deleteOrder', 'createOfflineOrder'),
//                'users' => array('superbeta'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $model = $this->model;
        //$model = $this->loadModelById($id);
        $this->render('view', array('model' => $model));
    }

    public function actionCreateBKOrder($bid) {
        //  $booking = Booking::model()->getById($bid);
        $booking = $this->booking;
        $order = new SalesOrder();
        $order->bk_id = $booking->getId();
        $order->bk_type = StatCode::TRANS_TYPE_BK;
        $order->bk_ref_no = $booking->getRefNo();
        $order->user_id = $booking->getUserId();
        $order->subject = $booking->contact_name;
        $order->description = $booking->disease_detail;
        //$this->performAjaxValidation($order);

        if (isset($_POST['order'])) {
            $values = $_POST['order'];

            $order->setAmount($values['final_amount']);
            $order->setSubject($values['subject']);
            $order->setDescription($values['description']);
            $order->setBdCode($values['bd_code']);
            $order->setCashBack($values['cash_back']);
            $order->setIsPaid(0);
            $order->setDateOpen(new CDbExpression('NOW()'));
            $order->createRefNo($booking->ref_no, $booking->id, StatCode::TRANS_TYPE_BK);
            //$order->validate();
            if ($order->save()) {
                $this->redirect(array('view', 'id' => $order->id));
            }
        }

        $this->render('createBKOrder', array(
            'model' => $order
        ));
    }

    public function actionCreatePBOrder($bid) {
        //  $booking = Booking::model()->getById($bid);
        $booking = $this->patientBooking;
        $order = new SalesOrder();
        $order->bk_id = $booking->getId();
        $order->bk_type = StatCode::TRANS_TYPE_PB;
        $order->bk_ref_no = $booking->getRefNo();
        $order->user_id = $booking->getPatientId();
        $order->subject = $booking->patient_name;
        $order->description = $booking->detail;
        if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_PATIENT_GO) {
            $order->order_type = SalesOrder::ORDER_TYPE_SERVICE;
            $order->setAmount(1000.00);
        } else if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_DOCTOR_COME) {
            $order->order_type = SalesOrder::ORDER_TYPE_DEPOSIT;
            $order->setAmount(500.00);
        }
        //$this->performAjaxValidation($order);

        if (isset($_POST['order'])) {
            $values = $_POST['order'];
            $order->setAmount($values['final_amount']);
            $order->setSubject($values['subject']);
            $order->setDescription($values['description']);
            $order->setBdCode($values['bd_code']);
            $order->setCashBack($values['cash_back']);
            $order->setIsPaid(0);
            $order->setDateOpen(new CDbExpression('NOW()'));
            $order->createRefNo($booking->ref_no, $booking->id, StatCode::TRANS_TYPE_PB);
            if ($order->save()) {
                $this->redirect(array('view', 'id' => $order->id));
            }
        }

        $this->render('createPBOrder', array(
            'model' => $order
        ));
    }

    public function actionCreateAdminBKOrder($bid) {
        //  $booking = Booking::model()->getById($bid);
        $booking = $this->booking;
        $order = new SalesOrder();
        $order->bk_id = $booking->booking_id;
        $order->admin_booking_id = $booking->id;
        $order->bk_type = $booking->booking_type;
        $order->bk_ref_no = $booking->ref_no;
        $order->user_id = $booking->patient_id;
        $order->subject = $booking->patient_name;
        $order->description = $booking->booking_detail;
        $order->bd_code = $booking->bd_user_name;
        $order->cash_back = $booking->bd_user_name;
        if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_PATIENT_GO) {
            $order->order_type = SalesOrder::ORDER_TYPE_SERVICE;
            $order->setAmount(1000.00);
        } else if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_DOCTOR_COME) {
            $order->order_type = SalesOrder::ORDER_TYPE_DEPOSIT;
            $order->setAmount(500.00);
        } else {
            $order->order_type = SalesOrder::ORDER_TYPE_SERVICE;
        }
        //$this->performAjaxValidation($order);

        if (isset($_POST['order'])) {
            $values = $_POST['order'];

            $order->setAmount($values['final_amount']);
            $order->setSubject($values['subject']);
            $order->setDescription($values['description']);
            $order->setBdCode($values['bd_code']);
            $order->setCashBack($values['cash_back']);
            $order->setIsPaid(0);
            $order->setDateOpen(new CDbExpression('NOW()'));
            $order->order_type = $values['order_type'];
            $order->createRefNo($booking->ref_no, $booking->id, StatCode::TRANS_TYPE_AB);
            //$order->validate();
            //var_dump($order);exit;
            if ($order->save()) {
                //订单保存成功;修改admminbooking的金额
                if ($order->order_type == SalesOrder::ORDER_TYPE_DEPOSIT) {
                    $booking->addDepositTotal($order->getFinalAmount());
                } else {
                    $booking->addServiceTotal($order->getFinalAmount());
                }
                $booking->save();
                if ($booking->booking_type == StatCode::TRANS_TYPE_BK) {
                    $bookingModel = Booking::model()->getById($booking->booking_id);
                    //往160推送消息
                    if ($bookingModel->vendor_id == VendorRest::VENDOR_ID_160) {
                        $values = array(
                            'order_no' => $order->ref_no,
                            'yuyue_no' => $booking->ref_no,
                            'order_status' => StatCode::BK_STATUS_SERVICE_UNPAID,
                            'phone' => $booking->patient_mobile,
                            'true_name' => $booking->patient_name,
                            'doctor' => isset($booking->final_doctor_name) ? $booking->final_doctor_name : '',
                            'hospital' => isset($booking->final_hospital_name) ? $booking->final_hospital_name : '',
                            'dep' => isset($booking->expected_hp_dept_name) ? $booking->expected_hp_dept_name : '',
                            'diagnosis' => $booking->disease_name,
                            'surgery_start_time' => isset($booking->expected_time_start) ? $booking->expected_time_start : '',
                            'surgery_end_time' => isset($booking->expected_time_end) ? $booking->expected_time_end : '',
                            'pay_money' => $values['final_amount'],
                            'surgery_time' => time(),
                            'treat_remark' => '',
                        );
//                        var_dump($values);die;
                        $result = VendorRest::send(VendorRest::VENDOR_ID_160, $values, VendorRest::SERVICE_160);
                    }
                }
                $this->redirect(array('view', 'id' => $order->id));
            }
        }
        $this->render('createAdminBKOrder', array(
            'model' => $order
        ));
    }

    public function actionCreateOfflineOrder($bid) {
        //  $booking = Booking::model()->getById($bid);
        $booking = $this->booking;
        $order = new SalesOrder();
        $order->bk_id = $booking->booking_id;
        $order->admin_booking_id = $booking->id;
        $order->bk_type = $booking->booking_type;
        $order->bk_ref_no = $booking->ref_no;
        $order->user_id = $booking->patient_id;
        $order->subject = $booking->patient_name;
        $order->description = $booking->booking_detail;
        $order->bd_code = $booking->bd_user_name;
        $order->cash_back = $booking->bd_user_name;
        if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_PATIENT_GO) {
            $order->order_type = SalesOrder::ORDER_TYPE_SERVICE;
            $order->setAmount(1000.00);
        } else if ($booking->getTravelType(false) == StatCode::BK_TRAVELTYPE_DOCTOR_COME) {
            $order->order_type = SalesOrder::ORDER_TYPE_DEPOSIT;
            $order->setAmount(500.00);
        } else {
            $order->order_type = SalesOrder::ORDER_TYPE_SERVICE;
        }
        //$this->performAjaxValidation($order);
        if (isset($_POST['order'])) {
            $output = array('status' => 'no');
            $values = $_POST['order'];

            $order->setAmount($values['final_amount']);
            $order->setSubject($values['subject']);
            $order->setDescription($values['description']);
            $order->setBdCode($values['bd_code']);
            $order->setCashBack($values['cash_back']);
            $order->order_type = $values['order_type'];
            $order->setIsPaid(SalesOrder::ORDER_PAIDED);
            $order->setDateOpen($values['date_closed']);
            $order->setDateClosed($values['date_closed']);
            $order->createRefNo($booking->ref_no, $booking->id, StatCode::TRANS_TYPE_AB);
            //$order->validate();

            if ($order->save()) {
                //订单保存成功;修改adminbooking的支付金额
                if ($order->order_type == SalesOrder::ORDER_TYPE_DEPOSIT) {
                    $booking->addDepositTotal($order->getFinalAmount());
                    $booking->addDepositPaid($order->getFinalAmount());
                } else {
                    $booking->addServiceTotal($order->getFinalAmount());
                    $booking->addServicePaid($order->getFinalAmount());
                }
                $booking->save();
                //生成payment
                $salesMgr = new SalesManager();
                $offlineOrder = $salesMgr->createPaymentByOfflinSalseOrder($order, $values);
                if ($offlineOrder) {
                    $output['status'] = 'ok';
                    $output['orderId'] = $order->id;
                } else {
                    $output['errors'] = $offlineOrder->getErrors();
                }
            } else {
                $output['errors'] = $order->getErrors();
            }
            $this->renderJsonOutput($output);
        } else {
            $this->render('createOfflineOrder', array(
                'model' => $order
            ));
        }
    }

    public function actionDeleteOrder($id) {
        $output = array('status' => 'no');
        $model = SalesOrder::model()->getById($id);
        if ($model->delete(false)) {
            $output['status'] = 'ok';
            $output['refNo'] = $model->getRefNo();
        }
        $this->renderJsonOutput($output);
    }

    public function loadModelById($id, $with = null) {
        if (is_null($this->model)) {
            $this->model = SalesOrder::model()->getById($id, $with);
            if (is_null($this->model)) {
                throw new CHttpException(404, 'The requested page does not exists.');
            }
        }
    }

    public function loadBookingById($id, $with = null) {
        if (is_null($this->booking)) {
            $this->booking = Booking::model()->getById($id, $with);
            if (is_null($this->booking)) {
                throw new CHttpException(404, 'The requested page does not exists.');
            }
        }
    }

    public function loadPatientBookingById($id, $with = null) {
        if (is_null($this->patientBooking)) {
            $this->patientBooking = PatientBooking::model()->getById($id, $with);
            if (is_null($this->patientBooking)) {
                throw new CHttpException(404, 'The requested page does not exists.');
            }
        }
    }

    public function loadAdminBookingById($id, $with = null) {
        if (is_null($this->booking)) {
            $this->booking = AdminBooking::model()->getById($id, $with);
            if (is_null($this->booking)) {
                throw new CHttpException(404, 'The requested page does not exists.');
            }
        }
    }

    public function actionCreate() {
        $model = new SalesOrder;

        if (isset($_POST['SalesOrder'])) {
            $model->attributes = $_POST['SalesOrder'];
            $model->setAmount($model->final_amount);
            $model->setIsPaid(0);
            $model->setDateOpen(new CDbExpression('NOW()'));
//            var_dump($model);exit;
            $model->ref_no = '1'; //pass验证
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SalesOrder'])) {
            $model->attributes = $_POST['SalesOrder'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->join = 'left join sales_payment s on (t.`id`=s.`order_id`)';
        $criteria->compare("s.payment_status", StatCode::PAY_SUCCESS);
        $criteria->distinct = true;
        $criteria->addCondition("t.date_deleted is NULL");
        $criteria->order = "t.id DESC";
        $dataProvider = new CActiveDataProvider('SalesOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            //  'pageVar' => 'page'
            ),
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new SalesOrder('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['SalesOrder']))
//            $model->attributes = $_GET['SalesOrder'];
//
//        $this->render('admin', array(
//            'model' => $model,
//        ));
//    }

    public function actionSearch() {
        $this->render('search');
    }

    public function actionSearchResult() {
        $pbSeach = new SalesOrderSearch($_GET);
        $criteria = $pbSeach->criteria;
        $dataProvider = new CActiveDataProvider('SalesOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->renderPartial('searchResult', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * 统计金额
     */
    public function actionCountAmount() {
        $pbSeach = new PaymentSearch($_GET);
        $criteria = $pbSeach->criteria;
        $model = SalesOrder::model()->find($criteria);
        $output = array('amount' => $model->final_amount);
        $this->renderJsonOutput($output);
    }

}
