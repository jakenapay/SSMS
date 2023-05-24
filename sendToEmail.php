<?php
include 'includes/config.inc.php';
//library to use phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send-code-btn'])) {

    // check if empty user email
    if (empty($_POST['email'])) {
        header("location: sendToEmail.php?m=emptyFields");
        exit();
    }

    // generate code
    function generateRandomString($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $code = generateRandomString($length = 4);
    $msg = "Your code is " . $code . ". Dont share your code to avoid unauthorized access.";
    $subj = "Your code to retrieve your account.";
    // email of the user
    $receiver = $_POST['email'];

    require("phpmailer/src/Exception.php");
    require("phpmailer/src/PHPMailer.php");
    require("phpmailer/src/SMTP.php");

    $mail = new PHPMailer(true); //to allow this Mailer

    $mail->isSMTP(); //send using Secure Message Transport Protocol
    $mail->Host = "smtp.gmail.com"; //google server

    $mail->SMTPAuth = true; //enable authentication

    $mail->Username = 'storagesupplyms@gmail.com';
    $mail->Password = 'aslhlcxjhijdizbm'; //google password

    $mail->SMTPSecure = "tls"; //tls (Transport Layer Security)
    $mail->Port = 587;

    $mail->From = "storagesupplyms@gmail.com"; //my gmail
    $mail->FromName = "Storage Suppy Management System Admin"; //sender name

    $mail->addAddress($receiver); //email reciever

    $mail->isHTML(true); //this line is to allow the html
    $mail->Subject    = $subj;
    $mail->Body    = $msg;
    $mail->send();

    $sql = "UPDATE users SET code='$code' WHERE user_email='$receiver'";
    if ($conn->query($sql) === FALSE) {
        //     $error = $conn->error;
        //     echo "<script>alert(" . $error . ");</script>";
        header("location: sendToEmail.php?m=error");
        exit();
    }


    header("location: enterCode.php?email=$receiver");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sender</title>

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
    <link rel="icon" type="image/x-icon" href="logo.png">

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
                        S.S.M.S Forgot Password
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
                        <label for="email">Enter your email address to receive a code.</label>
                        <div class="form-input">
                            <span><i class="fa fa-envelope-o"></i></span>
                            <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <button name="send-code-btn" id="send-code-btn" type="submit" class="btn btn-block text-uppercase">
                                Send Code
                            </button>
                        </div>
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