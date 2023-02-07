<?php
session_start();

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
    <link rel="stylesheet" href="assets/css/profile.css?v=<?php echo time(); ?>">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>SSMS | Profile & Accounts</title>

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
    <?php
    include 'nav.php';

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
    }
    ?>

    <section class="home">
        <div class="container mt-3 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="header-content">
                            <div class="d-flex flex-row align-items-center"><i class="fa-solid fa-users icon"></i>
                                <p class="header-title text">Profile & Accounts</p>
                            </div>

                            <p id="path"><a href="includes/logout.inc.php">Logout</a></p>
                        </div>
                    </div>
                </div>

                <!-- Profile picture -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                    <div class="box-content-profile">
                        <form action="includes/updateProfile.inc.php" method="post" enctype="multipart/form-data" class="">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <!-- hidden -->
                                <input type="hidden" name="old_img" value="<?php echo $old_img; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">

                                <?php
                                if ($old_img != '') {
                                    // if there's an existing image then echo the image
                                    echo '<img src="userProfile/' . $old_img . '" alt="" class="img-fluid pb-3" style="max-width: 200px;">';
                                } else {
                                    echo '<label class="m-5">No image found.</label>';
                                }
                                ?>
                                <hr>
                                <label class="label">Update new image</label>
                                <input type="file" accept="image/*" name="user_img" id="user_img">
                                <input type="submit" class="mt-4 btn button-warning" name="edit-image" value="Save ">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Here you can start to add code -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                    <div class="box-content-details">
                        <span id="span-form">
                            <!-- error message here -->
                            <?php
                            $message = '';
                            if (isset($_GET['m'])) {
                                if ($_GET['m'] == 'emptyFields') {
                                    $message = 'Fill up all fields';
                                    echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                                }
                                if ($_GET['m'] == 'emailExist') {
                                    $message = 'Email already exists';
                                    echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                                }
                                if ($_GET['m'] == 'updateSuccess') {
                                    $message = 'Update success';
                                    echo '<p class="message-success pl-2"><i class="fa-solid fa-check"></i>' . $message . '</p>';
                                }
                                if ($_GET['m'] == 'updateFailed') {
                                    $message = 'Update failed';
                                    echo '<p class="message pl-2"><i class="fa-solid fa-circle-exclamation"></i>' . $message . '</p>';
                                }
                            }
                            ?>

                            <form id="form">
                                <h5><strong>Status:
                                        <span id="status" class="text-capitalize"><?php echo $st; ?></span></strong>
                                </h5>
                                <div class="form-input">
                                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" disabled>
                                    <label for="user_firstname" class="label">First name</label>
                                    <input id="user_firstname" name="user_firstname" type="text" value="<?php echo $fn; ?>" disabled>
                                </div>
                                <div class="form-input">
                                    <label for="user_lastname" class="label text-center">Last name</label>
                                    <input id="user_lastname" name="user_lastname" type="text" value="<?php echo $ln; ?>" disabled>
                                </div>
                                <div class="form-input">
                                    <label for="email" class="label">Email Address</label>
                                    <input id="email" name="email" type="email" value="<?php echo $em; ?>" disabled>
                                </div>
                                <div class="form-input">
                                    <label for="category" class="label">Category</label>
                                    <input class="text-capitalize" id="category" name="category" type="text" value="<?php echo $ct; ?>" disabled>
                                </div>
                                <div class="form-input mb-0">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn button-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Edit Profile
                                    </button>
                                </div>
                            </form>
                        </span>
                    </div>
                </div>
                <!-- end of user details -->

                <!-- Users accounts tables -->
                <?php if ((isset($_SESSION['ct']) and ($_SESSION['ct']) != 'user')) { ?>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="large-content">
                            <!-- <span class="d-flex justify-content-between">
                        <h3 class="amount"><strong>Recent history</strong></h3>
                    </span> 
                    <hr> -->
                            <div class="table-responsive">
                                <h5>User Accounts</h5>
                                <hr class="my-3">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="pt-5">
                                            <th scope="col">User ID</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/config.inc.php';
                                        include 'includes/user.inc.php';
                                        // Checks if its a user or admin; if user then go to stocks page
                                        // Only admin can go to index page or dashboard
                                        if ((isset($_SESSION['ct']) and ($_SESSION['ct']) == 'user')) {
                                            $sql = "SELECT user_id as id, user_firstname as fn, user_lastname as ln, user_email as em, user_img as img, user_category as cat, user_status as stat FROM ssms.users WHERE user_id=' . $id . '";
                                        } else {
                                            $sql = "SELECT user_id as id, user_firstname as fn, user_lastname as ln, user_email as em, user_img as img, user_category as cat, user_status as stat FROM ssms.users";
                                        }
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                $userid = $row['id'];
                                                $fn = $row['fn'];
                                                $ln = $row['ln'];
                                                $em = $row['em'];
                                                $cat = $row['cat'];
                                                $stat = $row['stat'];

                                        ?>
                                                <tr>
                                                    <form action="includes/user.inc.php" method="POST" enctype="multipart/form-data">
                                                        <td class=" user_id"><?php echo $userid; ?></td>
                                                        <input name="user_id" class="user_id" type="hidden" value="<?php echo $userid; ?>">
                                                        <td><?php echo $fn; ?></td>
                                                        <td><?php echo $ln; ?></td>
                                                        <td><?php echo $em; ?></td>
                                                        <?php
                                                        if ($cat == 'admin') {
                                                            echo '<td class="text-capitalize text-success"><strong>' . $cat . '</strong></td>';
                                                        } else if ($cat == 'user') {
                                                            echo '<td class="text-danger text-capitalize"><strong>' . $cat . '</strong></td>';
                                                        } ?>
                                                        <?php
                                                        if ($stat == 'active') {
                                                            echo '<td class="text-success text-capitalize"><strong>' . $stat . '</strong></td>';
                                                        } else if ($stat == 'inactive') {
                                                            echo '<td class="text-danger text-capitalize"><strong>' . $stat . '</strong></td>';
                                                        } ?>

                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn viewBtn btn-default px-2" data-bs-toggle="modal" data-bs-target="#viewUserAccountModal">
                                                                View
                                                            </button>
                                                        </td>
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
                <?php } ?>
            </div>
    </section>

    <!-- For editing details Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/updateProfile.inc.php" method="post">
                    <div class="modal-body">
                        <div class="form-group pt-2 pb-2">
                            <label for="new_fn">First name</label>
                            <input type="text" class="form-control" id="new_fn" name="new_fn" placeholder="Enter first name" value="<?php echo $fn; ?>">
                        </div>
                        <div class="form-group pt-2 pb-2">
                            <label for="new_ln">Last name</label>
                            <input type="text" class="form-control" id="new_ln" name="new_ln" placeholder="Enter last name" value="<?php echo $ln; ?>">
                        </div>
                        <div class="form-group pt-2 pb-2">
                            <label for="new_em">Email address</label>
                            <input type="email" class="form-control" id="new_em" name="new_em" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $em; ?>" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save-btn" class="btn button-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View other user accounts modal -->
    <div class="modal fade" id="viewUserAccountModal" tabindex="-1" role="dialog" aria-labelledby="viewUserAccountModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="includes/user.inc.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewUserAccountModal">View User Account</h5>
                        <button type="button" class="close border-0 bg-white px-2" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user_view">

                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                        <button type="button" class="btn btn-light px-2" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-default px-2" name="user_btn_update" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                var user_id = $(this).closest('tr').find('.user_id').text();

                $.ajax({
                    type: 'POST',
                    url: "includes/user.inc.php",
                    data: {
                        'check_view': true,
                        'user_id': user_id
                    },
                    success: function(response) {
                        // console.log(response);
                        $('.user_view').html(response);
                        $('#viewUserAccountModal').modal('show');
                    }
                });
            });
        });
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</body>

</html>