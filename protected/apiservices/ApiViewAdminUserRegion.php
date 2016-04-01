<?php

class ApiViewAdminUserRegion extends EApiViewService {

    private $adminUserRole;
    private $setMgr;

    //初始化类的时候将参数注入

    public function __construct($adminUserRole) {
        parent::__construct();
        $this->adminUserRole = $adminUserRole;
        $this->setMgr = new SetManager();
    }

    protected function loadData() {
        $this->loadAdminUserRegion();
    }

    //返回的参数
    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'errorCode' => 0,
                'errorMsg' => 'success',
                'results' => $this->results,
            );
        }
    }

    public function loadAdminUserRegion() {
        if (is_null($this->adminUserRole) == false) {
            $models = AdminUserRegionJoin::model()->getAllByAttributes(array('admin_user_role' => $this->adminUserRole), null, array('order' => 't.default DESC,t.admin_user_id'));
            if (isset($models)) {
                $this->setAdminUserRegion($models);
            }
        }
    }

    public function setAdminUserRegion($models) {
        $adminUserBK = array();
        $adminUserPB = array();
        foreach ($models as $model) {
            $data = new stdClass;
            $data->adminUserName = $model->admin_user_name;
            if (is_null($model->state_id) == false) {
                $region = RegionState::model()->getById($model->state_id);
                $data->state = $region->getName();
            } else {
                $data->state = '默认';
            }
            if ($model->booking_type == AdminBooking::BK_TYPE_BK) {
                $adminUserBK[] = $data;
            } else {
                $adminUserPB[] = $data;
            }
        }
        $adminUserRegion = array(
            'adminUserBK' => $adminUserBK,
            'adminUserPB' => $adminUserPB
        );
        $this->results = $adminUserRegion;
    }

}
