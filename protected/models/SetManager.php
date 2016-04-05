<?php

class SetManager {

    public function loadAllStateByAdminUserIdAndType($adminUserId, $type) {
        $output = new stdClass();
        $list = AdminUserRegionJoin::model()->getAllStateByAdminUserIdAndType($adminUserId, $type);
        $output->stateIds = arrayExtractValue($list, 'state_id');
        //$output->diseaseIds = CHtml::listData($list, 'disease_id');
        return $output;
    }

    public function updateAdminUserRegion(AdminUserRegionJoinForm $form) {
        if ($form->validate()) {
            $listDelete = $form->getStateListDelete();
            $adminUserId = $form->getAdminUserId();
            try {
                if (arrayNotEmpty($listDelete)) {
                    AdminUserRegionJoin::model()->deleteAllByAdminUserIdAndStateIds($adminUserId, $listDelete);
                }
                $listInsert = $form->getStateListInsert();
                if (arrayNotEmpty($listInsert)) {
                    foreach ($listInsert as $v) {
                        $adminUserRegionJoin = new AdminUserRegionJoin();
                        $adminUserRegionJoin->admin_user_id = $adminUserId;
                        $adminUserRegionJoin->booking_type = $form->booking_type;
                        $adminUserRegionJoin->admin_user_role = 1;
                        $adminUserRegionJoin->state_id = $v;
                        $adminUserRegionJoin->default = 0;
                        $adminUserRegionJoin->admin_user_name = AdminUser::model()->getById($adminUserId)->fullname;
                        $adminUserRegionJoin->save();
                    }
                }
            } catch (CDbException $e) {
                $form->addError('数据库操作失败');
                throw new CHttpException($e->getMessage());
            } catch (CException $e) {
                $form->addError('操作失败');
                Yii::log("database table disease_doctor_join jdbc: " . $e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
                throw new CHttpException($e->getMessage());
            }
        }
    }

    public function getStateIdsByAdminUserIdAndBookingType($adminUserId, $type) {
        $output = array('status' => 'no');
        $adminUserRegionJoin = AdminUserRegionJoin::model()->getAllStateByAdminUserIdAndType($adminUserId, $type);
        if (isset($adminUserRegionJoin)) {
            $stateIds = array();
            foreach ($adminUserRegionJoin as $value) {
                $stateIds[] = $value->state_id;
            }
            $output['status'] = 'ok';
            $output['stateIds'] = $stateIds;
        }
        return $output;
    }

    public function getAllStateIdsByBookingTypeAndRole($type, $admin_user_role) {
        $output = array('status' => 'no');
        $adminUserRegionJoin = AdminUserRegionJoin::model()->getAllStateByBookingTypeAndRole($type, $admin_user_role);
        if (isset($adminUserRegionJoin)) {
            $stateIds = array();
            foreach ($adminUserRegionJoin as $value) {
                $stateIds[] = $value->state_id;
            }
            $output['status'] = 'ok';
            $output['stateIds'] = $stateIds;
        }
        return $output;
    }

    public function getDefaultAdminUserByBookingTypeAndAdminUserRole($type, $adminUserRole) {
        $output = array('status' => 'no');
        $adminUserRegionJoin = AdminUserRegionJoin::model()->getDefaultAdminUserByBookingTypeAndAdminUserRole($type, $adminUserRole);
        if (isset($adminUserRegionJoin)) {
            $output['status'] = 'ok';
            $output['admin_user_id'] = $adminUserRegionJoin->admin_user_id;
            $output['admin_user_name'] = $adminUserRegionJoin->admin_user_name;
        }
        return $output;
    }

}
