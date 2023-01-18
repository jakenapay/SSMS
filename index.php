<?php include 'includes/config.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>SSMS</title>
</head>

<body>
    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>

    <section class="home">
        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="header-content">
                            <p class="header-title text">Dashboard</p>
                            <p id="path">Home > <a href="index.php">Dashboard</a></p>
                        </div>
                    </div>
                </div>

                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Office Supplies</p>
                        </span>
                    </div>
                </div>

                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-computer icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Technology Supplies</p>
                        </span>
                    </div>
                </div>
                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Restocks Notifications</p>
                        </span>
                    </div>
                </div>
                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Restocks Notifications</p>
                        </span>
                    </div>
                </div>
                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Restocks Notifications</p>
                        </span>
                    </div>
                </div>
                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Restocks Notifications</p>
                        </span>
                    </div>
                </div>
                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Restocks Notifications</p>
                        </span>
                    </div>
                </div>
                <!-- content -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <h3 class="amount"><strong>99</strong></h3>
                            <p class="category ellipsis">Restocks Notifications</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container box">
            <div class="row">

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>