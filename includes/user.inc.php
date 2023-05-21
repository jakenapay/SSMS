<?php
//library to use phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// view users account
if (isset($_POST['check_view'])) {

    // get the technology supply id
    $user_id = $_POST['user_id'];

    include 'config.inc.php';

    $result = $conn->query("SELECT u.user_id, u.user_firstname, u.user_lastname, u.user_email, u.user_img, u.user_category, u.user_status, u.user_date, u.date_last_modified, us.modified_by as Modified_by FROM `users` as u INNER JOIN `users` as us ON u.user_id=us.user_id WHERE u.user_id=$user_id");
    // Check if the query was successful
    if ($result) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            // Process each row and generate the HTML content
            $user_id = $row['user_id'];
            $fn = $row['user_firstname'];
            $ln = $row['user_lastname'];
            $em = $row['user_email'];
            $old_img = $row['user_img'];
            $cat = $row['user_category'];
            $stat = $row['user_status'];
            $date = $row['user_date'];
            $dlm = $row['date_last_modified'];
            $by = $row['Modified_by'];

            echo $return = '
                <div class="row">
                    <div class="col-md-12 pt-4 pb-5 d-flex justify-content-center">
                        <img src="userProfile/' . $old_img . '" alt="" class="img-fluid" style="width: 300px;">
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_id">User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="' . $user_id . '" disabled>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="' . $user_id . '">
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_firstname">First Name</label>
                        <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="' . $fn . '" >
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_lastname">Last Name</label>
                        <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="' . $ln . '" >
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_email">Email</label>
                        <input type="text" class="form-control" id="user_email" name="user_email" value="' . $em . '" >
                    </div>  
                    <div class="col-md-6 pt-3 pb-1">
                        <label for="user_category">Category</label>
                        <select class="user_category" id="user_category" name="user_category">
                            <option value="admin"' . ($cat == 'admin' ? "selected" : "") . '>Admin</option>
                            <option value="user"' . ($cat == 'user' ? "selected" : "") . '>User</option>
                        </select>
                    </div> 
                    <div class="col-md-6 pt-3 pb-1">
                        <label for="user_status">Status</label>
                        <select class="user_status" id="user_status" name="user_status">
                            <option value="active"' . ($stat == 'active' ? "selected" : "") . '>Active</option>
                            <option value="inactive"' . ($stat == 'inactive' ? "selected" : "") . '>Inactive</option>
                        </select>
                    </div>

                    <div class="w-100 my-2">
                        <hr
                    </div>
                      <div class="col-md-12 pt-1 pb-1">
                        <label for="user_date">Date Created</label>
                        <input type="text" class="form-control" id="user_date" name="user_date" value="' . $date . '" disabled>
                        <input type="hidden" class="form-control" id="user_date" name="user_date" value="' . $date . '" >
                    </div>
                    <div class="col-md-12 pt-1 pb-1">
                        <label for="date_last_modified">Last Modified</label>
                        <input type="text" class="form-control" id="date_last_modified" name="date_last_modified" value="' . $dlm . '" disabled>
                        <input type="hidden" class="form-control" id="date_last_modified" name="date_last_modified" value="' . $dlm . '" >
                    </div>  
                    <div class="col-md-12 pt-1 pb-1">
                        <label for="modified_by">Modified By</label>
                        <input type="text" class="form-control" id="modified_by" name="modified_by" value="' . $by . '" disabled>
                        <input type="hidden" class="form-control" id="modified_by" name="modified_by" value="' . $by . '" >
                    </div>  

                    <div class="w-100 my-2">
                        <hr
                    </div>
                    <div class="col-12">
                        <label><strong>Send an email</strong></label>
                    </div>
                    <div class="col-md-12 pt-1 pb-1">
                        <label for="receiver_email">Receiver Email:</label>
                        <input type="text" class="form-control" id="receiver_email" name="receiver_email" value="' . $em . '" readonly>
                    </div>  
                    <div class="col-md-12 pt-1 pb-1">
                        <label for="subject_email">Subject:</label>
                        <input type="text" class="form-control" id="subject_email" name="subject_email">
                    </div>  
                    <div class="col-md-12 pt-1 pb-1">
                        <label for="message_email">Message:</label>
                        <textarea type="text" class="form-control" id="message_email" name="message_email"></textarea>
                    </div>
                     <input type="submit" class="btn btn-default px-2 my-2" name="send_email" value="Send Email">
                </div>

                
            ';
        }
    } else {
        echo '<h5>' . $conn->error . '</h5>';
    }
}

if (isset($_POST['user_btn_update'])) {

    // test
    // echo '<script>alert("hi");</script>';

    // includes to run database and functions
    include 'config.inc.php';
    include 'functions.inc.php';

    // check if empty user id
    if (empty($_POST['user_id']) and (empty($_POST['uid']))) {
        header("location: ../profile.php?m=noid");
        exit();
    }

    // get user info
    $uid = $_POST['uid'];
    $user_id = $_POST['user_id'];
    $fn = $_POST['user_firstname'];
    $ln = $_POST['user_lastname'];
    $em = $_POST['user_email'];
    $cat = $_POST['user_category'];
    $stat = $_POST['user_status'];
    $date = $_POST['user_date'];
    $by = $_POST['modified_by'];
    $dlm = $_POST['date_last_modified'];

    $sql = "UPDATE users SET user_id='$user_id', user_firstname='$fn', user_lastname='$ln', user_email='$em', user_category='$cat', user_status='$stat', user_date='$date',date_last_modified=now(), modified_by=$uid WHERE user_id=$user_id";
    if ($conn->query($sql) === TRUE) {
        header("location: ../profile.php?m=success");
    } else {
        echo $conn->error;
        echo "<script>alert('Error updating product.');window.location.replace('../restocks.php?m=error');</script>";
    }
}

if (isset($_POST['send_email'])) {

    // test
    // echo '<script>alert("hi");</script>';

    // includes to run database and functions
    include 'config.inc.php';
    include 'functions.inc.php';

    // check if empty user id
    if (empty($_POST['user_id']) and (empty($_POST['uid']))) {
        header("location: ../profile.php?m=noid");
        exit();
    }

    $msg = $_POST['message_email'];
    $subj = $_POST['subject_email'];
    $receiver = $_POST['receiver_email'];

    $uid = $_POST['uid'];
    $user_id = $_POST['user_id'];

    require("../phpmailer/src/Exception.php");
    require("../phpmailer/src/PHPMailer.php");
    require("../phpmailer/src/SMTP.php");

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

    header("location: ../profile.php?m=success");
    exit();
}
