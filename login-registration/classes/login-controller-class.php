<?php

class LoginController extends Login {

    private $user;
    private $pass;
    
    public function __construct($user, $pass) {

        $this->user         = $user;
        $this->pass         = $pass;
    }

    public function loginUser() {
        if($this->checkEmptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        /* getUser() method creato in login-class.php */
        $this->getUser($this->user, $this->pass, $this->mail);   
    }

    // controllo INPUT
    private function checkEmptyInput() {
        $result;
        if(empty($this->user) || empty($this->pass)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}