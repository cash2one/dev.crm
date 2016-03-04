<?php

/**
 * Description of TaskManager
 *
 * @author haley
 */
class TaskManager {

    public function createTaskBooking($model) {
        $adminTask = new AdminTask();

        $adminTask->subject = '您有一条新的任务，预约编号：'.$model->ref_no;
        $adminTask->content = $model->disease_detail;
        $adminTask->url = 'http://localhost/crm.myzd.com/index.php/admin/adminBooking/view/id/'.$model->getId();

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if($adminTask->save() === false){
                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminTaskJoin->admin_user_id = 1;    //test
            $adminTaskJoin->work_type = 1;
            if($adminTaskJoin->save() === false){
                throw new CException("Error saving adminTask");
            }
            $adminTaskBkJoin = new AdminTaskBkJoin();
            $adminTaskBkJoin->admin_task_join_id = $adminTaskJoin->getId();
            $adminTaskBkJoin->admin_booking_id = 1;   //test
            if($adminTaskBkJoin->save() === false){
                throw new CException("Error saving adminTaskBkJoin");
            }
            $dbTran->commit();
        } catch (CDbException $cdbex) {
            $dbTran->rollback();
            return false;
        } catch (CException $cex) {
            $dbTran->rollback();
            return false;
        }

        return true;
    }

    /**
     * 付款完成
     */
    public function createTaskOrder($model) {

    }

    /**
     * md端 医生上传照片
     */
    public function createTaskDoctor($model) {

    }

    /**
     * 获取新任务
     */
    public function getNewTask($admin_user_id){
        $models = AdminTaskJoin::model()->getAllByAttributes(array('admin_user_id'=>$admin_user_id, 'is_read'=>0));
        return $models;
    }

    /**
     * 获取推送任务
     */
    public function getPlanTask($admin_user_id){
        $admin_user_id = (int) $admin_user_id;
        $db = Yii::app()->db;
        $sql = "SELECT * FROM `admin_task_join` where admin_user_id={$admin_user_id} and (UNIX_TIMESTAMP(now())- UNIX_TIMESTAMP(date_plan) < 60)";
        $command = $db->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }

}
