<?php

if (isset($_POST['request-btn'])) {

    // requires the functions and database management
    require 'config.inc.php';
    require 'functions.inc.php';

    // get the user inputs
    $fn = $_POST['user_firstname'];
    $ln = $_POST['user_lastname'];
    $em = $_POST['email'];
    $pw = $_POST['password'];
    $pw2 = $_POST['confirmPassword'];

    // check empty email or password
    if (checkEmptyRequest($em, $pw, $fn, $ln, $pw2) !== false) {
        header("location: ../requestAccount.php?m=emptyFields");
        exit();
    }

    // Check if password does not match
    if (passwordMatch($pw, $pw2) !== false) {
        header("location: ../requestAccount.php?m=passwordNotMatch");
        exit();
    }

    // check for invalid email
    if (invalidEmail($em) !== false) {
        header("location: ../requestAccount.php?m=invalidEmail");
        exit();
    }

    // check for email if existing
    if (checkEmailExist($conn, $em) !== false) {
        header("location: ../requestAccount.php?m=emailExist");
        exit();
    }

    // if success for all checking, proceed to the code below
    signUp($conn, $fn, $ln, $em, $pw);
} else {
    header("location: ../requestAccount.php");
    exit();
}
