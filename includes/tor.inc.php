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

    $stmt = $conn->prepare("SELECT * FROM tor WHERE id = ?");
    $stmt->bind_param('i', $tid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $tid = $row['id'];
        $tor_id = $row['tor_id'];
        $tor_user = $row['tor_user'];
        $date = $row['tor_date'];
        $tdlm = $row['date_last_modified'];
        $mby = $row['modified_by'];

        $return = '
        <div class="row">
        <input type="hidden" class="form-control" id="tid" name="tid" value"' . $tid .'">
        <div class="col-md-6 pt-1 pb-1">
            <label for="tor_id">TOR ID</label>
            <input type="text" class="form-control" id="tor_id" name="tor_id" value="' . $tor_id . '" disabled>
            <input type="hidden" class="form-control" id="tor_id" name="tor_id" value="' . $tor_id . '">
        </div>
        <div class="col-md-6 pt-1 pb-1">
            <label for="tor_user">Assigned To</label>
            <input type="text" class="form-control" id="tor_user" name="tor_user" value="' . $tor_user . '" disabled>
        </div>  
        <div class="col-md-6 pt-1 pb-1">
            <label for="ts_model">Unit of Measure</label>
            <input type="text" class="form-control" id="os_uom" name="os_uom" value="' . $uom . '" disabled>
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
    $sql = "INSERT INTO history(`os_id`, `history_quantity`, `user_id`, `status`, `modified_by`, `history_date`) VALUES ('$tor_id', '$qty', $id, 'pending', NULL, now())";

    if ($conn->query($sql) === TRUE) {
        header("location: ../tor.php?m=success");
        exit();
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../tor.php?m=error');</script>";
    }
}

// Disabling tech supply
if (isset($_POST['delete-supply'])) {

    // Include other PHP processes
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $del_id = $_POST['del_id']; // ID of the supply to disable
    $uid = $_POST['uid']; // User ID - the ID of the account that you're using

    $sql = "UPDATE office_supplies SET status='disabled', date_last_modified=now(), modified_by=$uid WHERE os_id=$del_id";
    if ($conn->query($sql) === TRUE) {
        // Return a success response
        header("location: ../tor.php?m=disablingSuccess");
        exit();
    } else {
        // Return an error response
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../tor.php?m=error');</script>";
        exit();
    }
    exit();
}

// Enabling tech supply
if (isset($_POST['enable-supply'])) {

    // Include other PHP processes
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $enbl_id = $_POST['enbl_id']; // ID of the supply to enable
    $uid = $_POST['uid']; // User ID - the ID of the account that you're using

    $sql = "UPDATE office_supplies SET status='enabled', date_last_modified=now(), modified_by=$uid WHERE os_id=$enbl_id";
    if ($conn->query($sql) === TRUE) {
        // Return a success response
        header("location: ../tor.php?m=enablingSuccess");
        exit();
    } else {
        // Return an error response
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../tor.php?m=error');</script>";
    }
    exit();
}


// add supply
if (isset($_POST['add-office-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id'])) {
        header("location: ../tor.php?m=noid");
        exit();
    }

    // details
    $uid = $_POST['user_id'];
    $name = $_POST['os_name'];
    $brand = $_POST['os_brand'];
    $uom = $_POST['os_uom'];
    $qty = $_POST['os_quantity'];
    $loc = $_POST['os_location'];
    $des = $_POST['os_description'];
    $stat = $_POST['status'];
    $os_img = $_POST['os_img']['name'];

    // functions to be added
    // requires
    require_once 'config.inc.php';
    require_once 'functions.inc.php';

    // Get the uploaded image file and its information
    $image = $_FILES['os_img']['name'];
    $tmp_img_name = $_FILES['os_img']['tmp_name'];
    $image_type = $_FILES['os_img']['type'];
    $image_size = $_FILES['os_img']['size'];
    $image_error = $_FILES['os_img']['error'];

    // Seperate extension and filename
    $image_tmp_ext = explode('.', $image);
    $image_ext = strtolower(end($image_tmp_ext));

    // Check if there is an empty field
    if (empty($name) or empty($uom) or empty($brand) or empty($qty) or empty($qty) or empty($loc)) {
        header("location: ../tor.php?m=emptyFields");
        exit();
    }

    // Check if image type is an image
    if (checkImageType($image_type) !== false) {
        header("location: ../tor.php?m=ImageTypeDenied");
        exit();
    }

    // Check if image size is more than 2mb
    if (checkImageSize($image_size) !== false) {
        header("location: ../tor.php?m=ImageTooLarge");
        exit();
    }

    // Check if image has an error
    if (
        checkImageError($image_error) !== false
    ) {
        header("location: ../tor.php?m=ImageError");
        exit();
    }

    // If all functions were passed then explode the image name and extension
    // Create a unique ID for the image
    // Upload the image to the folder
    $image_new_name = uniqid('', true) . "." . $image_ext;

    // Upload the image to upload folder (product_img)
    $image_final_name = 'IMG_' . $image_new_name;
    $folder = '../tor/';
    move_uploaded_file($tmp_img_name, $folder . $image_final_name);

    // All done head back to product.php
    $sql = "INSERT INTO `office_supplies` (`os_name`, `os_brand`, `os_uom`, `os_quantity`, `os_location`, `os_img`, `os_desc`, `status`, `date_added`, `date_last_modified`, `modified_by`) VALUES ('$name', '$brand','$uom','$qty', '$loc', '$image_final_name', '$des', '$stat', '$now', '$now', '$uid')";

    if ($conn->query($sql) === false) {
        header("location: ../tor.php?m=uploadError");
        exit();
    }

    header('location: ../tor.php?m=addSuccess');
    exit();
}