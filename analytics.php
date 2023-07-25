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
    header("location: home.php");
    exit();
}

include 'includes/config.inc.php';
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
    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="logo.png">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>







</head>

<body>
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
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="header-content">
                            <div class="d-flex flex-row align-items-center">
                                <!-- <i class="fa-solid fa-house-chimney icon"></i> -->
                                <i class="fa-solid fa-chart-simple icon dbicon"></i>
                                <p class="header-title text">Analytics</p>
                            </div>
                            <p id="path"><a href="profile.php"><?php echo $ln . ', ' . $fn; ?></a></p>
                        </div>
                    </div>
                </div>

               
                <!-- CODE HERE -->
                <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                    <div class="header">
                        <div class="header-content">
                            <div class="d-flex flex-row align-items-center">
                            <?php
                                include 'includes/config.inc.php';

                                $selectedMonth = "";
                                $mostObtainedItem = "";
                                $mostObtainedQuantity = "";

                                if (isset($_POST['update'])) {
                                    $selectedMonth = $_POST['selected_month'];

                                    $sql = "SELECT COALESCE(os.os_name, ts.ts_model) AS Item, COUNT(*) AS Quantity
                                            FROM history h
                                            LEFT JOIN office_supplies os ON h.os_id = os.os_id
                                            LEFT JOIN technology_supplies ts ON h.ts_id = ts.ts_id
                                            WHERE h.status = 'approved' AND MONTH(h.history_date) = '$selectedMonth'
                                            GROUP BY Item
                                            ORDER BY Quantity DESC
                                            LIMIT 1";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $mostObtainedItem = $row['Item'];
                                        $mostObtainedQuantity = $row['Quantity'];
                                    }
                                }

                                ?>

                                <h3>Most Obtained Item:</h3>
                                <form method="POST">
                                    <label for="selected_month">Select Month:</label>
                                    <select id="selected_month" name="selected_month" required>
                                        <option value="1" <?php if ($selectedMonth == 1) echo "selected"; ?>>January</option>
                                        <option value="2" <?php if ($selectedMonth == 2) echo "selected"; ?>>February</option>
                                        <option value="3" <?php if ($selectedMonth == 3) echo "selected"; ?>>March</option>
                                        <option value="4" <?php if ($selectedMonth == 4) echo "selected"; ?>>April</option>
                                        <option value="5" <?php if ($selectedMonth == 5) echo "selected"; ?>>May</option>
                                        <option value="6" <?php if ($selectedMonth == 6) echo "selected"; ?>>June</option>
                                        <option value="7" <?php if ($selectedMonth == 7) echo "selected"; ?>>July</option>
                                        <option value="8" <?php if ($selectedMonth == 8) echo "selected"; ?>>August</option>
                                        <option value="9" <?php if ($selectedMonth == 9) echo "selected"; ?>>September</option>
                                        <option value="10" <?php if ($selectedMonth == 10) echo "selected"; ?>>October</option>
                                        <option value="11" <?php if ($selectedMonth == 11) echo "selected"; ?>>November</option>
                                        <option value="12" <?php if ($selectedMonth == 12) echo "selected"; ?>>December</option>
                                    </select>

                                    <button type="submit" name="update">Update</button>
                                </form>

                                <?php
                                if (!empty($mostObtainedItem)) {
                                    echo "<p>Item: " . $mostObtainedItem . "</p>";
                                    echo "<p>Quantity: " . $mostObtainedQuantity . "</p>";
                                }
                                ?>


                            </div>          
                        </div>
                    </div>
                </div>
                



            </div>

            <div class="container box">
                <div class="row">
                    <!-- <h1>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit ex autem beatae eius non architecto minus eligendi incidunt molestias dolore?</h1> -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>