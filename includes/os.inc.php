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
    $updateQuery = "UPDATE ssms.office_supplies SET `os_name`='$name', `os_brand`='$brand', `os_uom`='$uom',`os_location`='$loc', `os_desc`='$des', `date_last_modified`=now(),`modified_by`=$uid WHERE os_id=$osid;";

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
        header("location: ../officeSupplies.php");
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

        $sql = "UPDATE ssms.office_supplies SET os_img='$img', date_last_modified=now(), modified_by=$uid WHERE os_id=$osid";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product updated successfully.');window.location.replace('../osEdit.php?eid='.$osid.'&m=failed');</script>";
            header("location: ../osEdit.php?eid=$osid&m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../osEdit.php?eid='.$osid.'&m=error');</script>";
        }
    } else {
        $img = $old_img;
    }
}


if (isset($_POST['check_view'])) {

    // get the technology supply id
    $os_id = $_POST['os_id'];

    // requirements to run into database and functions for configurations
    require 'config.inc.php';

    $result = $conn->query("SELECT * FROM ssms.office_supplies WHERE os_id = $os_id");
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
            <form>
                <div class="row">
                    <div class="col-md-12 pt-4 pb-5 d-flex justify-content-center">
                        <img src="officeSupplies/' . $old_img . '" alt="" class="img-fluid" style="width: 300px;">
                    </div>
                    <div class="col-md-12 pt-1 pb-1">
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
            </form>
            ';
        }
    } else {
        echo '<h5>No result</h5>';
    }
}
