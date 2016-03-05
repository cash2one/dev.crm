<?php

/**
 * Description of TaskManager
 *
 * @author haley
 */
class TaskManager {

    public function createTaskBooking($model) {
        $adminTask = new AdminTask();

        $adminTask->subject = '您有一条新的任务，预约编号：' . $model->ref_no;
        $adminTask->content = $model->disease_detail;
        $adminTask->url = 'http://localhost/crm.myzd.com/index.php/admin/adminBooking/view/id/' . $model->getId();

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {
                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminTaskJoin->admin_user_id = 1;    //test
            $adminTaskJoin->work_type = 1;
            if ($adminTaskJoin->save() === false) {
                throw new CException("Error saving adminTask");
            }
            $adminTaskBkJoin = new AdminTaskBkJoin();
            $adminTaskBkJoin->admin_task_join_id = $adminTaskJoin->getId();
            $adminTaskBkJoin->admin_booking_id = $model->getId();
            if ($adminTaskBkJoin->save() === false) {
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

    public function createTaskPlan($model, $values) {
//        print_r($model);
//        print_r($values);
        $adminTask = new AdminTask();
        $adminTask->subject = '您有一条新的任务，预约编号：' . $model->ref_no;
        $adminTask->content = $values['content'];
        $adminTask->url = 'http://localhost/crm.myzd.com/index.php/admin/adminBooking/view/id/' . $model->getId();

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {

                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->date_plan = $values['date_plan'];
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminTaskJoin->admin_user_id = $values['admin_user_id'];
            $adminTaskJoin->work_type = $values['work_type'];

            if ($adminTaskJoin->save() === false) {

                throw new CException("Error saving adminTask");
            }

            $adminTaskBkJoin = new AdminTaskBkJoin();
            $adminTaskBkJoin->admin_task_join_id = $adminTaskJoin->getId();
            $adminTaskBkJoin->admin_booking_id = $model->getId();
            if ($adminTaskBkJoin->save() === false) {
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

    /*
     * 获取adminbooking相关的追单任务
     */

    public function loadAdminTaskByAdminBookingId($adminBooingId, $isDone) {
        $adminTaskBkJoin = AdminTaskBkJoin::model()->loadllAdminBkJoinByAdminBookingId($adminBooingId, $isDone);
        $data = array();
        foreach ($adminTaskBkJoin as $v) {
            $adminTaskJoin = $v->getAdminTaskJoin();
            $adminTask = AdminTask::model()->getById($adminTaskJoin->admin_task_id);
            $taskPlan = new stdClass();
            $taskPlan->id = $v->id;
            $taskPlan->taskJoinId = $adminTaskJoin->id;
            $taskPlan->date_plan = $adminTaskJoin->date_plan;
            $taskPlan->admin_user = AdminUser::model()->getById($adminTaskJoin->admin_user_id)->username;
            $taskPlan->content = $adminTask->content;
            $taskPlan->date_done = $adminTaskJoin->date_done;
            $data[] = $taskPlan;
        }
        return $data;
    }

}
