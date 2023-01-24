<?php

// database configuration
include 'config.inc.php';

$output = "";
$sql = "SELECT \n"
    . "    h.history_id as Id, COALESCE(os.os_name, CONCAT(ts.ts_name, ' ', ts.ts_model)) as Item,\n"
    . "    h.history_quantity AS Quantity, \n"
    . "    CONCAT(u.user_firstname, ' ', u.user_lastname) as User, \n"
    . "    h.history_date AS Date\n"
    . "FROM ssms.history h\n"
    . "LEFT JOIN ssms.office_supplies os ON h.os_id = os.os_id\n"
    . "LEFT JOIN ssms.technology_supplies ts ON h.ts_id = ts.ts_id\n"
    . "LEFT JOIN ssms.users u ON h.user_id = u.user_id\n"
    . "WHERE MONTH(h.history_date) = MONTH(CURRENT_DATE())\n"
    . "AND YEAR(h.history_date) = YEAR(CURRENT_DATE())\n"
    . "AND CONCAT(u.user_firstname, ' ', u.user_lastname) LIKE '%" . $_POST['search'] . "%'\n"
    . "ORDER BY h.history_date\n";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    
}
