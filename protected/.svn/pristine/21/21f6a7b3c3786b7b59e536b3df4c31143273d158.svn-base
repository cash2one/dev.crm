<?php

class AdminWebUser extends CWebUser {

    /**
     *
     * @param AdminIdentity $identity
     * @param integer $duration 
     */
    public function login($identity, $duration=0) {
        parent::login($identity, $duration);

        $this->setState('role', $identity->getRole());
    }

    public function getRole() {
        return $this->getState('role');
    }

}