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

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>SSMS | Office Supplies</title>

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

    <!-- Add Modal for technology supplies -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Office Supply</h5>
                    <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/os.inc.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <!-- add name -->
                            <div class="col-md-6 pt-3 pb-1">
                                <label for="os_name">Name</label><br>
                                <input class="form-control" type="text" name="os_name" id="os_name" placeholder="Supply Name">
                            </div>
                            <!-- brand -->
                            <div class="col-md-6 pt-3 pb-1">
                                <label for="os_brand">Brand</label><br>
                                <input class="form-control" type="text" name="os_brand" id="os_brand" placeholder="Supply Brand">
                            </div>
                            <!-- uom -->
                            <div class="col-md-6 pt-3 pb-1">
                                <label for="os_uom">Unit of Measure</label><br>
                                <input class="form-control" type="text" name="os_uom" id="os_uom" placeholder="Unit of Measure">
                            </div>
                            <!-- quantity -->
                            <div class="col-md-6 pt-3 pb-1">
                                <label for="os_quantity">Quantity</label>
                                <input class="form-control" type="number" min="1" name="os_quantity" id="os_quantity" required placeholder="Supply Quantity">
                            </div>
                            <!-- location -->
                            <div class="col-md-6 pt-3 pb-1">
                                <label for="os_location">Location</label>
                                <input class="form-control" type="text" name="os_location" id="os_location" placeholder="Location">
                            </div>
                            <!-- description -->
                            <div class="col-md-12 pt-3 pb-1">
                                <label for="os_description">Description</label>
                                <textarea class="form-control" type="text" name="os_description" id="os_description" placeholder="Other information.."></textarea>
                            </div>
                            <!-- status -->
                            <div class="col-md-12 pt-3 pb-1">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="text-dark">
                                    <option value="enabled">Enabled</option>
                                    <option value="disabled">Disabled</option>
                                </select>
                            </div>
                            <!-- image -->
                            <div class="col-md-12 pt-3 pb-1">
                                <label for="os_img">Image</label>
                                <input type="file" accept="image/*" name="os_img" id="os_img" required>
                            </div>

                            <!-- hidden -->
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-default px-2" name="add-office-btn" value="Add Supply">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Navigational sidebar -->
    <?php include 'nav.php';
    include 'includes/config.inc.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM ssms.users WHERE user_id=$id LIMIT 1";
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
                            <i class="fa-solid fa-boxes-packing icon"></i>
                            <p class="header-title text">Office Supplies</p>
                        </span>
                        <?php
                        if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                            <div>
                                <button class="btn btn-default py-1 px-2 my-1" data-bs-toggle="modal" data-bs-target="#addModal">Add Office Supply</button>
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
                    <!-- <span class="d-flex justify-content-between">
                        <h3 class="amount"><strong>Recent history</strong></h3>
                    </span> 
                    <hr> -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="pt-5">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Unit of Measure</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Image</th>
                                    <!-- for users -->
                                    <?php
                                    if (isset($_SESSION['ct']) && ($_SESSION['ct']) != "admin") { ?>
                                        <th scope="col"></th>
                                    <?php } ?>
                                    <!-- for admins -->
                                    <?php
                                    if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
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
                                    $sql = "SELECT os_id as id, os_name as name, os_brand as brand, os_uom as uom, os_quantity as qty, os_location as loc, os_desc as des, os_img as img, status, date_added as da, date_last_modified as dm FROM ssms.office_supplies WHERE os_quantity > 0 AND status='enabled'";
                                } else if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") {
                                    $sql = "SELECT os_id as id, os_name as name, os_brand as brand, os_uom as uom, os_quantity as qty, os_location as loc, os_desc as des, os_img as img, status, date_added as da, date_last_modified as dm FROM ssms.office_supplies WHERE os_quantity > 0";
                                }

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
                                        $img = $row['img'];

                                        // for admins only to see
                                        $qty = $row['qty'];
                                        $stat = $row['status'];
                                        $da = $row['da'];
                                        $dm = $row['dm'];
                                ?>
                                        <tr>
                                            <form action="includes/os.inc.php" method="post" enctype="multipart/form-data">
                                                <!-- rows -->

                                                <!-- id -->
                                                <td class="os_id"><?php echo $id; ?></td>
                                                <input name="os_id" class="os_id" type="hidden" value="<?php echo $id; ?>">

                                                <!-- name -->
                                                <td><?php echo $name; ?></td>
                                                <input name="os_name" type="hidden" value="<?php echo $name; ?>">

                                                <td><?php echo $brand; ?></td>
                                                <input name="os_brand" type="hidden" value="<?php echo $brand; ?>">

                                                <td><?php echo $uom; ?></td>
                                                <input name="os_uom" type="hidden" value="<?php echo $uom; ?>">

                                                <td><?php echo $loc; ?></td>
                                                <input name="os_location" type="hidden" value="<?php echo $loc; ?>">

                                                <td><img alt="<?php echo $name; ?>" src="officeSupplies/<?php echo $img; ?>" style="width: 100px;" class="img-fluid"></td>
                                                <input name="os_location" type="hidden" value="<?php echo $loc; ?>">

                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <td><?php echo $qty; ?></td>
                                                <?php
                                                    if ($stat == "enabled") {
                                                        echo '<td class="text-capitalize text-success"><strong>' . $stat . '</strong></td>';
                                                    } else if ($stat == "disabled") {
                                                        echo '<td class="text-capitalize text-danger"><strong>' . $stat . '</strong></td>';
                                                    }
                                                } ?>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn viewBtn btn-default px-2" data-bs-toggle="modal" data-bs-target="#viewModal">
                                                        View
                                                    </button>
                                                </td>

                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <td><a class="btn btn-warning" href="osEdit.php?eid=<?php echo $id; ?>"><button type="button" class="btn btn-warning px-2 updateBtn" data-bs-toggle="modal" data-bs-target="#updateModal">
                                                                Update
                                                            </button></a>
                                                    </td>
                                                    <?php
                                                    if ($stat == 'enabled') {
                                                        echo '<td><a href=""><button class="btn btn-danger px-2 disable-btn">Disable</button></a></td>';
                                                    } else if ($stat == 'disabled') {
                                                        echo '<td><a href=""><button class="btn btn-success px-2 enable-btn">Enable</button></a></td>';
                                                    }
                                                    ?>
                                                <?php } ?>
                                            </form>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<td>No data found</td>
                                            <td></td>
                                            <td></td>
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

        <!-- View Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="includes/os.inc.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Office Supply</h5>
                            <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="os_view">

                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-default px-2" name="get-btn-office" value="Get Supply">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete(disabled supply) Modal -->
        <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="disableModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="includes/os.inc.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="disableModal">Disable Office Supply</h5>
                            <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="del_id" id="del_id">
                            <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
                            <h6>Are you sure you want to disable this supply?</h6>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-default px-2" name="delete-supply" value="Disable Supply">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Enable supply Modal -->
        <div class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-labelledby="enableModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="includes/os.inc.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="enableModal">Enable Office Supply</h5>
                            <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="enbl_id" id="enbl_id">
                            <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
                            <h6>Are you sure you want to enable this supply?</h6>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-default px-2" name="enable-supply" value="Enable Supply">
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


        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.viewBtn').click(function(e) {
                e.preventDefault();
                // alert('hello');
                var os_id = $(this).closest('tr').find('.os_id').text();

                $.ajax({
                    type: 'POST',
                    url: "includes/os.inc.php",
                    data: {
                        'check_view': true,
                        'os_id': os_id
                    },
                    success: function(response) {
                        // console.log(response);
                        $('.os_view').html(response);
                        $('#viewModal').modal('show');
                    }
                });
            });

            // disabling TS
            $('.disable-btn').click(function(e) {
                e.preventDefault();
                var os_id = $(this).closest('tr').find('.os_id').text();
                // console.log(ts_id);
                $('#del_id').val(os_id);
                $('#disableModal').modal('show');

            });

            // enabling TS 
            $('.enable-btn').click(function(e) {
                e.preventDefault();
                var os_id = $(this).closest('tr').find('.os_id').text();
                // console.log(ts_id);
                $('#enbl_id').val(os_id);
                $('#enableModal').modal('show');

            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>