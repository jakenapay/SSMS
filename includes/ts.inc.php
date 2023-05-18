<?php

// UPDATE DETAILS OF TECHNOLOGY SUPPLIES
if (isset($_POST['save-changes'])) {

    if (!isset($_POST['ts_id']) and !isset($_POST['uid'])) {
        // go back to edit panel
        header("location: ../technologySupplies.php");
        exit();
    }

    require 'config.inc.php';
    require 'functions.inc.php';

    $uid =  $_POST['uid']; // User id or more likely modified by
    $tsid = $_POST['ts_id'];
    $name = $_POST['ts_name'];
    $model = $_POST['ts_model'];
    $brand = $_POST['ts_brand'];
    $cat = $_POST['ts_category'];
    $loc = $_POST['ts_location'];
    $des = $_POST['ts_desc'];
    $qty = $_POST['ts_quantity'];
    $dlm = $_POST['date_last_modified'];
    $by = $_POST['modified_by'];

    if (checkEmptyInput($name, $model, $brand, $cat, $qty, $loc, $dlm, $by) !== false) {
        // if true !== false => true; run this code
        header("location: ../tsEdit.php?eid=$tsid&m=emptyFields");
        exit();
    }

    // Sql query to update the row
    $updateQuery = "UPDATE ssms.technology_supplies SET `ts_name`='$name', `ts_model`='$model', `ts_brand`='$brand', `ts_category`='$cat', `ts_quantity`='$qty', `ts_location`='$loc', `ts_desc`='$des', `date_last_modified`=now(),`modified_by`=$uid WHERE ts_id=$tsid;";

    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>alert('Product updated successfully.');</script>";
        header("location: ../tsEdit.php?eid=$tsid&m=success");
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../tsEdit.php?eid=$tsid&m=error');</script>";
    }
}

// UPDATE AN IMAGE OF TECHNOLOGY SUPPLIES
if (isset($_POST['update-img'])) {

    // check first if there's an id of technology and the user
    if (!isset($_POST['ts_id']) and !isset($_POST['uid'])) {
        // go back to edit panel
        header("location: ../technologySupplies.php");
        exit();
    }

    require 'config.inc.php';
    require 'functions.inc.php';

    $tsid = $_POST['ts_id'];
    $uid = $_POST['uid'];

    // If img has name and img name isnt blank
    if (isset($_FILES['ts_img']['name']) && ($_FILES['ts_img']['name'] != '')) {

        $imgName = $_FILES['ts_img']['name'];
        $imgTmpName = $_FILES['ts_img']['tmp_name'];
        $imgType = $_FILES['ts_img']['type'];
        $imgSize = $_FILES['ts_img']['size'];
        $imgError = $_FILES['ts_img']['error'];
        $old_img = $_POST['old_img'];

        // Seperate extension and filename
        $imageTmpExt = explode('.', $imgName);
        $imageExt = strtolower(end($imageTmpExt));

        // Check if image type is an image
        if (checkImageType($imgType) !== false) {
            header("location: ../tsEdit.php?eid='.$tsid.'&error=ImageTypeDenied");
            exit();
        }

        // Check if image size is more than 2mb
        if (checkImageSize($imgSize) !== false) {
            header("location: ../tsEdit.php?eid='.$tsid.'&error=ImageTooLarge");
            exit();
        }

        // Check if image has an error
        if (checkImageError($imgError) !== false) {
            header("location: ../tsEdit.php?eid='.$tsid.'&error=ImageError");
            exit();
        }

        // If all functions were passed then explode the image name and extension
        // Declare path and old pic name, and unlink/delete it from folder of images
        if (isset($old_img) && ($old_img != '')) {
            $path = "../technologySupplies/" . $old_img;
            if (!unlink($path)) {
                echo "You have an error deleting image";
            }
        }

        // Create a unique ID for the image
        // Upload the image to the folder
        $imageNewName = uniqid('', true) . "." . $imageExt;

        // Upload the image to upload folder (product_img)
        $img = 'IMG_' . $imageNewName;
        $folder = '../technologySupplies/';
        move_uploaded_file($imgTmpName, $folder . $img);

        $sql = "UPDATE ssms.technology_supplies SET ts_img='$img', date_last_modified=now(), modified_by=$uid WHERE ts_id=$tsid";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product updated successfully.');window.location.replace('../tsEdit.php?eid='.$tsid.'&m=failed');</script>";
            header("location: ../tsEdit.php?eid=$tsid&m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../tsEdit.php?eid='.$tsid.'&m=error');</script>";
        }
    } else {
        $img = $old_img;
    }
}


if (isset($_POST['check_view'])) {
    // requirements to run into database and functions for configurations
    require 'config.inc.php';

    // get the technology supply id
    $ts_id = $_POST['ts_id'];

    $stmt = $conn->prepare("SELECT * FROM ssms.technology_supplies WHERE ts_id = ?");
    $stmt->bind_param('i', $ts_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $tsid = $row['ts_id'];
        $name = $row['ts_name'];
        $brand = $row['ts_brand'];
        $model = $row['ts_model'];
        $cat = $row['ts_category'];
        $qty = $row['ts_quantity'];
        $loc = $row['ts_location'];
        $old_img = $row['ts_img'];
        $des = $row['ts_desc'];
        $da = $row['date_added'];
        $dlm = $row['date_last_modified'];

        $return = '
        <div class="row">
                    <div class="col-md-12 pt-4 pb-5 d-flex justify-content-center">
                        <img src="technologySupplies/' . $old_img . '" alt="" class="img-fluid" style="width: 300px;">
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="tsid">ID</label>
                        <input type="text" class="form-control" id="ts_id" name="ts_id" value="' . $tsid . '" disabled>
                        <input type="hidden" class="form-control" id="ts_id" name="ts_id" value="' . $tsid . '">
                    </div> 
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="ts_name" name="ts_name" value="' . $name . '" disabled>
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="ts_model">Model</label>
                        <input type="text" class="form-control" id="ts_model" name="ts_model" value="' . $model . '" disabled>
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="ts_brand">Brand</label>
                        <input type="text" class="form-control" id="ts_brand" name="ts_brand" value="' . $brand . '" disabled>
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="ts_category">Category</label>
                        <input type="text" class="form-control" id="ts_category" name="ts_category" value="' . $cat . '" disabled>
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="ts_location">Location</label>
                        <input type="text" class="form-control" id="ts_location" name="ts_location" value="' . $loc . '" disabled>
                    </div>
                    <div class="col-md-12 pt-1 pb-1">
                        <label for="ts_desc">Description (Additional Information)</label>
                        <textarea type="text" class="form-control" id="ts_desc" name="ts_desc" disabled>' . $des . '</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="w-100 my-2">
                        <hr
                    </div>
                    <div class="col-md-12 pt-3 pb-2">
                        <h6><strong>Get this item:</strong></h6>
                        <h6><span class="text-muted"><strong>Note:</strong> Please be careful when getting items</span></h6>
                         <div class="form-group mt-3">
                            <span class="d-flex justify-content-between align-items-center">
                                <label class="" for="get_quantity">Quantity (1-10)</label>
                                <label><strong>' . $qty . ' left</strong></label>
                            </span>
                                <input class="form-control" type="number" min="1" max="10" name="get_quantity" id="get_quantity" placeholder="1-10" required>
                                <input type="hidden" name="ts_quantity" value="' . $qty . '" />
                        </div>
                    </div>
                </div>
        ';

        echo $return;
    } else {
        echo '<h5>No result</h5>';
    }
}

if (isset($_POST['get-btn-tech'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id']) or empty($_POST['ts_id'])) {
        header("location: ../technologySupplies.php?m=noid");
        exit();
    }

    $tsid = $_POST['ts_id'];
    $id = $_POST['user_id'];

    // how many supply the user will get
    $qty = $_POST['get_quantity'];
    // how many supply left
    $qty_left = $_POST['ts_quantity'];

    if (empty($qty)) {
        header("location: ../technologySupplies.php?m=nogetquantity");
    }
    if (empty($qty_left)) {
        header("location: ../technologySupplies.php?m=noquantityleft");
    }

    // 18 = 19 - 1
    // 0 = 1 - 1 
    $left = $qty_left - $qty;
    if ($left < 0) { // 18 < 0 => false
        // 0 < 0 = false; but -1 < 0 true
        // If left is less than 0, run this code below
        header("location: ../technologySupplies.php?m=insufficientStock");
        exit();
    }

    $sql = "UPDATE ssms.technology_supplies SET ts_quantity='$left', date_last_modified=now(), modified_by=$id WHERE ts_id=$tsid";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "INSERT INTO ssms.history(`ts_id`, `history_quantity`, `user_id`, `status`, `modified_by`, `history_date`) VALUES ('$tsid', '$qty', $id, 'pending', NULL, now())";
        if ($conn->query($sql2) === TRUE) {
            header("location: ../technologySupplies.php?m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../technoglogySupplies.php?m=error');</script>";
        }
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../technoglogySupplies.php?m=error');</script>";
    }
}

// Disabling tech supply new
if (isset($_POST['delete-supply'])) {

    // Include other PHP processes
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $del_id = $_POST['del_id']; // ID of the supply to disable
    $uid = $_POST['uid']; // User ID - the ID of the account that you're using

    $sql = "UPDATE ssms.technology_supplies SET status='disabled', date_last_modified=now(), modified_by=$uid WHERE ts_id=$del_id";
    if ($conn->query($sql) === TRUE) {
        // Return a success response
        header("location: ../technologySupplies.php?m=disablingSuccess");
        exit();
    } else {
        // Return an error response
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../technologySupplies.php?m=error');</script>";
        exit();
    }
    exit();
}

// Enabling tech supply new
if (isset($_POST['enable-supply'])) {

    // Include other PHP processes
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $enbl_id = $_POST['enbl_id']; // ID of the supply to enable
    $uid = $_POST['uid']; // User ID - the ID of the account that you're using

    $sql = "UPDATE ssms.technology_supplies SET status='enabled', date_last_modified=now(), modified_by=$uid WHERE ts_id=$enbl_id";
    if ($conn->query($sql) === TRUE) {
        // Return a success response
        header("location: ../technologySupplies.php?m=enablingSuccess");
        exit();
    } else {
        // Return an error response
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../technologySupplies.php?m=error');</script>";
    }
    exit();
}

// add supply
if (isset($_POST['add-tech-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id'])) {
        header("location: ../technologySupplies.php?m=noid");
        exit();
    }

    // details
    $uid = $_POST['user_id'];
    $name = $_POST['ts_name'];
    $model = $_POST['ts_model'];
    $brand = $_POST['ts_brand'];
    $cat = $_POST['ts_category'];
    $qty = $_POST['ts_quantity'];
    $loc = $_POST['ts_location'];
    $des = $_POST['ts_description'];
    $stat = $_POST['status'];
    $ts_img = $_POST['ts_img']['name'];

    // functions to be added
    // requires
    require_once 'config.inc.php';
    require_once 'functions.inc.php';

    // Get the uploaded image file and its information
    $image = $_FILES['ts_img']['name'];
    $tmp_img_name = $_FILES['ts_img']['tmp_name'];
    $image_type = $_FILES['ts_img']['type'];
    $image_size = $_FILES['ts_img']['size'];
    $image_error = $_FILES['ts_img']['error'];

    // Seperate extension and filename
    $image_tmp_ext = explode('.', $image);
    $image_ext = strtolower(end($image_tmp_ext));

    // Check if there is an empty field
    if (empty($name) or empty($model) or empty($brand) or empty($cat) or empty($qty) or empty($qty) or empty($loc)) {
        header("location: ../technologySupplies.php?m=emptyFields");
        exit();
    }

    // Check if image type is an image
    if (checkImageType($image_type) !== false) {
        header("location: ../technologySupplies.php?m=ImageTypeDenied");
        exit();
    }

    // Check if image size is more than 2mb
    if (checkImageSize($image_size) !== false) {
        header("location: ../technologySupplies.php?m=ImageTooLarge");
        exit();
    }

    // Check if image has an error
    if (
        checkImageError($image_error) !== false
    ) {
        header("location: ../technologySupplies.php?m=ImageError");
        exit();
    }

    // If all functions were passed then explode the image name and extension
    // Create a unique ID for the image
    // Upload the image to the folder
    $image_new_name = uniqid('', true) . "." . $image_ext;

    // Upload the image to upload folder (product_img)
    $image_final_name = 'IMG_' . $image_new_name;
    $folder = '../technologySupplies/';
    move_uploaded_file($tmp_img_name, $folder . $image_final_name);

    // All done head back to product.php
    $sql = "INSERT INTO `ssms`.`technology_supplies` (`ts_name`, `ts_model`, `ts_brand`, `ts_category`, `ts_quantity`, `ts_location`, `ts_img`, `ts_desc`, `status`, `date_added`, `date_last_modified`, `modified_by`) VALUES ('$name','$model','$brand','$cat','$qty', '$loc', '$image_final_name', '$des', '$stat', now(), now(), '$uid')";

    if ($conn->query($sql) === false) {
        header("location: ../technologySupplies.php?m=uploadError");
        exit();
    }

    header('location: ../technologySupplies.php?m=success');
    exit();
}
