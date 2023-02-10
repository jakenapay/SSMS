<?php

if (isset($_POST['save-btn'])) {
    session_start();
    // requires
    require 'config.inc.php';
    require 'functions.inc.php';

    // get user inputs
    $id = $_SESSION['id'];
    $fname = $_POST['new_fn'];
    $lname = $_POST['new_ln'];
    $email = $_POST['new_em'];
    $pw = $_POST['new_pw'];

    // check for invalid email
    if (invalidEmail($email) !== false) {
        header("location: ../profile.php?m=invalidEmail");
        exit();
    }

    // retrieve the email and check if the email was changed
    if ($_SESSION['em'] != $email) {
        // check for email if existing
        if (checkEmailExist($conn, $email) !== false) {
            header("location: ../profile.php?m=emailExist");
            exit();
        }
    }

    $pw = password_hash($pw, PASSWORD_ARGON2I);
    // sql query
    $sql = "UPDATE epiz_33456032_ssms.users SET user_firstname='$fname', user_lastname='$lname', user_email='$email', user_password='$pw' WHERE user_id=$id";
    if ($conn->query($sql) === TRUE) {
        header("location: ../profile.php?m=updateSuccess");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


// UPDATE AN IMAGE OF TECHNOLOGY SUPPLIES
if (isset($_POST['edit-image'])) {

    // check first if there's an id of technology and the user
    if (!isset($_POST['user_id']) or !isset($_POST['uid'])) {
        // go back to edit panel
        header("location: ../profile.php?m=noid");
        exit();
    }

    require 'config.inc.php';
    require 'functions.inc.php';

    $old_img = $_POST['old_img'];
    $user_id = $_POST['user_id'];
    $uid = $_POST['uid'];

    // If img has name and img name isnt blank
    if (isset($_FILES['user_img']['name']) && ($_FILES['user_img']['name'] != '')) {

        $imgName = $_FILES['user_img']['name'];
        $imgTmpName = $_FILES['user_img']['tmp_name'];
        $imgType = $_FILES['user_img']['type'];
        $imgSize = $_FILES['user_img']['size'];
        $imgError = $_FILES['user_img']['error'];
        $old_img = $_POST['old_img'];

        // Seperate extension and filename
        $imageTmpExt = explode('.', $imgName);
        $imageExt = strtolower(end($imageTmpExt));

        // Check if image type is an image
        if (checkImageType($imgType) !== false) {
            header("location: ../profile.php?error=ImageTypeDenied");
            exit();
        }

        // Check if image size is more than 2mb
        if (checkImageSize($imgSize) !== false) {
            header("location: ../profile.php?error=ImageTooLarge");
            exit();
        }

        // Check if image has an error
        if (checkImageError($imgError) !== false) {
            header("location: ../tsEdit.php?error=ImageError");
            exit();
        }

        // If all functions were passed then explode the image name and extension
        // Declare path and old pic name, and unlink/delete it from folder of images
        if (isset($old_img) && ($old_img != '')) {
            $path = "../userProfile/" . $old_img;
            if (!unlink($path)) {
                echo "You have an error deleting image";
            }
        }

        // Create a unique ID for the image
        // Upload the image to the folder
        $imageNewName = uniqid('', true) . "." . $imageExt;

        // Upload the image to upload folder (product_img)
        $img = 'IMG_' . $imageNewName;
        $folder = '../userProfile/';
        move_uploaded_file($imgTmpName, $folder . $img);

        $sql = "UPDATE epiz_33456032_ssms.users SET user_img='$img', date_last_modified=now(), modified_by='$uid' WHERE user_id=$user_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product updated successfully.');window.location.replace('../profile.php?m=failed');</script>";
            header("location: ../profile.php?&m=success");
        } else {
            echo $conn->error;
            echo "<script>alert('Error updating product.');window.location.replace('../profile.php?m=error');</script>";
        }
    } else {
        $img = $old_img;
        header("location: ../profile.php");
        exit();
    }
}

if (isset($_POST['delete-confirm-btn'])) {

    include 'config.inc.php';

    if (empty($_POST['user_id']) or empty($_POST['user_password'])) {
        header("location: ../profile.php?m=error");
        exit();
    }

    if (!password_verify($_POST['user_password'], $_POST['user_password_correct'])) {
        header("location: ../profile.php?m=wrongpassword");
        exit();
    }

    $id = $_POST['user_id'];
    $pw = $_POST['user_password'];
    $sql = "UPDATE epiz_33456032_ssms.users SET user_status='inactive' WHERE user_id=$id";
    if ($conn->query($sql) === TRUE) {
        header("location: ../login.php");
        exit();
    } else {
        // header("location: ../profile.php?m=error");
        // exit();
        echo $conn->error;
    }
}
