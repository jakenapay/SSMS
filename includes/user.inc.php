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
        $old_img = $row['user_img'];
        $ct = $row['user_category'];
        $st = $row['user_status'];
    }
} else {
    echo "0 results";
}
