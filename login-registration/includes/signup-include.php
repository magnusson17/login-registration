<?php

if(isset($_POST['submit'])) {

    $user           = $_POST['user'];
    $pass           = $_POST['pass'];
    $passrepeat     = $_POST['passrepeat'];
    $mail           = $_POST['mail'];

    /* includere & inizializzare Signup Controller Class */
    include '../classes/db-class.php';
    include '../classes/signup-class.php';
    include '../classes/signup-controller-class.php';
    $signup = new SignupController($user, $pass, $passrepeat, $mail);

    /* Runnare error handlers & fare il signup del user, vedi signup-controller-class.php */
    $signup->signupUser();

    /* Tornare alla front page */
    header("location: ../index.php?error=none");
}