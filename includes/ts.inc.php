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
    $dlm = $_POST['date_last_modified'];
    $by = $_POST['modified_by'];

    if (checkEmptyInput($name, $model, $brand, $cat, $loc, $dlm, $by) !== false) {
        // if true !== false => true; run this code
        header("location: ../tsEdit.php?eid=$tsid&m=emptyFields");
        exit();
    }

    // Sql query to update the row
    $updateQuery = "UPDATE ssms.technology_supplies SET `ts_name`='$name', `ts_model`='$model', `ts_brand`='$brand', `ts_category`='$cat', `ts_location`='$loc', `ts_desc`='$des', `date_last_modified`=now(),`modified_by`=$uid WHERE ts_id=$tsid;";

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

    // get the technology supply id
    $ts_id = $_POST['ts_id'];

    // requirements to run into database and functions for configurations
    require 'config.inc.php';

    $result = $conn->query("SELECT * FROM ssms.technology_supplies WHERE ts_id = $ts_id");
    // Check if the query was successful
    if ($result) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            // Process each row and generate the HTML content
            $tsid = $row['ts_id'];
            $name = $row['ts_name'];
            $model = $row['ts_model'];
            $brand = $row['ts_brand'];
            $cat = $row['ts_category'];
            $qty = $row['ts_quantity'];
            $loc = $row['ts_location'];
            $old_img = $row['ts_img'];
            $des = $row['ts_desc'];
            $da = $row['date_added'];
            $dlm = $row['date_last_modified'];
            // $by = $row['fullname'];

            echo $return = '
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
        }
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
        $sql2 = "INSERT INTO ssms.history(`ts_id`, `history_quantity`, `user_id`, `history_date`) VALUES ('$tsid', '$qty', $id, now())";
        if ($conn->query($sql2) === TRUE) {
            header("location: ../technologySupplies.php?m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');</script>";
            // window . location . replace('../technoglogySupplies.php?m=error');
        }
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');</script>";
        // window . location . replace('../technoglogySupplies.php?m=error');
    }
}
