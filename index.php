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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Script for pie chart -->
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

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

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
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
                    position: 'top'
                },
                bar: {
                    groupWidth: '75%'
                },
                color: ['#390099', '#9E0059', '#FF0054', '#FF5400', '#FFBD00']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);

        }
    </script>
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
                                    $sql = "SELECT \n"
                                        . "    h.history_id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
                                        . "    h.history_quantity AS Quantity, \n"
                                        . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
                                        . "    DATE_FORMAT(h.history_date, '%Y-%m-%d') AS Date\n"
                                        . "FROM ssms.history h\n"
                                        . "LEFT JOIN ssms.office_supplies os ON h.os_id = os.os_id\n"
                                        . "LEFT JOIN ssms.technology_supplies ts ON h.ts_id = ts.ts_id\n"
                                        . "LEFT JOIN ssms.users u ON h.user_id = u.user_id\n"
                                        . "WHERE MONTH(h.history_date) = MONTH(CURRENT_DATE())\n"
                                        . "AND YEAR(h.history_date) = YEAR(CURRENT_DATE()) ORDER BY h.history_date DESC LIMIT 3;";

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
                        <span class="d-flex justify-content-center align-items-center">
                            <div id="piechart_3d" style="width: 100%;height: 200px"></div>
                        </span>
                    </div>
                </div>

                <!-- Recent Restock -->
                <div class="col-12 col-sm-12 col-md-8 col-lg-9">
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