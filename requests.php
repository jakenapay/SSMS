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

    <title>Requests</title>

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
    <?php include 'includes/user.inc.php';
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
                        <p class="header-title text">Requests</p>
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
                                    <th scope="col">History ID</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Approved by</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'includes/config.inc.php';
                                // Checks if its a user or admin; if user then go to stocks page
                                // Only admin can go to index page or dashboard
                                if ((isset($_SESSION['ct']) and ($_SESSION['ct']) == 'user')) {
                                    $sql = "SELECT \n"
                                        . "    h.history_id as Id, COALESCE(os.os_name, ts.ts_model) as Item,\n"
                                        . "    h.history_quantity AS Quantity, \n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) AS Modified, \n"
                                        . "    h.status as Status,\n"
                                        . "    h.history_date AS Date\n"
                                        . "FROM history h\n"
                                        . "LEFT JOIN office_supplies os ON h.os_id = os.os_id\n"
                                        . "LEFT JOIN technology_supplies ts ON h.ts_id = ts.ts_id\n"
                                        . "LEFT JOIN users u ON h.user_id = u.user_id\n"
                                        . "LEFT JOIN users mb ON h.modified_by = u.user_id\n"
                                        . "WHERE u.user_id=" . $id . "\n"
                                        . "ORDER BY h.history_date;";
                                } else {
                                    $sql = "SELECT DISTINCT\n"
                                        . "    h.history_id AS Id,\n"
                                        . "    COALESCE(os.os_name, ts.ts_model) AS Item,\n"
                                        . "    COALESCE(os.os_id, ts.ts_id) AS Item_id, \n"
                                        . "    h.history_quantity AS Quantity,\n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) AS User,\n"
                                        . "    CONCAT(mb.user_firstname, ' ', mb.user_lastname) AS Modified,\n"
                                        . "    h.status AS Status,\n"
                                        . "    h.history_date AS Date\n"
                                        . "FROM history h\n"
                                        . "LEFT JOIN office_supplies os ON h.os_id = os.os_id\n"
                                        . "LEFT JOIN technology_supplies ts ON h.ts_id = ts.ts_id\n"
                                        . "LEFT JOIN users u ON h.user_id = u.user_id\n"
                                        . "LEFT JOIN users mb ON h.modified_by = u.user_id\n"
                                        . "WHERE h.status = 'pending'\n"
                                        . "ORDER BY h.history_date;";
                                }
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['Id'];
                                        $item = $row['Item'];
                                        $item_id = $row['Item_id'];
                                        $qty = $row['Quantity'];
                                        $user = $row['User'];
                                        $stat = $row['Status'];
                                        $by = $row['Modified'];
                                        $date = $row['Date'];

                                ?>
                                        <tr>
                                            <form action="includes/requests.inc.php" method="POST" enctype="multipart/form-data">
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $item; ?></td>
                                                <td><?php echo $qty; ?></td>
                                                <td><?php echo $user; ?></td>
                                                <?php
                                                    if ($stat == "approved") {
                                                        echo '<td class="text-capitalize text-success"><strong>' . $stat . '</strong></td>';
                                                    } else if ($stat == "pending") {
                                                        echo '<td class="text-capitalize text-warning"><strong>' . $stat . '</strong></td>';
                                                    } 
                                                ?>
                                                <td><?php echo $by; ?></td>
                                                <td><?php echo $date; ?></td>

                                                <!-- Action -->
                                                <?php
                                                if (isset($_SESSION['ct']) && ($_SESSION['ct']) == "admin") { ?>
                                                    <td>
                                                        <?php if ($stat == 'pending') { ?>
                                                            <button class="btn btn-success px-2 appr-btn" data-appr-id="<?php echo $id; ?>" data-item-name="<?php echo $item ?>" data-item-id="<?php echo $item_id; ?>" data-item-qty="<?php echo $qty; ?>">Approve</button>
                                                        <?php } ?>
                                                    </td>

                                                <?php } ?>
                                                <!-- End of action -->
                                            </form>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td>No data found</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                            </tr>';
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Aprrove Modal -->
            <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="includes/requests.inc.php" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="disableModal">Approve Request</h5>
                                <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- <label for="appr_id">Approve ID</label> -->
                                <input type="hidden" name="appr_id" id="appr_id">
                                <!-- <label for="appr_item_name">Item Name</label> -->
                                <input type="hidden" name="appr_item_name" id="appr_item_name">
                                <!-- <label for="appr_item_id">Item ID</label> -->
                                <input type="hidden" name="appr_item_id" id="appr_item_id">
                                <!-- <label for="appr_item_qty">Item QTY</label> -->
                                <input type="hidden" name="appr_item_qty" id="appr_item_qty">
                                <!-- <label for="">User ID</label> -->
                                <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
                                <h6>Are you sure you want to approve this request?</h6>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                                <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-default px-2" name="approve-request" value="Approve Request">
                            </div>
                        </div>
                    </form>
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

            // Approving supply
            $('table').on('click', '.appr-btn', function(e) {
                e.preventDefault();
                var appr_id = $(this).data('appr-id');
                var appr_item_name = $(this).data('item-name');
                var appr_item_id = $(this).data('item-id');
                var appr_item_qty = $(this).data('item-qty');
                $.ajax({
                    type: 'POST',
                    url: "includes/requests.inc.php",
                    data: {
                        'approve_supply': true,
                        'appr_id': appr_id,
                        'appr_item_name': appr_item_name,
                        'appr_item_id': appr_item_id,
                        'appr_item_qty': appr_item_qty
                    },
                    success: function(response) {
                        $('#appr_id').val(appr_id);
                        $('#appr_item_name').val(appr_item_name);
                        $('#appr_item_id').val(appr_item_id);
                        $('#appr_item_qty').val(appr_item_qty);
                        $('#approveModal').modal('show');
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>