<?php
session_start();
// Check if there's an id, if it has, then it's logged in
// If there's no id, head back to login page
if (!isset($_SESSION['id']) and ($_SESSION['id'] == '')) {
    header("location: login.php");
    exit();
}

// Checks if its a user or admin; if user then go to stocks page
// Only admin can go to index page or dashboard
if ((isset($_SESSION['ct']) and ($_SESSION['ct']) == 'user')) {
    header("location: index.php");
    exit();
}

// if there is an edit id then you can go to this website
if (isset($_GET['eid']) and ($_GET['eid']) != '') {
    require 'includes/config.inc.php';
    require 'includes/functions.inc.php';

    $id = $_GET['eid'];
    $result = $conn->query("SELECT id, tor_id as 'TOR ID', CONCAT(u.user_firstname, ' ', u.user_lastname) as 'fullname', tor_date as 'Date', t.date_last_modified as 'Last Modified', CONCAT(m.user_firstname, ' ', m.user_lastname) as 'Modified by' FROM tor t INNER JOIN users u ON t.tor_user=u.user_id INNER JOIN users m ON t.modified_by=m.user_id WHERE id=$id LIMIT 1;");
    // Check if the query was successful
    if ($result) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            // Process each row and generate the HTML content
            $tid = $row['id'];
            $tor_id = $row['TOR ID'];
            $tor_user = $row['fullname'];
            $tor_date = $row['Date'];
            $tdlm = $row['Last Modified'];
            $mby = $row['Modified by'];
        }
    }
} else {
    header("location: officeSupplies.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style1.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/history.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/ts.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/updateSupply.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/profile.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="logo.png">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Edit TOR</title>

</head>

<body>
    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>

    <section class="home">
        <div class="container mt-3 mb-3">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="header-content">
                            <span class="d-flex justify-content-between align-items-center">
                            <i class="fa-solid fa-file-lines icon"></i>
                                <p class="header-title text">Edit Transcript of Record</p>
                            </span>
                        </div>
                    </div>
                </div>


                <!-- error message here -->
                <?php
                $message = '';
                if (isset($_GET['m'])) {
                    if ($_GET['m'] == 'emptyFields') {
                        $message = 'Fill up all fields';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'error') {
                        $message = 'Error occured';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'uploadError') {
                        $message = 'Error adding supply';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'ImageError') {
                        $message = 'Image has an error';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'noimg') {
                        $message = 'No image';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'ImageTypeDenied') {
                        $message = 'Image type is denied';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'ImageTooLarge') {
                        $message = 'Image is too large';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'noid') {
                        $message = 'Something went wrong';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'noquantityleft') {
                        $message = 'Insufficient stock will be left, please get a sufficient quantity only';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'nogetquantity') {
                        $message = 'Enter how many supply you will take';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'insufficientStock') {
                        $message = 'Insufficient stock will be left, please get a sufficient quantity only';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'success') {
                        $message = 'Office supply updated';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                        <p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'enablingSuccess') {
                        $message = 'Office supply updated';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                        <p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                    if ($_GET['m'] == 'disablingSuccess') {
                        $message = 'Office supply updated';
                        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                        <p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>
                                    </div>
                                </div>';
                    }
                }
                ?>



                <div class="col-12 col-sm-6 col-md-6 col-lg-7">
                    <div class="box-content">
                        <form method="POST" action="includes/tor.inc.php">
                            <h3 class="header-title text text-center">Details</h3><br>
                            <div class="row">
                                <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['id']; ?>">

                                <div class="col-md-4 pb-3">
                                    <label for="tor_id">TOR ID</label>
                                    <input id="tor_id" name="tor_id" type="hidden" class="form-control" placeholder="Id" value="<?php echo $tor_id; ?>">
                                    <p class="pt-2 pb-1 px-2 border rounded align-items-center"><?php echo $tor_id; ?></p>
                                </div>
                                <div class="col-md-8 pb-3">
                                    <label for="tor_user">Assigned To</label>
                                    <!-- <input id="tor_user" name="tor_user" type="text" class="form-control" placeholder="" value="<?php echo $tor_user; ?>"> -->
                                    <select class="form-control" name="tor_user" id="tor_user">
                                        <option value="<?php echo $tor_user; ?>" selected><?php echo $tor_user; ?></option>
                                        <?php
                                            $sql = "SELECT user_id, CONCAT(user_firstname, ' ', user_lastname) as 'user_fullname' FROM users";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $tor_user_id = $row['user_id'];
                                                    $name = $row['user_fullname']; ?>
                                                    <option value="<?php echo $tor_user_id; ?>"><?php echo $name; ?></option>
                                        <?php
                                                }
                                            } else {
                                                echo "No users found";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <!-- <div class="col-md-6 pb-3"> -->
                                    <!-- <label for="tid">tid</label> -->
                                    <input id="tid" name="tid" type="hidden" class="form-control" placeholder="tid" value="<?php echo $tid; ?>">
                                <!-- </div> -->
                                
                                <div class="w-100 pb-3">
                                    <hr>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="tor_date">Date and Time Added</label>
                                    <input id="tor_date" name="tor_date" type="hidden" class="form-control" placeholder="Date Added" value="<?php echo $tor_date; ?>">
                                    <p class="pt-2 pb-1 px-2 border rounded align-items-center"><?php echo $tor_date; ?></p>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="tdlm">Last Modified</label>
                                    <input id="tdlm" name="tdlm" type="hidden" class="form-control" placeholder="Last Modified" value="<?php echo $tdlm; ?>">
                                    <p class="pt-2 pb-1 px-2 border rounded align-items-center"><?php echo $tdlm; ?></p>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="mby">Modified by</label>
                                    <input id="mby" name="mby" type="hidden" class="form-control" placeholder="Modified by" value="<?php echo $mby; ?>">
                                    <p class="pt-2 pb-1 px-2 border rounded align-items-center"><?php echo $mby; ?></p>
                                </div>
                                <div class="w-100 pb-3">
                                    <hr>
                                </div>
                                <div class="form-input d-flex justify-content-between align-items-center px-4">
                                    <a href="tor.php">Back</a>
                                    <input class="submit-btn" name="save-changes" id="save-changes" type="submit" value="Save Changes" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");


        sidebar.addEventListener("mouseout", () => {
            sidebar.classList.toggle("close");
        })

        sidebar.addEventListener("mouseover", () => {
            sidebar.classList.remove("close");
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>

</html>