<?php

// for technology supplies
if (isset($_POST['restock-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id']) or empty($_POST['restock_item'])) {
        header("location: ../restocks.php");
        exit();
    }

    $item = $_POST['restock_item'];
    $id = $_POST['user_id'];
    $qty = $_POST['restock_quantity'];

    $sql = "UPDATE ssms.technology_supplies SET ts_quantity='$qty', date_last_modified=now(), modified_by=$id WHERE ts_id=$item";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "INSERT INTO ssms.restocks(`ts_id`, `restock_quantity`, `user_id`, `restock_date`) VALUES ('$item', '$qty', '$id', now())";
        if ($conn->query($sql2) === TRUE) {
            header("location: ../restocks.php?m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../restocks.php?m=error');</script>";
        }
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../restocks.php?m=error');</script>";
    }
}



// for office supplies
if (isset($_POST['restock-btn-office'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id']) or empty($_POST['restock_item'])) {
        header("location: ../restocks.php");
        exit();
    }

    $item = $_POST['restock_item'];
    $id = $_POST['user_id'];
    $qty = $_POST['restock_quantity'];

    $sql = "UPDATE ssms.technology_supplies SET ts_quantity='$qty', date_last_modified=now(), modified_by=$id WHERE ts_id=$item";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "INSERT INTO ssms.restocks(`ts_id`, `restock_quantity`, `user_id`, `restock_date`) VALUES ('$item', '$qty', '$id', now())";
        if ($conn->query($sql2) === TRUE) {
            header("location: ../restocks.php?m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../restocks.php?m=error');</script>";
        }
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../restocks.php?m=error');</script>";
    }
}
