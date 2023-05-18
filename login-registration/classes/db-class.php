<?php

class DbClass {
    
    /* 
    
    per connettermi al db 
    uso "protected" perchè è un method che funzionerà quando estenderò la class DbClass
    
    */

    protected function connect() {
        /* try run the code, if there is an error catch it and run it instead */
        try {
            $username = "root";
            $password = "root";
            $dbhandler = new PDO('mysql:host=localhost;dbname=login_test_db', $username, $password);
            return $dbhandler;
        } catch (PDOExeption $e) {
            echo "error! " . $e->getMessage() . "<br/>";
            die(); 
        }
    }

    /*
    
    CREAZIONE DB SU MYSQL:

    1 - crea db

    2 - su "SQL" a menu inserisci il seguente codice per creare una table con le seguenti chiavi:

    CREATE TABLE users (
        users_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
        users_user TINYTEXT not null,
        users_pass LONGTEXT not null,
        users_mail TINYTEXT not null
    )
    
    */

}