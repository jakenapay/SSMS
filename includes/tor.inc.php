<?php

// UPDATE DETAILS OF OFFICE SUPPLIES
if (isset($_POST['save-changes'])) {

    if (!isset($_POST['eid']) and !isset($_POST['uid'])) {
        // go back to edit panel
        header("location: ../tor.php?m=noid");
        exit();
    }

    include 'config.inc.php';
    include 'functions.inc.php';

    $uid =  $_POST['uid']; // User id or more likely modified by
    $tid = $_POST['tid'];
    $tor_id = $_POST['tor_id'];
    $tor_user = $_POST['tor_user'];
    $tdlm = $_POST['tdlm'];
    $mby = $_POST['mby'];

    if (checkEmptyInput($name, $des, $brand, $uom, $qty, $loc, $dlm, $by) !== false) {
        // if true !== false => true; run this code
        header("location: ../torEdit.php?eid=$tid&m=emptyFields");
        exit();
    }

    

    // Sql query to update the row
    $updateQuery = "UPDATE tor SET `tor_user`='$tor_user', `date_last_modified`='$tdlm', `modified_by`=$uid WHERE tor_id=$tor_id;";

    if ($conn->query($updateQuery) === TRUE) {
        header("location: ../torEdit.php?eid=$tid&m=success");
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating TOR.');window.location.replace('../torEdit.php?eid=$tid&m=error');</script>";
    }
}

// New view TOR 
if (isset($_POST['check_view'])) {
    require 'config.inc.php';

    $tid = $_POST['tid'];

    $stmt = $conn->prepare("SELECT *, CONCAT(u.user_firstname, ' ', u.user_lastname) as 'fullname' FROM tor LEFT JOIN users u ON tor.tor_user=u.user_id WHERE id = ?");
    $stmt->bind_param('i', $tid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $tid = $row['id'];
        $tor_id = $row['tor_id'];
        $tor_user = $row['tor_user'];
        $fullname = $row['fullname'];
        $date = $row['tor_date'];
        $tdlm = $row['date_last_modified'];
        $mby = $row['modified_by'];

        $return = '
        <div class="row">
        <input type="hidden" class="form-control" id="tid" name="tid" value"' . $tid .'">
        <div class="col-md-12 pt-1 pb-1">
            <label for="tor_id">TOR ID</label>
            <input type="text" class="form-control" id="tor_id" name="tor_id" value="' . $tor_id . '" disabled>
            <input type="hidden" class="form-control" id="tor_id" name="tor_id" value="' . $tor_id . '">
        </div>
        
        ';

        

        echo $return;
    } else {
        echo '<h5>No result</h5>';
    }
}

if (isset($_POST['get-tor'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id']) or empty($_POST['tid'])) {
        header("location: ../tor.php?m=noid");
        exit();
    }

    $tor_id = $_POST['os_id'];
    $id = $_POST['user_id'];

    // how many supply the user will get
    $qty = $_POST['get_quantity'];
    // how many supply left
    $qty_left = $_POST['os_quantity'];

    if (empty($qty)) {
        header("location: ../tor.php?m=nogetquantity");
    }
    if (empty($qty_left)) {
        header("location: ../tor.php?m=noquantityleft");
    }

    // 18 = 19 - 1
    // 0 = 1 - 1 
    $left = $qty_left - $qty;
    if ($left < 0) { // 18 < 0 => false
        // 0 < 0 = false; but -1 < 0 true
        // If left is less than 0, run this code below
        header("location: ../tor.php?m=insufficientStock");
        exit();
    }

    // $sql = "UPDATE office_supplies SET os_quantity='$left', date_last_modified='$now', modified_by=$id WHERE os_id=$tor_id";
    // Lalagay sa request.inc.php
    $sql = "INSERT INTO history(`tor_id`, `history_quantity`, `user_id`, `status`, `modified_by`, `history_date`) VALUES ('$tor_id', '1', $id, 'pending', NULL, now())";

    if ($conn->query($sql) === TRUE) {
        header("location: ../tor.php?m=success");
        exit();
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../tor.php?m=error');</script>";
    }
}

// // Disabling tech supply
// if (isset($_POST['delete-supply'])) {

//     // Include other PHP processes
//     include_once 'config.inc.php';
//     include_once 'functions.inc.php';

//     $del_id = $_POST['del_id']; // ID of the supply to disable
//     $uid = $_POST['uid']; // User ID - the ID of the account that you're using

//     $sql = "UPDATE office_supplies SET status='disabled', date_last_modified=now(), modified_by=$uid WHERE os_id=$del_id";
//     if ($conn->query($sql) === TRUE) {
//         // Return a success response
//         header("location: ../tor.php?m=disablingSuccess");
//         exit();
//     } else {
//         // Return an error response
//         echo $conn->error;
//         echo "<script>alert('Error updating product.');window.location.replace('../tor.php?m=error');</script>";
//         exit();
//     }
//     exit();
// }

// // Enabling tech supply
// if (isset($_POST['enable-supply'])) {

//     // Include other PHP processes
//     include_once 'config.inc.php';
//     include_once 'functions.inc.php';

//     $enbl_id = $_POST['enbl_id']; // ID of the supply to enable
//     $uid = $_POST['uid']; // User ID - the ID of the account that you're using

//     $sql = "UPDATE office_supplies SET status='enabled', date_last_modified=now(), modified_by=$uid WHERE os_id=$enbl_id";
//     if ($conn->query($sql) === TRUE) {
//         // Return a success response
//         header("location: ../tor.php?m=enablingSuccess");
//         exit();
//     } else {
//         // Return an error response
//         echo $conn->error;
//         echo "<script>alert('Error updating product.');window.location.replace('../tor.php?m=error');</script>";
//     }
//     exit();
// }


// add supply
if (isset($_POST['add-tor-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id'])) {
        header("location: ../tor.php?m=noid");
        exit();
    }

    // details
    $uid = $_POST['user_id'];
    $tid = $_POST['id'];
    $tor_id = $_POST['tor_id'];
    $tor_user = $_POST['tor_user'];
    $fullname = $_POST['fullname'];
    $date = $_POST['tor_date'];
    $tdlm = $_POST['date_last_modified'];
    $mby = $_POST['modified_by'];

    // functions to be added
    // requires
    require_once 'config.inc.php';
    require_once 'functions.inc.php';


    $sql = "INSERT INTO `tor` (`tor_id`, `tor_user`, `tor_date`, `date_last_modified`, `modified_by`) VALUES ('$tor_id', NULL, '$now', '$now', '$uid')";

    if ($conn->query($sql) === false) {
        header("location: ../tor.php?m=uploadError");
        exit();
    }

    header('location: ../tor.php?m=addSuccess');
    exit();
}