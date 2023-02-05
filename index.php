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

    <title>SSMS</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Script for pie chart -->
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        // Function for pie chart
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Supplies', 'Quantity'],
                <?php
                include('includes/config.inc.php');
                $office_supplies_query = "SELECT COUNT(*) as count FROM ssms.office_supplies";
                $office_supplies_result = mysqli_query($conn, $office_supplies_query);
                $office_supplies_data = mysqli_fetch_assoc($office_supplies_result);
                $office_supplies_count = $office_supplies_data['count'];
                $technology_supplies_query = "SELECT COUNT(*) as count FROM ssms.technology_supplies";
                $technology_supplies_result = mysqli_query($conn, $technology_supplies_query);
                $technology_supplies_data = mysqli_fetch_assoc($technology_supplies_result);
                $technology_supplies_count = $technology_supplies_data['count'];
                echo "['Office Supplies', $office_supplies_count],";
                echo "['Technology Supplies', $technology_supplies_count]";
                ?>
            ]);

            var options = {
                is3D: false,
                colors: ['#FFBD00', '#390099'],
                legend: {
                    position: 'bottom'
                }
            };

            function drawChart() {
                // code to draw chart
                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }

            drawChart();
            window.onmouseover = function() {
                drawChart();
            }

            window.onmousemove = function() {
                drawChart();
            }
        }
    </script>

    <script>
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);
    </script>

    <!-- Script for column graph -->
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Quantity'],
                <?php
                include('includes/config.inc.php');
                $query = "SELECT 
    MONTH(restock_date) as month, 
    SUM(restock_quantity) as total_quantity
    FROM ssms.restocks
    GROUP BY MONTH(restock_date)
    ORDER BY month DESC
    LIMIT 12";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . date("F", mktime(0, 0, 0, $row['month'], 10)) . "', " . $row['total_quantity'] . "],";
                }
                ?>
            ]);

            var options = {
                hAxis: {
                    title: 'Month',
                },
                vAxis: {
                    title: 'Quantity',
                    minValue: 0
                },
                legend: {
                    position: 'right'
                },
                bar: {
                    groupWidth: '20%'
                },
                color: ['#390099', '#9E0059', '#FF0054', '#FF5400', '#FFBD00']
            };


            function drawChart() {
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }

            drawChart();
            window.onmouseover = function() {
                drawChart();
            }



        }
    </script>
</head>

<body>
    <!-- Navigational sidebar -->
    <?php include 'nav.php'; ?>
    <?php include 'includes/user.inc.php'; ?>

    <section class="home">
        <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="header-content">
                            <div class="d-flex flex-row align-items-center">
                                <!-- <i class="fa-solid fa-house-chimney icon"></i> -->
                                <p class="header-title text">Dashboard</p>
                            </div>
                            <p id="path"><a href="profile.php"><?php echo $ln . ', ' . $fn; ?></a></p>
                        </div>
                    </div>
                </div>

                <!-- Total Office supplies -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-boxes-packing icon"></i>
                        <span>
                            <?php
                            $result = $conn->query("SELECT COUNT(*) FROM ssms.office_supplies");
                            if ($result = $result->fetch_assoc()) {
                            ?>
                                <h3 class="amount"><strong><?php echo implode($result); ?></strong></h3>
                            <?php } ?>
                            <p class="category ellipsis">Office Supplies</p>
                        </span>
                    </div>
                </div>

                <!-- Total technology supplies -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-computer icon"></i>
                        <span>
                            <?php
                            $result = $conn->query("SELECT COUNT(*) FROM ssms.technology_supplies");
                            if ($result = $result->fetch_assoc()) {
                            ?>
                                <h3 class="amount"><strong><?php echo implode($result); ?></strong></h3>
                            <?php } ?>
                            <p class="category ellipsis">Technology Supplies</p>
                        </span>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-users icon"></i>
                        <span>
                            <?php
                            $result = $conn->query("SELECT COUNT(*) FROM ssms.users");
                            if ($result = $result->fetch_assoc()) {
                            ?>
                                <h3 class="amount"><strong><?php echo implode($result); ?></strong></h3>
                            <?php } ?>
                            <p class="category ellipsis">Total Users</p>
                        </span>
                    </div>
                </div>

                <!-- Total reports -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="box-content">
                        <i class="fa-solid fa-bug icon"></i>
                        <span>
                            <?php
                            $result = $conn->query("SELECT COUNT(*) FROM ssms.reports");
                            if ($result = $result->fetch_assoc()) {
                            ?>
                                <h3 class="amount"><strong><?php echo implode($result); ?></strong></h3>
                            <?php } ?>
                            <p class="category ellipsis">Total Reports</p>
                        </span>
                    </div>
                </div>

                <!-- Recent History -->
                <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                    <div class="large-content">
                        <span class="d-flex justify-content-between">
                            <h3 class="amount"><strong>Recent history</strong></h3>
                            <p class="category ellipsis" id="month-details"><a href="history.php">See more</a></p>
                        </span>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $sql = "SELECT \n"
                                    //     . "    h.history_id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                    //     . "    h.history_quantity AS Quantity, \n"
                                    //     . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                    //     . "    DATE_FORMAT(h.history_date, '%Y-%m-%d') AS Date\n"
                                    //     . "FROM ssms.history h\n"
                                    //     . "LEFT JOIN ssms.office_supplies os ON h.os_id = os.os_id\n"
                                    //     . "LEFT JOIN ssms.technology_supplies ts ON h.ts_id = ts.ts_id\n"
                                    //     . "LEFT JOIN ssms.users u ON h.user_id = u.user_id\n"
                                    //     . "WHERE MONTH(h.history_date) = MONTH(CURRENT_DATE())\n"
                                    //     . "AND YEAR(h.history_date) = YEAR(CURRENT_DATE()) ORDER BY h.history_date DESC LIMIT 3;";
                                    $sql = "SELECT COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item, h.history_quantity as Quantity, CONCAT(U.user_firstname, ' ', u.user_lastname) as User, h.history_date as Date FROM ssms.history as h LEFT JOIN ssms.office_supplies as os on h.os_id=os.os_id LEFT JOIN ssms.technology_supplies as ts on h.ts_id=ts.ts_id LEFT JOIN ssms.users as u on h.user_id=u.user_id ORDER BY h.history_date DESC LIMIT 3;";

                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $item = $row['Item'];
                                            $qty = $row['Quantity'];
                                            $user = $row['User'];
                                            $date = $row['Date'];

                                    ?>
                                            <tr>
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

                <!-- Pie Chart -->
                <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                    <div class="large-content">
                        <span class="d-flex justify-content-between">
                            <h3 class="amount"><strong>Supplies</strong></h3>
                            <!-- <p class="category ellipsis extra-details">This month</p> -->
                        </span>
                        <hr>
                        <span>
                            <div id="piechart_3d"></div>
                        </span>
                    </div>
                </div>

                <!-- Recent Restock -->
                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                    <div class="large-content">
                        <span class="d-flex justify-content-between">
                            <h3 class="amount"><strong>Recent Restocks</strong></h3>
                            <p class="category ellipsis" id="month-details"><a href="restocks.php">See more</a></p>
                        </span>
                        <hr>
                        <span>
                            <div id="chart_div" class="">
                            </div>
                        </span>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                    <div class="large-content">
                        <span class="d-flex justify-content-between">
                            <h3 class="amount"><strong>Users</strong></h3>
                            <!-- <p class="category ellipsis extra-details">This month</p> -->
                        </span>
                        <hr>
                        <span class="user-count">
                            <!-- php code to select admins -->
                            <?php
                            require 'includes/config.inc.php';
                            $sql = "SELECT COUNT(user_id) FROM ssms.users WHERE user_category='admin'";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_fetch_array($result)[0];
                            ?>
                            <!-- admins count -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fa-sharp fa-solid fa-user-tie user-count-icon"></i>
                                    <p class="user-count-title">Admins</p>
                                </div>
                                <div>
                                    <p class="user-count-value"><?php echo $count; ?></p>
                                </div>
                            </div>
                            <hr>

                            <!-- php code to select users -->
                            <?php
                            require 'includes/config.inc.php';
                            $sql = "SELECT COUNT(user_id) FROM ssms.users WHERE user_category='user'";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_fetch_array($result)[0];
                            ?>
                            <!-- users count -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fa-solid fa-user user-count-icon"></i>
                                    <p class="user-count-title">Users</p>
                                </div>
                                <div>
                                    <p class="user-count-value"><?php echo $count; ?></p>
                                </div>
                            </div>
                            <hr>

                            <!-- php code to select users -->
                            <?php
                            require 'includes/config.inc.php';
                            $sql = "SELECT COUNT(user_id) FROM ssms.users WHERE user_status='inactive'";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_fetch_array($result)[0];
                            ?>
                            <!-- inactive accounts -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fa-solid fa-user-slash user-count-icon"></i>
                                    <p class="user-count-title">Inactive</p>
                                </div>
                                <div>
                                    <p class="user-count-value"><?php echo $count; ?></p>
                                </div>
                            </div>
                            <hr>

                        </span>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="large-content">
                        <span class="d-flex justify-content-between">
                            <h3 class="amount"><strong>Low Stocks</strong></h3>
                            <!-- <p>Low stocks</p> -->
                            <!-- <p class="category ellipsis extra-details">This month</p> -->
                        </span>
                        <hr>
                        <span>

                        </span>
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