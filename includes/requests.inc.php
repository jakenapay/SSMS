<?php

// Approve requests
if (isset($_POST['approve-request'])) {

    // Include other PHP processes
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $appr_id = $_POST['appr_id']; // ID of the supply to disable
    $uid = $_POST['uid']; // User ID - the ID of the account that you're using

    // probably add some date last modified by
    $sql = "UPDATE ssms.history SET status='approved', modified_by=$uid WHERE history_id=$appr_id";
    if ($conn->query($sql) === TRUE) {
        // Return a success response
        header("location: ../requests.php?m=approved");
        exit();
    } else {
        // Return an error response
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../requests.php?m=error');</script>";
        exit();
    }
    exit();
}