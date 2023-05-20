<?php

class Login extends DbClass {

    protected function getUser($user, $pass) {

        $statement = $this->connect()->prepare('SELECT users_pass FROM users WHERE users_user = ? OR users_mail = ?;');

        if(!$statement->execute(array($user, $mail))) {
            $statement = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($statement->rowCount() == 0) {
            $statement = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        /* 
        
        voglio prendere la pass dal db e voglio metcharla con quella che l'utente ha scritto:
        
        1 - con fetchAll tiro giu tutti i dati del mio statement
        
        2 - in che modo voglio convertire i dati per poi usarli?:
        in un ASSOCIATIVE ARRAY -> PDO:FETCH_ASSOC

        3 - check della pass grazie alla built-in fun password_verify(), ha come params:
        
        - $pass (la pass inserita dal user) 
        - $passHashed[0]["users_pass"] (pass nel db, che vado a prendere dentro il mio ASSOCIATIVE ARRAY)

        tale fun ritorna TRUE o FALSE

        4 - if TRUE voglio loggarmi con quel user.  if FALSE ritorno un error.

        "WHERE users_user = ? OR users_mail = ?" ---> per loggarmi o con l'user name o con la mail

        5 - loggo l'user!
        
        - faccio un'altra verifica di row count 
        - salvo i dati dell'user in una var $userLogged
        - creo una nuova sessione
        
        */

        $passHashed = $statement->fetchAll(PDO:FETCH_ASSOC);
        $checkPass = password_verify($pass, $passHashed[0]["users_pass"]);

        if($checkPass == false) {
            $statement = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPass == true) {
            $statement = $this->connect()->prepare('SELECT * FROM users WHERE users_user = ? OR users_mail = ? AND users_pass = ?;');

            /* ($user, $user, ---> uno è "user" l'altro è nel caso voglio far login con "mail", vedi punto 4,
            
            in getUser($user, $pass) passo 2 params non 3! quindi 1 dei 2 "$user" indica user, l'altro mail
            inserendo O user O mail un param sarà riempito e l'altro no
            
            execute prende i dati di prepare e prepare mi indica 3 params (users_user, users_mail, users_pass)
            quindi in execute devo segnare 3 params ---> $user(riferito a user), $user(riferito a mail), $pass(riferito a pass) */

            if(!$statement->execute(array($user, $user, $pass))) {
                $statement = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            /* login the user */

            if($statement->rowCount() == 0) {
                $statement = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $userLogged = $statement->fetchAll(PDO:FETCH_ASSOC);

            session_start();
            $_SESSION["userid"]     = $userLogged[0]["users_id"];
            $_SESSION["useruser"]   = $userLogged[0]["users_user"];

            $statement = null;
        }

        $statement = null;
    }
}
