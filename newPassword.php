<?php
include 'includes/config.inc.php';

if (!isset($_GET['email'])) {
    header("location: sendToEmail.php");
    exit();
}

if (isset($_POST['enter-pass-btn'])) {

    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $email = $_GET['email'];
    $code = $_GET['code'];

    // check if empty user email
    if (empty($_POST['p1']) or empty($_POST['p2']) or empty($_GET['code'])) {
        header("location: newPassword.php?email=$email&code=$code&m=emptyFields");
        exit();
    }


    // compare if pw match
    if ($p1 != $p2) {
        header("location: newPassword.php?email=$email&code=$code&m=pwnotmatch");
        exit();
    }

    // hash the pw and update the user's password
    $p1 = password_hash($p1, PASSWORD_DEFAULT);
    $sql = $conn->query("UPDATE ssms.users SET user_password='$p1' WHERE user_email='$email' AND code='$code'");
    if (!$sql) {
        // echo '<script>alert("' . $conn->error . '");</script>';
        header("location: newPassword.php?email=$email&code=$code&m=error");
        exit();
    }

    echo '<script>alert("Password changed successfully");</script>';
    header("location: login.php?m=passwordchanged");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSMS</title>

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="assets/css/profile.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- ajax -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <style>
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="cd">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-6 card">
                <!-- <div class="img-left d-none d-md-fledx"></div> -->
                <div class="card-body">
                    <h4 class="title text-center">
                        S.S.M.S | Enter Code
                    </h4>
                    <form class="form-box px-3" action="" method="post">

                        <!-- error message here -->
                        <?php
                        $message = '';
                        if (isset($_GET['m'])) {
                            if ($_GET['m'] == 'emptyFields') {
                                $message = 'Fill up all fields';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'pwnotmatch') {
                                $message = 'Password does not match';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'userNotFound') {
                                $message = 'Email does not exist';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'inactiveAccount') {
                                $message = 'Inactive account';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'entercode') {
                                $message = 'Please enter your code';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'emailExist') {
                                $message = 'Email already exists';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'success') {
                                $message = 'Password Change, you can now login';
                                echo '<p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'requestFailed') {
                                $message = 'Request failed';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                        }
                        ?>
                        <label for="p1">Enter new password</label>
                        <div class="form-input m-0">
                            <span><i class="fa-regular fa-keyboard"></i></span>
                            <input type="password" name="p1" id="p1" placeholder="Enter new password" minlength="8">
                        </div>
                        <label for="p2">Confirm new password</label>
                        <div class="form-input m-0">
                            <span><i class="fa-regular fa-keyboard"></i></span>
                            <input type="password" name="p2" id="p2" placeholder="Re-enter password" minlength="8">
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="toggle-password" name="" onclick="showHidePassword()">
                                <label id="label-toggle" class="custom-control-label" for="toggle-password">Show password</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button name="enter-pass-btn" id="enter-pass-btn" type="submit" class="btn btn-block text-uppercase">
                                Enter Code
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showHidePassword() {
            var x = document.getElementById("p1");
            var x2 = document.getElementById("p2");
            var y = document.getElementById("label-toggle");
            if (x.type === "password") {
                x.type = "text";
                x2.type = "text";
                y.innerHTML = "Hide Password";
            } else {
                x.type = "password";
                x2.type = "password";
                y.innerHTML = "Show Password";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>