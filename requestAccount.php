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
        body {
            padding-top: 200px !important;
        }
    </style>
</head>

<body class="mt-5 mb-5">
    <div class="container">
        <div class="row px-3 py-5">
            <div class="col-lg-6 col-xl-6 card flex-row mx-auto px-0">
                <!-- <div class="img-left d-none d-md-flex"></div> -->
                <div class="card-body">
                    <h4 class="title text-center">
                        S.S.M.S Request Account
                    </h4>
                    <form class="form-box px-3" action="includes/requestAccount.inc.php" method="post">

                        <!-- error message here -->
                        <?php
                        $message = '';
                        if (isset($_GET['m'])) {
                            if ($_GET['m'] == 'emptyFields') {
                                $message = 'Fill up all fields';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'wrongPassword') {
                                $message = 'Wrong password';
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
                            if ($_GET['m'] == 'passwordNotMatch') {
                                $message = 'Password does not match';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'emailExist') {
                                $message = 'Email already exists';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'requestSuccess') {
                                $message = 'Request success';
                                echo '<p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>';
                            }
                            if ($_GET['m'] == 'requestFailed') {
                                $message = 'Request failed';
                                echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                            }
                        }
                        ?>


                        <label for="user_firstname">First Name</label>
                        <div class="form-input">
                            <span><i class="fa-regular fa-address-card"></i></span>
                            <input type="text" name="user_firstname" id="user_firstname">
                        </div>

                        <label for="user_lastname">Last Name</label>
                        <div class="form-input">
                            <span><i class="fa-regular fa-address-card"></i></span>
                            <input type="text" name="user_lastname" id="user_lastname">
                        </div>

                        <label for="email">Email Address</label>
                        <div class="form-input">
                            <span><i class="fa fa-envelope-o"></i></span>
                            <input type="email" name="email" id="email">
                        </div>

                        <label for="password">Password</label>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" id="password" name="password">
                        </div>

                        <label for="confirmPassword">Confirm Password</label>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" id="confirmPassword" name="confirmPassword">
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="toggle-password" name="" onclick="showHidePassword()">
                                <label id="label-toggle" class="custom-control-label" for="toggle-password">Show password</label>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-around">
                            <button name="request-btn" id="request-btn" type="submit" class="m-1 btn btn-block text-uppercase">
                                Request
                            </button>
                        </div>
                        <div class="d-flex d-flex justify-content-center">
                            <a href="login.php" class="forget-link text-center m-auto">
                                Back
                            </a>
                        </div>
                        <!-- 
                        <div class="d-flex justify-content-between">
                            <a href="#" class="forget-link">
                                Request an account
                            </a>
                        </div> -->


                </div>


                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        function showHidePassword() {
            var x = document.getElementById("password");
            var x2 = document.getElementById("confirmPassword");
            var y = document.getElementById("label-toggle");
            if (x.type === "password" || x2.type === "password") {
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