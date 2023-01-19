<?php

if (isset($_POST['login-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    // get data from login
    $em = $_POST['email'];
    $pw = $_POST['password'];

    if (checkEmpty($em, $pw) !== false) {
        header("location: ../login.php?m=emptyFields");
        exit();
    }

    login($conn, $em, $pw);
} else {
    header("location: ../login.php");
    exit();
}
