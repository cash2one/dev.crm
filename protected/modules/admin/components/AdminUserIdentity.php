<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminUserIdentity extends CUserIdentity {

    private $_id;
    private $role;

    const ERROR_IS_LOCKED = 3;
    const IS_LOCKED_YES = 1;
    const IS_LOCKED_NO = 0;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = AdminUser::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->is_locked == self::IS_LOCKED_YES) {
            $this->errorCode = self::ERROR_IS_LOCKED;
        } else if ($user->password != $this->encryptPassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            //登录错误次数增加
            $login_attempts = $user->login_attempts;
            $login_attempts++;
            $user->login_attempts = $login_attempts;
            if ($login_attempts >= 3) {
                $user->is_locked = self::IS_LOCKED_YES;
            }
            $user->update(array('login_attempts', 'is_locked'));
            $userMgr = new UserManager();
            $userMgr->createLoginLogByAdminUserAndIsSuccess($user, AdminUserLoginLog::LOGIN_FAILED);
        } else {
            $this->_id = $user->id;
            $this->username = $user->username;
            $this->errorCode = self::ERROR_NONE;
            $user->login_attempts = 0;
            $user->last_login_ip = Yii::app()->request->getUserHostAddress();
            $user->update(array('login_attempts', 'last_login_ip'));
            $userMgr = new UserManager();
            $userMgr->createLoginLogByAdminUserAndIsSuccess($user, AdminUserLoginLog::LOGIN_SUCCESS);
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

    protected function encryptPassword($password) {
        return hash('sha256', $password);
    }

    public function getRole() {
        return $this->role;
    }

}
