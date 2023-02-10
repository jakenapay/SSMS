<?php

// UPDATE DETAILS OF TECHNOLOGY SUPPLIES
if (isset($_POST['save-changes'])) {

    if (!isset($_POST['os_id']) and !isset($_POST['uid'])) {
        // go back to edit panel
        header("location: ../officeSupplies.php?m=noid");
        exit();
    }

    require 'config.inc.php';
    require 'functions.inc.php';

    $uid =  $_POST['uid']; // User id or more likely modified by
    $osid = $_POST['os_id'];
    $name = $_POST['os_name'];
    $uom = $_POST['os_uom'];
    $brand = $_POST['os_brand'];
    $des = $_POST['os_desc'];
    $loc = $_POST['os_location'];
    $dlm = $_POST['date_last_modified'];
    $by = $_POST['modified_by'];

    if (checkEmptyInput($name, $des, $brand, $uom, $loc, $dlm, $by) !== false) {
        // if true !== false => true; run this code
        header("location: ../osEdit.php?eid=$osid&m=emptyFields");
        exit();
    }

    // Sql query to update the row
    $updateQuery = "UPDATE epiz_33456032_ssms.office_supplies SET `os_name`='$name', `os_brand`='$brand', `os_uom`='$uom',`os_location`='$loc', `os_desc`='$des', `date_last_modified`=now(),`modified_by`=$uid WHERE os_id=$osid;";

    if ($conn->query($updateQuery) === TRUE) {
        // echo "<script>alert('Product updated successfully.');</script>";
        header("location: ../osEdit.php?eid=$osid&m=success");
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../osEdit.php?eid=$osid&m=error');</script>";
    }
}

// UPDATE AN IMAGE OF TECHNOLOGY SUPPLIES
if (isset($_POST['update-img'])) {

    // check first if there's an id of technology and the user
    if (!isset($_POST['os_id']) and !isset($_POST['uid'])) {
        // go back to edit panel
        header("location: ../officeSupplies.php?m=noid");
        exit();
    }

    require 'config.inc.php';
    require 'functions.inc.php';

    $osid = $_POST['os_id'];
    $uid = $_POST['uid'];

    // If img has name and img name isnt blank
    if (isset($_FILES['os_img']['name']) && ($_FILES['os_img']['name'] != '')) {

        $imgName = $_FILES['os_img']['name'];
        $imgTmpName = $_FILES['os_img']['tmp_name'];
        $imgType = $_FILES['os_img']['type'];
        $imgSize = $_FILES['os_img']['size'];
        $imgError = $_FILES['os_img']['error'];
        $old_img = $_POST['old_img'];

        // Seperate extension and filename
        $imageTmpExt = explode('.', $imgName);
        $imageExt = strtolower(end($imageTmpExt));

        // Check if image type is an image
        if (checkImageType($imgType) !== false) {
            header("location: ../osEdit.php?eid='.$osid.'&error=ImageTypeDenied");
            exit();
        }

        // Check if image size is more than 2mb
        if (checkImageSize($imgSize) !== false) {
            header("location: ../osEdit.php?eid='.$osid.'&error=ImageTooLarge");
            exit();
        }

        // Check if image has an error
        if (checkImageError($imgError) !== false) {
            header("location: ../osEdit.php?eid='.$osid.'&error=ImageError");
            exit();
        }

        // If all functions were passed then explode the image name and extension
        // Declare path and old pic name, and unlink/delete it from folder of images
        if (isset($old_img) && ($old_img != '')) {
            $path = "../officeSupplies/" . $old_img;
            if (!unlink($path)) {
                echo "You have an error deleting image";
            }
        }

        // Create a unique ID for the image
        // Upload the image to the folder
        $imageNewName = uniqid('', true) . "." . $imageExt;

        // Upload the image to upload folder (product_img)
        $img = 'IMG_' . $imageNewName;
        $folder = '../officeSupplies/';
        move_uploaded_file($imgTmpName, $folder . $img);

        $sql = "UPDATE epiz_33456032_ssms.office_supplies SET os_img='$img', date_last_modified=now(), modified_by=$uid WHERE os_id=$osid";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product updated successfully.');window.location.replace('../osEdit.php?eid='.$osid.'&m=failed');</script>";
            header("location: ../osEdit.php?eid=$osid&m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../osEdit.php?eid='.$osid.'&m=error');</script>";
        }
    } else {
        $img = $old_img;
        header("location: ../officeSupplies.php?m=noimg");
        exit();
    }
}


if (isset($_POST['check_view'])) {

    // get the technology supply id
    $os_id = $_POST['os_id'];

    // requirements to run into database and functions for configurations
    require 'config.inc.php';

    $result = $conn->query("SELECT * FROM epiz_33456032_ssms.office_supplies WHERE os_id = $os_id");
    // Check if the query was successful
    if ($result) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            // Process each row and generate the HTML content
            $osid = $row['os_id'];
            $name = $row['os_name'];
            $brand = $row['os_brand'];
            $uom = $row['os_uom'];
            $qty = $row['os_quantity'];
            $loc = $row['os_location'];
            $old_img = $row['os_img'];
            $des = $row['os_desc'];
            $da = $row['date_added'];
            $dlm = $row['date_last_modified'];
            // $by = $row['fullname'];

            echo $return = '
                <div class="row">
                    <div class="col-md-12 pt-4 pb-5 d-flex justify-content-center">
                        <img src="officeSupplies/' . $old_img . '" alt="" class="img-fluid" style="width: 300px;">
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="os_id">ID</label>
                        <input type="text" class="form-control" id="os_id" name="os_id" value="' . $osid . '" disabled>
                        <input type="hidden" class="form-control" id="os_id" name="os_id" value="' . $osid . '">
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="os_name" name="os_name" value="' . $name . '" disabled>
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="ts_brand">Brand</label>
                        <input type="text" class="form-control" id="os_brand" name="os_brand" value="' . $brand . '" disabled>
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="ts_model">Unit of Measure</label>
                        <input type="text" class="form-control" id="os_uom" name="os_uom" value="' . $uom . '" disabled>
                    </div>
                    <div class="col-md-12 pt-1 pb-1">
                        <label for="ts_model">Description (additional information)</label>
                        <textarea type="text" class="form-control" id="os_uom" name="os_uom" disabled>' . $des . '</textarea>
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
                                <input type="hidden" name="os_quantity" value="' . $qty . '" />
                        </div>
                    </div>
                </div>
            ';
        }
    } else {
        echo '<h5>No result</h5>';
    }
}

if (isset($_POST['get-btn-office'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id']) or empty($_POST['os_id'])) {
        header("location: ../officeSupplies.php?m=noid");
        exit();
    }

    $osid = $_POST['os_id'];
    $id = $_POST['user_id'];

    // how many supply the user will get
    $qty = $_POST['get_quantity'];
    // how many supply left
    $qty_left = $_POST['os_quantity'];

    if (empty($qty)) {
        header("location: ../officeSupplies.php?m=nogetquantity");
    }
    if (empty($qty_left)) {
        header("location: ../officeSupplies.php?m=noquantityleft");
    }

    // 18 = 19 - 1
    // 0 = 1 - 1 
    $left = $qty_left - $qty;
    if ($left < 0) { // 18 < 0 => false
        // 0 < 0 = false; but -1 < 0 true
        // If left is less than 0, run this code below
        header("location: ../officeSupplies.php?m=insufficientStock");
        exit();
    }

    $sql = "UPDATE epiz_33456032_ssms.office_supplies SET os_quantity='$left', date_last_modified=now(), modified_by=$id WHERE os_id=$osid";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "INSERT INTO epiz_33456032_ssms.history(`os_id`, `history_quantity`, `user_id`, `history_date`) VALUES ('$osid', '$qty', $id, now())";
        if ($conn->query($sql2) === TRUE) {
            header("location: ../officeSupplies.php?m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../officeSupplies.php?m=error');</script>";
        }
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../officeSupplies.php?m=error');</script>";
    }
}

// disabling tech supply
if (isset($_POST['delete-supply'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $del_id = $_POST['del_id']; // delete id of the certain TS
    $uid = $_POST['uid']; // user id - the id of account that you're using

    $sql = "UPDATE epiz_33456032_ssms.office_supplies SET status='disabled', date_last_modified=now(), modified_by=$uid WHERE os_id=$del_id";
    if ($conn->query($sql) === TRUE) {
        header("location: ../officeSupplies.php?m=disablingSuccess");
        exit();
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../officeSupplies.php?m=error');</script>";
        exit();
    }
}

// enable-supply
if (isset($_POST['enable-supply'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    $enbl_id = $_POST['enbl_id']; // delete id of the certain TS
    $uid = $_POST['uid']; // user id - the id of account that you're using

    $sql = "UPDATE epiz_33456032_ssms.office_supplies SET status='enabled', date_last_modified=now(), modified_by=$uid WHERE os_id=$enbl_id";
    if ($conn->query($sql) === TRUE) {
        header("location: ../officeSupplies.php?m=enablingSuccess");
        exit();
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../officeSupplies.php?m=error');</script>";
    }
}


// add supply
if (isset($_POST['add-office-btn'])) {

    // include other php process
    include_once 'config.inc.php';
    include_once 'functions.inc.php';

    if (empty($_POST['user_id'])) {
        header("location: ../officeSupplies.php?m=noid");
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
        header("location: ../officeSupplies.php?m=emptyFields");
        exit();
    }

    // Check if image type is an image
    if (checkImageType($image_type) !== false) {
        header("location: ../officeSupplies.php?m=ImageTypeDenied");
        exit();
    }

    // Check if image size is more than 2mb
    if (checkImageSize($image_size) !== false) {
        header("location: ../officeSupplies.php?m=ImageTooLarge");
        exit();
    }

    // Check if image has an error
    if (
        checkImageError($image_error) !== false
    ) {
        header("location: ../officeSupplies.php?m=ImageError");
        exit();
    }

    // If all functions were passed then explode the image name and extension
    // Create a unique ID for the image
    // Upload the image to the folder
    $image_new_name = uniqid('', true) . "." . $image_ext;

    // Upload the image to upload folder (product_img)
    $image_final_name = 'IMG_' . $image_new_name;
    $folder = '../officeSupplies/';
    move_uploaded_file($tmp_img_name, $folder . $image_final_name);

    // All done head back to product.php
    $sql = "INSERT INTO `epiz_33456032_ssms`.`office_supplies` (`os_name`, `os_brand`, `os_uom`, `os_quantity`, `os_location`, `os_img`, `os_desc`, `status`, `date_added`, `date_last_modified`, `modified_by`) VALUES ('$name', '$brand','$uom','$qty', '$loc', '$image_final_name', '$des', '$stat', now(), now(), '$uid')";

    if ($conn->query($sql) === false) {
        header("location: ../officeSupplies.php?m=uploadError");
        exit();
    }

    header('location: ../officeSupplies.php?m=success');
    exit();
}
