<?php

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
    $ty = "member";

    // query
    $sql = "INSERT INTO website.member (first_name, last_name, email, password, type, created_at)
VALUES ('$fn', '$ln', '$em', '$pw', '$ty', now())";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        alert("Sign up success");
        window.location.replace("../index.php");
        </script>';
        exit();
    } else {
        echo '<script>
        alert("Something went wrong.");
        window.location.replace("../signUp.php");
        </script>';
        exit();
    }
}
