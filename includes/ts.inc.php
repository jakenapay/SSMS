<?php

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
    $dlm = $_POST['date_last_modified'];
    $by = $_POST['modified_by'];

    if (checkEmptyInput($name, $model, $brand, $cat, $loc, $dlm, $by) !== false) {
        // if true !== false => true; run this code
        header("location: ../tsEdit.php?m=emptyFields");
        exit();
    }

    // Sql query to update the row
    $updateQuery = "UPDATE ssms.technology_supplies SET `ts_name`='$name', `ts_model`='$model', `ts_brand`='$brand', `ts_category`='$cat', `ts_location`='$loc', `date_last_modified`=now(),`modified_by`=$uid WHERE ts_id=$tsid;";

    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>alert('Product updated successfully.');</script>";
        header("location: ../tsEdit.php?eid=$tsid&m=success");
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');</script>";
    }
} else {
    header("location: ../technologySupplies.php");
    exit();
}


    // // If img has name and img name isnt blank
    // if (isset($_FILES['product_pic']['name']) && ($_FILES['product_pic']['name'] != '')) {
    //     // Get the uploaded image file and its information
    //     // $image = $_FILES['product_pic']['name'];
    //     // $tmp_img_name = $_FILES['product_pic']['tmp_name'];
    //     // $image_type = $_FILES['product_pic']['type'];
    //     // $image_size = $_FILES['product_pic']['size'];
    //     // $image_error = $_FILES['product_pic']['error'];

    //     $imgName = $_FILES['product_pic']['name'];
    //     $imgTmpName = $_FILES['product_pic']['tmp_name'];
    //     $imgType = $_FILES['product_pic']['type'];
    //     $imgSize = $_FILES['product_pic']['size'];
    //     $imgError = $_FILES['product_pic']['error'];
    //     $old_pic = $_POST['old_pic'];

    //     // Seperate extension and filename
    //     $imageTmpExt = explode('.', $imgName);
    //     $imageExt = strtolower(end($imageTmpExt));

    //     // Check if image type is an image
    //     if (checkImageType($imgType) !== false) {
    //         header("location: ../product.php?id='.$id.'&error=ImageTypeDenied");
    //         exit();
    //     }

    //     // Check if image size is more than 2mb
    //     if (checkImageSize($imgSize) !== false) {
    //         header("location: ../product.php?id='.$id.'&error=ImageTooLarge");
    //         exit();
    //     }

    //     // Check if image has an error
    //     if (checkImageError($imgError) !== false) {
    //         header("location: ../product.php?id='.$id.'&error=ImageError");
    //         exit();
    //     }

    //     // If all functions were passed then explode the image name and extension
    //     // Declare path and old pic name, and unlink/delete it from folder of images
    //     if (isset($old_pic) && ($old_pic != '')) {
    //         $path = "../product_img/" . $old_pic;
    //         if (!unlink($path)) {
    //             echo "You have an error deleting image";
    //         }
    //     }

    //     // Create a unique ID for the image
    //     // Upload the image to the folder
    //     $imageNewName = uniqid('', true) . "." . $imageExt;

    //     // Upload the image to upload folder (product_img)
    //     $img = 'IMG_' . $imageNewName;
    //     $folder = '../product_img/';
    //     move_uploaded_file($imgTmpName, $folder . $img);
    // } else {
    //     $img = $old_pic;
    // }