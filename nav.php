<nav class="sidebar close">
    <header class="d-flex justify-content-between">
        <div class="image-text">
            <span class="image">
                <img src="logo-wo-name.png" alt="Logo">
            </span>

            <div class="text logo-text">
                <span class="name">S.S.M.S.</span>
                <span class="profession">Group Napay</span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <!-- <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search">
            </li> -->

            <ul class="menu-links p-0">

                <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                    if (isset($_SESSION['ct']) and ($_SESSION['ct']) != 'user') { ?>
                        <li class="nav-link">
                            <a href="index.php">
                                <i class="fa-solid fa-house-chimney icon"></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li>
                <?php }
                } ?>


                <li class="nav-link">
                    <a href="history.php">
                        <i class="fa-solid fa-clock-rotate-left icon"></i>
                        <span class="text nav-text">History</span>
                    </a>
                </li>

                <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                    if (isset($_SESSION['ct']) and ($_SESSION['ct']) != 'user') { ?>
                        <li class="nav-link">
                            <a href="notifications.php">
                                <i class="fa-solid fa-bell icon"></i>
                                <span class="text nav-text">Notifications</span>
                            </a>
                        </li>
                <?php }
                } ?>

                <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                    if (isset($_SESSION['ct']) and ($_SESSION['ct']) != 'user') { ?>
                        <li class="nav-link">
                            <a href="analytics.php">
                                <i class="fa-solid fa-chart-pie icon"></i>
                                <span class="text nav-text">Analytics</span>
                            </a>
                        </li>
                <?php }
                } ?>

                <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) { ?>
                    <li class="nav-link">
                        <a href="stocks.php">
                            <i class="fa-solid fa-boxes-stacked icon"></i>
                            <span class="text nav-text">Stocks</span>
                        </a>
                    </li>
                <?php
                } ?>

                <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                    if (isset($_SESSION['ct']) and ($_SESSION['ct']) != 'user') { ?>
                        <li class="nav-link">
                            <a href="reports.php">
                                <i class="fa-solid fa-bug icon"></i>
                                <span class="text nav-text">Reports</span>
                            </a>
                        </li>
                <?php }
                } ?>

            </ul>
        </div>

        <div class="bottom-content">
            <li>
                <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) { ?>
                    <a href="profile.php">
                        <i class="fa-solid fa-user icon"></i>
                        <span class="text nav-text">Profile</span>
                    </a>
                <?php } ?>
            </li>

            <li>
                <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) { ?>
                    <a href="includes/logout.inc.php">
                        <i class="fa-solid fa-power-off icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                <?php } ?>
            </li>
            <!-- 
            <li class="mode">
                <div class="sun-moon">
                    <i class="fa-solid fa-moon icon moon"></i>
                    <i class="fa-solid fa-sun icon sun"></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li> -->

        </div>
    </div>
</nav>