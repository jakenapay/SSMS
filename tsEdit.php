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
    header("location: stocks.php");
    exit();
}

// if there is an edit id then you can go to this website
if (isset($_GET['eid']) and ($_GET['eid']) != '') {
    require 'includes/config.inc.php';
    require 'includes/functions.inc.php';

    $id = $_GET['eid'];
    $result = $conn->query("SELECT *, CONCAT(ssms.users.user_firstname, ' ', ssms.users.user_lastname) as fullname FROM ssms.technology_supplies INNER JOIN ssms.users ON ssms.technology_supplies.modified_by=ssms.users.user_id WHERE ts_id = $id LIMIT 1");
    // Check if the query was successful
    if ($result) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            // Process each row and generate the HTML content
            $tsid = $row['ts_id'];
            $name = $row['ts_name'];
            $model = $row['ts_model'];
            $brand = $row['ts_brand'];
            $cat = $row['ts_category'];
            $qty = $row['ts_quantity'];
            $loc = $row['ts_location'];
            $img = $row['ts_img'];
            $da = $row['date_added'];
            $dlm = $row['date_last_modified'];
            $by = $row['fullname'];
        }
    }
} else {
    header("location: technologySupplies.php");
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

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>SSMS</title>

</head>

<body>
    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>

    <section class="home">
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="header-content">
                            <span class="d-flex justify-content-start align-items-center">
                                <i class="fa-solid fa-computer icon"></i>
                                <p class="header-title text">Edit Technology Supplies</p>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-7">
                    <div class="box-content">
                        <form method="POST" action="includes/ts.inc.php" enctype="multipart/form-data">
                            <div class="row">

                                <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['id']; ?>">

                                <div class="col-md-3 pb-3">
                                    <label for="">Id</label>
                                    <input id="ts_id" name="ts_id" type="text" class="form-control" placeholder="Id" value="<?php echo $tsid; ?>" disabled>
                                </div>
                                <div class="col-md-5 pb-3">
                                    <label for="ts_name">Name</label>
                                    <input id="ts_name" name="ts_name" type="text" class="form-control" placeholder="Enter Name" value="<?php echo $name; ?>">
                                </div>
                                <div class="col-md-4 pb-3">
                                    <label for="ts_model">Model</label>
                                    <input id="ts_model" name="ts_model" type="text" class="form-control" placeholder="Model" value="<?php echo $model; ?>">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="ts_model">Brand</label>
                                    <input id="ts_brand" name="ts_brand" type="text" class="form-control" placeholder="Brand" value="<?php echo $brand; ?>">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="ts_category">Category</label>
                                    <input id="ts_category" name="ts_category" type="text" class="form-control" placeholder="Category" value="<?php echo $cat; ?>">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="ts_quantity">Quantity (<a href="#">Restock here</a>)</label>
                                    <input id="ts_quantity" name="ts_quantity" type="number" class="form-control" placeholder="Quantity" value="<?php echo $qty; ?>" disabled>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="ts_location">Location</label>
                                    <input id="ts_location" name="ts_location" type="text" class="form-control" placeholder="Location" value="<?php echo $loc; ?>">
                                </div>
                                <div class="w-100 pb-3">
                                    <hr>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="date_added">Date Added</label>
                                    <input id="date_added" name="date_added" type="text" class="form-control" placeholder="Date Added" value="<?php echo $da; ?>" disabled>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="date_last_modified">Last Modified</label>
                                    <input id="date_last_modified" name="date_last_modified" type="text" class="form-control" placeholder="Last Modified" value="<?php echo $dlm; ?>" disabled>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="modified_by">Modified by</label>
                                    <input id="modified_by" name="modified_by" type="text" class="form-control" placeholder="Modified by" value="<?php echo $by; ?>" disabled>
                                </div>
                                <div class="w-100 pb-3">
                                    <hr>
                                </div>
                                <div class="form-input d-flex justify-content-between align-items-center px-4">
                                    <a href="technologySupplies.php">Back</a>
                                    <input name="save-changes" id="save-changes" type="submit" value="Save Changes" />
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-5">
                    <div class="box-content">
                        <div class="col-md-12 pt-4 pb-4 d-flex justify-content-center flex-column align-items-center">
                            <img src="logo-wo-name.png" alt="" class="img-fluid pb-5" style="width: 300px;">
                            <input type="file" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>