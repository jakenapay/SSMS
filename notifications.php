<?php
session_start();
// Check if there's an id, if it has, then it's logged in
// If there's no id, head back to login page
if (!isset($_SESSION['id']) and ($_SESSION['id'] == '')) {
    header("location: login.php");
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
    <link rel="icon" type="image/x-icon" href="logo.png">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>SSMS</title>

    <!-- jQuery Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('table').DataTable({
                scrollY: 200
            });
        });
    </script>

</head>

<body>
    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>
    <?php include 'includes/user.inc.php'; ?>

    <section class="home">
        <div class="container mt-3 mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="header">
                    <div class="header-content">
                        <p class="header-title text">Notifications <span class="text-muted">(Low Stocks)</span></p>
                    </div>
                </div>
            </div>

            <!-- Recent History -->
            <div class="row">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="large-content">
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-boxes-packing icon"></i>
                            <h5><a href="officeSupplies.php" title="Office Supplies">Office Supplies</a></h5>
                        </div>
                        <hr class="my-3">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="pt-5">
                                        <th scope="col">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Unit of Measure</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'includes/config.inc.php';
                                    // Checks if its a user or admin; if user then go to stocks page
                                    // Only admin can go to this page or dashboard
                                    $sql = "SELECT os_id as id, os_name as name, os_brand as brand, os_uom as uom, os_quantity as qty, os_location as loc, os_desc as des, status, date_added as da, date_last_modified as dm FROM office_supplies WHERE os_quantity < 5";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $uom = $row['uom'];
                                            $brand = $row['brand'];
                                            $loc = $row['loc'];

                                            $des = $row['des'];
                                            $qty = $row['qty'];
                                            $stat = $row['status'];
                                            $da = $row['da'];
                                            $dm = $row['dm'];

                                    ?>
                                            <tr>
                                                <!-- <td><?php echo $id; ?></td> -->
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $brand; ?></td>
                                                <td><?php echo $uom; ?></td>
                                                <td><?php echo $qty; ?></td>
                                                <td><?php echo $loc; ?></td>
                                                <td><?php echo $des; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent History -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="large-content">
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-computer icon"></i>
                            <h5><a href="technologySupplies.php" title="Technology Supplies">Technology Supplies</a></h5>
                        </div>

                        <hr class="my-3">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="pt-5">
                                        <!-- <th scope="col">History ID</th> -->
                                        <th scope="col">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'includes/config.inc.php';
                                    // Checks if its a user or admin; if user then go to stocks page
                                    // Only admin can go to index page or dashboard
                                    $sql = "SELECT ts_id as id, ts_name as name, ts_model as model, ts_brand as brand, ts_category as cat, ts_quantity as qty, ts_location as loc, status,ts_img as img, ts_desc as des, date_added as da, date_last_modified as dm FROM technology_supplies WHERE ts_quantity < 5";

                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            //     th scope="col">Name</th>
                                            // <th scope="col">Brand</th>
                                            // <th scope="col">Model</th>
                                            // <th scope="col">Quantity</th>
                                            // <th scope="col">Location</th>
                                            // <th scope="col">Description</th>
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $brand = $row['brand'];
                                            $model = $row['model'];
                                            $qty = $row['qty'];
                                            $loc = $row['loc'];
                                            $des = $row['des'];

                                    ?>
                                            <tr>
                                                <!-- <td><?php echo $id; ?></td> -->
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $brand; ?></td>
                                                <td><?php echo $model; ?></td>
                                                <td><?php echo $qty; ?></td>
                                                <td><?php echo $loc; ?></td>
                                                <td><?php echo $des; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td><td></td></<td></td><td></td><td></td><td></td><td></tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
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


        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>