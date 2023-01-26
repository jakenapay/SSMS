<?php

// for login
function checkEmpty($em, $pw)
{
    $result = true;
    if (empty($em) || empty($pw)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// for signup 
function checkEmptyRequest($em, $pw, $fn, $ln, $pw2)
{
    $result = true;
    if (empty($em) || empty($pw) || empty($fn) || empty($ln) || empty($pw2)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function passwordMatch($pw, $pw2)
{
    $result = true;
    // 123 != 123 = false
    if ($pw != $pw2) {
        $result = true;
        // password does not match
    } else {
        $result = false;
    }

    return $result;
}

// checking if username is invalid
function invalidUsername($em)
{
    $result = true;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $em)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function checkEmailExist($conn, $em)
{
    $sql = "SELECT * FROM ssms.users WHERE user_email='$em'";
    $sql_result = $conn->query($sql);

    if ($sql_result->num_rows > 0) {
        $result = true;
        return $result;
    } else {
        $result = false;
        return $result;
    }
}


function login($conn, $em, $pw)
{

    $sql = "SELECT * FROM ssms.users WHERE user_email='$em' LIMIT 1";
    $sql_result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sql_result) > 0) {
        while ($row = mysqli_fetch_assoc($sql_result)) {
            if (password_verify($pw, $row['user_password'])) {
                session_start();
                $_SESSION["id"] = $row['user_id'];
                $_SESSION['fn'] = $row['user_firstname'];
                $_SESSION['ln'] = $row['user_lastname'];
                $_SESSION['em'] = $row['user_email'];
                $_SESSION['ct'] = $row['user_category'];
                $_SESSION['st'] = $row['user_status'];

                // active !== active = false; go to else
                // inactive !== active = true; run the inside code
                // and check if admin or not
                if ($row['user_status'] == 'active') {
                    // admin != admin = false; go to else
                    // user != admin = true; you're user only
                    if ($row['user_category'] !== 'admin') {
                        header("location: ../stocks.php");
                        exit();
                    } else {
                        header("location: ../index.php");
                        exit();
                    }
                } else {
                    // Account is inactive
                    header("location: ../login.php?m=inactiveAccount");
                    exit();
                }
            } else {
                // Wrong password 
                header("location: ../login.php?m=wrongPassword");
                exit();
            }
        }
    } else {
        // No results found
        header("location: ../login.php?m=userNotFound");
        exit();
    }
}



// checking if email is invalid
function invalidEmail($em)
{
    $result = true;
    if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}



function signUp($conn, $fn, $ln, $em, $pw)
{
    // hash by md5
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $category = "user";
    $status = "inactive";

    // query
    $sql = "INSERT INTO ssms.users (user_firstname, user_lastname, user_password, user_email, user_category, user_status, user_date)
VALUES ('$fn', '$ln', '$pw', '$em', '$category', '$status', now())";

    if ($conn->query($sql) === TRUE) {
        header("location: ../requestAccount.php?m=requestSuccess");
        exit();
    } else {
        header("location: ../requestAccount.php?m=requestFailed");
        exit();
    }
}



function checkImageSize($image_size)
{
    $result = true;
    if ($image_size > 2000000) {
        // Error
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkImageError($image_error)
{
    $result = true;
    if ($image_error !== 0) {
        // Error
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkImageType($image_ext)
{
    $result = true;
    $ext = array('jpg', 'jpeg', 'png', 'pdf');
    if (in_array($image_ext, $ext)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkEmptyInput($name, $model, $brand, $cat, $loc, $dlm, $by)
{
    $result = true;
    if (
        empty($name) || empty($model) || empty($brand) || empty($cat) || empty($loc)
        || empty($dlm) || empty($by)
    ) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
