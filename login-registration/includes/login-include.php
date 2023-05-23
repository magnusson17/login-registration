<?php

if(isset($_POST['submit'])) {

    $user           = $_POST['user'];
    $pass           = $_POST['pass'];

    /* includere & inizializzare Login Controller Class */
    include '../classes/db-class.php';
    include '../classes/login-class.php';
    include '../classes/login-controller-class.php';
    $login = new LoginController($user, $pass);

    /* Runnare error handlers & fare il login del user, vedi login-controller-class.php */
    $login->loginUser();

    /* Tornare alla front page */
    header("location: ../homepage.php?error=none");
}
