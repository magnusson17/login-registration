<?php

/* estendo DbClass per poter usare il suo method "connect" */
class Signup extends DbClass {

    /* 2 vedi signup-controller-class.php */
    protected function setUser($user, $pass, $mail) {

        $statement = $this->connect()->prepare('INSERT INTO users (users_user, users_pass, users_mail) VALUES (?, ?, ?);');

        /* cripto la pass prima di inserirla */
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        if(!$statement->execute(array($user, $hashedPass, $mail))) {
            $statement = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $statement = null;
    }

    /* 
    
    1 - user & pass sono properties della class SignupController 
    userò questo method in SignupController
    
    */

    protected function checkUser($user, $mail) {

        /* 
        
        connect() fa riferimento al method definito nella class estesa DbClass
        con questa connection voglio runnare un sql statement:
        
        I - grazie a prepare() preparo lo statement
        WHERE users_user = ? ---> DOVE users_user è = a qualcosa (ha un valore) 
        per prevenire sql injection ---> ? fa da placeholder al posto di $user o $mail

        II - grazie a execute() lo eseguo
        
        */

        $statement = $this->connect()->prepare('SELECT users_user FROM users WHERE users_user = ? OR users_mail = ?;');

        /* ora passo i valori corrispondemti a "?" */
        if(!$statement->execute(array($user, $mail))) {
            $statement = null;
            /* se fallisce mando un errore a index.php */
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck;

        /* rowCount() verifica quante row sono ritornate dallo statement */
        if($statement->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}
