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
            $('table').DataTable();
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


                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
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
                                        <th scope="col">Supply ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'includes/config.inc.php';
                                    // Checks if its a user or admin; if user then go to stocks page
                                    // Only admin can go to this page or dashboard
                                    $sql = "SELECT os_id as id, os_name as name, os_brand as brand, os_uom as uom, os_quantity as qty, os_location as loc, status, date_added as da, date_last_modified as dm FROM ssms.office_supplies WHERE os_quantity > 0";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $uom = $row['uom'];
                                            $brand = $row['brand'];
                                            $loc = $row['loc'];

                                            // for admins only to see
                                            $qty = $row['qty'];
                                            $stat = $row['status'];
                                            $da = $row['da'];
                                            $dm = $row['dm'];

                                    ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $uom; ?></td>
                                                <td><?php echo $user; ?></td>
                                                <td><?php echo $date; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td></tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent History -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
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
                                        <th scope="col">History ID</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'includes/config.inc.php';
                                    // Checks if its a user or admin; if user then go to stocks page
                                    // Only admin can go to index page or dashboard
                                    if ((isset($_SESSION['ct']) and ($_SESSION['ct']) == 'user')) {
                                        $sql = "SELECT \n"
                                            . "    h.history_id as Id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                            . "    h.history_quantity AS Quantity, \n"
                                            . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                            . "    h.history_date AS Date\n"
                                            . "FROM ssms.history h\n"
                                            . "LEFT JOIN ssms.office_supplies os ON h.os_id = os.os_id\n"
                                            . "LEFT JOIN ssms.technology_supplies ts ON h.ts_id = ts.ts_id\n"
                                            . "LEFT JOIN ssms.users u ON h.user_id = u.user_id\n"
                                            . "WHERE u.user_id=" . $id . "\n"
                                            . "ORDER BY h.history_date;";
                                    } else {
                                        $sql = "SELECT \n"
                                            . "    h.history_id as Id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                            . "    h.history_quantity AS Quantity, \n"
                                            . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                            . "    h.history_date AS Date\n"
                                            . "FROM ssms.history h\n"
                                            . "LEFT JOIN ssms.office_supplies os ON h.os_id = os.os_id\n"
                                            . "LEFT JOIN ssms.technology_supplies ts ON h.ts_id = ts.ts_id\n"
                                            . "LEFT JOIN ssms.users u ON h.user_id = u.user_id\n"
                                            . "ORDER BY h.history_date;";
                                        // $sql = "SELECT *, h.history_id as Id FROM `ssms`.`history` as h";
                                    }
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['Id'];
                                            $item = $row['Item'];
                                            $qty = $row['Quantity'];
                                            $user = $row['User'];
                                            $date = $row['Date'];

                                    ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $item; ?></td>
                                                <td><?php echo $qty; ?></td>
                                                <td><?php echo $user; ?></td>
                                                <td><?php echo $date; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td></tr>';
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