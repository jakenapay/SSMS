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

    <title>SSMS</title>



</head>

<body>
    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>

    <section class="home">
        <div class="container mt-3 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="header-content">
                            <p class="header-title text">Profile</p>
                            <p id="path"><a href="includes/logout.inc.php">Logout</a></p>
                        </div>
                    </div>
                </div>

                <!-- Profile picture -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="box-content-profile">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <img class="img-fluid photo" src="https://thumbs.dreamstime.com/b/default-profile-picture-avatar-photo-placeholder-vector-illustration-default-profile-picture-avatar-photo-placeholder-vector-189495158.jpg" alt="Default Photo">
                            <br>
                            <h5 class="label">Edit image</h5>
                        </div>
                        <span>

                        </span>
                    </div>
                </div>

                <?php
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
                        $ct = $row['user_category'];
                        $st = $row['user_status'];
                    }
                } else {
                    echo "0 results";
                }
                mysqli_close($conn);
                ?>
                <!-- Here you can start to add code -->
                <div class="col-12 col-sm-6 col-md-8 col-lg-8">
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
                                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                    <label for="user_firstname" class="label">First name</label>
                                    <input id="user_firstname" name="user_firstname" type="text" value="<?php echo $fn; ?>">
                                </div>
                                <div class="form-input">
                                    <label for="user_lastname" class="label text-center">Last name</label>
                                    <input id="user_lastname" name="user_lastname" type="text" value="<?php echo $ln; ?>">
                                </div>
                                <div class="form-input">
                                    <label for="email" class="label">Email Address</label>
                                    <input id="email" name="email" type="email" value="<?php echo $em; ?>">
                                </div>
                                <div class="form-input">
                                    <label for="category" class="label">Category</label>
                                    <input class="text-capitalize" id="category" name="category" type="text" value="<?php echo $ct; ?>" disabled>
                                </div>
                                <div class="form-input mb-0">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn button-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Edit
                                    </button>
                                </div>
                            </form>
                        </span>
                    </div>
                </div>



            </div>
        </div>
    </section>



    <!-- Modal -->
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
                            <input type="email" class="form-control" id="new_em" name="new_em" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $em; ?>">
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

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";

            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</body>

</html>