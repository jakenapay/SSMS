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
    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>
    <?php include 'includes/user.inc.php'; ?>

    <section class="home">
        <div class="container mt-3 mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="header">
                    <div class="header-content">
                        <span class="d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-boxes-packing icon"></i>
                            <p class="header-title text">Office Supplies</p>
                        </span>
                    </div>
                </div>
            </div>

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
                                    <!-- for users -->
                                    <?php
                                    if (isset($_SESSION['ct']) && ($_SESSION['ct']) != "admin") { ?>
                                        <th scope="col"></th>
                                    <?php } ?>

                                    <!-- for admins -->
                                    <?php
                                    if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                        <th scope="col">Quantity</th>
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
                                $sql = "SELECT os_id as id, os_name as name, os_brand as brand, os_uom as uom, os_quantity as qty, os_location as loc, date_added as da, date_last_modified as dm FROM ssms.office_supplies WHERE os_quantity > 3";

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
                                        $da = $row['da'];
                                        $dm = $row['dm'];
                                ?>
                                        <tr>
                                            <form action="includes/ts.inc.php" method="post" enctype="multipart/form-data">
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

                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <td><?php echo $qty; ?></td>
                                                <?php } ?>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn viewBtn px-2" data-bs-toggle="modal" data-bs-target="#viewModal">
                                                        View
                                                    </button>
                                                </td>

                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>

                                                    <td><a class="btn btn-warning" href="osEdit.php?eid=<?php echo $id; ?>"><button type="button" class="btn btn-warning px-2 updateBtn" data-bs-toggle="modal" data-bs-target="#updateModal">
                                                                Update
                                                            </button></a>
                                                    </td>
                                                    <td><a class="btn btn-danger" href="url_to_delete<?php echo $id; ?>" id="<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn btn-danger px-2">Delete</button></a></td>
                                                <?php } ?>
                                            </form>
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

        <!-- View Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                    <div class="modal-footer">
                        <div class="row">
                            <button type="button" class="btn btn-danger px-2" data-bs-dismiss="modal">Close</button>
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
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>