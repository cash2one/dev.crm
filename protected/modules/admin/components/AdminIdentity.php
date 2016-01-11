<?php

class AdminIdentity extends CUserIdentity {

    private $id;
    private $role;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->role = StatCode::USER_ROLE_ADMIN;
    }

    public function authenticate() {
        $username = Yii::app()->params['admin'];
        $password = Yii::app()->params['adminPassword'];
        if ($username != $this->username) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($password != $this->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->id = $username;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($v) {
        $this->id = $v;
    }

    public function getRole() {
        return $this->role;
    }

}
