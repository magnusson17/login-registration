<?php

/* estendo Signup per poter usare i suoi methods "checkUser" & "setUser" */
class SignupController extends Signup {

    /* definisco le variabili (dette PROPERTIES in Object-oriented programming OOP) */
    private $user;
    private $pass;
    private $passrepeat;
    private $mail;

    /* 
    
    definisco il contructor 
    le var passate qua NON sono le properties definite prima ma i valori delle var passate in POST

    */
    
    public function __construct($user, $pass, $passrepeat, $mail) {

        /* attribuisco alle properties il valore delle variabili passate in POST */
        $this->user         = $user;
        $this->pass         = $pass;
        $this->passrepeat   = $passrepeat;
        $this->mail         = $mail;
    }

    /* 2 - USO le methods per gestione errori */
    public function signupUser() {
        if($this->checkEmptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if($this->checkInvalidMail() == false) {
            header("location: ../index.php?error=invalidmail");
            exit();
        }
        if($this->checkWrongPassword() == false) {
            header("location: ../index.php?error=wrongpassword");
            exit();
        }
        if($this->checkExistentUser() == false) {
            header("location: ../index.php?error=useralreadyexist");
            exit();
        }

        /* setUser() method creato in signup-class.php */
        $this->setUser($this->user, $this->pass, $this->mail);   
    }

    /* 1 - CREO methods per gestione errori (in OOP le fun son dette METHODS) */

    // controllo INPUT
    private function checkEmptyInput() {
        $result;
        if(empty($this->user) || empty($this->pass) || empty($this->passrepeat) || empty($this->mail)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // controllo MAIL
    private function checkInvalidMail() {
        $result;
        if(!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // controllo PASSWORD
    private function checkWrongPassword() {
        $result;
        if($this->pass !== $this->passrepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // controllo USER GIA ESISTENTE (vedi signup-class.php)
    private function checkExistentUser() {
        $result;
        if(!$this->checkUser($this->user, $this->mail)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}