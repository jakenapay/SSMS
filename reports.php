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
// if ((isset($_SESSION['ct']) and ($_SESSION['ct']) == 'user')) {
//     header("location: history.php");
//     exit();
// }

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

    <title>Reports</title>

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

    <!-- add report tech modal -->
    <div class="modal fade" id="viewModalTechnology" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report Technology Supply</h5>
                    <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/reports.inc.php" method="post">
                    <div class="modal-body">
                        <div class="report">
                            <div class="form-group my-2">

                                <!-- technology supply -->
                                <label for="item">Technology Supplies</label><br>
                                <select class="form-select" id="ts_item" name="ts_item" aria-label="Default select example" required>
                                    <option selected>Select</option>
                                    <?php
                                    include 'includes/config.inc.php';
                                    $sql = "SELECT ts_id as t_id, ts_name as t_item FROM epiz_33456032_ssms.technology_supplies";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $row['t_id']; ?>"><?php echo $row['t_item']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td></tr>';
                                    }

                                    ?>

                                </select>
                            </div>

                            <!-- description -->
                            <div class="form-group my-2">
                                <label for="report_description">Message</label>
                                <textarea class="form-control" name="report_description" id="report_description" required></textarea>
                            </div>

                            <!-- hidden -->
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-default px-2" name="report-tech-btn" value="Report">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- add report office modal -->
    <div class="modal fade" id="viewModaloffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report Office Supply</h5>
                    <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/reports.inc.php" method="post">
                    <div class="modal-body">
                        <div class="report">
                            <div class="form-group my-2">

                                <!-- Office supply -->
                                <label for="os_item">Office Supplies</label><br>
                                <select class="form-select" id="os_item" name="os_item" aria-label="Default select example" required>
                                    <option selected>Select</option>
                                    <?php
                                    include 'includes/config.inc.php';
                                    $sql = "SELECT os_id as os_id, os_name as os_item FROM epiz_33456032_ssms.office_supplies";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $row['os_id']; ?>"><?php echo $row['os_item']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td>No data found</td></tr>';
                                    }

                                    ?>

                                </select>
                            </div>

                            <!-- description -->
                            <div class="form-group my-2">
                                <label for="report_description">Message</label>
                                <textarea class="form-control" name="report_description" id="report_description" required></textarea>
                            </div>

                            <!-- hidden -->
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-default px-2" name="report-office-btn" value="Report">
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
                        <span class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-bug icon"></i>
                            <p class="header-title text">Reports</p>
                        </span>
                        <div>
                            <button class="btn btn-default py-1 my-1" data-bs-toggle="modal" data-bs-target="#viewModalTechnology">Report Technology Supply</button>
                            <button class="btn btn-default py-1 my-1" data-bs-toggle="modal" data-bs-target="#viewModaloffice">Report Office Supply</button>
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
                if ($_GET['m'] == 'noid') {
                    $message = 'Something went wrong';
                    echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                    <p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>
                                    </div>
                                </div>';
                }
                if ($_GET['m'] == 'success') {
                    $message = 'Report success';
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
                    <div class="table-responsive">
                        <h5>Reports</h5>
                        <hr class="my-3">
                        <table class="table table-hover">
                            <thead>
                                <tr class="pt-5">
                                    <th scope="col">Report ID</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Reported By</th>
                                    <th scope="col">Date Reported</th>
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
                                        . "    r.report_id as Id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                        . "    r.report_description AS Description, \n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                        . "    r.report_date AS Date\n"
                                        . "FROM epiz_33456032_ssms.reports r\n"
                                        . "LEFT JOIN epiz_33456032_ssms.office_supplies os ON r.os_id = os.os_id\n"
                                        . "LEFT JOIN epiz_33456032_ssms.technology_supplies ts ON r.ts_id = ts.ts_id\n"
                                        . "LEFT JOIN epiz_33456032_ssms.users u ON r.report_by = u.user_id\n"
                                        . "WHERE r.report_by=" . $_SESSION['id'] . "\n"
                                        . "ORDER BY r.report_date DESC;";
                                } else {
                                    $sql = "SELECT \n"
                                        . "    r.report_id as Id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                        . "    r.report_description AS Description, \n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                        . "    r.report_date AS Date\n"
                                        . "FROM epiz_33456032_ssms.reports r\n"
                                        . "LEFT JOIN epiz_33456032_ssms.office_supplies os ON r.os_id = os.os_id\n"
                                        . "LEFT JOIN epiz_33456032_ssms.technology_supplies ts ON r.ts_id = ts.ts_id\n"
                                        . "LEFT JOIN epiz_33456032_ssms.users u ON r.report_by = u.user_id\n"
                                        . "ORDER BY r.report_date DESC;";
                                }
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['Id'];
                                        $item = $row['Item'];
                                        $des = $row['Description'];
                                        $user = $row['User'];
                                        $date = $row['Date'];

                                ?>
                                        <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $item; ?></td>
                                            <td><?php echo $des; ?></td>
                                            <td><?php echo $user; ?></td>
                                            <td><?php echo $date; ?></td>


                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<td>No data found</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>';
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