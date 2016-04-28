<?php

/**
 * Description of ApiFilesOfPatient
 *
 * @author Administrator
 */
class ApiViewAdminTaskList extends EApiViewService {

    public $adminTaskList;

    //初始化类的时候将参数注入
    public function __construct() {
        parent::__construct();
    }

    protected function loadData() {
        $this->loadAdminTask();
    }

    //返回的参数
    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'errorCode' => 0,
                'errorMsg' => 'success',
                'results' => $this->adminTaskList,
            );
        }
    }

    public function loadAdminTask() {
        $models = AdminUser::model()->getAllByAttributes(array('role' => AdminUser::ROLE_CS), array('adminTaskJoin'));
        if (isset($models)) {
            $this->setAdminUserTask($models);
        }
    }

    public function setAdminUserTask($models) {
        foreach ($models as $model) {
            $data = new stdClass();
            $data->id = $model->id;
            $data->adminUserName = $model->fullname;
            $data->mobile = $model->mobile;
            $taskIsDone = 0;
            $taskNotDone = 0;
            $taskIsReadNotDone = 0;
            $taskCount = 0;
            if (isset($model->adminTaskJoin)) {
                $adminTaskJoins = $model->adminTaskJoin;
                $taskCount = count($adminTaskJoins);
                foreach ($adminTaskJoins as $adminTaskJoin) {
                    if ($adminTaskJoin->getRead(false) == AdminTaskJoin::NOT_READ && $adminTaskJoin->getStatus(false) == AdminTaskJoin::STATUS_NO) {
                        $taskNotDone ++;
                    } else if ($adminTaskJoin->getRead(false) == AdminTaskJoin::IS_READ & $adminTaskJoin->getStatus(false) == AdminTaskJoin::STATUS_NO) {
                        $taskIsReadNotDone ++;
                    } else {
                        $taskIsDone ++;
                    }
                }
            }
            $data->taskIsDone = $taskIsDone;
            $data->taskNotDone = $taskNotDone;
            $data->taskIsReadNotDone = $taskIsReadNotDone;
            $data->taskCount = $taskCount;
            $this->adminTaskList[] = $data;
        }
    }

}
