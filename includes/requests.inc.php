<?php

// Approve requests
if (isset($_POST['approve-request'])) {

    // Include other PHP processes
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $appr_id = $_POST['appr_id']; // ID of the supply to approve
    $appr_item_name = $_POST['appr_item_name']; // Approve item name to find it in the tech or office supply table
    $appr_item_id = $_POST['appr_item_id']; // Item id to find which table is the item
    $appr_item_qty = $_POST['appr_item_qty']; // Item quantity that the user will get
    $uid = $_POST['uid']; // User ID - the ID of the account that you're using

    // Select * from technology supply WHERE $appr_item_name
    // If there's no result in technology supply
    // Select * from office supply WHERE $appr_item_name
    // If there's a result, run the update query of respective table

    $data_from = ""; // If 0 = ts; 1 = os;

    $result = $conn->query("SELECT *, ts_quantity FROM technology_supplies WHERE ts_id='$appr_item_id' AND ts_model LIKE '%$appr_item_name%' LIMIT 1"); // result for ts
    $result2 = $conn->query("SELECT *, os_quantity FROM office_supplies WHERE os_id='$appr_item_id' AND os_name LIKE '%$appr_item_name%' LIMIT 1"); // result for os
    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            $qty_left = $row['ts_quantity'];
            $data_from = 0;
        }
    } elseif ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $qty_left = $row['os_quantity'];
            $data_from = 1;
        }
    } else {
        header("location: ../requests.php?m=supplyNotFound");
        echo $conn->error;
        exit();
    }

    // Logic for knowing if there's sufficient stocks will be left

    // Example
    // 18 = 19 - 1
    // 0 = 1 - 1 
    $left = $qty_left - $appr_item_qty;
    // header("location: ../requests.php?left=$left&qty_left=$qty_left&appr_item_qty=$appr_item_qty");
    // exit();
    if ($left < 0) { // 18 < 0 => false
        // 0 < 0 = false; but -1 < 0 true
        // If left is less than 0, run this code below
        header("location: ../requests.php?m=insufficientStock");
        exit();
    }

    if ($data_from == 0) { // If supply from TS run TS query
        $update_ts_sql = "UPDATE technology_supplies SET ts_quantity='$left', date_last_modified='$now', modified_by='$uid' WHERE ts_id='$appr_item_id' AND ts_model LIKE '%$appr_item_name%'";
        if($conn->query($update_ts_sql) === TRUE) {
            $approve_sql = "UPDATE history SET status='approved', modified_by=$uid WHERE history_id=$appr_id";
            if($conn->query($approve_sql) === TRUE) {
                header("location: ../requests.php?m=requestApproved");
                exit();
            }
            else {
                echo $conn->error;
                echo "<script>alert('Error approving request.');window.location.replace('../requests.php?m=error');</script>";
            }
        }
        else {
            echo $conn->error;
            echo "<script>alert('Error updating technology supply.');window.location.replace('../requests.php?m=error');</script>";
        }
    } 
    elseif($data_from == 1) { // If supply from OS run OS query
        $update_os_sql = "UPDATE office_supplies SET os_quantity='$left', date_last_modified='$now', modified_by='$uid' WHERE os_id='$appr_item_id' AND os_name LIKE '%$appr_item_name%'";
        if($conn->query($update_os_sql) === TRUE) {
            $approve_sql = "UPDATE history SET status='approved', modified_by=$uid WHERE history_id=$appr_id";
            if($conn->query($approve_sql) === TRUE) {
                header("location: ../requests.php?m=requestApproved");
                exit();
            }
            else {
                echo $conn->error;
                echo "<script>alert('Error approving request.');window.location.replace('../requests.php?m=error');</script>";
            }
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating office supply.');window.location.replace('../requests.php?m=error');</script>";
        }
    }
    exit();
}
else {
    header("location: ../requests.php");
    exit();
}