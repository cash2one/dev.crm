<?php

/**
 * Description of TaskManager
 *
 * @author haley
 */
class TaskManager {

    const USER_DOCTOR_CERT = 1;
    const USER_DOCTOR_PROFILE_NEW = 2;
    const USER_DOCTOR_PROFILE_UPDATE = 3;

    public function createTaskBooking(AdminBooking $model) {
        $adminTask = new AdminTask();

        $adminTask->subject = '您有一条新的任务，预约编号：' . $model->ref_no;
        $adminTask->content = $model->disease_detail;
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/adminBooking/view', array('id' => $model->getId()));

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {
                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminTaskJoin->admin_user_id = $model->admin_user_id;
            $adminTaskJoin->work_type = AdminTaskJoin::WORK_TYPE_TEL;
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_BK;
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

    public function createTaskPlan(AdminBooking $model, $values) {
        $adminTask = new AdminTask();

        $adminTask->subject = '您有一条新的任务，预约编号：' . $model->ref_no;
        $adminTask->content = $values['content'];
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/adminBooking/view', array('id' => $model->getId()));

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {

                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            if (strIsEmpty($values['date_plan']) == false) {
                $adminTaskJoin->date_plan = $values['date_plan'];
            }
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminTaskJoin->admin_user_id = $values['admin_user_id'];
            $adminTaskJoin->work_type = $values['work_type'];
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_BK;

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

    public function createAndCompletedTaskPlan(AdminBooking $model, $values) {
        $adminTask = new AdminTask();

        $adminTask->subject = '您有一条新的任务，预约编号：' . $model->ref_no;
        $adminTask->content = $values['content'];
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/adminBooking/view', array('id' => $model->getId()));

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {

                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            if (strIsEmpty($values['date_plan']) == false) {
                $adminTaskJoin->date_plan = $values['date_plan'];
            } else {
                //若没有计划时间则自动完成任务
                date_default_timezone_set("Asia/Shanghai");
                $adminTaskJoin->date_done = date('Y-m-d H:i:s');
                $adminTaskJoin->status = AdminTaskJoin::STATUS_OK;
                $adminTaskJoin->is_read = AdminTaskJoin::IS_READ;
                $adminTaskJoin->date_read = date('Y-m-d H:i:s');
            }
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminTaskJoin->admin_user_id = $values['admin_user_id'];
            $adminTaskJoin->work_type = $values['work_type'];
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_BK;
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
    public function createTaskOrder(SalesOrder $model) {
        $adminTask = new AdminTask();
        $adminTask->subject = "订单号{$model->ref_no}的订单已完成支付"; //$model->subject;
        date_default_timezone_set("Asia/Shanghai");
        $nowTime = date('Y-m-d H:i:s');
        $dateClosed = strIsEmpty($model->date_closed) ? $nowTime : $model->date_closed;
        $adminTask->content = "订单号{$model->ref_no}的在{$dateClosed}已完成支付";//$model->description . '已支付完成';
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/order/view', array('id' => $model->getId()));

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {
                throw new CException("Error saving adminTask");
            }

            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminBooking = AdminBooking::model()->getByAttributes(array('booking_id' => $model->bk_id, 'booking_type' => $model->bk_type));
            if ($adminBooking) {
                $adminTaskJoin->admin_user_id = $adminBooking->admin_user_id;
            }
            $adminTaskJoin->work_type = AdminTaskJoin::WORK_TYPE_TEL;
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_ORDER;
            if ($adminTaskJoin->save() === false) {
                throw new CException("Error saving adminTask");
            }

            $adminTaskOrderJoin = new AdminTaskOrderJoin();
            $adminTaskOrderJoin->admin_task_join_id = $adminTaskJoin->getId();
            $adminTaskOrderJoin->order_id = $model->getId();
            if ($adminTaskOrderJoin->save() === false) {
                throw new CException("Error saving adminTaskBkJoin");
            }
            if ($adminBooking) {
                $adminTaskBkJoin = new AdminTaskBkJoin();
                $adminTaskBkJoin->admin_task_join_id = $adminTaskJoin->getId();
                $adminTaskBkJoin->admin_booking_id = $adminBooking->getId();
                if ($adminTaskBkJoin->save() === false) {
                    throw new CException("Error saving adminTaskBkJoin");
                }
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
     * md端 医生上传照片
     */
    public function createTaskDoctor(UserDoctorProfile $model) {
        $adminTask = new AdminTask();

        $adminTask->subject = '上传认证照片';
        $adminTask->content = $model->name . ':' . $model->hospital_name . '-' . $model->hp_dept_name;
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/user/view', array('id' => $model->getUserId()));

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {
                throw new CException("Error saving adminTask");
            }

            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            //$adminUser = $this->getAdminUser($model->city_id, $model->state_id, AdminBooking::bk_type_pb, AdminUser::ROLE_CS);
            $adminTaskJoin->admin_user_id = Yii::app()->params['doctorVerifyAdminUserId'];
            $adminTaskJoin->work_type = AdminTaskJoin::WORK_TYPE_TEL;
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_USER_DR;
            if ($adminTaskJoin->save() === false) {
                throw new CException("Error saving adminTask");
            }

            $adminTaskDoctorJoin = new AdminTaskDoctorJoin();
            $adminTaskDoctorJoin->admin_task_join_id = $adminTaskJoin->getId();
            $adminTaskDoctorJoin->doctor_id = $model->getId();
            if ($adminTaskDoctorJoin->save() === false) {
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
     * md端 医生资料更新
     */
    public function createTaskDoctorCert(UserDoctorProfile $model, $type) {
        if ($type == self::USER_DOCTOR_PROFILE_NEW) {
            return true;
        }
        $adminTask = new AdminTask();
        switch ($type) {
            case self::USER_DOCTOR_CERT :
                $adminTask->subject = '医生资料 - 上传认证照片';
                break;
            case self::USER_DOCTOR_PROFILE_NEW :
                $adminTask->subject = '医生资料 - 新医生用户';
                break;
            case self::USER_DOCTOR_PROFILE_UPDATE :
                $adminTask->subject = '医生资料 - 基本信息修改';
                break;
        }

        if ($type == self::USER_DOCTOR_CERT) {
            $doctorMgr = new DoctorManager();
            $certs = $doctorMgr->loadDoctorsCert($model->getUserId());
            if (arrayNotEmpty($certs)) {
                $date = $certs[0]->getDateCreated('Y-m-d h:i:s');
                $num = time() - strtotime($date);
                if ($num <= 120) {
                    return true;
                }
            }
        }

        $adminTask->content = $model->name . ':' . $model->hospital_name . '-' . $model->hp_dept_name;
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/user/view', array('id' => $model->getUserId()));

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {
                throw new CException("Error saving adminTask");
            }

            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            //$adminUser = $this->getAdminUser($model->city_id, $model->state_id, AdminBooking::bk_type_pb, AdminUser::ROLE_CS);
            $adminTaskJoin->admin_user_id = Yii::app()->params['doctorVerifyAdminUserId'];
            $adminTaskJoin->work_type = AdminTaskJoin::WORK_TYPE_TEL;
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_USER_DR;
            if ($adminTaskJoin->save() === false) {
                throw new CException("Error saving adminTask");
            }

            $adminTaskDoctorJoin = new AdminTaskDoctorJoin();
            $adminTaskDoctorJoin->admin_task_join_id = $adminTaskJoin->getId();
            $adminTaskDoctorJoin->doctor_id = $model->getId();
            if ($adminTaskDoctorJoin->save() === false) {
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

    public function createTaskPatientFile(PatientBooking $model) {
        $patientMgr = new PatientManager();
        $filelist = $patientMgr->loadPatientFile($model->getPatientId());
        if (arrayNotEmpty($filelist)) {
            //var_dump($filelist[0]);            exit();
            $date = $filelist[0]->getDateCreated('Y-m-d h:i:s');
            $num = time() - strtotime($date);
            if ($num <= 120) {
                return true;
            }
        }
        $adminTask = new AdminTask();
        $adminTask->subject = '医生端预约影像资料变更,预约编号：' . $model->ref_no;
        $adminTask->content = $model->getCreatorName() . '医生变更了患者' . $model->getPatientName() . '的影像资料';
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/patientbooking/view', array('id' => $model->getId()));
        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {
                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $profile = $model->pbUserDoctorProfile;
            $cityId = null;
            $stateId = null;
            if (isset($profile)) {
                $cityId = $profile->city_id;
                $stateId = $profile->state_id;
            }
            $adminUser = $this->getAdminUser($cityId, $stateId, AdminBooking::BK_TYPE_PB, AdminUser::ROLE_CS);
            $adminTaskJoin->admin_user_id = $adminUser->admin_user_id;
            $adminTaskJoin->work_type = AdminTaskJoin::WORK_TYPE_TEL;
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_USER_DR;
            if ($adminTaskJoin->save() === false) {
                throw new CException("Error saving adminTask");
            }

            $adminTaskDoctorJoin = new AdminTaskDoctorJoin();
            $adminTaskDoctorJoin->admin_task_join_id = $adminTaskJoin->getId();
            $adminTaskDoctorJoin->doctor_id = $model->getCreatorId();
            if ($adminTaskDoctorJoin->save() === false) {
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
            $taskPlan->admin_user = AdminUser::model()->getById($adminTaskJoin->admin_user_id)->fullname;
            $taskPlan->type = $adminTaskJoin->getType(false);
            $taskPlan->work_type = $adminTaskJoin->getWorkType();
            $taskPlan->content = $adminTask->content;
            $taskPlan->date_done = $adminTaskJoin->date_done;
            $data[] = $taskPlan;
        }
        return $data;
    }

    public function getAdminUser($cityId, $stateId, $bkType, $role) {
        //若城市和省会为空 则找默认人员 因地推无默认 所以无需判断
        if (strIsEmpty($cityId) && strIsEmpty($stateId)) {
            return AdminUserRegionJoin::model()->getDefaultUser($bkType, $role);
        }
        //若城市和省会不为空的情况  查找顺序依次为城市 省会 默认
        $cityUser = AdminUserRegionJoin::model()->getByCityIdAndBookingTypeAndRole($cityId, $bkType, $role);

        if (isset($cityUser)) {
            return $cityUser;
        } else {

            $stateUser = AdminUserRegionJoin::model()->getByStateIdAndBookingTypeAndRole($stateId, $bkType, $role);

            if (isset($stateUser)) {
                return $stateUser;
            } else {
                return AdminUserRegionJoin::model()->getDefaultUser($bkType, $role);
            }
        }
    }

    public function loadAdminTaskByIdAndUserId($id, $adminUserId) {
        return AdminTaskJoin::model()->getByAttributes(array('id' => $id, 'admin_user_id' => $adminUserId));
    }

    public function deleteAdminTaskJoinByAdminBookingId($adminBookingId) {
        $adminTaskBkJoins = AdminTaskBkJoin::model()->getAllByAttributes(array('admin_booking_id' => $adminBookingId), array('adminTaskJoin'));
        foreach ($adminTaskBkJoins as $value) {
            $adminTaskJoin = $value->getAdminTaskJoin();
            $adminTaskJoin->delete(false);
        }
    }

    public function createChangeAdminUserTask(AdminBooking $adminbooking, $oldUserId, $newUserId) {
        $values = array();
        $oldUser = AdminUser::model()->getById($oldUserId);
        $newUser = AdminUser::model()->getById($newUserId);
        $operatorId = Yii::app()->user->id;
        $operator = AdminUser::model()->getById($operatorId);
        if (isset($oldUser)) {
            $oldUserName = $oldUser->fullname;
        } else {
            $oldUserName = '离职人员';
        }
        $values['content'] = $operator->fullname . '将' . $oldUserName . '的订单分配给' . $newUser->fullname;
        $values['admin_user_id'] = $newUser->id;
        $values['work_type'] = AdminTaskJoin::WORK_TYPE_TEL;
        $values['date_plan'] = null;
        $this->createTaskPlan($adminbooking, $values);
    }

    public function createTaskBookingDAFile(AdminBooking $model, $values) {
        $adminTask = new AdminTask();

        $adminTask->subject = '上传出院小结，预约编号：' . $model->ref_no;
        $adminTask->content = $values['content'];
        $adminTask->url = Yii::app()->createAbsoluteUrl('/admin/adminBooking/view', array('id' => $model->getId()));

        $dbTran = Yii::app()->db->beginTransaction();
        try {
            if ($adminTask->save() === false) {

                throw new CException("Error saving adminTask");
            }
            $adminTaskJoin = new AdminTaskJoin();
            if (strIsEmpty($values['date_plan']) == false) {
                $adminTaskJoin->date_plan = $values['date_plan'];
            }
            $adminTaskJoin->admin_task_id = $adminTask->getId();
            $adminTaskJoin->admin_user_id = $values['admin_user_id'];
            $adminTaskJoin->work_type = $values['work_type'];
            $adminTaskJoin->type = AdminTaskJoin::TASK_TYPE_DA;

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

    public function createBookingDaFileTaskPlan(AdminBooking $adminbooking, $user) {
        $values = array();
        $values['content'] = $user->fullname . '上传了出院小结;';
        $values['admin_user_id'] = $adminbooking->admin_user_id;
        $values['work_type'] = AdminTaskJoin::WORK_TYPE_TEL;
        $values['date_plan'] = null;
        $this->createTaskBookingDAFile($adminbooking, $values);
    }

    public function createPatientBookingDaFileTaskPlan(AdminBooking $adminbooking) {
        $values = array();
        $values['content'] = "预约{$adminbooking->ref_no}上传了出院小结";
        $values['admin_user_id'] = $adminbooking->admin_user_id;
        $values['work_type'] = AdminTaskJoin::WORK_TYPE_TEL;
        $values['date_plan'] = null;
        return $this->createTaskBookingDAFile($adminbooking, $values);
    }

    public function completeTaskByAdminBookingIdAndWorkSchedule($adminbookingId, $workSchedule) {
        $taskType = null;
        switch ($workSchedule) {
            case StatCode::BK_STATUS_PROCESS_DONE:
                $taskType = AdminTaskJoin::TASK_TYPE_DA;
        }
        if (is_null($taskType) == false) {
            $with = array('adminTaskJoin' => array('on' => 'adminTaskJoin.date_done IS NULL AND adminTaskJoin.type = ' . $taskType));
            $adminTaskBkJoin = AdminTaskBkJoin::model()->getAllByAttributes(array('admin_booking_id' => $adminbookingId), $with);
            foreach ($adminTaskBkJoin as $value) {
                $adminTaskJoin = $value->getAdminTaskJoin();
                if (is_null($adminTaskJoin) == false) {
                    $adminTaskJoin->status = AdminTaskJoin::STATUS_OK;
                    $adminTaskJoin->date_done = new CDbExpression('NOW()');
                    $adminTaskJoin->update(array('status', 'date_done'));
                }
            }
        }
    }

    public function createShareTask($adminBooking, $type) {
        $values = array();
        $shareType = null;
        switch ($type) {
            case 'KA':
                $shareType = 'KA';
                break;
            case 'BD':
                $shareType = '地推';
                break;
            default :
                $shareType = '地推';
        }
        $values['content'] = '将此订单分享给了' . $shareType;
        $values['admin_user_id'] = Yii::app()->user->id;
        $values['work_type'] = AdminTaskJoin::WORK_TYPE_TEL;
        $values['date_plan'] = date('Y-m-d H:i:s', time() + 3600 * 24 * 3);
        $this->createTaskPlan($adminBooking, $values);
    }

}
