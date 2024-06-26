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
    <link rel="stylesheet" href="assets/css/ts.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/os.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/profile.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="logo.png">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Office Supplies</title>

    <!-- jQuery Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('table').DataTable({
                ordering: false
            });
        });
    </script>

</head>

<body>

    <!-- Add Modal for tor -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Transcript of Records</h5>
                    <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/tor.inc.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <!-- add name -->
                            <div class="col-md-12 pt-3 pb-1">
                                <label for="tor_id">TOR ID</label><br>
                                <input class="form-control" type="text" name="tor_id" id="tor_id" placeholder="TOR ID">
                            </div>

                            <!-- <div class="col-md-6 pt-3 pb-1"> -->
                                <!-- <label for="tor_user">Assigned To</label><br> -->
                                <input class="form-control" type="hidden" name="tor_user" id="tor_user" placeholder="Assigned To">
                            <!-- </div> -->

                            <!-- <div class="col-md-6 pt-3 pb-1"> -->
                                <!-- <label for="tor_date">TOR DATE</label><br> -->
                                <input class="form-control" type="hidden" name="tor_date" id="tor_date" placeholder="TOR DATE">
                            <!-- </div> -->
                            
                            <!-- <div class="col-md-6 pt-3 pb-1"> -->
                                <!-- <label for="tdlm">Date Last Modified</label> -->
                                <input class="form-control" type="hidden" name="tdlm" id="tdlm" placeholder="tdlm">
                            <!-- </div> -->
                            <!-- description -->
                            <!-- <div class="col-md-12 pt-3 pb-1"> -->
                                <!-- <label for="os_description">Modified by</label> -->
                                <input class="form-control" type="hidden" name="mby" id="mby" placeholder="Modified By">
                            <!-- </div> -->

                            <!-- hidden -->
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-default px-2" name="add-tor-btn" value="Add TOR">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Navigational sidebar -->
    <?php include 'nav.php';
    include 'includes/config.inc.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE user_id=$id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['user_id'];
            $fn = $row['user_firstname'];
            $ln = $row['user_lastname'];
            $em = $row['user_email'];
            $old_img = $row['user_img'];
            $ct = $row['user_category'];
            $st = $row['user_status'];
        }
    } else {
        echo "0 results";
    } ?>

    <section class="home">
        <div class="container mt-3 mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="header">
                    <div class="header-content">
                        <span class="d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-file-lines icon"></i>
                            <p class="header-title text">Transcript of Records</p>
                        </span>
                        <?php
                        if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                            <div>
                                <button class="btn btn-default py-1 px-2 my-1" data-bs-toggle="modal" data-bs-target="#addModal">Add Transcript of Records</button>
                            </div>
                        <?php } ?>
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
                if ($_GET['m'] == 'addSuccess') {
                    $message = 'Supply Added';
                    echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-content d-block">
                                        <p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>
                                    </div>
                                </div>';
                }
                if ($_GET['m'] == 'getSuccess') {
                    $message = 'Supply requested successfully';
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

            <!-- Recent History -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="large-content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="pt-5">
                                    <th scope="col">ID</th>
                                    <th scope="col">TOR ID</th>
                                    <th scope="col">In Charge</th>
                                    <?php
                                        if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                    <th scope="col">Date</th>
                                    <?php } ?>
                                    <?php
                                        if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "user") { ?>
                                            <th scope="col"></th>
                                    <?php } ?>
                                    <!-- for admins -->
                                    <?php
                                    if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                        <th scope="col">Last Modified</th>
                                        <th scope="col">Modified By</th>

                                        <!-- for buttons -->
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // fetch all tech supplies that is more than 3 stocks of quantity
                                include 'includes/config.inc.php';
                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) != "admin") {
                                    $sql = "SELECT id,
                                            tor_id AS 'TOR ID',
                                            CONCAT(u.user_firstname, ' ', u.user_lastname) as User,
                                            tor_date as Date,
                                            t.date_last_modified AS tdlm,
                                            CONCAT(mb.user_firstname, ' ', mb.user_lastname) as 'tmb'
                                            FROM tor t
                                            LEFT JOIN users u ON t.tor_user = u.user_id
                                            LEFT JOIN users mb ON t.modified_by = mb.user_id
                                            WHERE tor_user IS NULL
                                            ORDER BY tor_date;";

                                } else if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") {
                                    $sql = "SELECT id,\n"
                                    . "tor_id AS 'TOR ID',\n"
                                    . "CONCAT(u.user_firstname, ' ', u.user_lastname) as User,\n"
                                    . "tor_date as Date,\n"
                                    . "t.date_last_modified AS tdlm,\n"
                                    . "CONCAT(mb.user_firstname, ' ', mb.user_lastname) as 'tmb'\n"
                                    . "FROM tor t\n"
                                    . "LEFT JOIN users u ON t.tor_user=u.user_id\n"
                                    . "LEFT JOIN users mb ON t.modified_by=mb.user_id\n"
                                    . "ORDER BY t.tor_date;";
                                }

                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $tid = $row['id'];
                                        $tor_id = $row['TOR ID'];
                                        $tor_user = $row['User'];
                                        $tor_date = $row['Date'];
                                        $dlm = $row['tdlm'];
                                        $mby = $row['tmb'];
                                ?>
                                        <tr>
                                            <form action="includes/tor.inc.php" method="post" enctype="multipart/form-data">
                                                <!-- rows -->

                                                <!-- t_id -->
                                                <td class="tid"><?php echo $tid; ?></td>
                                                <input name="tid" type="hidden" value="<?php echo $tid; ?>">

                                                <!-- tor_id -->
                                                <td><?php echo $tor_id; ?></td>
                                                <input name="tor_id" type="hidden" value="<?php echo $tor_id; ?>">

                                                <!-- tor_user -->
                                                <td><?php echo ($tor_user === null) ? 'No assigned yet' : $tor_user; ?></td>
                                                <input name="tor_user" type="hidden" value="<?php echo $tor_user; ?>">

                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <!-- tor_date -->
                                                    <td><?php echo $tor_date; ?></td>
                                                    <input name="tor_date" type="hidden" value="<?php echo $tor_date; ?>">
                                                <?php } ?>

                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <!-- date_last_modified -->
                                                    <td><?php echo $dlm; ?></td>
                                                    <input name="dlm" type="hidden" value="<?php echo $dlm; ?>">
                                                <?php } ?>
                                                
                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <!-- modified_by -->
                                                    <td><?php echo $mby; ?></td>
                                                    <input name="mby" type="hidden" value="<?php echo $mby; ?>">
                                                <?php } ?>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn viewBtn btn-default px-2" data-bs-toggle="modal" data-bs-target="#viewModal" data-product-id="<?php echo $tid; ?>">
                                                        View
                                                    </button>
                                                </td>

                                                

                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <td><a class="btn btn-warning" href="torEdit.php?eid=<?php echo $tid; ?>"><button type="button" class="btn btn-warning px-2 updateBtn" data-bs-toggle="modal" data-bs-target="#updateModal">
                                                                Update
                                                            </button></a>
                                                    </td>
                                                <?php } ?>
                                            </form>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") {
                                        echo '<td>No data found</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ';
                                    } else 
                                    {
                                        echo '<td>No data found</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        ';
                                    }
                                    }
                                    
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="includes/tor.inc.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Transcript of Record</h5>
                            <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="tor_view">

                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-default px-2" name="get-tor" value="Get Supply">
                        </div>
                    </div>
                </form>
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
    <script>
        $(document).ready(function() {

            $('table').on('click', '.viewBtn', function(e) {
                e.preventDefault();
                var tID = $(this).data('product-id');
                $.ajax({
                    type: 'POST',
                    url: "includes/tor.inc.php",
                    data: {
                        'check_view': true,
                        'tid': tID
                    },
                    success: function(response) {
                        $('.tor_view').html(response);
                        $('#viewModal').modal('show');
                    }
                });
            });

            // Disabling OS
            $('table').on('click', '.disable-btn', function(e) {
                e.preventDefault();
                var osID = $(this).data('os-id');
                $.ajax({
                    type: 'POST',
                    url: "includes/os.inc.php",
                    data: {
                        'disable_supply': true,
                        'os_id': osID
                    },
                    success: function(response) {
                        $('#del_id').val(osID);
                        $('#disableModal').modal('show');
                    }
                });
            });

            // Enabling OS
            $('table').on('click', '.enable-btn', function(e) {
                e.preventDefault();
                var osID = $(this).data('os-id');
                $.ajax({
                    type: 'POST',
                    url: "includes/os.inc.php",
                    data: {
                        'enable_supply': true,
                        'os_id': osID
                    },
                    success: function(response) {
                        $('#enbl_id').val(osID);
                        $('#enableModal').modal('show');
                    }
                });
            });


        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>