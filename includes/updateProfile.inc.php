<?php

if (isset($_POST['save-btn'])) {
    session_start();
    // requires
    require 'config.inc.php';
    require 'functions.inc.php';

    // get user inputs
    $id = $_SESSION['id'];
    $fname = $_POST['new_fn'];
    $lname = $_POST['new_ln'];
    $email = $_POST['new_em'];

    // sql query
    $sql = "UPDATE ssms.users SET user_firstname='$fname', user_lastname='$lname', user_email='$email' WHERE user_id=$id";
    if ($conn->query($sql) === TRUE) {
        header("location: ../profile.php?m=updateSuccess");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    header("location: ../profile.php");
    exit();
}
