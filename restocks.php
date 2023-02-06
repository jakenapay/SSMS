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
    header("location: history.php");
    exit();
}

include 'includes/user.inc.php';
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
    <link rel="stylesheet" href="assets/css/profile.css?v=<?php echo time(); ?>">

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

    <!-- View Modal for technology supplies -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restock Technology Supply</h5>
                    <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/restock.inc.php" method="post">
                    <div class="modal-body">
                        <div class="restock_supplies">
                            <div class="form-group my-2">
                                <label for="restock_item">Technology Supply</label><br>
                                <select class="form-select" id="restock_item" name="restock_item" aria-label="Default select example" required>
                                    <option selected>Select</option>
                                    <?php
                                    include 'includes/config.inc.php';
                                    $sql = "SELECT ts_id as id, ts_quantity as quantity, CONCAT(ts_name, ' ', ts_model) as item, ts_location as location FROM ssms.technology_supplies WHERE ts_quantity <= 5";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['item']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td></tr>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group my-2">
                                <label for="restock_quantity">Quantity (0-100)</label>
                                <input class="form-control" type="number" min="0" max="100" name="restock_quantity" id="restock_quantity" required>
                            </div>

                            <!-- hidden -->
                            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-default px-2" name="restock-btn" value="Restock">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal for technology supplies -->
    <div class="modal fade" id="viewModalOffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restock Office Supply</h5>
                    <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/restock.inc.php" method="post">
                    <div class="modal-body">
                        <div class="restock_supplies">
                            <div class="form-group my-2">
                                <label for="restock_item">Office Supply</label><br>
                                <select class="form-select" id="restock_item" name="restock_item" aria-label="Default select example" required>
                                    <option selected>Select</option>
                                    <?php
                                    include 'includes/config.inc.php';
                                    $sql = "SELECT os_id as id, os_quantity as quantity, CONCAT(os_name, ' ', os_brand) as item, os_location as location FROM ssms.office_supplies WHERE os_quantity <= 5";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['item']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td></tr>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group my-2">
                                <label for="restock_quantity">Quantity (0-100)</label>
                                <input class="form-control" type="number" min="0" max="100" name="restock_quantity" id="restock_quantity" required>
                            </div>

                            <!-- hidden -->
                            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-default px-2" name="restock-btn-office" value="Restock">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>

    <section class="home">
        <div class="container mt-3 mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="header">
                    <div class="header-content">
                        <p class="header-title text">Restocks</p>
                        <div>
                            <button class="btn btn-default py-1 my-1" data-bs-toggle="modal" data-bs-target="#viewModal">Restock Technology Supply</button>
                            <button class="btn btn-default py-1 my-1" data-bs-toggle="modal" data-bs-target="#viewModalOffice">Restock Office Supply</button>
                        </div>
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
                    $message = 'Error Occured';
                    echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                }
                if ($_GET['m'] == 'success') {
                    $message = 'Technology Supply Updated';
                    echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                        <p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>
                                    </div>
                                </div>';
                }
            }
            ?>

            <!-- Recent History -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="large-content">
                    <!-- <span class="d-flex justify-content-between">
                        <h3 class="amount"><strong>Recent history</strong></h3>
                    </span> 
                    <hr> -->
                    <div class="table-responsive">
                        <h5>Latest Restocks</h5>
                        <hr class="my-3">
                        <table class="table table-hover">
                            <thead>
                                <tr class="pt-5">
                                    <th scope="col">Restock ID</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Date</th>
                                    <!-- <th scope="col">View</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'includes/config.inc.php';
                                // Checks if its a user or admin; if user then go to stocks page
                                // Only admin can go to index page or dashboard
                                if ((isset($_SESSION['ct']) and ($_SESSION['ct']) == 'user')) {
                                    $sql = "SELECT \n"
                                        . "    r.restock_id as Id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                        . "    r.restock_quantity AS Quantity, \n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                        . "    r.restock_date AS Date\n"
                                        . "FROM ssms.restocks r\n"
                                        . "LEFT JOIN ssms.office_supplies os ON r.os_id = os.os_id\n"
                                        . "LEFT JOIN ssms.technology_supplies ts ON r.ts_id = ts.ts_id\n"
                                        . "LEFT JOIN ssms.users u ON r.user_id = u.user_id\n"
                                        . "WHERE u.user_id=" . $id . "\n"
                                        . "ORDER BY r.restock_date DESC;";
                                } else {
                                    $sql = "SELECT \n"
                                        . "    r.restock_id as Id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                        . "    r.restock_quantity AS Quantity, \n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                        . "    r.restock_date AS Date\n"
                                        . "FROM ssms.restocks r\n"
                                        . "LEFT JOIN ssms.office_supplies os ON r.os_id = os.os_id\n"
                                        . "LEFT JOIN ssms.technology_supplies ts ON r.ts_id = ts.ts_id\n"
                                        . "LEFT JOIN ssms.users u ON r.user_id = u.user_id\n"
                                        . "ORDER BY r.restock_date DESC;";
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